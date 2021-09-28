<?php 
class Login_lib {

	function __construct()
	{		
		$this->ci =& get_instance();
		$this->ci->load->model($this->ci->config->item('admin_controller').'login_model');
	}
	public function validate_login($email,$password)
	{	
		$result=$this->ci->login_model->get_login($email,$password);
        if(!empty($result) && count($result)>0)
		{
		    $permissions = array();
            $permissions['dashboard'] = get_admin_permissions($result['id'], 'dashboard');
            if (empty($permissions['dashboard'])) {
                $permissions['dashboard'] = 'N/A';
            }
            $permissions['claims'] = get_admin_permissions($result['id'], 'claims');
            if (empty($permissions['claims'])) {
                $permissions['claims'] = 'N/A';
            }
            $permissions['vendors'] = get_admin_permissions($result['id'], 'vendors');
            if (empty($permissions['vendors'])) {
                $permissions['vendors'] = 'N/A';
            }
            $permissions['invoice'] = get_admin_permissions($result['id'], 'invoice');
            if (empty($permissions['invoice'])) {
                $permissions['invoice'] = 'N/A';
            }
            $permissions['scoreboard'] = get_admin_permissions($result['id'], 'scoreboard');
            if (empty($permissions['scoreboard'])) {
                $permissions['scoreboard'] = 'N/A';
            }
            $permissions['admin_access'] = get_admin_permissions($result['id'], 'admin');
            if (empty($permissions['admin_access'])) {
                $permissions['admin_access'] = 'N/A';
            }
            $permissions['payment'] = get_admin_permissions($result['id'], 'payment');
            if (empty($permissions['payment'])) {
                $permissions['payment'] = 'N/A';
            }
            $permissions['reporting'] = get_admin_permissions($result['id'], 'reporting');
            if (empty($permissions['reporting'])) {
                $permissions['reporting'] = 'N/A';
            }
            $permissions['leadsource'] = get_admin_permissions($result['id'], 'leadsource');
            if (empty($permissions['leadsource'])) {
                $permissions['leadsource'] = 'N/A';
            }
            $other = get_admin_permissions($result['id'], 'other');
            if (!empty($other['miscellaneous'])){
                $permissions['miscellaneous'] = json_decode($other['miscellaneous']);
            }else{
                $permissions['miscellaneous'] = 'N/A';
            }

			$this->ci->login_model->get_starts_policy();
			$array=array(
				'admin_id'=>$result["id"],
				'radmin_id'=>$result["AdminID"],
				'admin_username'=>$result["FirstName"].' '.$result["LastName"],
				'admin_email'=>$result["Email"],
				'admin_type'=>$result["type"],
				'admin_permissions'=>$permissions,
				'admin_login'=>true,
				'admin_logged_in'=>true
			);
			$this->ci->session->set_userdata($array);
			return true;
		}else {
			return false;			
		}
	}
	
}

