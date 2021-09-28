<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forgot_password extends CI_Controller {

	function __construct()
	{
		parent::__construct();		
		if($this->session->userdata('admin_logged_in'))
		{
			 redirect(base_url() . 'customers/');
		}
		$this->load->model('customers/login_model');
        
	}
	public function index()
	{
		$this->load->view('customers/forgot_password');
	}
	public function retrieve_password()
	{
		if($_POST) {
			$data = $_POST;
			$this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|callback_email_exist');

			if ($this->form_validation->run($this) == FALSE)
			{
				$finalResult = array('msg' => 'error', 'response'=>validation_errors());
				echo json_encode($finalResult);
				exit;
			}else{
				$this->load->helper('string');
				$data['password'] = random_string('alnum',8);
				$status = $this->login_model->set_admin_password($data['email'] , $data['password']);
				if($status){
					$data['admin_details'] = $this->login_model->get_details($data['email']);
					$htmlresponse = $this->load->view('customers/recover_pass_email', $data, TRUE);
					
					$this->send_confirmation_email( $data['email'] , $htmlresponse);    
					$finalResult = array('msg' => 'success', 'response'=>'Password updated please check your email inbox!');
					echo json_encode($finalResult);
					exit;
				} else {
					$finalResult = array('msg' => 'error', 'response'=>'Something went wrong !');
					echo json_encode($finalResult);
					exit;
				}
			}
		} else {
			show_admin404();
		}
	}
	public function email_exist($email)
	{
		
		$email = $this->login_model->check_email($email);
		if ($email > 0)
		{
			return TRUE;
		}
		else
		{
			$this->form_validation->set_message('email_exist', 'This email does not exist.');
			return FALSE;
		}
	}

	public function send_confirmation_email($user_email , $email_body)
	{
        $subject = 'Regal Home Warranty Forgot Password';

        /* $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_user' => 'Info@completecarehomewarranty.com',
            'smtp_pass' => 'Dcemmeeaj9',
            'mailtype'  => 'html',
            'charset'   => 'utf-8'
        ); */
        $this->load->library('email');
        $this->email->set_newline("\r\n");

        $this->email->from(admin_email(), 'Complete Care Home Warranty');
        $this->email->to($user_email);

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

//        $to = $user_email;
//        $subject = 'Regal Home Warranty Forgot Password';
//        $body = $email_body;
//        // Always set content-type when sending HTML email
//        $headers = "MIME-Version: 1.0" . "\r\n";
//        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
//
//        // More headers
//        $headers .= 'From: <'.admin_email().'>' . "\r\n";
//        @mail($to,$subject,$body,$headers);
	}
}
