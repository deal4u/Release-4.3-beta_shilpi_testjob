<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Task_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
    }

    public function get_tasks()
    {
        $this->db->select('*');
        $this->db->from('tasks_notes');
        $this->db->where('type',1);
        $this->db->where('status',1);
        if (get_session('admin_type') != 1){
            $this->db->where('assign_to',get_session('admin_id'));
        }
        $this->db->order_by('created_at', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function insert_task($data)
    {
        $this->db->set('customer', $data['customer']);
        $this->db->set('claim', $data['claim']);
        $this->db->set('assign_by', $this->session->userdata('admin_id'));
        if ($data['type']==1){
            $this->db->set('assign_to', $data['assign_to']);
        }  
		if (isset($data['show_portal'])){
            $this->db->set('show_portal', $data['show_portal']);
        }
        $this->db->set('details', $data['text']);
        $this->db->set('type', $data['type']);
        $this->db->set('created_at', date('Y-m-d H-i-s'));
        $this->db->insert('tasks_notes');
        return $this->db->insert_id();
    }

    public function insert_notes($data)
    {
        $this->db->set('customer', isset($data['customer'])?$data['customer']:NULL);
        $this->db->set('vendor', isset($data['vendor'])?$data['vendor']:NULL);
        $this->db->set('claim', isset($data['claim'])?$data['claim']:NULL);
        // $this->db->set('customer', $data['customer']);
        $this->db->set('assign_by', $this->session->userdata('admin_id'));
        $this->db->set('details', $data['text']);
        if ($data['type']==1){
            $this->db->set('assign_to', $data['assign_to']);
        }
		
        $this->db->set('type', $data['type']);
        $this->db->set('show_portal', isset($data['show_portal'])?$data['show_portal']:0);
        $this->db->set('created_at', date('Y-m-d H-i-s'));
        $this->db->insert('tasks_notes');
        return $this->db->insert_id();
    }

    public function update_task($data)
    {
        if (isset($data['task_status'])){
            if ($data['task_status'] == '2'){
                $this->db->set('close_date', date('Y-m-d H-i-s'));
            }
            $this->db->set('status', $data['task_status']);
        }
        if (get_session('admin_type') == 1 || (get_session('admin_type') == 2 && get_session('admin_permissions')['miscellaneous'] != 'N/A' && isset(get_session('admin_permissions')['miscellaneous']->forward_task))) {
            $this->db->set('assign_to', $data['assign_to']);
        }
        $this->db->set('updated_at', date('Y-m-d H-i-s'));
        $this->db->where('id' , $data['task']);
        $query = $this->db->update('tasks_notes');
        return $this->db->affected_rows();
    }

    public function update_status($data)
    {
        if ($data['status'] == '2'){
            $this->db->set('close_date', date('Y-m-d H-i-s'));
        }
        $this->db->set('status', $data['status']);
        $this->db->set('updated_at', date('Y-m-d H-i-s'));
        $this->db->where('id' , $data['id']);
        $query = $this->db->update('tasks_notes');
        return $this->db->affected_rows();
    }

    public function search_task($data)
    {
        $this->db->select('*');
        $this->db->from('tasks_notes');
        $this->db->where('type',1);
        if (isset($data['task_status'])) {
            $this->db->like('status', $data['task_status']);
        }
        if (get_session('admin_type') != 1){
            $this->db->where('assign_to',get_session('admin_id'));
        }
        if (isset($data['task_person'])) {
            $this->db->like('assign_to', $data['task_person']);
        }
        $this->db->order_by('created_at', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function update_multiple($data)
    {
        foreach ($data['update'] as $update){
            if ($data['status'] == '2'){
                $this->db->set('close_date', date('Y-m-d H-i-s'));
            }
            if ($data['status']!=""){
                $this->db->set('status', $data['status']);
                $this->db->set('updated_at', date('Y-m-d H-i-s'));
            }
            if (get_session('admin_type') == 1 || (get_session('admin_type') == 2 && get_session('admin_permissions')['miscellaneous'] != 'N/A' && isset(get_session('admin_permissions')['miscellaneous']->forward_task))) {
                if ($data['assign_to'] != "") {
                    $this->db->set('assign_to', $data['assign_to']);
                    $this->db->set('updated_at', date('Y-m-d H-i-s'));
                }
            }
            $this->db->where('id' , $update);
            $this->db->where('type',1);
            $query = $this->db->update('tasks_notes');
        }
        return true;
    }
}
