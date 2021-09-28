<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reportings extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model(admin_controller() . 'reporting_model');
        $this->load->model('common/common_model');
        if (!$this->session->userdata('admin_logged_in')) {
            redirect(admin_url() . 'login');
        }
        if (get_session('admin_type') == 2 && (get_session('admin_permissions')['reporting'] == 'N/A' || get_session('admin_permissions')['reporting']['view'] == 0)){
            redirect(admin_url());
        }
    }

    public function lead_source()
    {
        if (get_session('admin_type') == 1 || (get_session('admin_type') == 2 && get_session('admin_permissions')['reporting'] != 'N/A' && get_session('admin_permissions')['reporting']['view'] == 1)){
            $sources = get_leadsource();
            $data = array();
            foreach ($sources as $source){
                $elements = array();
                $customers = array();
                $customers = get_customer_by_leadsource($source['id']);
                $elements['source'] = $source;
                $elements['customer_count'] = count($customers);

                $total = 0;
                $net_total = 0;
                foreach ($customers as $customer){
                    $policy_num = $this->reporting_model->get_policy_num($customer['id']);
                    $customer_policy = get_customer_policy($policy_num['policy_num']);

                    $total = $total + round($customer_policy['plan_initial']);
                    $net_total = $net_total + round($customer_policy['net_total']);
                }
                $elements['total'] = $total;
                $elements['net_total'] = $net_total;
                $data['sources'][] = $elements;
            }
            $this->load->view('reportings/lead_source', $data);
        }else{
            show_admin404();
        }
    }

    public function search_customer()
    {
        $data['param'] = $this->input->get();
        if (!empty($data['param'])){
            if (!empty($data['param']['startdate'])) {
                $data['param']['startdate'] = date('Y-m-d', strtotime($data['param']['startdate']));
            }else{
                $data['param']['startdate'] = date('Y-m-d', strtotime('01-01-1970'));
            }
            if (!empty($data['param']['enddate'])){
                $data['param']['enddate'] = date('Y-m-d', strtotime($data['param']['enddate']));
            }else{
                $data['param']['enddate'] = date('Y-m-d');
            }
            if (!empty($data['param']['source'])){
                $elements = array();
                $customers = array();
                $source = get_leadsource($data['param']['source']);
                $customers = $this->reporting_model->get_customer_by_date($source['id'],$data['param']);
                $elements['source'] = $source;
                $elements['customer_count'] = count($customers);

                $total = 0;
                $net_total = 0;
                foreach ($customers as $customer){
                    $policy_num = $this->reporting_model->get_policy_num($customer['id']);
                    $customer_policy = get_customer_policy($policy_num['policy_num']);

                    $total = $total + round($customer_policy['plan_initial']);
                    $net_total = $net_total + round($customer_policy['net_total']);
                }
                $elements['total'] = $total;
                $elements['net_total'] = $net_total;
                $data['sources'][] = $elements;

            }else{
                $sources = get_leadsource();
                foreach ($sources as $source){
                    $elements = array();
                    $customers = array();
                    $customers = $this->reporting_model->get_customer_by_date($source['id'], $data['param']);
                    $elements['source'] = $source;
                    $elements['customer_count'] = count($customers);

                    $total = 0;
                    $net_total = 0;
                    foreach ($customers as $customer){
                        $policy_num = $this->reporting_model->get_policy_num($customer['id']);
                        $customer_policy = get_customer_policy($policy_num['policy_num']);

                        $total = $total + round($customer_policy['plan_initial']);
                        $net_total = $net_total + round($customer_policy['net_total']);
                    }
                    $elements['total'] = $total;
                    $elements['net_total'] = $net_total;
                    $data['sources'][] = $elements;
                }
            }
            $data['param']['startdate'] = date('m/d/Y', strtotime($data['param']['startdate']));
            $data['param']['enddate'] = date('m/d/Y', strtotime($data['param']['enddate']));
            $this->load->view('reportings/lead_source', $data);
        }else{
            show_admin404();
        }
    }
}
