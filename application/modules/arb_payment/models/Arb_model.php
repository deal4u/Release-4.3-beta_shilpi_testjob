<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Arb_model extends CI_Model
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

    public function insert_payment($data, $details, $rep)
    {
        $this->db->set('customer_id', $data['customer']);
        $this->db->set('rep', $rep);
        if (isset($data['card_id'])){
            $this->db->set('card_id', $data['card_id']);
        }
        if (!empty($details->code)){
            $this->db->set('code', $details->code);
        }
        if (!empty($details->transaction_id)) {
            $this->db->set('transaction_id', $details->transaction_id);
        }
        if (!empty($details->order_id)) {
            $this->db->set('order_id', $details->order_id);
        }
        if (!empty($details->authcode)) {
            $this->db->set('authcode', $details->authcode);
        }
        if (!empty($details->amount_approved)) {
            $this->db->set('amount_approved', $details->amount_approved);
        }
        if (!empty($details->token)) {
            $this->db->set('token', $details->token);
        }
        if (!empty($details->message)) {
            $this->db->set('message', $details->message);
        }
        if (!empty($details->status)) {
            if ($details->status == 'approved'){
                $this->db->set('status', 1);
            }elseif ($details->status == 'declined'){
                $this->db->set('status', 2);
            }elseif ($details->status == 'error'){
                $this->db->set('status', 3);
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
