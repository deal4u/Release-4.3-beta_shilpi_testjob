<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Homeowners extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('common/common_model');
    }

    public function index()
    {
        $this->load->view('homeowners');
    }
}
