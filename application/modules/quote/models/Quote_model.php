<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Quote_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
    }

    public function check_email_update($data)
    {
        $this->db->select('*');
        $this->db->where('email',$data);
        $query = $this->db->get('customers');
        return $query->num_rows();
    }

    public function insert_customer($data, $total, $ip_address)
    {
        $time = strtotime(date('Y-m-d G:i:s'));
        $start_plan = date("Y-m-d G:i:s", strtotime("+1 month", $time));
        $end_plan = date("Y-m-d G:i:s", strtotime('+1 years', strtotime($start_plan)));
        $i=1;
        if(!get_last_policy_num()) {
            $add_policy_num = str_pad(561483999+$i,9,'0',STR_PAD_LEFT);
        }else {
            $policy_num = get_last_policy_num();
            $add_policy_num = str_pad($policy_num+$i,9,'0',STR_PAD_LEFT);
        }

        $this->db->set('first_name', $data['FirstName']);
        $this->db->set('last_name', $data['LastName']);
        $this->db->set('email', $data['email']);
        $this->db->set('send_mail', 0);
        $this->db->set('home_phone', $data['HomePhone']);
        $this->db->set('work_phone', $data['CellPhone']);
        $this->db->set('p_firstname', $data['FirstName']);
        $this->db->set('p_lastname', $data['LastName']);
        $this->db->set('p_phone', $data['HomePhone']);
        $this->db->set('p_work_phone', $data['CellPhone']);
        $this->db->set('p_email', $data['email']);
        $this->db->set('ip_address', $ip_address);
        $this->db->set('street_address', $data['address']);
        $this->db->set('city', $data['city']);
        $this->db->set('state', $data['state']);
        $this->db->set('zip_code', $data['zipcode']);
        $this->db->set('card_num', $data['cardnumber']);
        $this->db->set('card_pin', $data['cvv']);
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
                if ($data['schedule']==2){
                    $this->db->set('payment_as', 2);
                    $net_total = $total * 12;
                    $this->db->set('payment_split', 12);
                }else{
                    $this->db->set('payment_as', 1);
                    $net_total = $total;
                    $this->db->set('payment_split', 1);
                }
                $this->db->set('policy_num', $add_policy_num);
                $this->db->set('property_type', $data['propertyType']);
                $this->db->set('size', $data['propertySize']);
                $this->db->set('plan', $data['plan']);
                $this->db->set('plan_year', 1);
                $this->db->set('free_month', 0);
                $this->db->set('discount', 0);
                $this->db->set('m_charge', 0);
                $this->db->set('plan_discount', 0);
                $this->db->set('plan_total', $total);
                $this->db->set('net_total', $net_total);
                $this->db->set('scf', 3);
                $this->db->set('free_scf', 1);
                $this->db->set('charge_state', 2);
                $this->db->set('plan_start', $start_plan);
                $this->db->set('plan_end', $end_plan);
                $this->db->set('created_at', date('Y-m-d H-i-s'));
                $this->db->insert('policy_renewal');
                $policy_renewal_id = $this->db->insert_id();
            }
        }
        return array("customer_id"=>$customer_id, "renewal_id"=>$policy_renewal_id);
    }

    public function insert_coverage($customer, $renewal_id, $data)
    {
        foreach ($data as $value){
            $this->db->set('customer', $customer);
            $this->db->set('renewal_id', $renewal_id);
            $this->db->set('coverage', $value);
            $this->db->set('created_at', date('Y-m-d H-i-s'));
            $this->db->insert('extra_coverage');
        }
        return true;
    }
}
