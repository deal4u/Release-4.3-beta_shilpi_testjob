<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Claim_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
    }

    public function get_claims()
    {
        $this->db->select('*');
        $this->db->from('claims');
        $this->db->order_by('created_at', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function insert_claim($data,$claim_num)
    {
        $this->db->set('claim_num', $claim_num);
        $this->db->set('customer', $data['customer']);
        $this->db->set('representative', $this->session->userdata('admin_id'));
        $this->db->set('item', $data['item']);
        $this->db->set('problem', $data['problem']);
        $this->db->set('last_working', $data['last_working']);
        $this->db->set('make', $data['make']);
        $this->db->set('last_serviced', $data['last_serviced']);
        $this->db->set('description', $data['description']);
        $this->db->set('status', 1);
        $this->db->set('created_at', date('Y-m-d H-i-s'));
        $this->db->insert('claims');
        return $this->db->insert_id();
    }

    public function claim_detail($claim, $claim_customer_id)
    {
        $this->db->select('*');
        $this->db->from('claims');
        $this->db->where('claim_num', $claim);
        $this->db->where('customer', $claim_customer_id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function update_status($data)
    {
    
        $this->db->select('*');
        $this->db->from('claims');
        $this->db->where('claim_num' , $data['claim']);
        $query = $this->db->get();
        $old =  $query->row_array();
        $old_status = $old['status'];
        $customer = $old['customer'];
        $claim_id = $old['id'];


        $this->db->set('status', $data['status']);
        $this->db->set('updated_at', date('Y-m-d H-i-s'));
        $this->db->where('claim_num' , $data['claim']);
        $query = $this->db->update('claims');

         //Add Notes in case of status change
         if (isset($data['status']) && ($old_status!=$data['status'])) {
            $new_status = $data['status'];
            $msg = "Status changed from <b>". claim_status($old_status) . '</b> to <b>'. claim_status($data['status']).'</b>'; 
            save_log_note_for_claim($customer,$claim_id,$msg);
        }

        return $this->db->affected_rows();
    }
    
    public function make_reimbursement($data)
    {
        $this->db->set('status', '2');
        $this->db->set('vendor', '');
        $this->db->set('updated_at', date('Y-m-d H-i-s'));
        $this->db->where('claim_num' , $data['claim']);
        $query = $this->db->update('claims');
        return $this->db->affected_rows();
    }

    public function update_satisfaction($data)
    {
        $this->db->set('customer_satisfaction', $data['status']);
        $this->db->set('updated_at', date('Y-m-d H-i-s'));
        $this->db->where('claim_num' , $data['claim']);
        $query = $this->db->update('claims');
        return $this->db->affected_rows();
    }

    public function update_vendor($data)
    {
        $this->db->set('vendor', $data['vendor']);
        $this->db->set('vendor_assign', date('Y-m-d H-i-s'));
        $this->db->where('claim_num' , $data['claim']);
        $query = $this->db->update('claims');
        return $this->db->affected_rows();
    }

    public function update_diagnose($data)
    {
        $this->db->set('contractor', $data['contractor']);
        $this->db->set('tech_name', $data['tech']);
        $this->db->set('called_by', $data['call_by']);
        $this->db->set('tech_home', $data['tech_home']);
        $this->db->set('there_when', $data['there_when']);
        $this->db->set('type', $data['type']);
        $this->db->set('age', $data['age']);
        $this->db->set('size', $data['size']);
        $this->db->set('p_installed', $data['p_installed']);
        $this->db->set('rust', $data['rust']);
        $this->db->set('failure_cause', $data['cause_failure']);
        $this->db->set('diagnosis', $data['diagnose']);
        $this->db->set('p_number', $data['p_number']);
        $this->db->set('p_price', $data['p_price']);
        $this->db->set('service_fee', $data['service_fee']);
        $this->db->set('paid_by', $data['paid_by']);
        $this->db->set('condition', $data['condition']);
        $this->db->set('leaks', $data['leak']);
        $this->db->set('leak_size', $data['leak_size']);
        $this->db->set('p_make', $data['make']);
        $this->db->set('p_model', $data['model']);
        $this->db->set('p_units', $data['units']);
        $this->db->set('p_maintained', $data['p_maintained']);
        $this->db->set('overloaded', $data['overloaded']);
        $this->db->set('total', $data['total']);
        $this->db->set('diagnose_by', $this->session->userdata('admin_id'));
        $this->db->set('diagnose_added', date('Y-m-d H-i-s'));
        $this->db->set('updated_at', date('Y-m-d H-i-s'));
        $this->db->where('id' , $data['id']);
        $query = $this->db->update('claims');
        return $this->db->affected_rows();
    }

    public function delete_claim($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->delete('claims');
        $this->db->where('claim', $id);
        $query = $this->db->delete('claim_auth');
        return true;
    }

    public function check_authorize($values)
    {
        $this->db->select('*');
        $this->db->from('claim_auth');
        foreach ($values as $key=>$value){
            $this->db->where($key, $value);
            $this->db->where('status', '1');
        }
        $query = $this->db->get();
        return $query->result_array();
    }

    public function save_authorization($data,$amount,$auth_num)
    {
        $this->db->set('claim', $data['claim']);
        $this->db->set('auth_num', $auth_num);
        $this->db->set('type', $data['type']);
        $this->db->set('auth_for', $data['auth_for']);
        $this->db->set('auth_by', $this->session->userdata('admin_id'));
        $this->db->set('auth_net', 15);
        $this->db->set('amount', $amount);
        $this->db->set('status', 1);
        $this->db->set('created_at', date('Y-m-d H-i-s'));
        $this->db->insert('claim_auth');
        return $this->db->insert_id();
    }
    public function change_authorization_status($data)
    {
        $this->db->set('status',2);
        $this->db->set('updated_at', date('Y-m-d H-i-s'));
        $this->db->where('id', $data['claim']);
        $result = $this->db->update('claim_auth');
        return $this->db->affected_rows();
    }

    public function get_policy_num($id)
    {
        $this->db->select('c.*, p.policy_num');
        $this->db->from('customers as c');
        $this->db->join('policy as p', 'p.customer = c.id');
        $this->db->where('c.id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function get_total_claims_by_customer($customer_id){
        $this->db->select('*');
        $this->db->from('claims as c');
        $this->db->where('c.customer', $customer_id);
        $query = $this->db->get();
        return $query->num_rows();
    }
	
	public function insert_image($data)
    {
        $this->db->set('customer',$data['customer_claimz']);
        $this->db->set('claim_id',$data['claim_idz']);
        $this->db->set('name', $data['image_alts']);
        $this->db->set('file', $data['image']);
        $this->db->set('created_at', date('Y-m-d H-i-s'));
        return  $this->db->insert('claim_files');
    }
}