<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Claims extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('customers/claim_model');
        $this->load->model('common/common_model');
        if (!$this->session->userdata('admin_logged_in')) {
            redirect(base_url() . 'login');
        }
       
    }
    public function index()
    {
		$data['id'] = $this->session->userdata('id');
        $data['claims'] = $this->claim_model->get_claims();
        $this->load->view('claims', $data);
        
    }

    public function view_claim_details($id)
    {
		$data['id'] = $this->session->userdata('id');
		$data['claim_id'] = $id;
            $data['claims'] = $this->claim_model->get_claims($data);
			
            $this->load->view('view_claim_details', $data);
       
    }
    public function add($id='')
    {
        if (get_session('admin_type') == 1 || (get_session('admin_type') == 2 && get_session('admin_permissions')['claims'] != 'N/A' && get_session('admin_permissions')['claims']['add'] == 1)){
            if (!empty($id)) {
                $data = array('id' => $id);
                $this->load->view('add_claim', $data);
            } else {
                $this->load->view('add_claim');
            }
        }else {
            show_admin404();
        }
    }
    public function save()
    {
       
            if ($_POST) {
                $data = $this->input->post();
                $this->form_validation->set_rules('customer', 'Customer', 'trim|required|xss_clean');
                $this->form_validation->set_rules('item', 'Item', 'trim|required|xss_clean');
                $this->form_validation->set_rules('last_working', 'Last working time', 'trim|required|xss_clean');
                $this->form_validation->set_rules('make', 'Make/Model/Serial', 'trim|required|xss_clean');
                $this->form_validation->set_rules('last_serviced', 'Last Time Serviced', 'trim|required|xss_clean');
                if ($this->form_validation->run($this) == FALSE) {
                    $finalResult = array('msg' => 'error', 'response' => validation_errors());
                    echo json_encode($finalResult);
                    exit;
                } else {
                    $i = 1;
                    if (!get_last_claim_num()) {
                        $add_claim_num = str_pad(34199 + $i, 5, '0', STR_PAD_LEFT);
                    } else {
                        $claim_num = get_last_claim_num();
                        $add_claim_num = str_pad($claim_num + $i, 5, '0', STR_PAD_LEFT);
                    }
                    $claim_id = $this->claim_model->insert_claim($data, $add_claim_num);
                    if ($claim_id > 0) {
                        $claim = get_claim_data($claim_id);
                        $claim_num = $claim['claim_num'];
                        $finalResult = array('msg' => 'success', 'response' => "Claim successfully inserted.", 'claim' => $claim_num);
                        echo json_encode($finalResult);
                        exit;
                    } else {
                        $finalResult = array('msg' => 'error', 'response' => 'Something went wrong!');
                        echo json_encode($finalResult);
                        exit;
                    }
                }
            } else {
                show_admin404();
            }
    }
    public function claim_details()
    {
        if($_POST){
            $data = $this->input->post();
            $details['claim'] = $this->claim_model->claim_detail($data['id'], $data['claim_customer_id']);
            $view = "claim_details";
            if(!empty($details['claim'])) {
                $htmlrespon = $this->load->view($view , $details,TRUE);
                $finalResult = array('msg' => 'success', 'response'=>$htmlrespon);
                echo json_encode($finalResult);
                exit;
            } else {
                $finalResult = array('msg' => 'error', 'response'=>"Something went wrong!");
                echo json_encode($finalResult);
                exit;
            }
        }else{
            show_admin404();
        }
    }
    public function get_claim() {
        if($_POST) {
            $data = $this->input->post();
            $details = get_data('','claims',array('claim_num'=>$data['id']),array('claim_num','customer','status','updated_at,created_at,item,problem'));
            if(!empty($details)) {
                $finalResult = array('msg' => 'success', 'response' => base_url().'admin/customers/edit/'.$details[0]['customer'].'/'.$details[0]['claim_num']);
                echo json_encode($finalResult);
                exit;
            } else {
                $finalResult = array('msg' => 'error', 'response'=>"No record found!");
                echo json_encode($finalResult);
                exit;
            }
        } else {
            show_admin404();
        }
    }
    public function send_confirmation_email($data, $to, $template, $subject)
    {
        $email_body = $this->load->view('common/emails/'.$template , $data,TRUE);
        // $config = Array(
        //     'protocol' => 'smtp',
        //     'smtp_host' => 'ssl://smtp.googlemail.com',
        //     'smtp_port' => 465,
        //     'smtp_user' => 'Info@completecarehomewarranty.com',
        //     'smtp_pass' => 'Dcemmeeaj9',
        //     'mailtype'  => 'html',
        //     'charset'   => 'utf-8'
        // );
        // $this->load->library('email', $config);
        $this->load->library('email');
        $this->email->set_newline("\r\n");
        $this->email->from(support_email(), 'Complete Care Home Warranty');
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($email_body);
        if($this->email->send())
        {
            return true;
        }
        else
        {
            show_error($this->email->print_debugger());
        }
//        $email_body = $this->load->view('common/emails/'.$template , $data,TRUE);
//
//        $body = $email_body;
//        $headers = "MIME-Version: 1.0" . "\r\n";
//        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
//        $headers .= 'From: <'.support_email().'>' . "\r\n";
//        @mail($to,$subject,$body,$headers);
//        return true;
    }
    public function get_claim_item_covered()
    {
        $id = $this->input->post('id');
        $policy_num = $this->claim_model->get_policy_num($id);
        $get_plan = get_customer_policy($policy_num['policy_num']);
        $plan_data = get_plan_name('plan', $get_plan['plan']);
        if ($plan_data['meta_key'] == '1') {
            $data['opt']= 'c';
        }elseif ($plan_data['meta_key'] == '2') {
            $data['opt']= 's';
        }elseif ($plan_data['meta_key'] == '3') {
            $data['opt']= 'a';
        }
        $data['plan_name'] = get_plan_data($plan_data['meta_key']);
        $plan_coverage = get_coverage_ids($id, $get_plan['id']);
        $data['opt_coverages'] = get_plan_coverages('opt_coverage', $plan_coverage);
        echo json_encode($data);
    }

	public function add_note()
    {
        if($_POST){
            $data = $this->input->post();

            $claim_id = $this->claim_model->insert_task($data);
            if($claim_id > 0){
                $claim = get_claim_data($data['claim']);
                $claim_num = $claim['claim_num'];
                if ($data['type']==1){
                    $msg = "Task successfully inserted.";
                }else{
                    $msg = "Note successfully inserted.";
                }
                $finalResult = array('msg' => 'success', 'response'=>$msg, 'claim' => $claim_num);
                echo json_encode($finalResult);
                exit;
            }else{
                $finalResult = array('msg' => 'error', 'response'=>'Something went wrong!');
                echo json_encode($finalResult);
                exit;
            }
        }else{
            show_admin404();
        }
    }

}