<?php
defined('BASEPATH') OR exit('No direct script access allowed');

define("AUTHORIZENET_LOG_FILE", "phplog");

class Auth_payment extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('authorize_model');
        $this->load->model('common/common_model');
    }

    public function check_payments()
    {
    //    die("ddd");
        return true;
       /*
        $policies = $this->authorize_model->get_policies();
        foreach ($policies as $policy){
            $response = $this->charge_customer($policy);
            $policy_details = get_customer_policy($policy['policy_num']);
            $next_payment = $this->get_next_payment_date($policy_details);
            $charge_round = $policy_details['charge_round'] - 1;
            $this->authorize_model->update_policy($policy, $next_payment, $charge_round);
        }
       */
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

        $details = '{"createTransactionRequest": {"merchantAuthentication": {
                                        "name": "27YyPJm5N",
                                        "transactionKey": "6J7486kDn2Pm9mZ6"},
                                        "transactionRequest": {
                                                            "transactionType": "authCaptureTransaction",
                                                            "amount": "'.$amount.'",
                                                            "payment": {
                                                                    "creditCard": {
                                                                            "cardNumber": "'.$data['card_num'].'",
                                                                            "expirationDate": "'.$data['card_exp_year'].'-'.$data['card_exp_month'].'",
                                                                            "cardCode": "'.$data['card_pin'].'"
                                                                        }
                                                                },
                                                             "billTo": {    
                                                                    "firstName": "'.$data['bill_cardname'].'",
                                                                    "zip": "'.$data['bill_zipcode'].'",
                                                                        },
                                                              "transactionSettings": {
                                                                     "setting": {
                                                                            "settingName": "testRequest",
                                                                            "settingValue": "false"
                                                                                }
                                                                         },
                                                               "authorizationIndicatorType": {
                                                                            "authorizationIndicator": "final"
                                                                                            }
                                                                }
                                                                            }
                                         }';

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.authorize.net/xml/v1/request.api",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $details,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return "Error:" . $err;
        } else {
            $this->save_payment($data, $response, 0, $amount);
            return json_decode( preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $response), true );
        }
    }

    public function save_payment($data, $response, $rep, $amount)
    {
        $details = json_decode( preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $response), true );
        $this->authorize_model->insert_payment($data ,$details, $rep, $amount);
    }

    public function get_next_payment_date($data)
    {
        $payment_date = date('Y-m-d');
        if ($data['payment_as'] == 1){
//            $plan_months = $data['plan_year'] * 12;
//            $structure = $plan_months/$data['payment_split'];
//            for ($i=0; $i<999; $i++){
//                $v = $i+1;
//                $structure_months = $structure*$v;
//                $next_date = date('Y-m-d', strtotime('+'.$structure_months.' month', strtotime($data['plan_start'])));
//                $current_date = date('Y-m-d');
//                if ($next_date > $current_date){
//                    break;
//                }
//            }
            $time = strtotime(date('Y-m-d G:i:s'));
            $next_date = date("Y-m-d", strtotime("+1 month", $time));
            $payment_date = $next_date;
        }else{
//            $day = date('d', strtotime($data['plan_start']));
//            $moth_year = date('m-Y');
//            $next_date = date('Y-m-d', strtotime('+1 month', strtotime($day.'-'.$moth_year)));
            $time = strtotime(date('Y-m-d G:i:s'));
            $next_date = date("Y-m-d", strtotime("+1 month", $time));
            if ($next_date <= $data['plan_end']){
                $payment_date = $next_date;
            }else{
                $payment_date = '';
            }
        }
        return $payment_date;
    }
}
