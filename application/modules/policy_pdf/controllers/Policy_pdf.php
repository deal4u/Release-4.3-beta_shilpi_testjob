<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH . '../vendor/autoload.php';
class Policy_pdf extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model( 'policy_model');
        $this->load->model('common/common_model');
    }

    public function get($id='')
    {
        if ($id != ''){
            $mpdf = new \Mpdf\Mpdf([
                'mode' => 'c',
                'format' => 'A4',
                'margin_left' => 10,
                'margin_right' => 10,
                'margin_top' => 6,
                'margin_bottom' => 10,
                'margin_header' => 0,
                'margin_footer' => 0,
            ]);
            $document_unique_id = get_policy_by_pdf($id);
            $customer = $document_unique_id['customer'];

            $data['details'] = $this->policy_model->get_plan_policy_data($customer);
            $data['latest_policy'] = get_customer_policy($data['details']['policy_num']);

            $ip_address = get_client_ip();
            $this->policy_model->update_ip($data['latest_policy'], $ip_address);

            $data['plan_value'] = get_plan_name('plan', $data['latest_policy']['plan'])['meta_content'];
            $scf_value = get_plan_name('scf', $data['latest_policy']['scf']);
            $plan_coverages = get_plan_names($data['plan_value'], $data['latest_policy']['plan']);
            $coverage = array();
            foreach ($plan_coverages as $plan_coverage){
                $coverage[] = $plan_coverage['meta_content'];
            }
            $data['plan_coverage'] = implode($coverage, ', ');
            $data['property_type'] = get_plan_name('property_type',$data['latest_policy']['property_type'])['meta_content'];
            $selected = array();
            $other_coverage = '';
            $other_coverage_arr = [];
            foreach (get_coverage($data['details']['id'], $data['latest_policy']['id']) as $cov_id) {
                $selected[] = get_setting('opt_coverage', $cov_id['coverage'], 1)[0]['meta_content'];
                if($cov_id['coverage']=='25' && $cov_id['comments']!=''){
                    $other_coverage_arr = explode(',',$cov_id['comments']);
                }
            }
            if(count($other_coverage_arr) > 0){
                $other_coverage= implode($other_coverage_arr,', ');
            }
    
            $data['extra_coverage'] = implode($selected,', ');
            $data['extra_coverage'] = str_replace('Other',$other_coverage, $data['extra_coverage']); 
            $data['scf_value'] = '$'.number_format((float)$scf_value['meta_value'], 2, '.', '');

            $doc_name = 'Complete Care HW Policy #'.$data['details']['policy_num'];

            $html = $this->load->view('policy_pdf/pdf_document', $data, true);
            $mpdf->WriteHTML($html);
            $mpdf->Output($doc_name, 'I');
        }

    }

}
