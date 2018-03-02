<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report extends CI_Controller {

	function __construct()
    {
        parent::__construct();	

    } 	

    public function product()
	{
		$ac = $this->validation_model->access();

		if(in_array('RP', $ac))
		{
			$data['menu'] = "r_product";
			$data['ac'] = $this->validation_model->access();
			$ac = $this->validation_model->access(1, 'RP');
			$val = explode('/', $ac[0]);
			$data['r_'] = $val[1];
			$data['w_'] = $val[2];

			$data['category'] = $this->getdata_model->category();

			$this->load->view('template/header',$data);
			$this->load->view('reports/product');	   
		//	$this->load->view('reports/');

			$this->load->view('template/footer');
			
		}
		else
		{
			redirect(base_url());
		}
	}
	public function product_pdf()
	{
		$ac = $this->validation_model->access();
		
		if(in_array('RP', $ac))
		{
			$result = array();
			$data['columns'] = $this->security->xss_clean($_GET['columns']);
			$category = $this->security->xss_clean($_GET['category']);
			$status = $this->security->xss_clean($_GET['status']);

			$cat = "(";
			foreach($category as $r)
				$cat .= $r.",";
			$cat.="0)";

			if($status == 'Active')
				$stat = " and p.status = 1";
			else if($status == 'Inactive')
				$stat = ' and p.status = 0';
			else
				$stat = "";
			$q = $this->db->query("SELECT CONCAT(DATEPART(yyyy,p.date_added),'-',p.types,'-',pc.master_id,'-',p.category_id) stock_number,
									  FORMAT(p.id,'0000') id,
									  p.description,p.unit_price unit_value,
									  un.code,
									  p.critical_level,
									  CONVERT(VARCHAR,p.date_added, 101) date_added,
									  concat(u.lname, ', ', u.fname) added_by,
									    un.description unit,
									     inv.current_stock stock
									FROM product p 
									INNER JOIN product_category pc 
										ON pc.id = p.category_id
									inner join users u 
									on u.id = p.added_by
									inner join units un
									on un.id = p.measurement
									inner join inventory inv
									on inv.product=p.id
									where p.property = 0 ");

			foreach($q->result() as $r)
			{
				$cat = $this->getdata_model->category($r->category_id);
				$unit_price=$r->unit_value;
				$result[] = array(
					'category' => $cat[0]['desc'],
					'description' => $r->description,
					'stock_number'=>$r->stock_number,
					'date_added' => $r->date_added,
					'added_by' => $r->added_by,
					'code' => $r->code,
					'critical_level' => $r->critical_level,
					'id' => $r->id,
					'unit'=>$r->unit,
					'stock'=>$r->stock,
					'unit_value'=> ($unit_price == 0)?"---":'Php '.number_format($unit_price,2)
					);
			}
			// echo json_encode($result);
			// exit();
			$this->load->library('pdf');
			$data['product'] = $result;


			//$this->pdf->load_view('reports/product_pdf', $data);
            $this->pdf->load_view('reports/RPCI(supplies)',$data);
            $this->pdf->set_paper('a4', 'landscape');
            $this->pdf->render();
            $this->pdf->output();
          
            $this->pdf->stream("products.pdf", array('Attachment' => 0));
			
		}
		else
		{
			redirect(base_url());
		}
	}

	public function product_excel()
	{
		$ac = $this->validation_model->access();
		
		if(in_array('RP', $ac))
		{
			$result = array();
			$data['columns'] = $this->security->xss_clean($_GET['columns']);
			$category = $this->security->xss_clean($_GET['category']);
			$status = $this->security->xss_clean($_GET['status']);

			$cat = "(";
			foreach($category as $r)
				$cat .= $r.",";
			$cat.="0)";

			if($status == 'Active')
				$stat = " and p.status = 1";
			else if($status == 'Inactive')
				$stat = ' and p.status = 0';
			else
				$stat = "";
			$q = $this->db->query("SELECT
									  LPAD(p.id,4,0) id,
									  category_id,
									  p.description,
									  un.code,
									  p.critical_level,
									  CONVERT(VARCHAR,p.date_added, 101) date_added,
									  concat(u.lname, ', ', u.fname) added_by
									FROM product p 
									inner join users u 
									on u.id = p.added_by
									inner join units un
									on un.id = p.measurement
									where category_id in $cat $stat");

			foreach($q->result() as $r)
			{
				$cat = $this->getdata_model->category($r->category_id);
				$result[] = array(
					'category' => $cat[0]['desc'],
					'description' => $r->description,
					'date_added' => $r->date_added,
					'added_by' => $r->added_by,
					'code' => $r->code,
					'critical_level' => $r->critical_level,
					'id' => $r->id
					);
			}
			$data['product'] = $result;
			$this->load->view('reports/product_excel', $data);
			
		}
		else
		{
			redirect(base_url());
		}
	}


	 

  
	public function inventory()
	{
		function compare($a, $b)
		  {
		    return strcmp($a['desc'], $b['desc']);
		  }
		$ac = $this->validation_model->access();

		if(in_array('RI', $ac))
		{
			$data['menu'] = "r_inventory";
			$data['ac'] = $this->validation_model->access();
			$ac = $this->validation_model->access(1, 'RI');
			$val = explode('/', $ac[0]);
			$data['r_'] = $val[1];
			$data['w_'] = $val[2];

			$data['category'] = $this->getdata_model->category(0,0,1);
			$data['p'] = $this->getdata_model->product('loadtable',array(), 1);
			// $arr = $data['category'];
			// echo json_encode($arr);
			usort($data['category'], 'compare');
			// echo json_encode($arr);

			// exit();

			$data['category'] = $data['category'];

			$this->load->view('template/header',$data);
			$this->load->view('reports/inventory');		
			$this->load->view('template/footer');
			
		}
		else
		{
			redirect(base_url());
		}
	}
	public function inventory_pdf()
	{
		$ac = $this->validation_model->access();
		
		if(in_array('RI', $ac))
		{
			$result = array();
			$data['columns'] = $this->security->xss_clean($_GET['columns']);
			$category = $this->security->xss_clean($_GET['category']);
			$status = $this->security->xss_clean($_GET['status']);
			$product = $this->security->xss_clean($_GET['product']);

			$cat = "(";
			foreach($category as $r)
				$cat .= $r.",";
			$cat.="0)";

			if($status == 'Active')
				$stat = " and p.status = 1";
			else if($status == 'Inactive')
				$stat = ' and p.status = 0';
			else
				$stat = "";

			$cond = "";
			if($product != "")
				$cond = " and p.id = ?";
			if(in_array('unit_price', $data['columns']))
				$q = $this->db->query("SELECT CONCAT('INV-', FORMAT(i.id,'00000')) st_id,
									CONCAT(DATEPART(yyyy,p.date_added),'-',p.types,'-',pc.master_id,'-',p.category_id) stock_number,
									FORMAT(i.id,'00000') id,
									i.id id_,
									p.description,
									p.unit_price as value,
									p.critical_level,
									FORMAT(i.current_stock,'00') current_stock,
									u.username added_by, 
									i.remarks, 
									CONVERT(VARCHAR,i.date_updated) date_updated,
									unit.code as unit, p.id p_id,pc.id category_id ,p.property property
									FROM inventory i
									INNER JOIN product p 
									ON p.id = i.product
									left JOIN product_category pc 
									ON pc.id = p.category_id
									left join units unit
									on unit.id=p.measurement
									left join users u 
									on u.id = i.added_by WHERE i.status = 1");
			else
				$q = $this->db->query("SELECT CONCAT('INV-', FORMAT(i.id,'00000')) st_id,
									CONCAT(DATEPART(yyyy,p.date_added),'-',p.types,'-',pc.master_id,'-',p.category_id) stock_number,
									FORMAT(i.id,'00000') id,
									i.id id_,
									p.description,
									p.unit_price as value,
									p.critical_level,
									FORMAT(i.current_stock,'00') current_stock,
									u.username added_by, 
									i.remarks, 
									CONVERT(VARCHAR,i.date_updated) date_updated,
									unit.code as unit, p.id p_id,pc.id category_id ,p.property property
									FROM inventory i
									INNER JOIN product p 
									ON p.id = i.product
									left JOIN product_category pc 
									ON pc.id = p.category_id
									left join units unit
									on unit.id=p.measurement
									left join users u 
									on u.id = i.added_by WHERE i.status = 1");
		
			foreach($q->result() as $r)
			{
				
						$result[] = array(
						'article' => $r->description,
						'description' => $r->description,
						'stock_number' => $r->stock_number,
						'unit' => $r->unit,
						'value' => $r->value,			
						'on_hand' => $r->current_stock
						
						);
			}
			// echo json_encode($result);
			// exit();
			$this->load->library('pdf');
			$data['product'] = $result;
		  
			$this->pdf->load_view('reports/RPCI',$data);
			 $this->pdf->set_paper('a4', 'landscape');
            $this->pdf->render();
            $this->pdf->output();
          
            $this->pdf->stream("products.pdf", array('Attachment' => 0));
			
		}
		else
		{
			redirect(base_url());
		}
	}
	public function reports_rpci()
	{
			$ac = $this->validation_model->access();
		
		if(in_array('RI', $ac))
		{
			$q = $this->db->query("SELECT CONCAT('INV-', FORMAT(i.id,'00000')) st_id,
									CONCAT(DATEPART(yyyy,p.date_added),'-',p.types,'-',pc.master_id,'-',p.category_id) stock_number,
									FORMAT(i.id,'00000') id,
									i.id id_,
									p.description,
									p.unit_price as value,
									p.critical_level,
									FORMAT(i.current_stock,'00') current_stock,
									u.username added_by, 
									i.remarks, 
									CONVERT(VARCHAR,i.date_updated) date_updated,
									unit.code as unit, p.id p_id,pc.id category_id ,p.property property
									FROM inventory i
									INNER JOIN product p 
									ON p.id = i.product
									left JOIN product_category pc 
									ON pc.id = p.category_id
									left join units unit
									on unit.id=p.measurement
									left join users u 
									on u.id = i.added_by WHERE i.status = 1");
			foreach($q->result() as $r)
				{

						$result[] = array(
						'article' => $r->description,
						'description' => $r->description,
						'stock_number' => $r->stock_number,
						'unit' => $r->unit,
						'value' => $r->value,			
						'on_hand' => $r->current_stock
						
						);
				}

			$this->load->library('pdf');
			$data['product'] = $result;

			$this->pdf->load_view('reports/RPCI', $data);
			 $this->pdf->set_paper('a4', 'landscape');
            $this->pdf->render();
            $this->pdf->output();
          
            $this->pdf->stream("products.pdf", array('Attachment' => 0));
		}
		else
		{
			redirect(base_url());
		}

	}









	public function inventory_excel()
	{
		$ac = $this->validation_model->access();
		
		if(in_array('RI', $ac))
		{
			$result = array();
			$data['columns'] = $this->security->xss_clean($_GET['columns']);
			$category = $this->security->xss_clean($_GET['category']);
			$status = $this->security->xss_clean($_GET['status']);
			$product = $this->security->xss_clean($_GET['product']);

			$cat = "(";
			foreach($category as $r)
				$cat .= $r.",";
			$cat.="0)";

			if($status == 'Active')
				$stat = " and p.status = 1";
			else if($status == 'Inactive')
				$stat = ' and p.status = 0';
			else
				$stat = "";

			$cond = "";
			if($product != "")
				$cond = " and p.id = ?";
			$q = $this->db->query("SELECT 
									  FORMAT(p.id,'0000') id,
									  category_id,
									  p.description,
									  CONCAT(coalesce(i.current_stock,0),' ',un.code) current_stock,
									  CONCAT(coalesce(p.critical_level,0),' ',un.code) critical_level,
									  CONVERT(VARCHAR,COALESCE(i.date_updated, i.date_added), 101) date_updated,
									  CONCAT(u.lname, ', ', u.fname) updated_by,
									  CONCAT(COALESCE(ROUND(SUM(tbl.total),0),0),' ',un.code) purchase_order
									FROM product p 

									INNER JOIN units un
									ON un.id = p.measurement
									LEFT JOIN inventory i 
									ON i.product = p.id AND i.status = 1
									LEFT JOIN users u 
									ON u.id = COALESCE(i.updated_by, i.added_by)
									LEFT JOIN (SELECT pol.product, 
									(SUM(pol.qty)/COUNT(*))-SUM(COALESCE(d.qty_received,0)) total
									FROM purchase_order po 
									INNER JOIN purchase_order_line  pol
									ON pol.po_id = po.id AND pol.status = 1
									LEFT JOIN delivery d 
									ON d.pol_id = pol.id AND d.status = 1
									WHERE (po.po_status = 'New' OR po.po_status = 'Partially Received' OR po.po_status = 'Released' OR po.po_status = 'Changed Order')
									GROUP BY pol.id, pol.product, pol.qty, d.qty_received) tbl ON tbl.product = p.id
									where category_id in $cat $stat
									p.id, category_id, p.description, i.current_stock, un.code, p.critical_level, i.date_updated, i.date_added, u.lname, u.fname, tbl.total");
		
			foreach($q->result() as $r)
			{
				$cat = $this->getdata_model->category($r->category_id);
				$result[] = array(
					'category' => $cat[0]['desc'],
					'description' => $r->description,
					'date_updated' => $r->date_updated,
					'updated_by' => $r->updated_by,
					'current_stock' => $r->current_stock,
					'critical_level' => $r->critical_level,
					'purchase_order' => $r->purchase_order,
					'id' => $r->id
					);
			}
			$data['product'] = $result;
			$this->load->view('reports/inventory_excel', $data);
			
		}
		else
		{
			redirect(base_url());
		}
	}

	public function stock_ledger()
	{
		function compare($a, $b)
		{
		  return strcmp($a['desc'], $b['desc']);
		}
		$ac = $this->validation_model->access();

		if(in_array('SL', $ac))
		{
			if(isset($_GET['loadProduct']))
			{
				echo json_encode($this->getdata_model->stock_ledger($_GET));
				exit();
			}
			else
			{
				$data['menu'] = "r_stock_ledger";
				$data['ac'] = $this->validation_model->access();
				$ac = $this->validation_model->access(1, 'SL');
				$val = explode('/', $ac[0]);
				$data['r_'] = $val[1];
				$data['w_'] = $val[2];

				$data['p'] = $this->getdata_model->product('loadtable', array(), 1);

				$data['category'] = $this->getdata_model->category(0,0,1);
				usort($data['category'], 'compare');

				$this->load->view('template/header',$data);
				$this->load->view('reports/stock_ledger');		
				$this->load->view('template/footer');
			}
			
			
		}
		else
		{
			redirect(base_url());
		}
	}
	public function stock_ledger_pdf()
	{
		$ac = $this->validation_model->access();
		
		if(in_array('SL', $ac))
		{
			if($_GET['product'] == '')
			{
				return redirect(base_url('Report/stock_ledger'));
			}


			$result = array();
			$data['columns'] = $this->security->xss_clean($_GET['columns']);

			$data['ledger'] = $this->getdata_model->stock_ledger($_GET);
			$data['bal'] = $this->getdata_model->stock_ledger($_GET, 'loadPrev');
			$q = $this->db->query("SELECT description from product where id = ?", $_GET['product']);
			$data['item'] = $q->result()[0]->description;
			$data['status'] = $_GET['status'];

			$from = $this->security->xss_clean(date('Y-m-d', strtotime($_GET['start'])));
			$to = $this->security->xss_clean(date('Y-m-d', strtotime($_GET['end'])));
			// echo json_encode($data['ledger']);
			// exit();
			if($_GET['start'] == "")
				$from = "---";
			if($_GET['end'] == "")
				$to = "---";
			$data['dates'] = array($from, $to);


			// $this->load->view('reports/stock_ledger_pdf', $data);
			// echo json_encode($data['status']);
			// exit();
			$this->load->library('pdf');
			// $data['product'] = $result;
			$this->pdf->load_view('reports/stock_ledger_pdf', $data);
            $this->pdf->render();
            $this->pdf->output();
          
            $this->pdf->stream("stock_ledger.pdf", array('Attachment' => 0));
			
		}
		else
		{
			redirect(base_url());
		}
	}

	public function stock_ledger_excel()
	{
		$ac = $this->validation_model->access();
		
		if(in_array('SL', $ac))
		{
			$result = array();
			$data['columns'] = $this->security->xss_clean($_GET['columns']);

			$data['ledger'] = $this->getdata_model->stock_ledger($_GET);
			$data['status'] = $_GET['status'];

			$from = $this->security->xss_clean(date('Y-m-d', strtotime($_GET['start'])));
			$to = $this->security->xss_clean(date('Y-m-d', strtotime($_GET['end'])));
			// echo json_encode($from);
			// exit();
			if($_GET['start'] == "")
				$from = "---";
			if($_GET['end'] == "")
				$to = "---";
			$data['dates'] = array($from, $to);


			$this->load->view('reports/stock_ledger_excel', $data);
			
		}
		else
		{
			redirect(base_url());
		}
	}

	public function office_expense()
	{
		$ac = $this->validation_model->access();

		if(in_array('OE', $ac))
		{
			$data['menu'] = "r_office_expense";
			$data['ac'] = $this->validation_model->access();
			$ac = $this->validation_model->access(1, 'OE');
			$val = explode('/', $ac[0]);
			$data['r_'] = $val[1];
			$data['w_'] = $val[2];

			$data['o'] = $this->getdata_model->department_office('loadtable');

			$this->load->view('template/header',$data);
			$this->load->view('reports/office_expense');		
			$this->load->view('template/footer');
			
		}
		else
		{
			redirect(base_url());
		}
	}
	public function office_expense_pdf()
	{
		$ac = $this->validation_model->access();
		
		if(in_array('OE', $ac))
		{
			$result = array();
			$data['columns'] = $this->security->xss_clean($_GET['columns']);

			$data['expense'] = $this->getdata_model->office_expense($_GET);

			$from = $this->security->xss_clean(date('Y-m-d', strtotime($_GET['start'])));
			$to = $this->security->xss_clean(date('Y-m-d', strtotime($_GET['end'])));
			// echo json_encode($from);
			// exit();
			if($_GET['start'] == "")
				$from = "---";
			if($_GET['end'] == "")
				$to = "---";
			$data['dates'] = array($from, $to);


			// $this->load->view('reports/stock_ledger_pdf', $data);
			// echo json_encode($data['status']);
			// exit();
			$this->load->library('pdf');
			// $data['product'] = $result;
			$this->pdf->load_view('reports/office_expense_pdf', $data);
            $this->pdf->render();
            $this->pdf->output();
          
            $this->pdf->stream("office_expense.pdf", array('Attachment' => 0));
			
		}
		else
		{
			redirect(base_url());
		}
	}

	public function office_expense_excel()
	{
		$ac = $this->validation_model->access();
		
		if(in_array('OE', $ac))
		{
			$result = array();
			$data['columns'] = $this->security->xss_clean($_GET['columns']);

			$data['expense'] = $this->getdata_model->office_expense($_GET);

			$from = $this->security->xss_clean(date('Y-m-d', strtotime($_GET['start'])));
			$to = $this->security->xss_clean(date('Y-m-d', strtotime($_GET['end'])));
			// echo json_encode($from);
			// exit();
			if($_GET['start'] == "")
				$from = "---";
			if($_GET['end'] == "")
				$to = "---";
			$data['dates'] = array($from, $to);


			$this->load->view('reports/office_expense_excel', $data);
			
		}
		else
		{
			redirect(base_url());
		}
	}

	public function property()
	{
		$ac = $this->validation_model->access();

		if(in_array('RPROP', $ac))
		{
			if(isset($_GET['loadEmployee']))
			{
				echo json_encode($this->getdata_model->property_report('loadEmployee', $_GET));
				exit();
			}
			else
			{
				$data['menu'] = "r_property";
				$data['ac'] = $this->validation_model->access();
				$ac = $this->validation_model->access(1, 'RPROP');
				$val = explode('/', $ac[0]);
				$data['r_'] = $val[1];
				$data['w_'] = $val[2];

				$data['category'] = $this->getdata_model->category(0,1,0);
				$data['e'] = $this->getdata_model->property_report('loadEmployee');
				$data['o'] = $this->getdata_model->property_report('loadOffice');
				// echo json_encode($data['o']);
				// exit();

				$this->load->view('template/header',$data);
				$this->load->view('reports/property');		
				$this->load->view('template/footer');
			}
			
		}
		else
		{
			redirect(base_url());
		}
	}
	public function property_pdf()
	{
		$ac = $this->validation_model->access();
		
		if(in_array('RPROP', $ac))
		{
			$result = array();
			//$data['columns'] = $this->security->xss_clean($_GET['columns']);
			//$category = $this->security->xss_clean($_GET['category']);
			$status = $this->security->xss_clean($_GET['status']);

			$office = $this->security->xss_clean($_GET['office']);
		//	$employee = $this->security->xss_clean($_GET['employee']);

			/*$cat = "(";
			foreach($category as $r)
				$cat .= $r.",";
			$cat.="0)";

			if($status == 'active')
				$stat = " and p.status = 1";
			else if($status == 'inactive')
				$stat = ' and p.status = 0';
			else
				$stat = "";

			$cond = "";

			if($office != "")
				$cond .= " and pa.officeid = ".$office;
			if($employee != "")
				$cond .= " and pa.userid = ".$employee;*/

			$q = $this->db->query("SELECT CONCAT(DATEPART(yyyy,p.date_added),'-','TYPE','-',pc.master_id,'-',p.category_id) property_number,
									  FORMAT(p.id,'0000') id,
									   concat(substring(convert(varchar,p.date_added, 2),1,2),'-',substring(convert(varchar,p.date_added, 2),4,2),'-',format(p.id,'0000')) as p_id,
									  category_id,
									  p.description,
									  un.code,
									  p.critical_level,
									  CONVERT(VARCHAR,p.date_added, 101) date_added,
									  CONCAT(u.lname, ', ', u.fname) added_by,
									  CONCAT(u2.lname, ', ', u2.fname) employee,
									  o.name office,
									  pa.property_code,p.unit_price unit_price,inv.current_stock stock,p.property
									  
									FROM product p 
									left JOIN product_category pc 
										ON pc.id = p.category_id
									LEFT JOIN property_assignment pa 
									ON pa.property_id = p.id 
									LEFT JOIN office o 
									ON o.id = pa.officeid
									LEFT JOIN users u2 
									ON u2.id = pa.userid
									INNER JOIN users u 
									ON u.id = p.added_by
									INNER JOIN units un
									ON un.id = p.measurement
									inner join inventory inv
									on p.id=inv.product
									WHERE p.property = 1 and p.status=1 ");
			//and category_id in $cat $stat $cond

			foreach($q->result() as $r)
			{
				//$cat = $this->getdata_model->category($r->category_id);
				$result[] = array(
					'category' => ($r->property == 1)?$this->getdata_model->category($r->category_id,1)[0]['desc']:$this->getdata_model->category($r->category_id,0)[0]['desc'],
					'description' => $r->description,
					'date_added' => $r->date_added,
					'added_by' => $r->added_by,
					'code' => $r->code,
					'critical_level' => $r->critical_level,
					'employee' => $r->employee,
					'office' => $r->office,
					'property_code' => $r->property_code,
					'id' => $r->id,
					'property_number'=>$r->property_number,
					'unit_value'=>$r->unit_price,
					'stock'=>$r->stock
					);
			}
			// echo json_encode($result);
			// exit();

			$this->load->library('pdf');
			$data['property'] = $result;
			//$this->pdf->load_view('reports/property_pdf', $data);
            $this->pdf->load_view('reports/RPCPPE',$data);
            $this->pdf->set_paper('a4', 'landscape');
            $this->pdf->render();
            $this->pdf->output();
          
            $this->pdf->stream("propertys.pdf", array('Attachment' => 0));
			
		}
		else
		{
			redirect(base_url());
		}
	}

	public function property_excel()
	{
		$ac = $this->validation_model->access();
		
		if(in_array('RPROP', $ac))
		{
			$result = array();
			$data['columns'] = $this->security->xss_clean($_GET['columns']);
			$category = $this->security->xss_clean($_GET['category']);
			$status = $this->security->xss_clean($_GET['status']);

			$cat = "(";
			foreach($category as $r)
				$cat .= $r.",";
			$cat.="0)";

			if($status == 'Active')
				$stat = " and p.status = 1";
			else if($status == 'Inactive')
				$stat = ' and p.status = 0';
			else
				$stat = "";
			$q = $this->db->query("SELECT
									  FORMAT(p.id,'0000') id,
									  category_id,
									  p.description,
									  un.code,
									  p.critical_level,
									  CONVERT(VARCHAR,p.date_added, 101) date_added,
									  concat(u.lname, ', ', u.fname) added_by
									FROM product p 
									inner join users u 
									on u.id = p.added_by
									inner join units un
									on un.id = p.measurement
									where category_id in $cat $stat");

			foreach($q->result() as $r)
			{
				$cat = $this->getdata_model->category($r->category_id);
				$result[] = array(
					'category' => $cat[0]['desc'],
					'description' => $r->description,
					'date_added' => $r->date_added,
					'added_by' => $r->added_by,
					'code' => $r->code,
					'critical_level' => $r->critical_level,
					'id' => $r->id
					);
			}
			$data['property'] = $result;
			$this->load->view('reports/property_excel', $data);
			
		}
		else
		{
			redirect(base_url());
		}
	}



	
}

?>
