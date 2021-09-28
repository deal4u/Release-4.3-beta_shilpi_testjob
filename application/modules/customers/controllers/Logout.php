<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends CI_Controller {

	function __construct()
	{
		parent::__construct();	
		 $this->load->library(admin_controller().'login_lib');
		  $this->load->model(admin_controller().'login_model');
	}
	public function index()
	{
		$user_data = $this->session->all_userdata();
		$data['email'] = $user_data['email'];
		$data['ip'] = $this->input->ip_address();
		$data['type'] = "logout"; 
		foreach ($user_data as $key => $value) {
			$this->session->unset_userdata($key);
		}

		$this->send_email_on_login($data);
		redirect(base_url().'customers/login');
	}

	public function send_email_on_login($data)
    {
		$subject = "Logout event recorded";
        
        $email_body = $this->load->view('common/emails/logout_event' , $data,TRUE);
        // die;
        $this->load->library('email');
        $this->email->set_newline("\r\n");

        $this->email->from(support_email(), 'Complete Care Home Warranty');
        $this->email->to(support_email());

        $this->email->subject($subject);
        $this->email->message($email_body);

        if($this->email->send())
        {
			$this->trackLogin($data);
            return true;
			
        }
        else
        {
            show_error($this->email->print_debugger());
        }
    }
	
	public function trackLogin($data){
		
		$dataArray = array(
			'email' => $data['email'],
			'ip' 	=> $data['ip'],
			'type' 	=> $data['type'],
			'login_type' 	=> 'customer',
		);
		
		 $this->login_model->insert_activity($dataArray );
		
		
	}


}