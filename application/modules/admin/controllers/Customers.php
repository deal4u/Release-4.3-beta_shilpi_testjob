<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Customers extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model(admin_controller() . 'customer_model');
        $this->load->model(admin_controller() . 'claim_model');
        $this->load->model('common/common_model');
        if (!$this->session->userdata('admin_logged_in')) {
            redirect(admin_url() . 'login');
        }
    }

    public function index()
    {
       $data['customers'] = $this->customer_model->get_customers($this->session->userdata('admin_id'));
        $this->load->view('customers/customers', $data);
    }

    public function add($id='')
    {
        if (isset($_GET['first'])){
            $data['details']['first_name'] = trim($_GET['first']);
            $data['details']['last_name'] = trim($_GET['last']);
            $data['details']['email'] = trim($_GET['email']);
            $data['details']['lead_source'] = trim($_GET['lead_source']);
            $data['details']['street_address'] = trim($_GET['address']);
            $data['details']['city'] = trim($_GET['city']);
            $data['details']['state'] = trim($_GET['state']);
            $data['details']['zip_code'] = trim($_GET['zip']);
            $data['details']['home_phone'] = trim($_GET['mobile']);
            $data['details']['work_phone'] = trim($_GET['mobile']);
            $this->load->view('customers/add_customer', $data);
        }else{
            if (get_session('admin_type') == 1 || (get_session('admin_type') == 2 && get_session('admin_permissions')['miscellaneous'] != 'N/A' && isset(get_session('admin_permissions')['miscellaneous']->add_customer))) {
				
                if (!empty($id)) {
					
                    $details = $this->customer_model->get_plan_policy_data($id);
                   // if (!empty(check_expired_policy($details['policy_num']))) {
                        $data['details'] = $details;
                        $this->load->view('customers/add_customer', $data);
                   /*  } else {
                        show_admin404();
                    } */
                } else {
                    $this->load->view('customers/add_customer');
                }
            }else{
                show_admin404();
            }
        }
    }

    public function save(){
        if (get_session('admin_type') == 1 || (get_session('admin_type') == 2 && get_session('admin_permissions')['miscellaneous'] != 'N/A' && isset(get_session('admin_permissions')['miscellaneous']->add_customer))) {
            if ($_POST) {
                $data = $this->input->post();
                $this->form_validation->set_rules('s_person', 'Sales Person', 'trim|required|xss_clean');
                $this->form_validation->set_rules('lead_source', 'Lead Source', 'trim|required|xss_clean');
                $this->form_validation->set_rules('c_fname', 'First Name', 'trim|required|xss_clean');
                $this->form_validation->set_rules('c_lname', 'Last Name', 'trim|required|xss_clean');
                if (empty($data['id'])) {
                    $this->form_validation->set_rules('c_email', 'Email', 'trim|required|xss_clean', array('required' => 'Email is required.'));
                } else {
                    $this->form_validation->set_rules('c_email', 'Email', 'trim|required|xss_clean');
                }
                $this->form_validation->set_rules('c_home_phn', 'Home Phone', 'trim|required|xss_clean');
                $this->form_validation->set_rules('c_work_phn', 'Work Phone', 'trim|required|xss_clean');
                $this->form_validation->set_rules('p_fname', 'Primary First Name', 'trim|required|xss_clean');
                $this->form_validation->set_rules('p_lname', 'Primary Last Name', 'trim|required|xss_clean');
                $this->form_validation->set_rules('p_phn', 'Primary Home Phone', 'trim|required|xss_clean');
                $this->form_validation->set_rules('p_work_phn', 'Primary Work Phone', 'trim|required|xss_clean');
                $this->form_validation->set_rules('p_email', 'Primary Email', 'trim|required|xss_clean');
                $this->form_validation->set_rules('c_address', 'Coverage Address', 'trim|required|xss_clean');
                $this->form_validation->set_rules('c_city', 'Coverage City', 'trim|required|xss_clean');
                $this->form_validation->set_rules('c_state', 'Coverage State', 'trim|required|xss_clean');
                $this->form_validation->set_rules('c_zip', 'Coverage Zip Code', 'trim|required|xss_clean');
                $this->form_validation->set_rules('m_address', 'Mailing Address', 'trim|required|xss_clean');
                $this->form_validation->set_rules('m_city', 'Mailing City', 'trim|required|xss_clean');
                $this->form_validation->set_rules('m_state', 'Mailing State', 'trim|required|xss_clean');
                $this->form_validation->set_rules('m_zip', 'Mailing Zip Code', 'trim|required|xss_clean');
                $this->form_validation->set_rules('b_address', 'Billing Address', 'trim|required|xss_clean');
                $this->form_validation->set_rules('b_city', 'Billing City', 'trim|required|xss_clean');
                $this->form_validation->set_rules('b_state', 'Billing State', 'trim|required|xss_clean');
                $this->form_validation->set_rules('b_zip', 'Billing Zip Code', 'trim|required|xss_clean');
                $this->form_validation->set_rules('b_name_on_card', 'Billing Name On Card', 'trim|required|xss_clean');
                $this->form_validation->set_rules('card_num', 'Card Number', 'trim|required|xss_clean');
                $this->form_validation->set_rules('card_pin', 'CVV', 'trim|required|xss_clean');

                if ($this->form_validation->run($this) == FALSE) {
                    $finalResult = array('msg' => 'error', 'response' => validation_errors());
                    echo json_encode($finalResult);
                    exit;
                } else {
                    if (!$this->checkEmail($data['c_email']) || !$this->checkEmail($data['p_email'])) {
                        $finalResult = array('msg' => 'error', 'response' => 'Email is Invalid');
                        echo json_encode($finalResult);
                        exit;
                    }
                    $total_amount = $this->calculate_plan($data, 2);

                    if (empty($data['c_discount'])) {
                        $discount = 0;
                    } else {
                        $discount = get_setting('discount', $data['c_discount']);
                    }
                    if (strpos($discount, '$') !== false) {
                        $total_discount = str_replace("$","",$discount);
                    }else{
                        $total_discount = $this->calculate_discount($discount, $total_amount);
                    }
                    $plan_total = $this->calculate_plan($data, 1);
                    $client_ip = $this->get_client_ip();
                    $charge_response = '';
                    $c_res = '';

                    if ($data['c_charge'] != 1){
                        $billing_date = date('Y-m-d'); //set as todays date
                    }else{
                        $billing_date = $this->get_bill_date($data);
                    }
				
                    if (!empty($data['id'])) {
                        $renewal_id = $this->customer_model->insert_customer_policy($data, $total_discount, $plan_total, $billing_date);
                        $customer_id = $data['id'];
                    } else {
                        $customer = $this->customer_model->insert_customer($data, $total_discount, $plan_total, $client_ip, $billing_date);
                        $customer_id = $customer['customer_id'];
                        $renewal_id = $customer['renewal_id'];
                    }
                    $customer_card = get_customer_card($customer_id,array('card_num'=> $data['card_num']));
					
                    if (empty($customer_card)){
                        $this->customer_model->insert_card($customer_id, $data);
                    }else{
						$data['card_id'] = $customer_card['id'];
						$this->customer_model->update_payment_info($data);
						$customer_card = get_customer_card($customer_id,array('card_num'=> $data['card_num']));
					}

                    if ($customer_id > 0) {
						if ($data['c_charge'] == 1){
							$rep = $this->session->userdata('admin_id');
							$card_details = get_customer_card($customer_id,array('card_num'=> $data['card_num']));
							$mode = 'ems_model';
							$this->load->model(admin_controller() . $mode);
							$charge_response =  $this->$mode->charge_customer($customer_id, $plan_total, $rep,$card_details,$renewal_id);
							$policydata['details'] = $this->customer_model->get_plan_policy_data($customer_id);
							
							if(execute_arb_profile_from_cron == '0'){
								$profilerror = $this->createCustomerProfile($customer_id, $card_details, $policydata= []);
							}
                       
							if ((isset($charge_response['msg']) && $charge_response['msg'] == 'error' ) || (isset($profilerror['messages']['resultCode']) &&  $profilerror['messages']['resultCode']=="Error")){
								if($charge_response['response']!=""){
									$c_res = $charge_response['response'];
								}elseif(isset($profilerror['messages']['message'][0]['text'])){
									$c_res = $profilerror['messages']['message'][0]['text'];
								}
								
							}else{
								$c_res = '';
							}
							if ($c_res != '' && $c_res != 1){
								
								$finalResult = array('msg' => 'error', 'response' => $c_res,'charge_status' => $c_res,'customer_id' => $customer_id);
								echo json_encode($finalResult);
								exit;
							} 
						}
                        if ($data['coverage'] != '') {
                            $this->customer_model->insert_coverage($customer_id, $renewal_id, explode(',', $data['coverage']));
                        }
                        if (!isset($data['not_mail'])) {
                            $this->send_policy_email($customer_id);
                        }
                        if ($data['c_charge'] == 1) {
                            $customer_details = get_customer_card($customer_id,'',1);
                            if (empty($customer_details)){
                                $details = get_data($customer_id,'customers','',array('id','card_num','card_exp_month','card_exp_year','card_pin','bill_zipcode','bill_cardname'));
                                $customer_details = $details[0];
                            }
                        }
						$finalResult = array('msg' => 'success', 'response' => "Customer successfully inserted.",'charge_status' => $c_res);
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
        }else{
            $finalResult = array('msg' => 'error', 'response' => 'Access denied!');
            echo json_encode($finalResult);
            exit;
        }
    }

	public function createCustomerProfile($customer_id, $card_details, $policydata){
		
		$this->load->model(admin_controller() . 'ems_model');
		$charge_response =  $this->ems_model->createCustomerProfile($customer_id, $card_details, $policydata);
		return 	$charge_response ;
	}

    public function get_bill_date($data)
    {
        $payment_date = date('Y-m-d');
        if (!isset($data['payment_as'])){
            if ($data['c_charge'] == 2){
                $time = strtotime(date('Y-m-d G:i:s'));
                $next_date = date("Y-m-d", strtotime("+1 month", $time));
            }else{
//                $plan_months = $data['c_plan'] * 12;
//                $structure = $plan_months/$data['c_payment'];
//                $time = strtotime(date('Y-m-d G:i:s'));
//                $start_plan = date("Y-m-d G:i:s", strtotime("+1 month", $time));
//                for ($i=0; $i<$data['c_payment']; $i++){
//                    $v = $i+1;
//                    $structure_months = $structure*$v;
//                    $next_date = date('Y-m-d', strtotime('+'.$structure_months.' month', strtotime($start_plan)));
//                    $current_date = date('Y-m-d');
//                    if ($next_date > $current_date){
//                        break;
//                    }
//                }
                $time = strtotime(date('Y-m-d G:i:s'));
                $next_date= date('Y-m-d', strtotime('+1 month', $time));
            }
            $payment_date = $next_date;
        }else{
            if ($data['c_charge'] == 2){
                $time = strtotime(date('Y-m-d G:i:s'));
                $payment_date = date('Y-m-d', strtotime('+1 month', $time));
            }else{
                $time = strtotime(date('Y-m-d G:i:s'));
                $payment_date = date('Y-m-d', strtotime('+1 month', $time));
            }
        }
        return $payment_date;
    }
	
	public function charge_payment()
    {
        if ($_POST) {
            $data = $this->input->post();

            $this->form_validation->set_rules('amount_to_charge', 'Amount', 'trim|required|xss_clean');

            if ($this->form_validation->run($this) == FALSE) {
                $finalResult = array('msg' => 'error', 'response' => validation_errors());
                echo json_encode($finalResult);
                exit;
            } else {
				$rep = $this->session->userdata('admin_id');
				$customer_id = $data['customer_id'];
				$card_details =  get_customer_card($customer_id,'',1);
				
				
				$mode = 'ems_model';
				$this->load->model(admin_controller() . $mode);
				$finalResult =  $this->$mode->charge_customer($customer_id, $data['amount_to_charge'], $rep,$card_details);
				echo json_encode($finalResult);
                exit;
            }
        } else {
            show_admin404();
        }
    }

	public function save_payment($customer ,$customer_details , $response, $rep, $amount,$paymentmethod)
    {
        $this->customer_model->insert_payment($customer ,$customer_details ,$response, $rep, $amount,$paymentmethod);
    }

    public function update_card_status()
    {
        if($_POST){
            $data = $this->input->post();
            $card_status = $this->customer_model->update_card_status($data);
            if($card_status > 0){
                $finalResult = array('msg' => 'success', 'response'=>"Card successfully updated.");
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

    public function send_policy_email($customer)
    {
        $data['details'] = $this->customer_model->get_plan_policy_data($customer);
        $data['latest_policy'] = get_customer_policy($data['details']['policy_num']);
        $data['plan_value'] = get_plan_name('plan', $data['latest_policy']['plan'])['meta_content'];
        $scf_value = get_plan_name('scf', $data['latest_policy']['scf']);
        $selected = array();
        $other_coverage = '';
        $other_coverage_arr = [];
        foreach (get_coverage($data['details']['id'], $data['latest_policy']['id']) as $cov_id) {
            $selected[] = get_setting('opt_coverage', $cov_id['coverage'], 1)[0]['meta_content'];

            if($cov_id['coverage']=='25' && $cov_id['comments']!=''){
                $other_coverage_arr = explode(',',$cov_id['comments']);
            }

        }

        if(isset($other_coverage_arr) && count($other_coverage_arr) > 0){
            $other_coverage= implode($other_coverage_arr,', ');
        }

        $data['extra_coverage'] = implode($selected,', ');
        $data['extra_coverage'] = str_replace('Other',$other_coverage, $data['extra_coverage']);

        $data['c_email'] = $data['details']['email'];
        if (empty($data['latest_policy']['pdf_randomid'])){
            $data['latest_policy']['pdf_randomid'] = strtoupper(md5(mt_rand(1000000, 9888888)));
            $this->customer_model->update_policy_number($data['latest_policy']);
        }
        $data['policy_url'] = base_url().'policy_pdf/get/'.$data['latest_policy']['pdf_randomid'];
        $data['scf_value'] = '$'.number_format((float)$scf_value['meta_value'], 2, '.', '');

        $this->send_confirmation_email($data, 'new_policy','Your Home Warranty Policy');
    }

    public function edit($id='',$claim='', $tab='')
    {
        if(!empty($id)){
            $details = $this->customer_model->get_plan_policy_data($id);
            if (!empty($details)){
                if (empty($claim) || $claim == 0){
                    if (empty($tab)){
                        $data['details'] = $details;
                        $data['claim_id'] = 'unknown';
                        $data['bottom_tab'] = 'unknown';
                        $this->load->view('customers/edit_customer', $data);
                    }else{
                        $data['details'] = $details;
                        $data['claim_id'] = 'unknown';
                        $data['bottom_tab'] = $tab;
                        $this->load->view('customers/edit_customer', $data);
                    }
                }else{
                    $check['check_claim'] = $this->claim_model->claim_detail($claim, $details['id']);
                    if(!empty($check['check_claim'])) {
                        if (empty($tab)){
                            $data['details'] = $details;
                            $data['claim_id'] = $claim;
                            $data['bottom_tab'] = 'tab-3';
                            $this->load->view('customers/edit_customer', $data);
                        }else{
                            $data['details'] = $details;
                            $data['claim_id'] = $claim;
                            $data['bottom_tab'] = $tab;
                            $this->load->view('customers/edit_customer', $data);
                        }

                    } else {
                        show_admin404();
                    }
                }
            }else{
                show_admin404();
            }
        }else{
            show_admin404();
        }
    }
	
    public function update()
    {
        if($_POST){
            $data = $_POST;

            $this->form_validation->set_rules('c_fname', 'First Name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('c_lname', 'Last Name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('c_email', 'Email', 'trim|required|xss_clean');
            $this->form_validation->set_rules('c_home_phn', 'Home Phone', 'trim|required|xss_clean');
            $this->form_validation->set_rules('c_work_phn', 'Work Phone', 'trim|required|xss_clean');
            $this->form_validation->set_rules('p_fname', 'Primary First Name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('p_lname', 'Primary Last Name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('p_phn', 'Primary Home Phone', 'trim|required|xss_clean');
            $this->form_validation->set_rules('p_work_phn', 'Primary Work Phone', 'trim|required|xss_clean');
            $this->form_validation->set_rules('p_email', 'Primary Email', 'trim|required|xss_clean');
            $this->form_validation->set_rules('c_address', 'Coverage Address', 'trim|required|xss_clean');
            $this->form_validation->set_rules('c_city', 'Coverage City', 'trim|required|xss_clean');
            $this->form_validation->set_rules('c_state', 'Coverage State', 'trim|required|xss_clean');
            $this->form_validation->set_rules('c_zip', 'Coverage Zip Code', 'trim|required|xss_clean');
            $this->form_validation->set_rules('m_address', 'Mailing Address', 'trim|required|xss_clean');
            $this->form_validation->set_rules('m_city', 'Mailing City', 'trim|required|xss_clean');
            $this->form_validation->set_rules('m_state', 'Mailing State', 'trim|required|xss_clean');
            $this->form_validation->set_rules('m_zip', 'Mailing Zip Code', 'trim|required|xss_clean');
            $this->form_validation->set_rules('b_address', 'Billing Address', 'trim|required|xss_clean');
            $this->form_validation->set_rules('b_city', 'Billing City', 'trim|required|xss_clean');
            $this->form_validation->set_rules('b_state', 'Billing State', 'trim|required|xss_clean');
            $this->form_validation->set_rules('b_zip', 'Billing Zip Code', 'trim|required|xss_clean');
            $this->form_validation->set_rules('b_name_on_card', 'Billing Name On Card', 'trim|required|xss_clean');

            if ($this->form_validation->run($this) == FALSE)
            {
                $finalResult = array('msg' => 'error', 'response'=>validation_errors());
                echo json_encode($finalResult);
                exit;
            }else{

                if (!$this->checkEmail($data['c_email']) || !$this->checkEmail($data['p_email']))
                {
                    $finalResult = array('msg' => 'error', 'response'=>'Email is Invalid');
                    echo json_encode($finalResult);
                    exit;
                }

                $customer_status = $this->customer_model->update_customer($data);
                if($customer_status > 0){
                    if (get_session('admin_type') == 1 || (get_session('admin_type') == 2 && get_session('admin_permissions')['miscellaneous'] != 'N/A' && isset(get_session('admin_permissions')['miscellaneous']->add_coverage))) {
                        $this->customer_model->delete_coverage($data['id'], $data['policy_id']);
                        if ($data['coverage'] != '') {
                           $this->customer_model->insert_coverage($data['id'], $data['policy_id'], explode(',', $data['coverage']),$data['other_coverage']);
                        }
                    }
                    $finalResult = array('msg' => 'success', 'response'=>"Customer successfully updated.");
					save_log_note($data['id'], 'Customer updated from edit customer page!!');
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
    }

    public function checkEmail($email) {
        $find1 = strpos($email, '@');
        $find2 = strpos($email, '.');
        return ($find1 !== false && $find2 !== false);
    }

    public function search_customer()
    {
        $data['param'] = $this->input->get();
        if (!empty($data)){
            if(!array_filter($data['param'])) {
                $data['customers'] = $this->customer_model->get_customers();
            }else{
                $data['customers'] = $this->customer_model->search_customer($data['param']);
            }
            $this->load->view('customers/customers', $data);
        }else{
            show_admin404();
        }
    }


    public function delete_customer()
    {
        if($_POST){
            $customer = $_POST['customer'];
            $claims = get_data('','claims',array('customer'=>$customer),'id');

            $this->customer_model->delete_tasks($customer);
            $status = $this->customer_model->delete_claims($customer, $claims);
            if($status > 0){
                $this->customer_model->delete_customer($customer);
				$payment_profile= $this->customer_model->get_customer_payment_profile($customer);##get payment profile_id 
				$authorize = $this->subscriptionSetting();
				$login_id = (isset($authorize['merchant_id'])) ? $authorize['merchant_id'] : '';
				$merchant_transaction_key = (isset($authorize['merchant_security'])) ? $authorize['merchant_security'] : '';
				$endpoint = $authorize['endpoint'];
				$subscription = '{
						"ARBCancelSubscriptionRequest": {
							"merchantAuthentication": {
								"name": "'.$login_id.'",
								"transactionKey": "'.$merchant_transaction_key.'"
							},
							"refId": "123456",
							"subscriptionId": "'.$payment_profile[0]['subscription_id'].'"
						}
					}';
				$response = $this->curlRequest($endpoint,$subscription);
				
				if($response['messages']['message'][0]['code'] = 'I00002' ||$response['messages']['message'][0]['resultCode'] == 'Ok'){
					$cancel = 'Ok';
				}
                $finalResult = array('msg' => 'success', 'response'=>"Customer successfully deleted.");
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
    }

    public function get_images() {

        if ($_POST) {
            $customer_claim = $this->input->post('customer_claim');
            $claim_id = $this->input->post('claim_id');
            if (!empty($customer_claim)){

                $images['images'] = $this->common_model->get_data('','claim_files',array('customer'=>$customer_claim,'claim_id'=> $claim_id));

                $htmlrespon = $this->load->view('customers/load_claim_files' , $images,TRUE);

                $finalResult = array('msg' => 'success', 'response'=>$htmlrespon);
                echo json_encode($finalResult);
                exit;
            } else {
                $finalResult = array('msg' => 'error', 'response'=>'Something went wrong!');
                echo json_encode($finalResult);
                exit;
            }
        } else {
            $finalResult = array('msg' => 'error', 'response'=>'Something went wrong!');
            echo json_encode($finalResult);
            exit;
        }
    }

    public function claim_files() {

        if ($_POST) {
            $data = $this->input->post();
            $this->form_validation->set_rules('image_alt', 'Image Alt', 'trim|required|xss_clean');
            if ($this->form_validation->run() == FALSE) {
                $finalResult = array('msg' => 'error', 'response'=>validation_errors());
                echo json_encode($finalResult);
                exit;
            } else {

                if (!empty($_FILES['image']['name'])) {


                    $main = $this->upload_image(FCPATH . 'assets/claim_files', 'image');

                    if ($main['msg'] == 'success') {
                        $data['image'] = $main['response'];

                    } else {
                        $finalResult = array('msg' => 'error', 'response' => $main['response']);
                        echo json_encode($finalResult);
                        exit;
                    }
                }

                // insert records to old post table
                $image_id = $this->customer_model->insert_image($data);
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

    public function upload_image($path , $image_type) {
        $config['upload_path'] = $path;
        $config['allowed_types'] = 'jpg|pdf';
        $config['max_size'] = 5000;
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

     public function update_payment_info() {
		 
        if($_POST) {
			$this->form_validation->set_rules('card_num', 'Card Number', 'trim|required');
			$this->form_validation->set_rules('card_pin', 'Card CVV', 'trim|required');
			if ($this->form_validation->run() == FALSE) {
				$finalResult = array('msg' => 'error', 'response'=>validation_errors());
				echo json_encode($finalResult);
				exit;
			} else {
			$mode = 'ems_model';
			$this->load->model(admin_controller() . $mode);
            $data = $_POST;
            $card_details = get_customer_card($data['customer_id'],array('card_num'=>$data['card_num']));
				$customerprofile = $this->customer_model->get_customer_payment_profile($data['customer_id']);
			
				if(!empty($customerprofile) && (isset($data['arb_profile']) && $data['arb_profile'] == 'on')){
			
         
				$policydata['details'] = $this->customer_model->get_plan_policy_data($data['customer_id']);
				$policydata['latest_policy'] = get_customer_policy($policydata['details']['policy_num']);
                $policydata['plan_value'] = get_plan_name('plan', $policydata['latest_policy']['plan'])['meta_content'];
				
          
                    // ADD to ARB
					$arb_response = $this->$mode->updateArbCardDetails($data['customer_id'], $customerprofile, $policydata,$data);// create profile
                    if((isset($arb_response['messages']['resultCode']) && $arb_response['messages']['resultCode']=='Error') || (isset($arb_response['msg']) && $arb_response['msg'] =='error')){
                        if(isset($arb_response['response'])){
                            $message = $arb_response['response'];
                        }else{
                            $message = $arb_response['messages']['message'][0]['text'];
                        }
						save_log_note($data['customer_id'], "Message from payment processor =>". $message);
                        $finalResult = array('msg' => 'error', 'response'=>"Message from payment processor =>".$message);
                        echo json_encode($finalResult);
                        exit;
                    }else{
						$msg = $data['card_num'].' changed to';
						save_log_note($data['customer_id'], "ARB profile updated with new credit card info");
						if (empty($card_details)){
							$billing_details = get_data($data['customer_id'],'customers','',array('bill_zipcode','bill_cardname'));
							$payment_info = $this->customer_model->add_payment_info($data,$billing_details[0]); //card add
						}else{
							$payment_info = $this->customer_model->update_payment_info($data); //card update
                    }
				}

					/* $rep = $this->session->userdata('admin_id');
                $plan_total = $policydata['latest_policy']['plan_total'];
                $arb_response['renewal_id'] = $policydata['details']['policy_num'];
                $this->save_payment($data['customer_id'], $card_details, $arb_response, $rep, $plan_total,'EMS');
                
					 */
					save_log_note($data['customer_id'], "Credit Card updated successfully");
                
                $finalResult = array('msg' => 'success', 'response'=>"Payment Info successfully updated.");
                echo json_encode($finalResult);
                exit;
                
				}else{
					if (empty($card_details)){
						$billing_details = get_data($data['customer_id'],'customers','',array('bill_zipcode','bill_cardname'));
						$payment_info = $this->customer_model->add_payment_info($data,$billing_details[0]); //card add
					}else{
						$payment_info = $this->customer_model->update_payment_info($data); //card update
					}
					save_log_note($data['customer_id'], "Credit Card updated successfully");
					//print_R($payment_info);
					if($payment_info > 0){
						$finalResult = array('msg' => 'success', 'response'=>"Payment Info successfully updated.");
						echo json_encode($finalResult);
						exit;
            } else {
                $finalResult = array('msg' => 'error', 'response'=>"Something went wrong please try again.");
                echo json_encode($finalResult);
                exit;
            }

				}
			}
        } else {
            show_admin404();
        }
    }

    public function calculate_plan($data, $cal_discount)
    {
        $property = get_setting('property_type',$data['c_p_type']);
        $size = get_setting('property_size',$data['c_size']);
        $splits = $data['c_payment'];
        $years = $data['c_plan'];
        $years_month = $years * 1;
        $months = $data['c_month'];
//        if ($months != ''){
//            $total_months = $years_month + ($months / 12);
//        }else{
        $total_months = $years_month;
//        }
        $optional_coverage = 0;
        if(!empty($data['coverage'])){
            $coverages = explode(',',$data['coverage']);
            foreach ($coverages as $coverage){
                $coverage_amount =get_setting('opt_coverage',$coverage);
                $coverage_total = $coverage_amount * $total_months;
                $optional_coverage = $optional_coverage+$coverage_total;
            }
        }
        $plan = get_setting('plan',$data['c_plan_type']);
        $year = $data['c_plan'];
        if (empty($data['c_discount'])) {
            $discount=0;
        }else{
            $discount = get_setting('discount', $data['c_discount']);
        }
        $m_charge = $data['m_charge'];
        $sign = '';
        if (strpos($m_charge, '-') !== false) {
            $sign = '-';
        }
        preg_match_all('!\d+!', $m_charge, $matches);
        if (!empty($matches[0])){
            $m_charge=implode('.',$matches[0]);
        }else{
            $m_charge=0;
        }
        $m_charge = $sign.$m_charge;
        $plan_total = $plan * $year;
        $total = $property + $size + $optional_coverage + $plan_total + $m_charge;
        if ($cal_discount==1){
            if (strpos($discount, '$') !== false) {
                $total_discount = str_replace("$","",$discount);
                $after_discount = $total - $total_discount;
            }else{
                $after_discount = $total - $this->calculate_discount($discount, $total);
            }
            if (isset($data['payment_as'])){
                $after_split = $after_discount/($year * 12);
            }else{
                $after_split = $after_discount/$splits;
            }
            return round($after_split, 2);

        }else {
            return $total;
        }
    }

    public function calculate_discount($discount, $total)
    {
        $total_discount = $total/100*$discount;
        return round($total_discount, 2);
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
    public function insert_policy_log() {
        $user_id=$this->session->userdata('admin_id');
        $this->customer_model->insert_policy_log($_POST['customer_id'],$user_id);
        exit();
    }
    public function delete_claim_files() {
        if($_POST) {
            $id = $_POST['id'];
            $status = $this->customer_model->delete_claim_files($id);
            if($status > 0) {
                $finalResult = array('msg' => 'success', 'response'=>"File successfully deleted.");
                echo json_encode($finalResult);
                exit;
            } else {
                $finalResult = array('msg' => 'error', 'response'=>"Something went wrong please try again.");
                echo json_encode($finalResult);
                exit;
            }
        } else {
            show_admin404();
        }
    }

    public function send_confirmation_email($data, $template, $subject)
    {

        $email_body = $this->load->view('common/emails/'.$template , $data,TRUE);
        $tomail = $data['c_email'];
        $this->load->library('email');
        $this->email->set_newline("\r\n");

        $this->email->from(support_email(), 'Complete Care Home Warranty');
        $this->email->to($tomail);

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
    }

    public function update_bill_date()
    {
        if($_POST) {
            $data = $_POST;
			$this->form_validation->set_rules('charge_payment', 'charge payment', 'trim|required|xss_clean');
			$this->form_validation->set_rules('amount_to_charge', 'occurrences', 'trim|required|xss_clean');
			if (isset($data['bill_date']) && $data['bill_date']!=""  ){
				$date = explode('-', $data['bill_date']);
				/* if( checkdate($date[2], $date[1], $date[0])){
					

				}else{
					$finalResult = array('msg' => 'error', 'response'=>"The Date field must be valid mm/dd/yyyy");
					echo json_encode($finalResult);
					exit;
				} */
			}else{
				$this->form_validation->set_rules('bill_date', 'bill date', 'trim|required|xss_clean');
				$this->form_validation->set_message('bill_date', 'The Date field must be mm/dd/yyyy');
			}
			if ($this->form_validation->run($this) == FALSE) {
				$finalResult = array('msg' => 'error', 'response' => validation_errors());
				echo json_encode($finalResult);
				exit;
			} else {
				$status = $this->customer_model->update_payment_details($data);
				$card_details = get_customer_card($data['customer_id'],'','1');
				$policydata['details'] = $this->customer_model->get_plan_policy_data($data['customer_id']);
				$policydata['latest_policy'] = get_customer_policy($policydata['details']['policy_num']);
				$policydata['plan_value'] = get_plan_name('plan', $policydata['latest_policy']['plan'])['meta_content'];
				$mode = 'ems_model';
				$this->load->model(admin_controller() . $mode);
				$arb_response = $this->$mode->charge_customerEMS($data['customer_id'], $card_details, $policydata,$data);// create profile
				
				if(isset($arb_response['message']['resultCode']) && $arb_response['message']['resultCode']=='Error'){
					$message = $arb_response['messages']['message'][0]['text'];
					$finalResult = array('msg' => 'error', 'response'=>"Message from payment processor =>".$message);
					echo json_encode($finalResult);
					exit;
				}else if(isset($arb_response['msg']) && $arb_response['msg']=='error'){
					$message = $arb_response['response'];
					$finalResult = array('msg' => 'error', 'response'=>"Message from payment processor =>".$message);
					echo json_encode($finalResult);
					exit;
				}else{
					$rep = $this->session->userdata('admin_id');	
					$plan_total = $policydata['latest_policy']['plan_total'];
					$mode = get_setting('configuration','paymentprocessor');
					//$this->save_payment($data['customer_id'], $card_details, $arb_response, $rep, $plan_total,$mode);
					if($status > 0) {
                        save_log_note($data['customer_id'], "ARB Profiles and subscriptions created");
						$finalResult = array('msg' => 'success', 'response'=>"Successfully updated.");
						echo json_encode($finalResult);
						exit;
					} else {
						$finalResult = array('msg' => 'error', 'response'=>"Something went wrong please try again.");
						echo json_encode($finalResult);
						exit;
					}
				}
			}
        } else {
            show_admin404();
        }
    }


    public function cancelSubscription() {
        if($_POST) {
			$data = $_POST;
			$mode = 'ems_model';
			$this->load->model(admin_controller() . $mode);
			$customer = $data['customer'];
			$subscription_id = $data['id'];
            $status = $this->$mode->cancelARBSubscription($subscription_id);

            if($status['messages']['resultCode'] != 'Error') {
                $this->customer_model->cancelARBSubscription($customer);
               
                //Add note for customer profile
                $this->load->model(admin_controller() . 'task_model');
                $this->task_model->insert_notes([
                    'customer' => $customer,
                    'text' => '<p>Subscription Cancelled</p>',
                    'type' => '3',
                    'assign_to' => 0

                ]);


                $finalResult = array('msg' => 'success', 'response'=>"Subscription Cancelled Successfully.");
                echo json_encode($finalResult);
                exit;
            } else {
                $finalResult = array('msg' => 'error', 'response'=>$status['messages']['message'][0]['text']);
                echo json_encode($finalResult);
                exit;
            }
        } else {
            show_admin404();
        }
    }
	
	public function update_password()
    {
        $data = $_POST;
        $this->form_validation->set_rules('new_password', 'New Password', 'trim|required|xss_clean|callback_check_new_password');
        $this->form_validation->set_rules('c_password', 'Confirm Password', 'trim|required|matches[new_password]|xss_clean');
        if ($this->form_validation->run($this) == false)
        {
            $finalResult = array(
                'msg' => 'error',
                'response' => validation_errors()
            );
            echo json_encode($finalResult);
            exit;
        }
        else
        {
            $status = $this->customer_model->change_admin_password($data);
            if ($status)
            {
                $finalResult = array(
                    'msg' => 'success',
                    'response' => 'Your password successfully changed!'
                );
				save_log_note($data['customer_id'], "Password was changed by admin");
                echo json_encode($finalResult);
                exit;
            }
            else
            {
                $finalResult = array(
                    'msg' => 'error',
                    'response' => 'Something went wrong!'
                );
                echo json_encode($finalResult);
                exit;
            }
        }
    }
	
	 public function check_new_password()
    {
        $data = $_POST;
        $status = $this->customer_model->check_new_password($data);
        if ($status > 0)
        {
            $this->form_validation->set_message('check_new_password', 'Your new password must be different.');
            return false;
        }
        else
        {
            return true;
        }
    }
}