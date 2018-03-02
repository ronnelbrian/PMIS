<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class validation_model extends CI_Model
{
	public function validateuser($input)
	{
		$username = $this->security->xss_clean($input['username']);
		$password = $this->security->xss_clean($input['password']);
		$sess_array = array();

		$qr = $this->db->query("SELECT u.id userid, CONCAT(lname, ', ', fname, ' ', mname, ' ', suffix) name, username, r.description usertype, image_path FROM users u
									INNER JOIN role r 
									ON r.id = u.role
									WHERE username = ? AND password = ?",array($username, sha1(md5($password)))); 
		if ($qr->num_rows() > 0) 
		{	   
			$this->load->library('session');
			$this->session->set_userdata(array(
                        'USERID'       => $qr->result()[0]->userid,
                        'USERTYPE'     => $qr->result()[0]->usertype,
                        'NAME'         => $qr->result()[0]->name,
                        'USERNAME'     => $qr->result()[0]->username,
                        'IMAGE_PATH'     => $qr->result()[0]->image_path
                ));
			$sess_array['IsError']=0;	
			$sess_array['url'] = base_url('Admin');	
		}
		else
		{
			$sess_array['IsError']=1;
		}
		return $sess_array;
	}

	public function access($get = 0, $trans = "")
	{
		$res = array();
		($this->session->userdata('USERID'))?$id = $this->session->userdata('USERID'):$id = 0;
		if($get == 0)
			$q = $this->db->query("SELECT trans ac 
									from access_control 
									where userid = ? and ((ac_read is not null and ac_read != 0) or (ac_write is not null and ac_write != 0))", $id);
		else
			$q = $this->db->query("SELECT CONCAT(trans,'/', coalesce(ac_read,0),'/', coalesce(ac_write,0)) ac 
									from access_control
									where userid = ? and trans = ?", array($id, $trans));
		if($q->num_rows() > 0)
			foreach($q->result() as $r)
				$res[] = $r->ac;
		else
		{
			$res[] = $trans.'/0/0';
		}
		
		return $res;
	}

}
?>