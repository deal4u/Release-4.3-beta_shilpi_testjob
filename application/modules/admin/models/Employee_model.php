<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
    }


    public function get_employee()
    {
        $this->db->select('*');
        $this->db->from('admins');
        $this->db->where('type!=',1);
        $this->db->order_by('created_at', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }
    
}

/* End of file admin_model.php */
/* Location: ./application/modules/admin/models/admin_model.php */
