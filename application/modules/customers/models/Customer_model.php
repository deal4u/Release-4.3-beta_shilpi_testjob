<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
    }


    public function change_admin_password($data)
    {
        $hash_pass="password('".$data['new_password']."')";
        $this->db->set('password',$hash_pass, FALSE);
        $this->db->where('id', $this->session->userdata('id'));
        $result = $this->db->update('customers');
        return $this->db->affected_rows();
    }
    public function check_old_password($data)
    {
        $hash_pass="password('".$data['old_password']."')";
        $this->db->select('*');
        $this->db->where('password',$hash_pass,FALSE);
        $this->db->where('id', $this->session->userdata('id'));
        $query = $this->db->get('customers');
        return $query->num_rows();
    }
    public function check_new_password($data)
    {
        $hash_pass="password('".$data['new_password']."')";
        $this->db->select('*');
        $this->db->where('password',$hash_pass,FALSE);
        $this->db->where('id', $this->session->userdata('id'));
        $query = $this->db->get('customers');
        return $query->num_rows();
    }


    public function get_customers($admin_id=null)
    {
        $this->db->select('c.id, c.first_name, c.last_name, c.salesperson, c.email, c.home_phone, c.created_at, c.state, p.policy_num');
        $this->db->from('customers as c');
        $this->db->join('policy as p', 'p.customer = c.id');

        if($admin_id!=null)
            $this->db->where('c.id',$admin_id);

        $this->db->order_by('c.created_at', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

//    public function update_date($policy, $date){
//        $this->db->set('next_bill_date', $date);
//        $this->db->where('id' , $policy);
//        $query = $this->db->update('policy_renewal');
//    }

	public function update_round($policy, $round){
        $this->db->set('charge_round', $round);
        $this->db->where('id' , $policy);
        $query = $this->db->update('policy_renewal');
    }

    public function update_payment_details($data)
    {
        $this->db->set('next_bill_date', $data['bill_date']);
        $this->db->set('next_payment', $data['charge_payment']);
        $this->db->set('charge_round', $data['amount_to_charge']);
        $this->db->set('charge_update', 1);
        $this->db->where('id' , $data['policy_id']);
        $this->db->update('policy_renewal');
        return true;
    }  
  
    public function check_email_update($data)
    {
        $this->db->select('*');
        $this->db->where('id !=',$data['id']);
        $this->db->where('email',$data['c_email']);
        $query = $this->db->get('customers');
        return $query->num_rows();
    }
	
/* CHECK EMAIL EXISTS */
	public function check_email_exists($data)
	{
		$this->db->select('*');
		//$this->db->where('id !=',$data['id']);
		$this->db->where('email',$data['c_email']);
		$query = $this->db->get('customers');
		return $query->result_array();
	}

    public function update_customer($data)
    {
        $this->db->set('first_name', $data['first_name']);
        $this->db->set('last_name', $data['last_name']);
        $this->db->set('email', $data['email']);
        $this->db->set('home_phone', $data['home_phone']);
        $this->db->set('work_phone', $data['work_phone']);
        $this->db->set('mail_address', $data['mail_address']);
        $this->db->set('mail_city', $data['mail_city']);
        $this->db->set('mail_state', $data['mail_state']);
        $this->db->set('mail_zipcode', $data['mail_zipcode']);
		$this->db->set('updated_at', date('Y-m-d H-i-s'));
        $this->db->where('id' , $data['id']);
        $query = $this->db->update('customers');
        return $this->db->affected_rows();
    }



    public function get_plan_policy_data($id)
    {
        $this->db->select('c.*, p.policy_num, policy_renewal.id as policy_renewal_id');
        $this->db->from('customers as c');
        $this->db->join('policy as p', 'p.customer = c.id');
		$this->db->join('policy_renewal', 'policy_renewal.policy_num = p.policy_num');
        $this->db->where('c.id', $id);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function get_policy_data($id,$policy)
    {
        $this->db->select('c.*,policy_renewal.*');
        $this->db->from('customers as c');
        $this->db->join('policy as p', 'p.customer = c.id');
		$this->db->join('policy_renewal', 'policy_renewal.policy_num = p.policy_num');
        $this->db->where('c.id', $id);
        $this->db->where('policy_renewal.id', $policy);
        $query = $this->db->get();
        return $query->result_array();
    }

	public function get_customer_payment_profile($customer_id, $processor){
		$query = $this->db->query("SELECT * FROM customer_payment_profiles where customer_id = {$customer_id}");
		return $query->result_array();    
	}
}
