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

}
