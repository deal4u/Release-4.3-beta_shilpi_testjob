<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Api_model extends CI_Model
{

	public function __construct()
	{
		$this->config->load('payments');
		$payment_processor = $this->config->item('payment_processors');
		$this->payment_processor = $payment_processor['authorize'];
		$this->authorize =  $this->config->item('authorize');
		parent::__construct();
	}

	public function subscriptionSetting()
	{
		$this->config->load('payments');
		$mode = $this->config->item('payment_processors');
		$authorize =  $this->config->item('authorize');
		$authorizes['merchant_id'] = $authorize['merchant_login_id'];
		$authorizes['merchant_security'] = $authorize['merchant_transaction_key'];
		$authorizes['endpoint'] = $authorize['endpoint'];
		$authorizes['payment_mode'] = "EMS";//$mode['authorize'];
		$authorizes['validation_mode'] = $authorize['validation_mode'];
        return $authorizes;
	}

	public function getCallSetting($data)
	{
		$this->db->select('*');
		$this->db->from('general_settings');
		$this->db->where('meta_tag', $data['meta_tag']);
		$this->db->where('meta_key', $data['meta_key']);
		$query = $this->db->get();
		return $query->result_array();
	}

	/* GET LEAD SOURCE ACC TO LEAD SOURCE ID */
	public function get_source($id = '')
	{
		$this->db->select('*');
		$this->db->from('lead_source');
		if ($id != '') {
			$this->db->where('name', $id);
		}
		$this->db->order_by('created_at', 'DESC');
		$query = $this->db->get();
		return $query->result_array();
	}

	/* CHECK PAYMENT PROFILE EXISTENCE */
	public function get_customer_payment_profile($customer_id)
	{
		$query = $this->db->query("SELECT * FROM customer_payment_profiles where customer_id = {$customer_id}");
		return $query->result_array();
	}

	/* GET CUSTOMERS TO CREATE ARB PROFILE */
	public function get_customers_ARB($dates)
	{
		$result = $this->db->query("SELECT * FROM `customers` WHERE (created_at BETWEEN '" . $dates['startdate'] . "' AND '" . $dates['enddate'] . "') order by id desc")->result_array();
		return $result;
	}

	public function create_customer_payment_profile($customer_id,  $profile_data)
	{
		$query = $this->db->query("SELECT * FROM customer_payment_profiles where customer_id = {$customer_id}");
		$count = $query->num_rows();

		if (isset($profile_data['payment_profileID']) &&  $profile_data['payment_profileID'] != "") {
			$this->db->set('authorize', $profile_data['payment_profileID']);
		}
		if (isset($profile_data['authorize_payment_profile']) &&  $profile_data['authorize_payment_profile'] != "") {
			$this->db->set("authorize_payment_profile", $profile_data['authorize_payment_profile']);
		}
		if (isset($profile_data['customer_shipping_id']) &&  $profile_data['customer_shipping_id'] != "") {
			$this->db->set("customer_shipping_id", $profile_data['customer_shipping_id']);
		}
		if (isset($profile_data['subscription_id']) &&   $profile_data['subscription_id'] != "") {
			$this->db->set("subscription_id", $profile_data['subscription_id']);
		}
		if (isset($profile_data['status']) &&   $profile_data['status'] != "") {
			$this->db->set("status", $profile_data['status']);
		}
		if (isset($profile_data['step_completed']) &&   $profile_data['step_completed'] != "") {
			$this->db->set("step_completed", $profile_data['step_completed']);
		}
		if (isset($profile_data['response']) &&   $profile_data['response'] != "") {
			$this->db->set("response", $profile_data['response']);
		}
		$authorize = $this->subscriptionSetting();  //settings
		if (isset($authorize['payment_mode']) &&   $authorize['payment_mode'] != "") {
			$this->db->set("payment_mode", $authorize['payment_mode']);
		}
		if ($count == 0) {
			$this->db->set('customer_id', $customer_id);
			$this->db->set('created_at', date('Y-m-d H-i-s'));
			$profile_id = $this->db->insert('customer_payment_profiles');
		} else {
			$this->db->set('updated_at', date('Y-m-d H-i-s'));
			$this->db->where('customer_id', $customer_id);
			$profile_id = $this->db->update('customer_payment_profiles');
		}
		return $profile_id;
	}

	public function createCustomerProfile($customer_id)
	{
		$customer =  get_data($customer_id, 'customers');
		$card_details = get_customer_card($customer_id);

		$authorize = $this->subscriptionSetting();  //settings
   		$login_id = (isset($authorize['merchant_id'])) ? $authorize['merchant_id'] : '';
		$merchant_transaction_key = (isset($authorize['merchant_security'])) ? $authorize['merchant_security'] : '';
		$endpoint = $authorize['endpoint'];
		$authorize_response_array = array(
			'customer_profile' => array(),
			'customer_payment_profile' => array(),
			'customer_shipping_profile' => array(),
			'subscription' => array(),
		);

		$details = '{
			"createCustomerProfileRequest": {
				"merchantAuthentication": {
					"name": "' . $login_id . '",
					"transactionKey": "' . $merchant_transaction_key . '"
				},
				 "profile": {
					"merchantCustomerId": "' . $customer_id . '",
					"description": "ARB Customer Profile for ' . $customer[0]['first_name'] . '",
					"email":  "' . $customer[0]['email'] . '",
					"paymentProfiles": {
						"customerType": "individual",
						"billTo": {
							"firstName": "' . $customer[0]['first_name'] . '",
							"lastName": "' . $customer[0]['last_name'] . '",
							"address": "' . $customer[0]['bill_address'] . '",
							"city": "' . $customer[0]['bill_city'] . '",
							"state": "' . $customer[0]['bill_state'] . '",
							"zip": "' . $customer[0]['bill_zipcode'] . '",
							"country": "' . $customer[0]['bill_state'] . '",
							"phoneNumber": "' . $customer[0]['work_phone'] . '"
						},
						"payment": {
							"creditCard": {
								"cardNumber": "' . $card_details['card_num'] . '",
								"expirationDate": "' . $card_details['card_exp_year'] . '-' . sprintf("%02d", $card_details['card_exp_month']) . '",
								"cardCode": "' . $card_details['card_pin'] . '",
							}
						}
					}
				},
				"validationMode": "' . $authorize['validation_mode'] . '"
			}
		}';
		$response_array = $this->curlRequest($endpoint, $details); //create or update customer profile request 
		$step = 0;
		if (isset($response_array['messages']['resultCode']) && $response_array['messages']['resultCode'] == 'Error') {
			$authorize_response_array['customer_profile'] = array('status' => '0', 'message' => $response_array['messages']['message'][0]['text']);
			$step = 0;
		} else {
			$authorize_response_array['customer_profile'] = array('status' => '1', 'message' => 'ARB Profile created');
			$step = 1;
		}
		if (isset($response_array['customerProfileId']) && $response_array['customerProfileId'] != "") {
			$authorize_payment_profile = $response_array['customerProfileId'];
		} else {
			$authorize_payment_profile = '';
		}
		$result = array(
			'payment_profileID' => $authorize_payment_profile,
			'status' => '0',
			'step_completed' => $step,
			'response' => json_encode($authorize_response_array),
		);
		//$authorize_payment_profile ='1930670624';
		$prifileentry = $this->create_customer_payment_profile($customer_id, $result);

		if (isset($authorize_payment_profile)) {
			$results =  $this->payment_profile($customer_id, $card_details, $authorize_payment_profile, $customer, $authorize_response_array);
			if (!empty($results)) {
				return $results;
			} else {
				return $result;
			}
		}
	}


	public function payment_profile($customer_id, $card_details, $authorize_profile, $customer, $authorize_response_array)
	{
		$authorize = $this->subscriptionSetting();  //settings
		$login_id = (isset($authorize['merchant_id'])) ? $authorize['merchant_id'] : '';
		$merchant_transaction_key = (isset($authorize['merchant_security'])) ? $authorize['merchant_security'] : '';
		$endpoint = $authorize['endpoint'];
		if (isset($authorize_profile) && $authorize_profile != "") {
			$details = '{
				"getCustomerProfileRequest": {
					"merchantAuthentication": {
						"name": "' . $login_id . '",
						"transactionKey": "' . $merchant_transaction_key . '"
					},
					"customerProfileId": "' . $authorize_profile . '",
					"includeIssuerInfo": "true"
				}
			}';
			$response_array = $this->curlRequest($endpoint, $details);
			if (isset($response_array['profile']['paymentProfiles'][0]['customerPaymentProfileId'])) {
				$authorize_payment_profile = $response_array['profile']['paymentProfiles'][0]['customerPaymentProfileId'];
				$authorize_response_array['customer_payment_profile'] = array('status' => '1', 'message' => 'Payment Profile Created');
				$step = 2;
				$result = array(
					'status' => '0',
					'step_completed' => $step,
					'response' => json_encode($authorize_response_array),
					'authorize_payment_profile' => $authorize_payment_profile,
				);
				$prifileentry = $this->create_customer_payment_profile($customer_id, $result);
				$this->createCustomerProfiles($customer_id, $card_details, $authorize_response_array, $authorize_payment_profile, $authorize_profile, $customer);
				return  $result;
			}
		}
	}




	/*create profile of authorise while adding customer */
	public function createCustomerProfiles($customer_id, $card_details, $authorize_response_array, $authorize_payment_profile, $authorize_profile, $customer)
	{
		$authorize = $this->subscriptionSetting();  //settings
		$login_id = (isset($authorize['merchant_id'])) ? $authorize['merchant_id'] : '';
		$merchant_transaction_key = (isset($authorize['merchant_security'])) ? $authorize['merchant_security'] : '';
		$endpoint = $authorize['endpoint'];
		$shippingaddress = 	'{
				"createCustomerShippingAddressRequest": {
					"merchantAuthentication": {
						  "name": "' . $login_id . '",
						"transactionKey": "' . $merchant_transaction_key . '"
					},
					"customerProfileId": "' . $authorize_profile . '",
					 "address": {
						"firstName": "' . $customer[0]['first_name'] . '",
						"lastName": "' . $customer[0]['last_name'] . '",
						"company": "",
						"address": "' . $customer[0]['bill_address'] . '",
						"city": "' . $customer[0]['bill_city'] . '",
						"state": "' . $customer[0]['bill_state'] . '",
						"zip": "' . $customer[0]['bill_zipcode'] . '",
						"country": "' . $customer[0]['bill_state'] . '",
						"phoneNumber": "' . $customer[0]['work_phone'] . '",
						"faxNumber": ""
					},
					"defaultShippingAddress": false
				}
			}';
		$step = 3;
		$responseshipping = $this->curlRequest($endpoint, $shippingaddress);
		if (isset($responseshipping['customerAddressId'])) {

			$authorize_response_array['customer_shipping_profile'] = array('status' => '1', 'message' => 'Shipping profile created successfully');

			$result = array(
				'status' => '1',
				'step_completed' => $step,
				'response' => json_encode($authorize_response_array),
				'customer_shipping_id' =>  $responseshipping['customerAddressId']
			);
			$this->create_customer_payment_profile($customer_id, $result);
			sleep(15);
			$policydata['details'] = $this->get_plan_policy_data($customer_id);
			$policydata['latest_policy'] = get_customer_policy($policydata['details']['policy_num']);
			$policydata['plan_value'] = get_plan_name('plan', $policydata['latest_policy']['plan'])['meta_content'];
			if ($policydata['latest_policy']['payment_split'] > 1) {
				$startdate  = $policydata['latest_policy']['plan_start'];
				$next_bill_date = date('Y-m-d', strtotime($policydata['latest_policy']['next_bill_date']));
				// $next_bill_date = date('Y-m-d', strtotime('+30 days', strtotime($startdate)));
				$dataArray =  array(
					'customerPaymentProfileId'  => $authorize_payment_profile,
					'customerProfileId'  => $authorize_profile,
					'customerAddressId'  => $responseshipping['customerAddressId'],
					'name'  => 'Subscription for ' . $policydata['details']['email'],
					'length'  =>  '1',
					'unit'  =>	"months",
					'startDate'  => $next_bill_date,
					"totalOccurrences" => $policydata['latest_policy']['charge_round'],
					"trialOccurrences" =>  '0',
					"amount" => $policydata['latest_policy']['plan_total'],
					"trialAmount" => "0.00",
				);

				$subscriptionresponse = $this->addRecurringDetails($dataArray, $customer_id);
				if ((isset($subscriptionresponse['msg']) && $subscriptionresponse['msg'] == 'error') || (isset($subscriptionresponse['messages']['resultCode']) && $subscriptionresponse['messages']['resultCode'] == 'Error')) {
					if (isset($subscriptionresponse['response']) && $subscriptionresponse['response'] != "") {
						$error = $subscriptionresponse['response'];
					} elseif (isset($subscriptionresponse['messages']['message'][0]['text'])) {
						$error = $subscriptionresponse['messages']['message'][0]['text'];
					}
					$step = 4;
					$authorize_response_array['subscription'] = $error;
					$result = array(
						'status' => '1',
						'step_completed' => $step,
						'response' => json_encode($authorize_response_array),

					);
					$this->create_customer_payment_profile($customer_id, $result);
				} else {
					if (isset($subscriptionresponse['subscriptionId'])) {
						$result = array(
							'subscription_id' => $subscriptionresponse['subscriptionId'],
							'customer_shipping_id' => $responseshipping['customerAddressId'],
							'authorize_payment_profile' => $authorize_payment_profile,
							//'payment_profileID' => $result['payment_profileID'],

						);
						if ($subscriptionresponse['messages']['resultCode'] != 'Error') {
							$this->create_customer_payment_profile($customer_id, $result);
						}
					}
				}
			}
		} else {
			$authorize_response_array['customer_shipping_profile'] = array('status' => '0', 'message' => 'Error while creating');
			$result = array(
				'status' => '0',
				'step_completed' => $step,
				'response' => json_encode($authorize_response_array),

			);

			$this->create_customer_payment_profile($customer_id, $result);
		}

		return  $result;
	}

	public function get_plan_policy_data($id)
	{
		$this->db->select('c.*, p.policy_num');
		$this->db->from('customers as c');
		$this->db->join('policy as p', 'p.customer = c.id');
		$this->db->where('c.id', $id);
		$query = $this->db->get();
		return $query->row_array();
	}

	public function addRecurringDetails($payment_profile, $customer_id)
	{

		$authorize = $this->subscriptionSetting();
		$login_id = (isset($authorize['merchant_id'])) ? $authorize['merchant_id'] : '';
		$merchant_transaction_key = (isset($authorize['merchant_security'])) ? $authorize['merchant_security'] : '';
		$endpoint = $authorize['endpoint'];
		$six_digit_random_number = mt_rand(100000, 999999);
		$billing  = '{
			"ARBCreateSubscriptionRequest": {
				"merchantAuthentication": {
					"name":  "' . $login_id . '",
					"transactionKey": "' . $merchant_transaction_key . '"
				},
				"refId": "' . $six_digit_random_number . '",
				"subscription": {
					"name": "Complete Care Home Warranty Subscription",
					"paymentSchedule": {
						"interval": {
							"length": "' . $payment_profile['length'] . '",
							"unit": "' . $payment_profile['unit'] . '"
						},
						"startDate": "' . $payment_profile['startDate'] . '",
						"totalOccurrences": "' . $payment_profile['totalOccurrences'] . '",
						"trialOccurrences": "' . $payment_profile['trialOccurrences'] . '"
					},
					"amount": "' . $payment_profile['amount'] . '",
					"trialAmount": "' . $payment_profile['amount'] . '",
					"profile": {
						"customerProfileId": "' . $payment_profile['customerProfileId'] . '",
						"customerPaymentProfileId": "' . $payment_profile['customerPaymentProfileId'] . '",
						"customerAddressId": "' . $payment_profile['customerAddressId'] . '"
					}
				}
			}
		}';

		$response = $this->curlRequest($endpoint, $billing);
		if (isset($response['messages']['resultCode']) && $response['messages']['resultCode'] == 'Error') {
			$error = $response['messages']['message'][0]['text'];
			$finalResult = array('msg' => 'error', 'response' => $error);
			return $finalResult;
		} else {
			$profileData = $this->getProfileIds($payment_profile['customerProfileId']);

			if (isset($response['subscriptionId'])) {
				$newsubID = $response['subscriptionId'];
			} elseif (isset($profileData['subscriptionIds']) && is_array($profileData['subscriptionIds'])) {
				$newsubID = end($profileData['subscriptionIds']);
			}

			if (isset($newsubID)) {
				$result = array(
					'subscription_id' => $newsubID,
					'authorize_payment_profile' => $payment_profile['customerPaymentProfileId'],
					'payment_profileID' => $payment_profile['customerProfileId'],
				);

				$this->create_customer_payment_profile($customer_id, $result);
			}
			return $response;
		}
	}


	public function getProfileIds($profileData)
	{
		$authorize = $this->subscriptionSetting();
		$login_id = (isset($authorize['merchant_id'])) ? $authorize['merchant_id'] : '';
		$merchant_transaction_key = (isset($authorize['merchant_security'])) ? $authorize['merchant_security'] : '';
		$endpoint = $authorize['endpoint'];
		$details = '{
				"getCustomerProfileRequest": {
					"merchantAuthentication": {
						"name": "' . $login_id . '",
                        "transactionKey": "' . $merchant_transaction_key . '"
					},
					"customerProfileId": "' . $profileData . '",
					"includeIssuerInfo": "true"
				}
			}';
		$response = $this->curlRequest($endpoint, $details);
		return $response;
	}
	public function curlRequest($endpoint, $details)
	{
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
			if (isset($response_array['messages']['messages']) && $response_array['messages']['messages'] == 'Error') {
				$error = $response_array['transactionResponse']['errors'][0]['errorText'];
				$finalResult = array('msg' => 'error', 'response' => $error);
				return $finalResult;
			} else {
				return $response_array;
			}
		}
	}

	public function save_lead($data)
	{
		//Check if lead_id already exists
		$this->db->where('website_lead_id', $data['lead_id']);
		$q = $this->db->get('leads');

		$this->db->set('first_name', $data['first_name']);
		$this->db->set('last_name', $data['last_name']);
		$this->db->set('email', $data['email']);
		$this->db->set('home_phone', $data['home_phone']);
		$this->db->set('cell_phone', $data['cell_phone']);
		$this->db->set('address', $data['address']);
		$this->db->set('city', $data['city']);
		$this->db->set('state', $data['state']);
		$this->db->set('zipcode', $data['zipcode']);

		$this->db->set('plan_name', $data['plan_name']);
		$this->db->set('plan_frequency', $data['plan_frequency']);
		$this->db->set('coupon_code', $data['coupon_code']);
		$this->db->set('discount', $data['discount']);
		$this->db->set('additional_options', $data['additional_options']);
		$this->db->set('total_charge', $data['total_charge']);
		$this->db->set('payment_status', $data['payment_status']);
		$this->db->set('lead_source', $data['lead_source']);
		$this->db->set('sid', $data['sid']);
		$this->db->set('uid', $data['uid']);
		$this->db->set('website_lead_id', $data['lead_id']);

		if ($q->num_rows() > 0) {
			$this->db->set('updated_at', date('Y-m-d H:i:s'));
			$this->db->where('website_lead_id', $data['lead_id']);
			$this->db->update('leads');
		} else {
			$this->db->insert('leads');
		}
	}

	public function getBatch($setting, $date_from, $date_to)
	{
		$date_from =  str_replace('+00:00', 'Z', gmdate('c', strtotime($date_from . ' 20:00:00')));
		$date_to =  str_replace('+00:00', 'Z', gmdate('c', strtotime($date_to . ' 19:59:59')));

		// echo $date_from;
		// echo " \n ";
		// echo $date_to;
		// die;

		$authorize = $this->subscriptionSetting();
		$login_id = (isset($setting->merchant_id)) ? $setting->merchant_id : '';
		$merchant_transaction_key = (isset($setting->merchant_security)) ? $setting->merchant_security : '';
		$endpoint = $authorize['endpoint'];
		$details = '{
				"getSettledBatchListRequest": {
					"merchantAuthentication": {
						"name": "' . $login_id . '",
                        "transactionKey": "' . $merchant_transaction_key . '"
					},
				"firstSettlementDate": "' . $date_from . '",
				"lastSettlementDate": "' . $date_to . '"
			}
		}';
		$responses = $this->curlRequest($endpoint, $details);
		// print_r($responses);
		// die;
		return $responses;
	}

	public function getBatchTransactions($setting, $batchId)
	{
		$authorize = $this->subscriptionSetting();
		$login_id = (isset($setting->merchant_id)) ? $setting->merchant_id : '';
		$merchant_transaction_key = (isset($setting->merchant_security)) ? $setting->merchant_security : '';
		$endpoint = $authorize['endpoint'];
		$details = '{
			"getTransactionListRequest": {
				"merchantAuthentication": {
					"name": "' . $login_id . '",
					"transactionKey": "' . $merchant_transaction_key . '"
				},
				"batchId" : "' . $batchId . '",
				"sorting": {
					"orderBy": "submitTimeUTC",
					"orderDescending": "true"
				},
				"paging": {
					"limit": "100",
					"offset": "1"
				}
			}
		}';
		$response = $this->curlRequest($endpoint, $details);
		return $response;
	}

	public function getBatchTransactionsDetail($setting, $transId)
	{
		// die("HERE");
		$authorize = $this->subscriptionSetting();
		$login_id = (isset($setting->merchant_id)) ? $setting->merchant_id : '';
		$merchant_transaction_key = (isset($setting->merchant_security)) ? $setting->merchant_security : '';
		$endpoint = $authorize['endpoint'];
		$details = '{
				"getTransactionDetailsRequest": {
					"merchantAuthentication": {
						"name": "' . $login_id . '",
						"transactionKey": "' . $merchant_transaction_key . '"
					},
					"transId": "' . $transId . '"
				}
			}';
		echo $details;
		echo "<br />";
		// die();
		$response = $this->curlRequest($endpoint, $details);


		return $response;
	}

	/* GET CUSTOMERS TO CREATE ARB PROFILE */
	public function get_customersARB($subscription)
	{
		$query = $this->db->query("SELECT * FROM customer_payment_profiles where subscription_id = {$subscription}");
		return $query->result_array();
	}


	public function insert_notes($data)
	{
		$this->db->set('customer', isset($data['customer']) ? $data['customer'] : NULL);
		//$this->db->set('vendor', isset($data['vendor'])?$data['vendor']:NULL);
		// $this->db->set('customer', $data['customer']);
		//$this->db->set('assign_by', $this->session->userdata('admin_id'));
		$this->db->set('details', $data['text']);
		$this->db->set('type', 3);
		$this->db->set('created_at', date('Y-m-d H-i-s'));
		$this->db->insert('tasks_notes');
		return $this->db->insert_id();
	}

	public function insert_payment($customer_details)
	{
		$query = $this->db->query("SELECT * FROM payments where transaction_id = {$customer_details['transId']}");
		$count = $query->num_rows();
		if ($count == 0) {
			if (isset($customer_details['customer_id'])) {
				$this->db->set('customer_id', $customer_details['customer_id']);
			}
			if (isset($customer_details['card_id'])) {
				$this->db->set('card_id', $customer_details['card_id']);
			}
			if (!empty($customer_details['code'])) {
				$this->db->set('code', $customer_details['code']);
			}
			if (!empty($customer_details['transId'])) {
				$this->db->set('transaction_id', $customer_details['transId']);
			}

			if (!empty($customer_details['renewal_id'])) {
				$this->db->set('policy_renewal_id', $customer_details['renewal_id']);
			}
			if (!empty($customer_details['networkTransId'])) {
				$this->db->set('refId', $customer_details['networkTransId']);
			}
			if (!empty($customer_details['authCode'])) {
				$this->db->set('authcode', $customer_details['authCode']);
			}
			if (!empty($customer_details['settleAmount'])) {
				$this->db->set('amount_approved', $customer_details['settleAmount']);
			}
			if (!empty($customer_details['description'])) {
				$this->db->set('message', $customer_details['description']);
				if($customer_details['description']=="declined"){
					$this->db->set('status', 2);
				}
				else if($customer_details['description']=="settledSuccessfully"){
					$this->db->set('status', 1);
				}
				else{
					$this->db->set('status', 3);
				}
			}


			if (!empty($customer_details['code'])) {
				$result_code = $customer_details['code'];
				if ($result_code == 1) {
					$this->db->set('status', 1);
				}
			}
			$this->db->set('created_at', date('Y-m-d H-i-s'));
			$card_id = $this->db->insert('payments');
			if($customer_details['description']=="declined"){
				$msg = "Payment for ".date('M,Y')." <strong>declined</strong> <br/>Status changed to <b>". policy_status(4)."</b>"; 
            	save_general_note($customer_details['customer_id'],$msg);
			}
			elseif($customer_details['description']=="settledSuccessfully"){
				$msg = "Payment for ".date('M,Y')." <strong>settled</strong> successfully."; 
            	save_general_note($customer_details['customer_id'],$msg);
			}else{
				$msg = "ATTENTION NEEDED: Payment for ".date('M,Y')."  -  ".$customer_details['description']; 
            	save_general_note($customer_details['customer_id'],$msg);
			}
			return $card_id;
		}
	}
	public function set_ActivePolicyRenewal($date)
	{
		$status = '2';
		$this->db->set('status', $status);
		$this->db->where('str_to_date(plan_end,"%Y-%m-%d") < str_to_date("' . $date . '","%Y-%m-%d")');
		$result = $this->db->update('policy_renewal');
		return $this->db->affected_rows();
	}
	public function set_ExpirePolicyRenewal($date)
	{
		$status = '6';
		$this->db->set('status', $status);
		$this->db->where('str_to_date(plan_start,"%Y-%m-%d") >= str_to_date("' . $date . '","%Y-%m-%d")');
		$result = $this->db->update('policy_renewal');
		return $this->db->affected_rows();
	}

	public function get_customer_policy($policy_num)
	{

		$this->db->select('*');
		$this->db->from('policy_renewal');
		$this->db->where('policy_num', $policy_num);
		$this->db->where('status', '2');
		return $this->db->get()->row_array();
	}

	public function updatepolicystatus($data)
	{
		$this->db->set('status', '4');
		$this->db->where('id', $data['id']);
		$this->db->update('policy_renewal');
		return $this->db->affected_rows();
    }
}
