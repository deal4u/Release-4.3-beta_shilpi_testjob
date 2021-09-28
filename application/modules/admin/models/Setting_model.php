<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting_model extends CI_Model{

    public function __construct(){
        parent::__construct();
        //Do your magic here
    }

    public function getsetting($data ,$checkmetavalue = ''){
        $this->db->select('*');
        $this->db->from('general_settings'); 
		$this->db->where('meta_tag',$data['meta_tag']);
		if(isset($data['meta_key'])&&  $data['meta_key']!=""){
			$this->db->where('meta_key',$data['meta_key']);	
		}
		if($checkmetavalue =="checkmetavalue"){
			$this->db->where('meta_value',$data['meta_value']);	
		}
		$query = $this->db->get();
        return $query->result_array();
    }
	
    public function addSetting($data){
		
		if(isset($data['meta_contents'])){
			$this->db->set('meta_content',json_encode($data['meta_contents']));
		}
		unset($data['meta_contents']);
		$offerid = $this->db->insert('general_settings',$data);
        return $offerid;
    }
	
	public function updateSetting($data)
    {
        $this->db->set('meta_value', $data['meta_value']);
		$this->db->where('meta_tag',$data['meta_tag']);
		$this->db->where('meta_key',$data['meta_key']);
		if(isset($data['id'])&& $data['id']!=""){
			$this->db->where('id',$data['id']);
		}
		$query = $this->db->update('general_settings');
		return $this->db->affected_rows();
    }
}
