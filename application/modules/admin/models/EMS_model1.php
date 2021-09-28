<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EMS_model extends CI_Model
{
private $authorize;
private $payment_processor;
    public function __construct()
    {	
		$this->config->load('payments');
		$payment_processor = $this->config->item('payment_processors');
		$this->payment_processor = $payment_processor['authorize'];
		$this->authorize =  $this->config->item('authorize');
		parent::__construct();
		
    }

	public function modeSetting(){
		$mode = get_setting('configuration','paymentprocessor');
		$chargemode = get_setting('payment_method','payment_mode','1',$mode);
		$authorize = (array)json_decode($chargemode[0]['meta_content']);
		$authorize['payment_mode'] = $mode;
		$authorize = array_merge($authorize, $this->authorize);
		return $authorize;
	}
	public function subscriptionSetting(){
		$this->config->load('payments');
        $mode = $this->config->item('payment_processors');
        $authorize =  $this->config->item('authorize');
		$authorizes['merchant_id'] = $authorize['merchant_login_id'];
        $authorizes['merchant_security'] = $authorize['merchant_transaction_key'];
        $authorizes['endpoint'] = $authorize['endpoint'];
		$authorizes['payment_mode'] = $mode['authorize'];
		$authorizes['validation_mode'] = $authorize['validation_mode'];
		//$authorize = array_merge($authorize, $this->authorize);
		return $authorizes;
	}
	
	public function curlRequest($endpoint,$details){
		$curl = curl_init();     
		curl_setopt_array($curl, array(
			CURLOPT_URL => $endpoint,
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
			$response_array = json_decode(removeBOM($response), true);
			if(isset($response_array['messages']['resultCode']) && $response_array['messages']['resultCode'] =='Error'){
				$error = $response_array['messages']['message'][0]['text'];
				$finalResult = array('msg' => 'error', 'response' => $error);
				return $finalResult;
				exit;
			}else{
				return $response_array;
			}
		}
	}

/* charge functionality on add customer */
	public function charge_customer($customer, $amount,$rep,$card_details,$renewal_id='') {
		$authorize = $this->modeSetting();
		$login_id = (isset($authorize['merchant_id'])) ? $authorize['merchant_id'] : '';
        $merchant_transaction_key = (isset($authorize['merchant_security'])) ? $authorize['merchant_security'] : '';
        $endpoint = $authorize['endpoint'];

		$customer_details = get_customer_card($customer,'',1);
        if (empty($customer_details)){
            $details = get_data($customer,'customers','',array('id','card_num','card_exp_month','card_exp_year','card_pin','bill_zipcode','bill_cardname'));
            $customer_details = $details[0];
        }
		$customerr =  get_data($customer,'customers');
        $profilerequest = '{"createTransactionRequest": 
				{
				"merchantAuthentication": {
					"name": "'.$login_id.'",
					"transactionKey": "'.$merchant_transaction_key.'"
				},
				"transactionRequest": {
					"transactionType": "authCaptureTransaction",
					"amount": "'.$amount.'",
					"payment": {
						"creditCard": {
								"cardNumber": "'.$customer_details['card_num'].'",
								"expirationDate": "'.$customer_details['card_exp_year'].'-'.$customer_details['card_exp_month'].'",
								"cardCode": "'.$customer_details['card_pin'].'"
							}
					},
					"billTo": {
						"firstName": "'.$customerr[0]['first_name'].'",
						"lastName": "'.$customerr[0]['last_name'].'",
						"address": "'.$customerr[0]['bill_address'].'",
						"city": "'.$customerr[0]['bill_city'].'",
						"state": "'.$customerr[0]['bill_state'].'",
						"zip": "'.$customerr[0]['bill_zipcode'].'",
						"country": "'.$customerr[0]['bill_state'].'",
						"phoneNumber": "'.$customerr[0]['work_phone'].'"
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
		
        $response_array = $this->curlRequest($endpoint,$profilerequest);
		if(isset($response_array['msg']) && $response_array['msg']=="error"){
			$error = $response_array['response'];
			$finalResult = array('msg' => 'error', 'response' => $error);
		}elseif(isset($response_array['transactionResponse']['errors'][0]['errorText']) && $response_array['transactionResponse']['errors'][0]['errorText']!=""){
			$error = $response_array['transactionResponse']['errors'][0]['errorText'];
			$finalResult = array('msg' => 'error', 'response' => $error);
		}else{
			$this->save_payment($customer,$customer_details ,$response_array, $rep, $amount,'EMS',$renewal_id);
			$finalResult = array('msg' => 'success', 'response' => "1",'charge_status' => '1' );
		}			
		return $finalResult;
    }

/* create profile of authorise while adding customer */	
	public function createCustomerProfile($customer_id, $card_details= [], $policydata= []){
		$customer =  get_data($customer_id,'customers');
		$authorize = $this->subscriptionSetting();
		$login_id = (isset($authorize['merchant_id'])) ? $authorize['merchant_id'] : '';
        $merchant_transaction_key = (isset($authorize['merchant_security'])) ? $authorize['merchant_security'] : '';
        $endpoint = $authorize['endpoint'];
		$update_cc = 0;

        $payment_profile= $this->customer_model->get_customer_payment_profile($customer_id,$this->payment_processor);//get payment profile_id from db
		
		if(isset($payment_profile[0]['authorize'])){
			$customer_profile =  $payment_profile[0]['authorize'];
            $payment_profile_id =  $payment_profile[0]['authorize_payment_profile'];
            $details = '{
                "updateCustomerPaymentProfileRequest": {
                    "merchantAuthentication": {
                        "name": "'.$login_id.'",
                        "transactionKey": "'.$merchant_transaction_key.'"
                    },
                    "customerProfileId": "'.$customer_profile.'",
                    "paymentProfile": {
                        "customerType": "individual",
                        "payment": {
                            "creditCard": {
                                "cardNumber": "'.$card_details['card_num'].'",
                                "expirationDate": "'.$card_details['card_exp_year'].'-'.sprintf("%02d", $card_details['card_exp_month']).'",
                                "cardCode": "'.$card_details['card_pin'].'",
                            }
                        },
                        "defaultPaymentProfile": false,
                        "customerPaymentProfileId": "'.$payment_profile_id.'"
                    },                   
                    "validationMode": "'.$authorize['validation_mode'].'"
                }
            }';
            $update_cc = 1;
		}else{
			$details = '{
                "createCustomerProfileRequest": {
                    "merchantAuthentication": {
                        "name": "'.$login_id.'",
                        "transactionKey": "'.$merchant_transaction_key.'"
                    },
                    "profile": {
                        "merchantCustomerId": "'.$customer_id.'",
                        "description": "ARB Customer Profile for '.$customer[0]['first_name'].' '.$customer[0]['last_name'].'",
                        "email": "'.$customer[0]['email'].'",
                        "paymentProfiles": {
                            "customerType": "individual",
							 "billTo": {
								"firstName": "'.$customer[0]['first_name'].'",
								"lastName": "'.$customer[0]['last_name'].'",
								"address": "'.$customer[0]['bill_address'].'",
								"city": "'.$customer[0]['bill_city'].'",
								"state": "'.$customer[0]['bill_state'].'",
								"zip": "'.$customer[0]['bill_zipcode'].'",
								"country": "'.$customer[0]['bill_state'].'",
								"phoneNumber": "'.$customer[0]['work_phone'].'"
							  },
                            "payment": {
                                "creditCard": {
                                    "cardNumber": "'.$card_details['card_num'].'",
                                    "expirationDate": "'.$card_details['card_exp_year'].'-'.sprintf("%02d", $card_details['card_exp_month']).'",
                                    "cardCode": "'.$card_details['card_pin'].'",
                                }
                            }
                        }
                    },
                    "validationMode": "'.$authorize['validation_mode'].'"
                }
            }';
		}
		
        $response_array = $this->curlRequest($endpoint,$details); //create or update customer profile request

		if($response_array['messages']['resultCode'] == 'Error'){
			return $response_array;
			die;
		}else{
				
			if(isset($payment_profile[0]['authorize'] ) && $payment_profile[0]['authorize']!=""){
				 $payment_ID = $payment_profile[0]['authorize_payment_profile'];
				 $payment_profileID = $payment_profile[0]['authorize'];
			}else{
				$payment_profileID = $response_array['customerProfileId'];
				$payment_ID = $response_array['customerPaymentProfileIdList'][0];
			}	
			$result = array(
				'authorize_payment_profile' => $payment_ID,
				'payment_profileID' => $payment_profileID,
			);
			$prifileentry = $this->customer_model->create_customer_payment_profile($customer_id,$this->payment_processor, $result);
			sleep('15');
			$shippingaddress = 	'{
					"createCustomerShippingAddressRequest": {
						"merchantAuthentication": {
							  "name": "'.$login_id.'",
							"transactionKey": "'.$merchant_transaction_key.'"
						},
						"customerProfileId": "'.$result['payment_profileID'].'",
						 "address": {
							"firstName": "'.$customer[0]['first_name'].'",
							"lastName": "'.$customer[0]['last_name'].'",
							"company": "",
							"address": "'.$customer[0]['bill_address'].'",
							"city": "'.$customer[0]['bill_city'].'",
							"state": "'.$customer[0]['bill_state'].'",
							"zip": "'.$customer[0]['bill_zipcode'].'",
							"country": "'.$customer[0]['bill_state'].'",
							"phoneNumber": "'.$customer[0]['work_phone'].'",
							"faxNumber": ""
						},
						"defaultShippingAddress": false
					}
				}';

			$responseshipping = $this->curlRequest($endpoint,$shippingaddress);
			if(isset( $responseShipping['customerAddressId'])){
				$result['customer_shipping_id'] = $responseShipping['customerAddressId'];
				
				$this->customer_model->create_customer_payment_profile($customer_id,$this->payment_processor, $result);
			}	
			return $responseshipping;
		}		
	}
	
	
	public function charge_customerEMS($customer_id, $card_details, $policydata,$postdata){
		$customer =  get_data($customer_id,'customers');
		$authorize = $this->subscriptionSetting();
		$login_id = (isset($authorize['merchant_id'])) ? $authorize['merchant_id'] : '';
        $merchant_transaction_key = (isset($authorize['merchant_security'])) ? $authorize['merchant_security'] : '';
        $endpoint = $authorize['endpoint'];
		$update_cc = 0;

        $payment_profile= $this->customer_model->get_customer_payment_profile($customer_id,$this->payment_processor);##get payment profile_id 
		if(isset($payment_profile[0]['authorize'])){  ##if profile exists in db
			$customer_profile =  $payment_profile[0]['authorize'];
            $payment_profile_id =  $payment_profile[0]['authorize_payment_profile'];
            $details = '{
                "updateCustomerPaymentProfileRequest": {
                    "merchantAuthentication": {
                        "name": "'.$login_id.'",
                        "transactionKey": "'.$merchant_transaction_key.'"
                    },
                    "customerProfileId": "'.$customer_profile.'",
                    "paymentProfile": {
                        "customerType": "individual",
                        "payment": {
                            "creditCard": {
                                "cardNumber": "'.$card_details['card_num'].'",
                                "expirationDate": "'.$card_details['card_exp_year'].'-'.sprintf("%02d", $card_details['card_exp_month']).'",
                                "cardCode": "'.$card_details['card_pin'].'",
                            }
                        },
                        "defaultPaymentProfile": false,
                        "customerPaymentProfileId": "'.$payment_profile_id.'"
                    },                   
                    "validationMode": "'.$authorize['validation_mode'].'"
                }
            }'; ##update data request
            $update_cc = 1;
		}else{  ##if profile not exits 
			$details = '{
                "createCustomerProfileRequest": {
                    "merchantAuthentication": {
                        "name": "'.$login_id.'",
                        "transactionKey": "'.$merchant_transaction_key.'"
                    },
                    "profile": {
                        "merchantCustomerId": "'.$customer_id.'",
                        "description": "ARB Customer Profile for '.$customer[0]['first_name'].' '.$customer[0]['last_name'].'",
                        "email": "'.$customer[0]['email'].'",
                        "paymentProfiles": {
                            "customerType": "individual",
							 "billTo": {
								"firstName": "'.$customer[0]['first_name'].'",
								"lastName": "'.$customer[0]['last_name'].'",
								"address": "'.$customer[0]['bill_address'].'",
								"city": "'.$customer[0]['bill_city'].'",
								"state": "'.$customer[0]['bill_state'].'",
								"zip": "'.$customer[0]['bill_zipcode'].'",
								"country": "'.$customer[0]['bill_state'].'",
								"phoneNumber": "'.$customer[0]['work_phone'].'"
							  },
                            "payment": {
                                "creditCard": {
                                    "cardNumber": "'.$card_details['card_num'].'",
                                    "expirationDate": "'.$card_details['card_exp_year'].'-'.sprintf("%02d", $card_details['card_exp_month']).'",
                                    "cardCode": "'.$card_details['card_pin'].'",
                                }
                            }
                        }
                    },
                    "validationMode": "'.$authorize['validation_mode'].'"
                }
            }';  ## create shipping and payment profile
		}
		$response = $this->curlRequest($endpoint,$details);  ##curl request
		if(isset($payment_profile[0]['authorize']) &&$payment_profile[0]['authorize']!=""){
			$result['authorize_payment_profile'] = $payment_profile[0]['authorize_payment_profile'];
			$result['payment_profileID'] = $payment_profile[0]['authorize'];
		}else{
			if(isset( $response['customerProfileId']) && isset( $response['customerPaymentProfileIdList'][0])){
				$result['payment_profileID'] = $response['customerProfileId'];
				$result['authorize_payment_profile']  = $response['customerPaymentProfileIdList'][0];
			}
			elseif(isset($response['messages']['message'][0]['text'])){
				$string = $response['messages']['message'][0]['text'];
				preg_match_all('!\d+!', $string, $matches);
				if(isset($matches[0][0]) && $matches[0][0]!=""){
					$profileData = $this->getProfileIds($matches[0][0]);
					$result['payment_profileID'] = $matches[0][0];
					$result['authorize_payment_profile']  = $profileData['profile']['paymentProfiles'][0]['customerPaymentProfileId'];
				}
			}elseif((isset($response['messages']['resultCode']) && $response['messages']['resultCode']=="Error") || (isset($response['msg']) && $response['msg'] =='error') ){
				return $response;
			}
		}
		
		if(isset($result)){
			$profileEntry = $this->customer_model->create_customer_payment_profile($customer_id,$this->payment_processor, $result); ##add entry in customer_payment_profiles table
			
			if(isset($payment_profile[0]['subscription_id']) && $payment_profile[0]['subscription_id']!="" ){
				
				$getSub = $this->getSubscription($payment_profile, $policydata,$postdata);
				$finalResult = array('msg' => 'success','response' => 'Successfully updated' );
				return $finalResult;

			}else
			{
				$shipping =  $this->shippingProfile($customer_id, $card_details, $policydata, $customer,$result,$postdata);
				return $shipping ;
			}
		}
	} 
    	
	public function shippingProfile($customer_id, $card_details, $policydata, $customer,$result,$postdata){
		$authorize = $this->subscriptionSetting();
		$login_id = (isset($authorize['merchant_id'])) ? $authorize['merchant_id'] : '';
        $merchant_transaction_key = (isset($authorize['merchant_security'])) ? $authorize['merchant_security'] : '';
        $endpoint = $authorize['endpoint'];
		$profileData = $this->getProfileIds( $result['payment_profileID']);	

		if(isset($profileData['profile']['shipToList'][0]['customerAddressId'])  && $profileData['profile']['shipToList'][0]['customerAddressId'] !="" ){
			$response['customerAddressId'] =$profileData['profile']['shipToList'][0]['customerAddressId'];
		}else{
			$shippingaddress = 	'{
				"createCustomerShippingAddressRequest": {
					"merchantAuthentication": {
						  "name": "'.$login_id.'",
						"transactionKey": "'.$merchant_transaction_key.'"
					},
					"customerProfileId": "'.$result['payment_profileID'].'",
					 "address": {
						"firstName": "'.$customer[0]['first_name'].'",
						"lastName": "'.$customer[0]['last_name'].'",
						"company": "",
						"address": "'.$customer[0]['bill_address'].'",
						"city": "'.$customer[0]['bill_city'].'",
						"state": "'.$customer[0]['bill_state'].'",
						"zip": "'.$customer[0]['bill_zipcode'].'",
						"country": "'.$customer[0]['bill_state'].'",
						"phoneNumber": "'.$customer[0]['work_phone'].'",
						"faxNumber": ""
					},
					"defaultShippingAddress": false
				}
			}';
			$response = $this->curlRequest($endpoint,$shippingaddress);
		}
		
	
		$plandate = date('Y-m-d', strtotime($policydata['latest_policy']['plan_start']));
		//if( isset($policydata['next_payment'] ) && $policydata['next_payment'] !=""){
			//print_r($postdata);
			$dataArray =  array(
				'customerPaymentProfileId'  => $result['authorize_payment_profile'],
				'customerProfileId'  => $result['payment_profileID'],
				'customerAddressId'  => $response['customerAddressId'],
				'name'  => 'Subscription for '.$policydata['details']['email'],
				'length'  =>  '12',//$policydata['latest_policy']['next_payment'],	
				'unit'  =>	"months",
				'startDate'  => $policydata['latest_policy']['next_bill_date'],	
				"totalOccurrences"=> '999', //$policydata['latest_policy']['charge_round'],	
				"trialOccurrences"=>  '0',
				"amount"=> $policydata['latest_policy']['plan_total'],
				"trialAmount"=> "0.00",
			);
			
			$subscriptionresponse = $this->addRecurringDetails($dataArray,$customer_id,$postdata);
		
			if((isset($subscriptionresponse['msg']) && $subscriptionresponse['msg'] == 'error') || ( isset($subscriptionresponse['messages']['resultCode']) && $subscriptionresponse['messages']['resultCode'] == 'Error'  )){
				if(isset($subscriptionresponse['response']) &&$subscriptionresponse['response']!=""){
					$error = $subscriptionresponse['response'];
				}elseif(isset( $subscriptionresponse['messages']['message'][0]['text'])){
					$error = $subscriptionresponse['messages']['message'][0]['text'];
				}
				$finalResult = array('msg' => 'error', 'response' => $error);
				
				return $finalResult;
			}else{
				if(isset( $subscriptionresponse['subscriptionId'])){
					$result = array(
						'subscription_id' => $subscriptionresponse['subscriptionId'],
						'customer_shipping_id' => $response['customerAddressId'],
						'authorize_payment_profile' =>$result['authorize_payment_profile'],
						'payment_profileID' => $result['payment_profileID'],
					
					);
					if($subscriptionresponse['messages']['resultCode']!='Error'){
						$this->customer_model->create_customer_payment_profile($customer_id,$this->payment_processor, $result);
					}
				}
			}
		//}
	}
	
	public function getSubscription($payment_profile, $policydata,$postdata){
		$authorize = $this->subscriptionSetting();
		$login_id = (isset($authorize['merchant_id'])) ? $authorize['merchant_id'] : '';
        $merchant_transaction_key = (isset($authorize['merchant_security'])) ? $authorize['merchant_security'] : '';
        $endpoint = $authorize['endpoint'];
		$subscription = 	'{
			  "ARBGetSubscriptionRequest": {
				"merchantAuthentication": {
					"name": "'.$login_id.'",
					"transactionKey": "'.$merchant_transaction_key.'"
				},
				"refId": "123456",
				"subscriptionId": "'.$payment_profile[0]['subscription_id'].'",
				"includeTransactions": true
			  }
		}';
		
		$response = $this->curlRequest($endpoint,$subscription);
		if($response['messages']['resultCode'] =='Error' ){
			$finalResult = array('msg' => 'error', 'response' => 'Subscription not found');
		}else{
			$this->cancelSubscription($payment_profile, $policydata,$postdata);
		}		
	}
	
	public function cancelSubscription($payment_profile, $policydata,$postdata){
		$authorize = $this->subscriptionSetting();
		$login_id = (isset($authorize['merchant_id'])) ? $authorize['merchant_id'] : '';
        $merchant_transaction_key = (isset($authorize['merchant_security'])) ? $authorize['merchant_security'] : '';
        $endpoint = $authorize['endpoint'];
		$subscription = '{
				"ARBCancelSubscriptionRequest": {
					"merchantAuthentication": {
						"name": "'.$login_id.'",
						"transactionKey": "'.$merchant_transaction_key.'"
					},
					"refId": "123456",
					"subscriptionId": "'.$payment_profile[0]['subscription_id'].'"
				}
			}';
		$response = $this->curlRequest($endpoint,$subscription);
		
		if($response['messages']['message'][0]['code'] = 'I00002' ||$response['messages']['message'][0]['resultCode'] == 'Ok'){
			$cancel = 'Ok';
			
			if(isset($postdata['charge_payment'])){
				$charge_payment = $postdata['charge_payment'];
			}else{
				$charge_payment = $policydata['latest_policy']['plan_total'];
			}
			$dataArray =  array(
				'customerPaymentProfileId'  => $payment_profile[0]['authorize_payment_profile'],
				'customerProfileId'  => $payment_profile[0]['authorize'],
				'customerAddressId'  => $payment_profile[0]['customer_shipping_id'],
				'name'  => 'Subscription for '.$policydata['details']['email'],
				'length'  =>  '12', //$policydata['latest_policy']['payment_split'],	
				'unit'  =>	"months",
				'startDate'  => $policydata['latest_policy']['next_bill_date'],	
				"totalOccurrences"=> $policydata['latest_policy']['charge_round'],	
				"trialOccurrences"=>  '0',
				"amount"=> $charge_payment,
				"trialAmount"=> "0.00",
			);
			$response = $this->addRecurringDetails($dataArray,$payment_profile[0]['customer_id'],$postdata );
			
		}
		
		return $response ;
	}
	
	public function addRecurringDetails($payment_profile, $customer_id,$postdata=array()){
		
		$authorize = $this->subscriptionSetting();
		$login_id = (isset($authorize['merchant_id'])) ? $authorize['merchant_id'] : '';
        $merchant_transaction_key = (isset($authorize['merchant_security'])) ? $authorize['merchant_security'] : '';
        $endpoint = $authorize['endpoint'];
		$six_digit_random_number = mt_rand(100000, 999999);
        $billing  = '{
			"ARBCreateSubscriptionRequest": {
				"merchantAuthentication": {
					"name":  "'.$login_id.'",
					"transactionKey": "'.$merchant_transaction_key.'"
				},
				"refId": "'.$six_digit_random_number.'",
				"subscription": {
					"name": "Complete Care Home Warranty Subscription",
					"paymentSchedule": {
						"interval": {
							"length": "'.$payment_profile['length'].'",
							"unit": "'.$payment_profile['unit'].'"
						},
						"startDate": "'.$payment_profile['startDate'].'",
						"totalOccurrences": "'.$payment_profile['totalOccurrences'].'",
						"trialOccurrences": "'.$payment_profile['trialOccurrences'].'"
					},
					"amount": "'.$payment_profile['amount'].'",
					"trialAmount": "'.$payment_profile['amount'].'",
					"profile": {
						"customerProfileId": "'.$payment_profile['customerProfileId'].'",
						"customerPaymentProfileId": "'.$payment_profile['customerPaymentProfileId'].'",
						"customerAddressId": "'.$payment_profile['customerAddressId'].'"
					}
				}
			}
		}';
		
		$response = $this->curlRequest($endpoint,$billing);
		if(isset($response['messages']['resultCode']) && $response['messages']['resultCode'] =='Error'){
			$error = $response['messages']['message'][0]['text'];
			$finalResult = array('msg' => 'error', 'response' => $error);
			return $finalResult;
		}else{
			$profileData = $this->getProfileIds($payment_profile['customerProfileId']);
		
			if(isset($response['subscriptionId'])){
				$newsubID = $response['subscriptionId'];
			}elseif(isset($profileData['subscriptionIds']) && is_array($profileData['subscriptionIds']) ){
				$newsubID = end($profileData['subscriptionIds']);
			}
			
			if(isset($newsubID)){
				$result = array(
					'subscription_id' => $newsubID,
					'authorize_payment_profile' =>$payment_profile['customerPaymentProfileId'],
					'payment_profileID' =>$payment_profile['customerProfileId'],
				);

				$this->customer_model->create_customer_payment_profile($customer_id,$this->payment_processor, $result);
				
			}
			return $response;
		}		
    }
	
	  public function save_payment($customer,$card_details , $details, $rep, $amount,$paymentmode,$renewal_id='')
    { 
	 
        $this->db->set('customer_id', $customer);
        $this->db->set('rep', $rep);
        if (isset($card_details['id'])){
            $this->db->set('card_id', $card_details['id']);
        }
        if (!empty($details['transactionResponse']['responseCode'])){
            $this->db->set('code', $details['transactionResponse']['responseCode']);
        }
        if (!empty($details['transactionResponse']['transId'])) {
            $this->db->set('transaction_id', $details['transactionResponse']['transId']);
        }
        if (!empty($renewal_id)) {
            $this->db->set('policy_renewal_id', $renewal_id);
        }
        if (!empty($details['transactionResponse']['networkTransId'])) {
            $this->db->set('refId', $details['transactionResponse']['networkTransId']);
        }
        if (!empty($details['transactionResponse']['authCode'])) {
            $this->db->set('authcode', $details['transactionResponse']['authCode']);
        }
        $this->db->set('amount_approved', $amount);
        if (!empty($details['m_cardEaseReference'])) {
            $this->db->set('nmi_cardEaseReference', $details['m_cardEaseReference']);
        }
		if (!empty($details['nmi_cardReference'])) {
            $this->db->set('nmi_cardReference', $details['nmi_cardReference']);
        }
		if (!empty($paymentmode)) {
            $this->db->set('payment_mode', $paymentmode);
        }
		if (!empty($details['transactionResponse']['transHashSha2'])) {
            $this->db->set('token', $details['transactionResponse']['transHashSha2']);
        }
        if (!empty($details['transactionResponse']['messages'][0]['description'])) {
            $this->db->set('message', $details['transactionResponse']['messages'][0]['description']);
        }elseif (!empty($details['transactionResponse']['errors'][0]['errorText'])){
            $this->db->set('message', $details['transactionResponse']['errors'][0]['errorText']);
        }
        if (!empty($details['transactionResponse']['message'][0]['code'])) {
            $result_code = $details['transactionResponse']['message'][0]['code'];
            if ($result_code == 1){
                $this->db->set('status', 1);
            }
			$this->db->set('message', $details['transactionResponse']['message'][0]['text']);
        }elseif (!empty($details['transactionResponse']['errors'])){
            $result_code = $details['transactionResponse']['errors'][0]['errorCode'];
            if ($result_code == 11 || $result_code == 8){
                $this->db->set('status', 2);
            }elseif ($result_code == 5 || $result_code == 6){
                $this->db->set('status', 3);
            }else{
                $this->db->set('status', 4);
            }
        }
        $this->db->set('created_at', date('Y-m-d H-i-s'));
        $card_id = $this->db->insert('payments');
        return $card_id;
    }
	

	

	
	public function getProfileIds($profileData){
		$authorize = $this->subscriptionSetting();
		$login_id = (isset($authorize['merchant_id'])) ? $authorize['merchant_id'] : '';
        $merchant_transaction_key = (isset($authorize['merchant_security'])) ? $authorize['merchant_security'] : '';
        $endpoint = $authorize['endpoint'];												
		$details = '{
				"getCustomerProfileRequest": {
					"merchantAuthentication": {
						"name": "'.$login_id.'",
                        "transactionKey": "'.$merchant_transaction_key.'"
					},
					"customerProfileId": "'.$profileData.'",
					"includeIssuerInfo": "true"
				}
			}';
		$response = $this->curlRequest($endpoint,$details);
		return $response;
	}

	
	
	
	

	
	
	
	
	
	
	
	public function updatesubscription($customer_id, $data){
	  //print_R($data);
        $customer =  get_data($customer_id,'customers');
        $authorize = $this->subscriptionSetting();
		$login_id = (isset($authorize['merchant_id'])) ? $authorize['merchant_id'] : '';
        $merchant_transaction_key = (isset($authorize['merchant_security'])) ? $authorize['merchant_security'] : '';
        $endpoint = $authorize['endpoint'];
        $update_cc = 0;
                
        //get payment profile_id 
        $payment_profile= $this->customer_model->get_customer_payment_profile($customer_id,$this->payment_processor);
		
		if(isset($payment_profile[0]['authorize'])){
            $customer_profile =  $payment_profile[0]['authorize'];
            $payment_profile_id =  $payment_profile[0]['authorize_payment_profile'];
            $subscription_id =  $payment_profile[0]['subscription_id'];
			$details = '{
				"ARBUpdateSubscriptionRequest": {
					"merchantAuthentication": {
						 "name": "'.$login_id.'",
                        "transactionKey": "'.$merchant_transaction_key.'"
					},
					"refId": "123456",
					"subscriptionId": "'.$subscription_id.'",
					"subscription": {
						"payment": {
							"creditCard": {
								"cardNumber": "'.$data['card_num'].'",
								"expirationDate": "'.$data['card_exp_year'].'-'.sprintf("%02d", $data['card_exp_month']).'"
							}
						}
					}
				}
			}';	
			$response = $this->curlRequest($endpoint,$details);
			return $response;
		}
	}
	
	public function refund_payment($details, $amount, $rep){
		$authorize = $this->subscriptionSetting();
		$login_id = (isset($authorize['merchant_id'])) ? $authorize['merchant_id'] : '';
        $merchant_transaction_key = (isset($authorize['merchant_security'])) ? $authorize['merchant_security'] : '';
        $endpoint = $authorize['endpoint'];
		
        $customer_card = get_customer_card($details['customer_id'],'',1);
        $card_num = substr($customer_card['card_num'], -4);

        $curl = curl_init();
        $data = '{
				"createTransactionRequest": 
					{"merchantAuthentication": 
						{
							"name": "'.$login_id.'",
							"transactionKey": "'.$merchant_transaction_key.'"
						},
						"transactionRequest": {
						"transactionType": "refundTransaction",
							"amount": "'.$amount.'",
							"payment": {
								"creditCard": {
									"cardNumber": "'.$customer_card['card_num'].'",
									"expirationDate": "'.$customer_card['card_exp_year'].'-'.$customer_card['card_exp_month'].'"
								}
							},
							"refTransId": "'.$details['transaction_id'].'"
						}
					}	
				}';
        curl_setopt_array($curl, array(
            CURLOPT_URL =>  $endpoint,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $data,
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
            $response_array = json_decode(removeBOM($response), true);
			if($response_array['transactionResponse']['errors'][0]['errorText']!=""){
				$error = $response_array['transactionResponse']['errors'][0]['errorText'];
				$finalResult = array('msg' => 'error', 'response' => $error);
			}else{				
				$this->payments_model->insert_payment($response_array ,$details ,$amount, $rep);
				$finalResult = array('msg' => 'success', 'response' =>  $response_array['message'][0]['text'],'charge_status' => '1' );
			}			
			return $finalResult;
        }
	}
	
	public function void_payment($details, $rep)
    {
		$authorize = $this->subscriptionSetting();
		$login_id = (isset($authorize['merchant_id'])) ? $authorize['merchant_id'] : '';
        $merchant_transaction_key = (isset($authorize['merchant_security'])) ? $authorize['merchant_security'] : '';
        $endpoint = $authorize['endpoint'];
		
        $curl = curl_init();
         $data = '{"createTransactionRequest": {"merchantAuthentication": {
												"name": "'.$login_id.'",
												"transactionKey": "'.$merchant_transaction_key.'"
												},
											
                                                "transactionRequest": {
                                                     "transactionType": "voidTransaction",
                                                     "refTransId": "'.$details['transaction_id'].'"
                                                    }
                                               }
                                             }';

        curl_setopt_array($curl, array(
            CURLOPT_URL => $endpoint,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
           return $finalResult = array('msg' => 'error', 'response' =>  $err);
        } else {
			// $this->save_void($details ,$response, $rep);
			$response_array = json_decode(removeBOM($response), true );
			$this->payments_model->insert_void($response_array ,$details, $rep);
			return $finalResult = array('msg' => 'success', 'response' => '1');
        }
    }

	public function cancelARBSubscription($subscription_id){
		$authorize = $this->subscriptionSetting();
		$login_id = (isset($authorize['merchant_id'])) ? $authorize['merchant_id'] : '';
        $merchant_transaction_key = (isset($authorize['merchant_security'])) ? $authorize['merchant_security'] : '';
        $endpoint = $authorize['endpoint'];
		$subscription = '{
				"ARBCancelSubscriptionRequest": {
					"merchantAuthentication": {
						"name": "'.$login_id.'",
						"transactionKey": "'.$merchant_transaction_key.'"
					},
					"refId": "123456",
					"subscriptionId": "'.$subscription_id.'"
				}
			}';
		$response = $this->curlRequest($endpoint,$subscription);
		return $response;
	}
}
