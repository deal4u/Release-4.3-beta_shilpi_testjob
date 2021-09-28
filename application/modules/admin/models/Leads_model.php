<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Leads_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
    }

    public function get_source($id='')
    {
        $this->db->select('*');
        $this->db->from('lead_source');
        if ($id != ''){
            $this->db->where('id',$id);
        }
        $this->db->order_by('created_at', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function update_lead_source($data)
    {
        $this->db->set('name', $data['name']);
        $this->db->set('cost', $data['cost']);
        $this->db->set('status', $data['status']);
		if(isset($data['sales_phone_no']) && $data['sales_phone_no']!=""){
			$this->db->set('sales_phone_no', $data['sales_phone_no']);
		}
		if(isset($data['show_portal']) && $data['show_portal']!=""){
			$this->db->set('show_portal', $data['show_portal']);
		}
        $this->db->set('updated_at', date('Y-m-d H-i-s'));
        $this->db->where('id' , $data['id']);
        $query = $this->db->update('lead_source');
        return true;
    }

    public function insert_lead_source($data)
    {
        $this->db->set('name', $data['name']);
        $this->db->set('cost', $data['cost']);
        $this->db->set('status', $data['status']);
		if(isset($data['sales_phone_no']) && $data['sales_phone_no']!=""){
			$this->db->set('sales_phone_no', $data['sales_phone_no']);
		}
		if(isset($data['show_portal']) && $data['show_portal']!=""){
			$this->db->set('show_portal', $data['show_portal']);
		}
        $this->db->set('created_at', date('Y-m-d H-i-s'));
        $this->db->insert('lead_source');
        return $this->db->insert_id();
    }
}
