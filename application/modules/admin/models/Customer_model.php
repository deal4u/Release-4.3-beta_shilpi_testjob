<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
    }

    public function get_customers($admin_id=null)
    {
        $this->db->select('c.id, c.first_name, c.last_name, c.salesperson, c.email, c.home_phone, c.created_at, c.state, p.policy_num, pr.status as policy_status');
        $this->db->from('customers as c');
        $this->db->join('policy as p', 'p.customer = c.id');

        $this->db->join('policy_renewal as pr', 'pr.policy_num = p.policy_num', 'left');
        if($admin_id!=null)
            $this->db->where('c.salesperson',$admin_id);

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

    public function insert_customer($data, $discount, $total, $ip_address, $billing_date)
    {
        $time = strtotime(date('Y-m-d G:i:s'));
        //$start_plan = date("Y-m-d G:i:s", $time);
        $start_plan = date("Y-m-d G:i:s", strtotime("+1 month", $time));
        $end_plan = date("Y-m-d G:i:s", strtotime('+'."{$data['c_plan']}".' years', strtotime($start_plan)));
        if ($data['c_month'] != ''){
            $time_month = strtotime($end_plan);
            $end_plan_month = date("Y-m-d G:i:s", strtotime('+'."{$data['c_month']}".' month', $time_month));
        }else{
            $end_plan_month = $end_plan;
        }
        $i=1;
        if(!get_last_policy_num()) {
            $add_policy_num = str_pad(561483999+$i,9,'0',STR_PAD_LEFT);
        }
        else {
            $policy_num = get_last_policy_num();
            $add_policy_num = str_pad($policy_num+$i,9,'0',STR_PAD_LEFT);
        }

        $this->db->set('first_name', $data['c_fname']);
        $this->db->set('last_name', $data['c_lname']);
        $this->db->set('email', $data['c_email']);
        if (isset($data['not_mail'])){
            $this->db->set('send_mail', 0);
        }else{
            $this->db->set('send_mail', 1);
        }
        $this->db->set('home_phone', $data['c_home_phn']);
        $this->db->set('work_phone', $data['c_work_phn']);
        $this->db->set('p_firstname', $data['p_fname']);
        $this->db->set('p_lastname', $data['p_lname']);
        $this->db->set('p_phone', $data['p_phn']);
        $this->db->set('p_work_phone', $data['p_work_phn']);
        $this->db->set('p_email', $data['p_email']);

        $this->db->set('mail_address', $data['m_address']);
        $this->db->set('mail_city', $data['m_city']);
        $this->db->set('mail_state', $data['m_state']);
        $this->db->set('mail_zipcode', $data['m_zip']);
        $this->db->set('bill_address', $data['b_address']);
        $this->db->set('bill_city', $data['b_city']);
        $this->db->set('bill_state', $data['b_state']);
        $this->db->set('bill_zipcode', $data['b_zip']);
        $this->db->set('bill_cardname', $data['b_name_on_card']);

        $this->db->set('ip_address', $ip_address);
        $this->db->set('street_address', $data['c_address']);
        $this->db->set('city', $data['c_city']);
        $this->db->set('state', $data['c_state']);
        $this->db->set('zip_code', $data['c_zip']);
        if (empty($data['s_person'])){
            $this->db->set('salesperson', $this->session->userdata('admin_id'));
        }else{
            $this->db->set('salesperson', $data['s_person']);
        }
        $this->db->set('leadsource', $data['lead_source']);

        $this->db->set('card_num', $data['card_num']);
        $this->db->set('card_pin', $data['card_pin']);
        $this->db->set('card_exp_month', $data['card_month']);
        $this->db->set('card_exp_year', $data['card_year']);
        $this->db->set('created_at', date('Y-m-d H-i-s'));

        $this->db->insert('customers');
        $customer_id = $this->db->insert_id();

        if($customer_id > 0){
            $this->db->set('customer',$customer_id);
            $this->db->set('policy_num', $add_policy_num);
            $this->db->set('created_at', date('Y-m-d H-i-s'));
            $this->db->insert('policy');
            $policy_id = $this->db->insert_id();

            if ($policy_id > 0) {
                $random_number = strtoupper(md5(mt_rand(1000000, 9888888)));

                if (isset($data['payment_as'])){
                    $this->db->set('payment_as', 2);
                    $net_total = ($total * ($data['c_plan'] * 12));
                    $this->db->set('payment_split', ($data['c_plan'] * 12));
                    // if ($data['c_charge'] != 1){
                    //     $this->db->set('charge_round', 0);
                    // }
                }else{
                    $this->db->set('payment_as', 1);
                    $net_total = ($total * $data['c_payment']);
                    $this->db->set('payment_split', $data['c_payment']);

                    if ($data['c_charge'] == 1 && $data['c_payment'] == 1){
                        $this->db->set('charge_round', 0);
                    }elseif ($data['c_charge'] == 1 && $data['c_payment'] != 1){
                        $round = $data['c_payment'] - 1;
                        $this->db->set('charge_round', $round);
                    }else{
                        $this->db->set('charge_round', 0);
                    }
                }
				
                $this->db->set('policy_num', $add_policy_num);
                $this->db->set('property_type', $data['c_p_type']);
                $this->db->set('size', $data['c_size']);
                $this->db->set('plan', $data['c_plan_type']);
                $this->db->set('plan_year', $data['c_plan']);
                $this->db->set('free_month', $data['c_month']);
                $this->db->set('discount', $data['c_discount']);
                $this->db->set('m_charge', $data['m_charge']);
                $this->db->set('plan_discount', $discount);
                $this->db->set('plan_initial', $total);
                $this->db->set('plan_total', $total);
                $this->db->set('net_total', $net_total);
                $this->db->set('scf', $data['c_scf']);
                $this->db->set('free_scf', $data['free_scf']);
                $this->db->set('charge_state', $data['c_charge']);
                $this->db->set('plan_start', $start_plan);
                $this->db->set('plan_end', $end_plan_month);
                $this->db->set('next_bill_date', $billing_date);
                $this->db->set('pdf_randomid', $random_number);
                $this->db->set('created_at', date('Y-m-d H-i-s'));
                $this->db->insert('policy_renewal');
                $policy_renewal_id = $this->db->insert_id();
            }
			$hash_pass="password('".$add_policy_num."')";
				$this->db->set('Password',$hash_pass, FALSE);
				$this->db->where('id', $customer_id);
				$result = $this->db->update('customers');
        }
        // return $customer_id;
        return array("customer_id"=>$customer_id, "renewal_id"=>$policy_renewal_id);


    }

    public function insert_customer_policy($data, $discount, $total, $billing_date)
    {
		$policydata1 = get_last_policy_num($data['id']);
		$policydata = get_customer_policy($policydata1);

/*
        if(isset($policydata['plan_end'])){
			$time = strtotime($policydata['plan_end']);
			$start_plan = date("Y-m-d G:i:s", strtotime("+1 day", $time));
		}else{
			$time = strtotime(date('Y-m-d G:i:s'));
			$start_plan = date("Y-m-d G:i:s", strtotime("+1 month", $time));
		}
      
       
        $end_plan = date("Y-m-d G:i:s", strtotime('+'."{$data['c_plan']}".' years', strtotime($start_plan)));

        if ($data['c_month'] != ''){
            $time_month = strtotime($end_plan);
            $end_plan_month = date("Y-m-d G:i:s", strtotime('+'."{$data['c_month']}".' month', $time_month));
        }else{
            $end_plan_month = $end_plan;
        }
        */

        $today = date('Y-m-d');

        if($today <= $policydata['plan_end']){
            $time = strtotime($policydata['plan_end']);
            $start_plan = date("Y-m-d", strtotime("+1 day", $time));
            $end_plan = date("Y-m-d", strtotime('+'."{$data['c_plan']}".' years', strtotime($start_plan)));
        }
        else{
            $start_plan = date('Y-m-d');
            $end_plan = date("Y-m-d", strtotime('+'."{$data['c_plan']}".' years', strtotime($start_plan)));
        }

        if ($data['c_month'] != ''){
            $time_month = strtotime($end_plan);
            $end_plan = date("Y-m-d", strtotime('+'."{$data['c_month']}".' month', $time_month));
        }

        $this->db->set('first_name', $data['c_fname']);
        $this->db->set('last_name', $data['c_lname']);
        $this->db->set('email', $data['c_email']);
        if (isset($data['not_mail'])){
            $this->db->set('send_mail', 0);
        }
        $this->db->set('home_phone', $data['c_home_phn']);
        $this->db->set('work_phone', $data['c_work_phn']);
        $this->db->set('p_firstname', $data['p_fname']);
        $this->db->set('p_lastname', $data['p_lname']);
        $this->db->set('p_phone', $data['p_phn']);
        $this->db->set('p_work_phone', $data['p_work_phn']);
        $this->db->set('p_email', $data['p_email']);

        $this->db->set('salesperson', $data['s_person']);
        $this->db->set('leadsource', $data['lead_source']);

        $this->db->set('street_address', $data['c_address']);
        $this->db->set('city', $data['c_city']);
        $this->db->set('state', $data['c_state']);
        $this->db->set('zip_code', $data['c_zip']);

        $this->db->set('mail_address', $data['m_address']);
        $this->db->set('mail_city', $data['m_city']);
        $this->db->set('mail_state', $data['m_state']);
        $this->db->set('mail_zipcode', $data['m_zip']);
        $this->db->set('bill_address', $data['b_address']);
        $this->db->set('bill_city', $data['b_city']);
        $this->db->set('bill_state', $data['b_state']);
        $this->db->set('bill_zipcode', $data['b_zip']);
        $this->db->set('bill_cardname', $data['b_name_on_card']);
        $this->db->set('updated_at', date('Y-m-d H-i-s'));
        $this->db->where('id' , $data['id']);
        $query = $this->db->update('customers');

        $random_number = strtoupper(md5(mt_rand(1000000, 9888888)));

        if (isset($data['payment_as'])){
            $this->db->set('payment_as', 2);
            $net_total = ($total * ($data['c_plan'] * 12));
            $this->db->set('payment_split', ($data['c_plan'] * 12));
            // if ($data['c_charge'] != 1){
            //     $this->db->set('charge_round', 0);
            // }
        }else{
            $this->db->set('payment_as', 1);
            $net_total = ($total * $data['c_payment']);
            $this->db->set('payment_split', $data['c_payment']);
            if ($data['c_charge'] == 1 && $data['c_payment'] == 1){
                $this->db->set('charge_round', 0);
            }elseif ($data['c_charge'] == 1 && $data['c_payment'] != 1){
                $round = $data['c_payment'] - 1;
                $this->db->set('charge_round', $round);
            }else{
                $this->db->set('charge_round', 0);
            }
        }
        $this->db->set('policy_num', $data['policy_num']);
        $this->db->set('property_type', $data['c_p_type']);
        $this->db->set('size', $data['c_size']);
        $this->db->set('plan', $data['c_plan_type']);
        $this->db->set('plan_year', $data['c_plan']);
        $this->db->set('free_month', $data['c_month']);
        $this->db->set('discount', $data['c_discount']);
        $this->db->set('m_charge', $data['m_charge']);
        $this->db->set('plan_discount', $discount);
        $this->db->set('plan_initial', $total);
        $this->db->set('plan_total', $total);
        $this->db->set('net_total', $net_total);
        $this->db->set('scf', $data['c_scf']);
        $this->db->set('free_scf', $data['free_scf']);
        $this->db->set('charge_state', $data['c_charge']);
        $this->db->set('plan_start', $start_plan);
        $this->db->set('plan_end', $end_plan);
        $this->db->set('next_bill_date', $billing_date);
        $this->db->set('pdf_randomid', $random_number);
        $this->db->set('created_at', date('Y-m-d H-i-s'));
        $this->db->insert('policy_renewal');
        $renewal_id = $this->db->insert_id();
        return $renewal_id;
    }

    public function insert_coverage($customer, $renewal_id, $data, $other_coverage='')
    {
        foreach ($data as $value){
            $this->db->set('customer', $customer);
            $this->db->set('renewal_id', $renewal_id);
            $this->db->set('coverage', $value);
            $this->db->set('created_at', date('Y-m-d H-i-s'));
            if(($other_coverage!='') && ($value=='25')){
                $this->db->set('comments', $other_coverage);
            }
            $this->db->insert('extra_coverage');
        }
        return true;
    }

    public function insert_card($customer, $details)
    {
        $this->db->set('customer_id', $customer);
        $this->db->set('card_num', $details['card_num']);
        $this->db->set('card_exp_month', $details['card_month']);
        $this->db->set('card_exp_year', $details['card_year']);
        $this->db->set('card_pin', $details['card_pin']);
        $this->db->set('bill_zipcode', $details['b_zip']);
        $this->db->set('bill_cardname', $details['b_name_on_card']);
        $this->db->set('created_at', date('Y-m-d H-i-s'));
        $card_id = $this->db->insert('customer_cards');
        return $card_id;
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
        $start_plan = date("Y-m-d G:i:s", strtotime($data['plan_start']));
        $end_plan = date("Y-m-d G:i:s", strtotime('+'."{$data['c_plan']}".' years', strtotime($start_plan)));
        if ($data['c_month'] != ''){
            $time_month = strtotime($end_plan);
            $end_plan_month = date("Y-m-d G:i:s", strtotime('+'."{$data['c_month']}".' month', $time_month));
        }else{
            $end_plan_month = $end_plan;
        }

        $this->db->set('first_name', $data['c_fname']);
        $this->db->set('last_name', $data['c_lname']);
        $this->db->set('email', $data['c_email']);
        if (isset($data['not_mail'])){
            $this->db->set('send_mail', 0);
        }
        $this->db->set('home_phone', $data['c_home_phn']);
        $this->db->set('work_phone', $data['c_work_phn']);
        $this->db->set('p_firstname', $data['p_fname']);
        $this->db->set('p_lastname', $data['p_lname']);
        $this->db->set('p_phone', $data['p_phn']);
        $this->db->set('p_work_phone', $data['p_work_phn']);
        $this->db->set('p_email', $data['p_email']);

        $this->db->set('salesperson', $data['salesperson']);
        $this->db->set('leadsource', $data['lead_source']);

        $this->db->set('street_address', $data['c_address']);
        $this->db->set('city', $data['c_city']);
        $this->db->set('state', $data['c_state']);
        $this->db->set('zip_code', $data['c_zip']);

        $this->db->set('mail_address', $data['m_address']);
        $this->db->set('mail_city', $data['m_city']);
        $this->db->set('mail_state', $data['m_state']);
        $this->db->set('mail_zipcode', $data['m_zip']);
        $this->db->set('bill_address', $data['b_address']);
        $this->db->set('bill_city', $data['b_city']);
        $this->db->set('bill_state', $data['b_state']);
        $this->db->set('bill_zipcode', $data['b_zip']);
        $this->db->set('bill_cardname', $data['b_name_on_card']);
        $this->db->set('updated_at', date('Y-m-d H-i-s'));

        $this->db->where('id' , $data['id']);
        $query = $this->db->update('customers');

        $this->db->set('updated_at', date('Y-m-d H-i-s'));
        $this->db->where('policy_num' , $data['plan_id']);
        $query = $this->db->update('policy');

         // Get OLD DATA
         $this->db->select('*');
         $this->db->where('id',$data['policy_id']);
         $query = $this->db->get('policy_renewal');
         $old_data = $query->row_array();
        $this->db->set('property_type', $data['c_p_type']);
        $this->db->set('size', $data['c_size']);
        $this->db->set('plan', $data['c_plan_type']);
        $this->db->set('plan_year', $data['c_plan']);
        $this->db->set('free_month', $data['c_month']);
        $this->db->set('discount', $data['c_discount']);
        $this->db->set('m_charge', $data['m_charge']);
        // $this->db->set('plan_discount', $discount);
        $this->db->set('plan_initial', $data['plan_total']);
        $this->db->set('plan_total', $data['plan_total']);
        $this->db->set('net_total', $data['net_total']);
        $this->db->set('scf', $data['c_scf']);
        $this->db->set('free_scf', $data['free_scf']);
        $this->db->set('plan_end', $end_plan_month);
        if (isset($data['status'])) {
            $this->db->set('status', $data['status']);
        }
        if (isset($data['start'])) {
            $this->db->set('plan_start', $data['start']);
        }
        if (isset($data['end'])) {
            $this->db->set('plan_end', $data['end']);
        }
        $this->db->set('updated_at', date('Y-m-d H-i-s'));
        $this->db->where('policy_num' , $data['plan_id']);
        $this->db->where('id' , $data['policy_id']);
        $query = $this->db->update('policy_renewal');

        //Add Notes in case of status change
        if (isset($data['status']) && ($old_data['status']!=$data['status'])) {
            $new_status = $data['status'];
            $msg = "Status changed from <b>". policy_status($old_data['status']) . '</b> to <b>'. policy_status($new_status).'</b>'; 
            save_general_note($data['id'],$msg);
        }
        return $this->db->affected_rows();
    }

    public function update_policy_number($details)
    {
        $this->db->set('pdf_randomid', $details['pdf_randomid']);
        $this->db->where('id' , $details['id']);
        $query = $this->db->update('policy_renewal');
    }

    public function delete_coverage($id, $policy_id)
    {
        $this->db->where('customer', $id);
        $this->db->where('renewal_id', $policy_id);
        $query = $this->db->delete('extra_coverage');
        return $this->db->affected_rows();
    }

    public function search_customer($data)
    {
        $this->db->select('customers.*,policy.policy_num');
        $this->db->from('customers');
        $this->db->join('policy', 'customers.id = policy.customer', 'left');
        if (!empty($data['policyno']) || !empty($data['status'])) {
            $this->db->join('policy_renewal as pr', 'pr.policy_num = policy.policy_num', 'left');
        }

        if (!empty($data['claimno'])) {
            $this->db->join('claims', 'customers.id = claims.customer', 'left');
            $this->db->like('claims.claim_num', $data['claimno']);
        }
        if (isset($data['fname'])) {
            $this->db->like('customers.first_name', $data['fname']);
        }
        if (isset($data['lname'])) {
            $this->db->like('customers.last_name', $data['lname']);
        }
        if (isset($data['number'])) {
            $this->db->like('customers.home_phone', $data['number']);
        }
        if (!empty($data['status'])) {
            $this->db->like('pr.status', $data['status']);
        }
        if (isset($data['email'])) {
            $this->db->like('customers.email', $data['email']);
        }
        if (isset($data['address'])) {
            $this->db->like('customers.street_address', $data['address']);
        }
        if (isset($data['zip'])) {
            $this->db->like('customers.zip_code', $data['zip']);
        }
        if (isset($data['representative'])) {
            $this->db->like('customers.salesperson', $data['representative']);
        }
        if (isset($data['source'])) {
            $this->db->like('customers.leadsource', $data['source']);
        }
        if (!empty($data['policyno'])) {
            $this->db->like('policy.policy_num', $data['policyno']);
        }
        if (isset($data['cc'])) {
            $this->db->like('customers.card_num', $data['cc']);
        }
        $this->db->order_by('customers.created_at', 'DESC');
        $this->db->group_by('customers.id');
        $query = $this->db->get();
        //echo $this->db->last_query();
        return $query->result_array();
    }

    public function delete_customer($id)
    {
        $this->db->select('policy_num');
        $this->db->from('policy as p');
        $this->db->where('customer', $id);
        $policy_num = $this->db->get();
        $policy_number = $policy_num->row_array();

        $this->db->where('policy_num', $policy_number['policy_num']);
        $query = $this->db->delete('policy_renewal');

        $this->db->where('customer', $id);
        $query = $this->db->delete('policy');

        $this->db->where('customer', $id);
        $query = $this->db->delete('extra_coverage');

        $this->db->where('customer', $id);
        $query = $this->db->delete('policy_logs');

        $this->db->where('customer', $id);
        $query = $this->db->delete('claim_files');

        $this->db->where('id', $id);
        $query = $this->db->delete('customers');
        return true;
    }

    public function delete_tasks($id)
    {
        $this->db->where('customer', $id);
        $query = $this->db->delete('tasks_notes');
        return true;
    }

    public function delete_claims($id, $claims)
    {
        foreach ($claims as $claim) {
            $this->db->where('claim', $claim['id']);
            $query = $this->db->delete('claim_auth');
        }

        $this->db->where('customer', $id);
        $query = $this->db->delete('claims');
        return true;
    }
    public function insert_image($data)
    {
        $this->db->set('customer',$data['customer_claim']);
        $this->db->set('name', $data['image_alt']);
        $this->db->set('file', $data['image']);
        $this->db->set('created_at', date('Y-m-d H-i-s'));
        return  $this->db->insert('claim_files');
    }
    public function delete_claim_files($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->delete('claim_files');
        return $this->db->affected_rows();
    }

    public function update_payment_info($data)
    {
		if(isset($data['id']) && $data['id']!=""){
			$data['customer_id'] = $data['id'];
		}
		$this->db->select('card_num,id');
        $this->db->from('customer_cards');
        $this->db->where('card_num',$data['card_num']);
        $this->db->where('customer_id',$data['customer_id']);
        $cardNumber = $this->db->get();
        $card_number = $cardNumber->row_array();
		if(isset($card_number['id']) && $card_number['id']!=""){
        $this->db->set('card_num',$data['card_num']);
        $this->db->set('card_pin',$data['card_pin']);
        $this->db->set('card_exp_month', $data['card_month']);
        $this->db->set('card_exp_year', $data['card_year']);
        $this->db->set('updated_at', date('Y-m-d H-i-s'));
			$this->db->set('status', 1);
			$this->db->where('id', $card_number['id']);
			$this->db->update('customer_cards');
			
			$this->db->set('status', 0);
			$this->db->set('updated_at', date('Y-m-d H-i-s'));
			$this->db->where('customer_id', $data['customer_id']);
			$this->db->where('id !=', $card_number['id']);
			$this->db->update('customer_cards');
			return true;
		}else{
			$this->db->set('card_num',$data['card_num']);
			$this->db->set('card_pin',$data['card_pin']);
			$this->db->set('card_exp_month', $data['card_month']);
			$this->db->set('card_exp_year', $data['card_year']);
			$this->db->set('updated_at', date('Y-m-d H-i-s'));
			$this->db->set('status', 1);
        $this->db->where('id', $data['card_id']);
        $this->db->update('customer_cards');
        return true;
    }
    }

    public function add_payment_info($data, $billing_info)
    {
        $this->db->set('customer_id', $data['customer_id']);
        $this->db->set('card_num', $data['card_num']);
        $this->db->set('card_exp_month', $data['card_month']);
        $this->db->set('card_exp_year', $data['card_year']);
        $this->db->set('card_pin', $data['card_pin']);
        $this->db->set('bill_zipcode', $billing_info['bill_zipcode']);
        $this->db->set('bill_cardname', $billing_info['bill_cardname']);
        $this->db->set('created_at', date('Y-m-d H-i-s'));
        $this->db->insert('customer_cards');
        $card_id = $this->db->insert_id();

        $this->db->set('status', 0);
        $this->db->set('updated_at', date('Y-m-d H-i-s'));
        $this->db->where('customer_id', $data['customer_id']);
        $this->db->where('id !=', $card_id);
        $this->db->update('customer_cards');
        return $card_id;
    }

    public function update_card_status($data)
    {
        $this->old_card_status($data);

        $this->db->set('status', $data['status']);
        $this->db->set('updated_at', date('Y-m-d H-i-s'));
        $this->db->where('id', $data['id']);
        $this->db->update('customer_cards');
        return $this->db->affected_rows();
    }

    public function old_card_status($data)
    {
        $this->db->set('status', 0);
        $this->db->set('updated_at', date('Y-m-d H-i-s'));
        $this->db->where('customer_id', $data['customer']);
        $this->db->update('customer_cards');
    }

    public function insert_policy_log($customer_id,$user_id)
    {
        $this->db->set('customer',$customer_id);
        $this->db->set('user', $user_id);
        $this->db->set('created_at', date('Y-m-d H-i-s'));
        return  $this->db->insert('policy_logs');
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

    public function insert_payment($customer,$customer_details , $details, $rep, $amount)
    {
        $this->db->set('customer_id', $customer);
        $this->db->set('rep', $rep);
        if (isset($customer_details['id'])){
            $this->db->set('card_id', $customer_details['id']);
        }
        if (!empty($details['transactionResponse']['responseCode'])){
            $this->db->set('code', $details['transactionResponse']['responseCode']);
        }
        if (!empty($details['transactionResponse']['transId'])) {
            $this->db->set('transaction_id', $details['transactionResponse']['transId']);
        }
		
        if (!empty( $details['renewal_id'])) {
            $this->db->set('policy_renewal_id', $details['renewal_id']);
        }
        if (!empty($details['transactionResponse']['networkTransId'])) {
            $this->db->set('refId', $details['transactionResponse']['networkTransId']);
        }
        if (!empty($details['transactionResponse']['authCode'])) {
            $this->db->set('authcode', $details['transactionResponse']['authCode']);
        }
        $this->db->set('amount_approved', $amount);
        if (!empty($details['transactionResponse']['transHashSha2'])) {
            $this->db->set('token', $details['transactionResponse']['transHashSha2']);
        }
        if (!empty($details['transactionResponse']['messages'][0]['description'])) {
            $this->db->set('message', $details['transactionResponse']['messages'][0]['description']);
        }elseif (!empty($details['transactionResponse']['errors'][0]['errorText'])){
            $this->db->set('message', $details['transactionResponse']['errors'][0]['errorText']);
        }
        if (!empty($details['transactionResponse']['messages'][0]['code'])) {
            $result_code = $details['transactionResponse']['messages'][0]['code'];
            if ($result_code == 1){
                $this->db->set('status', 1);
            }
        }elseif (!empty($details['transactionResponse']['errors'])){
            $result_code = $details['transactionResponse']['errors'][0]['errorCode'];
            if ($result_code == 11 || $result_code == 8){
                $this->db->set('status', 2);
            }elseif ($result_code == 5 || $result_code == 6){
                $this->db->set('status', 3);
            }else{
                $this->db->set('status', 4);
            }
        }
        $this->db->set('created_at', date('Y-m-d H-i-s'));
        $card_id = $this->db->insert('payments');
        return $card_id;
    }

	public function create_customer_payment_profile($customer_id, $processor, $profile_data){
		$query = $this->db->query("SELECT * FROM customer_payment_profiles where customer_id = {$customer_id}");
		$count = $query->num_rows();
		$this->db->set('authorize', $profile_data['payment_profileID']);
		$this->db->set("authorize_payment_profile", $profile_data['authorize_payment_profile']);
		if( isset($profile_data['customer_shipping_id']) &&  $profile_data['customer_shipping_id']!=""){
             $this->db->set("customer_shipping_id", $profile_data['customer_shipping_id']);
		}
		if(isset($profile_data['subscription_id']) &&   $profile_data['subscription_id']!=""){
             $this->db->set("subscription_id", $profile_data['subscription_id']);
		}
		
		if(isset($processor) &&   $processor!=""){
             $this->db->set("payment_mode", $processor);
		}
	 if($count == 0){
		 $this->db->set('customer_id', $customer_id);
		 $this->db->set('created_at', date('Y-m-d H-i-s'));
		 $profile_id = $this->db->insert('customer_payment_profiles');
	 }else{
		 $this->db->set('updated_at', date('Y-m-d H-i-s'));
		 $this->db->where('customer_id', $customer_id);
		 $profile_id = $this->db->update('customer_payment_profiles');
	 }
	 return $profile_id;
	}
	public function cancelARBSubscription($customer_id){
		$this->db->set('subscription_id', '');
		 $this->db->set('updated_at', date('Y-m-d H-i-s'));
		 $this->db->where('customer_id', $customer_id);
		 $profile_id = $this->db->update('customer_payment_profiles');
	 
	 return $profile_id;
	}
	public function get_customer_payment_profile($customer_id){
		$query = $this->db->query("SELECT * FROM customer_payment_profiles where customer_id = {$customer_id}");
		return $query->result_array();    
	}

//    public function get_total()
//    {
//        $this->db->select('id,plan_total');
//        $this->db->from('policy_renewal');
//        $query = $this->db->get();
//        return $query->result_array();
//    }
//
//    public function update_initial($data)
//    {
//        $this->db->set('plan_initial', $data['plan_total']);
//        $this->db->where('id', $data['id']);
//        $this->db->update('policy_renewal');
//        return $this->db->affected_rows();
//    }
    public function renew_customer($data)
    {
        $this->db->set('first_name', $data['c_fname']);
        $this->db->set('last_name', $data['c_lname']);
        $this->db->set('email', $data['c_email']);
        if (isset($data['not_mail'])){
            $this->db->set('send_mail', 0);
        }
        $this->db->set('home_phone', $data['c_home_phn']);
        $this->db->set('work_phone', $data['c_work_phn']);
        $this->db->set('p_firstname', $data['p_fname']);
        $this->db->set('p_lastname', $data['p_lname']);
        $this->db->set('p_phone', $data['p_phn']);
        $this->db->set('p_work_phone', $data['p_work_phn']);
        $this->db->set('p_email', $data['p_email']);

        $this->db->set('salesperson', $data['salesperson']);
        $this->db->set('leadsource', $data['lead_source']);

        $this->db->set('street_address', $data['c_address']);
        $this->db->set('city', $data['c_city']);
        $this->db->set('state', $data['c_state']);
        $this->db->set('zip_code', $data['c_zip']);

        $this->db->set('mail_address', $data['m_address']);
        $this->db->set('mail_city', $data['m_city']);
        $this->db->set('mail_state', $data['m_state']);
        $this->db->set('mail_zipcode', $data['m_zip']);
        $this->db->set('bill_address', $data['b_address']);
        $this->db->set('bill_city', $data['b_city']);
        $this->db->set('bill_state', $data['b_state']);
        $this->db->set('bill_zipcode', $data['b_zip']);
        $this->db->set('bill_cardname', $data['b_name_on_card']);
        $this->db->set('updated_at', date('Y-m-d H-i-s'));

        $this->db->where('id' , $data['id']);
        $query = $this->db->update('customers');
		
		return $this->db->affected_rows();
		/* 
 $start_plan = date("Y-m-d G:i:s", strtotime($data['plan_start']));
        $end_plan = date("Y-m-d G:i:s", strtotime('+'."{$data['c_plan']}".' years', strtotime($start_plan)));
        if ($data['c_month'] != ''){
            $time_month = strtotime($end_plan);
            $end_plan_month = date("Y-m-d G:i:s", strtotime('+'."{$data['c_month']}".' month', $time_month));
        }else{
            $end_plan_month = $end_plan;
        }
        $this->db->set('updated_at', date('Y-m-d H-i-s'));
        $this->db->where('policy_num' , $data['plan_id']);
        $query = $this->db->update('policy');

        $this->db->set('property_type', $data['c_p_type']);
        $this->db->set('size', $data['c_size']);
        $this->db->set('plan', $data['c_plan_type']);
        $this->db->set('plan_year', $data['c_plan']);
        $this->db->set('free_month', $data['c_month']);
        $this->db->set('discount', $data['c_discount']);
        $this->db->set('m_charge', $data['m_charge']);
        // $this->db->set('plan_discount', $discount);
        $this->db->set('plan_initial', $data['plan_total']);
        $this->db->set('plan_total', $data['plan_total']);
        $this->db->set('net_total', $data['net_total']);
        $this->db->set('scf', $data['c_scf']);
        $this->db->set('free_scf', $data['free_scf']);
        $this->db->set('plan_end', $end_plan_month);
        if (isset($data['status'])) {
            $this->db->set('status', $data['status']);
        }
        if (isset($data['start'])) {
            $this->db->set('plan_start', $data['start']);
        }
        if (isset($data['end'])) {
            $this->db->set('plan_end', $data['end']);
        }
        $this->db->set('updated_at', date('Y-m-d H-i-s'));
        $this->db->where('policy_num' , $data['plan_id']);
        $this->db->where('id' , $data['policy_id']);
        $query = $this->db->update('policy_renewal');

        return $this->db->affected_rows(); */
    }
	
	   public function change_admin_password($data)
    {
        $hash_pass="password('".$data['new_password']."')";
        $this->db->set('password',$hash_pass, FALSE);
        $this->db->where('id', $data['customer_id']);
        $result = $this->db->update('customers');
        return $this->db->affected_rows();
    }
	
	    public function check_new_password($data)
    {
        $hash_pass="password('".$data['new_password']."')";
        $this->db->select('*');
        $this->db->where('password',$hash_pass,FALSE);
        $this->db->where('id', $data['customer_id']);
        $query = $this->db->get('customers');
        return $query->num_rows();
    }
}
