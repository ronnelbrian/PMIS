<?php
class getdata_model extends CI_Model{

	public function fund_cluster(){

		$arr = array();
		$arr[]=array('Special Accounts - Locally Funded (151)');			
		/*$arr[]=array('Code-02 Foreign Assisted Projects Fund');
		$arr[]=array('Code-03 Special Account - Locally Funded/Domestic Grants Fund');
		$arr[]=array('Code-04 Special Account - Foreign Assisted/Foreign Grants Fund');
		$arr[]=array('Code-05 Internally Generated Funds');
		$arr[]=array('Code-06 Business Related Funds');		
		$arr[]=array('Code-07 Trust Receipts');*/
		return $arr;
	}

	public function property_type(){
		$arr=array();
		$arr[]=array('Books');
		$arr[]=array('Communication Equipment');
		$arr[]=array('Land');
		$arr[]=array('Office Building');
		$arr[]=array('Military and Police Equipment');
		$arr[]=array('Motor Vehicle');
		$arr[]=array('Info. & Comm. Equipment');
		$arr[]=array('Software');
		$arr[]=array('Dis. Resp and Rescue Eqpt.');
		$arr[]=array('Office Equipment');
		$arr[]=array('Furniture and Fixture');
		$arr[]=array('Other Structure');
		return $arr;
	}
	public function supply_type(){
		$arr=array();
		$arr[]=array('Common Office Supply');
		$arr[]=array('Non-Recurring Supply');
		$arr[]=array('Common Computer Suppy');
		
		return $arr;
	}

	public function user_roles($act, $input = array())
	{
		$result = array();
		
		if($act == 'loadtable' || $act == 'getspecific')
		{
			$cond = "";
			if($act == "getspecific")
			{
				$id = $this->security->xss_clean($input['id']);
				$cond = " and id = $id";
			}

			$q = $this->db->query("SELECT id, FORMAT(id,'0000') id_, description FROM role WHERE STATUS = 1 $cond");
			
			foreach($q->result() as $r) 
			{
				$ac = $this->validation_model->access(1, 'UR');
				$val = explode('/', $ac[0]);
				$r_ = $val[1];
				$w_ = $val[2];
				$name = '"'.$r->description.'"';
				($w_ == 1)?$btn = "<center><button class='btn-danger btn-xs '  data-tooltip='Delete' onclick='del_(".$r->id.",".$name.")'> 
		                         <i class='fa fa-trash-o'></i>
		                         <span></span></button>
		                         <button class='btn-success btn-xs '  data-tooltip='Edit' id='back-to-top' onclick='edit_(".$r->id.")'>
			                     <i class='fa fa-pencil'></i>
			                     <span></span></button>
			                     </center>":$btn = "";

				$result[] = array(
					$r->id_,
					$r->description,
					$btn,
					$r->id);
			}
		}
		
		return $result;
	}
	
