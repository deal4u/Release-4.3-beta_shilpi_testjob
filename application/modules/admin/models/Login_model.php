<?php 
class Login_model extends CI_Model
{
	
	public function get_login($email,$password)
	{
		$hash_pass="password('".$password."')";
		$this->db->select('id');
		$this->db->select('AdminID');
		$this->db->select('FirstName');
		$this->db->select('LastName');
		$this->db->select('Email');
		$this->db->select('type');
		$this->db->where('Email',$email);		
		$this->db->where('Password',$hash_pass, FALSE);
		$this->db->where('status',1);
		$query=$this->db->get('admins');
		return $query->row_array();
	}
	public function check_email($email)
	{
		$this->db->select('*');
		$this->db->where('Email',$email);
		$query = $this->db->get('admins');
		return $query->num_rows();
	}

	public function get_details($email)
	{
		$this->db->select('FirstName');
		$this->db->select('LastName');
		$this->db->select('Email');
		$this->db->where('Email',$email);			
		$query=$this->db->get('admins');
		return $query->row();	
	}

	public function set_admin_password($email, $new_password)
	{
		$hash_pass="password('".$new_password."')";
		$this->db->set('Password',$hash_pass, FALSE);	
		$this->db->where('Email',$email);		
		$query=$this->db->update('admins');
		return $this->db->affected_rows();
	}

	public function get_starts_policy()
	{
		$this->db->set('status','2');
		// $this->db->where('DATE(plan_start)', date("Y-m-d"));
		$this->db->where('DATE(plan_start) <= ', date("Y-m-d"));
		$this->db->where('status','1');
		$this->db->update('policy_renewal');

		$this->db->set('status','6');
		// $this->db->where('DATE(plan_end)', date("Y-m-d"));
		$this->db->where('DATE(plan_end) <= ', date("Y-m-d"));
		$this->db->where('status !=', '1');
		$this->db->update('policy_renewal');

	}
	public function insert_activity($dataArray ){
		$this->db->insert('login_activities',$dataArray);
	   
   }


}

?>
