<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Invoice extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model(admin_controller() . 'invoice_model');
        $this->load->model('common/common_model');
        if (!$this->session->userdata('admin_logged_in')) {
            redirect(admin_url() . 'login');
        }
        $this->customer_type = 1;
        $this->vendor_type = 2;
        if (get_session('admin_type') == 2 && (get_session('admin_permissions')['invoice'] == 'N/A' || get_session('admin_permissions')['invoice']['view'] == 0)){
            redirect(admin_url());
        }
    }

    public function vendor()
    {
        if (get_session('admin_type') == 1 || (get_session('admin_type') == 2 && get_session('admin_permissions')['invoice'] != 'N/A' && get_session('admin_permissions')['invoice']['view'] == 1)){
            $data['invoice_data'] = $this->invoice_model->get_invoice($this->vendor_type);
            $this->load->view('invoice/vendor_invoice',$data);
        }else{
            show_admin404();
        }
    }



    public function search_vendor_invoice()
    {
        $data['param'] = $this->input->get();
        if (!empty($data)){
            $data['invoice_data'] = $this->invoice_model->search_invoice($data['param'],$this->vendor_type);
            $this->load->view('invoice/vendor_invoice', $data);
        }else{
            show_admin404();
        }
    }

    public function update_vendor_auth_net()
    {
        if (get_session('admin_type') == 1 || (get_session('admin_type') == 2 && get_session('admin_permissions')['invoice'] != 'N/A' && get_session('admin_permissions')['invoice']['edit'] == 1)){
            $auth_net = $this->invoice_model->update_auth_net($_POST);
            if($auth_net){
                $finalResult = array('msg' => 'success', 'response'=>'Auth Net Updated!');
                echo json_encode($finalResult);
                exit;
            }else{
                $finalResult = array('msg' => 'error', 'response'=>'Something went wrong!');
                echo json_encode($finalResult);
                exit;
            }
        }else{
            $finalResult = array('msg' => 'error', 'response' => 'Access denied!');
            echo json_encode($finalResult);
            exit;
        }
    }

    public function update_vendor_invoice_status()
    {
        if (get_session('admin_type') == 1 || (get_session('admin_type') == 2 && get_session('admin_permissions')['invoice'] != 'N/A' && get_session('admin_permissions')['invoice']['edit'] == 1)){
            $status = $this->invoice_model->change_invoice_status($_POST);
            if($status){
                $finalResult = array('msg' => 'success', 'response'=>'Status changed!');
                echo json_encode($finalResult);
                exit;
            }else{
                $finalResult = array('msg' => 'error', 'response'=>'Something went wrong!');
                echo json_encode($finalResult);
                exit;
            }
        }else{
            $finalResult = array('msg' => 'error', 'response' => 'Access denied!');
            echo json_encode($finalResult);
            exit;
        }
    }


    public function update_vendor_multipe_invoice()
    {
        if (get_session('admin_type') == 1 || (get_session('admin_type') == 2 && get_session('admin_permissions')['invoice'] != 'N/A' && get_session('admin_permissions')['invoice']['edit'] == 1)){
            if($_POST){
                $update_status = $this->invoice_model->update_multiple($_POST,$this->vendor_type);
                if($update_status > 0){
                    $finalResult = array('msg' => 'success', 'response'=>"Invoice successfully updated.");
                    echo json_encode($finalResult);
                    exit;
                }else{
                    $finalResult = array('msg' => 'error', 'response'=>'Something went wrong!');
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
    public function customer()
    {
        if (get_session('admin_type') == 1 || (get_session('admin_type') == 2 && get_session('admin_permissions')['invoice'] != 'N/A' && get_session('admin_permissions')['invoice']['view'] == 1)){
            $data['invoice_data'] = $this->invoice_model->get_invoice($this->customer_type);
            $this->load->view('invoice/customer_invoice',$data);
        }else{
            show_admin404();
        }
    }

    public function search_customer_invoice()
    {
        $data['param'] = $this->input->get();
        if (!empty($data)){
            $data['invoice_data'] = $this->invoice_model->search_invoice($data['param'],$this->customer_type);
            $this->load->view('invoice/customer_invoice', $data);
        }else{
            show_admin404();
        }
    }
    public function update_customer_invoice_status()
    {
        if (get_session('admin_type') == 1 || (get_session('admin_type') == 2 && get_session('admin_permissions')['invoice'] != 'N/A' && get_session('admin_permissions')['invoice']['edit'] == 1)){
            $status = $this->invoice_model->change_invoice_status($_POST);
            if($status){
                $finalResult = array('msg' => 'success', 'response'=>'Status changed!');
                echo json_encode($finalResult);
                exit;
            }else{
                $finalResult = array('msg' => 'error', 'response'=>'Something went wrong!');
                echo json_encode($finalResult);
                exit;
            }
        }else{
            $finalResult = array('msg' => 'error', 'response' => 'Access denied!');
            echo json_encode($finalResult);
            exit;
        }
    }

    public function update_customer_multipe_invoice()
    {
        if (get_session('admin_type') == 1 || (get_session('admin_type') == 2 && get_session('admin_permissions')['invoice'] != 'N/A' && get_session('admin_permissions')['invoice']['edit'] == 1)){
            if($_POST){
                $update_status = $this->invoice_model->update_multiple($_POST,$this->customer_type);
                if($update_status > 0){
                    $finalResult = array('msg' => 'success', 'response'=>"Invoice successfully updated.");
                    echo json_encode($finalResult);
                    exit;
                }else{
                    $finalResult = array('msg' => 'error', 'response'=>'Something went wrong!');
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
