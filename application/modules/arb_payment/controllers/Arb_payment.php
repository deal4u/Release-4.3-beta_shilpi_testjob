<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Arb_payment extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('arb_model');
        $this->load->model('common/common_model');
    }

    public function check_payments()
    {
        $policies = $this->arb_model->get_policies();
        foreach ($policies as $policy){
            $response = $this->charge_customer($policy);
            $policy_details = get_customer_policy($policy['policy_num']);
            $next_payment = $this->get_next_payment_date($policy, $policy_details);
            $charge_round = $policy_details['charge_round'] - 1;
            $this->arb_model->update_policy($policy, $next_payment, $charge_round);
        }
    }

    public function charge_customer($data)
    {
        $amount = 0;
        if ($data['charge_update'] == 1){
            if ($data['next_payment'] != '') {
                $amount = $data['next_payment'];
            }
        }else{
            $amount = $data['plan_total'];
        }

        $curl = curl_init();
        $details = '{"transaction_data":{"mid":"VYA_08630857",
                            "amount":"'.$amount.'",
                            "creditcard":"'.$data['card_num'].'",
                            "cvv":"'.$data['card_pin'].'",
                            "month":"'.$data['card_exp_month'].'",
                            "year":"'.$data['card_exp_year'].'",
                            "bzip":"'.$data['bill_zipcode'].'",
                            "cardfullname":"'.$data['bill_cardname'].'",
                            "currency":"USD",
                            "store_card":true}}';

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.vyapay.com/v2/card/sale",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $details,
            CURLOPT_HTTPHEADER => array(
                "content-type: application/json",
                "vyalynk-app-id: APP-P6554264892431061980",
                "vyalynk-client-id: Cv3Nu5N5KBjr7gWTP8AxUZFmWvqlSvnV"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return "Error:" . $err;
        } else {
            $this->save_payment($data, $response, 0);
            return json_decode($response);
        }
    }

    public function save_payment($data, $response, $rep)
    {
        $details = json_decode($response);
        $this->arb_model->insert_payment($data ,$details, $rep);
    }

    public function get_next_payment_date($policy, $data)
    {
        $payment_date = date('Y-m-d');
        if ($data['payment_as'] == 1){
            $plan_months = $data['plan_year'] * 12;
            $structure = $plan_months/$data['payment_split'];
            for ($i=0; $i<$data['c_payment']; $i++){
                $v = $i+1;
                $structure_months = $structure*$v;
                $next_date = date('Y-m-d', strtotime('+'.$structure_months.' month', strtotime($data['plan_start'])));
                $current_date = date('Y-m-d');
                if ($next_date > $current_date){
                    break;
                }
            }
            $payment_date = $next_date;
        }else{
            $day = date('d', strtotime($data['plan_start']));
            $moth_year = date('m-Y');
            $next_date = date('Y-m-d', strtotime('+1 month', strtotime($day.'-'.$moth_year)));
            if ($next_date <= $data['plan_end']){
                $payment_date = $next_date;
            }else{
                $payment_date = '';
            }
        }
        return $payment_date;
    }
}
