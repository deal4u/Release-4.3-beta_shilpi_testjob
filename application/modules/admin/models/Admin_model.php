<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
    }

    public function change_admin_password($data)
    {
        $hash_pass="password('".$data['new_password']."')";
        $this->db->set('Password',$hash_pass, FALSE);
        $this->db->where('id', $this->session->userdata('admin_id'));
        $result = $this->db->update('admins');
        return $this->db->affected_rows();
    }
    public function check_old_password($data)
    {
        $hash_pass="password('".$data['old_password']."')";
        $this->db->select('*');
        $this->db->where('Password',$hash_pass,FALSE);
        $this->db->where('id', $this->session->userdata('admin_id'));
        $query = $this->db->get('admins');
        return $query->num_rows();
    }
    public function check_new_password($data)
    {
        $hash_pass="password('".$data['new_password']."')";
        $this->db->select('*');
        $this->db->where('Password',$hash_pass,FALSE);
        $this->db->where('id', $this->session->userdata('admin_id'));
        $query = $this->db->get('admins');
        return $query->num_rows();
    }
    public function get_admins($id = "")
    {
        $this->db->select('*');
        $this->db->from('admins');
        if ($id!=""){
            $this->db->where('id',$id);
        }
        $this->db->where('type!=',1);
        $this->db->order_by('created_at', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }
    /******Shilpi*************/
    public function get_departments()
    {
        $this->db->select('department');
        $this->db->from('general_settings');
        $query = $this->db->get();
        return $query->result();
    }
    public function insert_admin($data)
    {
        $admin_name = $data['firstname'].' '.$data['lastname'];
        $hash_pass="password('".trim($data['password'])."')";
        $access_pass = "'".base64_encode(trim($data['password']))."'";

        $this->db->set('FirstName', $data['firstname']);
        $this->db->set('LastName', $data['lastname']);
        $this->db->set('AdminName', $admin_name);
        $this->db->set('Email', $data['email']);
        $this->db->set('Password',$hash_pass, FALSE);
        $this->db->set('access_code',$access_pass, FALSE);
        $this->db->set('phone', $data['phone']);
        $this->db->set('city', $data['city']);
        $this->db->set('address', $data['address']);
         $this->db->set('department', $data['department']);
          $this->db->set('ext', $data['ext']);
        $this->db->set('status', $data['status']);
        $this->db->set('type', 2);
        $this->db->set('created_at', date('Y-m-d H-i-s'));
        $this->db->insert('admins');
        $user_id = $this->db->insert_id();

        $admin_id = 'R61'.str_pad($user_id, 3, '0', STR_PAD_LEFT);

        $this->db->set('AdminID', $admin_id);
        $this->db->where('id' , $user_id);
        $this->db->update('admins');
        return $user_id;
    }

    public function insert_permissions($permissions, $admin)
    {
        foreach ($permissions as $permission=>$value){
            $this->db->set('admin_id' , $admin);
            if ($permission != 'other'){
                $this->db->set('module' , $permission);
                if (isset($value["view"])){
                    $this->db->set('view',1);
                }
                if (isset($value["add"])){
                    $this->db->set('add',1);
                }
                if (isset($value["edit"])){
                    $this->db->set('edit',1);
                }
                if (isset($value["delete"])){
                    $this->db->set('delete',1);
                }
            }else{
                $this->db->set('module' , $permission);
                $other = $permissions['other'];
                $this->db->set('miscellaneous',json_encode($other));
            }
            $this->db->insert('admin_permissions');
        }
    }

    public function check_email_update($data)
    {
        $this->db->select('*');
        $this->db->where('id !=',$data['admin_id']);
        $this->db->where('Email',$data['email']);
        $query = $this->db->get('admins');
        return $query->num_rows();
    }

    public function update_admin($data)
    {
        $admin_name = $data['firstname'].' '.$data['lastname'];
        $hash_pass="password('".trim($data['password'])."')";

        $this->db->set('FirstName', $data['firstname']);
        $this->db->set('LastName', $data['lastname']);
        $this->db->set('AdminName', $admin_name);
        $this->db->set('Email', $data['email']);
        if (isset($data['status'])) {
            $this->db->set('status', $data['status']);
        }
        $this->db->set('phone', $data['phone']);
        $this->db->set('city', $data['city']);
        $this->db->set('address', $data['address']);
        $this->db->set('updated_at', date('Y-m-d H-i-s'));
        if($data['password'] != ''){
            $this->db->set('Password',$hash_pass, FALSE);
        }
        $this->db->where('id' , $data['admin_id']);
        $query = $this->db->update('admins');
        return $this->db->affected_rows();
    }

    public function remove_permissions($admin_id)
    {
        $this->db->where('admin_id', $admin_id);
        $query = $this->db->delete('admin_permissions');
        return $this->db->affected_rows();
    }

    public function update_permissions($data)
    {
        if (isset($data['permissions'])){
            foreach ($data['permissions'] as $permission=>$value){
                $this->db->set('admin_id' , $data['admin_id']);
                if ($permission != 'other'){
                    $this->db->set('module' , $permission);
                    if (isset($value["view"])){
                        $this->db->set('view',1);
                    }
                    if (isset($value["add"])){
                        $this->db->set('add',1);
                    }
                    if (isset($value["edit"])){
                        $this->db->set('edit',1);
                    }
                    if (isset($value["delete"])){
                        $this->db->set('delete',1);
                    }
                }else{
                    $this->db->set('module' , $permission);
                    $other = $data['permissions']['other'];
                    $this->db->set('miscellaneous',json_encode($other));
                }
                $this->db->insert('admin_permissions');
            }
        }
    }

    public function delete_admin($admin_id)
    {
        $this->db->where('id', $admin_id);
        $query = $this->db->delete('admins');
        return $this->db->affected_rows();
    }
}

/* End of file admin_model.php */
/* Location: ./application/modules/admin/models/admin_model.php */
