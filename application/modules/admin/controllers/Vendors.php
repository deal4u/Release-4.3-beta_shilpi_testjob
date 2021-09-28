<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vendors extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model(admin_controller() . 'vendor_model');
        $this->load->model(admin_controller() . 'customer_model');
        $this->load->model(admin_controller() . 'claim_model');
        $this->load->model('common/common_model');
        if (!$this->session->userdata('admin_logged_in')) {
            redirect(admin_url() . 'login');
        }
        if (get_session('admin_type') == 2 && (get_session('admin_permissions')['vendors'] == 'N/A' || get_session('admin_permissions')['vendors']['view'] == 0)){
            redirect(admin_url());
        }
    }

    public function index()
    {
        if (get_session('admin_type') == 1 || (get_session('admin_type') == 2 && get_session('admin_permissions')['vendors'] != 'N/A' && get_session('admin_permissions')['vendors']['view'] == 1)){
            $data['vendors'] = $this->vendor_model->get_vendors();
            $this->load->view('vendors/vendors', $data);
        }else{
            show_admin404();
        }
    }
    public function vendor_details()
    {
        if (get_session('admin_type') == 1 || (get_session('admin_type') == 2 && get_session('admin_permissions')['vendors'] != 'N/A' && get_session('admin_permissions')['vendors']['view'] == 1)){
            if($_POST){
                $data = $this->input->post();
                $result = $this->vendor_model->get_vendors($data['vendor']);
                $details['vendor'] = $result[0];
                $view = "vendors/vendor_detail_ajax";
                if(!empty($details)) {
                    $htmlrespon = $this->load->view($view , $details,TRUE);
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

    public function add()
    {
        if (get_session('admin_type') == 1 || (get_session('admin_type') == 2 && get_session('admin_permissions')['vendors'] != 'N/A' && get_session('admin_permissions')['vendors']['add'] == 1)){
            $this->load->view('vendors/add_vendor');
        }else{
            show_admin404();
        }
    }

    public function save()
    {
        if (get_session('admin_type') == 1 || (get_session('admin_type') == 2 && get_session('admin_permissions')['vendors'] != 'N/A' && get_session('admin_permissions')['vendors']['add'] == 1)){
            if($_POST){
                $data = $this->input->post();
                $this->form_validation->set_rules('company', 'Company Name', 'trim|required|xss_clean');
                $this->form_validation->set_rules('name', 'Contact Name', 'trim|required|xss_clean');
                $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|is_unique[vendors.Email]', array('required' => 'Email is required.', 'is_unique' => 'Email already associated with another account.'));
                $this->form_validation->set_rules('phone', 'Phone', 'trim|required|xss_clean');
                $this->form_validation->set_rules('fax', 'Fax', 'trim|required|xss_clean');
                $this->form_validation->set_rules('address', 'Address', 'trim|required|xss_clean');
                $this->form_validation->set_rules('city', 'City', 'trim|required|xss_clean');
                $this->form_validation->set_rules('state', 'State', 'trim|required|xss_clean');
                $this->form_validation->set_rules('zip_code', 'Zip Code', 'trim|required|xss_clean');

                if ($this->form_validation->run($this) == FALSE)
                {
                    $finalResult = array('msg' => 'error', 'response'=>validation_errors());
                    echo json_encode($finalResult);
                    exit;
                }else {
                    if(empty($data["zip_codes_serviced"])) {
                        $finalResult = array('msg' => 'error', 'response'=>'<p>The Zip Codes Serviced field is required.</p>');
                        echo json_encode($finalResult);
                        exit;
                    }

                    $vendor_id = $this->vendor_model->insert_vendor($data);
                    $this->vendor_model->insert_services($data['opt_service'], $vendor_id);
                    $this->vendor_model->insert_zip_codes_serviced($data, $vendor_id);
                    $finalResult = array('msg' => 'success', 'response' => "Vendor successfully added.");
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

    public function edit($id='', $tab='')
    {
        if (get_session('admin_type') == 1 || (get_session('admin_type') == 2 && get_session('admin_permissions')['vendors'] != 'N/A' && get_session('admin_permissions')['vendors']['edit'] == 1)){
            if(!empty($id)){
                $details = $this->vendor_model->get_vendors($id);
                if (!empty($details)){
                    $services = $this->vendor_model->get_services($id);
                    $vendor_services = array();
                    foreach ($services as $key=>$service){
                        $vendor_services[$key+1] = $service['service'];
                    }
                    $data['details'] = $details[0];
                    $data['services'] = $vendor_services;
					$data['claim_auth'] = $this->vendor_model->get_vendors_claims($id);
				
                    if (empty($tab)){
                        $data['bottom_tab'] = 'unknown';
                    }else{
                       $data['bottom_tab'] = $tab;
                    }

                    $this->load->view('vendors/edit_vendor', $data);
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

    public function update()
    {
        if (get_session('admin_type') == 1 || (get_session('admin_type') == 2 && get_session('admin_permissions')['vendors'] != 'N/A' && get_session('admin_permissions')['vendors']['edit'] == 1)){
            if($_POST){
                $data = $this->input->post();

                $this->form_validation->set_rules('company', 'Company Name', 'trim|required|xss_clean');
                $this->form_validation->set_rules('name', 'Contact Name', 'trim|required|xss_clean');
                $this->form_validation->set_rules('phone', 'Phone', 'trim|required|xss_clean');
                $this->form_validation->set_rules('fax', 'Fax', 'trim|required|xss_clean');
                $this->form_validation->set_rules('address', 'Address', 'trim|required|xss_clean');
                $this->form_validation->set_rules('city', 'City', 'trim|required|xss_clean');
                $this->form_validation->set_rules('state', 'State', 'trim|required|xss_clean');
                $this->form_validation->set_rules('zip_code', 'Zip Code', 'trim|required|xss_clean');

                if ($this->form_validation->run($this) == FALSE)
                {
                    $finalResult = array('msg' => 'error', 'response'=>validation_errors());
                    echo json_encode($finalResult);
                    exit;
                }else {

                    if(empty($data["zip_codes_serviced"])) {
                        $finalResult = array('msg' => 'error', 'response'=>'<p>The Zip Codes Serviced field is required.</p>');
                        echo json_encode($finalResult);
                        exit;
                    }

                    $vendor_status = $this->vendor_model->update_vendor($data);
                    $this->vendor_model->delete_services($data['id']);
                    $this->vendor_model->update_services($data['opt_service'], $data['id']);
                    $this->vendor_model->delete_zip_codes_serviced($data['id']);
                    $this->vendor_model->update_zip_codes_serviced($data, $data['id']);
                    $finalResult = array('msg' => 'success', 'response' => "Vendor successfully updated.");
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


    public function delete_vendor()
    {
        if($_POST){
            $vendor = $_POST['vendor'];
            // $claims = get_data('','claims',array('customer'=>$customer),'id');

            // $this->customer_model->delete_tasks($customer);
            // $status = $this->customer_model->delete_claims($customer, $claims);
            $status =  $this->vendor_model->delete_vendor($vendor);
            if($status > 0){
                $finalResult = array('msg' => 'success', 'response'=>"Vendor successfully deleted.");
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
    }

    public function vendor_claims()
    {
        if($_POST){
            $data = $this->input->post();
            $details['claim_auth'] = $this->vendor_model->get_vendors_claims($data['vendor']);
            $view = "vendors/vendor_claim_ajax";
            if(!empty($details)) {
                $htmlrespon = $this->load->view($view , $details, TRUE);
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
    }

    public function claim_files() {

        if ($_POST) {
            $data = $this->input->post();
            $this->form_validation->set_rules('image_alt', 'Image Alt', 'trim|required|xss_clean');
            if ($this->form_validation->run() == FALSE) {
                $finalResult = array('msg' => 'error', 'response'=>validation_errors());
                echo json_encode($finalResult);
                exit;
            } else {

                if (!empty($_FILES['image']['name'])) {


                    $main = $this->upload_image(FCPATH . 'assets/claim_files', 'image');

                    if ($main['msg'] == 'success') {
                        $data['image'] = $main['response'];

                    } else {
                        $finalResult = array('msg' => 'error', 'response' => $main['response']);
                        echo json_encode($finalResult);
                        exit;
                    }
                }

                // insert records to old post table
                $image_id = $this->vendor_model->insert_image($data);
                if($image_id > 0) {
                    $finalResult = array('msg' => 'success', 'response'=>"File successfully uploaded.");
                    echo json_encode($finalResult);
                    exit;
                } else {
                    $finalResult = array('msg' => 'error', 'response'=>'Something went wrong!');
                    echo json_encode($finalResult);
                    exit;
                }
            }
        } else {
            show_admin404();
        }
    }

    public function upload_image($path , $image_type) {
        $config['upload_path'] = $path;
        $config['allowed_types'] = 'jpg|pdf';
        $config['max_size'] = 5000;
        $config['max_width'] = 5000;
        $config['max_height'] = 5000;

        $this->load->library('upload');
        $this->upload->initialize($config);

        if ($this->upload->do_upload($image_type)) {
            $banner_upload = $this->upload->data();
            return array( 'msg' => 'success', 'response' => $banner_upload['file_name']);

        } else {
            return array( 'msg' => 'error', 'response' => $this->upload->display_errors());
        }
    }

    public function get_images() {

        if ($_POST) {
            $vendor_file = $this->input->post('vendor_file');
            if (!empty($vendor_file)){

                $images['images'] = $this->common_model->get_data('','claim_files',array('vendor_id'=>$vendor_file));

                $htmlrespon = $this->load->view('customers/load_claim_files' , $images,TRUE);

                $finalResult = array('msg' => 'success', 'response'=>$htmlrespon);
                echo json_encode($finalResult);
                exit;
            } else {
                $finalResult = array('msg' => 'error', 'response'=>'Something went wrong!');
                echo json_encode($finalResult);
                exit;
            }
        } else {
            $finalResult = array('msg' => 'error', 'response'=>'Something went wrong!');
            echo json_encode($finalResult);
            exit;
        }
    }

    public function delete_claim_files() {
        if($_POST) {
            $id = $_POST['id'];
            $status = $this->vendor_model->delete_claim_files($id);
            if($status > 0) {
                $finalResult = array('msg' => 'success', 'response'=>"File successfully deleted.");
                echo json_encode($finalResult);
                exit;
            } else {
                $finalResult = array('msg' => 'error', 'response'=>"Something went wrong please try again.");
                echo json_encode($finalResult);
                exit;
            }
        } else {
            show_admin404();
        }
    }

}
