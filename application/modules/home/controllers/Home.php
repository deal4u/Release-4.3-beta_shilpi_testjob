<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('home_model');
        $this->load->model('common/common_model');
    }

    public function index()
    {
        $data = array();
        if (!empty($_SESSION['quote'])) {
            $data['name'] = $_SESSION['quote']['name'];
            $data['email'] = $_SESSION['quote']['email'];
            $data['phone'] = $_SESSION['quote']['phone'];
        }
        $this->load->view('home', $data);
    }
    public function get_quote()
    {
        if($_POST){
            $data = $this->input->post();

            $this->form_validation->set_rules('name', 'First Name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('email', 'Email Address', 'trim|required|xss_clean|valid_email');
            $this->form_validation->set_rules('phone', 'Home Phone', 'trim|required|xss_clean');
            if ($this->form_validation->run($this) == FALSE)
            {
                $finalResult = array('msg' => 'error', 'response'=>validation_errors());
                echo json_encode($finalResult);
                exit;
            }else {
                $_SESSION['quote'] = array();
                $_SESSION['quote']['name'] = $data['name'];
                $_SESSION['quote']['email'] = $data['email'];
                $_SESSION['quote']['phone'] = $data['phone'];
                if (!empty($_SESSION['quote'])){
                    $finalResult = array('msg' => 'success');
                    echo json_encode($finalResult);
                    exit;
                }else{
                    $finalResult = array('msg' => 'error', 'response'=>'Something went wrong!');
                    echo json_encode($finalResult);
                    exit;
                }
            }
        }else{
            show_404();
        }
    }
}