	public function system_users($act, $input = array())
	{
		$result = array();
		
		if($act == 'loadtable' || $act == 'getspecific')
		{
			$cond = "";
			if($act == "getspecific")
			{
				$id = $this->security->xss_clean($input['id']);
				$cond = " and u.id = $id";
			}

			$q = $this->db->query("SELECT u.id, fname, mname, lname, suffix, bday, bplace, username, gender, address, FORMAT(u.id,'0000') id_, 
										CONCAT(lname, ', ', fname, ' ', mname, ' ', suffix, CASE WHEN suffix != '' THEN '.' ELSE '' END) name, image_path, r.description role, r.id role_
									FROM users u 
									INNER JOIN role r 
									ON r.id = u.role
									WHERE u.status = 1 $cond");
			
			foreach($q->result() as $r) 
			{
				$ac = $this->validation_model->access(1, 'UR');
				$val = explode('/', $ac[0]);
				$r_ = $val[1];
				$w_ = $val[2];

				$name = '"'.$r->name.'"';
				($w_ == 1)?$btn = "<center><button class='btn-danger btn-xs '  data-tooltip='Delete' onclick='del_(".$r->id.",".$name.")'> 
		                         <i class='fa fa-trash-o'></i>
		                         <span></span></button>
		                         <button class='btn-success btn-xs '  data-tooltip='Edit' id='back-to-top' onclick='edit_(".$r->id.")'>
			                     <i class='fa fa-pencil'></i>
			                     <span></span></button>
			                     </center>":$btn = "";

				$result[] = array(
					$r->id_,
					'<center><a href="'.base_url('assets/uploads').'/'.$r->image_path.'" target="_blank"><img style="width:50px; height:50px" src="'.base_url('assets/uploads').'/'.$r->image_path.'">'.'</img></a></center>',
					$r->name,
					$r->username,
					$r->role,
					$btn,
					$r->id,
					$r->fname,
					$r->mname,
					$r->lname,
					$r->suffix,
					$r->bday,
					$r->bplace,
					$r->gender,
					$r->address,
					$r->role_,
					$r->username
					);
			}
		}
		
		return $result;
	}

	public function access_control($act, $input = array())
	{
		$result = array();
		$trans = $this->security->xss_clean($input['trans']);
		if($act == 'loadtable')
		{
			if($trans != "")
			{
				$q = $this->db->query("SELECT u.id ID, fname, mname, lname, suffix, bday, bplace, username, gender, address, FORMAT(u.id,'0000') id_, 
											CONCAT(lname, ', ', fname, ' ', mname, ' ', suffix, CASE WHEN suffix != '' THEN '.' ELSE '' END) name, image_path, r.description role, r.id role_, ac.trans, ac.ac_read, ac.ac_write
										FROM users u 
										INNER JOIN role r 
										ON r.id = u.role
										LEFT JOIN access_control ac 
										ON ac.userid = u.id and ac.trans = ?
										WHERE u.status = 1", $trans);
				
				foreach($q->result() as $r) 
				{
					($r->ac_read == 1)?$r_c = ' checked ':$r_c = ' ';
					($r->ac_write == 1)?$w_c = ' checked ':$w_c = ' ';

					$ac = $this->validation_model->access(1, 'AC');
					$val = explode('/', $ac[0]);
					$r_ = $val[1];
					$w_ = $val[2];

					($w_ == 1)?$read = '<center><input type="checkbox" id="r_'.$r->ID.'" onchange="u_r('.$r->ID.')" '.$r_c.'></center>':$read = "";
					($w_ == 1)?$write = '<center><input type="checkbox" id="w_'.$r->ID.'" onchange="u_w('.$r->ID.')" '.$w_c.'></center>':$write = "";
					$result[] = array(
						$r->name,
						$r->role,
						$read,
						$write);
				}
			}
		}
		return $result;
	}

	public function units_of_measurement($act, $input = array())
	{
		$result = array();
		
		if($act == 'loadtable' || $act == 'getspecific')
		{
			$cond = "";
			if($act == "getspecific")
			{
				$id = $this->security->xss_clean($input['id']);
				$cond = " and id = $id";
			}

			$q = $this->db->query("SELECT id, FORMAT(id,'0000') id_, description, code FROM units WHERE STATUS = 1 $cond");
			
			foreach($q->result() as $r) 
			{
				$ac = $this->validation_model->access(1, 'UM');
				$val = explode('/', $ac[0]);
				$r_ = $val[1];
				$w_ = $val[2];
				$name = '"'.$r->description.'"';
				($w_ == 1)?$btn = "<center><button class='btn-danger btn-xs '  data-tooltip='Delete' onclick='del_(".$r->id.",".$name.")'> 
		                         <i class='fa fa-trash-o'></i>
		                         <span></span></button>
		                         <button class='btn-success btn-xs '  data-tooltip='Edit' id='back-to-top' onclick='edit_(".$r->id.")'>
			                     <i class='fa fa-pencil'></i>
			                     <span></span></button>
			                     </center>":$btn = "";

				$result[] = array(
					$r->id_,
					$r->description,
					$r->code,
					$btn,
					$r->id);
			}
		}
		
		return $result;
	}

	public function department_office($act, $input = array())
	{
		$result = array();
		
		if($act == 'loadtable' || $act == 'getspecific')
		{
			$cond = "";
			if($act == "getspecific")
			{
				$id = $this->security->xss_clean($input['id']);
				$cond = " and id = $id";
			}

			$q = $this->db->query("SELECT id, FORMAT(id,'0000') id_, name, oic_name, code, acronym, 
										(case when parent_id is not null then (select code from office o2 where o2.id = o.parent_id) else '' end) division
										FROM office o WHERE STATUS = 1 $cond");
			
			foreach($q->result() as $r) 
			{
				$ac = $this->validation_model->access(1, 'DO');
				$val = explode('/', $ac[0]);
				$r_ = $val[1];
				$w_ = $val[2];
				$name = '"'.$r->name.'"';
				($w_ == 1)?$btn = "<center><button class='btn-danger btn-xs '  data-tooltip='Delete' onclick='del_(".$r->id.",".$name.")'> 
		                         <i class='fa fa-trash-o'></i>
		                         <span></span></button>
		                         <button class='btn-success btn-xs '  data-tooltip='Edit' id='back-to-top' onclick='edit_(".$r->id.")'>
			                     <i class='fa fa-pencil'></i>
			                     <span></span></button>
			                     </center>":$btn = "";

				$result[] = array(
					$r->code,
					$r->division,
					$r->acronym,
					$r->name,
					$btn,
					$r->id,
					($r->code != "")?$r->code.' - '.$r->name:$r->name);
			}
		}
		if($act == 'loadtable2')
		{
			$cond = "";

			$q = $this->db->query("SELECT id, FORMAT(id,'0000') id_, name, oic_name, code, acronym, 
										(case when parent_id is not null then (select code from office o2 where o2.id = o.parent_id) else '' end) division
										FROM office o WHERE STATUS = 1 and o.parent_id is not null");
			
			foreach($q->result() as $r) 
			{
				$result[] = array(
					$r->code,
					($r->code != "")?$r->code.' - '.$r->name:$r->name,
					$r->acronym,
					$r->name,
					$r->id);
			}
		}
		
		return $result;
	}

	public function billing_shipping_details($act)
	{
		$result = array();
		
		if($act == 'loaddata')
		{
			$q = $this->db->query("SELECT
									  id,
									  s_address,
									  s_telno,
									  s_mobile,
									  s_company,
									  b_address,
									  b_telno,
									  b_mobile,
									  b_company,
									  status,
									  date_added,
									  added_by,
									  date_updated,
									  updated_by
									FROM billing_shipping WHERE STATUS = 1");
			
			foreach($q->result() as $r) 
			{
				$result[] = array(
					$r->s_company,
					$r->s_address,
					$r->s_telno,
					$r->s_mobile,
					$r->b_company,
					$r->b_address,
					$r->b_telno,
					$r->b_mobile);
			}
		}
		
		return $result;
	}

	public function product_category($act)
	{
		$result = array();
		
		$q = $this->db->query("SELECT
								  FORMAT(id, '0000') id,
								  id id_,
								  coalesce(master_id,0) master_id,
								  parent_id,
								  description,
								  status
								FROM product_category where status = 1  and property = 0 and (parent_id = 0 or parent_id is null)");
		
		foreach($q->result() as $r) 
		{
			$c_btn = "";
			$sub = "";

			$sub = $this->sub_category($r->id_);

			$cat_name = "'".$r->description."'";
			($r->master_id == 0)?$master = $r->id_:$master = $r->master_id;
			$result[] = array(
				$r->id, 
				'<table style="margin:0px"><tr>
						<td>'.$r->description.'</td>
						<td><table style="margin-left:4px; margin-top:0px">
							<tr><td><center><a href="javascript:addSub('.$r->id_.','.$master.')" data-tooltip="Add Sub Category">+</a></center></td></tr>
							<tr><td><center><a href="javascript:delC('.$r->id_.','.$cat_name.')" data-tooltip="Delete Category">-</a></center></td></tr></table></td>
						</tr>
					</table>',
				$sub
				);
			
		}
		
		return $result;
	}

	public function property_category($act)
	{
		$result = array();
		
		$q = $this->db->query("SELECT
								  FORMAT(id,'0000') id,
								  id id_,
								  coalesce(master_id,0) master_id,
								  parent_id,
								  description,
								  status
								FROM product_category where status = 1  and property = 1 and (parent_id = 0 or parent_id is null)");
		
		foreach($q->result() as $r) 
		{
			$c_btn = "";
			$sub = "";

			$sub = $this->sub_category($r->id_);

			$cat_name = "'".$r->description."'";
			($r->master_id == 0)?$master = $r->id_:$master = $r->master_id;
			$result[] = array(
				$r->id, 
				'<table style="margin:0px"><tr>
						<td>'.$r->description.'</td>
						<td><table style="margin-left:4px; margin-top:0px">
							<tr><td><center><a href="javascript:addSub('.$r->id_.','.$master.')" data-tooltip="Add Sub Category">+</a></center></td></tr>
							<tr><td><center><a href="javascript:delC('.$r->id_.','.$cat_name.')" data-tooltip="Delete Category">-</a></center></td></tr></table></td>
						</tr>
					</table>',
				$sub
				);
			
		}
		
		return $result;
	}

	public function sub_category($id, $sub = "")
	{
		
		$q = $this->db->query("SELECT id, description, master_id from product_category where status = 1 and parent_id = ? order by id asc", $id);
		
		if($q->num_rows() > 0)
			foreach($q->result() as $r)
			{
				$cat_name = "'".$r->description."'";
				$sub .= '<table>
						<tr><td>
						<table style="margin:0px; border-bottom:1px solid;border-left:1px solid;"><tr>
						<td style="width:100px; padding-left:5px">'.$r->description.'</td>
						<td><table style="margin-left:4px; margin-top:0px">
							<tr><td><center><a href="javascript:addSub('.$r->id.','.$r->master_id.')" data-tooltip="Add Sub-category">+</a></center></td></tr>
							<tr><td><center><a href="javascript:delC('.$r->id.','.$cat_name.')" data-tooltip="Delete Sub-category">-</a></center></td></tr></table></td>
						</tr>
						</table>
						</td>';
				$q2 = $this->db->query("SELECT id, description from product_category where status = 1 and parent_id = ? order by id asc", $r->id);
				if($q2->num_rows() > 0)
				{
					$sub.=$this->sub_category2($r->id);
				}
				$sub.="</tr></table>";
				// ($sub!="")?$sub.="<br>":null;
				
			}

		return $sub;
	}

	public function sub_category2($id, $sub = "")
	{
		
		$q = $this->db->query("SELECT id, description, master_id, 
				(SELECT COUNT(*) FROM product_category WHERE master_id = (SELECT master_id FROM product_category WHERE id = ? and status = 1 and parent_id != master_id) AND id <= ? and parent_id = (select parent_id from product_category where id = ?) and status = 1) + 1 hops from product_category where status = 1 and parent_id = ? order by id asc", array($id, $id, $id, $id));
		$ctr = 0;
		if($q->num_rows() > 0)
			foreach($q->result() as $r)
			{
				$hop = 0;
				$in = 0;
				$id = $r->id;
				while($in == 0)
				{
					$qh = $this->db->query("SELECT parent_id from product_category where id = ? and status = 1 and master_id != parent_id", array($id));
					if($qh->num_rows()>0)
					{
						$id = $qh->result()[0]->parent_id;
						$hop++;
					}
					else
						$in = 1;
				}

				$cat_name = "'".$r->description."'";
				$sub .='<td><i class="fa fa-arrow-right" style="padding:5px; color:red"></i></td>'.'<td><table style="margin:0px;border-bottom:1px solid;border-left:1px solid;"><tr>
						<td style="width:100px; padding-left:5px">'.$r->description.'</td>
						<td><table style="margin-left:4px; margin-top:0px">
							<tr><td><center><a href="javascript:addSub('.$r->id.','.$r->master_id.')" data-tooltip="Add Sub-category">+</a></center></td></tr>
							<tr><td><center><a href="javascript:delC('.$r->id.','.$cat_name.')" data-tooltip="Delete Sub-category">-</a></center></td></tr></table></td>
						</tr>
						</table>
						</td>';


				$q2 = $this->db->query("SELECT id, description from product_category where status = 1 and parent_id = ? order by id asc", $r->id);
				if($q2->num_rows() > 0)
				{
					$sub.=$this->sub_category2($r->id);
				}
				$sub.="</tr><tr>";
				if($hop == 0)
					$sub.="<td></td>";
				for($i = 0; $i < $hop; $i++)
					$sub.="<td></td>";
				if($hop > 1)
					$sub.="<td></td>";
				if($hop > 2)
					$sub.="<td></td>";
				if($hop > 3)
					$sub.="<td></td>";
				if($hop > 4)
					$sub.="<td></td>";
				if($hop > 5)
					$sub.="<td></td>";
				// $ctr++;
				
			}

		return $sub;
	}

	public function audit_trail($id, $sub = "")
	{
		$result = array();
		$q = $this->db->query("SELECT FORMAT(id,'0000') id, username, action, CONVERT(VARCHAR,date_added) date_added FROM audit_trail order by date_added desc");
		
		foreach($q->result() as $r)
		{
			$result[] = array(
				$r->id,
				$r->action,
				$r->username,
				$r->date_added);
			
		}

		return $result;
	}

	public function product($act, $input=array(), $get = 0)
	{
		$result = array();
		$ac = $this->validation_model->access(1, 'P');
		$val = explode('/', $ac[0]);
		$r_ = $val[1];
		$w_ = $val[2];



		if($act == 'getspecific')
		{
			$id = $this->security->xss_clean($input['id']);
			$cond = " and p.id = $id";
		}else if($act=='get_product'){
			for($i=0;$i<count($input);$i++){
				$id_ =$input[$i];
			}
			$cond= "and p.id =$id_";
		}
		else
			$cond ="";

		($get == 0)?$prop = " and p.property = 0 ":$prop = "";
		
		if($act == 'loadtable' || $act == 'getspecific')
		{
			$q = $this->db->query("SELECT CONCAT(DATEPART(yyyy,p.date_added),'-',p.types,'-',pc.master_id,'-',p.category_id) stock_number, CONCAT(DATEPART(yyyy,p.date_added),'-',FORMAT(DATEPART(mm,p.date_added),'00'),'-',FORMAT(p.id,'0000')) as p_id,p.property, FORMAT(p.id,'0000') id, p.unit_price, p.id id_ ,p.description product, pc.description category, m.code measurement, critical_level, m.id mid, pc.id category_id ,p.types types
										FROM product p 
										INNER JOIN product_category pc 
										ON pc.id = p.category_id
										INNER JOIN units m
										ON m.id = p.measurement
										WHERE p.status = 1  and pc.status =1 and p.property =0 $prop $cond");
			
			foreach($q->result() as $r) 
			{  
				$name = '"'.$r->product.'"';
				($w_ == 1)?$btn = "<center><button class='btn-danger btn-xs '  data-tooltip='Delete' onclick='del_(".$r->id_.",".$name.")'> 
		                         <i class='fa fa-trash-o'></i>
		                         <span></span></button>
		                         <button class='btn-success btn-xs '  data-tooltip='Edit' id='back-to-top' onclick='edit_(".$r->id_.")'>
			                     <i class='fa fa-pencil'></i>
			                     <span></span></button>
			                     </center>":$btn = "";
			      $categories = $this->category($r->category_id,0)[0]['desc'];
			
			   
				$result[] = array(
					//$r->id,
					$r->stock_number,
					//$r->p_id,
					$r->product,
					//$this->category($r->category_id,0),
				//$r->category,
					$categories,
					$r->measurement,
					$r->critical_level,
					'P '.number_format($r->unit_price,2),
					$btn,
					$r->id_,
					$r->category_id,
					$r->mid,
					$r->unit_price,
					$r->types);

			}
		}
		
		return $result;
	}
/*	public function product($act, $input=array(), $get = 0)
	{
		$result = array();
		$ac = $this->validation_model->access(1, 'P');
		$val = explode('/', $ac[0]);
		$r_ = $val[1];
		$w_ = $val[2];



		if($act == 'getspecific')
		{
			$id = $this->security->xss_clean($input['id']);
			$cond = " and p.id = $id";
		}
		else
			$cond ="";

		($get == 0)?$prop = " and p.property = 0 ":$prop = "";
		
		if($act == 'loadtable' || $act == 'getspecific')
		{
			$q = $this->db->query("SELECT p.property, FORMAT(p.id,'0000') id, p.unit_price, p.id id_ ,p.description product, pc.description category, m.code measurement, critical_level, m.id mid, pc.id category_id 
										FROM product p 
										INNER JOIN product_category pc 
										ON pc.id = p.category_id
										INNER JOIN units m
										ON m.id = p.measurement
										WHERE p.status = 1 $prop $cond");
			
			foreach($q->result() as $r) 
			{
				$name = '"'.$r->product.'"';
				($w_ == 1)?$btn = "<center><button class='btn-danger btn-xs '  data-tooltip='Delete' onclick='del_(".$r->id_.",".$name.")'> 
		                         <i class='fa fa-trash-o'></i>
		                         <span></span></button>
		                         <button class='btn-success btn-xs '  data-tooltip='Edit' id='back-to-top' onclick='edit_(".$r->id_.")'>
			                     <i class='fa fa-pencil'></i>
			                     <span></span></button>
			                     </center>":$btn = "";
				$category[0]=($r->property == 1)?$this->category($r->category_id,1):$this->category($r->category_id,0);
				$category_subcategory=$category[0][0]['desc'];

				$result[] = array(
					$r->id,
					$r->product,
					$r->measurement,
					$r->critical_level,	
					$category_subcategory,		
					'P '.number_format($r->unit_price,2),
					$btn,
					$r->id_,
					$r->category_id,
					$r->mid);
			}
		}
		
		return $result;
	}*/

	public function property($act, $input=array())
	{
		$result = array();
		$ac = $this->validation_model->access(1, 'PROP');
		$val = explode('/', $ac[0]);
		$r_ = $val[1];
		$w_ = $val[2];



		if($act == 'getspecific')
		{
			$id = $this->security->xss_clean($input['id']);
			$cond = " and p.id = $id";
		}
		else
			$cond ="";
		
		if($act == 'loadtable' || $act == 'getspecific')
		{
			$q = $this->db->query("SELECT  CONCAT(DATEPART(yyyy,p.date_added),'-',p.types,'-',pc.master_id,'-',p.category_id) property_number,CONCAT(DATEPART(yyyy,p.date_added),'-',FORMAT(DATEPART(mm,p.date_added),'00'),'-',FORMAT(p.id,'0000')) as pro_id, p.property, FORMAT(p.id,'0000') id, p.unit_price, p.id id_ ,p.description product, pc.description category, m.code measurement, critical_level, m.id mid, pc.id category_id ,p.types
										FROM product p 
										INNER JOIN product_category pc 
										ON pc.id = p.category_id
										INNER JOIN units m
										ON m.id = p.measurement
										WHERE p.status = 1 and p.property = 1 $cond");
			
			foreach($q->result() as $r) 
			{
				$name = '"'.$r->product.'"';
				($w_ == 1)?$btn = "<center><button class='btn-danger btn-xs '  data-tooltip='Delete' onclick='del_(".$r->id_.",".$name.")'> 
		                         <i class='fa fa-trash-o'></i>
		                         <span></span></button>
		                         <button class='btn-success btn-xs '  data-tooltip='Edit' id='back-to-top' onclick='edit_(".$r->id_.")'>
			                     <i class='fa fa-pencil'></i>
			                     <span></span></button>
			                     </center>":$btn = "";
			    
				$result[] = array(
					//$r->id,
					$r->property_number,
					$r->product,
					($r->property == 1)?$this->category($r->category_id,1)[0]['desc']:$this->category($r->category_id,0)[0]['desc'],
					$r->measurement,
					'P '.number_format($r->unit_price,2),
					$btn,
					$r->id_,
					$r->category_id,
					$r->mid,
					$r->unit_price,
					$r->types);
			}
		}
		
		return $result;
	}

	public function category($id = 0, $prop = 0, $get = 0)
	{
		
		$cond = "";
		($id != 0)?$cond = " and pc.id = $id":null;

		$qp = $this->db->query("SELECT TOP 1 stuff(( SELECT cast(', ' as varchar(max)) + cast(pc.parent_id as varchar) from product_category pc group by pc.parent_id for xml path('')), 1, 1, '') parent_id FROM (SELECT pc2.parent_id FROM product_category pc2 GROUP BY pc2.parent_id)tbl");
		(isset($qp->result()[0]->parent_id))?$parent_id = $qp->result()[0]->parent_id:$parent_id = 0;
		$parent = '('.$parent_id.')';

		$qm = $this->db->query("SELECT TOP 1 stuff(( SELECT cast(', ' as varchar(max)) + cast(pc2.master_id as varchar) FROM product_category pc2 GROUP BY pc2.master_id
									    for xml path('')), 1, 1, '') master_id FROM 
									(SELECT pc2.parent_id FROM product_category pc2 GROUP BY pc2.parent_id)tbl");
		(isset($qm->result()[0]->master_id))?$master_id = $qm->result()[0]->master_id:$master_id = 0;
		$master = '('.$master_id.')';

		($prop == 0)?$prop = " and property = 0":$prop=" and property = 1";
		($get != 0)?$prop = "":null;
		$desc = "";
		($id == 0)?
		$q = $this->db->query("SELECT id, description, parent_id from product_category pc where status = 1 $prop and id not in $parent and id not in $master $cond order by description asc "):
		$q = $this->db->query("SELECT id, description, parent_id from product_category pc where id not in $parent $prop and id not in $master $cond order by description asc ");;
		$category = array();
		foreach($q->result() as $r)
		{
			$desc = $r->description;
			$in = 0;
			$parent_id = $r->parent_id;
			while($in == 0)
			{
				($id == 0)?
				$q2 = $this->db->query("SELECT parent_id, description from product_category pc where id = ?  $prop and status = 1", $parent_id):
				$q2 = $this->db->query("SELECT parent_id, description from product_category pc where id = ? $prop ", $parent_id);
				if($q2->num_rows() > 0)
				{
					$parent_id = $q2->result()[0]->parent_id;
					$desc = $q2->result()[0]->description.', '.$desc; //eto un
				}
				else
				{
					$in = 1;
					$category[] = array('id' => $r->id, 'desc' => $desc);
				}
			}
		}
		return $category;
	}
public function category_id($id , $prop = 0, $get = 0)
	{
		
		$cond = "";
		($id != 0)?$cond = " and pc.id = $id":null;

		$qp = $this->db->query("SELECT TOP 1 stuff(( SELECT cast(', ' as varchar(max)) + cast(pc.parent_id as varchar) from product_category pc group by pc.parent_id for xml path('')), 1, 1, '') parent_id FROM (SELECT pc2.parent_id FROM product_category pc2 GROUP BY pc2.parent_id)tbl");
		(isset($qp->result()[0]->parent_id))?$parent_id = $qp->result()[0]->parent_id:$parent_id = 0;
		$parent = '('.$parent_id.')';

		$qm = $this->db->query("SELECT TOP 1 stuff(( SELECT cast(', ' as varchar(max)) + cast(pc2.master_id as varchar) FROM product_category pc2 GROUP BY pc2.master_id
									    for xml path('')), 1, 1, '') parent_id FROM 
									(SELECT pc2.parent_id FROM product_category pc2 GROUP BY pc2.parent_id)tbl");
		(isset($qm->result()[0]->master_id))?$master_id = $qm->result()[0]->master_id:$master_id = 0;
		$master = '('.$master_id.')';

		($prop == 0)?$prop = " and property = 0":$prop=" and property = 1";
		($get != 0)?$prop = "":null;
		$desc = "";
		($id == 0)?
		$q = $this->db->query("SELECT id, description, parent_id from product_category pc where status = 1 $prop and id not in $parent and id not in $master $cond order by description asc "):
		$q = $this->db->query("SELECT id, description, parent_id from product_category pc where id not in $parent $prop and id not in $master $cond order by description asc ");;
		$category = array();
		foreach($q->result() as $r)
		{
			$desc = $r->description;
			$in = 0;
			$parent_id = $r->parent_id;
			while($in == 0)
			{
				($id == 0)?
				$q2 = $this->db->query("SELECT parent_id, description from product_category pc where id = ?  $prop and status = 1", $parent_id):
				$q2 = $this->db->query("SELECT parent_id, description from product_category pc where id = ? $prop ", $parent_id);
				if($q2->num_rows() > 0)
				{
					$parent_id = $q2->result()[0]->parent_id;
					$desc = $q2->result()[0]->description.', '.$desc; //eto un
				}
				else
				{
					$in = 1;
					$category[] = array('id' => $r->id, 'desc' => $desc);
				}
			}
		}
		return $category;
	}

	public function supplier_vendor($act, $input = array())
	{
		$ac = $this->validation_model->access(1, 'SV');
		$val = explode('/', $ac[0]);
		$r_ = $val[1];
		$w_ = $val[2];
		$result = array();


		if($act == 'loadtable' || $act == 'getspecific')
		{
			if($act == 'getspecific')
				$id = $this->security->xss_clean($input['id']);
			($act == 'getspecific')?$cond = " and s.id = $id":$cond = "";
			$q = $this->db->query("SELECT distinct FORMAT(s.id,'0000') id, s.id id_, supplier_name, tin_no, service_desc, supplier_type, address, contact_person, tel_no, mobile, stuff(( SELECT cast(', ' as varchar(max)) + p2.description from supplier_product sp2 left join product p2 on p2.id = sp2.product_id where sp2.supplier_id = s.id and sp2.status = 1 for xml path('')), 1, 1, '') product
										FROM supplier s 
										LEFT JOIN supplier_product sp 
										ON sp.supplier_id = s.id AND sp.status = 1
										LEFT JOIN product p 
										ON p.id = sp.product_id 
										WHERE s.status = 1 $cond
										GROUP BY s.id, supplier_name, address, contact_person, tel_no, mobile, p.description, tin_no, service_desc, supplier_type");
			foreach($q->result() as $r)
			{
				$name = '"'.$r->supplier_name.'"';
				($w_ == 1)?$btn = "<center><button class='btn-danger btn-xs '  data-tooltip='Delete' onclick='del_(".$r->id_.",".$name.")'> 
		                         <i class='fa fa-trash-o'></i>
		                         <span></span></button>
		                         <button class='btn-success btn-xs '  data-tooltip='Edit' id='back-to-top' onclick='edit_(".$r->id_.")'>
			                     <i class='fa fa-pencil'></i>
			                     <span></span></button>
			                     </center>":$btn = "";
			    ($r->mobile != "")?$sl = ' / ':$sl = '';
				$result[] = array( 
					$r->supplier_name,  
					$r->address, 
					$r->tel_no.$sl.$r->mobile,
					$r->tin_no,
					$r->supplier_type,
					$r->product,
					$btn,
					$r->tel_no,
					$r->mobile,
					$r->id_,
					$this->supplier_vendor('getspecificproduct',array('id' => $r->id_)));
			}
		}
		else if($act = 'getspecificproduct')
		{
			$id = $this->security->xss_clean($input['id']);
			$q = $this->db->query("SELECT p.id, p.description FROM supplier_product sp 
									INNER JOIN product p 
									ON p.id = sp.product_id
									WHERE sp.status = 1 AND sp.supplier_id = ?", $id);
			foreach($q->result() as $r)
			{
				$result[] = array(
					$r->id, 
					$r->description);
			}
		}
		
		return $result;
	}

	public function approver($act, $input = array())
	{
		$result = array();
		
		if($act == 'loadtable' || $act == 'getspecific')
		{
			$cond = "";
			if($act == "getspecific")
			{
				$id = $this->security->xss_clean($input['id']);
				$cond = " and a.id = $id";
			}

			$q = $this->db->query("SELECT CONCAT(u.lname, ', ', u.fname) approver , trans, heirarchy,
									  a.id,
									  trans,
									  userid
									FROM approver a 
									INNER JOIN users u 
									ON u.id = a.userid
									WHERE a.status = 1 $cond");
			
			foreach($q->result() as $r) 
			{
				$ac = $this->validation_model->access(1, 'A');
				$val = explode('/', $ac[0]);
				$r_ = $val[1];
				$w_ = $val[2];
				$name = '"'.$r->approver.'"';
				($w_ == 1)?$btn = "<center><button class='btn-danger btn-xs '  data-tooltip='Delete Approver' onclick='del_(".$r->id.",".$name.")'> 
		                         <i class='fa fa-trash-o'></i>
		                         <span></span></button>
			                     </center>":$btn = "";

			    if($r->trans == 'PR')
			    	$trans = 'Purchase Request';
			    else if ($r->trans == 'IR')
			    	$trans = 'Item Request';
			    else if ($r->trans == 'JR')
			    	$trans = 'Job Request';
			    else if ($r->trans == 'FER')
			    	$trans = 'Furniture/Equipment Request';
			    else 
			    	$trans = "";

			    if($r->heirarchy == 1)
			    	$suffix = $r->heirarchy.'st Approver';
			    else if ($r->heirarchy == 2)
			    	$suffix = $r->heirarchy.'nd Approver';
			    else if ($r->heirarchy == 3)
			    	$suffix = $r->heirarchy.'rd Approver';
			    else if($r->heirarchy > 3)
			    	$suffix = $r->heirarchy."th Approver";
			    else
			    	$suffix = "";

				$result[] = array(
					$trans,
					$r->approver,
					$suffix,
					$btn);
			}
		}
		if($act == 'getH')
		{

			$q = $this->db->query("SELECT heirarchy FROM approver WHERE STATUS = 1 AND trans = ?", $input['trans']);
			$num = array();
			foreach($q->result() as $r) 
			{
				$num[] = $r->heirarchy;
			}
			$h = array();

			for($i = 1; $i<11; $i++)
				if(!in_array($i, $num))
				{ 
					if($i == 1)
				    	$suffix = $i.'st Approver';
				    else if ($i == 2)
				    	$suffix = $i.'nd Approver';
				    else if ($i == 3)
				    	$suffix = $i.'rd Approver';
				    else if($i > 3)
				    	$suffix = $i."th Approver";
				    else
				    	$suffix = "";
					$h[] = array($i, $suffix);
				}

			return array('mes' => 'Success', 'h' => $h);
		}

		if($act == 'getA')
		{
			$q = $this->db->query("SELECT u.id, CONCAT(lname, ', ', fname, ' - ',  r.description) name FROM users u INNER JOIN role r ON r.id = u.role  WHERE u.status = 1 AND u.id not in ( select userid from approver where trans = ? and status = 1)", $input['trans']);
			foreach($q->result() as $r)
				$h[] = array($r->id, $r->name);
			return array('mes' => 'Success', 'h' => $h);
		}

		return $result;
		
		
	}

	public function inventory($act, $input = array())
	{
		$result = array();
		
		if($act == 'loadtable')
		{
			$cond = "";

			$q = $this->db->query("SELECT CONCAT('INV-', pc.master_id,'-', pc.parent_id,'-' ,pc.id, '-', p.id) st_id,
							FORMAT(i.id,'00000') id,
							 i.id id_,
							  p.description,
							   p.critical_level,
							    FORMAT(i.current_stock,'00') current_stock,
								 u.username added_by, 
								 i.remarks, 
								 CONVERT(VARCHAR,i.date_updated) date_updated,
								 unit.code as unit, p.id p_id,pc.id category_id, p.property property
								 FROM inventory i
								  INNER JOIN product p 
								  ON p.id = i.product
								  INNER JOIN product_category pc 
									ON pc.id = p.category_id
								   INNER join units unit
								    on unit.id=p.measurement
									 INNER join users u 
									 on u.id = i.added_by WHERE i.status = 1 and pc.status = 1");
		//	coalesce(i.updated_by, i.added_by)
			foreach($q->result() as $r) 
			{
				$ac = $this->validation_model->access(1, 'I');
				$val = explode('/', $ac[0]);
				$r_ = $val[1];
				$w_ = $val[2];
				$name = '"'.$r->description.'"';
				
			
				// ($w_ == 1)?$btn = "<center>

    //                              <button class='btn-info btn-xs '  data-tooltip='Create Purchase Request' onclick='pr_(".$r->id.",".$name.")'> 
		  //                        <i class='fa fa-arrow-right'></i>
		  //                        <span></span></button>
    //                                   &nbsp
				//                  <button class='btn-success btn-xs '  data-tooltip='Create Purchase Order' onclick='po_(".$r->id.",".$name.")'> 
		  //                        <i class='fa fa-arrow-right'></i>
		  //                        <span></span></button>

			 //                     </center>":$btn = "";
			   
			     ////////////
			       /* if($r->current_stock > $r->critical_level && $r->current_stock > 0){               
			        $stocks="<center><button style='margin-left:5px' class='btn-info btn-xs '  class='btn-info btn-xs '   data-tooltip='Remaining ".$r->current_stock." item/s'> ".$r->current_stock." <span></span></button></center>";
			        	}
			        else{
			        	$stocks="<center><button style='margin-left:5px' class='btn-danger btn-xs '  class='btn-info btn-xs '   data-tooltip='Remaining ".$r->current_stock." item/s'> ".$r->current_stock." <span></span></button></center>";
			            }

			      if($r->critical_level){
                   $critical_level="<center><button style='margin-left:5px' class='btn-danger btn-xs '  class='btn-info btn-xs '   data-tooltip='Remaining ".$r->current_stock." item/s'> ".$r->critical_level." <span></span></button></center>";
                   }else{
                     $critical_level="<center><button style='margin-left:5px' class='btn-danger btn-xs '  class='btn-info btn-xs '  data-tooltip='Remaining ".$r->current_stock." item/s'>00 <span></span></button></center>";
                    }*/
                    ($r->critical_level==FALSE)?$c_level='00':$c_level =$r->critical_level;

                    ($r->property==0)?
                 	$categories = $this->category($r->category_id,0)[0]['desc']:
                  	$categories = $this->category($r->category_id,1)[0]['desc'];
                  	
                    
				$result[] = array(
					$r->st_id,
					
					($r->property==0)?
                 	$r->description . ' ' . '(' .$categories. ')':
                  	$r->description . ' ' . '(' .$categories. ')',
					// $r->description,
					$r->unit,
					$r->current_stock,
					$c_level,
					// $r->date_updated,
					// $r->added_by,
					// $btn,
					// $r->p_id,
					//$categories
					);
//($r->property == 1)?$this->category($r->category_id,1)[0]['desc']:$this->category($r->category_id,0)[0]['desc']

			}
		}
		return $result;
		
		
	}

	public function item_requests($act, $input = array())
	{
		$result = array();
		
		if($act == 'loadtable' || $act == 'getspecific')
		{
			$cond = "";
			if($act == "getspecific")
			{
				$id = $this->security->xss_clean($input['id']);
				$cond = " and a.id = $id";
			}

			$statement = "";
			if(isset($input['s_office']))
				if($input['s_office'] != "")
					$statement .= " and o.id = ".$this->security->xss_clean($input['s_office']);
			if(isset($input['s_user']))
				if($input['s_user'] != "")
					$statement .= " and ri.requested_by = ".$this->security->xss_clean($this->session->userdata('USERID'));
			if(isset($input['s_item']))
				if($input['s_item'] != "")
					$statement .= " and ril.product = ".$this->security->xss_clean($input['s_item']);
			if(isset($input['s_date']))
				if($input['s_date'] != "")
					$statement .= " and ri.date_requested between '".date('Y-m-d',strtotime($this->security->xss_clean($input['s_date'])))." 00:00:00' and '".date('Y-m-d',strtotime($this->security->xss_clean($input['s_date'])))." 23:59:59'";
			if(isset($input['s_status']))
				if($input['s_status'] != "")
					$statement .= " and ril.request_status = '".$this->security->xss_clean($input['s_status'])."'";

			$q = $this->db->query("SELECT iv.current_stock stocks,
								 concat(substring(convert(varchar,ri.date_requested, 2),1,2),'-',substring(convert(varchar,ri.date_requested, 2),4,2),'-',format(ri.id,'0000')) as r_id ,
								 FORMAT(ri.id,'0000') id, o.name office, concat(us.lname, ', ', us.fname) requested_by,
								   CONVERT(VARCHAR,ri.date_requested,101) date_requested,
								    concat(ril.unit, ' ', u.code, ' ',p.description) product,
								     ril.unit qty,
								      concat(p.description,', ',pc.description) product_desc,
								      ri.fund_cluster,
								      concat(ril.unit,'',u.code,' of ',p.description,', ',pc.description ) product_description,
									u.code units,ril.unit, ril.id id_, ril.remarks, ril.request_status, CONCAT('Reason: ', case when ril.reason is NULL then 'No reason' else ril.reason END) reason,p.property,p.category_id
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
									WHERE ri.added_by = ? and ri.status = 1   $cond $statement", $this->session->userdata('USERID'));
										
			foreach($q->result() as $r) 
			{
				$ac = $this->validation_model->access(1, 'IR');
				$val = explode('/', $ac[0]);
				$r_ = $val[1];
				$w_ = $val[2];
				$name = '"'.$r->product.'"';
				$reason = '"'.str_replace("'", "", $r->reason).'"';
				if($w_ == 1 && $r->request_status == 'Pending')
					{
						/*$btn = "<center><button class='btn-success btn-xs '  data-tooltip='Show Reason' onclick='alert(".'"'.$r->reason.'"'.")'> 
		                         <i class='fa fa-eye'></i>
		                         <span></span></button><button class='btn-danger btn-xs '  data-tooltip='Cancel Request' onclick='del_(".$r->id_.",".$name.")'> 
		                         <i class='fa fa-trash-o'></i>
		                         <span></span></button>
			                     </center>"; */
			           $status ="<center><button style='padding:10px;width:120px;'  class='btn-default btn-md' onclick='del_(".$r->id_.",".$name.")' type='button'data-tooltip='Cancel Request'><i class='fa fa-ellipsis-h'></i> Pending</button></center>";
			 
			           /* $btn = "<center><button class='btn-success btn-xs '  data-tooltip='Show Reason' onclick='alert(".$reason.")'> 
		                         <i class='fa fa-eye'></i>
		                         <span></span></button>
			                     </center>";*/
                    }
			    else if($w_ == 1 && $r->request_status == 'Approved')
                      {
			           $status ="<center><button style='padding:10px;width:120px;'  class='btn-info btn-md' type='button'data-tooltip='Approved Request' onclick='view_ris(".$r->id_.",".$name.")'><i class='fa fa-thumbs-up'></i>  Approved</button></center>";
			 
                      }
                 else {
                 	   $status ="<center><button style='padding:10px;width:120px;'  class='btn-danger btn-md' type='button'data-tooltip='Disapproved Request'><i class='fa fa-thumbs-down'></i>  Disapproved</button></center>";
			 
                   
                 }

			      if($r->stocks < 1){               
			        $stocks="<center><button style='margin-left:5px' class='btn-danger btn-xs '  class='btn-info btn-xs '   data-tooltip='Available ".$r->stocks." item/s'> ".$r->stocks." <span></span></button></center>";
			        	}
			        else{
			        	$stocks="<center><button style='margin-left:5px' class='btn-info btn-xs '  class='btn-info btn-xs '   data-tooltip='Available ".$r->stocks." item/s'> ".$r->stocks." <span></span></button></center>";
			            }
			            $categories = $this->category($r->category_id);
			           
				$result[] = array(
					
					$r->r_id,
					//$r->product,
				//	$r->units,
					//$r->product_desc,
				//	$r->qty,
					$r->product_description,

				//	($r->property == 1)?$this->category($r->category_id,1)[0]['desc']:$this->category($r->category_id,0)[0]['desc'],
					$r->office,
					$r->fund_cluster,
					$r->requested_by,
					$r->date_requested,
					$stocks,
					$status,
					$r->request_status,
				//	$r->remarks,
					//$btn
					);
			}
		}

		return $result;
		
		
	}
/////////////
  public function purchase_request_to_po($input =array()){
  	$result = array();

  	if($input['action']=="getspecific"){
				  		$id = $this->security->xss_clean($input['id']);

				  		$q = $this->db->query("SELECT CONCAT('PR-',DATEPART(yyyy, pr.date_added),'-',FORMAT(DATEPART(mm, pr.date_added),'00'),'-',FORMAT(pr.id,'0000')) as pr_id, concat(substring(convert(varchar, pr.date_added, 2),1,2),'-',substring(convert(varchar, pr.date_added, 2),4,2),'-',format(pr.id,'0000')) pr_no, pr.id pr_id_,
													o.name office, concat(us.lname, ', ', us.fname) requested_by, CONVERT(VARCHAR,pr.date_added,101) date_requested, 
													prl.item_desc, prl.qty, concat('P ',format(prl.unit_cost,'#,###.00')) unit_costs,
													prl.unit, prl.id,  prl.purpose, prl.request_status,concat('P ',format(prl.total_cost,'#,###.00')) total_costs,
													concat(prl.qty,' ',prl.unit,' of ',prl.item_desc) requested_item ,prl.unit_cost unit_cost,prl.total_cost total_cost,prl.unit,prl.product
													,p.category_id,p.description


													FROM purchase_request pr 
													inner join purchase_request_line prl 
													on prl.pr_id = pr.id
												    inner join product p
													on p.id=prl.product
													INNER JOIN office o 
													ON o.id = pr.office_id
													left join users us
													on us.id = pr.requested_by
													WHERE prl.id=$id and request_status='Approved' ");
				foreach($q->result() as $r) 
			{  

			      $categories = $this->category($r->category_id,0)[0]['desc'];

			 $result[] = array(
									$r->pr_no,
									$r->office,
						//	$r->item_desc,					
						//	$r->qty,
						//	$r->unit,
						   $r->requested_item,
							$r->unit_costs,
							$r->total_costs,
							$r->requested_by,
							$r->date_requested,
							//$r->purpose,
							//$p,					
						//	$status,
							$r->request_status,
							$r->qty,
							$r->item_desc,
							$r->unit_cost,
							$r->total_cost,
							$r->unit,
							$r->pr_id_,
							$r->product,
							$categories,
							$r->description
							//$btn
							);


			// print_r($result);die();
	        }
}
   	return $result;
		
  }


/////////////

	public function purchase_request($act, $input = array())
	{
		$result = array();
		
		if($act == 'loadtable' || $act == 'getspecific')
		{
			$cond = "";
			if($act == "getspecific")
			{
				$id = $this->security->xss_clean($input['id']);
				$cond = " and a.id = $id";
			}

			$statement = "";
			if(isset($input['s_office']))
				if($input['s_office'] != "")
					$statement .= " and pr.office_id = ".$this->security->xss_clean($input['s_office']);
			if(isset($input['s_user']))
				if($input['s_user'] != "")
					$statement .= " and pr.requested_by = ".$this->security->xss_clean($this->session->userdata('USERID'));
			
			if(isset($input['s_date']))
				if($input['s_date'] != "")
					$statement .= " and pr.date_added between '".date('Y-m-d',strtotime($this->security->xss_clean($input['s_date'])))." 00:00:00' and '".date('Y-m-d',strtotime($this->security->xss_clean($input['s_date'])))." 23:59:59'";
			if(isset($input['s_status']))
				if($input['s_status'] != "")
					$statement .= " and prl.request_status = '".$this->security->xss_clean($input['s_status'])."'";



			$q = $this->db->query("SELECT CONCAT('PR-',DATEPART(yyyy, pr.date_added),'-',FORMAT(DATEPART(mm, pr.date_added),'00'),'-',FORMAT(pr.id,'0000')) as pr_id,
 concat(substring(convert(varchar, pr.date_added, 2),1,2),'-',substring(convert(varchar, pr.date_added, 2),4,2),'-',format(pr.id,'0000')) pr_no, 
									o.name office,
									 concat(us.lname, ', ', us.fname) requested_by,
									  CONVERT(VARCHAR,pr.date_added,101) date_requested, 
									prl.item_desc, prl.qty, 
									concat('P ',format(prl.unit_cost,'#,###.00')) unit_costs,
									prl.unit, prl.id,  prl.purpose, prl.remarks, prl.request_status,
									concat('P ',format(prl.total_cost,'#,###.00')) total_costs,
									concat(prl.qty,' ',prl.unit,' of ',prs.description) requested_item ,
									prl.unit_cost unit_cost,
									prl.total_cost total_cost
									
									FROM purchase_request pr 
									inner join purchase_request_line prl 
									on prl.pr_id = pr.id
									INNER JOIN office o 
									ON o.id = pr.office_id

									inner join product as prs
									on prs.id=prl.product
									
									left join users us
									on us.id = pr.requested_by
									WHERE pr.added_by = ? $cond $statement", $this->session->userdata('USERID'));
			

			foreach($q->result() as $r) 
			{
				$ac = $this->validation_model->access(1, 'PR');
				$val = explode('/', $ac[0]);
				$r_ = $val[1];
				$w_ = $val[2];
            //    print_r($val);die();
				$name = '"'.str_replace("'", "`", $r->item_desc).'"';

	/*		($w_ == 1 && $r->request_status == 'Pending')?$btn = "<center><button class='btn-danger btn-xs '  data-tooltip='Cancel Request' onclick='del_(".$r->id.",".$name.")'> 
		                         <i class='fa fa-trash-o'></i>
		                         <span></span></button>
			                     </center>":$btn = "<center>
			                     </center>";
*/
			              
			     if($w_==1 && $r->request_status=='Pending'){
			     	$btn = "<center><label class='btn-danger btn-xs> 
		                         <i class='fa fa-trash-o'></i> Cancel
		                         <span></span></label>
			                     </center> ";
			         $status ="<center><label style='padding:10px;width:120px;'  class='btn-default btn-md'><i class='fa fa-ellipsis-h'></i> Pending</label></center>";

			     	// $btn = "<center><label class='btn-danger btn-xs 'onclick='del_(".$r->id.",".$name.")'> 
		       //                   <i class='fa fa-trash-o'></i> Cancel
		       //                   <span></span></label>
			      //                </center> ";
			        // $status ="<center><label style='padding:10px;width:120px;'  class='btn-default btn-md' onclick='del_(".$r->id.",".$name.")'><i class='fa fa-ellipsis-h'></i> Pending</label></center>";
			 
			     }else if($w_ == 1 && $r->request_status=='Approved'){
			     		
					     
					     	$btn="<center><label  class='btn-info btn-xs' onclick='po_form_(".$r->id.",".$name.")' type='button'><i class='fa fa-thumbs-up'></i> Approved</label></center>";
					     		$status ="<center><label style='padding:10px;width:120px;' class='btn-info btn-md' onclick='po_form_(".$r->id.")'><i class='fa fa-thumbs-up'></i> Approved</label></center>";
					     	
			     
			     }else if($w_ == 1 && $r->request_status == 'Disapproved'){
			     $btn="<p align='center'><i>--disapproved--</i></p>";
			     	$status ="<center><label style='padding:10px;width:120px;'  class='btn-danger btn-md disable><i class='fa fa-thumbs-down'></i> Disapproved</label></center>";
			 
			     }
			     else{
	 	         $status ="<center><label   style='padding:10px;width:120px;background-color:#ff8000;'class='btn-warning btn-md'><i class='fa fa-times'></i> Cancelled</label></center>";
			     $btn ="<p align='center'><i class='fa fa-close-circle'></i>--cancelled--</p>";
                 } 


                  if($r->purpose==Null){
                  	$p = "<p align='center'><i>-- none --</i></p>";
                  }else{$p=$r->purpose;}
				$result[] = array(
					$r->pr_no,
					$r->office,
				//	$r->item_desc,					
				//	$r->qty,
				//	$r->unit,
				   $r->requested_item,
				   /* 'hi',*/
					$r->unit_costs,
					$r->total_costs,
					$r->requested_by,
					$r->date_requested,
					//$r->purpose,
					$p,
					$r->remarks,			
					$status,
					$r->request_status,
					$r->qty,
					$r->item_desc,
					$r->unit_cost,
					$r->total_cost
					//$btn
					);

				//print_r($result);die();
			}
		}

		return $result;
		
		
	}

//
	public function check_if_pr_is_on_po($id){
			$result = array();

				  		$id = $this->security->xss_clean($input['id']);

				  		$q = $this->db->query("");
				foreach($q->result() as $r) 
			{  

			 $result[] = array(
									$r->pr_no,
									$r->office,
						//	$r->item_desc,					
						//	$r->qty,
						//	$r->unit,
						   $r->requested_item,
							$r->unit_costs,
							$r->total_costs,
							$r->requested_by,
							$r->date_requested,
							//$r->purpose,
							//$p,					
						//	$status,
							$r->request_status,
							$r->qty,
							$r->item_desc,
							$r->unit_cost,
							$r->total_cost,
							$r->unit,
							$r->pr_id_,
							$r->product,
							$categories,
							$r->description
							//$btn
							);


			// print_r($result);die();
	        }

   	return $result;
	}


	public function approve_item_requests($act, $input = array())
	{
		$result = array();
		
		if($act == 'loadtable' || $act == 'getspecific')
		{
			$cond = "";
			if($act == "getspecific")
			{
				$id = $this->security->xss_clean($input['id']);
				$cond = " and a.id = $id";
			}

			$q = $this->db->query("SELECT FORMAT(ri.id, '0000') id, concat(substring(convert(varchar,ri.date_requested, 2),1,2),'-',substring(convert(varchar,ri.date_requested, 2),4,2),'-',format(ri.id,'0000')) as r_id , o.name office, concat(us.lname, ', ', us.fname) requested_by, CONVERT(VARCHAR,ri.date_requested,101) date_requested, concat(ril.unit, ' ', u.code, ' ',p.description) product, p.description,u.code,ri.fund_cluster,
									CONCAT(u.description,'(',u.code,')') units,ril.unit,ril.unit qty, ril.id id_, ril.remarks, ril.request_status, coalesce(i.current_stock, 0) current_stock, case when p.critical_level > coalesce(i.current_stock, 0) then 'danger' else 'primary' end critical_level
									FROM request_item ri 
									INNER JOIN office o 
									ON o.id = ri.office_id
									inner join request_item_line ril 
									on ril.request_item_id = ri.id
									LEFT JOIN product p 
									ON p.id = ril.product
									LEFT JOIN units u 
									ON u.id = p.measurement
									left join users us
									on us.id = ri.requested_by
									left join inventory i 
									on i.product = ril.product
									WHERE ri.status = 1 and request_status != 'Cancelled' and request_status = 'Pending' $cond
									order by ril.status desc");
												
			foreach($q->result() as $r) 
			{
				$btn = "";
				$a = $this->db->query("SELECT TOP 1 concat(u.lname, ', ', u.fname) name, u.id, coalesce((SELECT approval_status FROM request_line_approval WHERE STATUS = 1 AND request_item_line_id = ? and approver = u.id),2) status FROM approver a 
										INNER JOIN users u 
										ON u.id = a.userid
										WHERE trans = 'IR' AND a.status = 1 AND u.id 
										NOT IN (SELECT approver FROM request_line_approval WHERE STATUS = 1 AND approval_status = 1 AND request_item_line_id = ?)", array($r->id_, $r->id_));

				$ac = $this->validation_model->access(1, 'AIR');
				$val = explode('/', $ac[0]);
				$r_ = $val[1];
				$w_ = $val[2];
				$name = '"'.$r->product.'"';
				if(isset($a->result()[0]->id))
				($w_ == 1 && $this->session->userdata('USERID') == $a->result()[0]->id && $a->result()[0]->status != 0 && ($r->request_status == "" || $r->request_status == 'Pending'))?$btn = "<table style='margin:0px'><tr><td><center><button class='btn-success btn-xs '  data-tooltip='Approve Request' onclick='approve_(".$r->id_.",".$name.")'> 
		                         <i class='fa fa-check'></i>
		                         <span></span></button></td><td style='padding-left:2px'>
		                         <button class='btn-danger btn-xs '  data-tooltip='Disapprove Request' onclick='disapprove_(".$r->id_.",".$name.")'> 
		                         <i class='fa fa-times''></i>
		                         <span></span></button>
			                     </center></td></tr></table>":$btn = "";
			    $status = "";
			    if($a->num_rows() > 0)
			    	if($a->result()[0]->status == 2 || $a->result()[0]->status == 1)
			    		$status = "Pending approval of ".$a->result()[0]->name;
			    	else if($a->result()[0]->status == 0)
			    		$status = $a->result()[0]->name." disapproved this request.";

			    $cs = "<center><button style='margin-left:5px' class='btn-".$r->critical_level." btn-xs '  data-tooltip='Remaining ".$r->current_stock." item/s'> 
		                         ".$r->current_stock."
		                         <span></span></button>
			                     </center>";

			    $wf = "<center><button class='btn-common btn-xs' data-tooltip='View Workflow' onclick='wf_(".$r->id_.",".$name.")'> 
		                         <i class='fa fa-arrow-right'></i>
		                         <span></span></button>
			                     </center>";
			    ($btn == "")?$cs = "":null;
			    if(isset($a->result()[0]->id))
			    	if($a->result()[0]->id == $this->session->userdata('USERID'))
						$result[] = array(
							$r->r_id,
							$r->code,
							$r->description,
							$r->qty,
							$r->office,
							$r->fund_cluster,
							$r->requested_by,
							$r->date_requested,
							$r->remarks,
							$status,
							$cs,
							'<table style="margin:0px"><tr><td>'.$wf.'</td><td>'.$btn.'</td></tr></table>');
			}
		}
		if($act == 'wf')
		{
			$data = array();
			$id = $this->security->xss_clean($input['id']);

			$a = $this->db->query("SELECT concat(u.lname, ', ', u.fname) name, u.id,
									coalesce((SELECT TOP 1 approval_status FROM request_line_approval WHERE STATUS = 1 AND approver = u.id AND request_item_line_id = ? order by id desc),2) approval_status
									FROM approver a 
									INNER JOIN users u 
									ON u.id = a.userid
									WHERE trans = 'IR' AND a.status = 1
									order by heirarchy", $id);
			foreach($a->result() as $r)
			$data[] = array(
				$r->id,
				$r->name,
				$r->approval_status);

			$result = array('mes' => 'Success', 'data' => $data);
			
		}

		return $result;
		
		
	}

	public function item_requests_monitoring($act, $input = array())
	{
		$result = array();
		
		if($act == 'loadtable' || $act == 'getspecific')
		{
			$cond = "";
			if($act == "getspecific")
			{
				$id = $this->security->xss_clean($input['id']);
				$cond = " and a.id = $id";
			}

			$statement = "";
			if(isset($input['s_office']))
				if($input['s_office'] != "")
					$statement .= " and o.id = ".$this->security->xss_clean($input['s_office']);
			if(isset($input['s_user']))
				if($input['s_user'] != "")
					$statement .= " and ri.requested_by = ".$this->security->xss_clean($input['s_user']);
			if(isset($input['s_item']))
				if($input['s_item'] != "")
					$statement .= " and ril.product = ".$this->security->xss_clean($input['s_item']);
			if(isset($input['s_date']))
				if($input['s_date'] != "")
					$statement .= " and ri.date_requested between '".date('Y-m-d',strtotime($this->security->xss_clean($input['s_date'])))." 00:00:00' and '".date('Y-m-d',strtotime($this->security->xss_clean($input['s_date'])))." 23:59:59'";
			if(isset($input['s_status']))
				if($input['s_status'] != "")
					$statement .= " and ril.request_status = '".$this->security->xss_clean($input['s_status'])."'";

			$q = $this->db->query("SELECT FORMAT(ri.id,'0000') id, concat(substring(convert(varchar,ri.date_requested, 2),1,2),'-',substring(convert(varchar,ri.date_requested, 2),4,2),'-',format(ri.id,'0000')) as r_id, o.name office, concat(us.lname, ', ', us.fname) requested_by, CONVERT(VARCHAR,ri.date_requested,101) date_requested, concat(ril.unit, ' ', u.code, ' of ',p.description,', ',pc.description) product, 
									CONCAT(u.description,'(',u.code,')') units,ril.unit, ril.id id_, ril.remarks, ril.request_status, coalesce(i.current_stock, 0) current_stock, case when p.critical_level > coalesce(i.current_stock, 0) then 'danger' else 'primary' end critical_level
									FROM request_item ri 
									INNER JOIN office o 
									ON o.id = ri.office_id
									inner join request_item_line ril 
									on ril.request_item_id = ri.id
									LEFT JOIN product p 
									ON p.id = ril.product
									left join product_category pc
									on pc.id=p.category_id
									LEFT JOIN units u 
									ON u.id = p.measurement
									left join users us
									on us.id = ri.requested_by
									left join inventory i 
									on i.product = ril.product
									WHERE ri.status = 1 and request_status != 'Cancelled' $cond $statement
									order by ril.status desc");
												
			foreach($q->result() as $r) 
			{
				$btn = "";
				$a = $this->db->query("SELECT TOP 1 concat(u.lname, ', ', u.fname) name, u.id, coalesce((SELECT approval_status FROM request_line_approval WHERE STATUS = 1 AND request_item_line_id = ? and approver = u.id),2) status FROM approver a 
										INNER JOIN users u 
										ON u.id = a.userid
										WHERE trans = 'IR' AND a.status = 1 AND u.id 
										NOT IN (SELECT approver FROM request_line_approval WHERE STATUS = 1 AND approval_status = 1 AND request_item_line_id = ?)", array($r->id_, $r->id_));

				$ac = $this->validation_model->access(1, 'AIR');
				$val = explode('/', $ac[0]);
				$r_ = $val[1];
				$w_ = $val[2];
				$name = '"'.$r->product.'"';
				if(isset($a->result()[0]->id))
				($w_ == 1 && $this->session->userdata('USERID') == $a->result()[0]->id && $a->result()[0]->status != 0 && ($r->request_status == "" || $r->request_status == 'Pending'))?$btn = "<table style='margin:0px'><tr><td><center><button class='btn-success btn-xs '  data-tooltip='Approve Request' onclick='approve_(".$r->id_.",".$name.")'> 
		                         <i class='fa fa-check'></i>
		                         <span></span></button></td><td style='padding-left:2px'>
		                         <button class='btn-danger btn-xs '  data-tooltip='Disapprove Request' onclick='disapprove_(".$r->id_.",".$name.")'> 
		                         <i class='fa fa-times''></i>
		                         <span></span></button>
			                     </center></td></tr></table>":$btn = "";
			    $status = "";
			    if($a->num_rows() > 0)
			    	if($a->result()[0]->status == 2 || $a->result()[0]->status == 1)
			    		$status = "Pending approval of ".$a->result()[0]->name;
			    	else if($a->result()[0]->status == 0)
			    		$status = $a->result()[0]->name." disapproved this request.";

			    $cs = "<center><button style='margin-left:5px' class='btn-".$r->critical_level." btn-xs '  data-tooltip='Remaining ".$r->current_stock." item/s'> 
		                         ".$r->current_stock."
		                         <span></span></button>
			                     </center>";

			    $wf = "<center><button class='btn-common btn-xs' data-tooltip='View Workflow' onclick='wf_(".$r->id_.",".$name.")'> 
		                         <i class='fa fa-arrow-right'></i>
		                         <span></span></button>
			                     </center>";
			    ($btn == "")?$cs = "":null;
				$result[] = array(
					$r->r_id,
					$r->product,
					$r->office,
					$r->requested_by,
					$r->date_requested,
					$r->remarks,
					$status,
				//	$cs,
					'<table style="margin:0px"><tr><td>'.$wf.'</td><td>'.$btn.'</td></tr></table>');
			}
		}
		if($act == 'wf')
		{
			$data = array();
			$id = $this->security->xss_clean($input['id']);

			$a = $this->db->query("SELECT concat(u.lname, ', ', u.fname) name, u.id,
									coalesce((SELECT TOP 1 approval_status FROM request_line_approval WHERE STATUS = 1 AND approver = u.id AND request_item_line_id = ? order by id desc),2) approval_status,
									(select remarks from request_item_line where id = ?) remarks
									FROM approver a 
									INNER JOIN users u 
									ON u.id = a.userid
									WHERE trans = 'IR' AND a.status = 1
									order by heirarchy", array($id, $id));
			foreach($a->result() as $r)
			$data[] = array(
				$r->id,
				$r->name,
				$r->approval_status,
				$r->remarks);

			$result = array('mes' => 'Success', 'data' => $data);
			
		}

		return $result;
		
		
	}

	public function purchase_order($act, $input = array())
	{
		$result = array();
		
		if($act == 'loadtable')
		{
			$statement = "";
			if(isset($input['s_supplier']))
				if($input['s_supplier'] != "")
					$statement .= " and po.supplier_id = ".$this->security->xss_clean($input['s_supplier']);
			if(isset($input['s_user']))
				if($input['s_user'] != "")
					$statement .= " and po.added_by_id = ".$this->security->xss_clean($input['s_user']);
			if(isset($input['s_item']))
				if($input['s_item'] != "")
					$statement .= " and po.id in (SELECT pol.po_id from purchase_order_line pol where pol.product = ".$this->security->xss_clean($input['s_item']).")";
			if(isset($input['s_date']))
				if($input['s_date'] != "")
					$statement .= " and po.expected_delivery_date between '".date('Y-m-d',strtotime($this->security->xss_clean($input['s_date'])))." 00:00:00' and '".date('Y-m-d',strtotime($this->security->xss_clean($input['s_date'])))." 23:59:59'";
			if(isset($input['s_status']))
				if($input['s_status'] != "")
					$statement .= " and po.po_status = '".$this->security->xss_clean($input['s_status'])."'";
			if(isset($input['s_po']))
				if($input['s_po'] != "")
					$statement .= " and CONCAT('PO-',FORMAT(po.id,'000000')) LIKE '%".$this->security->xss_clean($input['s_po'])."%'";

			$q = $this->db->query("SELECT distinct id_, 
				                  (SELECT supplier_name from supplier where id = tbl.supplier_id) supplier_name, 
				                  expected_delivery_date, 
				                  code,  
								 stuff(( SELECT  CONCAT(p2.description, ' (',pol2.qty,' ', u2.code, ')',' ( P ',pol2.amount,' )') + cast('<br> ' as varchar(max)) from purchase_order_line pol2 left join product p2 on p2.id = pol2.product left join units u2 on u2.id = p2.measurement where pol2.po_id = tbl.id_ and pol2.status = 1 for xml path('')), 1, 0, '') product,
								  total_price, 
								   po_status,
								    (SELECT CONCAT(lname,', ', fname) FROM users u where added_by_id = u.id) added_by, 
								    added_by_id
								    FROM 
										(
										SELECT distinct po.id id_, supplier_id, CONVERT(VARCHAR,po.expected_delivery_date,101) expected_delivery_date , CONCAT('PO-',FORMAT(po.id,'000000')) code, po_status, po.added_by, po.total_price, po.added_by_id
										FROM purchase_order po
										where 1 = 1 $statement
										) tbl
										GROUP BY tbl.id_, expected_delivery_date,  code, total_price,  po_status, added_by, added_by_id, supplier_id");
												
			foreach($q->result() as $r) 
			{
				$ac = $this->validation_model->access(1, 'PO');
				$val = explode('/', $ac[0]);
				$r_ = $val[1];
				$w_ = $val[2];
				$name = '"'.$r->code.'"';
				$status = '"'.$r->po_status.'"';

				($w_ == 1)?$btn = "<center><table style='margin:0px'><tr><td><center><button class='btn-success btn-xs '  data-tooltip='View Purchase Order' onclick='view_(".$r->id_.",".$name.",".$status.")'> 
		                         <i class='fa fa-eye'></i>
		                         <span></span></button></td><td style='padding-left:2px'>
		                         <button class='btn-danger btn-xs '  data-tooltip='Cancel Purchase Order' onclick='cancel_(".$r->id_.",".$name.")'> 
		                         <i class='fa fa-times''></i>
		                         <span></span></button>
			                     </center></td></tr></table></center>":$btn = "";
			    if($r->po_status == 'Cancelled')
			    	$btn = "<div style='vertical-align:middle'><center><table style='margin:0px'><tr><td><center><button class='btn-success btn-xs '  data-tooltip='View Purchase Order' onclick='view_(".$r->id_.",".$name.")'> 
		                         <i class='fa fa-eye'></i>
		                         <span></span></button></td></tr></table></center></div>";
		        if($r->po_status == 'New' || $r->po_status == 'Changed Order')
			    	$btn = "<center><table style='margin:0px'><tr><td><center><button class='btn-success btn-xs '  data-tooltip='View Purchase/Release Order' onclick='view_(".$r->id_.",".$name.",".$status.")'> 
		                         <i class='fa fa-eye'></i>
		                         <span></span></button></td><td style='padding-left:2px'>
		                         <button class='btn-warning btn-xs '  data-tooltip='Change Order' onclick='co_(".$r->id_.",".$name.")'> 
		                         <i class='fa fa-pencil''></i>
		                         <span></span></button>
			                     </center></td><td style='padding-left:2px'>
		                         <button class='btn-danger btn-xs '  data-tooltip='Cancel Purchase Order' onclick='cancel_(".$r->id_.",".$name.")'> 
		                         <i class='fa fa-times''></i>
		                         <span></span></button>
			                     </center></td></tr></table></center>";

			    ($w_ == 1)?null:$btn="";
			    $result[] = array(
					$r->code,
					$r->supplier_name,
					htmlspecialchars_decode($r->product),
					'Php '.number_format($r->total_price,2),
					$r->expected_delivery_date,
					$r->added_by,
					$r->po_status,					
					$btn);
			}
		}
		if($act == 'loaddata')
		{
			$q = $this->db->query("SELECT CONVERT(VARCHAR,po.expected_delivery_date,101) expected_delivery_date , 
									po.id id_, 
									po.expected_delivery_date delivery_date_,
									CONCAT('P.O. #',FORMAT(po.id,'000000')) code,
									s.supplier_name, 
									s.address supplier_address,
									s.contact_person contact_person,
									s.tel_no supplier_telno,
									s.mobile supplier_mobile,
									s.id supplier_id,
									p.description, 
									u.code measurement, 
									po_status, 
									po.added_by, 
									pol.unit_price, 
									pol.qty, 
									pol.discount,
									pol.amount, 
									pol.product product_id,
									po.total_price,
									po.b_address, 
									po.b_company, 
									po.b_telno, 
									po.b_mobile, 
									po.s_address, 
									po.s_company, 
									po.s_telno, 
									po.s_mobile
										FROM purchase_order po
										INNER JOIN purchase_order_line pol
										ON pol.po_id = po.id AND pol.status = 1
										INNER JOIN product p 
										ON p.id = pol.product
										INNER JOIN units u
										ON u.id = p.measurement
										INNER JOIN supplier s 
										ON s.id = po.supplier_id
										WHERE po.id = ?", $input['id']);
												
			foreach($q->result() as $r) 
			{
				$result[] = array(
					'po_no' => $r->code,
					'delivery_date' => $r->expected_delivery_date,
					'delivery_date_' => $r->delivery_date_,
					'supplier_name' => $r->supplier_name,
					'contact_person' => $r->contact_person,
					'supplier_address' => $r->supplier_address,
					'supplier_telno' => $r->supplier_telno,
					'supplier_mobile' => $r->supplier_mobile,
					'product' => $r->description,
					'unit' => $r->measurement,
					'po_status' => $r->po_status,
					'qty' => $r->qty,
					'unit_price' => $r->unit_price,
					'discount' => $r->discount,
					'amount' => $r->amount,
					'total_price' => $r->total_price,
					'b_company' => $r->b_company,
					'b_address' => $r->b_address,
					'b_telno' => $r->b_telno,
					'b_mobile' => $r->b_mobile,
					's_company' => $r->s_company,
					's_address' => $r->s_address,
					's_telno' => $r->s_telno,
					's_mobile' => $r->s_mobile,
					'p_id' => $r->product_id,
					's_id' => $r->supplier_id);
			}
		}

		if($act == 'initProduct')
		{
			$data = array();
			$id = $this->security->xss_clean($input['id']);


			$a = $this->db->query("SELECT p.id, p.description name,p.category_id category_id
									FROM supplier_product sp 
									INNER JOIN product p 
									/*ON p.id = sp.product_id
									*/

									ON p.category_id = sp.product_id
									WHERE supplier_id = ? AND sp.status = 1 ", $id);
			foreach($a -> result() as $r)
			{
				   $categories = $this->category($r->category_id,0)[0]['desc'];
			
				$data[] = array(
					$r->id,
					$categories
					/*$r->name*/
				);
			}
			$result = array('mes' => 'Success', 'data' => $data);
			
		}
//===================================================

		if($act == 'getspecific')
		{

			$this->db->query("SELECT CONCAT('PR-',DATEPART(yyyy, pr.date_added),'-',FORMAT(DATEPART(mm, pr.date_added),'00'),'-',FORMAT(pr.id,'0000')) as pr_id, concat(substring(convert(varchar, pr.date_added, 2),1,2),'-',substring(convert(varchar, pr.date_added, 2),4,2),'-',format(pr.id,'0000')) pr_no, pr.id pr_id_,
													o.name office, concat(us.lname, ', ', us.fname) requested_by, CONVERT(VARCHAR,pr.date_added,101) date_requested, 
													prl.item_desc, prl.qty, concat('P ',format(prl.unit_cost,'#,###.00')) unit_costs,
													prl.unit, prl.id,  prl.purpose, prl.request_status,concat('P ',format(prl.total_cost,'#,###.00')) total_costs,
													concat(prl.qty,' ',prl.unit,' of ',prl.item_desc) requested_item ,prl.unit_cost unit_cost,prl.total_cost total_cost,prl.unit,prl.product
													,p.category_id,p.description


													FROM purchase_request pr 
													inner join purchase_request_line prl 
													on prl.pr_id = pr.id
												    inner join product p
													on p.id=prl.product
													INNER JOIN office o 
													ON o.id = pr.office_id
													left join users us
													on us.id = pr.requested_by
													WHERE prl.id=$id and request_status='Approved' ");
				foreach($q->result() as $r) 
			{  

			      $categories = $this->category($r->category_id,0)[0]['desc'];

			 $result[] = array(
									$r->pr_no,
									$r->office,
						//	$r->item_desc,					
						//	$r->qty,
						//	$r->unit,
						   $r->requested_item,
							$r->unit_costs,
							$r->total_costs,
							$r->requested_by,
							$r->date_requested,
							//$r->purpose,
							//$p,					
						//	$status,
							$r->request_status,
							$r->qty,
							$r->item_desc,
							$r->unit_cost,
							$r->total_cost,
							$r->unit,
							$r->pr_id_,
							$r->product,
							$categories,
							$r->description
							//$btn
							);


			// print_r($result);die();
	        }
		}

		return $result;
		
		
	}

	public function delivery($act, $input = array())
	{
		$result = array();

		$ac = $this->validation_model->access(1, 'D');
		$val = explode('/', $ac[0]);
		$r_ = $val[1];
		$w_ = $val[2];
		
		if($act == 'loadtable')
		{
			$po_no = $this->security->xss_clean($input['po_no']);
			$product = $this->security->xss_clean($input['product']);
			$supplier = $this->security->xss_clean($input['supplier']);
			$po_status = $this->security->xss_clean($input['po_status']);

			$cond = "";

			if(isset($input['category']))
			{
				$category = $this->security->xss_clean($input['category']);
				$cat = "(";
				foreach($category as $r)
					$cat .= $r.",";
				$cat .= "0)";
				if(sizeof($category) > 0)
					$cond .= " and po.id in (select pol3.po_id from purchase_order_line pol3 inner join product p3 on p3.id = pol3.product and p3.category_id in $cat)";
			}
			if($po_status != "")
				$cond .= " and po.po_status = '".$po_status."'";
			if($product != "")
				$cond .= " and po.id in (SELECT pol4.po_id from purchase_order_line pol4 where pol4.product = ".$product.")";
			if($supplier != "")
				$cond .= " and po.supplier_id = ".$supplier;
			if($po_no != "")
				$cond .= " and CONCAT('PO-',FORMAT(po.id,'000000')) LIKE '%".$po_no."%'";

			$q = $this->db->query("SELECT expected_delivery_date, id_, code, supplier_name , 
										stuff(( SELECT CONCAT(p2.description, ' (',pol2.qty,' ', u2.code, ')',' ( P ',pol2.amount,' )') + cast('<br> ' as varchar(max)) from purchase_order_line pol2 left join product p2 on p2.id = pol2.product left join units u2 on u2.id = p2.measurement where pol2.status = 1 and pol2.po_id = tbl.id_ for xml path('')), 1, 0, '') product, total_price,  po_status, (SELECT distinct CONCAT(lname, ', ', fname) FROM users u, delivery d where u.username LIKE CONCAT('%', d.added_by, '%'))added_by FROM 
										(
										SELECT distinct po.id id_, (select supplier_name from supplier where id = po.supplier_id) supplier_name, CONVERT(VARCHAR,po.expected_delivery_date,101) expected_delivery_date, CONCAT('PO-',FORMAT(po.id,'000000')) code,  po_status, po.added_by, po.total_price 
										FROM purchase_order po
										where 1 = 1 $cond
										) tbl
										GROUP BY tbl.id_,expected_delivery_date, id_, code, total_price, po_status, added_by, supplier_name ");
												
			foreach($q->result() as $r) 
			{
				$ac = $this->validation_model->access(1, 'D');
				$val = explode('/', $ac[0]);
				$r_ = $val[1];
				$w_ = $val[2];
				$name = '"'.$r->code.'"';
				$status = '"'.$r->po_status.'"';

			    if($w_ == 1)
			    	if($r->po_status == 'Released' || $r->po_status == 'Partially Received' || $r->po_status == 'Changed Order')
			    	{
				    	$btn = "<div style='vertical-align:middle'><center><table style='margin:0px'><tr><td><center><button class='btn-primary btn-xs '  data-tooltip='Add New Delivery' onclick='delivery_(".$r->id_.",".$name.")'> 
			                         <i class='fa fa-truck'></i>
			                         <span></span></button></td></tr></table></center></div>";
			    	}
			    	else
			    		$btn = "";
			    else
			    	$btn = "";


			    ($w_ == 1)?null:$btn="";
			    $result[] = array(
					$r->code,
					$r->supplier_name,
					htmlspecialchars_decode($r->product),
					'Php '.number_format($r->total_price,2),
					$r->expected_delivery_date,
					$r->added_by,
					$r->po_status,					
					$btn);
			}
		}
		if($act == 'loaddata' || $act == 'loadSpecific')
		{
			$cond = "";$cond2 = "";
			if(isset($input['loadPOL']))
				$cond = " WHERE pol.id = ".$this->security->xss_clean($input['id']);
			else
				$cond = " WHERE po.id = ".$this->security->xss_clean($input['id']);

			if(isset($input['d_id']))
				$cond2 = " and id != ".$this->security->xss_clean($input['d_id']);

			$q = $this->db->query("SELECT po.id poid, pol.id polid, COALESCE((SELECT SUM(qty_received) accepted FROM delivery WHERE STATUS = 1 AND pol_id = pol.id $cond2),0) accepted,
									COALESCE((SELECT SUM(qty_returned) returned FROM delivery WHERE STATUS = 1 AND pol_id = pol.id $cond2),0) returned,
									COALESCE((SELECT SUM(qty_received + qty_returned) delivered FROM delivery WHERE STATUS = 1 AND pol_id = pol.id $cond2),0) delivered,
									CONVERT(VARCHAR,po.expected_delivery_date,101) expected_delivery_date , 
									po.id id_, 
									po.expected_delivery_date delivery_date_,
									CONCAT('P.O. #',FORMAT(po.id,'000000')) code,
									s.supplier_name, 
									s.address supplier_address,
									s.contact_person contact_person,
									s.tel_no supplier_telno,
									s.mobile supplier_mobile,
									s.id supplier_id,
									p.description, 
									u.code measurement, 
									po_status, 
									po.added_by, 
									pol.unit_price, 
									pol.qty, 
									pol.discount,
									pol.amount, 
									pol.product product_id,
									po.total_price,
									po.b_address, 
									po.b_company, 
									po.b_telno, 
									po.b_mobile, 
									po.s_address, 
									po.s_company, 
									po.s_telno, 
									po.s_mobile
										FROM purchase_order po
										INNER JOIN purchase_order_line pol
										ON pol.po_id = po.id AND pol.status = 1
										INNER JOIN product p 
										ON p.id = pol.product
										INNER JOIN units u
										ON u.id = p.measurement
										INNER JOIN supplier s 
										ON s.id = po.supplier_id
										$cond ");
												
			foreach($q->result() as $r) 
			{
				$result[] = array(
					'poid' => $r->poid,
					'polid' => $r->polid,
					'po_no' => $r->code,
					'delivery_date' => $r->expected_delivery_date,
					'delivery_date_' => $r->delivery_date_,
					'supplier_name' => $r->supplier_name,
					'contact_person' => $r->contact_person,
					'supplier_address' => $r->supplier_address,
					'supplier_telno' => $r->supplier_telno,
					'supplier_mobile' => $r->supplier_mobile,
					'product' => $r->description,
					'unit' => $r->measurement,
					'po_status' => $r->po_status,
					'qty' => $r->qty,
					'qty_' => $r->qty.' '.$r->measurement,
					'delivered' => $r->delivered,
					'returned' => $r->returned,
					'accepted' => $r->accepted,
					'unit_price' => $r->unit_price,
					'discount' => $r->discount,
					'amount' => $r->amount,
					'total_price' => $r->total_price,
					'unit_price_' => 'Php '.number_format($r->unit_price,2),
					'discount_' => number_format($r->discount,2),
					'amount_' => 'Php '.number_format($r->amount,2),
					'total_price_' => 'Php '.number_format($r->total_price,2),
					'b_company' => $r->b_company,
					'b_address' => $r->b_address,
					'b_telno' => $r->b_telno,
					'b_mobile' => $r->b_mobile,
					's_company' => $r->s_company,
					's_address' => $r->s_address,
					's_telno' => $r->s_telno,
					's_mobile' => $r->s_mobile,
					'p_id' => $r->product_id,
					's_id' => $r->supplier_id);
			}
		}
		if($act == 'loaddelivery' || $act == 'loadspecific')
		{
			$cond = "";
			if($act == 'loadspecific')
				$cond = " and d.id = ".$this->security->xss_clean($input['id']);
			if(isset($input['pol_id']))
				$cond = " and d.pol_id = ".$this->security->xss_clean($input['pol_id']);
			$q = $this->db->query("SELECT
									  FORMAT(d.id,'00000') id,
									  d.pol_id,
									  qty_received,
									  qty_returned,
									  p.description product,
									  CONVERT(VARCHAR,delivery_date,101) delivery_date,
									  received_by,
									  inspected_by,
									  d.remarks,
									  d.date_added,
									  d.added_by,
									  d.date_updated,
									  d.updated_by,
									  d.status,
									  d.id id_,
									  u.code units,
									  coalesce(d.actual_unit_price,0) actual_unit_price, 
									  coalesce(d.actual_discount,0) actual_discount,
									  coalesce(d.actual_amount,0) actual_amount
									FROM delivery d 
									inner join product p 
									on p.id = d.product
									inner join units u 
									on u.id = p.measurement
									WHERE d.STATUS  = 1 $cond");
												
			foreach($q->result() as $r) 
			{
				$name = '"'.$r->product.'"';
				($w_ == 1)?
		    	$btn = "<div style='vertical-align:middle'><center><table style='margin:0px'><tr><td><center><button type='button' class='btn-primary btn-xs '  data-tooltip='Edit Delivery Details' onclick='edit_(".$r->id_.",".$name.")'> 
	                         <i class='fa fa-pencil'></i>
	                         <span></span></button></td>
	                         <td style='padding-left:5px'><center><button type='button' class='btn-danger btn-xs '  data-tooltip='Delete Delivery' onclick='del_(".$r->id_.",".$name.")'> 
	                         <i class='fa fa-times'></i>
	                         <span></span></button></td></tr></table></center></div>":
	    		$btn = "";

				$result[] = array(
					$r->id,
					$r->product,
					$r->qty_received.' '.$r->units,
					(($r->qty_returned == "")?0:$r->qty_returned).' '.$r->units,
					$r->actual_unit_price,
					$r->actual_discount,
					$r->actual_amount,
					$r->received_by,
					$r->delivery_date,
					$r->remarks,
					$btn,
					$r->id_,
					$r->qty_received,
					$r->qty_returned);
			}
		}
		if($act == 'initProduct')
		{
			$data = array();
			$id = $this->security->xss_clean($input['id']);

			$a = $this->db->query("SELECT p.id, p.description name
									FROM supplier_product sp 
									INNER JOIN product p 
									ON p.id = sp.product_id
									WHERE supplier_id = ? AND sp.status = 1 ", $id);
			foreach($a->result() as $r)
				$data[] = array(
					$r->id,
					$r->name);

			$result = array('mes' => 'Success', 'data' => $data);
			
		}

		return $result;
		
		
	}

	public function notifications($act, $input=array())
	{
		$result = array();
		$ac = $this->validation_model->access(1, 'MN');
		$val = explode('/', $ac[0]);
		$r_ = $val[1];
		$w_ = $val[2];

		
		if($act == 'loadtable')
		{
			$q = $this->db->query("SELECT FORMAT(id,'000000') id,
										  id id_,
										  userid,
										  status,
										  title,
										  content,
										  CONVERT(VARCHAR,date_added,101) date_created,
										  CONVERT(VARCHAR,date_seen,101) date_seen
										   FROM notifications WHERE userid = ? order by date_added desc", $this->session->userdata('USERID'));
			
			foreach($q->result() as $r) 
			{
				$name = '"'.$r->id.'"';
				($w_ == 1 && $r->date_seen == "")?$btn = "<center><button class='btn-success btn-xs '  data-tooltip='Tag as seen' onclick='seen_(".$r->id_.",".$name.")'> 
		                         <i class='fa fa-eye'></i>
		                         <span></span></button>
			                     </center>":$btn = "";
				$result[] = array(
					$r->id,
					$r->title,
					$r->content,
					$r->date_created,
					$r->date_seen,
					$btn);
			}
		}
		
		return $result;
	}

	public function all_notifications($act, $input=array())
	{
		$result = array();
		$ac = $this->validation_model->access(1, 'AN');
		$val = explode('/', $ac[0]);
		$r_ = $val[1];
		$w_ = $val[2];

		
		if($act == 'loadtable')
		{
			$q = $this->db->query("SELECT CONCAT('N-',FORMAT(n.id,'000000')) id,
										  n.id id_,
										  userid,
										  n.status,
										  title,
										  content,
										  CONVERT(VARCHAR,n.date_added,101) date_created,
										  CONVERT(VARCHAR,n.date_seen,101) date_seen,
										  concat(u.lname, ', ', u.fname) users
										   FROM notifications n 
										   inner join users u 
										   on u.id = n.userid
										   order by n.date_added desc");
			
			foreach($q->result() as $r) 
			{
				$name = '"'.$r->id.'"';
				($w_ == 1 && $r->date_seen == "")?$btn = "<center><button class='btn-success btn-xs '  data-tooltip='Tag as seen' onclick='seen_(".$r->id_.",".$name.")'> 
		                         <i class='fa fa-eye'></i>
		                         <span></span></button>
			                     </center>":$btn = "";
				$result[] = array(
					$r->id,
					$r->users,
					$r->title,
					$r->content,
					$r->date_created,
					$r->date_seen,
					$btn);
			}
		}
		
		return $result;
	}

	public function user_office_assignment($act, $input = array())
	{
		if($act == 'getspecificoffice')
		{
			$id = $this->security->xss_clean($input['id']);
			$q = $this->db->query("SELECT o.id, o.name 
									FROM user_office_assignment uoa
									INNER JOIN office o 
									ON o.id = uoa.office
									WHERE uoa.status = 1 AND uoa.userid = ?", $id);
			foreach($q->result() as $r)
			{
				$result[] = array(
					$r->id, 
					$r->name);
			}
		}

		$ac = $this->validation_model->access(1, 'UOA');
		$val = explode('/', $ac[0]);
		$r_ = $val[1];
		$w_ = $val[2];
		$result = array();


		if($act == 'loadtable' || $act == 'getspecific')
		{
			if($act == 'getspecific')
				$id = $this->security->xss_clean($input['id']);
			($act == 'getspecific')?$cond = " and u.id = $id":$cond = "";
			$q = $this->db->query("SELECT distinct u.id id_, CONCAT(u.lname, ', ', u.fname) name, STUFF((SELECT cast('; ' as varchar(max)) + o2.name from user_office_assignment uoa2 inner join office o2 on o2.id = uoa2.office where uoa2.userid = u.id and uoa2.status = 1 for xml path('')),1,1,'') offices 
									FROM user_office_assignment uoa 
									INNER JOIN office o 
									ON o.id = uoa.office
									INNER JOIN users u 
									ON u.id = uoa.userid

									AND uoa.status = 1 $cond
									GROUP BY u.ID, u.lname,u.fname,o.name");
			foreach($q->result() as $r)
			{
				$name = '"'.$r->name.'"';
				($w_ == 1)?$btn = "<center><button class='btn-danger btn-xs '  data-tooltip='Delete' onclick='del_(".$r->id_.",".$name.")'> 
		                         <i class='fa fa-trash-o'></i>
		                         <span></span></button>
		                         <button class='btn-success btn-xs '  data-tooltip='Edit' id='back-to-top' onclick='edit_(".$r->id_.")'>
			                     <i class='fa fa-pencil'></i>
			                     <span></span></button>
			                     </center>":$btn = "";
				$result[] = array(
					$r->name, 
					$r->offices, 
					$btn,
					$this->user_office_assignment('getspecificoffice',array('id' => $r->id_)),
					$r->id_);
			}
		}
		else if($act == 'getspecificoffice')
		{
			$id = $this->security->xss_clean($input['id']);
			$q = $this->db->query("SELECT o.id, o.name FROM user_office_assignment uoa
									INNER JOIN office o 
									ON o.id = uoa.office
									WHERE uoa.status = 1 AND uoa.userid = ?", $id);
			foreach($q->result() as $r)
			{
				$result[] = array(
					$r->id, 
					$r->name);
			}
		}
		else if($act == 'loadUser')
		{
			$cond = "";
			if(isset($input['id']))
				($input['id'] != "")?
					$cond = " and userid != ".$input['id']:$cond = "";
			$q = $this->db->query("SELECT u.id, CONCAT(u.lname, ', ', u.fname,' (',r.description,')') name 
									FROM users u
									inner join role r 
									on r.id = u.role
									WHERE u.id NOT IN (SELECT userid FROM user_office_assignment WHERE STATUS = 1 $cond) AND u.status = 1
									order by u.lname");
			foreach($q->result() as $r)
			{
				$result[] = array(
					$r->id, 
					$r->name);
			}
		}
		
		return $result;
	}

	public function budget_allocation($act, $input = array())
	{
		$ac = $this->validation_model->access(1, 'BA');
		$val = explode('/', $ac[0]);
		$r_ = $val[1];
		$w_ = $val[2];
		$result = array();



		if($act == 'loadtable' || $act == 'getspecific')
		{
			$year = "";
			if($act == 'loadtable')
			{
				$year_ = $this->security->xss_clean($input['year_']);
				$year = "AND year_budget = $year_";
			}
			if($act == 'getspecific')
				$id = $this->security->xss_clean($input['id']);
			($act == 'getspecific')?$cond = " and ob.id = $id":$cond = "";
			$q = $this->db->query("SELECT o.name, budget, year_budget, ob.id id_, o.id office_id 
										FROM office_budget ob
										INNER JOIN office o 
										ON o.id = ob.office 
										WHERE ob.STATUS = 1 $year $cond");
			foreach($q->result() as $r)
			{
				$q_ = $this->db->query("SELECT SUM(total_amount) sum_ 
											FROM office_expense of_
											WHERE STATUS = 1 AND office = ? and year_ = ?", array($r->office_id, $r->year_budget));
				(isset($q_->result()[0]->sum_))?$consumed = $q_->result()[0]->sum_:$consumed = 0;

				$name = '"'.str_replace("'", "", $r->name).'"';

				($w_ == 1)?$btn = "<center><button class='btn-danger btn-xs '  data-tooltip='Delete' onclick='del_(".$r->id_.",".$name.")'> 
		                         <i class='fa fa-trash-o'></i>
		                         <span></span></button>
		                         <button class='btn-success btn-xs '  data-tooltip='Edit' id='back-to-top' onclick='edit_(".$r->id_.")'>
			                     <i class='fa fa-pencil'></i>
			                     <span></span></button>
			                     </center>":$btn = "";
				$result[] = array(
					$r->year_budget,
					$r->name, 
					'Php '.number_format($r->budget,2), 
					'Php '.number_format($consumed,2), 
					'Php '.number_format($r->budget - $consumed,2), 
					$btn,
					$r->id_,
					$r->budget,
					$r->office_id,
					$consumed,
					$r->budget - $consumed);
			}
		}
		else if($act == 'loadOffice')
		{
			$cond = "";
			if(isset($input['id']))
				$cond = "and office != ".$this->security->xss_clean($input['id']);
			$q = $this->db->query("SELECT o.id, o.name 
									FROM office o
									WHERE o.id NOT IN (SELECT office FROM office_budget WHERE year_budget = ? and STATUS = 1 $cond) AND o.status = 1", $this->security->xss_clean($input['year_']));
			foreach($q->result() as $r)
			{
				$result[] = array(
					$r->id, 
					$r->name);
			}
		}
		
		return $result;
	}

	public function stock_ledger($input = array(), $act = "")
	{
		if(isset($input['loadProduct']))
		{
			$result = array();
			if(isset($input['category']))
			{
				
				$category = $this->security->xss_clean($input['category']);
				$cat = "(";
				foreach($category as $r)
					$cat .= $r.",";
				$cat.="0)";

				$q = $this->db->query("SELECT p.id, p.description 
									FROM product p
									WHERE p.status = 1 AND p.category_id IN $cat");

				foreach($q->result() as $r)
					$result[] = array(
						$r->id,
						$r->description);
			}

			return $result;
		}
		else if($act == 'loadPrev')
		{
			$status = $this->security->xss_clean($input['status']);
			$product = $this->security->xss_clean($input['product']);
			$start = $this->security->xss_clean(date('Y-m-d', strtotime($input['start'])));
			$end = $this->security->xss_clean(date('Y-m-d', strtotime($input['end'])));

			$cat = "(0)";

			$cond = "";
			if($product != "")
				$cond = " and p.id = ".$product;

			($input['start'] == "")?$start = "2000-01-01":null;
			($input['end'] == "")?$end = "2050-01-01":null;

			$q = $this->db->query("SELECT COALESCE(SUM(qty),0) sum_qty from 
				(SELECT SUM(unit)*-1 qty, CONVERT(VARCHAR,ril.date_updated,101) released, '' delivered
				FROM request_item_line ril 
				INNER JOIN product p 
				ON p.id = ril.product $cond
				WHERE request_status = 'Approved' and ril.date_updated < '$start'
				group by ril.id, ril.date_updated

				UNION

				SELECT  SUM(qty_received) qty, '' released , CONVERT(VARCHAR,d.date_added,101) delivered
				FROM delivery d
				INNER JOIN product p 
				ON p.id = d.product $cond
				where d.status = 1 and d.date_added < '$start'
				group by d.id, d.date_added

				UNION

				SELECT  SUM(mpp.qty) qty, '' released , CONVERT(VARCHAR,mpp.date_added,101) delivered
				FROM manual_product_property mpp
				INNER JOIN product p 
				ON p.id = mpp.product  $cond
				WHERE mpp.status = 1 and mpp.date_added < '$start'
				group by mpp.id, mpp.date_added) tbl");
			
			return $q->result()[0]->sum_qty;
		}
		else
		{
			$result = array();
			$status = $this->security->xss_clean($input['status']);
			$product = $this->security->xss_clean($input['product']);
			$start = $this->security->xss_clean(date('Y-m-d', strtotime($input['start'])));
			$end = $this->security->xss_clean(date('Y-m-d', strtotime($input['end'])));

			$cat = "(0)";

			$cond = "";
			if($product != "")
				$cond = " and p.id = ".$product;

			($input['start'] == "")?$start = "2000-01-01":null;
			($input['end'] == "")?$end = "2050-01-01":null;


			if($status == 'all')
			{
				$q = $this->db->query("SELECT * from (SELECT CONCAT('IR-',FORMAT(ril.id,'00000')) id, p.description, unit qty, u.code, ril.date_updated action_date,  CONVERT(VARCHAR,ril.date_updated,101) released, '' delivered, ril.current_stock balance
					FROM request_item_line ril 
					INNER JOIN product p 
					ON p.id = ril.product $cond
					INNER JOIN units u 
					ON u.id = p.measurement
					WHERE request_status = 'Approved' and ril.date_updated between '$start' and '$end 23:59:59'

					UNION

					SELECT CONCAT('D-',FORMAT(d.id, '00000')) id, p.description, qty_received qty, u.code, d.date_added action_date, '' released , CONVERT(VARCHAR,d.date_added,101) delivered, d.current_stock balance
					FROM delivery d
					INNER JOIN product p 
					ON p.id = d.product $cond
					INNER JOIN units u 
					ON u.id = p.measurement
					where d.status = 1 and d.date_added between '$start' and '$end 23:59:59' 

					UNION

					SELECT CONCAT('M-',FORMAT(mpp.id,'00000')) id, p.description, mpp.qty, u.code, mpp.date_added action_date, '' released , CONVERT(VARCHAR,mpp.date_added,101) delivered, '0' balance
					FROM manual_product_property mpp
					INNER JOIN product p 
					ON p.id = mpp.product  $cond
					INNER JOIN units u 
					ON u.id = p.measurement
					WHERE mpp.status = 1 and mpp.date_added between '$start' and '$end 23:59:59') tbl order by action_date desc");
			}
			else if($status == 'in')
				$q = $this->db->query("SELECT * from (SELECT CONCAT('D-',FORMAT(d.id, '00000')) id, p.description, qty_received qty, u.code, d.date_added action_date, CONVERT(VARCHAR,d.date_added,101) delivered, '' released, d.current_stock balance
					FROM delivery d
					INNER JOIN product p 
					ON p.id = d.product $cond
					INNER JOIN units u 
					ON u.id = p.measurement
					where d.status = 1 and d.date_added between '$start' and '$end 23:59:59'

					UNION

					SELECT CONCAT('M-',FORMAT(mpp.id,'00000')) id, p.description, mpp.qty, u.code, mpp.date_added action_date, CONVERT(VARCHAR,mpp.date_added,101) delivered, '' released, '0' balance
					FROM manual_product_property mpp
					INNER JOIN product p 
					ON p.id = mpp.product  $cond
					INNER JOIN units u 
					ON u.id = p.measurement
					WHERE mpp.status = 1 and mpp.date_added between '$start' and '$end 23:59:59') tbl order by action_date desc");
			else if($status == 'out')
				$q = $this->db->query("SELECT CONCAT('IR-',FORMAT(ril.id,'00000')) id, p.description, unit qty, u.code, ril.date_updated action_date, CONVERT(VARCHAR,ril.date_updated,101) released, '' delivered, ril.current_stock balance
					FROM request_item_line ril 
					INNER JOIN product p 
					ON p.id = ril.product $cond
					INNER JOIN units u 
					ON u.id = p.measurement
					WHERE request_status = 'Approved' and ril.date_updated  between '$start' and '$end 23:59:59' 
					order by action_date desc");
			$result = array();
			foreach($q->result() as $r)
			{
				$result[] = array(
					'id' => $r->id,
					'description' => $r->description,
					'qty' => $r->qty.' '.$r->code, 
					'delivered' => $r->delivered,
					'released' => $r->released,
					'balance' => $r->balance);
			}
			return $result;
		}
	}

	public function property_management($act, $input = array())
	{
		$result = array();
		
		if($act == 'loadtable' || $act == 'getspecific')
		{
			$cond = "";
			if($act == "getspecific")
			{
				$id = $this->security->xss_clean($input['id']);
				$cond = " and pa.id = $id";
			}

			$statement = "";
			if(isset($input['s_employee']))
				if($input['s_employee'] != "")
					$statement .= " and u.id = ".$this->security->xss_clean($input['s_employee']);
			if(isset($input['s_office']))
				if($input['s_office'] != "")
					$statement .= " and o.id  = ".$this->security->xss_clean($input['s_office']);
			if(isset($input['s_item']))
				if($input['s_item'] != "")
					$statement .= " and p.id = ".$this->security->xss_clean($input['s_item']);
			
			if(isset($input['s_serial']))
				if($input['s_serial'] != "")
					$statement .= " and pa.property_code LIKE '%".$this->security->xss_clean($input['s_serial'])."%'";

			(isset($input['s_category']))?
			$category = $this->security->xss_clean($input['s_category']):$category = array();
			$cat = "(";
			foreach($category as $r)
				$cat .= $r.",";
			$cat.="0)";


			$q = $this->db->query("SELECT CONCAT('PR-',FORMAT(pa.id,'0000')) id, p.description property, pa.property_code, pa.id id_ , o.name office, CONCAT(u.lname, ', ', u.fname, ' ', UPPER(SUBSTRING(u.mname, 1,1)), ' ', suffix) name 
									FROM property_assignment pa
									LEFT JOIN users u 
									ON u.id = pa.userid
									INNER JOIN product p 
									ON p.id = pa.property_id
									LEFT JOIN office o 
									ON o.id = pa.officeid $cond 
									where 1 = 1 $statement and p.category_id in $cat");
			
			foreach($q->result() as $r) 
			{
				$ac = $this->validation_model->access(1, 'PM');
				$val = explode('/', $ac[0]);
				$r_ = $val[1];
				$w_ = $val[2];
				$name = '"'.$r->id.'"';

				($r->name != "")?
				$del = "<button class='btn-danger btn-xs '  data-tooltip='Unassign User/Office to the property' onclick='del_(".$r->id_.",".$name.")'> 
		                         <i class='fa fa-user'></i>
		                         <span></span></button>":$del ="";
				($w_ == 1)?$btn = "<center>".$del."
		                         <button class='btn-success btn-xs '  data-tooltip='Property Assignment/Transfer' id='back-to-top' onclick='edit_(".$r->id_.")'>
			                     <i class='fa fa-arrow-right'></i>
			                     <span></span></button>
			                     </center>":$btn = "";

				$result[] = array(
					$r->id,
					$r->property,
					$r->property_code,
					$r->name,
					$r->office,
					$btn,
					$r->id_);
			}
		}
		else if($act == 'loadSpecific')
		{
			$q = $this->db->query("SELECT CONCAT('PR-',FORMAT(pa.id,'0000')) id, p.description property, pa.property_code, pa.id id_ , o.name office, p.id propertyid, o.id officeid, u.id userid, CONCAT(u.lname, ', ', u.fname, ' ', UPPER(SUBSTRING(u.mname, 1,1)), ' ', suffix) name 
									FROM property_assignment pa
									LEFT JOIN users u 
									ON u.id = pa.userid
									INNER JOIN product p 
									ON p.id = pa.property_id
									LEFT JOIN office o 
									ON o.id = pa.officeid
									where pa.id = ?", $this->security->xss_clean($input['id']));
			foreach($q->result() as $r) 
			{
				$result[] = array(
					$r->id_,
					$r->propertyid,
					$r->userid,
					$r->officeid,
					$r->id,
					$r->name,
					$r->office,
					$r->property_code);
			}
		}
		else if($act == 'loadOffice_')
		{
			$q = $this->db->query("SELECT o.id, o.name FROM office o 
										WHERE o.STATUS = 1 and parent_id is not null
										order by name");
			foreach($q->result() as $r) 
			{
				$result[] = array(
					$r->id,
					$r->name);
			}
		}
		else if($act == 'loadEmployee')
		{
			$cond = "";
			if(isset($input['office']))
				if($input['office'] != "")
					$cond = " and uoa.office  = ".$this->security->xss_clean($input['office']);

			$q = $this->db->query("SELECT CONCAT(u.lname, ', ', u.fname, ' ', u.mname, ' ', u.suffix) name, u.id
											FROM user_office_assignment uoa 
											INNER JOIN users u 
											ON u.id = uoa.userid and u.status = 1 
											WHERE uoa.status = 1 $cond
											GROUP BY uoa.userid, u.lname,u.fname, u.mname,u.suffix, u.id");
			$result = array();
			foreach($q->result() as $r)
				$result[] = array(
					$r->id, 
					$r->name);
		}
		else if($act == 'loadInventory')
		{
			$q = $this->db->query("SELECT p.id, CONCAT(p.description,' [', i.current_stock,' ', u.code,']') product FROM inventory i 
									INNER JOIN product p 
									ON p.id =  i.product
									INNER JOIN units u 
									ON u.id = p.measurement
									WHERE p.property = 1 AND i.current_stock > 0");
			$result = array();
			foreach($q->result() as $r)
				$result[] = array(
					$r->id, 
					$r->product);
		}
		
		return $result;
	}

	public function office_expense($input = array())
	{
		$office = $this->security->xss_clean($input['office']);
		$start = $this->security->xss_clean(date('Y-m-d', strtotime($input['start'])));
		$end = $this->security->xss_clean(date('Y-m-d', strtotime($input['end'])));

		$cond = "";
		if($office != "")
			$cond = " and oe.office = ".$office;

		($_GET['start'] == "")?$start = "2000-01-01":null;
		($_GET['end'] == "")?$end = "2050-01-01":null;

		$q = $this->db->query("SELECT concat(oel.qty,' ', un.code) qty, oel.unit_price*oel.qty total, oel.unit_price, CONCAT('OE-',FORMAT(oe.id,'00000')) id,CONVERT(VARCHAR,oe.date_added,101) transaction_date, p.description product, o.name office, concat(u.lname, ' ', u.fname,' ', u.mname, ' ', u.suffix) requested_by, oe.added_by
								FROM office_expense oe 
								inner join office_expense_line oel 
								on oel.office_expense_id = oe.id 
								INNER JOIN office o 
								ON o.id = oe.office 
								INNER JOIN product p 
								ON p.id = oe.product
								inner join units un 
								on un.id = p.measurement
								left join users u 
								on u.id = oe.requested_by
								WHERE oe.status = 1 $cond");
		$result = array();
		foreach($q->result() as $r)
		{
			$result[] = array(
				'id' => $r->id,
				'product' => $r->product,
				'office' => $r->office, 
				'qty' => $r->qty, 
				'unit_price' => $r->unit_price, 
				'total' => $r->total,
				'requested_by' => $r->requested_by, 
				'released_by' => $r->added_by, 
				'transaction_date' => $r->transaction_date);
		}
		return $result;
	}

	public function stock_manual($act, $input = array())
	{
		if($act == 'loadtable')
		{
			$item = $this->security->xss_clean($input['s_item']);

			$cond = "";
			if($item != "")
				$cond = " and mpp.product = ".$item;

			$q = $this->db->query("SELECT FORMAT(mpp.id,'0000') id, mpp.id id_, p.description, mpp.qty,mpp.unit_price, mpp.remarks, CONVERT(VARCHAR,mpp.date_added,101) date_added
									FROM manual_product_property mpp
									INNER JOIN product p 
									ON p.id = mpp.product 
									LEFT JOIN inventory_price ip 
									ON ip.id = mpp.inventory_price_id
									WHERE mpp.status = 1");
			$ac = $this->validation_model->access(1, 'SM');
			$val = explode('/', $ac[0]);
			$r_ = $val[1];
			$w_ = $val[2];

			
			$result = array();
			foreach($q->result() as $r)
			{
				$name = '"'.$r->id.'"';

				($w_ == 1)?$btn = "<center>
			                     <button class='btn-danger btn-xs '  data-tooltip='Delete Stock' onclick='del_(".$r->id_.",".$name.")'> 
		                         <i class='fa fa-trash-o'></i>
		                         <span></span></button>
			                     </center>":$btn = "";
				$result[] = array(
					$r->id,
					$r->description,
					$r->qty, 
					$r->unit_price, 
					$r->remarks, 
					$r->date_added,
					$btn);
			}
		}
		else if($act == 'loadInventory')
		{
			$q = $this->db->query("SELECT ip.id, CONCAT(p.description,' [QTY: ',ip.qty,']', '[PRICE:',ip.price,']') item
									FROM inventory_price ip
									INNER JOIN product p 
									ON p.id = ip.product
									WHERE qty > 0 and ip.product = ?", $this->security->xss_clean($input['id']));
			$data = array();
			foreach($q->result() as $r)
				$data[] = array(
					$r->id, 
					$r->item);
			$result = array('mes'=>'Success', 'data'=>$data);
		}
		
		return $result;
	}

	public function property_report($act, $input = array())
	{
		if($act == 'loadtable')
		{
			$item = $this->security->xss_clean($input['s_item']);

			$cond = "";
			if($item != "")
				$cond = " and mpp.product = ".$item;

			$q = $this->db->query("SELECT CONCAT('ST-', FORMAT(mpp.id,'00000')) id, mpp.id id_, p.description, mpp.qty,mpp.unit_price, mpp.remarks, CONVERT(VARCHAR,mpp.date_added,101) date_added
									FROM manual_product_property mpp
									INNER JOIN product p 
									ON p.id = mpp.product 
									LEFT JOIN inventory_price ip 
									ON ip.id = mpp.inventory_price_id
									WHERE mpp.status = 1");
			$ac = $this->validation_model->access(1, 'SM');
			$val = explode('/', $ac[0]);
			$r_ = $val[1];
			$w_ = $val[2];

			
			$result = array();
			foreach($q->result() as $r)
			{
				$name = '"'.$r->id.'"';

				($w_ == 1)?$btn = "<center>
			                     <button class='btn-danger btn-xs '  data-tooltip='Delete Stock' onclick='del_(".$r->id_.",".$name.")'> 
		                         <i class='fa fa-trash-o'></i>
		                         <span></span></button>
			                     </center>":$btn = "";
				$result[] = array(
					$r->id,
					$r->description,
					$r->qty, 
					$r->unit_price, 
					$r->remarks, 
					$r->date_added,
					$btn);
			}
		}
		else if($act == 'loadEmployee')
		{
			$cond = "";
			if(isset($input['office']))
				if($input['office'] != "")
					$cond = " and uoa.office  = ".$this->security->xss_clean($input['office']);

			$q = $this->db->query("SELECT CONCAT(u.lname, ', ', u.fname, ' ', u.mname, ' ', u.suffix) name, u.id
											FROM user_office_assignment uoa 
											INNER JOIN users u 
											ON u.id = uoa.userid and u.status = 1 
											WHERE uoa.status = 1 $cond
											GROUP BY uoa.userid, u.lname, u.fname, u.mname, u.suffix, u.id");
			$result = array();
			foreach($q->result() as $r)
				$result[] = array(
					$r->id, 
					$r->name);
		}
		else if($act == 'loadOffice')
		{
			$q = $this->db->query("SELECT id, name FROM office WHERE STATUS = 1 ");
			$result = array();
			foreach($q->result() as $r)
				$result[] = array(
					$r->id, 
					$r->name);
		}
		
		
		return $result;
	}
	public function approve_purchase_requests($act, $input = array())
	{
		$result = array();

		/*approvePurchaseRequest*/
		if($act=='loadApprovePurchaseRequest'){
			$query=$this->db->query("SELECT CONCAT('PR-',DATEPART(yyyy, pr.date_added),'-',FORMAT(DATEPART(mm, pr.date_added),'00'),'-',FORMAT(pr.id,'0000')) as pr_id,concat(substring(convert(varchar, pr.date_added, 2),1,2),'-',substring(convert(varchar, pr.date_added, 2),4,2),'-',format(pr.id,'0000')) pr_no, 
									o.name office, concat(us.lname, ', ', us.fname) requested_by, CONVERT(VARCHAR,pr.date_added,101) date_requested, 
									prl.item_desc, prl.qty, prl.unit_cost,prl.total_cost,
									prl.unit, prl.id,  prl.purpose, prl.request_status,
									prl.pr_id as id, /*purchase_request ID*/
									concat(prl.qty,' ',prl.unit,' of ',prs.description) requested_item

									FROM purchase_request pr 
									inner join purchase_request_line prl 
									on prl.pr_id = pr.id

									inner join product as prs
									on prs.id=prl.product
									

									INNER JOIN office o 
									ON o.id = pr.office_id
									left join users us
									on us.id = pr.requested_by
									WHERE prl.request_status='Approved'
									order by prl.request_status desc");

		
			foreach($query->result() as $r) 
			{	
				
				$action= "<button class='btn-info btn-xs '  data-tooltip='Purchase Order' onclick='approvePurchaseRequestToPo(".$r->id.");'> 
		                         <i class='fa fa-check''></i>
		                         <span></span></button>";


							$result[] = array(
							//$r->pr_no,
						    $r->pr_id,
							$r->office,/*
							$r->item_desc,*/
							$r->requested_item,						
							$r->unit_cost,
							$r->total_cost,
							$r->requested_by,
							$r->date_requested,
							//$r->request_status,
							$r->purpose,
							//$cs,
							$action
							);

			}
		}
		/*approvePurchaseRequest*/


		if($act == 'loadtable' || $act == 'getspecific')
		{
			$cond = "";
			if($act == "getspecific")
			{
				$id = $this->security->xss_clean($input['id']);
				$cond = " and a.id = $id";
				//print_r($cond);die();
			}

			$q = $this->db->query("SELECT CONCAT('PR-',DATEPART(yyyy, pr.date_added),'-',FORMAT(DATEPART(mm, pr.date_added),'00'),'-',FORMAT(pr.id,'0000')) as pr_id,concat(substring(convert(varchar, pr.date_added, 2),1,2),'-',substring(convert(varchar, pr.date_added, 2),4,2),'-',format(pr.id,'0000')) pr_no, 
									o.name office, concat(us.lname, ', ', us.fname) requested_by, CONVERT(VARCHAR,pr.date_added,101) date_requested, 
									prl.item_desc, prl.qty, prl.unit_cost,
									prl.unit, prl.id,  prl.purpose, prl.request_status,

									concat(prl.qty,' ',prl.unit,' of ',prs.description) requested_item

									FROM purchase_request pr 
									inner join purchase_request_line prl 
									on prl.pr_id = pr.id

									inner join product as prs
									on prs.id=prl.product
									

									INNER JOIN office o 
									ON o.id = pr.office_id
									left join users us
									on us.id = pr.requested_by
									WHERE prl.request_status != 'Cancelled' and prl.request_status = 'Pending' $cond
									order by prl.request_status desc");

			foreach($q->result() as $r) 
			{
				$btn = "";
				$a = $this->db->query("SELECT TOP 1 concat(u.lname, ', ', u.fname) name, u.id, coalesce((SELECT approval_status FROM purchase_request_line_approval WHERE STATUS = 1 AND purchase_request_line_id = $r->id and approver = u.id),2) status FROM approver a 
										INNER JOIN users u 
										ON u.id = a.userid
										WHERE trans = 'PR' AND a.status = 1 AND u.id 
										NOT IN (SELECT approver FROM purchase_request_line_approval WHERE STATUS = 1 AND approval_status = 1 AND purchase_request_line_id = $r->id)");
  
				$ac = $this->validation_model->access(1, 'APR');
				$val = explode('/', $ac[0]);
				$r_ = $val[1];
				$w_ = $val[2];

				$name = '"'.$r->item_desc.'"';
				if(isset($a->result()[0]->id))
				($w_ == 1 && $this->session->userdata('USERID') == $a->result()[0]->id && $a->result()[0]->status != 0 && ($r->request_status == "" || $r->request_status == 'Pending'))?$btn = "<table style='margin:0px'><tr><td><center><button class='btn-success btn-xs '  data-tooltip='Approve Request' onclick='approve_(".$r->id.",".$name.")'> 
		                         <i class='fa fa-check'></i>
		                         <span></span></button></td><td style='padding-left:2px'>
		                         <button class='btn-danger btn-xs '  data-tooltip='Disapprove Request' onclick='disapprove_(".$r->id.",".$name.")'> 
		                         <i class='fa fa-times''></i>
		                         <span></span></button>
			                     </center></td></tr></table>":$btn = "";
			    $status = "";		
			     if($a->num_rows() > 0)
			    	if($a->result()[0]->status == 2 || $a->result()[0]->status == 1)
			    		$status = "Pending approval of ".$a->result()[0]->name;
			    	else if($a->result()[0]->status == 0)
			    		$status = $a->result()[0]->name." disapproved this request.";	
			 $wf = "<center><button class='btn-common btn-xs' data-tooltip='View Workflow' onclick='wf_(".$r->id.",".$name.")'> 
		                         <i class='fa fa-arrow-right'></i>
		                         <span></span></button>
			                     </center>";
			
			    ($btn == "");
							$result[] = array(
							//$r->pr_no,
						    $r->pr_id,
							$r->office,/*
							$r->item_desc,*/
							$r->requested_item,
							$r->unit,
							$r->qty,
							$r->unit_cost,
							$r->purpose,
							$r->date_requested,
							//$r->request_status,
							$status,
							//$cs,
							'<table style="margin:0px"><tr><td>'.$wf.'</td><td>'.$btn.'</td></tr></table>'
							);
			}
		}
		if($act == 'wf')
		{
			$data = array();
			$id = $this->security->xss_clean($input['id']);

			$a = $this->db->query("SELECT concat(u.lname, ', ', u.fname) name, u.id,
									coalesce((SELECT TOP 1 approval_status FROM purchase_request_line_approval WHERE STATUS = 1 AND approver = u.id AND purchase_request_line_id = ? order by id desc),2) approval_status
									FROM approver a 
									INNER JOIN users u 
									ON u.id = a.userid
									WHERE trans = 'PR' AND a.status = 1
									order by heirarchy", $id);
			foreach($a->result() as $r)
			$data[] = array(
				$r->id,
				$r->name,
				$r->approval_status);

			$result = array('mes' => 'Success', 'data' => $data);
			
		}

		return $result;
		
		
	}

	public function item_units($input = array()){

  	$result = array();

  	if($input['action']=="getspecifics"){
  		$id = $this->security->xss_clean($input['id']);

  			$a = $this->db->query("SELECT b.description, b.code 
								  FROM product as a 
								  inner join units as b on
								  a.measurement=b.id where a.id=$id");

  			foreach($a->result() as $r){
  				$result[]=array(
  					$r->description,
  					$r->code);
  				} 	
  		}return $result;

     }
      public function furniture_order($act, $input = array()){
     		$result = array();
		if($act == 'loadtable')
		{
			$statement = "";
			if(isset($input['s_supplier']))
				if($input['s_supplier'] != "")
					$statement .= " and fo.supplier_id = ".$this->security->xss_clean($input['s_supplier']);
			if(isset($input['s_user']))
				if($input['s_user'] != "")
					$statement .= " and fo.added_by_id = ".$this->security->xss_clean($input['s_user']);
			if(isset($input['s_item']))
				if($input['s_item'] != "")
					$statement .= " and fo.id in (SELECT fol.fo_id from purchase_order_line fol where fol.product = ".$this->security->xss_clean($input['s_item']).")";
			if(isset($input['s_date']))
				if($input['s_date'] != "")
					$statement .= " and fo.expected_delivery_date between '".date('Y-m-d',strtotime($this->security->xss_clean($input['s_date'])))." 00:00:00' and '".date('Y-m-d',strtotime($this->security->xss_clean($input['s_date'])))." 23:59:59'";
			if(isset($input['s_status']))
				if($input['s_status'] != "")
					$statement .= " and fo.fo_status = '".$this->security->xss_clean($input['s_status'])."'";
			if(isset($input['s_po']))
				if($input['s_po'] != "")
					$statement .= " and CONCAT('PO-',FORMAT(fo.id,'000000')) LIKE '%".$this->security->xss_clean($input['s_po'])."%'";

			$q = $this->db->query("SELECT distinct id_, 
				                  (SELECT supplier_name from supplier where id = tbl.supplier_id) supplier_name, 
				                  expected_delivery_date, 
				                  code,  
								 stuff((    SELECT  CONCAT(f2.item_desc, ' (',fol2.qty,' ', f2.unit, ')',' ( P ',fol2.amount,' )') + cast('<br> ' as varchar(max)) from furniture_order_line fol2 
									 left join furniture_request_line f2 
									 on f2.fr_id = fol2.product 
									 
									   where fol2.fo_id = tbl.id_ and fol2.status = 1 for xml path('')), 1, 0, '') product,
								  total_price, 
								   fo_status,
								    added_by, 
								    added_by_id
								    FROM 
										(
											SELECT distinct fo.id id_, supplier_id, CONVERT(VARCHAR,fo.expected_delivery_date,101) expected_delivery_date , 
											CONCAT('FO-',FORMAT(fo.id,'000000')) code,
											 fo_status,
											  fo.added_by,
											   fo.total_price, 
											   fo.added_by_id
											FROM furniture_order fo
										where 1 = 1 $statement
										) tbl
										GROUP BY tbl.id_, expected_delivery_date,  code, total_price,  fo_status, added_by, added_by_id, supplier_id");
												
			foreach($q->result() as $r) 
			{
				$ac = $this->validation_model->access(1, 'JO');
				$val = explode('/', $ac[0]);
				$r_ = $val[1];
				$w_ = $val[2];
				$name = '"'.$r->code.'"';
				$status = '"'.$r->fo_status.'"';

				($w_ == 1)?$btn = "<center><table style='margin:0px'><tr><td><center><button class='btn-success btn-xs '  data-tooltip='View Job Order' onclick='view_(".$r->id_.",".$name.",".$status.")'> 
		                         <i class='fa fa-eye'></i>
		                         <span></span></button></td><td style='padding-left:2px'>
		                         <button class='btn-danger btn-xs '  data-tooltip='Cancel Purchase Order' onclick='cancel_(".$r->id_.",".$name.")'> 
		                         <i class='fa fa-times''></i>
		                         <span></span></button>
			                     </center></td></tr></table></center>":$btn = "";
			    if($r->fo_status == 'Cancelled')
			    	$btn = "<div style='vertical-align:middle'><center><table style='margin:0px'><tr><td><center><button class='btn-success btn-xs '  data-tooltip='View Job Order' onclick='view_(".$r->id_.",".$name.")'> 
		                         <i class='fa fa-eye'></i>
		                         <span></span></button></td></tr></table></center></div>";
		        if($r->fo_status == 'New' || $r->fo_status == 'Changed Order')
			    	$btn = "<center><table style='margin:0px'><tr><td><center><button class='btn-success btn-xs '  data-tooltip='View Job/Release Order' onclick='view_(".$r->id_.",".$name.",".$status.")'> 
		                         <i class='fa fa-eye'></i>
		                         <span></span></button></td><td style='padding-left:2px'>
		                         <button class='btn-warning btn-xs '  data-tooltip='Change Order' onclick='co_(".$r->id_.",".$name.")'> 
		                         <i class='fa fa-pencil''></i>
		                         <span></span></button>
			                     </center></td><td style='padding-left:2px'>
		                         <button class='btn-danger btn-xs '  data-tooltip='Cancel Job Order' onclick='cancel_(".$r->id_.",".$name.")'> 
		                         <i class='fa fa-times''></i>
		                         <span></span></button>
			                     </center></td></tr></table></center>";

			    ($w_ == 1)?null:$btn="";
			    $result[] = array(
					$r->code,
					$r->supplier_name,
					htmlspecialchars_decode($r->product),
					'Php '.number_format($r->total_price,2),
					$r->expected_delivery_date,
					$r->added_by,
					$r->fo_status,					
					$btn);
			}
		}return $result;
     }



     public function furniture_request($act, $input = array()){

     		$result = array();
     		if($act == 'loadtable' || $act == 'getspecific'){


     			$statement = "";
			if(isset($input['s_office']))
				if($input['s_office'] != "")
					$statement .= " and o.ID = ".$this->security->xss_clean($input['s_office']);
			
				if(isset($input['s_date']))
				if($input['s_date'] != "")
					$statement .= " and fr.date_added between '".date('Y-m-d',strtotime($this->security->xss_clean($input['s_date'])))." 00:00:00' and '".date('Y-m-d',strtotime($this->security->xss_clean($input['s_date'])))." 23:59:59'";

			if(isset($input['s_status']))
				if($input['s_status'] != "")
					$statement .= " and frl.request_status = '".$this->security->xss_clean($input['s_status'])."'";

 				 	   $q=$this->db->query("SELECT frl.unit,concat(substring(convert(varchar, fr.date_added, 2),1,2),'-',substring(convert(varchar, fr.date_added, 2),4,2),'-',format(fr.id,'0000')) fr_id,fr.id,frl.item_desc,o.name,frl.qty,CONCAT('P ',format(frl.unit_cost,'#,###.00')) unit_cost,CONCAT('P ',format(frl.total_cost,'#,###.00')) total_cost,convert(varchar,fr.date_added,101)date_added,frl.request_status, CONCAT(u.fname,' ',u.mname,' ',u.lname) as username 
		     	   	     from furniture_request as fr
		     	   	     inner join furniture_request_line as frl
		     	   	     on fr.id=frl.fr_id
		     	   	     inner join office as o
		     	   	     on fr.office_id=o.ID 
		     	   	     inner join users as u
		     	   	     on fr.requested_by=u.id
		     	   	     where fr.requested_by = ? $statement", $this->session->userdata('USERID')
		     	   	     );
		     		
			     		


			     		foreach($q->result() as $r){
			     			
			     			$result[]=array(
			     				$r->fr_id,
			     				$r->item_desc,
			     				$r->name,
			     				$r->unit,
			     				$r->qty,
			     				$r->unit_cost,
			     				$r->total_cost,
			     				$r->date_added,
			     				$r->username,
			     				$r->request_status,
			     				$r->id

			     				);
			     		 }
     		}
			return $result;
     }

     public function job_order($act, $input = array()){
     		$result = array();
		if($act == 'loadtable')
		{
			$statement = "";
			if(isset($input['s_supplier']))
				if($input['s_supplier'] != "")
					$statement .= " and jo.supplier_id = ".$this->security->xss_clean($input['s_supplier']);
			if(isset($input['s_user']))
				if($input['s_user'] != "")
					$statement .= " and jo.added_by_id = ".$this->security->xss_clean($input['s_user']);
			if(isset($input['s_item']))
				if($input['s_item'] != "")
					$statement .= " and jo.id in (SELECT jol.jo_id from job_order_line jol where jol.product = ".$this->security->xss_clean($input['s_item']).")";
			if(isset($input['s_date']))
				if($input['s_date'] != "")
					$statement .= " and jo.expected_delivery_date between '".date('Y-m-d',strtotime($this->security->xss_clean($input['s_date'])))." 00:00:00' and '".date('Y-m-d',strtotime($this->security->xss_clean($input['s_date'])))." 23:59:59'";
			if(isset($input['s_status']))
				if($input['s_status'] != "")
					$statement .= " and jo.jo_status = '".$this->security->xss_clean($input['s_status'])."'";
			if(isset($input['s_po']))
				if($input['s_po'] != "")
					$statement .= " and CONCAT('JO-',FORMAT(jo.id,'000000')) LIKE '%".$this->security->xss_clean($input['s_po'])."%'";

			$q = $this->db->query("SELECT distinct id_, 
				                  (SELECT supplier_name from supplier where id = tbl.supplier_id) supplier_name, 
				                  expected_delivery_date, 
				                  code,  
								 stuff((    SELECT  CONCAT(p2.item_desc, ' (',jol2.qty,' ', p2.unit, ')',' ( P ',jol2.amount,' )') + cast('<br> ' as varchar(max)) from job_order_line jol2 
									 left join job_request_line p2 
									 on p2.jr_id = jol2.product 
									 
									   where jol2.jo_id = tbl.id_ and jol2.status = 1 for xml path('')), 1, 0, '') product,
								  total_price, 
								   jo_status,
								    added_by, 
								    added_by_id
								    FROM 
										(
											SELECT distinct jo.id id_, supplier_id, CONVERT(VARCHAR,jo.expected_delivery_date,101) expected_delivery_date , 
											CONCAT('JO-',FORMAT(jo.id,'000000')) code,
											 jo_status,
											  jo.added_by,
											   jo.total_price, 
											   jo.added_by_id
											FROM job_order jo
										where 1 = 1 $statement
										) tbl
										GROUP BY tbl.id_, expected_delivery_date,  code, total_price,  jo_status, added_by, added_by_id, supplier_id");
												
			foreach($q->result() as $r) 
			{
				$ac = $this->validation_model->access(1, 'JO');
				$val = explode('/', $ac[0]);
				$r_ = $val[1];
				$w_ = $val[2];
				$name = '"'.$r->code.'"';
				$status = '"'.$r->jo_status.'"';

				($w_ == 1)?$btn = "<center><table style='margin:0px'><tr><td><center><button class='btn-success btn-xs '  data-tooltip='View Job Order' onclick='view_(".$r->id_.",".$name.",".$status.")'> 
		                         <i class='fa fa-eye'></i>
		                         <span></span></button></td><td style='padding-left:2px'>
		                         <button class='btn-danger btn-xs '  data-tooltip='Cancel Purchase Order' onclick='cancel_(".$r->id_.",".$name.")'> 
		                         <i class='fa fa-times''></i>
		                         <span></span></button>
			                     </center></td></tr></table></center>":$btn = "";
			    if($r->jo_status == 'Cancelled')
			    	$btn = "<div style='vertical-align:middle'><center><table style='margin:0px'><tr><td><center><button class='btn-success btn-xs '  data-tooltip='View Job Order' onclick='view_(".$r->id_.",".$name.")'> 
		                         <i class='fa fa-eye'></i>
		                         <span></span></button></td></tr></table></center></div>";
		        if($r->jo_status == 'New' || $r->jo_status == 'Changed Order')
			    	$btn = "<center><table style='margin:0px'><tr><td><center><button class='btn-success btn-xs '  data-tooltip='View Job/Release Order' onclick='view_(".$r->id_.",".$name.",".$status.")'> 
		                         <i class='fa fa-eye'></i>
		                         <span></span></button></td><td style='padding-left:2px'>
		                         <button class='btn-warning btn-xs '  data-tooltip='Change Order' onclick='co_(".$r->id_.",".$name.")'> 
		                         <i class='fa fa-pencil''></i>
		                         <span></span></button>
			                     </center></td><td style='padding-left:2px'>
		                         <button class='btn-danger btn-xs '  data-tooltip='Cancel Job Order' onclick='cancel_(".$r->id_.",".$name.")'> 
		                         <i class='fa fa-times''></i>
		                         <span></span></button>
			                     </center></td></tr></table></center>";

			    ($w_ == 1)?null:$btn="";
			    $result[] = array(
					$r->code,
					$r->supplier_name,
					htmlspecialchars_decode($r->product),
					'Php '.number_format($r->total_price,2),
					$r->expected_delivery_date,
					$r->added_by,
					$r->jo_status,					
					$btn,
					$r->id_);
			}
		}return $result;
     }

     public function job_request($act, $input = array()){

     		$result = array();
     		if($act == 'loadtable' || $act == 'getspecific'){


     			$statement = "";
			if(isset($input['s_office']))
				if($input['s_office'] != "")
					$statement .= " and o.ID = ".$this->security->xss_clean($input['s_office']);
			
				if(isset($input['s_date']))
				if($input['s_date'] != "")
					$statement .= " and jr.date_added between '".date('Y-m-d',strtotime($this->security->xss_clean($input['s_date'])))." 00:00:00' and '".date('Y-m-d',strtotime($this->security->xss_clean($input['s_date'])))." 23:59:59'";

			if(isset($input['s_status']))
				if($input['s_status'] != "")
					$statement .= " and jrl.request_status = '".$this->security->xss_clean($input['s_status'])."'";

 				 	   $q=$this->db->query("SELECT jrl.unit,concat(substring(convert(varchar, jr.date_added, 2),1,2),'-',substring(convert(varchar, jr.date_added, 2),4,2),'-',format(jr.id,'0000')) jr_id,jr.id,jrl.item_desc,o.name,jrl.qty,CONCAT('P ',format(jrl.unit_cost,'#,###.00')) unit_cost,CONCAT('P ',format(jrl.total_cost,'#,###.00')) total_cost,convert(varchar,jr.date_added,101)date_added,jrl.request_status, CONCAT(u.fname,' ',u.mname,' ',u.lname) as username 
		     	   	     from job_request as jr
		     	   	     inner join job_request_line as jrl
		     	   	     on jr.id=jrl.jr_id
		     	   	     inner join office as o
		     	   	     on jr.office_id=o.ID 
		     	   	     inner join users as u
		     	   	     on jr.requested_by=u.id
		     	   	     where jr.requested_by = ? $statement", $this->session->userdata('USERID')
		     	   	     );
		     		
			     		


			     		foreach($q->result() as $r){
			     			
			     			$result[]=array(
			     				$r->jr_id,
			     				$r->item_desc,
			     				$r->name,
			     				$r->unit,
			     				$r->qty,
			     				$r->unit_cost,
			     				$r->total_cost,
			     				$r->date_added,
			     				$r->username,
			     				$r->request_status,
			     				$r->id

			     				);
			     		 }
     		}
			return $result;
     }

     public function view_requisition_and_issue_slip($id){
     	$sql = "SELECT CONCAT(DATEPART(yyyy,p.date_added),'-',p.types,'-',pc.master_id,'-',p.category_id) stock_number,iv.current_stock stocks, 
		     	concat(substring(convert(varchar,ri.date_requested, 2),1,2),'-',substring(convert(varchar,ri.date_requested, 2),4,2),'-',format(ri.id,'0000')) as r_id ,
		     	FORMAT(ri.id,'0000') id,
		     	o.name office,
		     	o.code,
		     	ri.fund_cluster,
		     	concat(us.lname, ', ', us.fname) requested_by, 
		     	CONVERT(VARCHAR,ri.date_requested,101) date_requested,
		    ril.unit qty, concat(p.description,', ',pc.description) product_desc,
		     	ril.unit qty,
		     	p.category_id,
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
				WHERE ril.id=$id  ";
				
		$query = $this->db->query($sql);
		$result = $query->result();
		
		return $result;
     }

  public function getItemUnits($input){
  	$result = array();

  	if($input['act2']=="getData"){
  		$id = $this->security->xss_clean($input['id']);

  			$a = $this->db->query("SELECT b.code, c.current_stock
								  FROM product as a 
								  INNER JOIN units as b 
								  on a.measurement=b.id 
								  JOIN inventory as c 
								  on c.product = a.id
								  where a.id=$id");

  			foreach($a->result() as $r){
  				$result[]=array(
  					$r->code,
  					$r->current_stock);
  				}
  		}
  		return $result;

     }

       public function getMaxQuantity($input){
  	$result = array();

  	if($input['act3']=="getData"){
  		$id = $this->security->xss_clean($input['id']);

  			$a = $this->db->query("SELECT b.code, c.current_stock
								  FROM product as a 
								  INNER JOIN units as b 
								  on a.measurement=b.id 
								  JOIN inventory as c 
								  on c.product = a.id
								  where a.id=$id");

  			foreach($a->result() as $r){
  				$result[]=array(
  					$r->code,
  					$r->current_stock);
  				}
  		}
  		return $result;

     }

     #############################################################
#															#
#				APPROVE FURNITURE REQUEST 					#
#															#
#	Created by : RBC 										#
# 	Date updated : 02/22/18									#
#############################################################
    public function approve_furniture_requests($act, $input = array())
    {
    	$result = array();

    	if($act == 'loadtable' || $act == 'getspecific')
		{
			$cond = "";
			if($act == "getspecific")
			{
				$id = $this->security->xss_clean($input['id']);
				$cond = " and a.id = $id";
			}

			$q = $this->db->query("SELECT CONCAT('FR-',DATEPART(yyyy, fr.date_added),'-',FORMAT(DATEPART(mm, fr.date_added),'00'),'-',FORMAT(fr.id,'0000')) as fr_id,concat(substring(convert(varchar, fr.date_added, 2),1,2),'-',substring(convert(varchar, fr.date_added, 2),4,2),'-',format(fr.id,'0000')) fr_no, 
									o.name office, concat(us.lname, ', ', us.fname) requested_by, CONVERT(VARCHAR,fr.date_added,101) date_requested, 
									frl.item_desc, frl.qty, frl.unit_cost,
									frl.unit, frl.id,  frl.purpose, frl.request_status,
									frl.item_desc as requested_item

									FROM furniture_request fr 
									inner join furniture_request_line frl 
									on frl.fr_id = fr.id

									INNER JOIN office o 
									ON o.id = fr.office_id
									left join users us
									on us.id = fr.requested_by
									WHERE frl.request_status != 'Cancelled' and frl.request_status = 'Pending'
									order by frl.request_status desc");

			foreach($q->result() as $r) 
			{
				$btn = "";
				$a = $this->db->query("SELECT TOP 1 concat(u.lname, ', ', u.fname) name, u.id, coalesce((SELECT approval_status FROM furniture_request_line_approval WHERE STATUS = 1 AND furniture_request_line_id = $r->id and approver = u.id),2) status 
										
										FROM approver a 
										INNER JOIN users u 
										ON u.id = a.userid
										WHERE trans = 'FER' AND a.status = 1 AND u.id 
										NOT IN (SELECT approver FROM furniture_request_line_approval WHERE STATUS = 1 AND approval_status = 1 AND furniture_request_line_id = $r->id)");
  
				$ac = $this->validation_model->access(1, 'AFER');
				$val = explode('/', $ac[0]);
				$r_ = $val[1];
				$w_ = $val[2];

				$name = '"'.$r->item_desc.'"';
				if(isset($a->result()[0]->id))
				($w_ == 1 && $this->session->userdata('USERID') == $a->result()[0]->id && $a->result()[0]->status != 0 && ($r->request_status == "" || $r->request_status == 'Pending'))?$btn = "<table style='margin:0px'><tr><td><center><button class='btn-success btn-xs '  data-tooltip='Approve Request' onclick='approve_(".$r->id.",".$name.")'> 
		                         <i class='fa fa-check'></i>
		                         <span></span></button></td><td style='padding-left:2px'>
		                         <button class='btn-danger btn-xs '  data-tooltip='Disapprove Request' onclick='disapprove_(".$r->id.",".$name.")'> 
		                         <i class='fa fa-times''></i>
		                         <span></span></button>
			                     </center></td></tr></table>":$btn = "";
			    $status = "";		
			     if($a->num_rows() > 0)
			    	if($a->result()[0]->status == 2 || $a->result()[0]->status == 1)
			    		$status = "Pending approval of ".$a->result()[0]->name;
			    	else if($a->result()[0]->status == 0)
			    		$status = $a->result()[0]->name." disapproved this request.";	
			 	$wf = "<center><button class='btn-common btn-xs' data-tooltip='View Workflow' onclick='wf_(".$r->id.",".$name.")'> 
		                         <i class='fa fa-arrow-right'></i>
		                         <span></span></button>
			                     </center>";
			
			    ($btn == "");
							$result[] = array(
						    $r->fr_id,
							$r->office,
							$r->requested_item,
							$r->unit,
							$r->qty,
							$r->unit_cost,
							$r->purpose,
							$r->date_requested,
							$status,
							'<table style="margin:0px"><tr><td>'.$wf.'</td><td>'.$btn.'</td></tr></table>'
							);
			}
		}

		if($act == 'wf')
		{
			$data = array();
			$id = $this->security->xss_clean($input['id']);

			$a = $this->db->query("SELECT concat(u.lname, ', ', u.fname) name, u.id,
									coalesce((SELECT TOP 1 approval_status FROM furniture_request_line_approval WHERE STATUS = 1 AND approver = u.id AND furniture_request_line_id = ? order by id desc),2) approval_status
									FROM approver a 
									INNER JOIN users u 
									ON u.id = a.userid
									WHERE trans = 'FER' AND a.status = 1
									order by heirarchy", $id);
			foreach($a->result() as $r)
			$data[] = array(
				$r->id,
				$r->name,
				$r->approval_status);

			$result = array('mes' => 'Success', 'data' => $data);
			
		}
		return $result;
    }

    #############################################################
#															#
#					APPROVE JOB REQUEST 					#
#															#
#	Created by : RBC 										#
# 	Date updated : 02/21/18									#
#############################################################
    public function approve_job_requests($act, $input = array())
    {
    	$result = array();

    	if($act == 'loadtable' || $act == 'getspecific')
		{
			$cond = "";
			if($act == "getspecific")
			{
				$id = $this->security->xss_clean($input['id']);
				$cond = " and a.id = $id";
			}

			$q = $this->db->query("SELECT CONCAT('JR-',DATEPART(yyyy, jr.date_added),'-',FORMAT(DATEPART(mm, jr.date_added),'00'),'-',FORMAT(jr.id,'0000')) as jr_id,concat(substring(convert(varchar, jr.date_added, 2),1,2),'-',substring(convert(varchar, jr.date_added, 2),4,2),'-',format(jr.id,'0000')) jr_no, 
									o.name office, concat(us.lname, ', ', us.fname) requested_by, CONVERT(VARCHAR,jr.date_added,101) date_requested, 
									jrl.item_desc, jrl.qty, jrl.unit_cost,
									jrl.unit, jrl.id,  jrl.purpose, jrl.request_status,
									jrl.item_desc as requested_item

									FROM job_request jr 
									inner join job_request_line jrl 
									on jrl.jr_id = jr.id

									INNER JOIN office o 
									ON o.id = jr.office_id
									left join users us
									on us.id = jr.requested_by
									WHERE jrl.request_status != 'Cancelled' and jrl.request_status = 'Pending'
									order by jrl.request_status desc");

			foreach($q->result() as $r) 
			{
				$btn = "";
				$a = $this->db->query("SELECT TOP 1 concat(u.lname, ', ', u.fname) name, u.id, coalesce((SELECT approval_status FROM job_request_line_approval WHERE STATUS = 1 AND job_request_line_id = $r->id and approver = u.id),2) status 
										
										FROM approver a 
										INNER JOIN users u 
										ON u.id = a.userid
										WHERE trans = 'JR' AND a.status = 1 AND u.id 
										NOT IN (SELECT approver FROM job_request_line_approval WHERE STATUS = 1 AND approval_status = 1 AND job_request_line_id = $r->id)");
  
				$ac = $this->validation_model->access(1, 'AJR');
				$val = explode('/', $ac[0]);
				$r_ = $val[1];
				$w_ = $val[2];

				$name = '"'.$r->item_desc.'"';
				if(isset($a->result()[0]->id))
				($w_ == 1 && $this->session->userdata('USERID') == $a->result()[0]->id && $a->result()[0]->status != 0 && ($r->request_status == "" || $r->request_status == 'Pending'))?$btn = "<table style='margin:0px'><tr><td><center><button class='btn-success btn-xs '  data-tooltip='Approve Request' onclick='approve_(".$r->id.",".$name.")'> 
		                         <i class='fa fa-check'></i>
		                         <span></span></button></td><td style='padding-left:2px'>
		                         <button class='btn-danger btn-xs '  data-tooltip='Disapprove Request' onclick='disapprove_(".$r->id.",".$name.")'> 
		                         <i class='fa fa-times''></i>
		                         <span></span></button>
			                     </center></td></tr></table>":$btn = "";
			    $status = "";		
			     if($a->num_rows() > 0)
			    	if($a->result()[0]->status == 2 || $a->result()[0]->status == 1)
			    		$status = "Pending approval of ".$a->result()[0]->name;
			    	else if($a->result()[0]->status == 0)
			    		$status = $a->result()[0]->name." disapproved this request.";	
			 	$wf = "<center><button class='btn-common btn-xs' data-tooltip='View Workflow' onclick='wf_(".$r->id.",".$name.")'> 
		                         <i class='fa fa-arrow-right'></i>
		                         <span></span></button>
			                     </center>";
			
			    ($btn == "");
							$result[] = array(
						    $r->jr_id,
							$r->office,
							$r->requested_item,
							$r->unit,
							$r->qty,
							$r->unit_cost,
							$r->purpose,
							$r->date_requested,
							$status,
							'<table style="margin:0px"><tr><td>'.$wf.'</td><td>'.$btn.'</td></tr></table>'
							);
			}
		}

		if($act == 'wf')
		{
			$data = array();
			$id = $this->security->xss_clean($input['id']);

			$a = $this->db->query("SELECT concat(u.lname, ', ', u.fname) name, u.id,
									coalesce((SELECT TOP 1 approval_status FROM job_request_line_approval WHERE STATUS = 1 AND approver = u.id AND job_request_line_id = ? order by id desc),2) approval_status
									FROM approver a 
									INNER JOIN users u 
									ON u.id = a.userid
									WHERE trans = 'JR' AND a.status = 1
									order by heirarchy", $id);
			foreach($a->result() as $r)
			$data[] = array(
				$r->id,
				$r->name,
				$r->approval_status);

			$result = array('mes' => 'Success', 'data' => $data);
			
		}
		return $result;
    }
}
?>

