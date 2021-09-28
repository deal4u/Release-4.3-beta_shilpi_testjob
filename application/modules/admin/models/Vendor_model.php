<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vendor_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
    }

    public function get_vendors($id="")
    {
        $this->db->select('*');
        $this->db->from('vendors');
        if ($id!=""){
            $this->db->where('id',$id);
        }
        $this->db->order_by('created_at', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_services($id="")
    {
        $this->db->select('service');
        $this->db->from('vendor_services');
        $this->db->where('vendor',$id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function insert_vendor($data)
    {
        $this->db->set('name', $data['name']);
        $this->db->set('company', $data['company']);
        $this->db->set('email', $data['email']);
        $this->db->set('phone', $data['phone']);
        $this->db->set('fax', $data['fax']);
        $this->db->set('street_address', $data['address']);
        $this->db->set('city', $data['city']);
        $this->db->set('state', $data['state']);
        $this->db->set('zip_code', $data['zip_code']);
        $this->db->set('travel_miles', $data['travel_miles']);
        $this->db->set('diagosis_fee', $data['diagosis_fee']);
        $this->db->set('status', $data['status']);
        $this->db->set('created_at', date('Y-m-d H-i-s'));
        $this->db->insert('vendors');
        return $this->db->insert_id();
    }

    public function update_vendor($data)
    {
        $this->db->set('name', $data['name']);
        $this->db->set('company', $data['company']);
        $this->db->set('email', $data['email']);
        $this->db->set('phone', $data['phone']);
        $this->db->set('fax', $data['fax']);
        $this->db->set('street_address', $data['address']);
        $this->db->set('city', $data['city']);
        $this->db->set('state', $data['state']);
        $this->db->set('zip_code', $data['zip_code']);
		$this->db->set('travel_miles', $data['travel_miles']);
        $this->db->set('diagosis_fee', $data['diagosis_fee']);
        if (isset($data['status'])){
            $this->db->set('status', $data['status']);
        }
        $this->db->set('updated_at', date('Y-m-d H-i-s'));
        $this->db->where('id' , $data['id']);
        $query = $this->db->update('vendors');
        return $this->db->affected_rows();
    }

    public function insert_services($services, $vendor)
    {
        foreach ($services as $service){
            $this->db->set('vendor', $vendor);
            $this->db->set('service', $service);
            $this->db->set('created_at', date('Y-m-d H-i-s'));
            $this->db->insert('vendor_services');
        }
        return true;
    }

    public function delete_services($id)
    {
        $this->db->where('vendor', $id);
        $query = $this->db->delete('vendor_services');
        return true;
    }

    public function update_services($services, $vendor)
    {
        foreach ($services as $service){
            $this->db->set('vendor', $vendor);
            $this->db->set('service', $service);
            $this->db->set('created_at', date('Y-m-d H-i-s'));
            $this->db->insert('vendor_services');
        }
        return true;
    }

    public function delete_zip_codes_serviced($vendor_id)
    {
        $this->db->where('meta_tag', 'vendor_zip_codes');
        $this->db->where('meta_key', $vendor_id);
        $query = $this->db->delete('general_settings');
        return true;
    }

    public function insert_zip_codes_serviced($data, $vendor_id)
    {
        $zip_codes = explode(',',$data['zip_codes_serviced']);
        foreach($zip_codes as $value){
            if ($value == ''){
                continue;
            }
            $this->db->set('meta_tag', 'vendor_zip_codes');
            $this->db->set('meta_key', $vendor_id);
            $this->db->set('meta_value', $value);
            $query = $this->db->insert('general_settings');
        }
        return true;
    }

    public function update_zip_codes_serviced($data, $vendor_id)
    {
        $zip_codes = explode(',',$data['zip_codes_serviced']);
        foreach($zip_codes as $value){
            if ($value == ''){
                continue;
            }
            $this->db->set('meta_tag', 'vendor_zip_codes');
            $this->db->set('meta_key', $vendor_id);
            $this->db->set('meta_value', $value);
            $query = $this->db->insert('general_settings');
        }
        return true;
    }

    public function get_vendors_claims($id)
    {
        $this->db->select('*');
        $this->db->from('claims');
        $this->db->where('vendor', $id);
        $this->db->order_by('created_at', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function delete_claim_files($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->delete('claim_files');
        return $this->db->affected_rows();
    }
    
    public function insert_image($data)
    {
        $this->db->set('vendor_id',$data['vendor_file']);
        $this->db->set('name', $data['image_alt']);
        $this->db->set('file', $data['image']);
        $this->db->set('created_at', date('Y-m-d H-i-s'));
        return  $this->db->insert('claim_files');
    }

    public function delete_vendor($vendor_id){
        $this->db->set('is_deleted', '1');
        $this->db->set('updated_at', date('Y-m-d H-i-s'));
        $this->db->where('id' , $vendor_id);
        $query = $this->db->update('vendors');
        return $this->db->affected_rows();
    }
}
