<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Claims extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model(admin_controller() . 'claim_model');
        $this->load->model('common/common_model');
        if (!$this->session->userdata('admin_logged_in')) {
            redirect(admin_url() . 'login');
        }
        if (get_session('admin_type') == 2 && (get_session('admin_permissions')['claims'] == 'N/A' || get_session('admin_permissions')['claims']['view'] == 0)){
            redirect(admin_url());
        }
    }

    public function index()
    {
        if (get_session('admin_type') == 2 && (get_session('admin_permissions')['claims'] == 'N/A' || get_session('admin_permissions')['claims']['view'] == 0)){
            show_admin404();
        }else{
            $data['claims'] = $this->claim_model->get_claims();
            $this->load->view('claims/claims', $data);
        }
    }

    public function add($id='')
    {
        if (get_session('admin_type') == 1 || (get_session('admin_type') == 2 && get_session('admin_permissions')['claims'] != 'N/A' && get_session('admin_permissions')['claims']['add'] == 1)){
            if (!empty($id)) {
                $data = array('id' => $id);
                $this->load->view('claims/add_claim', $data);
            } else {
                $this->load->view('claims/add_claim');
            }
        }else {
            show_admin404();
        }
    }

    public function save()
    {
        if (get_session('admin_type') == 1 || (get_session('admin_type') == 2 && get_session('admin_permissions')['claims'] != 'N/A' && get_session('admin_permissions')['claims']['add'] == 1)){
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
						save_log_note($data['customer'], "Claim inserted by admin ".$claim_num);
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
        }else {
            redirect(admin_url());
        }
    }

    public function claim_details()
    {
        if($_POST){
            $data = $this->input->post();
            $details['claim'] = $this->claim_model->claim_detail($data['id'], $data['claim_customer_id']);
            $view = "claims/claim_details";

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

    public function update_status()
    {
        if (get_session('admin_type') == 1 || (get_session('admin_type') == 2 && get_session('admin_permissions')['claims'] != 'N/A' && get_session('admin_permissions')['claims']['edit'] == 1)) {
            if ($_POST) {
                $data = $this->input->post();
                $claim_status = $this->claim_model->update_status($data);

                if ($claim_status > 0) {
                    $finalResult = array('msg' => 'success', 'response' => "Status successfully updated.");
                    echo json_encode($finalResult);
                    exit;
                } else {
                    $finalResult = array('msg' => 'error', 'response' => 'Something went wrong!');
                    echo json_encode($finalResult);
                    exit;
                }
            } else {
                show_admin404();
            }
        }else{
            $finalResult = array('msg' => 'error', 'response' => 'Access denied!');
            echo json_encode($finalResult);
            exit;
        }
    }

    public function update_satisfaction()
    {
        if (get_session('admin_type') == 1 || (get_session('admin_type') == 2 && get_session('admin_permissions')['claims'] != 'N/A' && get_session('admin_permissions')['claims']['edit'] == 1)) {
            if($_POST){
                $data = $this->input->post();
                $claim_status = $this->claim_model->update_satisfaction($data);

                if($claim_status > 0){
                    $finalResult = array('msg' => 'success', 'response'=>"Satisfaction status successfully updated.");
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
        }else{
            $finalResult = array('msg' => 'error', 'response' => 'Access denied!');
            echo json_encode($finalResult);
            exit;
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

    public function assign_vendor()
    {
        if (get_session('admin_type') == 1 || (get_session('admin_type') == 2 && get_session('admin_permissions')['claims'] != 'N/A' && get_session('admin_permissions')['claims']['edit'] == 1)) {
            if($_POST){
                 $data = $this->input->post();
                $zip_code = get_data($data['customer'],'customers','','zip_code');
                $customer_zipcode = $zip_code[0]['zip_code'];
                $zip_code_data = get_data("",'zipcodes',['zipcode'=>$customer_zipcode],['latitude','longitude']);
                $nearby_zipcodes_in_radius = get_zipcodes_in_radius($zip_code_data[0]['latitude'],$zip_code_data[0]['longitude']);

                $nearby_vendors = [];
                foreach($nearby_zipcodes_in_radius as $key=>$vendor){
                        $nearby_vendors[] = $vendor['meta_key'];
                }

                if(count($nearby_vendors)>0){
                    $vendors = get_vendors_by_ids($nearby_vendors);   
                
                    $details['vendors'] = $vendors;
                    $details['claim']= $data['claim'];
                    $details['customer']= $data['customer'];
                    $vendor= $this->claim_model->claim_detail($data['claim'], $data['customer']);
                    if (empty($vendor['vendor'])){
                        $details['old_vendor']='';
                    }else{
                        $details['old_vendor']=$vendor['vendor'];
                    }
                    $view = "claims/vendor_list";
                    if(!empty($details)) {
                        $htmlrespon = $this->load->view($view , $details,TRUE);
                        $finalResult = array('msg' => 'success', 'response'=>$htmlrespon);
                        echo json_encode($finalResult);
                        exit;

                    } else {
                        $finalResult = array('msg' => 'error', 'response'=>"Something went wrong!");
                        echo json_encode($finalResult);
                        exit;
                    }
                }
                else {
                    $finalResult = array('msg' => 'error', 'response'=>"No nearby vendor available");
                    echo json_encode($finalResult);
                    exit;
                }
            }else{
                show_admin404();
            }
        }else{
            $finalResult = array('msg' => 'error', 'response' => 'Access denied!');
            echo json_encode($finalResult);
            exit;
        }
    }

    public function vendor_details()
    {
        if($_POST){
            $data = $this->input->post();
            $details['vendor'] = get_vendors($data['id']);
            $details['services'] = $this->common_model->get_data('','vendor_services',array('vendor'=>$data['id']),'service');
            $view = "claims/vendor_detail";
            if(!empty($details)) {
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

    public function update_vendor()
    {
        if (get_session('admin_type') == 1 || (get_session('admin_type') == 2 && get_session('admin_permissions')['claims'] != 'N/A' && get_session('admin_permissions')['claims']['edit'] == 1)) {
            if($_POST){
                $data = $this->input->post();
                $claim_status = $this->claim_model->update_vendor($data);
                $details = $this->claim_model->claim_detail($data['claim'], $data['customer']);
                if($claim_status > 0){
                    $data['status'] = 2; // Update status to Assigned
                    $result = $this->claim_model->update_status($data);
                    if ($result > 0){
                        $details['customer'] = get_customers($details['customer']);
                        $details['vendor'] = get_vendors($details['vendor']);
                        $details['policy'] = $this->claim_model->get_policy_num($details['customer']['id']);
                        $details['policydetails'] = get_customer_policy($details['policy']['policy_num']);
                    
                        // calculate pending Free scf
                        // if no. of claims less than free_scf then we will not charge service fee 
                        $total_claims  = $this->claim_model->get_total_claims_by_customer($data['customer']);
                        $details['free_scf'] = false;
                        if($total_claims <= $details['policydetails']['free_scf']){
                            $details['free_scf'] = true;
                        }
                        
                        // Send emails
                        $this->send_confirmation_email($details,$details['vendor']['email'],'vendor_assign_vendor','You Have a New Work Order from CCHW | SWO# '.$details['claim_num']);
                        $this->send_confirmation_email($details,$details['customer']['email'],'vendor_assign_customer','Your Claim Has Been Assigned to a Contractor');
                        
                        //Add to notes
                        if(!$details['free_scf']){
                            $scf_content = get_claim_value('scf', $details['policydetails']['scf']);
                            $scf_cost =  $scf_content['meta_value'];
                        }else{
                            $scf_cost = "0";
                        }
                        $note_content = '<span style="font-size:12pt">
                                        Your claim has been assigned to '. $details['vendor']['company']. ' They can be reached at '.$details['vendor']['phone'] .' 
                                        or&nbsp;<a href="mailto: '.$details['vendor']['email'] .'" target="_blank">'.$details['vendor']['email'].'</a>. 
                                        Please contact the service contractor directly to schedule a mutually convenient appointment. 
                                        Upon the technicians arrival you will be required to pay a 
                                        $'. $scf_cost.' service call fee.</span>';
                        $this->load->model('Task_model','task_model');
                        $this->task_model->insert_task([
                            'customer' => $details['customer']['id'],
                            'text' => $note_content,
                            'type' => 2,
                            'assign_to' => 0,
                            'claim' => $details['id']
                        ]);




                        $finalResult = array('msg' => 'success', 'response'=>"Vendor successfully assigned.");
                        echo json_encode($finalResult);
                        exit;
                    }
                    else{
                        $finalResult = array('msg' => 'error', 'response'=>'Something went wrong!');
                        echo json_encode($finalResult);
                        exit;
                    }
                }else{
                    $finalResult = array('msg' => 'error', 'response'=>'Something went wrong!');
                    echo json_encode($finalResult);
                    exit;
                }
            }else{
                show_admin404();
            }
        }else{
            $finalResult = array('msg' => 'error', 'response' => 'Access denied!');
            echo json_encode($finalResult);
            exit;
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

    public function open_diagnose()
    {
        if (get_session('admin_type') == 1 || (get_session('admin_type') == 2 && get_session('admin_permissions')['claims'] != 'N/A' && get_session('admin_permissions')['claims']['edit'] == 1)) {
            if($_POST){
                $data = $this->input->post();
                $result = $this->common_model->get_data($data['claim'],'claims');
                // if (!empty($result[0]['vendor']) ){
               if ($result[0]['status']=='2' || $result[0]['status']=='7' || $result[0]['status']=='9' ){
                    $details['claim'] = $result[0];
                    $view = "claims/diagnose_form";
                    if(!empty($details)) {
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
                    $finalResult = array('msg' => 'error', 'response'=>'Either vendor not assigned yet or diagonsis form is unavailable!');
                    echo json_encode($finalResult);
                    exit;
                }

            }else{
                show_admin404();
            }
        }else{
            $finalResult = array('msg' => 'error', 'response' => 'Access denied!');
            echo json_encode($finalResult);
            exit;
        }
    }

    public function update_diagnose()
    {
        if (get_session('admin_type') == 1 || (get_session('admin_type') == 2 && get_session('admin_permissions')['claims'] != 'N/A' && get_session('admin_permissions')['claims']['edit'] == 1)) {
            if($_POST){
                $data = $this->input->post();

                $this->form_validation->set_rules('p_price','Part Number Price','required|regex_match[/^[0-9]{1,9}(,[0-9]{9})*(\.[0-9]+)*$/]');
                $this->form_validation->set_rules('service_fee','Service Call Fee','required|regex_match[/^[0-9]{1,9}(,[0-9]{9})*(\.[0-9]+)*$/]');
                $this->form_validation->set_rules('total','Total','required|regex_match[/^[0-9]{1,9}(,[0-9]{9})*(\.[0-9]+)*$/]');

                if ($this->form_validation->run($this) == FALSE)
                {
                    $finalResult = array('msg' => 'error', 'response'=>validation_errors());
                    echo json_encode($finalResult);
                    exit;
                }else{

                    $claim_status = $this->claim_model->update_diagnose($data);
                    if($claim_status > 0){
                        $claim = get_claim_data($data['id']);
                        $claim_num = $claim['claim_num'];
                        $finalResult = array('msg' => 'success', 'response'=>"Diagnose successfully inserted.", 'claim' => $claim_num);
                        echo json_encode($finalResult);
                        exit;
                    }else{
                        $finalResult = array('msg' => 'error', 'response'=>'Something went wrong!');
                        echo json_encode($finalResult);
                        exit;
                    }
                }
            }else{
                show_admin404();
            }
        }else{
            $finalResult = array('msg' => 'error', 'response' => 'Access denied!');
            echo json_encode($finalResult);
            exit;
        }
    }


    function numeric_wcomma()
    {
        $data = $_POST;
        $str = $data['total'];
        return preg_match('/^[0-9,]+$/', $str);
    }

    public function resend_swo()
    {
        if (get_session('admin_type') == 1 || (get_session('admin_type') == 2 && get_session('admin_permissions')['claims'] != 'N/A' && get_session('admin_permissions')['claims']['edit'] == 1)) {
            if($_POST){
                $data = $this->input->post();
                $details = $this->claim_model->claim_detail($data['claim'], $data['customer']);
                if (!empty($details['vendor'])){
                    $details['customer'] = get_customers($details['customer']);
                    $details['vendor'] = get_vendors($details['vendor']);

                    $details['policy'] = $this->claim_model->get_policy_num($details['customer']['id']);
                    $details['policydetails'] = get_customer_policy($details['policy']['policy_num']);

                    // calculate pending Free scf
                    // if no. of claims less than free_scf then we will not charge service fee 
                    $total_claims  = $this->claim_model->get_total_claims_by_customer($data['customer']);
                    $details['free_scf'] = false;
                    if($total_claims <= $details['policydetails']['free_scf']){
                        $details['free_scf'] = true;
                    }

                    $this->send_confirmation_email($details,$details['vendor']['email'],'vendor_assign_vendor','You Have a New Work Order from CCHW | SWO# '.$details['claim_num']);
                    $this->send_confirmation_email($details,$details['customer']['email'],'vendor_assign_customer','Your Claim Has Been Assigned to a Contractor');
    
                     //Add to notes
                     if(!$details['free_scf']){
                        $scf_content = get_claim_value('scf', $details['policydetails']['scf']);
                        $scf_cost =  $scf_content['meta_value'];
                    }else{
                        $scf_cost = "0";
                    }

                     $note_content = '<span style="font-size:12pt">
                                     <b>Resend SWO</b> <br/>   
                                     Your claim has been assigned to '. $details['vendor']['company']. ' They can be reached at '.$details['vendor']['phone'] .' 
                                     or&nbsp;<a href="mailto: '.$details['vendor']['email'] .'" target="_blank">'.$details['vendor']['email'].'</a>. 
                                     Please contact the service contractor directly to schedule a mutually convenient appointment. 
                                     Upon the technicians arrival you will be required to pay a 
                                     $'. $scf_cost.' service call fee.</span>';
                     $this->load->model('Task_model','task_model');
                     $this->task_model->insert_task([
                         'customer' => $details['customer']['id'],
                         'text' => $note_content,
                         'type' => 2,
                         'assign_to' => 0,
                         'claim' => $details['id']
                     ]);




                    $finalResult = array('msg' => 'success', 'response'=>"Vendor Assignment emails successfully sent.");
                    echo json_encode($finalResult);
                    exit;
                }else{
                    $finalResult = array('msg' => 'error', 'response'=>'Vendor not assigned yet!');
                    echo json_encode($finalResult);
                    exit;
                }
            }else{
                show_admin404();
            }
        }else{
            $finalResult = array('msg' => 'error', 'response' => 'Access denied!');
            echo json_encode($finalResult);
            exit;
        }
    }

    public function reimbursement()
    {
        if (get_session('admin_type') == 1 || (get_session('admin_type') == 2 && get_session('admin_permissions')['claims'] != 'N/A' && get_session('admin_permissions')['claims']['edit'] == 1)) {
            if($_POST){
                $data = $this->input->post();
                $details = $this->claim_model->claim_detail($data['claim'], $data['customer']);

                // if($details['status']=='1'){
                    //$data['status'] = 2; // Update status to Assigned
                    $result = $this->claim_model->make_reimbursement($data);
                    if ($result > 0){
                        $details['customer'] = get_customers($details['customer']);
//                        $details['vendor'] = get_vendors($details['vendor']);

                        $details['policy'] = $this->claim_model->get_policy_num($details['customer']['id']);
                        $details['policydetails'] = get_customer_policy($details['policy']['policy_num']);
                        
                        $this->send_confirmation_email($details,$details['customer']['email'],'customer_reimbursement','Complete Care Home Warranty | Claim Reimbursement Procedures');
						$CI = & get_instance();
						$CI->load->model('Task_model','task_model');
						$CI->task_model->insert_task([
							'customer' => $details['customer']['id'],
							'text' => '<p><strong>Reimbursement Claimed</strong></p>',
							'type' => 2,
							'assign_to' => 0,
							'claim' => $details['id']
						]);
                        $finalResult = array('msg' => 'success', 'response'=>"Claim reimbursement email successfully sent.");
                        echo json_encode($finalResult);
                        exit;
                    }else{
                        $finalResult = array('msg' => 'error', 'response'=>'Something went wrong!');
                        echo json_encode($finalResult);
                        exit;
                    }
             //   }

            }else{
                show_admin404();
            }
        }else{
            $finalResult = array('msg' => 'error', 'response' => 'Access denied!');
            echo json_encode($finalResult);
            exit;
        }
    }

    public function vendor_reassign()
    {
        if (get_session('admin_type') == 1 || (get_session('admin_type') == 2 && get_session('admin_permissions')['claims'] != 'N/A' && get_session('admin_permissions')['claims']['edit'] == 1)) {
            if($_POST){
                $data = $this->input->post();
                $details = $this->claim_model->claim_detail($data['claim'], $data['customer']);
                if (!empty($details['vendor'])){
                    $data['status'] = 5;
                    $result = $this->claim_model->update_status($data);
                    if ($result > 0){
                        $finalResult = array('msg' => 'success', 'response'=>"Claim status successfully changed to reassign.");
                        echo json_encode($finalResult);
                        exit;
                    }else{
                        $finalResult = array('msg' => 'error', 'response'=>'Something went wrong!');
                        echo json_encode($finalResult);
                        exit;
                    }
                }else{
                    $finalResult = array('msg' => 'error', 'response'=>'Vendor not assigned yet!');
                    echo json_encode($finalResult);
                    exit;
                }
            }else{
                show_admin404();
            }
        }else{
            $finalResult = array('msg' => 'error', 'response' => 'Access denied!');
            echo json_encode($finalResult);
            exit;
        }
    }

    public function claim_recall()
    {
        if (get_session('admin_type') == 1 || (get_session('admin_type') == 2 && get_session('admin_permissions')['claims'] != 'N/A' && get_session('admin_permissions')['claims']['edit'] == 1)) {
            if($_POST){
                $data = $this->input->post();
                $details = $this->claim_model->claim_detail($data['claim'], $data['customer']);
                if (!empty($details['vendor'])){
                    $details['customer'] = get_customers($details['customer']);
                    $details['vendor'] = get_vendors($details['vendor']);

                    $str = $details['item'];
                    $str_meta_key = explode("-", $str);
                    if ($str_meta_key[0] == 's') {
                        $meta_tag = 'systems';
                    }elseif ($str_meta_key[0] == 'a') {
                        $meta_tag = 'appliance';
                    }elseif ($str_meta_key[0] == 'c') {
                        $meta_tag = 'combo';
                    }else{
                        $meta_tag = 'opt_coverage';
                    }
                    $get_meta_content = get_claim_value($meta_tag, $str_meta_key[1]);
                    $details['item'] = $get_meta_content['meta_content'];

                    $this->send_confirmation_email($details,$details['customer']['email'],'vendor_assign_customer','Claim Recall');
                    $this->send_confirmation_email($details,$details['vendor']['email'],'vendor_assign_vendor','Claim Recall');

                    $finalResult = array('msg' => 'success', 'response'=>"Claim recall email successfully sent.");
                    echo json_encode($finalResult);
                    exit;
                }else{
                    $finalResult = array('msg' => 'error', 'response'=>'Vendor not assigned yet!');
                    echo json_encode($finalResult);
                    exit;
                }
            }else{
                show_admin404();
            }
        }else{
            $finalResult = array('msg' => 'error', 'response' => 'Access denied!');
            echo json_encode($finalResult);
            exit;
        }
    }

    public function delete_claim()
    {
        if (get_session('admin_type') == 1 || (get_session('admin_type') == 2 && get_session('admin_permissions')['claims'] != 'N/A' && get_session('admin_permissions')['claims']['delete'] == 1)) {
            if($_POST){
                $claim = $_POST['claim'];
                $status = $this->claim_model->delete_claim($claim);
                if($status > 0){
                    $finalResult = array('msg' => 'success', 'response'=>"Claim successfully deleted.");
                    echo json_encode($finalResult);
                    exit;
                } else {
                    $finalResult = array('msg' => 'error', 'response'=>"Something went wrong please try again.");
                    echo json_encode($finalResult);
                    exit;
                }
            }else{
                show_admin404();
            }
        }else{
            $finalResult = array('msg' => 'error', 'response' => 'Access denied!');
            echo json_encode($finalResult);
            exit;
        }
    }

    public function check_authorize()
    {
        if (get_session('admin_type') == 1 || (get_session('admin_type') == 2 && get_session('admin_permissions')['invoice'] != 'N/A' && get_session('admin_permissions')['invoice']['add'] == 1)){
            if($_POST){
                $data = $this->input->post();
                if(!is_reimbursement_claimed($data['claimnum'])){
                $details = $this->common_model->get_data($data['claim'],'claims','',array('vendor','diagnose_by'));
                if (empty($details[0]['vendor'])) {
                    $finalResult = array('msg' => 'error', 'response' => 'Vendor not assigned yet!');
                    echo json_encode($finalResult);
                    exit;
                }elseif (empty($details[0]['diagnose_by'])){
                    $finalResult = array('msg' => 'error', 'response'=>'Diagnosis not added yet!');
                    echo json_encode($finalResult);
                    exit;
                }else{
                    $finalResult = array('msg' => 'success');
                    echo json_encode($finalResult);
                    exit;
                }
            }else{
					$finalResult = array('msg' => 'success');
					echo json_encode($finalResult);
					exit;
				}
            }else{
                show_admin404();
            }
        }else{
            $finalResult = array('msg' => 'error', 'response' => 'Access denied!');
            echo json_encode($finalResult);
            exit;
        }
    }

    public function update_authorization()
    {
        if (get_session('admin_type') == 1 || (get_session('admin_type') == 2 && get_session('admin_permissions')['invoice'] != 'N/A' && get_session('admin_permissions')['invoice']['add'] == 1)){
            if($_POST){
                $data = $this->input->post();
                $this->form_validation->set_rules('amount', 'Amount', 'trim|required|xss_clean|numeric');

                if ($this->form_validation->run($this) == FALSE)
                {
                    $finalResult = array('msg' => 'error', 'response'=>validation_errors());
                    echo json_encode($finalResult);
                    exit;
                }else{

                    preg_match_all('!\d+!', $data['amount'], $matches);
                    if (!empty($matches)){
                        $amount = implode('.',$matches[0]);
                    }else{
                        $finalResult = array('msg' => 'error', 'response' => 'Amount must only be numeric');
                        echo json_encode($finalResult);
                        exit;
                    }
                    $details = $this->claim_model->check_authorize(array('claim'=>$data['claim'],'type'=>$data['type']));
                    if (empty($details)){
                        $auth_num = str_pad(mt_rand(1,99999999),8,'0',STR_PAD_LEFT);
                        $check_aut= $this->claim_model->check_authorize(array('auth_num'=>$auth_num));

                        if (empty($check_aut)) {
                            $auth_id = $this->claim_model->save_authorization($data,$amount,$auth_num);
                            if($auth_id > 0){
                                $claim = get_claim_data($data['claim']);
                                $claim_num = $claim['claim_num'];
                                $finalResult = array('msg' => 'success', 'response'=>"Claim successfully authorized.", 'claim' => $claim_num);
                                echo json_encode($finalResult);
                                exit;
                            } else {
                                $finalResult = array('msg' => 'error', 'response'=>"Something went wrong please try again.");
                                echo json_encode($finalResult);
                                exit;
                            }
                        }else{
                            $finalResult = array('msg' => 'error', 'response' => 'Claim already authorized!');
                            echo json_encode($finalResult);
                            exit;
                        }
                    }else{
                        $finalResult = array('msg' => 'error', 'response' => 'Claim already authorized!');
                        echo json_encode($finalResult);
                        exit;
                    }
                }
            }else{
                show_admin404();
            }
        }else{
            $finalResult = array('msg' => 'error', 'response' => 'Access denied!');
            echo json_encode($finalResult);
            exit;
        }
    }

    public function send_refund_mail()
    {
        if($_POST){
            $data = $this->input->post();
            $customer = get_customers($data['customer']);
            $customer['policy'] = $this->claim_model->get_policy_num($customer['id']);
            if ($data['action']==1){
                $status = $this->send_refund_email($customer,$customer['email'],'past_due','Important message regarding your Home Warranty account');
            }elseif ($data['action']==2){
                $status = $this->send_refund_email($customer,$customer['email'],'email_confirm','Email Confirmation');
            }elseif ($data['action']==3){
                $status = $this->send_refund_email($customer,$customer['email'],'txt_mail','TXT Confirmation');
            }elseif ($data['action']==4){
                $status = $this->send_refund_email($customer,$customer['email'],'paid_invoice','Paid Invoice');
            }
            if ($status > 0){
                $finalResult = array('msg' => 'success', 'response'=>"Email successfully sent.");
                echo json_encode($finalResult);
                exit;
            }else{
                $finalResult = array('msg' => 'error', 'response'=>"Something went wrong please try again.");
                echo json_encode($finalResult);
                exit;
            }
        }else{
            show_admin404();
        }
    }

    public function send_refund_email($data,$to, $template, $subject)
    {
        $email_body = $this->load->view('common/emails/'.$template , $data,TRUE);

        $this->load->library('email');
        $this->email->set_newline("\r\n");

        $this->email->from(support_email(), 'Complete Care Home Warranty');
        $this->email->to($to);

        $this->email->subject($subject);
        $this->email->message($email_body);

        if($this->email->send())
        {
            return 1;
        }
        else
        {
            show_error($this->email->print_debugger());
            return 0;
        }


//        $email_body = $this->load->view('common/emails/'.$template , $data,TRUE);
//        $body = $email_body;
//        $headers = "MIME-Version: 1.0" . "\r\n";
//        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
//        $headers .= 'From: <'.support_email().'>' . "\r\n";
//        if (@mail($to,$subject,$body,$headers)){
//            return 1;
//        }else{
//            return 0;
//        }
    }
    public function get_cliams_authorize()
    {
        if($_POST){
            $data = $this->input->post();
            $details['claim_auth'] = $this->common_model->get_data('','claim_auth',array('claim'=>$data['claim'],'status'=>1));

            $htmlrespon = $this->load->view('claims/claim_auth_ajax' , $details,TRUE);
            if ($details) {
                $finalResult = array('msg' => 'success', 'response' => $htmlrespon);
                echo json_encode($finalResult);
                exit;
            }
            else{
                $finalResult = array('msg' => 'error','response' => 'Something went wrong');
                echo json_encode($finalResult);
                exit;
            }
        }else{
            show_admin404();
        }
    }
    public function remove_cliams_authorize()
    {
        if (get_session('admin_type') == 1 || (get_session('admin_type') == 2 && get_session('admin_permissions')['invoice'] != 'N/A' && get_session('admin_permissions')['invoice']['delete'] == 1)){
            $status = $this->claim_model->change_authorization_status($_POST);
            if($status){
                $finalResult = array('msg' => 'success', 'response'=>'Authorization removed!');
                echo json_encode($finalResult);
                exit;
            }else{
                $finalResult = array('msg' => 'error', 'response'=>'Something went wrong!');
                echo json_encode($finalResult);
                exit;
            }
        }else{
            $finalResult = array('msg' => 'error', 'response' => 'Access denied!');
            echo json_encode($finalResult);
            exit;
        }
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
	
    public function claim_files() {

        if ($_POST) {
            $data = $this->input->post();
            $this->form_validation->set_rules('image_alts', 'Image Alt', 'trim|required|xss_clean');
            if ($this->form_validation->run() == FALSE) {
                $finalResult = array('msg' => 'error', 'response'=>validation_errors());
                echo json_encode($finalResult);
                exit;
            } else {

                if (!empty($_FILES['claimimage']['name'])) {


                    $main = $this->upload_image(FCPATH . 'assets/claim_files', 'claimimage');

                    if ($main['msg'] == 'success') {
                        $data['image'] = $main['response'];

                    } else {
                        $finalResult = array('msg' => 'error', 'response' => $main['response']);
                        echo json_encode($finalResult);
                        exit;
                    }
                }

                // insert records to old post table
                $image_id = $this->claim_model->insert_image($data);
                if($image_id > 0) {
                    $finalResult = array('msg' => 'success', 'response'=>"File successfully uploaded.");
                    echo json_encode($finalResult);
                    exit;
                } else {
                    $finalResult = array('msg' => 'error', 'response'=>'Something went wrong!');
                    echo json_encode($finalResult);
                    exit;
                }
            }
        } else {
            show_admin404();
        }
    }
	
    public function view_file($id) {
        if ($id) {
            $rowData =  singleRow('claim_files', '*', array('id'=>$id)) ;
			$data['claims'] =  $rowData;
            $this->load->view('claims/view_claim_file', $data);
        } else {
            show_admin404();
        }
    }

    public function upload_image($path , $image_type) {
        $config['upload_path'] = $path;
        $config['allowed_types'] = 'jpg|png|jpeg|pdf|csv|txt|doc|docx|JPG|PNG|JPEG|PDF|DOC|DOCX|xls|xlsx|CSV|TXT';
        $config['max_size'] = 10240;
        $config['max_width'] = 5000;
        $config['max_height'] = 5000;

        $this->load->library('upload');
        $this->upload->initialize($config);

        if ($this->upload->do_upload($image_type)) {
            $banner_upload = $this->upload->data();
            return array( 'msg' => 'success', 'response' => $banner_upload['file_name']);

        } else {

            return array( 'msg' => 'error', 'response' => $this->upload->display_errors());
        }
    }
}
