<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Become_contractor_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function add_contractors($data)
    {
        $this->db->set('company', $data['company']);
        $this->db->set('name', $data['name']);
        $this->db->set('email', $data['email']);
        $this->db->set('phone', $data['phone']);
        $this->db->set('fax', $data['fax']);
        $this->db->set('street_address', $data['address']);
        $this->db->set('city', $data['city']);
        $this->db->set('state', $data['state']);
        $this->db->set('zip_code', $data['zip_code']);
        $this->db->set('status', 0);
        $this->db->set('created_at', date('Y-m-d H-i-s'));
        $this->db->set('updated_at', date('Y-m-d H-i-s'));
        $this->db->insert('vendors');
        $contractor_id = $this->db->insert_id();

        if ($contractor_id > 0) {
            foreach ($data['opt_service'] as $service){
                $this->db->set('vendor', $contractor_id);
                $this->db->set('service', $service);
                $this->db->set('created_at', date('Y-m-d H-i-s'));
                $this->db->set('updated_at', date('Y-m-d H-i-s'));
                $this->db->insert('vendor_services');
            }
            foreach($data["zip_codes_serviced"] as $value){
                $this->db->set('meta_tag', 'vendor_zip_codes');
                $this->db->set('meta_key', $contractor_id);
                $this->db->set('meta_value', $value);
                $this->db->insert('general_settings');
            }
        }else{
            return false;
        }
        return $contractor_id;

    }

}