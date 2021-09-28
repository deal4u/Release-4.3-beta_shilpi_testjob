<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Policy_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
    }

    public function get_plan_policy_data($id)
    {
        $this->db->select('c.*, p.policy_num');
        $this->db->from('customers as c');
        $this->db->join('policy as p', 'p.customer = c.id');
        $this->db->where('c.id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function update_ip($details, $ip_address)
    {
        $this->db->set('mail_ip',$ip_address);
        $this->db->set('mail_timestamp', date('Y-m-d H-i-s'));
        $this->db->where('id', $details['id']);
        $this->db->update('policy_renewal');
        return $this->db->affected_rows();
    }
}
