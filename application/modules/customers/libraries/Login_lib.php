<?php 
class Login_lib {

	function __construct()
	{		
		$this->ci =& get_instance();
		$this->ci->load->model($this->ci->config->item('customer_controller').'login_model');
	}
	public function validate_login($email,$password)
	{	
		$result=$this->ci->login_model->get_login($email,$password);
		
        if(!empty($result) && count($result)>0)
		{
			$array=array(
				'id'=>$result["id"],
				'first_name'=>$result["first_name"],
				'admin_username'=>$result["first_name"].' '.$result["last_name"],
				'email'=>$result["email"],
				'admin_type'=>'2',
				'admin_login'=>true,
				'admin_type'=>'customer',
				'admin_logged_in'=>true
			);
			
			$this->ci->session->set_userdata($array);
			return true;
		}else {
			return false;			
		}
	}
	
}

