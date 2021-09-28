<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payments_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
    }

    public function get_payments()
    {
        $this->db->select('*');
        $this->db->from('payments');
        $this->db->order_by('created_at', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function filter_payments($data)
    {
        $this->db->select('*');
        $this->db->from('payments');
        if (isset($data['agent'])) {
            $this->db->like('rep', $data['agent']);
        }
        if (isset($data['status'])) {
            $this->db->like('status', $data['status']);
        }
        if (isset($data['startdate']) && !empty($data['startdate'])) {
            $start_date = $data['startdate'];
            $this->db->where("DATE_FORMAT(created_at,'%Y-%m-%d') >= '$start_date'",NULL,FALSE);
        }
        if (isset($data['enddate']) && !empty($data['enddate'])) {
            $end_date = $data['enddate'];
            $this->db->where("DATE_FORMAT(created_at,'%Y-%m-%d') <= '$end_date'",NULL,FALSE);
        }
        $this->db->order_by('created_at', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_payment_details($id)
    {
        $this->db->select('*');
        $this->db->from('payments');
        $this->db->where('id',$id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function insert_payment($response, $details, $amount, $rep)
    {
        $this->db->set('customer_id', $details['customer_id']);
        $this->db->set('card_id', $details['card_id']);
        $this->db->set('parent_id', $details['id']);
        $this->db->set('type', 2);
        $this->db->set('rep', $rep);
        if (!empty($response['transactionResponse']['responseCode']) && $response['transactionResponse']['responseCode'] == 1) {
            $this->db->set('amount_approved', $amount);
        }
        if (!empty($response['transactionResponse']['responseCode'])){
            $this->db->set('code', $response['transactionResponse']['responseCode']);
        }
        if (!empty($response['transactionResponse']['refTransID'])) {
            $this->db->set('transaction_id', $response['transactionResponse']['refTransID']);
        }
        if (!empty($response['transactionResponse']['messages'][0]['description'])) {
            $this->db->set('message', $response['transactionResponse']['messages'][0]['description']);
        }elseif (!empty($response['transactionResponse']['errors'][0]['errorText'])){
            $this->db->set('message', $response['transactionResponse']['errors'][0]['errorText']);
        }
        if (!empty($response['transactionResponse']['messages'][0]['code'])) {
            $result_code = $response['transactionResponse']['messages'][0]['code'];
            if ($result_code == 1){
                $this->db->set('status', 1);
            }
        }elseif (!empty($response['transactionResponse']['errors'])){
            $result_code = $response['transactionResponse']['errors'][0]['errorCode'];
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

    public function insert_void($response, $details, $rep)
    {
        $this->db->set('customer_id', $details['customer_id']);
        $this->db->set('card_id', $details['card_id']);
        $this->db->set('parent_id', $details['id']);
        $this->db->set('payment_mode', $details['payment_mode']);
        $this->db->set('type', 3);
        $this->db->set('rep', $rep);
        if (!empty($response['transactionResponse']['responseCode'])){
            $this->db->set('code', $response['transactionResponse']['responseCode']);
        }
        if (!empty($response['transactionResponse']['refTransID'])) {
            $this->db->set('transaction_id', $response['transactionResponse']['refTransID']);
        }
        if (!empty($response['transactionResponse']['messages'][0]['description'])) {
            $this->db->set('message', $response['transactionResponse']['messages'][0]['description']);
        }elseif (!empty($response['transactionResponse']['errors'][0]['errorText'])){
            $this->db->set('message', $response['transactionResponse']['errors'][0]['errorText']);
        }
        if (!empty($response['transactionResponse']['messages'][0]['code']) && $response['transactionResponse']['messages'][0]['code'] == 1) {
            $result_code = $response['transactionResponse']['messages'][0]['code'];
            if ($result_code == 1){
                $this->db->set('status', 1);
            }
        }elseif (!empty($response['transactionResponse']['errors'])){
            $result_code = $response['transactionResponse']['errors'][0]['errorCode'];
            if ($result_code == 11 || $result_code == 8){
                $this->db->set('status', 2);
            }elseif ($result_code == 5 || $result_code == 6){
                $this->db->set('status', 3);
            }else{
                $this->db->set('status', 4);
            }
        }else{
            $this->db->set('status', 4);
        }
        $this->db->set('created_at', date('Y-m-d H-i-s'));
        $card_id = $this->db->insert('payments');
        return $card_id;
    }
}
