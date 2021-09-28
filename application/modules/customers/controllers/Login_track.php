<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_track extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->model(admin_controller().'track_model');
        if(!$this->session->userdata('admin_logged_in'))
        {
            redirect(admin_url().'login');
        }
    }

    public function index()
    {
        if (get_session('admin_type') == 1 || (get_session('admin_type') == 2 && get_session('admin_permissions')['admin_access'] != 'N/A' && get_session('admin_permissions')['admin_access']['view'] == 1)){
            $data['track'] = $this->track_model->get_activities();
            $this->load->view('login_track/login_track', $data);
        }else{
            show_admin404();
        }
    }


}