<?php 
class Login_model extends CI_Model
{
	
	public function get_login($email,$password)
	{
		$hash_pass="password('".$password."')";
		$this->db->select('*');
		$this->db->where('email',$email);		
		$this->db->where('password',$hash_pass, FALSE);
		$this->db->where('status',1);
		$query=$this->db->get('customers');
		return $query->row_array();
	}
	public function check_email($email)
	{
		$this->db->select('*');
		$this->db->where('email',$email);
		$query = $this->db->get('customers');
		return $query->num_rows();
	}

	public function get_details($email)
	{
		$this->db->select('*');
		$this->db->where('email',$email);			
		$query=$this->db->get('customers');
		return $query->row();	
	}

	public function set_admin_password($email, $new_password)
	{
		$hash_pass="password('".$new_password."')";
		$this->db->set('password',$hash_pass, FALSE);	
		$this->db->where('email',$email);		
		$query=$this->db->update('customers');
		return $this->db->affected_rows();
	}

	/* login activities */
	public function insert_activity($dataArray ){
		 $this->db->insert('login_activities',$dataArray);
	}

}

?>
