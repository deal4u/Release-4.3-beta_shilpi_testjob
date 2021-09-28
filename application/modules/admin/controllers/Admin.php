<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->model(admin_controller().'admin_model');
        if(!$this->session->userdata('admin_logged_in'))
        {
            redirect(admin_url().'login');
        }
    }
    public function index()
    {
        if (get_session('admin_type') == 2 && (get_session('admin_permissions')['dashboard'] == 'N/A' || get_session('admin_permissions')['dashboard']['view'] == 0)){
            redirect(admin_url().'customers');
        }else{
            $this->load->view('dashboard');
        }
    }
    public function dashboard()
    {
        if (get_session('admin_type') == 2 && (get_session('admin_permissions')['dashboard'] == 'N/A' || get_session('admin_permissions')['dashboard']['view'] == 0)){
            redirect(admin_url().'customers');
        }else{
            $this->load->view('dashboard');
        }
    }
    public function change_password()
    {
        $this->load->view('change_password');
    }
    public function update_password()
    {
        $data = $_POST;
        $this->form_validation->set_rules('old_password', 'Old Password', 'trim|required|xss_clean|callback_check_old_password');
        $this->form_validation->set_rules('new_password', 'New Password', 'trim|required|xss_clean|callback_check_new_password');
        $this->form_validation->set_rules('c_password', 'Confirm Password', 'trim|required|matches[new_password]|xss_clean');
        if ($this->form_validation->run($this) == FALSE)
        {
            $finalResult = array('msg' => 'error', 'response'=>validation_errors());
            echo json_encode($finalResult);
            exit;
        }else{
            $status = $this->admin_model->change_admin_password($data);
            if($status){
                $finalResult = array('msg' => 'success', 'response'=>'Your password successfully changed!');
                echo json_encode($finalResult);
                exit;
            }else{
                $finalResult = array('msg' => 'error', 'response'=>'Something went wrong!');
                echo json_encode($finalResult);
                exit;
            }
        }
    }
    public function check_old_password()
    {
        $data = $_POST;
        $status = $this->admin_model->check_old_password($data);
        if ($status > 0)
        {
            return TRUE;
        }
        else
        {
            $this->form_validation->set_message('check_old_password', 'Old password is wrong.');
            return FALSE;
        }
    }

    public function check_new_password()
    {
        $data = $_POST;
        $status = $this->admin_model->check_new_password($data);
        if ($status > 0)
        {
            $this->form_validation->set_message('check_new_password', 'Your new password must be different.');
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }

    public function admin_users()
    {
        if (get_session('admin_type') == 1 || (get_session('admin_type') == 2 && get_session('admin_permissions')['admin_access'] != 'N/A' && get_session('admin_permissions')['admin_access']['view'] == 1)){
            $data['admins'] = $this->admin_model->get_admins();

            $this->load->view('admin_user/admins', $data);
        }else{
            show_admin404();
        }
    }

    public function add()
    {
        if (get_session('admin_type') == 1 || (get_session('admin_type') == 2 && get_session('admin_permissions')['admin_access'] != 'N/A' && get_session('admin_permissions')['admin_access']['add'] == 1)){
             $data['department'] = $this->admin_model->get_departments();
            $this->load->view('admin_user/add_admin',$data);
        }else{
            show_admin404();
        }
    }

    public function save_admin()
    {
        if (get_session('admin_type') == 1 || (get_session('admin_type') == 2 && get_session('admin_permissions')['admin_access'] != 'N/A' && get_session('admin_permissions')['admin_access']['add'] == 1)){
            if($_POST){
                $data = $this->input->post();
                $this->form_validation->set_rules('firstname', 'First Name', 'trim|required|xss_clean');
                $this->form_validation->set_rules('lastname', 'Last Name', 'trim|required|xss_clean');
                $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|is_unique[admins.Email]', array('required' => 'Email is required.', 'is_unique' => 'Email already associated with another account.'));
                $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]|xss_clean', array('required' => 'Password field is required.' , 'min_length' => 'Password must be 8 characters long.'));
                if ($this->form_validation->run($this) == FALSE)
                {
                    $finalResult = array('msg' => 'error', 'response'=>validation_errors());
                    echo json_encode($finalResult);
                    exit;
                }else{
                    if (!$this->checkEmail($data['email']))
                    {
                        $finalResult = array('msg' => 'error', 'response'=>'Email is Invalid');
                        echo json_encode($finalResult);
                        exit;
                    }
                    $admin_id = $this->admin_model->insert_admin($data);
                    if (isset($data['permissions'])){
                        $this->admin_model->insert_permissions($data['permissions'], $admin_id);
                    }
                    if($admin_id > 0){
                        $finalResult = array('msg' => 'success', 'response'=>"Admin successfully inserted.");
                        echo json_encode($finalResult);
                        exit;
                    }else{
                        $finalResult = array('msg' => 'error', 'response'=>'Something went wrong!');
                        echo json_encode($finalResult);
                        exit;
                    }
                }
            }else{
                show_admin404();
            }
        }else{
            $finalResult = array('msg' => 'error', 'response' => 'Access denied!');
            echo json_encode($finalResult);
            exit;
        }
    }

    public function edit($id='')
    {
        if (get_session('admin_type') == 1 || (get_session('admin_type') == 2 && get_session('admin_permissions')['admin_access'] != 'N/A' && get_session('admin_permissions')['admin_access']['edit'] == 1)){
            if(!empty($id)){
                $details = $this->admin_model->get_admins($id);
                if (!empty($details)){
                    $data['admin'] = $details[0];
                   $data['department'] = $this->admin_model->get_departments();
                    $this->load->view('admin_user/edit_admin' , $data);
                }else{
                    show_admin404();
                }
            }else{
                show_admin404();
            }
        }else{
            show_admin404();
        }

    }

    public function email_exists()
    {
        $data = $_POST;
        $email = $this->admin_model->check_email_update($data);
        if ($email > 0)
        {
            $this->form_validation->set_message('email_exists', 'Email already associated with another account.');
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }

    public function update_admin()
    {
        if (get_session('admin_type') == 1 || (get_session('admin_type') == 2 && get_session('admin_permissions')['admin_access'] != 'N/A' && get_session('admin_permissions')['admin_access']['edit'] == 1)){
            if($_POST){
                $data = $_POST;
                $this->form_validation->set_rules('firstname', 'First Name', 'trim|required|xss_clean');
                $this->form_validation->set_rules('lastname', 'Last Name', 'trim|required|xss_clean');
                $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|callback_email_exists');

                if ($this->form_validation->run($this) == FALSE)
                {
                    $finalResult = array('msg' => 'error', 'response'=>validation_errors());
                    echo json_encode($finalResult);
                    exit;
                }else{
                    if (!$this->checkEmail($data['email']))
                    {
                        $finalResult = array('msg' => 'error', 'response'=>'Email is Invalid');
                        echo json_encode($finalResult);
                        exit;
                    }
                    $admin_status = $this->admin_model->update_admin($data);
                    $this->admin_model->remove_permissions($data['admin_id']);
                    $this->admin_model->update_permissions($data);
                    if($admin_status > 0){
                        $finalResult = array('msg' => 'success', 'response'=>"Admin successfully updated.");
                        echo json_encode($finalResult);
                        exit;
                    }else{
                        $finalResult = array('msg' => 'error', 'response'=>'Something went wrong!');
                        echo json_encode($finalResult);
                        exit;
                    }
                }
            }else{
                show_admin404();
            }
        }else{
            $finalResult = array('msg' => 'error', 'response' => 'Access denied!');
            echo json_encode($finalResult);
            exit;
        }
    }

    public function checkEmail($email) {
        $find1 = strpos($email, '@');
        $find2 = strpos($email, '.');
        return ($find1 !== false && $find2 !== false);
    }

    public function delete_admin()
    {
        if (get_session('admin_type') == 1 || (get_session('admin_type') == 2 && get_session('admin_permissions')['admin_access'] != 'N/A' && get_session('admin_permissions')['admin_access']['delete'] == 1)){
            if($_POST){
                $admin_id = $_POST['admin_id'];
                $status = $this->admin_model->delete_admin($admin_id);
                $this->admin_model->remove_permissions($admin_id);
                if($status > 0){
                    $finalResult = array('msg' => 'success', 'response'=>"Admin successfully deleted.");
                    echo json_encode($finalResult);
                    exit;
                } else {
                    $finalResult = array('msg' => 'error', 'response'=>"Something went wrong please try again.");
                    echo json_encode($finalResult);
                    exit;
                }
            }else{
                show_admin404();
            }
        }else{
            $finalResult = array('msg' => 'error', 'response' => 'Access denied!');
            echo json_encode($finalResult);
            exit;
        }
    }
}
