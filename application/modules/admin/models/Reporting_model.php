<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reporting_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
    }

    public function search_customer($data)
    {
        $this->db->select('customers.*,policy.policy_num');
        $this->db->from('customers');
        $this->db->join('policy', 'customers.id = policy.customer', 'left');
        if (isset($data['source'])) {
            $this->db->like('customers.leadsource', $data['source']);
        }
        if (!empty($data['startdate'])) {
            $date=date_create($data['startdate']);
            $start_date = date_format($date,"Y-m-d");
            $this->db->where("DATE_FORMAT(customers.created_at,'%Y-%m-%d') >= '$start_date'",NULL,FALSE);
        }
        if (isset($data['enddate'])) {
            $date=date_create($data['enddate']);
            $end_date = date_format($date,"Y-m-d");
            $this->db->where("DATE_FORMAT(customers.created_at,'%Y-%m-%d') <= '$end_date'",NULL,FALSE);
        }
        $this->db->order_by('customers.created_at', 'DESC');
        $this->db->group_by('customers.id');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_customer_sale_by_date($customer, $dates)
    {
        $payments = $this->db->query("SELECT SUM(amount_approved) AS total FROM
 `payments` WHERE `customer_id` = ".$customer." AND (`type` = 1 OR `type` = 3) AND id NOT IN
 (SELECT parent_id FROM `payments` WHERE `customer_id` = ".$customer." AND `type` = 3 AND `status` = 1) AND `status` = 1 
 AND (created_at BETWEEN '".$dates['startdate']."' AND '".$dates['enddate']."')")->row_array();
        $refunds = $this->get_customer_refunds($customer, $dates);
        $result = $payments['total'] - $refunds;
        return $result;
    }

    public function get_customer_refunds($customer, $dates)
    {
        $result = $this->db->query("select sum(amount_approved) As total from `payments` 
where parent_id in (SELECT id FROM
 `payments` WHERE `customer_id` = ".$customer." AND (`type` = 1 OR `type` = 3) AND id NOT IN
 (SELECT parent_id FROM `payments` WHERE `customer_id` = ".$customer." AND `type` = 3 AND `status` = 1) AND `status` = 1 
 AND (created_at BETWEEN '".$dates['startdate']."' AND '".$dates['enddate']."')) and `type` = 2 and `status` = 1")->row_array();
        return $result['total'];
    }

    public function get_customer_by_date($source, $dates)
    {
        $result = $this->db->query("SELECT * FROM `customers` WHERE `leadsource` = ".$source." AND (created_at BETWEEN '".$dates['startdate']."' AND '".$dates['enddate']."')")->result_array();
        return $result;
    }

    public function get_policy_num($customer)
    {
        $this->db->select('policy_num');
        $this->db->from('policy');
        $this->db->where('customer', $customer);
        $query = $this->db->get();
        return $query->row_array();
    }
}
