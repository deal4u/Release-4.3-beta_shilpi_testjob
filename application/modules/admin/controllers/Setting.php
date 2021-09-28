<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('common/common_model');
		$this->load->model(admin_controller().'Setting_model');
        
        if (!$this->session->userdata('admin_logged_in')) {
            redirect(admin_url() . 'login');
        }
        if (get_session('admin_type') == 2 ){
            redirect(admin_url());
        }
    }

    public function index(){
        if (get_session('admin_type') == 2 && get_session('admin_permissions')['miscellaneous']->setting_menu!='on') {
            show_admin404();
        }else{
			$details['meta_tag'] = 'configuration';
			$getsetting = $this->Setting_model->getSetting($details);	
			$result = array();
			foreach ($getsetting as $setting){
				$result[$setting['meta_key']] = $setting['meta_value'];
				
			}
			$data['getsetting'] = $result;
            $this->load->view('setting/configuration',$data);
        }
    }
	
    public function add_payment_method(){
        if (get_session('admin_type') == 2 && get_session('admin_permissions')['miscellaneous']->setting_menu!='on') {
            show_admin404();
        }else{
			$details['meta_tag'] = 'payment_method';
			$getsetting = $this->Setting_model->getSetting($details);
			
			$data['getsetting'] = $getsetting;
            $this->load->view('setting/addpaymentlist',$data);
        }
    }
	
	public function savesetting(){
		if($_POST){
			$data = $_POST;
			$getsetting = $this->Setting_model->getSetting($data);
			if(isset($getsetting) && !empty($getsetting) ){
				
				$status = $this->Setting_model->updateSetting($data);
				
			}elseif($data['meta_tag']!=""){
				$status = $this->Setting_model->addSetting($data);
			}
			
			if($status > 0){
				$finalResult = array('msg' => 'success', 'response'=>"Setting changed successfully.");
				echo json_encode($finalResult);
				exit;
			}else{
				$finalResult = array('msg' => 'error', 'response'=>'Something went wrong!');
				echo json_encode($finalResult);
				exit;
			}
		}
	}	

	public function addmultiplesetting(){
		if($_POST){
			$data = $_POST;
			$getsetting = $this->Setting_model->getSetting($data , 'checkmetavalue');
			if(isset($getsetting) && !empty($getsetting) ){
				$finalResult = array('msg' => 'error', 'response'=>'Already Exists!');
				echo json_encode($finalResult);
				exit;
			}elseif($data['id']!=""){
				$status = $this->Setting_model->updateSetting($data);
				
			}elseif($data['meta_tag']!=""){
				$status = $this->Setting_model->addSetting($data);
			}
			
			if($status > 0){
				$finalResult = array('msg' => 'success', 'response'=>"Setting changed successfully.");
				echo json_encode($finalResult);
				exit;
			}else{
				$finalResult = array('msg' => 'error', 'response'=>'Something went wrong!');
				echo json_encode($finalResult);
				exit;
			}
		}
	}
	
}
