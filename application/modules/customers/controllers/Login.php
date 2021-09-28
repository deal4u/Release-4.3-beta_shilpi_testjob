<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->library('customers/login_lib');
        $this->load->model('customers/login_model');
        if($this->session->userdata('admin_logged_in'))
        {
            redirect(base_url().'customers/');
        }

    }
    public function index()
    {
        $this->load->view('login');
    }
    public function login_verify()
    {
		
        $data = [];
        if($_POST){
            $email=trim($this->input->post('email'));
            $password=trim($this->input->post('password'));
            $data['email'] = $email;
            $data['ip'] = $this->input->ip_address();

            if($this->login_lib->validate_login($email, $password))
            {
                $data['type'] = "valid"; 
                $this->send_email_on_login($data);
                //Send email to site admin
                 redirect(base_url().'customers/');
            }
            else
            {
                $data['type'] = "invalid"; 
                $this->send_email_on_login($data);
                $this->session->set_flashdata('email',$this->input->post('email'));
                $this->session->set_flashdata('login_error','Incorrect Email/Password or Combination');
                redirect(base_url().'customers/login');
            }
        }else{
            $data['type'] = "invalid"; 
			$this->send_email_on_login($data);
            $this->session->set_flashdata('email','');
            $this->session->set_flashdata('login_error','Incorrect Email/Password or Combination');
            redirect(base_url().'customers/login');
        }

    }

    public function send_email_on_login($data)
    {
        // print_r($data);
        if($data['type'] == "valid" ){
            $subject = "New successfull login attempt recorded";
        }
        else if($data['type'] == "invalid"){
            $subject = "Invalid login attempt recorded";
        }

        $email_body = $this->load->view('common/emails/login_event' , $data,TRUE);
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