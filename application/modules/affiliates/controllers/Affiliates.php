<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Affiliates extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('common/common_model');
		$this->load->model('affiliates/affiliates_model');
	}

	public function index()
	{
		$this->load->view('affiliates');
	}

	public function add_affiliate()
	{
		if($_POST){
			$data = $this->input->post();
			$this->form_validation->set_rules('first_name', 'First Name', 'trim|required|xss_clean');
			$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|xss_clean');
			$this->form_validation->set_rules('company', 'Company Name', 'trim|required|xss_clean');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean|is_unique[affiliaters.email]', array('required' => 'The Email field is required.', 'is_unique' => 'Email already associated with another account.'));
			$this->form_validation->set_rules('phone', 'Phone Number', 'trim|required|xss_clean');
			$this->form_validation->set_rules('fax', 'Fax Number', 'trim|required|xss_clean');
			$this->form_validation->set_rules('address', 'Address', 'trim|required|xss_clean');
			$this->form_validation->set_rules('city', 'City', 'trim|required|xss_clean');
			$this->form_validation->set_rules('state', 'State', 'trim|required|xss_clean');
			$this->form_validation->set_rules('zip_code', 'Zip Code', 'trim|required|xss_clean');

			if ($this->form_validation->run($this) == FALSE)
			{
				$finalResult = array('msg' => 'error', 'response'=>validation_errors());
				echo json_encode($finalResult);
				exit;
			}else {
				$status = $this->affiliates_model->add_affiliates($data);
				if ($status > 0) {
					$this->send_notification_to_affiliator($data);
					$this->send_notification_to_affiliator_admin($data);

					$finalResult = array('msg' => 'success', 'response' => "Your information has been received, We'll contact you shortly.");
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

	public function send_notification_to_affiliator($data)
	{
		$email_body = $this->load->view('common/emails/send_email_to_affiliator_notification', $data,TRUE);
		$tomail = $data['email'];
		$subject = 'Affiliate Program';
		$body = $email_body;
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		$headers .= 'From: <'.support_email().'>' . "\r\n";
		@mail($tomail,$subject,$body,$headers);
		return true;
	}

	public function send_notification_to_affiliator_admin($data)
	{
		$email_body = $this->load->view('common/emails/send_affiliate_email_to_admin_notification', $data,TRUE);
		$tomail = admin_email();
		$subject = 'Affiliate Program';
		$body = $email_body;
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		$headers .= 'From: <'.$data['email'].'>' . "\r\n";
		@mail($tomail,$subject,$body,$headers);
		return true;
	}
}
