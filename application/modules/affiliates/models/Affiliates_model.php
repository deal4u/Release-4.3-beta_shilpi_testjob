<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Affiliates_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function add_affiliates($data)
    {
        $this->db->set('company', $data['company']);
        $this->db->set('firstname', $data['first_name']);
        $this->db->set('lastname', $data['last_name']);
        $this->db->set('email', $data['email']);
        $this->db->set('phone', $data['phone']);
        $this->db->set('fax', $data['fax']);
        $this->db->set('address', $data['address']);
        $this->db->set('city', $data['city']);
        $this->db->set('state', $data['state']);
        $this->db->set('zip', $data['zip_code']);
        $this->db->set('status', 0);
        $this->db->set('created_at', date('Y-m-d H-i-s'));
        $this->db->set('updated_at', date('Y-m-d H-i-s'));
        $this->db->insert('affiliaters');
        $inserted_id = $this->db->insert_id();
        return $inserted_id;

    }

}