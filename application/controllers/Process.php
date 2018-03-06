<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Process extends CI_Controller {

	function __construct()
    {
        parent::__construct();	

    } 	

    public function showNotif()
	{
		if($this->session->userdata("USERID"))
		{

		}
		else
		{
			echo json_encode(array(2));
			exit();
		}
		if(isset($_POST['getNotif']))
		{
			$count = 0;
			$q = $this->db->query("SELECT TOP 10 u.image_path, CONCAT(u.fname, ' ', u.lname) NAME, title, content, CASE WHEN CONVERT(VARCHAR,n.date_added, 101) = CONVERT(VARCHAR,GETDATE(), 101) THEN 'Today' ELSE CONVERT(VARCHAR,n.date_added, 101) END date_added , case when date_seen is null then 'active' else '' end status
									FROM notifications n 
									INNER JOIN users u 
									ON u.id  = n.userid
									WHERE n.userid = ? order by n.date_added desc", $this->session->userdata("USERID"));
			$result = array();
			foreach($q->result() as $r)
			{
				($r->status == 'active')?$count++:null;
				$result[] = array
				(	
					$r->date_added,
					base_url('assets/uploads').'/'.$r->image_path,
					$r->NAME, 
					'<b>'.$r->title.'</b><br>'.$r->content, 
					$r->status,

					($r->title != '')?
					(
						($r->title == 'Purchase Request Disapproved' || $r->title == 'Item Request Disapproved')
						?(
							($r->title == 'Purchase Request Disapproved')
							?base_url('Process/purchase_request')
							:base_url('Process/item_requests_monitoring')
						)
						:(
							($r->title == 'Purchase Request')
							?base_url('Process/approve_purchase_requests')
							:base_url('Process/approve_item_requests')
						)
					)
					:base_url('Process/approve_purchase_requests')
					
				);
			}

			echo json_encode(array(1,$count,$result));
			exit();
		}
		if(isset($_POST['saveNotif']))
		{
			$this->db->where('userid',$this->session->userdata('USERID'));
			$this->db->update('notifications', array('date_seen' => date('Y-m-d H:i:s'), 'status' => 0));

			exit();
		}
		else
			echo json_encode(array(0));
		exit();
	}

	public function product()
	{
		function compare($a, $b)
	  	{
	    	return strcmp($a['desc'], $b['desc']);
	  	}
		$ac = $this->validation_model->access();

		if(in_array('P', $ac))
		{
			if(isset($_GET['loadtable']))
			{
				$output = $this->getdata_model->product('loadtable', $_GET);

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
				echo json_encode($this->getdata_model->product('getspecific', $_POST));
				exit();
			}
			else if(isset($_POST['act']))
			{
				echo json_encode($this->savedata_model->product($_POST));
				exit();
			}else if(isset($_POST['add_new_item'])){
								
				echo json_encode($this->savedata_model->product($_POST));
				exit();
			}
			else
			{
				$data['menu'] = "product";
				$data['ac'] = $this->validation_model->access();
				$data['category'] = $this->getdata_model->category();
				usort($data['category'], 'compare');

				$results = array();
				$qtypes = $this->db->query("SELECT * from product_item");
				foreach($qtypes->result() as $r)
					$results[] = array($r->id, $r->item_name);
				$data['item_name'] = $results;
				//echo "<pre>";print_r($data['item_name']); echo"</pre>";die();
				//echo "<pre>";print_r($data['item_name']);die();echo "</pre>";
		     
				$data['article'] = $this->getdata_model->supply_type();
				

				$result = array();
				$qunits = $this->db->query("SELECT CONCAT(description,' - ', code) code, id from units where status = 1");
				foreach($qunits->result() as $r)
					$result[] = array($r->id, $r->code);
				$data['units'] = $result;

				 //echo json_encode($data['units']);
				// exit();


				$ac = $this->validation_model->access(1, 'P');
				$val = explode('/', $ac[0]);
				$data['r_'] = $val[1];
				$data['w_'] = $val[2];

				$this->load->view('template/header',$data);
				$this->load->view('process/product');		
				$this->load->view('template/footer');
			}
		}
		else
		{
			redirect(base_url());
		}
	}

	public function property()
	{
		function compare($a, $b)
	  	{
	    	return strcmp($a['desc'], $b['desc']);
	  	}
		$ac = $this->validation_model->access();

		if(in_array('PROP', $ac))
		{
			if(isset($_GET['loadtable']))
			{
				$output = $this->getdata_model->property('loadtable', $_GET);
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
				echo json_encode($this->getdata_model->property('getspecific', $_POST));
				exit();
			}
			else if(isset($_POST['act']))
			{
				echo json_encode($this->savedata_model->property($_POST));
				exit();
			}
			else
			{
				$data['menu'] = "property";
				$data['ac'] = $this->validation_model->access();
				$data['category'] = $this->getdata_model->category(0,1);
				usort($data['category'], 'compare');

				$data['article'] = $this->getdata_model->property_type();
				

				$result = array();
				$qunits = $this->db->query("SELECT CONCAT(description,' - ', code) code, id from units where status = 1");
				foreach($qunits->result() as $r)
					$result[] = array($r->id, $r->code);
				$data['units'] = $result;

			//	 echo json_encode($data['units']);
			//	 exit();


				$ac = $this->validation_model->access(1, 'PROP');
				$val = explode('/', $ac[0]);
				$data['r_'] = $val[1];
				$data['w_'] = $val[2];

				$this->load->view('template/header',$data);
				$this->load->view('process/property');		
				$this->load->view('template/footer');
			}
		}
		else
		{
			redirect(base_url());
		}
	}

	public function supplier_vendor()
	{
		$ac = $this->validation_model->access();

		if(in_array('SV', $ac))
		{
			if(isset($_GET['loadtable']))
			{
				$output = $this->getdata_model->supplier_vendor('loadtable', $_GET);
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
				echo json_encode($this->getdata_model->supplier_vendor('getspecific', $_POST));
				exit();
			}
			else if(isset($_POST['loadProducts']))
			{
				echo json_encode($this->getdata_model->product('loadtable', array(), 1));
				exit();
			}
			else if(isset($_POST['getSpecificProduct']))
			{
				echo json_encode($this->getdata_model->supplier_vendor('getspecificproduct', $_POST));
				exit();
			}
			else if(isset($_POST['act']))
			{
				echo json_encode($this->savedata_model->supplier_vendor($_POST));
				exit();
			}
			else
			{
				$data['menu'] = "supplier_vendor";
				$data['ac'] = $this->validation_model->access();
				$ac = $this->validation_model->access(1, 'SV');
				$val = explode('/', $ac[0]);
				$data['r_'] = $val[1];
				$data['w_'] = $val[2];

				$this->load->view('template/header',$data);
				$this->load->view('process/supplier_vendor');		
				$this->load->view('template/footer');
			}
		}
		else
		{
			redirect(base_url());
		}
	}

	public function inventory()
	{
		$ac = $this->validation_model->access();

		if(in_array('I', $ac))
		{
			if(isset($_GET['loadtable']))
			{
				$output = $this->getdata_model->inventory('loadtable', $_GET);
		        $response = array(
		          'aaData' => $output,
		          'iTotalRecords' => count($output),
		          'iTotalDisplayRecords' => count($output),
		          'iDisplayStart' => 0
		        );
		        echo json_encode($response);
		        exit();
			}
			else
			{
				$data['menu'] = "inventory";
				$data['ac'] = $this->validation_model->access();
				$ac = $this->validation_model->access(1, 'I');
				$val = explode('/', $ac[0]);
				$data['r_'] = $val[1];
				$data['w_'] = $val[2];



				$this->load->view('template/header',$data);
				$this->load->view('process/inventory');		
				$this->load->view('template/footer');
			}
		}
		else
		{
			redirect(base_url());
		}
	}

	public function item_requests()
	{
		$ac = $this->validation_model->access();

		if(in_array('IR', $ac))
		{
			if(isset($_GET['loadtable']))
			{
				$output = $this->getdata_model->item_requests('loadtable', $_GET);
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
			//	print_r($_POST);die();
				echo json_encode($this->savedata_model->item_requests($_POST));
				exit();
			}

			else if(isset($_POST['action'])){
				//echo "HI";die();
				echo json_encode($this->getdata_model->item_units($_POST));
				exit();
			}

			else if(isset($_POST['act3']))
			{
				echo json_encode($this->getdata_model->getMaxQuantity($_POST));
				exit();
			}
			else
			{
				$data['menu'] = "item_requests";
				$data['ac'] = $this->validation_model->access();
				$ac = $this->validation_model->access(1, 'IR');
				$val = explode('/', $ac[0]);
				$data['r_'] = $val[1];
				$data['w_'] = $val[2];

				$o = array();
               
				$data['p'] = $this->getdata_model->product('loadtable', array(), 1);
          //   echo"<pre>";print_r($data['p']);die();echo"</pre>";

				$q = $this->db->query("SELECT id, name,oic_name FROM office WHERE STATUS = 1 and parent_id is not null and id in (select office from user_office_assignment where userid = ?)", $this->session->userdata('USERID'));
				foreach($q->result() as $r) $o[] = array($r->id, $r->name, $r->oic_name);
				$data['o'] = $o;
				$data['fund_cluster'] = $this->getdata_model->fund_cluster();
				
               
				$data['u'] = $this->getdata_model->system_users('loadtable');
				$this->load->view('template/header',$data);
				$this->load->view('process/item_requests');		
				$this->load->view('template/footer');
			}
		}
		else
		{
			redirect(base_url());
		}
	}

	public function approve_item_requests()
	{
		$ac = $this->validation_model->access();

		if(in_array('AIR', $ac))
		{
			if(isset($_GET['loadtable']))
			{
				$output = $this->getdata_model->approve_item_requests('loadtable', $_GET);
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
				echo json_encode($this->savedata_model->approve_item_requests($_POST));
				exit();
			}
			else if(isset($_POST['wf']))
			{
				echo json_encode($this->getdata_model->approve_item_requests('wf',$_POST));
				exit();
			}
			else
			{
				$data['menu'] = "approve_item_requests";
				$data['ac'] = $this->validation_model->access();
				$ac = $this->validation_model->access(1, 'AIR');
				$val = explode('/', $ac[0]);
				$data['r_'] = $val[1];
				$data['w_'] = $val[2];

				$this->db->where('userid', $this->session->userdata('USERID'));
				$this->db->update('notifications', array('date_seen' => date('Y-m-d H:i:s'), 'status' => 0));

				$this->load->view('template/header',$data);
				$this->load->view('process/approve_item_requests');		
				$this->load->view('template/footer');
			}
		}
		else
		{
			redirect(base_url());
		}
	}
public function purchase_request()
	{
		$ac = $this->validation_model->access();

		if(in_array('PR', $ac))
		{
			if(isset($_GET['loadtable']))
			{
				$output = $this->getdata_model->purchase_request('loadtable', $_GET);
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
				echo json_encode($this->savedata_model->purchase_request($_POST));
				exit();
			}
			else if(isset($_POST['action']))
			{
				echo json_encode($this->getdata_model->purchase_request_to_po($_POST));
				exit();
			}
			else if(isset($_POST['action_to_po'])){
				echo json_encode($this->savedata_model->purchase_request_to_po($_POST));
				exit();
			}
			else if(isset($_POST['act2']))
			{
				// $q = $this->db->query("SELECT code 
				// 				  FROM product as a 
				// 				  inner join units as b on
				// 				  a.measurement = b.id where a.id = ?", $this->security->xss_clean($_POST['id']));
				// echo json_encode($q->result()[0]->code);
				echo json_encode($this->getdata_model->getItemUnits($_POST));
				exit();
			}
			else
			{

				$data['bs'] = $this->getdata_model->billing_shipping_details('loaddata');

				$data['menu'] = "purchase_request";
				$data['ac'] = $this->validation_model->access();
				$ac = $this->validation_model->access(1, 'PR');
				$val = explode('/', $ac[0]);
				$data['r_'] = $val[1];
				$data['w_'] = $val[2];

				$o = array();

				$data['p'] = $this->getdata_model->product('loadtable', array(), 1);
				$q = $this->db->query("SELECT id, name, oic_name, code FROM office WHERE STATUS = 1 and parent_id is not null and id in (select office from user_office_assignment where userid = ?)", $this->session->userdata('USERID'));
				foreach($q->result() as $r) $o[] = array($r->id, $r->name, $r->oic_name);
				$data['o'] = $o;
				$data['u'] = $this->getdata_model->system_users('loadtable');
				$data['fund_cluster'] = $this->getdata_model->fund_cluster();



				$data['item'] = $this->getdata_model->product('loadtable', array(), 1);
				
				$qunits = $this->db->query("SELECT code from units where status = 1");
				foreach($qunits->result() as $r)
					$result[] = array($r->code);
				$data['units'] = $result;
				//print_r($data['units']);die();

				// echo json_encode($data['fund_cluster']);
				// exit();
				//supplier
				$data['supplier'] = $this->getdata_model->supplier_vendor('loadtable');
				//echo "<pre>";print_r($data['supplier']);die(); echo "</pre>";
				$this->load->view('template/header',$data);
				$this->load->view('process/purchase_request');		
				$this->load->view('template/footer');
			}
		}
		else
		{
			redirect(base_url());
		}
	}
	public function item_requests_monitoring()
	{
		$ac = $this->validation_model->access();

		if(in_array('IRM', $ac))
		{
			if(isset($_GET['loadtable']))
			{
				$output = $this->getdata_model->item_requests_monitoring('loadtable', $_GET);
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
				echo json_encode($this->savedata_model->item_requests_monitoring($_POST));
				exit();
			}
			else if(isset($_POST['wf']))
			{
				echo json_encode($this->getdata_model->item_requests_monitoring('wf',$_POST));
				exit();
			}
			else
			{
				$data['menu'] = "item_requests_monitoring";
				$data['ac'] = $this->validation_model->access();
				$ac = $this->validation_model->access(1, 'IRM');
				$val = explode('/', $ac[0]);
				$data['r_'] = $val[1];
				$data['w_'] = $val[2];

				$o = array();

				$data['p'] = $this->getdata_model->product('loadtable', array(), 1);
				$q = $this->db->query("SELECT id, name,oic_name FROM office WHERE STATUS = 1 ");
				foreach($q->result() as $r) $o[] = array($r->id, $r->name, $r->oic_name);
				$data['o'] = $o;
				$data['u'] = $this->getdata_model->system_users('loadtable');

				$this->load->view('template/header',$data);
				$this->load->view('process/item_requests_monitoring');		
				$this->load->view('template/footer');
			}
		}
		else
		{
			redirect(base_url());
		}
	}

	public function purchase_order()
	{
		$ac = $this->validation_model->access();

		if(isset($_POST['initProduct']))
		{
			echo json_encode($this->getdata_model->purchase_order('initProduct',$_POST));
			
			exit();
		}

		if(isset($_POST['loadPrice']))
		{
			$q = $this->db->query("SELECT unit_price from product where id = ?", $this->security->xss_clean($_POST['id']));
			echo json_encode($q->result()[0]->unit_price);
			exit();
		}

		if(in_array('PO', $ac))
		{
			if(isset($_GET['loadtable']))
			{
				$output = $this->getdata_model->purchase_order('loadtable', $_GET);
				$response = array(
		          'aaData' => $output,
		          'iTotalRecords' => count($output),
		          'iTotalDisplayRecords' => count($output),
		          'iDisplayStart' => 0
		        );
		        echo json_encode($response);

		        exit();

		      
			}
			if(isset($_GET['loadtableApprovePurchase'])){
				$output = $this->getdata_model->approve_purchase_requests('loadApprovePurchaseRequest', $_GET);
				$response = array(
		          'aaData' => $output,
		          'iTotalRecords' => count($output),
		          'iTotalDisplayRecords' => count($output),
		          'iDisplayStart' => 0
		        );
		        echo json_encode($response);

		        exit();
			}
			
			/*else if(isset($_GET['loadtable'])){

				  $output = $this->getdata_model->purchase_request('loadtable', $_GET);
		        $response = array(
		          'aaData' => $output,
		          'iTotalRecords' => count($output),
		          'iTotalDisplayRecords' => count($output),
		          'iDisplayStart' => 0
		        );
		        echo json_encode($response);

		        exit();


			}*/
			
			else if(isset($_POST['act']))
			{
				echo json_encode($this->savedata_model->purchase_order($_POST));
				exit();
			}
			else if(isset($_POST['loadSpecific']))
			{
				echo json_encode($this->getdata_model->purchase_order('loaddata',$_POST));
				exit();
			}
			else if(isset($_POST['initProduct']))
			{
				echo json_encode($this->getdata_model->purchase_order('initProduct',$_POST));
				exit();
			}

			else if(isset($_POST['action']))
			{
				echo json_encode($this->getdata_model->purchase_order($_POST));
				exit();
			}
			else
			{
				$data['bs'] = $this->getdata_model->billing_shipping_details('loaddata');

				$data['supplier'] = $this->getdata_model->supplier_vendor('loadtable');

				$data['menu'] = "purchase_order";
				$data['ac'] = $this->validation_model->access();
				$ac = $this->validation_model->access(1, 'PO');
				$val = explode('/', $ac[0]);
				$data['r_'] = $val[1];
				$data['w_'] = $val[2];

				$o = array();

				$data['p'] = $this->getdata_model->product('loadtable', array(), 1);
				$q = $this->db->query("SELECT id, name,oic_name FROM office WHERE STATUS = 1 ");
				foreach($q->result() as $r) $o[] = array($r->id, $r->name, $r->oic_name);
				$data['o'] = $o;
				$data['u'] = $this->getdata_model->system_users('loadtable');
				$data['s'] = $this->getdata_model->supplier_vendor('loadtable');

				$this->load->view('template/header',$data);
				$this->load->view('process/purchase_order');		
				$this->load->view('template/footer');
			}
		}
		else
		{
			redirect(base_url());
		}

	}

	public function view_po()
	{
		$ac = $this->validation_model->access();

		if(in_array('PO', $ac))
		{
			if(isset($_GET['id']))
			{
				$id = $this->security->xss_clean($_GET['id']);
				$q = $this->db->query("SELECT FORMAT(id,'00000') code, po_status from purchase_order where id = ?", $id);
				if($q->num_rows()>0)
				{
					if($q->result()[0]->po_status == "New" || $q->result()[0]->po_status == "Changed Order")
					{
						$this->db->where('id', $id);
						$this->db->update('purchase_order', array('po_status' => 'Released'));
					}
					$this->load->library('pdf');
					$data['product'] = $this->getdata_model->purchase_order('loaddata', array('id' => $id));
				//	echo "<pre>"; print_r($data['product']);

				//	 echo "</pre>";die();
					$this->pdf->load_view('reports/view_po', $data);
					$this->pdf->load_view('reports/view_purchase_order',$data);
		            $this->pdf->render();
		            $this->pdf->output();
		          
		            $this->pdf->stream($q->result()[0]->code.".pdf", array('Attachment' => 0));
				}
			}
			else
			{
				redirect(base_url());
			}
		}
		else
		{
			redirect(base_url());
		}
	}
	//april 25,2017

	public function view_requisition_and_issue_slip(){

		$ac = $this->validation_model->access();

		          if(in_array('IR', $ac)){

			          	if(isset($_GET['id'])){
			          		$id=$this->security->xss_clean($_GET['id']);
			          	
			       	 $requested_item=$this->getdata_model->view_requisition_and_issue_slip($id);
              	 for($ctr=0;$ctr<count($requested_item);$ctr++){
			          	   $data['requested_item']= $requested_item[$ctr];
			          	 } 

 					

			 /*
			        $result = array();
   $q = $this->db->query("SELECT iv.current_stock stocks, 
		     	concat(substring(convert(varchar,ri.date_requested, 2),1,2),'-',substring(convert(varchar,ri.date_requested, 2),4,2),'-',format(ri.id,'0000')) as r_id ,
		     	FORMAT(ri.id,'0000') id,
		     	o.name office,
		     	o.code,
		     	ri.fund_cluster,
		     	concat(us.lname, ', ', us.fname) requested_by, 
		     	CONVERT(VARCHAR,ri.date_requested,101) date_requested,
		    ril.unit qty, concat(p.description,', ',pc.description) product_desc,
		     	ril.unit qty,
		     	p.category_id,p.description,
		    	u.code units,ril.unit, ril.id id_, ril.remarks, ril.request_status, CONCAT('Reason: ', case when ril.reason is NULL then 'No reason' else ril.reason END) reason

				FROM request_item ri 
				INNER JOIN office o 
				ON o.id = ri.office_id
				inner join request_item_line ril 
				on ril.request_item_id = ri.id and ril.status = 1
				LEFT JOIN product p 
				ON p.id = ril.product
				left join product_category pc
				on pc.id=p.category_id
				LEFT JOIN units u 
				ON u.id = p.measurement
				left join users us
				on us.id = ri.requested_by
				left join inventory iv
				on p.id=iv.product
				WHERE ril.id=$id");
			
			foreach($q->result() as $r)
			{
				$cat = $this->getdata_model->category($r->category_id);
				$result[] = array(
					'category' => $cat[0]['desc'],
					'unit' => $r->units,
					'date_requested' => $r->date_requested,
					'responsibility_center' => $r->office,
					'ris_no' => $r->r_id,
					'critical_level' => $r->critical_level,
					'responsibility_center_code' => $r->code,
					'description'=>$r->description,
					'qtu'=>$r->qty
					);
			}



			print_r($data['requested_item']=$result);die();

*/









			        //		echo"<pre>"; print_r( $data['requested_item']); echo "</pre>";die();         	

			   //       	print_r($data['category']=$this->getdata_model->category_id($id));die();
			   //   echo "<pre>";	 print_r( $data['requested_item'] = $this->getdata_model->view_requisition_and_issue_slip($id));echo "</pre>";die();
							$this->load->library('pdf');
						    $this->pdf->load_view('reports/view_requisition_slip',$data);
				            $this->pdf->render();
				            $this->pdf->output();
				          
				            $this->pdf->stream("sample.pdf", array('Attachment' => 0));
				        }
                    }
	}
	public function view_purchase_request(){
					$this->load->library('pdf');
					$this->pdf->load_view('reports/view_purchase_request');
					$this->pdf->render();
					$this->pdf->output();

					$this->pdf->stream("sample.pdf", array('Attachment' => 0));
	}
	public function view_property_transfer_report(){
					$this->load->library('pdf');
					$this->pdf->load_view('reports/view_property_transfer_report');
					$this->pdf->render();
					$this->pdf->output();

					$this->pdf->stream("sample.pdf", array('Attachment' => 0));
	}
	

   








	//

	public function delivery()
	{
		function compare($a, $b)
	  	{
	    	return strcmp($a['desc'], $b['desc']);
	  	}
		$ac = $this->validation_model->access();

		if(in_array('D', $ac))
		{
			if(isset($_GET['loadtable']))
			{
				$output = $this->getdata_model->delivery('loadtable', $_GET);
		        $response = array(
		          'aaData' => $output,
		          'iTotalRecords' => count($output),
		          'iTotalDisplayRecords' => count($output),
		          'iDisplayStart' => 0
		        );
		        echo json_encode($response);
		        exit();
			}
			if(isset($_GET['loaddelivery']))
			{
				$output = $this->getdata_model->delivery('loaddelivery', $_GET);
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
				echo json_encode($this->savedata_model->delivery($_POST));
				exit();
			}
			else if(isset($_POST['loadSpecific']))
			{
				echo json_encode($this->getdata_model->delivery('loadSpecific',$_POST));
				exit();
			}
			else if(isset($_POST['loadspecific']))
			{
				echo json_encode($this->getdata_model->delivery('loadspecific',$_POST));
				exit();
			}
			else if(isset($_POST['initProduct']))
			{
				echo json_encode($this->getdata_model->delivery('initProduct',$_POST));
				exit();
			}
			else
			{
				$data['supplier'] = $this->getdata_model->supplier_vendor('loadtable');

				$data['category'] = $this->getdata_model->category(0,0,1);
				usort($data['category'], 'compare');
				//print_r($data['category']);die();

				$data['product'] = $this->getdata_model->product('loadtable', array(), 1);

				$data['menu'] = "delivery";
				$data['ac'] = $this->validation_model->access();
				$ac = $this->validation_model->access(1, 'D');
				$val = explode('/', $ac[0]);
				$data['r_'] = $val[1];
				$data['w_'] = $val[2];

				$this->load->view('template/header',$data);
				$this->load->view('process/delivery');		
				$this->load->view('template/footer');
			}
		}
		else
		{
			redirect(base_url());
		}
	}

	public function notifications()
	{
		$ac = $this->validation_model->access();

		if(in_array('MN', $ac))
		{
			if(isset($_GET['loadtable']))
			{
				$output = $this->getdata_model->notifications('loadtable', $_GET);
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
				echo json_encode($this->savedata_model->notifications($_POST));
				exit();
			}
			else
			{
				$data['menu'] = "notifications";
				$data['ac'] = $this->validation_model->access();

				$ac = $this->validation_model->access(1, 'MN');
				$val = explode('/', $ac[0]);
				$data['r_'] = $val[1];
				$data['w_'] = $val[2];

				$this->load->view('template/header',$data);
				$this->load->view('process/notifications');		
				$this->load->view('template/footer');
			}
		}
		else
		{
			redirect(base_url());
		}
	}

	public function all_notifications()
	{
		$ac = $this->validation_model->access();

		if(in_array('AN', $ac))
		{
			if(isset($_GET['loadtable']))
			{
				$output = $this->getdata_model->all_notifications('loadtable', $_GET);
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
				echo json_encode($this->savedata_model->notifications($_POST));
				exit();
			}
			else
			{
				$data['menu'] = "all_notifications";

				$ac = $this->validation_model->access(1, 'AN');
				$val = explode('/', $ac[0]);
				$data['r_'] = $val[1];
				$data['w_'] = $val[2];

				$data['ac'] = $this->validation_model->access();

				$this->load->view('template/header',$data);
				$this->load->view('process/all_notifications');		
				$this->load->view('template/footer');
			}
		}
		else
		{
			redirect(base_url());
		}
	}

	public function property_management()
	{
		function compare($a, $b)
		  {
		    return strcmp($a['desc'], $b['desc']);
		  }
		$ac = $this->validation_model->access();

		if(in_array('PM', $ac))
		{
			if(isset($_GET['loadtable']))
			{
				$output = $this->getdata_model->property_management('loadtable', $_GET);
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
				echo json_encode($this->getdata_model->property_management('getspecific', $_POST));
				exit();
			}
			else if(isset($_POST['loadSpecific']))
			{
				echo json_encode($this->getdata_model->property_management('loadSpecific', $_POST));
				exit();
			}
			else if(isset($_POST['loadOffice']))
			{
				echo json_encode($this->getdata_model->user_office_assignment('getspecificoffice', $_POST));
				exit();
			}
			else if(isset($_POST['act']))
			{
				echo json_encode($this->savedata_model->property_management($_POST));
				exit();
			}
			else if(isset($_POST['act2']))
			{
				 echo json_encode($_POST);
				echo json_encode($this->savedata_model->property_management($_POST));
				exit();
			}
			if(isset($_GET['loadEmployee']))
			{
				echo json_encode($this->getdata_model->property_management('loadEmployee', $_GET));
				exit();
			}
			if(isset($_GET['loadInventory']))
			{
				echo json_encode($this->getdata_model->property_management('loadInventory', $_GET));
				exit();
			}
			else
			{
				$data['menu'] = "property_management";
				$data['ac'] = $this->validation_model->access();
				$ac = $this->validation_model->access(1, 'PM');
				$val = explode('/', $ac[0]);
				$data['r_'] = $val[1];
				$data['w_'] = $val[2];

				$data['o'] = $this->getdata_model->property_management('loadOffice_');
				$data['e'] = $this->getdata_model->system_users('loadtable');

				$data['user'] = $this->getdata_model->system_users('loadtable');

				$data['category'] = $this->getdata_model->category(0,1,0);
				$data['p'] = $this->getdata_model->product('loadtable',array(), 1);
			//	echo "<pre>";print_r($data['p'] );die(); echo"</pre>";
				$data['i'] = $this->getdata_model->property_management('loadInventory');
				
			//	 echo json_encode($data['i'] );
			//	 exit();

				usort($data['category'], 'compare');

				$this->load->view('template/header',$data);
				$this->load->view('process/property_management');		
				$this->load->view('template/footer');
			}
		}
		else
		{
			redirect(base_url());
		}
	}

	public function stocks_manual()
	{
		$ac = $this->validation_model->access();

		if(in_array('SM', $ac))
		{
			if(isset($_GET['loadtable']))
			{
				$output = $this->getdata_model->stock_manual('loadtable', $_GET);
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
				echo json_encode($this->savedata_model->stock_manual($_POST));
				exit();
			}
			else if(isset($_POST['load']))
			{
				echo json_encode($this->getdata_model->stock_manual('loadInventory',$_POST));
				exit();
			}
			else
			{
				$data['menu'] = "stock_manual";
				$data['ac'] = $this->validation_model->access();
				$ac = $this->validation_model->access(1, 'SM');
				$val = explode('/', $ac[0]);
				$data['r_'] = $val[1];
				$data['w_'] = $val[2];

			//	$data['p'] = $this->getdata_model->product('loadtable', array(), 1);
				$data['p']=$this->getdata_model->inventory('loadtable',0);
             // echo "<pre>";print_r($data['p']);echo"</pre>";die();
				$this->load->view('template/header',$data);
				$this->load->view('process/stock_manual');		
				$this->load->view('template/footer');
			}
		}
		else
		{
			redirect(base_url());
		}
	}


//	jerald
/*		public function approve_purchase_requests()
	{
		$ac = $this->validation_model->access();

		if(in_array('APR', $ac))
		{
			
				$data['menu'] = "approve_purchase_requests";
				$data['ac'] = $this->validation_model->access();
				$ac = $this->validation_model->access(1, 'APR');
				$val = explode('/', $ac[0]);
				$data['r_'] = $val[1];
				$data['w_'] = $val[2];

				$this->db->where('userid', $this->session->userdata('USERID'));
				$this->db->update('notifications', array('date_seen' => date('Y-m-d H:i:s'), 'status' => 0));

				$this->load->view('template/header',$data);
				$this->load->view('process/approve_purchase_requests');		
				$this->load->view('template/footer');
			
		}
		else
		{
			redirect(base_url());
		}
	}*/

		public function approve_purchase_requests()
	{
		$ac = $this->validation_model->access();

		if(in_array('APR', $ac))
		{
			if(isset($_GET['loadtable']))
			{
				$output = $this->getdata_model->approve_purchase_requests('loadtable', $_GET);
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
				echo json_encode($this->savedata_model->approve_purchase_requests($_POST));
				exit();
			}
			else if(isset($_POST['wf']))
			{
				echo json_encode($this->getdata_model->approve_purchase_requests('wf',$_POST));
				exit();
			}
			else
			{
				$data['menu'] = "approve_purchase_requests";
				$data['ac'] = $this->validation_model->access();
				$ac = $this->validation_model->access(1, 'APR');
				$val = explode('/', $ac[0]);
				$data['r_'] = $val[1];
				$data['w_'] = $val[2];

				$this->db->where('userid', $this->session->userdata('USERID'));
				$this->db->update('notifications', array('date_seen' => date('Y-m-d H:i:s'), 'status' => 0));

				$this->load->view('template/header',$data);
				$this->load->view('process/approve_purchase_requests');		
				$this->load->view('template/footer');
			}
		}
		else
		{
			redirect(base_url());
		}
	}	

	public function job_request(){
		$ac = $this->validation_model->access();

		if(in_array('JR',$ac)){
       

			if(isset($_GET['loadtable']))
			{
				$output = $this->getdata_model->job_request('loadtable', $_GET);
		        $response = array(
		          'aaData' => $output,
		          'iTotalRecords' => count($output),
		          'iTotalDisplayRecords' => count($output),
		          'iDisplayStart' => 0
		        );
		        echo json_encode($response);
		        exit();
			}

			 else if(isset($_POST['add_job_request'])){
				echo json_encode($this->savedata_model->job_request($_POST));
				
				exit();
			}
			else{
			    $data['menu'] = "job request";
				$data['ac'] = $this->validation_model->access();
				$ac = $this->validation_model->access(1, 'JR');
				$val = explode('/', $ac[0]);
				$data['r_'] = $val[1];
				$data['w_'] = $val[2];
				$o = array();
                $q = $this->db->query("SELECT id, name,oic_name FROM office WHERE STATUS = 1 and parent_id is not null and id in (select office from user_office_assignment where userid = ?)", $this->session->userdata('USERID'));
				foreach($q->result() as $r) $o[] = array($r->id, $r->name, $r->oic_name);
				$data['o'] = $o;
				$data['fund_cluster'] = $this->getdata_model->fund_cluster();
			    $this->load->view('template/header',$data);
		        $this->load->view('process/job_request',$data);
			    $this->load->view('template/footer');
			}
		}else
		{
			redirect(base_url());
		}
	}
	public function job_order(){
		$ac = $this->validation_model->access();

		if(in_array('JO',$ac)){

			if(isset($_GET['loadtable']))
			{
				$output = $this->getdata_model->job_order('loadtable', $_GET);
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
				echo json_encode($this->savedata_model->job_order($_POST));
				exit();
			}
			else if(isset($_POST['add_job_order'])){
								
								echo json_encode($this->savedata_model->job_order($_POST));
								exit();
							}
							else{
										$data['u'] = $this->getdata_model->system_users('loadtable');
									$data['bs'] = $this->getdata_model->billing_shipping_details('loaddata');

									$data['supplier'] = $this->getdata_model->supplier_vendor('loadtable');

									$data['item'] = $this->getdata_model->job_request('loadtable', $_GET);
									$data['p'] = $this->getdata_model->job_order('loadtable', array(), 1);
								//	echo"<pre>";print_r($data['p']);echo "</pre>";die();
					 			//echo "<pre>";	print_r($data['item']); echo"</pre>";die();
								    $data['menu'] = "job order";
									$data['ac'] = $this->validation_model->access();
									$ac = $this->validation_model->access(1, 'JO');
									$val = explode('/', $ac[0]);
									$data['r_'] = $val[1];
									$data['w_'] = $val[2];
								  $this->load->view('template/header',$data);
							      $this->load->view('process/job_order');
								  $this->load->view('template/footer');
						     }
			}
	}

	public function view_jo()
	{
		$ac = $this->validation_model->access();

		if(in_array('PO', $ac))
		{
			if(isset($_GET['id']))
			{
				$id = $this->security->xss_clean($_GET['id']);
				$q = $this->db->query("SELECT FORMAT(id,'00000') code, jo_status from job_order where id = ?", $id);
				if($q->num_rows()>0)
				{
					if($q->result()[0]->jo_status == "New" || $q->result()[0]->jo_status == "Changed Order")
					{
						$this->db->where('id', $id);
						$this->db->update('job_order', array('jo_status' => 'Released'));
					}
					$this->load->library('pdf');
					$data['product'] = $this->getdata_model->job_order('loaddata', array('id' => $id));
				//	echo "<pre>"; print_r($data['product']);

				//	 echo "</pre>";die();
					$this->pdf->load_view('reports/view_jo', $data);
					$this->pdf->load_view('reports/view_job_order',$data);
		            $this->pdf->render();
		            $this->pdf->output();
		          
		            $this->pdf->stream($q->result()[0]->code.".pdf", array('Attachment' => 0));
				}
			}
			else
			{
				redirect(base_url());
			}
		}
		else
		{
			redirect(base_url());
		}
	}

	public function furniture_and_equipment_request(){
		$ac = $this->validation_model->access();

		if(in_array('FER',$ac)){


			if(isset($_GET['loadtable']))
			{
				$output = $this->getdata_model->furniture_request('loadtable', $_GET);
		        $response = array(
		          'aaData' => $output,
		          'iTotalRecords' => count($output),
		          'iTotalDisplayRecords' => count($output),
		          'iDisplayStart' => 0
		        );
		        echo json_encode($response);
		        exit();
			}
			else if(isset($_POST['add_furniture_request'])){
				echo json_encode($this->savedata_model->furniture_request($_POST));
				
				exit();
			}else{

			                    $data['menu'] = "furniture request";
			                     $data['ac'] = $this->validation_model->access();
									$ac = $this->validation_model->access(1, 'FER');
									$val = explode('/', $ac[0]);
									$data['r_'] = $val[1];
									$data['w_'] = $val[2];


									$o = array();
					                $q = $this->db->query("SELECT id, name,oic_name FROM office WHERE STATUS = 1 and parent_id is not null and id in (select office from user_office_assignment where userid = ?)", $this->session->userdata('USERID'));
									foreach($q->result() as $r) $o[] = array($r->id, $r->name, $r->oic_name);
									$data['o'] = $o;
									$data['fund_cluster'] = $this->getdata_model->fund_cluster();
								    
								  $this->load->view('template/header',$data);
							      $this->load->view('process/furniture_request');
								  $this->load->view('template/footer');
				}
		}
	}
	public function furniture_and_equipment_order(){
		$ac = $this->validation_model->access();

		if(in_array('FEO',$ac)){

			if(isset($_POST['initProduct']))
			{
				echo json_encode($this->getdata_model->furniture_order('initProduct',$_POST));
				
				exit();
			}

			if(isset($_POST['loadPrice']))
			{
				$q = $this->db->query("SELECT unit_cost from furniture_request_line where id = ?", $this->security->xss_clean($_POST['id']));
				echo json_encode($q->result()[0]->unit_cost);
				exit();
			}

			if(isset($_GET['loadtable']))
			{
				$output = $this->getdata_model->furniture_order('loadtable', $_GET);
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
				echo json_encode($this->savedata_model->furniture_order($_POST));
				exit();
			}
			else if(isset($_POST['add_furniture_order'])){
								
								echo json_encode($this->savedata_model->furniture_order($_POST));
								exit();
							}
			else{
						$data['u'] = $this->getdata_model->system_users('loadtable');

									$data['bs'] = $this->getdata_model->billing_shipping_details('loaddata');

									$data['supplier'] = $this->getdata_model->supplier_vendor('loadtable');

									$data['item'] = $this->getdata_model->furniture_request('loadtable', $_GET);	

										 $data['menu'] = "furniture order";
										$data['ac'] = $this->validation_model->access();
									$ac = $this->validation_model->access(1, 'FEO');
									$val = explode('/', $ac[0]);
									$data['r_'] = $val[1];
									$data['w_'] = $val[2];
								  $this->load->view('template/header',$data);
							      $this->load->view('process/furniture_order');
								  $this->load->view('template/footer');
						}
		}
	}

	public function view_fo()
	{
		$ac = $this->validation_model->access();

		if(in_array('PO', $ac))
		{
			if(isset($_GET['id']))
			{
				$id = $this->security->xss_clean($_GET['id']);
				$q = $this->db->query("SELECT FORMAT(id,'00000') code, fo_status from furniture_order where id = ?", $id);
				if($q->num_rows()>0)
				{
					if($q->result()[0]->fo_status == "New" || $q->result()[0]->fo_status == "Changed Order")
					{
						$this->db->where('id', $id);
						$this->db->update('furniture_order', array('fo_status' => 'Released'));
					}
					$this->load->library('pdf');
					$data['product'] = $this->getdata_model->furniture_order('loaddata', array('id' => $id));
				//	echo "<pre>"; print_r($data['product']);

				//	 echo "</pre>";die();
					$this->pdf->load_view('reports/view_fo', $data);
					$this->pdf->load_view('reports/view_furniture_order',$data);
		            $this->pdf->render();
		            $this->pdf->output();
		          
		            $this->pdf->stream($q->result()[0]->code.".pdf", array('Attachment' => 0));
				}
			}
			else
			{
				redirect(base_url());
			}
		}
		else
		{
			redirect(base_url());
		}
	}
	
	
		public function stock_card(){
		$ac = $this->validation_model->access();

		if(in_array('SC',$ac)){
			 $data['menu'] = "stock card";
			$data['ac'] = $this->validation_model->access();
									$ac = $this->validation_model->access(1, 'SC');
									$val = explode('/', $ac[0]);
									$data['r_'] = $val[1];
									$data['w_'] = $val[2];
								  $this->load->view('template/header',$data);
							      $this->load->view('process/stock_card');
								  $this->load->view('template/footer');
		}
	}

	#############################################################
#															#
#					APPROVE JOB REQUEST 					#
#															#
#	Created by : RBC 										#
# 	Date updated : 02/21/18									#
#############################################################
	public function approve_job_request(){
		$ac = $this->validation_model->access();

		if(in_array('AJR',$ac)){

			if(isset($_GET['loadtable']))
			{
				$output = $this->getdata_model->approve_job_requests('loadtable', $_GET);
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
				echo json_encode($this->savedata_model->approve_job_requests($_POST));
				exit();
			}
			else if(isset($_POST['wf']))
			{
				echo json_encode($this->getdata_model->approve_job_requests('wf',$_POST));
				exit();
			}
			else
			{
				$data['menu'] = "approve job request";
				$data['ac'] = $this->validation_model->access();
				$ac = $this->validation_model->access(1, 'AJR');
				$val = explode('/', $ac[0]);
				$data['r_'] = $val[1];
				$data['w_'] = $val[2];

				$this->db->where('userid', $this->session->userdata('USERID'));
				$this->db->update('notifications', array('date_seen' => date('Y-m-d H:i:s'), 'status' => 0));

				$this->load->view('template/header',$data);
		      	$this->load->view('process/approve_job_request');
			  	$this->load->view('template/footer');
			}

			
		  	
		}
	}

	#############################################################
#															#
#			Approve Furniture/Equipment Request 			#
#															#
#	Created by : RBC 										#
# 	Date updated : 02/21/18									#
#############################################################
	public function approve_furniture_and_equipment_request(){
		$ac = $this->validation_model->access();

		if(in_array('AFER',$ac)){
			if(isset($_GET['loadtable']))
			{
				$output = $this->getdata_model->approve_furniture_requests('loadtable', $_GET);
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
				echo json_encode($this->savedata_model->approve_furniture_requests($_POST));
				exit();
			}
			else if(isset($_POST['wf']))
			{
				echo json_encode($this->getdata_model->approve_furniture_requests('wf',$_POST));
				exit();
			}
			else
			{
				$data['menu'] = "approve furniture request";
				$data['ac'] = $this->validation_model->access();
				$ac = $this->validation_model->access(1, 'AFER');
				$val = explode('/', $ac[0]);
				$data['r_'] = $val[1];
				$data['w_'] = $val[2];

				$this->db->where('userid', $this->session->userdata('USERID'));
				$this->db->update('notifications', array('date_seen' => date('Y-m-d H:i:s'), 'status' => 0));

				$this->load->view('template/header',$data);
		      	$this->load->view('process/approve_furniture_and_equipment_request');
			  	$this->load->view('template/footer');
			}
		}
	}
}

?>
