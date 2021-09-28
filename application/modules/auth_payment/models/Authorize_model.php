<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Authorize_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
    }

    public function get_policies()
    {
        $this->db->select('p.customer,r.id AS policy,r.policy_num,r.plan_total,r.next_bill_date,r.next_payment,r.charge_update,c.card_num,c.card_exp_month,c.card_exp_year,c.card_pin,c.bill_zipcode,c.bill_cardname,c.id AS card_id');
        $this->db->from('policy_renewal AS r');
        $this->db->join('policy as p', 'r.policy_num = p.policy_num');
        $this->db->join('customer_cards as c', 'p.customer = c.customer_id');
        $this->db->where('r.next_bill_date', 'CURDATE()', FALSE);
        $this->db->where('r.charge_round >', 0);
        $this->db->where('c.status', 1);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function insert_payment($data, $details, $rep, $amount)
    {
        $this->db->set('customer_id', $data['customer']);
        $this->db->set('rep', $rep);
        if (isset($data['card_id'])){
            $this->db->set('card_id', $data['card_id']);
        }
        if (!empty($details['transactionResponse']['responseCode'])){
            $this->db->set('code', $details['transactionResponse']['responseCode']);
        }
        if (!empty($details['transactionResponse']['transId'])) {
            $this->db->set('transaction_id', $details['transactionResponse']['transId']);
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
        $payment_id = $this->db->insert('payments');
        return $payment_id;
    }

    public function update_policy($data, $next_payment, $charge_round)
    {
        $this->db->set('next_bill_date', $next_payment);
        $this->db->set('charge_round', $charge_round);
        $this->db->set('charge_update', 0);
        $this->db->set('updated_at', date('Y-m-d H-i-s'));
        $this->db->where('id', $data['policy']);
        $this->db->update('policy_renewal');
        return $this->db->affected_rows();
    }
    
   
}
