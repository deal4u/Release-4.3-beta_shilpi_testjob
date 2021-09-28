<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Api extends Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model(admin_controller() . 'api_model');
	}

	public function getCallSetting_get()
	{

		$post['meta_tag'] = 'configuration';
		$post['meta_key'] = 'callnow_toggle';
		$postData = $this->api_model->getCallSetting($post);
		if (isset($postData)) {
			$response = [
				'status' => 'success',
				'msg' => 'data found',
				'response' => array('callnow_toggle' => $postData[0]['meta_value']),
			];
		}
		echo json_encode($response);
		die;
	}

	/* GET LEAD SOURCE ACC TO LEAD SOURCE ID */
	public function getSource_get()
	{
		//echo  base64_encode($_GET['lead_source']);
		if ($_GET['lead_source'] != "") {
			$id = urldecode($_GET['lead_source']);
			$sourceData = $this->api_model->get_source($id);
			if ($sourceData) {
				$sourceData = $this->replaceMultiArrayValues($sourceData[0], array('NULL', '', NULL));
				$response = [
					'status' => 'success',
					'msg' => 'data found',
					'response' => array('sourcedata' => $sourceData),
				];
				echo json_encode($response);
				die;
			} else {
				$response = [
					'status' => 'error',
					'msg' => 'no data found',
					'response' => array(),
				];
				echo json_encode($response);
				die;
			}
		}
	}

	/* CREATE ARB PROFILES  */
	public function addARBProfile_get($customer_id = 0, $date_from = 0, $date_to = 0)
	{
		if (execute_arb_profile_from_cron == '1') {
			//	$dates['startdate'] = date('Y-m-d 00:00:00',time());
			if ($date_from == 0)
				$dates['startdate'] = date('2021-01-01 00:00:00');
			else
				$dates['startdate'] = date($date_from . ' 00:00:00');

			if ($date_to == 0)
			$dates['enddate'] = date('Y-m-d 23:59:59', time());
			else
				$dates['enddate'] = date($date_to . ' 23:59:59', time());
			$sourceData = $this->api_model->get_customers_ARB($dates);
			if ($sourceData) {

				$response = [];
				foreach ($sourceData as $customerData) {
					if($customer_id != 0){
						if($customerData['id'] == $customer_id) {
							$response[] = $this->createARB($customerData);
							break;
						}
					}
					else{
						$response[] = $this->createARB($customerData);
					}					

					
				}
				echo json_encode($response);
				die;
			} else {
				$response = [
					'status' => 'error',
					'msg' => 'no data found',
					'response' => array(),
				];
				echo json_encode($response);
				die;
			}
		}
	}

	public function createARB($customerData) {
		// echo "<pre>";print_r($customerData);echo "</pre>";
		$profile = $this->api_model->get_customer_payment_profile($customerData['id']);
		if (empty($profile['authorize'])) {
			$charge_response =  $this->api_model->createCustomerProfile($customerData['id']);
			$response = [
				'status' => 'success',
				'msg' => 'data found for customer ' . $customerData['id'],
				'response' => array('sourcedata' => $charge_response),
			];
			return $response;	
		}
		else {
			return false;
		}
		
	}
	public function replaceMultiArrayValues($dataArray, $values)
	{
		foreach ($values as $ditto) {
			$ar = array_replace(
				$dataArray,
				array_fill_keys(
					array_keys($dataArray, $ditto),
					''
				)
			);
		}
		return $ar;
	}

	public function savelead_get()
	{

		if ($_GET) {
			$data = $this->input->get();
			$save_lead = $this->api_model->save_lead($data);
			// $response[] = [
			// 	'status' => 'success',
			// 	'msg' => 'data found',
			// 	'response' => array('savelead'=>$save_lead),
			// ]; 
			// echo json_encode($response);die;
		}
	}

	public function getBatch_get($date_from = 0, $date_to = 0)
	{
		if ($date_from == 0) {
			$date_from = $lastWeek = date("Y-m-d", strtotime("-2 day"));
			//set this to -2 days to load entries from yesteday
		}

		if (($date_to == 0)) {
			if (($date_from != 0)) {
				$date_to = date('Y-m-d', strtotime($date_from . ' +1 day'));
			} else {
				$date_to = date('Y-m-d', strtotime(date('Y-m-d') . ' +1 day'));
			}
		}
		$settings  = "";
		$modes = get_setting('payment_method', $meta_key = "", $all = 1);
		foreach ($modes as $modename) {
			$settings = json_decode($modename['meta_content']);
			$batchlist = $this->api_model->getBatch($settings, $date_from, $date_to);
			$response = array();

			if ($batchlist['messages']['resultCode'] == 'Error') {
				if (isset($batchlist['messages']['message'][0]['text'])) {
					echo $batchlist['messages']['message'][0]['text'];
				}
			} else {
				if ($modename['meta_value'] == 'EMS') {
				foreach ($batchlist['batchList'] as $_batchlist) {
					$transactions = $this->getBatchTransactions($settings, $_batchlist['batchId']);
						print_r($transactions);
						// echo json_encode($transactions);
						// echo " \n";
						echo "==================================================== \n"; 
						echo " \n";
						// error_reporting(1);
						// $transactions = $this->transation();
						// print_r($transactions);die;
					foreach ($transactions['transactions'] as $_transaction) {
						if (isset($_transaction['subscription']['id']) && $_transaction['subscription']['id'] != "") {
								// print_r($_transaction);
								// die("2");
							$customerDetails =   $this->api_model->get_customersARB($_transaction['subscription']['id']);
								//  print_r($customerDetails);
								//  die("3");
							if (!empty($customerDetails)) {
									if ($_transaction['transactionStatus'] == 'settledSuccessfully') {
										// die("dsadas");
									$trabsactionDetails = $this->api_model->getBatchTransactionsDetail($settings, $_transaction['transId']);
										print_r($trabsactionDetails);
										$customers = $trabsactionDetails['transaction']['customer']['id'];
										$networkTransId = $trabsactionDetails['transaction']['networkTransId'];
									
									} else {
										/// note add main status
										echo "<br/> Here </br>";
										$policydata = $this->api_model->get_plan_policy_data($customerDetails[0]['customer_id']);
										print_r($policydata);

										$renewaldetaails = $this->api_model->get_customer_policy($policydata['policy_num']);
										echo "<br/> 2 </br>";
										
										print_r($renewaldetaails);
										$updatestatus = $this->api_model->updatepolicystatus(['id' => $renewaldetaails['id']]);
										
										$networkTransId = "";

										// if ($updatestatus > 0) {
											
											
										// 	// $data = array(
										// 	// 	'customer' => $customerDetails[0]['customer_id'],
										// 	// 	'text' => 'Payment is declined and current status is past due.Message from cronjob ' . $_transaction['transactionStatus'],
										// 	// );
										// 	// $this->api_model->insert_notes($data);
										// 	// $response[$customerDetails[0]['customer_id']] = $_transaction['transactionStatus'];
										// }
									}
									$data = array(
										'transId' 		=> $_transaction['transId'],
										//'code' 			=> $_transaction['code'],
										'settleAmount' 	=> $_transaction['settleAmount'],
										'description' 	=> $_transaction['transactionStatus'],
										'customer_id' 	=> $customerDetails[0]['customer_id'],
										'payment_mode' 	=> $modename['meta_value'],
										'networkTransId' => $networkTransId,
									);

									$this->api_model->insert_payment($data);
									$response[$customerDetails[0]['customer_id']] = 'success';
									// print_r($response);
									// die('5');
								}
								print_r($response);
							}
						}
					}
				}
			}
		}
	}

	public function getBatchTransactions($settings, $batchId)
	{
		$batchlist = $this->api_model->getBatchTransactions($settings, $batchId);
		return 	$batchlist;
	}
	public function updatepolicystatus_get()
	{
		$date = date("Y-m-d");
		$RenewId = $this->api_model->set_ActivePolicyRenewal($date);
		$expiry = $this->api_model->set_ExpirePolicyRenewal($date);
		$responses = array('Expiry_count' => $expiry, 'Renew_count' => $RenewId);
		$response = [
			'status' => 'success',
			'msg' => 'Records Updated data in response',
			'response' => $responses,
		];
		echo json_encode($response);
		die;
    }
}
