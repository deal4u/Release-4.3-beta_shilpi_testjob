<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contactus extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('common/common_model');
	}

	public function index()
	{
		$this->load->view('contactus');
	}

	public function contact_us()
	{
		if($_POST){
			$data = $this->input->post();
			$this->form_validation->set_rules('full_name', 'Full Name', 'trim|required|xss_clean');
			$this->form_validation->set_rules('company', 'Company', 'trim|required|xss_clean');
			$this->form_validation->set_rules('phone_no', 'Phone Number', 'trim|required|xss_clean');
			$this->form_validation->set_rules('email_address', 'Email Address', 'trim|required|xss_clean');
			$this->form_validation->set_rules('home_address', 'Street Address', 'trim|required|xss_clean');
			$this->form_validation->set_rules('home_city', 'City', 'trim|required|xss_clean');
			$this->form_validation->set_rules('home_state', 'State', 'trim|required|xss_clean');
			$this->form_validation->set_rules('home_zip', 'Zip Code', 'trim|required|xss_clean');
			$this->form_validation->set_rules('comment', 'Comments', 'trim|required|xss_clean');
			if ($this->form_validation->run($this) == FALSE)
			{
				$finalResult = array('msg' => 'error', 'response'=>validation_errors());
				echo json_encode($finalResult);
				exit;
			}else{
				if (!$this->checkEmail($data['email_address']))
                    		{
                        		$finalResult = array('msg' => 'error', 'response'=>'Email is Invalid');
			            	echo json_encode($finalResult);
				        exit;
                    		}
				$email_body = $this->load->view('common/emails/contactus_email', $data, TRUE);
				$subject = 'Contact Us Inquiry Mail';
				// $tomail = admin_email();
				$tomail = 'leads@regalhomewarranty.com';
				$body = $email_body;
				$headers = "MIME-Version: 1.0" . "\r\n";
				$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
				$headers .= 'From: <'.$data['email_address'].'>' . "\r\n";
				$result = @mail($tomail,$subject,$body,$headers);

				if($result){
                    $finalResult = array('msg' => 'success', 'response'=>"Thank you, your enquiry has been sent successfully.");
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
	
	public function checkEmail($email) {
        	$find1 = strpos($email, '@');
        	$find2 = strpos($email, '.');
        	return ($find1 !== false && $find2 !== false && $find2 > $find1);
    	}


}
