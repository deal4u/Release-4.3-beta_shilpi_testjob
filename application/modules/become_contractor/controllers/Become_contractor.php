<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Become_contractor extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('common/common_model');
		$this->load->model('become_contractor/become_contractor_model');
	}

	public function index()
	{
		$this->load->view('become_contractor');
	}

	public function add_contractor()
	{
		if($_POST){
			$data = $this->input->post();
			$this->form_validation->set_rules('company', 'Company Name', 'trim|required|xss_clean');
			$this->form_validation->set_rules('name', 'Contact Name', 'trim|required|xss_clean');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|is_unique[vendors.email]', array('required' => 'Email is required.', 'is_unique' => 'Email already associated with another account.'));
			$this->form_validation->set_rules('phone', 'Phone', 'trim|required|xss_clean');
			$this->form_validation->set_rules('fax', 'Fax', 'trim|required|xss_clean');
			$this->form_validation->set_rules('address', 'Address', 'trim|required|xss_clean');
			$this->form_validation->set_rules('city', 'City', 'trim|required|xss_clean');
			$this->form_validation->set_rules('state', 'State', 'trim|required|xss_clean');
			$this->form_validation->set_rules('zip_code', 'Zip Code', 'trim|required|xss_clean');

			if ($this->form_validation->run($this) == FALSE)
			{
				$finalResult = array('msg' => 'error', 'response'=>validation_errors());
				echo json_encode($finalResult);
				exit;
			}else{
			if (!$this->checkEmail($data['email']))
                    		{
                        		$finalResult = array('msg' => 'error', 'response'=>'Email is Invalid');
			            	echo json_encode($finalResult);
				        exit;
                    		}

				if(empty($data["zip_codes_serviced"])) {
					$finalResult = array('msg' => 'error', 'response'=>'<p>The Zip Codes Serviced field is required.</p>');
					echo json_encode($finalResult);
					exit;
				}

				$vendor_status = $this->become_contractor_model->add_contractors($data);
				if ($vendor_status > 0) {
					$this->send_notification_to_contractor_email($data);
					$this->send_notification_to_admin_email($data);

					$finalResult = array('msg' => 'success', 'response' => "Your information has been received to Contractor Relations Representative, We'll contact you shortly.");
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
        	return ($find1 !== false && $find2 !== false && $find2 > $find1);
    	}

	public function send_notification_to_contractor_email($data)
	{
		$email_body = $this->load->view('common/emails/send_email_to_contractor_notification', $data,TRUE);
		$tomail = $data['email'];
		$subject = 'Become a Service Provider';
		$body = $email_body;
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		$headers .= 'From: <'.support_email().'>' . "\r\n";
		@mail($tomail,$subject,$body,$headers);
		return true;
	}

	public function send_notification_to_admin_email($data)
	{
		$email_body = $this->load->view('common/emails/send_email_to_admin_notification', $data,TRUE);
		$tomail = admin_email();
		$subject = 'Become a Service Provider';
		$body = $email_body;
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		$headers .= 'From: <'.$data['email'].'>' . "\r\n";
		@mail($tomail,$subject,$body,$headers);
		return true;
	}

}
