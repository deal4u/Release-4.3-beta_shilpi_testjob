<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Scoreboard_model extends CI_Model{

    public function __construct(){
        parent::__construct();
        //Do your magic here
    }

    public function get_salesperson_scoreboard($id){

        $this->db->select('*');
        $this->db->from('admin_permissions'); 
		$this->db->where('module','other');
        $this->db->where('admin_id',$id);
		$query = $this->db->get();
        return $query->result_array();
    }
	
    public function get_active_offer($data){
        $this->db->select('*');
        $this->db->from('scoreboard_offers'); 
		if(isset($data['activeoffer']) && $data['activeoffer'] == '1'){
			$this->db->where('status','1');
		}
		$this->db->order_by('id','desc');
		$query = $this->db->get();
        return $query->result_array();
    }
	
	
    public function insert_offers($data){
        
		$offerid = $this->db->insert('scoreboard_offers',$data);
        return $offerid;
    }
	
	public function update_offers($details)
    {
        $this->db->set('status', '2');
       // $this->db->where('id' , $details['id']);
        $query = $this->db->update('scoreboard_offers');
    }
}
