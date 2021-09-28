<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//require_once APPPATH . '../vendor/autoload.php';
class Payments extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model(admin_controller() . 'payments_model');
        $this->load->model('common/common_model');
        if (!$this->session->userdata('admin_logged_in')) {
            redirect(admin_url() . 'login');
        }
        if (get_session('admin_type') == 2 && (get_session('admin_permissions')['payment'] == 'N/A' || get_session('admin_permissions')['payment']['view'] == 0)){
            redirect(admin_url());
        }
    }

    public function index()
    {
        if (get_session('admin_type') == 1 || (get_session('admin_type') == 2 && get_session('admin_permissions')['payment'] != 'N/A' && get_session('admin_permissions')['payment']['view'] == 1)){
            $data['payments'] = $this->payments_model->get_payments();
            $this->load->view('payments/payments', $data);
        }else{
            show_admin404();
        }
    }

    public function filter_payments()
    {
        $data['param'] = $this->input->get();
        if (isset($data['param']['daterange'])){
            $dates = str_replace(' ', '', $data['param']['daterange']);
            $dates = explode('-',$dates);
            $data['param']['startdate'] = date("Y-m-d", strtotime($dates[0]));
            $data['param']['enddate'] = date("Y-m-d", strtotime($dates[1]));
        }
        if (!empty($data)){
            $data['payments'] = $this->payments_model->filter_payments($data['param']);
            if ($data['param']['startdate'] == ''){
                $data['param']['startdate'] = date("m-d-Y");
                $data['param']['enddate'] = date("m-d-Y");
            }else{
                $data['param']['startdate'] = date("m-d-Y", strtotime($data['param']['startdate']));
                $data['param']['enddate'] = date("m-d-Y", strtotime($data['param']['enddate']));
            }

            $this->load->view('payments/payments', $data);
        }else{
            show_admin404();
        }
    }

    public function refund()
    {
        if (get_session('admin_type') == 1 || (get_session('admin_type') == 2 && get_session('admin_permissions')['invoice'] != 'N/A' && get_session('admin_permissions')['invoice']['edit'] == 1)){
            if ($_POST) {
                $data = $this->input->post();
				
                $payment_details = $this->payments_model->get_payment_details($data['id']);
				if ($data['amount'] <= $payment_details['amount_approved']){
                    $rep = $this->session->userdata('admin_id');
					$mode = 'ems_model';
					$this->load->model(admin_controller() . $mode);
					$finalResult =  $this->$mode->refund_payment($payment_details, $data['amount'], $rep);
					
					echo json_encode($finalResult);
                    exit;
                }else{
                    $finalResult = array('msg' => 'error', 'response' => 'Refund amount must pe smaller then payment');
                    echo json_encode($finalResult);
                    exit;
                }
            } else {
                show_admin404();
            }
        }else{
            $finalResult = array('msg' => 'error', 'response' => 'Access denied!');
            echo json_encode($finalResult);
            exit;
        }
    }

    public function save_payment($details, $response, $amount, $rep)
    {
        $response = json_decode( preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $response), true );
        $this->payments_model->insert_payment($response ,$details ,$amount, $rep);
    }

    public function void()
    {
        if (get_session('admin_type') == 1 || (get_session('admin_type') == 2 && get_session('admin_permissions')['invoice'] != 'N/A' && get_session('admin_permissions')['invoice']['edit'] == 1)){
            if ($_POST) {
                $data = $this->input->post();
                $payment_details = $this->payments_model->get_payment_details($data['id']);
                $rep = $this->session->userdata('admin_id');
                // $data['payment_type'] = "WPAY";
                $mode = 'ems_model';
                $this->load->model(admin_controller() . $mode);
                $charge =  $this->$mode->void_payment($payment_details, $rep);
                echo json_encode($charge);
                // $charge_response = json_decode( removeBOM($charge), true );
                // $finalResult = array('msg' => 'success', 'response' => $charge_response['transactionResponse']['responseCode']);
                // echo json_encode($finalResult);
                exit;
            } else {
                show_admin404();
            }
        }else{
            $finalResult = array('msg' => 'error', 'response' => 'Access denied!');
            echo json_encode($finalResult);
            exit;
        }
    }

    // public function save_void($details, $response, $rep)
    // {
    //     $response = json_decode( preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $response), true );
    //     $this->payments_model->insert_void($response ,$details, $rep);
    // }
}
