<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class access extends CI_Controller {

	function __construct()
    {
        parent::__construct();		
    } 	
    public function index()
	{
		if($this->session->userdata('USERID'))	
		{	
			if($this->session->userdata('USERTYPE'))
				redirect(base_url('Admin'));
			else
				$this->load->view('access/login');
		}
		else
			$this->load->view('access/login');
	}
	public function check_session()
	{
		if($this->session->userdata('USERID'))	
			echo json_encode('1');
		else
			echo json_encode('0');
	}
	public function validatecredentials()
	{
		if(isset($_POST['username']) && isset($_POST['password']))
		{
			$this->output->set_output(print(json_encode($this->validation_model->validateuser($_POST))));
			exit();
		}
		else
			redirect(base_url());
	}
	public function changepass()
	{
		if(isset($_POST['pass_']))
		{
			if($_POST['pass_'] == $_POST['confirm_pass_'])
			{
				$this->db->where('id', $this->session->userdata('USERID'));
				$this->db->update('users', array('password' => sha1(md5($this->security->xss_clean($_POST['pass_'])))));
				echo json_encode(array('mes' => "Success"));
				$this->session->sess_destroy();
				exit();
				
			}
			else
				echo json_encode(array('mes' => "Password does not match."));
			
		}
		else
			redirect(base_url());
	}
	public function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url());
	}
}

?>

