<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Quote extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('quote_model');
        $this->load->model('common/common_model');
    }

    public function index()
    {
        $data = array();
        if (!empty($_SESSION['plan'])){
            unset($_SESSION['quote']);
            $data['fname'] = $_SESSION['plan']['FirstName'];
            $data['lname'] = $_SESSION['plan']['LastName'];
            $data['email'] = $_SESSION['plan']['email'];
            $data['phone'] = $_SESSION['plan']['HomePhone'];
            $data['cphone'] = $_SESSION['plan']['CellPhone'];
            $data['zip'] = $_SESSION['plan']['zipcode'];
            $data['address'] = $_SESSION['plan']['address'];
            $data['city'] = $_SESSION['plan']['city'];
            $data['state'] = $_SESSION['plan']['state'];
            $data['propertyType'] = $_SESSION['plan']['propertyType'];
            $data['propertySize'] = $_SESSION['plan']['propertySize'];

        }elseif (!empty($_SESSION['quote'])) {
            $data['fname'] = $_SESSION['quote']['name'];
            $data['email'] = $_SESSION['quote']['email'];
            $data['phone'] = $_SESSION['quote']['phone'];
        }
        $this->load->view('quote', $data);
    }
    public function save_first(){
        if($_POST) {
            $data = $this->input->post();

            $this->form_validation->set_rules('FirstName', 'First Name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('LastName', 'Last Name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('email', 'Email Address', 'trim|required|xss_clean');
            $this->form_validation->set_rules('HomePhone', 'Home Phone', 'trim|required|xss_clean');
            $this->form_validation->set_rules('zipcode', 'Home Zip Code', 'trim|required|xss_clean');
            $this->form_validation->set_rules('state', 'State', 'trim|required|xss_clean');
            $this->form_validation->set_rules('propertyType', 'property Type', 'trim|required|xss_clean');
            if ($this->form_validation->run($this) == FALSE)
            {
                $finalResult = array('msg' => 'error', 'response'=>validation_errors());
                echo json_encode($finalResult);
                exit;
            }else {

                if (!$this->checkEmail($data['email']))
                {
                    $finalResult = array('msg' => 'error', 'response'=>'Email is Invalid');
                    echo json_encode($finalResult);
                    exit;
                }

                unset($_SESSION['quote']);
                $_SESSION['plan'] = array();
                foreach ($data as $key=>$value){
                    $_SESSION['plan'][$key] = $value;
                }
                if (!empty($_SESSION['plan'])){
                    $finalResult = array('msg' => 'success');
                    echo json_encode($finalResult);
                    exit;
                }else{
                    $finalResult = array('msg' => 'error', 'response'=>'Something went wrong!');
                    echo json_encode($finalResult);
                    exit;
                }
            }
        }else{
            show_404();
        }
    }
    public function steptwo()
    {
        if (!empty($_SESSION['plan'])){
            $this->load->view('steptwo');
        }else{
            show_404();
        }
    }

    public function save_plan()
    {
        if($_POST) {
            $data = $this->input->post();

            $this->form_validation->set_rules('cardnumber', 'Card-Number', 'trim|required|xss_clean');
            $this->form_validation->set_rules('cvv', 'CVV', 'trim|required|xss_clean');
            $this->form_validation->set_rules('card_month', 'Expiry Month', 'trim|required|xss_clean');
            $this->form_validation->set_rules('card_year', 'Year', 'trim|required|xss_clean');
            if ($this->form_validation->run($this) == FALSE)
            {
                $finalResult = array('msg' => 'error', 'response'=>validation_errors());
                echo json_encode($finalResult);
                exit;
            }else {

                $first_quote = $_SESSION['plan'];
                unset($_SESSION['plan']);
                $final_data = array_merge($data,$first_quote);
                $plan_total = $this->calculate_plan($final_data);
                $client_ip = $this->get_client_ip();
                $customer = $this->quote_model->insert_customer($final_data,$plan_total, $client_ip);
                $customer_id = $customer['customer_id'];
                $renewal_id = $customer['renewal_id'];

//                $this->send_confirmation_email($final_data,'new_customer_policy','New Policy');

                if($customer_id > 0){
                    if ($data['coverage'] != ''){
                        $this->quote_model->insert_coverage($customer_id, $renewal_id, explode(',',$data['coverage']));
                    }
                    $finalResult = array('msg' => 'success', 'response'=>"Customer successfully registered.");
                    echo json_encode($finalResult);
                    exit;
                }else{
                    $finalResult = array('msg' => 'error', 'response'=>'Something went wrong!');
                    echo json_encode($finalResult);
                    exit;
                }
            }
        }else{
            show_404();
        }
    }

//    public function email_exists($email)
//    {
//        $email_status = $this->quote_model->check_email_update($email);
//        if ($email_status > 0)
//        {
//            $this->form_validation->set_message('email_exists', 'Email already associated with another account.');
//            return FALSE;
//        }
//        else
//        {
//            return TRUE;
//        }
//    }

    public function checkEmail($email) {
        $find1 = strpos($email, '@');
        $find2 = strpos($email, '.');
        return ($find1 !== false && $find2 !== false && $find2 > $find1);
    }

    public function get_client_ip() {
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if(isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }

    public function calculate_plan($data)
    {
        $property = get_setting('property_type',$data['propertyType']);
        $size = get_setting('property_size',$data['propertySize']);
        $optional_coverage = 0;
        if (!empty($data['coverage'])){
            $coverages = explode(',',$data['coverage']);
            foreach ($coverages as $coverage){
                $coverage_amount =get_setting('opt_coverage',$coverage);
                $optional_coverage = $optional_coverage+$coverage_amount;
            }
        }
        $plan = get_setting('plan',$data['plan']);
        $total = $property + $size + $optional_coverage + $plan;

        if ($data['schedule']==2){
            $after_split = $total/12;
        }else{
            $after_split = $total;
        }
        return round($after_split, 2);
    }

    public function send_confirmation_email($data, $template, $subject)
    {
        $email_body = $this->load->view('common/emails/'.$template , $data,TRUE);
        $tomail = $data['email'];
        $body = $email_body;
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: <'.support_email().'>' . "\r\n";
        @mail($tomail,$subject,$body,$headers);
        return true;
    }
}
