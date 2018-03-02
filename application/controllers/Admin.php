<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	function __construct()
    {
        parent::__construct();	

    } 	
	
	public function index()
	{	
		if($this->session->userdata('USERID'))
		{
			$ac = $this->validation_model->access();
			// echo json_encode($ac);
			if(in_array('AD', $ac))
				$this->admin_dashboard();
			else if(in_array('UD', $ac))
				$this->user_dashboard();
			else
			{
				$data['ac'] = $this->validation_model->access();
				$data['menu'] = 'user_dashboard';

				$this->load->view('template/header',$data);
				$this->load->view('admin/user_dashboard');		
				$this->load->view('template/footer');
			}
		}
		else
			redirect(base_url());
	}

	public function admin_dashboard()
	{
		$ac = $this->validation_model->access();

		if(in_array('AD', $ac))
		{
			if(isset($_POST['loadBudget']))
			{
				$office = array();
				$remaining = array();
				$consumed = array();
				$budget = array();
				$q = $this->getdata_model->budget_allocation('loadtable', array('year_' => $this->security->xss_clean($_POST['year_'])));
				foreach($q as $r)
				{
					$office[] = $r[1];
					$budget[] = intval($r[7]);
					$consumed[] = intval($r[9]);
					$remaining[] = intval($r[10]);
				}
				echo json_encode(array('mes' => 'Success', $office, $budget, $consumed, $remaining));
				exit();
			}
			else
			{
				$q = $this->db->query("SELECT TOP 1 (SELECT COUNT(*) FROM product p 
											LEFT JOIN inventory i 
											ON i.product = p.id AND i.status = 1
											WHERE COALESCE(current_stock,0) <= p.critical_level AND p.status = 1) p,

											(SELECT COUNT(*) FROM request_item_line WHERE STATUS = 1 AND (request_status = 'pending' OR request_status IS NULL)) i,

											(SELECT COUNT(*) FROM purchase_order WHERE po_status = 'New') po FROM  product");
				$d = array();
				$d[] = (isset($q->result()[0]->p))?$q->result()[0]->p:0;
				$d[] = (isset($q->result()[0]->i))?$q->result()[0]->i:0;
				$d[] = (isset($q->result()[0]->po))?$q->result()[0]->po:0;

				$data['d'] = $d;
				$data['ac'] = $this->validation_model->access();
				$data['menu'] = 'admin_dashboard';


            
				$result = array();
				$d = array();
				$p = array();
				$ctr = 1;
				$q = $this->db->query("SELECT
										  p.description product,
										  COALESCE(current_stock,0) current_stock
										FROM product p 
										LEFT JOIN inventory i 
										ON i.product = p.id");

				foreach($q->result() as $r)
				{
					$d[] = array($ctr,intval($r->current_stock));
					$p[] = array($ctr,$r->product);
					$ctr++;
					$result[] = array($r->product, $d, $p);
				}

				$critical  = array();
				$q = $this->db->query("SELECT p.id, p.description, p.critical_level, COALESCE(current_stock,0) current_stock, u.code unit  FROM product p 
											LEFT JOIN inventory i 
											ON i.product = p.id AND i.status = 1
											inner join units u
											on u.id = p.measurement
											WHERE COALESCE(current_stock,0) < p.critical_level AND p.status = 1");

				foreach($q->result() as $r)
					$critical[] = array($r->description, $r->id, $r->critical_level, $r->current_stock, $r->unit);

				$data['p'] = $result; 
				$data['c'] = $critical;

				$res = array();
				$q = $this->db->query("SELECT year_budget FROM office_budget  WHERE STATUS = 1 GROUP BY year_budget");
				foreach($q->result() as $r)
					$res[] = $r->year_budget;
				$data['year_'] = $res;

				

				$this->load->view('template/header',$data);
				$this->load->view('admin/dashboard');		
				$this->load->view('template/footer');
			}
		}
		else
		{
			redirect(base_url());
		}
	}
	public function user_dashboard()
	{
		$ac = $this->validation_model->access();

		if(in_array('UD', $ac))
		{
			$data['ac'] = $this->validation_model->access();
			$data['menu'] = 'user_dashboard';

			$this->load->view('template/header',$data);
			$this->load->view('admin/user_dashboard');		
			$this->load->view('template/footer');
		}
		else
		{
			redirect(base_url());
		}
	}

	public function user_roles()
	{
		$ac = $this->validation_model->access();

		if(in_array('UR', $ac))
		{
			if(isset($_GET['loadtable']))
			{
				$output = $this->getdata_model->user_roles('loadtable', $_GET);
		        $response = array(
		          'aaData' => $output,
		          'iTotalRecords' => count($output),
		          'iTotalDisplayRecords' => count($output),
		          'iDisplayStart' => 0
		        );
		        echo json_encode($response);
		        exit();
			}
			else if(isset($_POST['getspecific']))
			{
				echo json_encode($this->getdata_model->user_roles('getspecific', $_POST));
				exit();
			}
			else if(isset($_POST['act']))
			{
				echo json_encode($this->savedata_model->user_roles($_POST));
				exit();
			}
			else
			{
				$data['menu'] = "user_roles";
				$data['ac'] = $this->validation_model->access();

				$ac = $this->validation_model->access(1, 'UR');
				$val = explode('/', $ac[0]);
				// echo json_encode($val);
				// exit();
				$data['r_'] = $val[1];
				$data['w_'] = $val[2];

				$this->load->view('template/header',$data);
				$this->load->view('admin/user_roles');		
				$this->load->view('template/footer');
			}
		}
		else
		{
			redirect(base_url());
		}
	}

	public function system_users()
	{
		$ac = $this->validation_model->access();

		if(in_array('SU', $ac))
		{
			if(isset($_GET['loadtable']))
			{
				$output = $this->getdata_model->system_users('loadtable', $_GET);
		        $response = array(
		          'aaData' => $output,
		          'iTotalRecords' => count($output),
		          'iTotalDisplayRecords' => count($output),
		          'iDisplayStart' => 0
		        );
		        echo json_encode($response);
		        exit();
			}
			else if(isset($_POST['getspecific']))
			{
				echo json_encode($this->getdata_model->system_users('getspecific', $_POST));
				exit();
			}
			else if(isset($_POST['act']))
			{
				($_POST['act'] == 'save')?$file = '':$file = 'noprofilepic.png';;
				if (!empty($_FILES["profilepic"]["type"]) && file_exists("assets/uploads/" . $_FILES["profilepic"]["name"])) 
				{
					$suffix = 0;
					$name = pathinfo($_FILES['profilepic']['name'], PATHINFO_FILENAME);
					$extension = pathinfo($_FILES['profilepic']['name'], PATHINFO_EXTENSION);
					if(strcasecmp($extension, 'JPEG') == 0 || strcasecmp($extension, 'JPG') == 0 || strcasecmp($extension, 'PNG') == 0)
					{
						while(file_exists("assets/uploads/".$name.".".$extension))
						{
							$name = pathinfo($_FILES['profilepic']['name'], PATHINFO_FILENAME);
							$name .=$suffix;
							$suffix++;
						}
						$basename = $name.".".$extension;

						$sourcePath = $_FILES['profilepic']['tmp_name'];
						$targetPath = "assets/uploads/".$basename;
						move_uploaded_file($sourcePath,$targetPath) ; 
						$file = $basename;
					}
					else
					{
						echo json_encode(array('mes' => 'You uploaded an invalid file. Make sure that the file format of the image you are uploading is JPG/JPEG/PNG.'));
						exit();
					}
				}
				else if(!empty($_FILES["profilepic"]["type"]))
				{
					$extension = pathinfo($_FILES['profilepic']['name'], PATHINFO_EXTENSION);
					if(strcasecmp($extension, 'JPEG') == 0 || strcasecmp($extension, 'JPG') == 0 || strcasecmp($extension, 'PNG') == 0)
					{
						$sourcePath = $_FILES['profilepic']['tmp_name'];
						$targetPath = "assets/uploads/".$_FILES["profilepic"]["name"]; 
						move_uploaded_file($sourcePath,$targetPath) ; 
						$file = $_FILES["profilepic"]["name"];
					}
					else
					{
						echo json_encode(array('mes' => 'You uploaded an invalid file. Make sure that the file format of the image you are uploading is JPG/JPEG/PNG.'));
						exit();
					}
				}

				echo json_encode($this->savedata_model->system_users($_POST, $file));
				exit();
			}
			else
			{
				$data['menu'] = "system_users";
				$data['ac'] = $this->validation_model->access();
				$data['role'] = $this->getdata_model->user_roles('loadtable');

				$ac = $this->validation_model->access(1, 'SU');
				$val = explode('/', $ac[0]);
				$data['r_'] = $val[1];
				$data['w_'] = $val[2];

				$this->load->view('template/header',$data);
				$this->load->view('admin/system_users');		
				$this->load->view('template/footer');
			}
		}
		else
		{
			redirect(base_url());
		}
	}

	public function user_office_assignment()
	{
		$ac = $this->validation_model->access();

		if(in_array('UOA', $ac))
		{
			if(isset($_GET['loadtable']))
			{
				$output = $this->getdata_model->user_office_assignment('loadtable', $_GET);
		        $response = array(
		          'aaData' => $output,
		          'iTotalRecords' => count($output),
		          'iTotalDisplayRecords' => count($output),
		          'iDisplayStart' => 0
		        );
		        echo json_encode($response);
		        exit();
			}
			else if(isset($_POST['getspecific']))
			{
				echo json_encode($this->getdata_model->user_office_assignment('getspecific', $_POST));
				exit();
			}
			else if(isset($_POST['loadUser']))
			{
				echo json_encode($this->getdata_model->user_office_assignment('loadUser', $_POST));
				exit();
			}
			else if(isset($_POST['loadOffice']))
			{
				echo json_encode($this->getdata_model->department_office('loadtable2'));
				exit();
			}
			else if(isset($_POST['getSpecificOffice']))
			{
				echo json_encode($this->getdata_model->user_office_assignment('getspecificoffice', $_POST));
				exit();
			}
			else if(isset($_POST['act']))
			{
				echo json_encode($this->savedata_model->user_office_assignment($_POST));
				exit();
			}
			else
			{
				$data['menu'] = "user_office_assignment";
				$data['ac'] = $this->validation_model->access();
				$ac = $this->validation_model->access(1, 'UOA');
				$val = explode('/', $ac[0]);
				$data['r_'] = $val[1];
				$data['w_'] = $val[2];


				$data['user'] = $this->getdata_model->user_office_assignment('loadUser');

				$this->load->view('template/header',$data);
				$this->load->view('admin/user_office_assignment');		
				$this->load->view('template/footer');
			}
		}
		else
		{
			redirect(base_url());
		}
	}

	public function budget_allocation()
	{
		$ac = $this->validation_model->access();

		if(in_array('BA', $ac))
		{
			if(isset($_GET['loadtable']))
			{
				$output = $this->getdata_model->budget_allocation('loadtable', $_GET);
		        $response = array(
		          'aaData' => $output,
		          'iTotalRecords' => count($output),
		          'iTotalDisplayRecords' => count($output),
		          'iDisplayStart' => 0
		        );
		        echo json_encode($response);
		        exit();
			}
			else if(isset($_POST['getspecific']))
			{
				echo json_encode($this->getdata_model->budget_allocation('getspecific', $_POST));
				exit();
			}
			else if(isset($_POST['loadOffice']))
			{
				echo json_encode($this->getdata_model->budget_allocation('loadOffice', $_POST));
				exit();
			}
			else if(isset($_POST['getSpecificOffice']))
			{
				echo json_encode($this->getdata_model->budget_allocation('getspecificoffice', $_POST));
				exit();
			}
			else if(isset($_POST['act']))
			{
				echo json_encode($this->savedata_model->budget_allocation($_POST));
				exit();
			}
			else
			{
				$data['menu'] = "budget_allocation";
				$data['ac'] = $this->validation_model->access();
				$ac = $this->validation_model->access(1, 'BA');
				$val = explode('/', $ac[0]);
				$data['r_'] = $val[1];
				$data['w_'] = $val[2];


				$data['office'] = $this->getdata_model->budget_allocation('loadOffice', array('year_'=>date('Y')));

				$this->load->view('template/header',$data);
				$this->load->view('admin/budget_allocation');		
				$this->load->view('template/footer');
			}
		}
		else
		{
			redirect(base_url());
		}
	}

	public function access_control()
	{
		$ac = $this->validation_model->access();

		if(in_array('AC', $ac))
		{
			if(isset($_GET['loadtable']))
			{
				$output = $this->getdata_model->access_control('loadtable', $_GET);
		        $response = array(
		          'aaData' => $output,
		          'iTotalRecords' => count($output),
		          'iTotalDisplayRecords' => count($output),
		          'iDisplayStart' => 0
		        );
		        echo json_encode($response);
		        exit();
			}
			else if(isset($_POST['act']))
			{
				echo json_encode($this->savedata_model->access_control($_POST['act'], $_POST));
				exit();
			}
			else
			{
				$data['menu'] = "access_control";
				$data['ac'] = $this->validation_model->access();

				$ac = $this->validation_model->access(1, 'AC');
				$val = explode('/', $ac[0]);
				$data['r_'] = $val[1];
				$data['w_'] = $val[2];

				$this->load->view('template/header',$data);
				$this->load->view('admin/access_control');		
				$this->load->view('template/footer');
			}
		}
		else
		{
			redirect(base_url());
		}
	}

	public function units_of_measurement()
	{
		$ac = $this->validation_model->access();

		if(in_array('UM', $ac))
		{
			if(isset($_GET['loadtable']))
			{
				$output = $this->getdata_model->units_of_measurement('loadtable', $_GET);
		        $response = array(
		          'aaData' => $output,
		          'iTotalRecords' => count($output),
		          'iTotalDisplayRecords' => count($output),
		          'iDisplayStart' => 0
		        );
		        echo json_encode($response);
		        exit();
			}
			else if(isset($_POST['getspecific']))
			{
				echo json_encode($this->getdata_model->units_of_measurement('getspecific', $_POST));
				exit();
			}
			else if(isset($_POST['act']))
			{
				echo json_encode($this->savedata_model->units_of_measurement($_POST));
				exit();
			}
			else
			{
				$data['menu'] = "units_of_measurement";
				$data['ac'] = $this->validation_model->access();

				$ac = $this->validation_model->access(1, 'UM');
				$val = explode('/', $ac[0]);
				$data['r_'] = $val[1];
				$data['w_'] = $val[2];

				$this->load->view('template/header',$data);
				$this->load->view('admin/units_of_measurement');		
				$this->load->view('template/footer');
			}
		}
		else
		{
			redirect(base_url());
		}
	}

	public function department_offices()
	{
		$ac = $this->validation_model->access();

		if(in_array('DO', $ac))
		{
			if(isset($_GET['loadtable']))
			{
				$output = $this->getdata_model->department_office('loadtable', $_GET);
		        $response = array(
		          'aaData' => $output,
		          'iTotalRecords' => count($output),
		          'iTotalDisplayRecords' => count($output),
		          'iDisplayStart' => 0
		        );
		        echo json_encode($response);
		        exit();
			}
			else if(isset($_POST['getspecific']))
			{
				echo json_encode($this->getdata_model->department_office('getspecific', $_POST));
				exit();
			}
			else if(isset($_POST['getDivision']))
			{
				echo json_encode($this->getdata_model->department_office('loadtable', $_POST));
				exit();
			}
			else if(isset($_POST['act']))
			{
				echo json_encode($this->savedata_model->department_office($_POST));
				exit();
			}
			else
			{
				$data['menu'] = "department_office";
				$data['ac'] = $this->validation_model->access();

				$ac = $this->validation_model->access(1, 'DO');
				$val = explode('/', $ac[0]);
				$data['r_'] = $val[1];
				$data['w_'] = $val[2];

				$this->load->view('template/header',$data);
				$this->load->view('admin/department_offices');		
				$this->load->view('template/footer');
			}
		}
		else
		{
			redirect(base_url());
		}
	}
	public function billing_shipping_details()
	{
		$ac = $this->validation_model->access();

		if(in_array('BS', $ac))
		{
			if(isset($_POST['act']))
			{
				echo json_encode($this->savedata_model->billing_shipping_details($_POST));
				exit();
			}
			else
			{
				$data['menu'] = "billing_shipping_details";
				$data['ac'] = $this->validation_model->access();

				$ac = $this->validation_model->access(1, 'BS');
				$val = explode('/', $ac[0]);
				$data['r_'] = $val[1];
				$data['w_'] = $val[2];

				$data['bs'] = $this->getdata_model->billing_shipping_details('loaddata');

				$this->load->view('template/header',$data);
				$this->load->view('admin/billing_shipping_details');		
				$this->load->view('template/footer');
			}
		}
		else
		{
			redirect(base_url());
		}
	}

	public function product_category()
	{
		$ac = $this->validation_model->access();

		if(in_array('PC', $ac))
		{
			if(isset($_GET['loadtable']))
			{
				$output = $this->getdata_model->product_category('loadtable', $_GET);
		        $response = array(
		          'aaData' => $output,
		          'iTotalRecords' => count($output),
		          'iTotalDisplayRecords' => count($output),
		          'iDisplayStart' => 0
		        );
		        echo json_encode($response);
		        exit();
			}
			else if(isset($_POST['getspecific']))
			{
				echo json_encode($this->getdata_model->product_category('getspecific', $_POST));
				exit();
			}
			else if(isset($_POST['act']))
			{
				echo json_encode($this->savedata_model->product_category($_POST));
				exit();
			}
			else
			{
				$data['menu'] = "product_category";
				$data['ac'] = $this->validation_model->access();

				$ac = $this->validation_model->access(1, 'PC');
				$val = explode('/', $ac[0]);
				$data['r_'] = $val[1];
				$data['w_'] = $val[2];

				$this->load->view('template/header',$data);
				$this->load->view('admin/product_category');		
				$this->load->view('template/footer');
			}
		}
		else
		{
			redirect(base_url());
		}
	}

	public function property_category()
	{
		$ac = $this->validation_model->access();

		if(in_array('PROPC', $ac))
		{
			if(isset($_GET['loadtable']))
			{
				$output = $this->getdata_model->property_category('loadtable', $_GET);
		        $response = array(
		          'aaData' => $output,
		          'iTotalRecords' => count($output),
		          'iTotalDisplayRecords' => count($output),
		          'iDisplayStart' => 0
		        );
		        echo json_encode($response);
		        exit();
			}
			else if(isset($_POST['getspecific']))
			{
				echo json_encode($this->getdata_model->property_category('getspecific', $_POST));
				exit();
			}
			else if(isset($_POST['act']))
			{
				echo json_encode($this->savedata_model->property_category($_POST));
				exit();
			}
			else
			{
				$data['menu'] = "property_category";
				$data['ac'] = $this->validation_model->access();

				$ac = $this->validation_model->access(1, 'PROPC');
				$val = explode('/', $ac[0]);
				$data['r_'] = $val[1];
				$data['w_'] = $val[2];

				$this->load->view('template/header',$data);
				$this->load->view('admin/property_category');		
				$this->load->view('template/footer');
			}
		}
		else
		{
			redirect(base_url());
		}
	}

	public function audit_trail()
	{
		$ac = $this->validation_model->access();

		if(in_array('AT', $ac))
		{
			$data['menu'] = "audit_trail";
			$data['ac'] = $this->validation_model->access();

			$ac = $this->validation_model->access(1, 'PC');
			$val = explode('/', $ac[0]);
			$data['r_'] = $val[1];
			$data['w_'] = $val[2];

			$data['data'] = $this->getdata_model->audit_trail('loadtable');

			$this->load->view('template/header',$data);
			$this->load->view('admin/audit_trail');		
			$this->load->view('template/footer');
			
		}
		else
		{
			redirect(base_url());
		}
	}

	public function approver()
	{
		$ac = $this->validation_model->access();

		if(in_array('A', $ac))
		{
			if(isset($_GET['loadtable']))
			{
				$output = $this->getdata_model->approver('loadtable', $_GET);
		        $response = array(
		          'aaData' => $output,
		          'iTotalRecords' => count($output),
		          'iTotalDisplayRecords' => count($output),
		          'iDisplayStart' => 0
		        );
		        echo json_encode($response);
		        exit();
			}
			else if(isset($_POST['getspecific']))
			{
				echo json_encode($this->getdata_model->approver('getspecific', $_POST));
				exit();
			}
			else if(isset($_POST['act']))
			{
				echo json_encode($this->savedata_model->approver($_POST));
				exit();
			}
			else if(isset($_POST['getH']))
			{
				echo json_encode($this->getdata_model->approver('getH', $_POST));
				exit();
			}
			else if(isset($_POST['getA']))
			{
				echo json_encode($this->getdata_model->approver('getA', $_POST));
				exit();
			}
			else
			{
				$data['menu'] = "approver";
				$data['ac'] = $this->validation_model->access();

				$ac = $this->validation_model->access(1, 'A');
				$val = explode('/', $ac[0]);
				$data['r_'] = $val[1];
				$data['w_'] = $val[2];

				$qa = $this->db->query("SELECT u.id, CONCAT(lname, ', ', fname, ' - ',  r.description) name FROM users u INNER JOIN role r ON r.id = u.role  WHERE u.status = 1");
				$a = array();
				foreach($qa->result() as $r)
					$a[] = array($r->id, $r->name);

				$data['approver'] = $a;


				$data['ac'] = $this->validation_model->access();

				$this->load->view('template/header',$data);
				$this->load->view('admin/approver');		
				$this->load->view('template/footer');
			}
		}
		else
		{
			redirect(base_url());
		}
	}

	
}

?>
