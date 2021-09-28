<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Employee extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model(admin_controller() . 'employee_model');
        if (!$this->session->userdata('admin_logged_in')) {
            redirect(admin_url() . 'login');
        }
    }

    public function index()
    {
       $data['employee'] = $this->employee_model->get_employee();
        $this->load->view('admin/employee/employee', $data);
    }
}