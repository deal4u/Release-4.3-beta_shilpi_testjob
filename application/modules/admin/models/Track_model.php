<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Track_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
    }

    public function get_activities($type)
    {
        $this->db->select('*');
        $this->db->from('login_activities');
        $this->db->where('login_type', $type);
        $this->db->order_by('created_at', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }
}