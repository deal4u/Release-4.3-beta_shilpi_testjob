<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class common_model extends CI_Model {

	public function insert_data($data, $table) {
		$this->db->insert($table, $data);
		return $this->db->insert_id();
	}

	public function get_data($id, $table, $where = "", $select = '', $limit = '', $order_by = "", $order = "", $joins = '', $group_by = "") {
		if ($group_by != "") {
			$this->db->group_by($group_by);
		}

		if ($limit != "") {
			$this->db->limit($limit[0], $limit[1]);
		}

		if (!is_array($order_by)) {
			if ($order_by != "") {
				if ($order != "") {
					$this->db->order_by($order_by, $order);
				} else {
					$this->db->order_by($order_by, "desc");
				}
			}
		} else {
//            print_r($order_by);exit;
			foreach ($order_by as $key => $orders) {
				$this->db->order_by($orders[0], $orders[1]);
//                print_r($orders);
			}
//            exit;
		}


		if ($joins != "") {
			foreach ($joins as $join) {
				$this->db->join($join[0], $join[1], $join[2]);
			}
		}


		if ($where != "") {
			$this->db->where($where);
		}


		if ($id != "") {
			$this->db->where('id', $id);
		}

		if (is_array($select)) {
			foreach ($select as $key => $value) {
				$this->db->select($value);
			}

		} else {
			$this->db->select($select);
		}

		$result = $this->db->get($table)->result_array();

		return $result;
	}

	public function delete_data($id, $table, $where = "") {

		if ($where != "") {
			$this->db->where($where);
		} else {
			$this->db->where('id', $id);
		}
		return $this->db->delete($table);
	}

	public function email($email,$subject,$message){

		$this->load->library('email');
		$this->email->initialize(array(
			'protocol' => 'smtp',
			'smtp_host' => 'smtp.sendgrid.net', //your host name
			'smtp_user' => 'waleedafzal569', //your user name
			'smtp_pass' => 'chaudarybaba569', //your password
			'smtp_port' => 587,
			'crlf' => "\r\n",
			'newline' => "\r\n",
			'mailtype' => 'html',
			'charset' => 'iso-8859-1',
			'wordwrap' => TRUE
		));

		$this->email->from('ahmad_ashfaq888@yahoo.com', 'Leadjones');
		$this->email->to($email);
		$this->email->subject($subject);
		$this->email->message($message);
		$this->email->send();


	}

	public function update_data($id, $table, $data, $where = "") {

		if ($where != "") {
			$this->db->where($where);
		} else {
			$this->db->where('id', $id);
		}
		return $this->db->update($table, $data);
	}



	public function get_plan_policy_data_old($id, $table, $where = "", $select = '', $limit = '', $order_by = "", $order = "", $joins = '', $group_by = "") {
		if ($group_by != "") {
			$this->db->group_by($group_by);
		}

		if ($limit != "") {
			$this->db->limit($limit[0], $limit[1]);
		}

		if (!is_array($order_by)) {
			if ($order_by != "") {
				if ($order != "") {
					$this->db->order_by($order_by, $order);
				} else {
					$this->db->order_by($order_by, "desc");
				}
			}
		} else {
			foreach ($order_by as $key => $orders) {
				$this->db->order_by($orders[0], $orders[1]);
			}
		}


		if ($joins != "") {
			foreach ($joins as $join) {
				$this->db->join($join[0], $join[1], $join[2]);
			}
		}


		if ($where != "") {
			$this->db->where($where);
		}


		if ($id != "") {
			$this->db->where('customer', $id);
		}

		if (is_array($select)) {
			foreach ($select as $key => $value) {
				$this->db->select($value);
			}

		} else {
			$this->db->select($select);
		}

		$result = $this->db->get($table)->result_array();

		return $result;
	}

	public function get_plan_policy_data()
	{
      $this->db->select('c.id, c.first_name, c.last_name, c.salesperson, c.email, c.send_mail, c.home_phone, c.created_at, c.work_phone, c.p_firstname, c.p_lastname, c.p_phone, c.p_work_phone, c.p_email, c.street_address, c.city, c.state, c.zip_code, c.mail_address, c.mail_city, c.mail_state, c.mail_zipcode, c.bill_address, c.bill_city, c.bill_state, c.bill_zipcode, c.bill_cardname, c. ip_address, c.card_num, c.card_exp_month, c.card_exp_year, c.card_pin, pr.policy_num, pr.property_type, pr.size, pr.plan, pr.plan_year, pr.payment_split, pr.free_month, pr.discount, pr.m_charge, pr.plan_total, pr.plan_discount, pr.scf, pr.free_scf, pr.plan_start, pr.plan_end, pr.charge_state, pr.status');
		$this->db->from('customers as c');
		$this->db->join('policy as p', 'p.customer = c.id');
		$this->db->join("policy_renewal as pr", "pr.policy_num = p.policy_num");
		$this->db->order_by('pr.created_at', 'DESC');
		$query = $this->db->get();
		return $query->result_array();
	}

}
