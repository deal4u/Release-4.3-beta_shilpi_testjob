<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Customers extends CI_Controller
{    function __construct(){
        parent::__construct();
        $this->load->library('customers/login_lib');
        $this->load->model('customers/login_model');
        $this->load->model('customers/customer_model');
        $this->load->model('common/common_model');
        if (!$this->session->userdata('admin_logged_in'))
        {
            redirect(base_url() . 'customers/login');
        }
    }
    public function index(){
        $id = $this->session->userdata('id');
        $data['customers'] = $this->customer_model->get_plan_policy_data($id);
        $this->load->view('dashboard', $data);
    }
    public function dashboard($ids)
    {
        if (isset($ids) && $ids != "")
        {
             $data['idx'] = $this->session->userdata('id');
             $data['renewal_id'] = $ids;
            $data['profile_data'] = $this->customer_model->get_policy_data( $data['idx'],$ids);
            $this->load->view('plan_details', $data);
        }
        else
        {
            $id = $this->session->userdata('id');
            $data['customers'] = $this->customer_model->get_plan_policy_data($id);
            $this->load->view('dashboard', $data);
        }
    }
    public function change_password()
    {
        $this->load->view('change_password');
    }
    public function edit_profile()
    {
        $id = $this->session->userdata('id');
        $data['customers'] = $this->customer_model->get_plan_policy_data($id);
        $this->load->view('edit_profile', $data);
    }
    public function update_password()
    {
        $data = $_POST;
        $this->form_validation->set_rules('old_password', 'Old Password', 'trim|required|xss_clean|callback_check_old_password');
        $this->form_validation->set_rules('new_password', 'New Password', 'trim|required|xss_clean|callback_check_new_password');
        $this->form_validation->set_rules('c_password', 'Confirm Password', 'trim|required|matches[new_password]|xss_clean');
        if ($this->form_validation->run($this) == false)
        {
            $finalResult = array(
                'msg' => 'error',
                'response' => validation_errors()
            );
            echo json_encode($finalResult);
            exit;
        }
        else
        {
            $status = $this->customer_model->change_admin_password($data);
            if ($status)
            {
                $finalResult = array(
                    'msg' => 'success',
                    'response' => 'Your password successfully changed!'
                );
                echo json_encode($finalResult);
                exit;
            }
            else
            {
                $finalResult = array(
                    'msg' => 'error',
                    'response' => 'Something went wrong!'
                );
                echo json_encode($finalResult);
                exit;
            }
        }
    }
    public function check_old_password()
    {
        $data = $_POST;
        $status = $this->customer_model->check_old_password($data);
        if ($status > 0)
        {
            return true;
        }
        else
        {
            $this->form_validation->set_message('check_old_password', 'Old password is wrong.');
            return false;
        }
    }
    public function check_new_password()
    {
        $data = $_POST;
        $status = $this->customer_model->check_new_password($data);
        if ($status > 0)
        {
            $this->form_validation->set_message('check_new_password', 'Your new password must be different.');
            return false;
        }
        else
        {
            return true;
        }
    }
    public function update()
    {
        if ($_POST)
        {
            $data = $_POST;
            $this->form_validation->set_rules('home_phone', 'Home Phone', 'trim|required|xss_clean');
            $this->form_validation->set_rules('work_phone', 'Work Phone', 'trim|required|xss_clean');
            $this->form_validation->set_rules('email', 'Primary Email', 'trim|required|xss_clean');
            $this->form_validation->set_rules('mail_address', 'Mailing Address', 'trim|required|xss_clean');
            $this->form_validation->set_rules('mail_city', 'Mailing City', 'trim|required|xss_clean');
            $this->form_validation->set_rules('mail_state', 'Mailing State', 'trim|required|xss_clean');
            $this->form_validation->set_rules('mail_zipcode', 'Mailing Zip Code', 'trim|required|xss_clean');
            if ($this->form_validation->run($this) == false)
            {
                $finalResult = array(
                    'msg' => 'error',
                    'response' => validation_errors()
                );
                echo json_encode($finalResult);
                exit;
            }
            else
            {
                if (!$this->checkEmail($data['email']))
                {
                    $finalResult = array(
                        'msg' => 'error',
                        'response' => 'Email is Invalid'
                    );
                    echo json_encode($finalResult);
                    exit;
                }
                $customer_status = $this->customer_model->update_customer($data);
                if ($customer_status > 0)
                {
                    $finalResult = array(
                        'msg' => 'success',
                        'response' => "Customer successfully updated."
                    );
                    echo json_encode($finalResult);
                    exit;
                }
                else
                {
                    $finalResult = array(
                        'msg' => 'error',
                        'response' => 'Something went wrong!'
                    );
                    echo json_encode($finalResult);
                    exit;
                }
            }
        }
        else
        {
            show_admin404();
        }
    }
    public function checkEmail($email)
    {
        $find1 = strpos($email, '@');
        $find2 = strpos($email, '.');
        return ($find1 !== false && $find2 !== false);
    }
    public function make_claim()
    {
        $this->load->view('make_claim');
    }
    public function claim_status()
    {
        $this->load->view('claim_status');
    }
}