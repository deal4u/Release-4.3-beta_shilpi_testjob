<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//require_once APPPATH . '../vendor/autoload.php';
class Lead_source extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model(admin_controller() . 'leads_model');
        $this->load->model('common/common_model');
        if (!$this->session->userdata('admin_logged_in')) {
            redirect(admin_url() . 'login');
        }
        if (get_session('admin_type') == 2 && (get_session('admin_permissions')['leadsource'] == 'N/A' || get_session('admin_permissions')['leadsource']['view'] == 0)){
            redirect(admin_url());
        }
    }

    public function index()
    {
        if (get_session('admin_type') == 1 || (get_session('admin_type') == 2 && get_session('admin_permissions')['leadsource'] != 'N/A' && get_session('admin_permissions')['leadsource']['view'] == 1)){
            $data['source'] = $this->leads_model->get_source();
            $this->load->view('lead_source/lead_source', $data);
        }else{
            show_admin404();
        }
    }

    public function edit_source()
    {
        if (get_session('admin_type') == 1 || (get_session('admin_type') == 2 && get_session('admin_permissions')['leadsource'] != 'N/A' && get_session('admin_permissions')['leadsource']['edit'] == 1)){
            if($_POST){
                $data = $_POST;
                $source = $this->leads_model->get_source($data['id']);
                if(!empty($source[0])) {
                    $data['lead'] = $source[0];
                    $htmlrespon = $this->load->view('lead_source/edit_lead_source' , $data,TRUE);
                    $finalResult = array('msg' => 'success', 'response'=>$htmlrespon);
                    echo json_encode($finalResult);
                    exit;

                } else {
                    $finalResult = array('msg' => 'error', 'response'=>"Something went wrong!");
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

    public function update_lead_source()
    {
        if (get_session('admin_type') == 1 || (get_session('admin_type') == 2 && get_session('admin_permissions')['leadsource'] != 'N/A' && get_session('admin_permissions')['leadsource']['edit'] == 1)){
            if($_POST){
                $data = $_POST;

                $this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');

                if ($this->form_validation->run($this) == FALSE)
                {
                    $finalResult = array('msg' => 'error', 'response'=>validation_errors());
                    echo json_encode($finalResult);
                    exit;
                }else{
                    $lead_status = $this->leads_model->update_lead_source($data);
                    if($lead_status > 0){
                        $finalResult = array('msg' => 'success', 'response'=>"Successfully updated.");
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

    public function save_lead()
    {
        if (get_session('admin_type') == 1 || (get_session('admin_type') == 2 && get_session('admin_permissions')['leadsource'] != 'N/A' && get_session('admin_permissions')['leadsource']['add'] == 1)){
            if($_POST){
                $data = $this->input->post();
                $this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
                if ($this->form_validation->run($this) == FALSE)
                {
                    $finalResult = array('msg' => 'error', 'response'=>validation_errors());
                    echo json_encode($finalResult);
                    exit;
                }else{
                    $lead_id = $this->leads_model->insert_lead_source($data);
                    if($lead_id > 0){
                        $finalResult = array('msg' => 'success', 'response'=>"Successfully inserted.");
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
}
