<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Invoice_model extends CI_Model
{

	public function __construct() {
		parent::__construct();
	}

	public function get_invoice($auth_id){

		$this->db->select('*');
		$this->db->from('claim_auth');
		$this->db->where('auth_for',$auth_id);
		$this->db->order_by('created_at', 'DESC');
		$query = $this->db->get();
		return $query->result_array();
	}
	public function search_invoice($data,$auth_id){
		$this->db->select('claim_auth.*');
		$this->db->from('claim_auth');
		if(isset($data['first_name']) || isset($data['last_name']) || isset($data['customer_status'])){
			$this->db->join('claims', 'claim_auth.claim = claims.id', 'left');
			$this->db->join('customers', 'claims.customer = customers.id', 'left');
		}
		if(isset($data['name']) || isset($data['vendor_status'])){
			$this->db->join('claims', 'claim_auth.claim = claims.id', 'left');
			$this->db->join('vendors', 'claims.vendor = vendors.id', 'left');
		}
		if (!empty($data['claim_num'])) {
			$this->db->join('claims c', 'claim_auth.claim = c.id', 'left');
			$this->db->like('c.claim_num', $data['claim_num']);
		}
		if (isset($data['first_name'])) {
			$this->db->like('customers.first_name', $data['first_name']);
		}
		if (isset($data['name'])) {
			$this->db->like('vendors.name', $data['name']);
		}
		if (isset($data['last_name'])) {
			$this->db->like('customers.last_name', $data['last_name']);
		}
		if (isset($data['customer_status'])) {
			if ($data['customer_status']==2){
				$status=0;
			} elseif($data['customer_status']==1) {
				$status=1;
			} else{
				$status='';
			}
			$this->db->like('customers.status', $status);
		}
		if (isset($data['vendor_status'])) {
			if ($data['vendor_status']==2){
				$status=0;
			} elseif($data['vendor_status']==1) {
				$status=1;
			} else{
				$status='';
			}
			$this->db->like('vendors.status', $status);
		}
		if (isset($data['invoice_status'])) {
			$this->db->like('claim_auth.status', $data['invoice_status']);
		}
		if (isset($data['auth_net'])) {
			$this->db->like('claim_auth.auth_net', $data['auth_net']);
		}
		if (isset($data['invoice_type'])) {
			$this->db->like('claim_auth.type', $data['invoice_type']);
		}
		if (!empty($data['start_date']) && empty($data['end_date'])) {
			$this->db->where('DATE(claim_auth.created_at) >=', $data['start_date']);
		}
		if (empty($data['start_date'])  && !empty($data['end_date'])) {
			$this->db->where('DATE(claim_auth.created_at) <=', $data['end_date']);
		}
		if (!empty($data['start_date']) && !empty($data['end_date'])) {
			$this->db->where('DATE(claim_auth.created_at) >=', $data['start_date']);
			$this->db->where('DATE(claim_auth.created_at) <=', $data['end_date']);
		}
		$this->db->where('auth_for',$auth_id);
		$this->db->order_by('claim_auth.created_at', 'DESC');
		$this->db->group_by('claim_auth.id');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function change_invoice_status($data){
		$this->db->set('status',$data['status']);
		$this->db->set('updated_at', date('Y-m-d H-i-s'));
		$this->db->where('id', $data['id']);
		$result = $this->db->update('claim_auth');
		return $this->db->affected_rows();
	}
	public function update_multiple($data,$auth_id) {
		foreach ($data['update'] as $update){
			if ($data['status']!=""){
				$this->db->set('status', $data['status']);
				$this->db->set('updated_at', date('Y-m-d H-i-s'));
			}
			$this->db->where('auth_for',$auth_id);
			$this->db->where('id' , $update);
			$query = $this->db->update('claim_auth');
		}
		return true;

	}
	public function update_auth_net($data) {
		$this->db->set('auth_net',$data['auth_net']);
		$this->db->set('updated_at', date('Y-m-d H-i-s'));
		$this->db->where('id', $data['id']);
		$result = $this->db->update('claim_auth');
		return $this->db->affected_rows();
	}
}
