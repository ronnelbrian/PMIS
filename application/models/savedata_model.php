<?php

class savedata_model extends CI_Model{

    public function audit_trail($act){
		 $data = array(
                'action' => $act,
                'userid' => $this->session->userdata('USERID'),
                'username' => $this->session->userdata('USERNAME')
          );

         $this->db->insert('audit_trail', $data);
         // return 'Success';
	}

	public function notifApprover($id, $requested_by = 0)
	{
		$q = $this->db->query("SELECT * from (SELECT CONCAT(u.lname, ', ', u.fname) NAME, u.id,
									COALESCE((SELECT TOP 1 approval_status FROM request_line_approval WHERE STATUS = 1 AND approver = u.id AND request_item_line_id = ? ORDER BY id DESC),2) approval_status
									FROM approver a 
									INNER JOIN users u 
									ON u.id = a.userid
									WHERE trans = 'IR' AND a.status = 1) tbl
									where tbl.approval_status = 2", $id);
		$d = $this->db->query("SELECT CONCAT(ril.unit,' ',u.code,' ','of',' ',p.description) details FROM request_item_line ril 
									INNER JOIN product p 
									ON p.id = ril.product
									INNER JOIN units u 
									ON u.id = p.measurement
									WHERE ril.id = ?", $id);
		if($requested_by == 0)
			$content = $this->session->userdata('NAME')." requested ".$d->result()[0]->details." that requires your approval.";
		else
		{
			$q2 = $this->db->query("SELECT CONCAT(u.lname, ' ', u.fname) requested_by 
									FROM request_item_line ril
									INNER JOIN request_item ri 
									ON ri.id = ril.request_item_id 
									INNER JOIN users u 
									ON u.id = ri.requested_by
									WHERE ril.id = ?", $id);
			$content = $q2->result()[0]->requested_by." requested ".$d->result()[0]->details." that requires your approval.";
		}
		$this->db->insert('notifications', array('userid' => $q->result()[0]->id, 'title' => 'Item Request', 'content' => $content, 'date_added' => date('Y-m-d H:i:s')));

	}

	public function user_roles($input = array())
	{
		if($input['act'] == 'add' || $input['act'] == 'save')
			$desc = $this->security->xss_clean($input['desc']);

		if($input['act'] == 'delete' || $input['act'] == 'save')
			$id = $this->security->xss_clean($input['id']);

		if($input['act'] == 'add')
		{
			$this->db->insert('role', array('description' => $desc, 'added_by' => $this->session->userdata('USERID')));
			$this->audit_trail('Add User Role '.$this->db->insert_id());
		}
		else if($input['act'] == 'save')
		{
			$this->db->where('id', $id);
			$this->db->update('role',array('description' => $desc, 'updated_by' => $this->session->userdata('USERID'), 'date_updated' => date('Y-m-d h:i:s')));
			$this->audit_trail('Update User Role '.$id." to ".$desc);
		}
		else if($input['act'] == 'delete')
		{
			$this->db->where('id', $id);
			$this->db->update('role',array('status' => 0, 'updated_by' => $this->session->userdata('USERID'), 'date_updated' => date('Y-m-d h:i:s')));
			$this->audit_trail('Delete User Role '.$id);
		}

		return array('mes' => 'Success');
	}

	public function system_users($input = array(), $f)
	{
		if($input['act'] == 'add' || $input['act'] == 'save')
		{
			if($input['pass'] != $input['confirmpass'])
				return array('mes' => 'Please confirm your password correctly.');
			$fname = $this->security->xss_clean($input['fname']);
			$mname = $this->security->xss_clean($input['mname']);
			$lname = $this->security->xss_clean($input['lname']);
			$suffix = $this->security->xss_clean($input['suffix']);
			$role = $this->security->xss_clean($input['role']);
			$gender = $this->security->xss_clean($input['gender']);
			$address = $this->security->xss_clean($input['address']);
			$bplace = $this->security->xss_clean($input['bplace']);
			$bday = $this->security->xss_clean($input['bday']);
			$username = $this->security->xss_clean($input['username']);
			$password = $this->security->xss_clean(sha1(md5($input['pass'])));

			$data = array(
				'fname' => $fname,
				'mname' => $mname,
				'lname' => $lname,
				'suffix' => $suffix,
				'role' => $role,
				'gender' => $gender,
				'address' => $address,
				'bplace' => $bplace,
				'bday' => $bday,
				'image_path' => $f,
				'username' => $username,
				'password' => $password);
		}

		if($input['act'] == 'delete' || $input['act'] == 'save')
			$id = $this->security->xss_clean($input['id']);

		if($input['act'] == 'add')
		{
			$this->db->insert('users', $data);
			$this->audit_trail('Add User '.$this->db->insert_id());
		}
		else if($input['act'] == 'save')
		{
			if($f == '')
			{
				$qf = $this->db->query("SELECT image_path from users where id = ?", $id);
				$f = $qf->result()[0]->image_path;
			}

			($password != "")?
				$data = array(
					'fname' => $fname,
					'mname' => $mname,
					'lname' => $lname,
					'suffix' => $suffix,
					'role' => $role,
					'gender' => $gender,
					'address' => $address,
					'bplace' => $bplace,
					'bday' => $bday,
					'image_path' => $f,
					'username' => $username,
					'password' => $password):
				$data = array(
					'fname' => $fname,
					'mname' => $mname,
					'lname' => $lname,
					'suffix' => $suffix,
					'role' => $role,
					'gender' => $gender,
					'address' => $address,
					'bplace' => $bplace,
					'bday' => $bday,
					'image_path' => $f,
					'username' => $username);

			$this->db->where('id', $id);
			$this->db->update('users',$data);
			$this->audit_trail('Update User '.$id." to ".json_encode($data));
		}
		else if($input['act'] == 'delete')
		{
			$this->db->where('id', $id);
			$this->db->update('users',array('status' => 0, 'updated_by' => $this->session->userdata('USERID'), 'date_updated' => date('Y-m-d h:i:s')));
			$this->audit_trail('Delete User '.$id);
		}

		return array('mes' => 'Success');
	}

	public function access_control($input = array())
	{
		$id = $this->security->xss_clean($_POST['id']);
		$val = $this->security->xss_clean($_POST['val']);
		$trans = $this->security->xss_clean($_POST['tid']);

		if($_POST['act'] == 'u_r')
		{
			$q = $this->db->query("SELECT * from access_control where userid = ? and trans = ?", array($id, $trans));
			
			$data = array(
				'userid' => $id,
				'trans' => $trans,
				'ac_read' => ($val == 'true')?1:0);

			if($q->num_rows() == 0)
			{
				$this->db->insert('access_control', $data);
				$this->audit_trail('Add Access Control '.$this->db->insert_id());
			}
			else
			{
				$this->db->where('userid', $id);
				$this->db->where('trans', $trans);
				$this->db->update('access_control',$data);
				$this->audit_trail('Update Access Control '.$id.' to '. json_encode($data));
			}
		}
		else if($_POST['act'] == 'u_w')
		{
			$q = $this->db->query("SELECT * from access_control where userid = ? and trans = ?", array($id, $trans));
			
			$data = array(
				'userid' => $id,
				'trans' => $trans,
				'ac_write' => ($val == 'true')?1:0);

			if($q->num_rows() == 0)
			{
				$this->db->insert('access_control', $data);
				$this->audit_trail('Add Access Control '.$this->db->insert_id());
			}
			else
			{
				$this->db->where('userid', $id);
				$this->db->where('trans', $trans);
				$this->db->update('access_control',$data);
				$this->audit_trail('Update Access Control '.$id.' to '. json_encode($data));
			}
		}

		return 'Success';
	}

	public function units_of_measurement($input = array())
	{
		if($input['act'] == 'add' || $input['act'] == 'save')
		{
			$desc = $this->security->xss_clean($input['desc']);
			$code = $this->security->xss_clean($input['code']);
		}

		if($input['act'] == 'delete' || $input['act'] == 'save')
			$id = $this->security->xss_clean($input['id']);

		if($input['act'] == 'add')
		{
			$this->db->insert('units', array('description' => $desc,'code' => $code, 'added_by' => $this->session->userdata('USERID'), 'date_updated' => date('Y-m-d h:i:s')));
			$this->audit_trail('Add Units '.$this->db->insert_id());
		}
		else if($input['act'] == 'save')
		{
			$this->db->where('id', $id);
			$this->db->update('units',array('description' => $desc, 'code' => $code, 'updated_by' => $this->session->userdata('USERID'), 'date_updated' => date('Y-m-d h:i:s')));
			$this->audit_trail('Update Units '.$id." to ".$desc);
		}
		else if($input['act'] == 'delete')
		{
			$this->db->where('id', $id);
			$this->db->update('units',array('status' => 0, 'updated_by' => $this->session->userdata('USERID')));
			$this->audit_trail('Delete Units '.$id);
		}

		return array('mes' => 'Success');
	}

	public function department_office($input = array())
	{
		if($input['act'] == 'add' || $input['act'] == 'save')
		{
			$name = $this->security->xss_clean($input['name']);
			$oic_name = $this->security->xss_clean($input['oic_name']);
			$code = $this->security->xss_clean($input['code']);
			$acronym = $this->security->xss_clean($input['acronym']);
			$division = $this->security->xss_clean($input['division']);
			($division == "")?$division = null:null;
		}

		if($input['act'] == 'delete' || $input['act'] == 'save')
			$id = $this->security->xss_clean($input['id']);

		if($input['act'] == 'add')
		{
			$this->db->insert('office', array('name' => $name,'oic_name' => $oic_name,'code' => $code,'acronym' => $acronym,'parent_id' => $division,  'added_by' => $this->session->userdata('USERID'), 'date_updated' => date('Y-m-d h:i:s')));
			$this->audit_trail('Add Office '.$this->db->insert_id());
		}
		else if($input['act'] == 'save')
		{
			$this->db->where('id', $id);
			$this->db->update('office',array('name' => $name, 'oic_name' => $oic_name, 'code' => $code,'acronym' => $acronym,'parent_id' => $division, 'updated_by' => $this->session->userdata('USERID'), 'date_updated' => date('Y-m-d h:i:s')));
			$this->audit_trail('Update Office '.$id." to ".$name);
		}
		else if($input['act'] == 'delete')
		{
			$this->db->where('id', $id);
			$this->db->update('office',array('status' => 0, 'updated_by' => $this->session->userdata('USERID'), 'date_updated' => date('Y-m-d h:i:s')));
			$this->audit_trail('Delete Office '.$id);
		}

		return array('mes' => 'Success');
	}

	public function billing_shipping_details($input = array())
	{
		
		$s_address = $this->security->xss_clean($input['s_address']);
		$s_telno = $this->security->xss_clean($input['s_telno']);
		$s_mobile = $this->security->xss_clean($input['s_mobile']);
		$s_company = $this->security->xss_clean($input['s_company']);

		$b_address = $this->security->xss_clean($input['b_address']);
		$b_telno = $this->security->xss_clean($input['b_telno']);
		$b_mobile = $this->security->xss_clean($input['b_mobile']);
		$b_company = $this->security->xss_clean($input['b_company']);

		if($input['act'] == 'add')
		{
			$this->db->query("update billing_shipping set status = ?, updated_by = ?, date_updated = ?",array('status' => 0, 'updated_by' => $this->session->userdata('USERID'), 'date_updated' => date('Y-m-d h:i:s')));

			$data = array(	's_address' => $s_address,
							's_telno' => $s_telno, 
							's_mobile' => $s_mobile, 
							's_company' => $s_company, 
							'b_address' => $b_address, 
							'b_telno' => $b_telno, 
							'b_mobile' => $b_mobile, 
							'b_company' => $b_company, 
							'added_by' => $this->session->userdata('USERID'));

			$this->db->insert('billing_shipping', $data);
			$this->audit_trail('Add Billing/Shipping '.$this->db->insert_id());
		}

		return array('mes' => 'Success');
	}

	public function product_category($input = array())
	{
		if($input['act'] == 'c')
		{
			$c_name = $this->security->xss_clean($input['c_name']);

			$this->db->insert('product_category', array('description' => $c_name, 'added_by' => $this->session->userdata('USERID')));
			$this->audit_trail('Add Product Category '.$this->db->insert_id());
		}
		else if($input['act'] == 'sc')
		{
			$sc_name = $this->security->xss_clean($input['sc_name']);
			$parent = $this->security->xss_clean($input['parent']);
			$master = $this->security->xss_clean($input['master']);

			$this->db->insert('product_category', array('description' => $sc_name, 'added_by' => $this->session->userdata('USERID'), 'master_id' => $master, 'parent_id' => $parent));
			$this->audit_trail('Add Product Sub-category '.$this->db->insert_id());
		}
		else if($input['act'] == 'delete')
		{
			$id = $this->security->xss_clean($input['id']);
			
			$this->db->where('id', $id);
			$this->db->update('product_category', array('status' => 0, 'updated_by' => $this->session->userdata('USERID'), 'date_updated' => date('Y-m-d h:i:s')));
			$this->audit_trail('Delete Product Category '.$id);

			$in = 1;
			while($in == 1)
			{
				$in = $this->delCategory($id);
			}
			
		}

		return array('mes' => 'Success');
	}

	public function property_category($input = array())
	{
		if($input['act'] == 'c')
		{
			$c_name = $this->security->xss_clean($input['c_name']);

			$this->db->insert('product_category', array('property' => 1, 'description' => $c_name, 'added_by' => $this->session->userdata('USERID')));
			$this->audit_trail('Add Product Category '.$this->db->insert_id());
		}
		else if($input['act'] == 'sc')
		{
			$sc_name = $this->security->xss_clean($input['sc_name']);
			$parent = $this->security->xss_clean($input['parent']);
			$master = $this->security->xss_clean($input['master']);

			$this->db->insert('product_category', array('property' => 1, 'description' => $sc_name, 'added_by' => $this->session->userdata('USERID'), 'master_id' => $master, 'parent_id' => $parent));
			$this->audit_trail('Add Product Sub-category '.$this->db->insert_id());
		}
		else if($input['act'] == 'delete')
		{
			$id = $this->security->xss_clean($input['id']);
			
			$this->db->where('id', $id);
			$this->db->update('product_category', array('status' => 0, 'updated_by' => $this->session->userdata('USERID'), 'date_updated' => date('Y-m-d h:i:s')));
			$this->audit_trail('Delete Product Category '.$id);

			$in = 1;
			while($in == 1)
			{
				$in = $this->delCategory($id);
			}
			
		}

		return array('mes' => 'Success');
	}

	public function delCategory($id)
	{
		$in = 1;
		$q = $this->db->query("SELECT id from product_category where parent_id = ?", $id);
		if($q->num_rows() > 0)
			foreach($q->result() as $r)
			{
				$in = $this->delCategory($r->id);
				$this->db->where('id', $r->id);
				$this->db->update('product_category', array('status' => 0, 'updated_by' => $this->session->userdata('USERID'), 'date_updated' => date('Y-m-d h:i:s')));
			}
		else $in = 0;
		return $in;

	}

	public function product($input = array())
	{
		if($input['act'] == 'add' || $input['act'] == 'save')
		{
		//	$description = $this->security->xss_clean($input['p_name']);
			$item = $this->security->xss_clean($input['item']);
			$measurement = $this->security->xss_clean($input['units']);
			$unit_price = $this->security->xss_clean($input['unit_price']);
			($unit_price == '')?$unit_price = 0:null;
			$critical_level = $this->security->xss_clean($input['critical']);
			$category_id = $this->security->xss_clean($input['category']);
			$type=$this->security->xss_clean($input['supply_type']);
		}

		if($input['act'] == 'delete' || $input['act'] == 'save')
			$id = $this->security->xss_clean($input['id']);

		if($input['act'] == 'add')
		{
			$this->db->insert('product',
			 array(
			 	'description' => $item,
			 	//'product_item_id'=>$item,
			 	'category_id' => $category_id, 
			 	'critical_level' => $critical_level,
			 	 'unit_price' => $unit_price,
			 	 'measurement' => $measurement, 
			 	  'added_by' => $this->session->userdata('USERID'),
			 	   'date_updated' => date('Y-m-d h:i:s'),
			 	   'types'=>$type
			 	   ));
			$productid = $this->db->insert_id();
			$this->db->insert('inventory', array('product' => $productid, 'current_stock' => 0, 'added_by' => $this->session->userdata('USERID')));
			$this->audit_trail('Add Product '.$productid);
			$this->audit_trail('Add Inventory '.$this->db->insert_id().' by adding a new product.');
		}
		else if($input['act'] == 'save')
		{
			$data = array('description' => $item,'category_id' => $category_id, 'critical_level' => $critical_level, 'unit_price' => $unit_price,'measurement' => $measurement,  'updated_by' => $this->session->userdata('USERID'), 'date_updated' => date('Y-m-d h:i:s'),'types'=>$type);
			$this->db->where('id', $id);
			$this->db->update('product',$data);
			$this->audit_trail('Update Product '.$id." to ".json_encode($data));
		}
		else if($input['act'] == 'delete')
		{
			$this->db->where('id', $id);
			$this->db->update('product',array('status' => 0, 'updated_by' => $this->session->userdata('USERID'), 'date_updated' => date('Y-m-d h:i:s')));
			$this->audit_trail('Delete Product '.$id);
		}
		else if($input['act']=='add_new_item'){

			$item_name=$this->security->xss_clean($input['new_item']);
			$this->db->insert('product_item',
				array(

					'item_name'=>$item_name,
					'date_added'=>date('Y-m-d h:i:s'),
					'added_by'=> $this->session->userdata('USERID')

					));
		}

		return array('mes' => 'Success');
	}

	public function property($input = array())
	{
		if($input['act'] == 'add' || $input['act'] == 'save')
		{
			$description = $this->security->xss_clean($input['p_name']);
			$measurement = $this->security->xss_clean($input['units']);
			$unit_price = $this->security->xss_clean($input['unit_price']);
			($unit_price == "")?$unit_price = 0:null;
			$category_id = $this->security->xss_clean($input['category']);
			$property_type=$this->security->xss_clean($input['property_type']);
		}

		if($input['act'] == 'delete' || $input['act'] == 'save')
			$id = $this->security->xss_clean($input['id']);

		if($input['act'] == 'add')
		{
			$this->db->insert(
				'product', array('property' => 1, 
					'description' => $description,
					'category_id' => $category_id,
					 'unit_price' => $unit_price,
					 'measurement' => $measurement, 
					  'added_by' => $this->session->userdata('USERID'),
					   'date_updated' => date('Y-m-d h:i:s'),
					   'types'=>$property_type
					   )
				);
			$productid = $this->db->insert_id();
			$this->db->insert('inventory', array('product' => $productid, 'current_stock' => 0, 'added_by' => $this->session->userdata('USERID')));
			$this->audit_trail('Add Product (Property) '.$productid);
			$this->audit_trail('Add Inventory '.$this->db->insert_id().' by adding a new product.');
		}
		else if($input['act'] == 'save')
		{
			$data = array('property' => 1, 'description' => $description,'category_id' => $category_id, 'unit_price' => $unit_price,'measurement' => $measurement,  'updated_by' => $this->session->userdata('USERID'), 'date_updated' => date('Y-m-d h:i:s'),'types'=>$property_type);
			$this->db->where('id', $id);
			$this->db->update('product',$data);
			$this->audit_trail('Update Product (Property) '.$id." to ".json_encode($data));
		}
		else if($input['act'] == 'delete')
		{
			$this->db->where('id', $id);
			$this->db->update('product',array('status' => 0, 'updated_by' => $this->session->userdata('USERID'), 'date_updated' => date('Y-m-d h:i:s')));
			$this->audit_trail('Delete Product (Property) '.$id);
		}

		return array('mes' => 'Success');
	}

	public function supplier_vendor($input = array())
	{
		if($input['act'] == 'add' || $input['act'] == 'save')
		{
			$supplier_name = $this->security->xss_clean($input['supplier_name']);
			$address = $this->security->xss_clean($input['address']);
			$contact_person = $this->security->xss_clean($input['contact_person']);
			$tel_no = $this->security->xss_clean($input['tel_no']);
			$tin_no = $this->security->xss_clean($input['tin_no']);
			$mobile = $this->security->xss_clean($input['mobile']);
			$service_desc = $this->security->xss_clean($input['service_desc']);
			$supplier_type = $this->security->xss_clean($input['supplier_type']);
			$product = $this->security->xss_clean($input['product']);
		}

		if($input['act'] == 'delete' || $input['act'] == 'save')
			$id = $this->security->xss_clean($input['id']);

		if($input['act'] == 'add')
		{
			$data = array('supplier_name' => $supplier_name,'address' => $address,'service_desc' => $service_desc,'supplier_type' => $supplier_type,'tin_no' => $tin_no, 'contact_person' => $contact_person,'tel_no' => $tel_no,'mobile' => $mobile,  'added_by' => $this->session->userdata('USERID'), 'date_updated' => date('Y-m-d h:i:s'));
			$this->db->insert('supplier', $data);
			$id = $this->db->insert_id();
			$this->audit_trail('Add Supplier '.$id);

			foreach($product as $r)
			{
				$this->db->insert('supplier_product', array('supplier_id' => $id,'product_id' => $r, 'added_by' => $this->session->userdata('USERID'), 'date_updated' => date('Y-m-d h:i:s')));
				$this->audit_trail('Add Supplier Product'.$this->db->insert_id());
			}
		}
		else if($input['act'] == 'save')
		{
			$data = array('supplier_name' => $supplier_name,'address' => $address,'service_desc' => $service_desc,'supplier_type' => $supplier_type,'tin_no' => $tin_no, 'contact_person' => $contact_person,'tel_no' => $tel_no,'mobile' => $mobile, 'updated_by' => $this->session->userdata('USERID'), 'date_updated' => date('Y-m-d h:i:s'));
			$this->db->where('id', $id);
			$this->db->update('supplier',$data);
			$this->audit_trail('Update Supplier '.$id." to ".json_encode($data));

			$this->db->where('supplier_id', $id);
			$this->db->update('supplier_product', array('status' => 0));

			foreach($product as $r)
			{
				$this->db->insert('supplier_product', array('supplier_id' => $id,'product_id' => $r, 'added_by' => $this->session->userdata('USERID'), 'date_updated' => date('Y-m-d h:i:s')));
				$this->audit_trail('Add Supplier Product'.$this->db->insert_id());
			}

		}
		else if($input['act'] == 'delete')
		{
			$this->db->where('id', $id);
			$this->db->update('supplier',array('status' => 0, 'updated_by' => $this->session->userdata('USERID'), 'date_updated' => date('Y-m-d h:i:s')));
			$this->audit_trail('Delete Supplier '.$id);
		}

		return array('mes' => 'Success');
	}

	public function approver($input = array())
	{
		if($input['act'] == 'add')
		{
			$approver = $this->security->xss_clean($input['approver']);
			$heirarchy = $this->security->xss_clean($input['heirarchy']);
			$trans = $this->security->xss_clean($input['trans']);
		}

		if($input['act'] == 'delete')
			$id = $this->security->xss_clean($input['id']);

		if($input['act'] == 'add')
		{
			$data = array('trans' => $trans,'userid' => $approver, 'heirarchy' => $heirarchy,'added_by' => $this->session->userdata('USERID'), 'date_updated' => date('Y-m-d h:i:s'));
			$this->db->insert('approver', $data);
			$id = $this->db->insert_id();
			$this->audit_trail('Add Approver '.$id);

		}
		else if($input['act'] == 'delete')
		{
			$this->db->where('id', $id);
			$this->db->update('approver',array('status' => 0, 'updated_by' => $this->session->userdata('USERID'), 'date_updated' => date('Y-m-d h:i:s')));
			$this->audit_trail('Delete Approver '.$id);
		}

		return array('mes' => 'Success');
	}

	public function item_requests($input = array())
	{
		if($input['act'] == 'delete'){
			$id = $this->security->xss_clean($input['id']);
		}
       
		if($input['act'] == 'add')
		{

			$office = $this->security->xss_clean($input['office']);
			$item = $this->security->xss_clean($input['item']);
			$unit = $this->security->xss_clean($input['unit']);
			$reason = $this->security->xss_clean($input['reason']);
			$fund_cluster = $this->security->xss_clean($input['fund_cluster']);
			

			$data = array(
				'office_id' => $office,
				'requested_by' => $this->session->userdata('USERID'),
				 'added_by' => $this->session->userdata('USERID'),
				 'date_requested' => date('Y-m-d h:i:s'),
				 'fund_cluster'=>$fund_cluster
				);

		
			$this->db->insert('request_item', $data);
			$id = $this->db->insert_id();
			$riid = $this->db->insert_id();
			
			
			$arr = 0;
			foreach($item as $i)
			{
				$data = array(
								'product' => $i,
							    'unit' => $unit[$arr],
								'reason' => $reason[$arr],
								'request_item_id' => $riid,
								'request_status' => 'Pending'
							     );

				$this->db->insert('request_item_line', $data);
				$id = $this->db->insert_id();
				$this->notifApprover($id);
				$arr++;
			}

			$this->audit_trail('Add Item Request '.$riid);

		}
		else if($input['act'] == 'delete')
		{
			$this->db->where('id', $id);
			$this->db->update('request_item_line',array('status' => 0,'request_status' => 'Cancelled', 'updated_by' => $this->session->userdata('USERID'), 'date_updated' => date('Y-m-d h:i:s')));
			$this->audit_trail('Delete Item Request '.$id);
		}

		return array('mes' => 'Success');
	}

	public function purchase_request($input = array())
	{
		if($input['act'] == 'add')
		{
			$office = $this->security->xss_clean($input['office']);
			$item = $this->security->xss_clean($input['item']);
			$unit = $this->security->xss_clean($input['unit']);
			$fund_cluster = $this->security->xss_clean($input['fund_cluster']);
			$qty = $this->security->xss_clean($input['qty']);
			$unit_cost = $this->security->xss_clean($input['unit_cost']);
			$total_cost = $this->security->xss_clean($input['total_cost']);
			$purpose = $this->security->xss_clean($input['purpose']);
		}

		if($input['act'] == 'delete')
			$id = $this->security->xss_clean($input['id']);

		if($input['act'] == 'add')
		{
			$data = array('office_id' => $office,'fund_cluster' => $fund_cluster,'requested_by' => $this->session->userdata('USERID'), 'added_by' => $this->session->userdata('USERID'));
			$this->db->insert('purchase_request', $data);
			$id = $this->db->insert_id();
			$prid = $this->db->insert_id();
			
			$arr = 0;
			foreach($item as $i)
			{
				$data = array(
				
					'unit' => $unit[$arr],
					'qty' => $qty[$arr],
					'unit_cost' => $unit_cost[$arr],
					'total_cost' => $total_cost[$arr],
					'purpose' => $purpose[$arr],
					 'pr_id' => $prid,
					 'added_by' => $this->session->userdata('USERID'),
					 'request_status' => 'Pending',
					 'product'=>$item[$arr]
					  );
				$this->db->insert('purchase_request_line', $data);
				$id = $this->db->insert_id();
				$this->notifApproverPR($id);
				$arr++;
			}

			$this->audit_trail('Add Purchase Request '.$prid);

		}
		else if($input['act'] == 'delete')
		{
			$this->db->where('id', $id);
			$this->db->update('purchase_request_line',array('request_status' => 'Cancelled', 'updated_by' => $this->session->userdata('USERID'), 'date_updated' => date('Y-m-d h:i:s')));
			$this->audit_trail('Delete Purchase Request '.$id);
		}

		return array('mes' => 'Success');
	}

	public function approve_item_requests($input = array())
	{
		$id = $this->security->xss_clean($input['id']);
		$liid = $this->security->xss_clean($input['id']);
		$message = "";

		if($input['act'] == 'approve')
		{
			$data = array(
				'request_item_line_id' => $id,
				'approver' => $this->session->userdata('USERID'),
				'added_by' => $this->session->userdata('USERID'),
				'approval_status' => 1);
			$this->db->insert('request_line_approval',$data);
			
			$ilid = $id;
			$id = $this->db->insert_id();

			$in  = 0;
			$a = $this->db->query("SELECT concat(u.lname, ', ', u.fname) name, u.id,
									coalesce((SELECT TOP 1 approval_status FROM request_line_approval WHERE STATUS = 1 AND approver = u.id AND request_item_line_id = ? order by id desc),2) approval_status
									FROM approver a 
									INNER JOIN users u 
									ON u.id = a.userid
									WHERE trans = 'IR' AND a.status = 1
									order by heirarchy", $ilid);

			foreach($a->result() as $r)
				if($r->approval_status == 0 || $r->approval_status == 1)
				{
					$in = 1;
					$this->notifApprover($liid, 1);
				}

			if($in == 0)
			{
				$p = $this->db->query("SELECT ril.product, ril.unit, ri.office_id from request_item_line ril inner join request_item ri on ri.id = ril.request_item_id where ril.id = ?", $ilid);

				$chk = 0;
				//Check if there is enough stock or not.
				$qty_requested = $p->result()[0]->unit;
				$check = $this->db->query("SELECT current_stock, p.description, p.property from inventory i inner join product p on p.id = i.product where i.product = ? and i.status = 1", $p->result()[0]->product);
				if($check->result()[0]->current_stock < $qty_requested)
				{
					$this->db->where('id', $id);
					$this->db->delete('request_line_approval');
					return array('mes' => 'There is no enough stock of '.$check->result()[0]->description.' in the inventory. The requested item/s cannot be released.');
				}

				$q_ = $this->db->query("SELECT SUM(total_amount) sum_ , (SELECT TOP 1 budget FROM office_budget WHERE office = ? AND STATUS = 1) budget
											FROM office_expense of_
											WHERE STATUS = 1 AND of_.office = ?", array($p->result()[0]->office_id,$p->result()[0]->office_id));
				{
					$qd = $this->db->query("SELECT office_id, product, unit qty FROM request_item ri 
										INNER JOIN request_item_line ril 
										ON ril.request_item_id = ri.id
										WHERE ril.id = ?",$liid);

					$prod_id = $qd->result()[0]->product;

					$q2 = $this->db->query("SELECT id, qty, price from inventory_price where product = ? and qty > 0 order by date_added asc", $prod_id);
					$temp_qty_requested = 0;
					$remaining = $qty_requested;
					$tot_amount = 0;
					foreach($q2->result() as $r)
					{
						if($qty_requested > $temp_qty_requested)
						{
							if($r->qty >= $remaining)
								$qty_taken = $remaining;
							else
								$qty_taken = $r->qty;

							$temp_qty_requested += $qty_taken;
							$remaining -= $qty_taken;

							$tot_amount+=($r->price*$qty_taken);
						}
					}
				}
				if(($q_->result()[0]->budget - $q_->result()[0]->sum_) < $tot_amount)
				{
					$this->db->where('id', $id);
					$this->db->delete('request_line_approval');
					return array('mes' => 'The office does not have enough budget to acquire the requested items. The requested item/s cannot be released.<br><br><b>Remaining Budget:</b> P '.number_format(($q_->result()[0]->budget - $q_->result()[0]->sum_),2).'<br><b>Total Cost of Requested Item:</b> P '.number_format($tot_amount,2));
				}


				//If there is, release the item
				date_default_timezone_set("Asia/Manila");
				$this->db->where('id', $ilid);
				$this->db->update('request_item_line', array('request_status' => 'Approved', 'remarks' => 'Item Released', 'released_by' => $this->session->userdata('USERID'), 'updated_by' => $this->session->userdata('USERID'), 'date_updated' => date('Y-m-d h:i:s')));

				//Update the Inventory
				$this->db->query("UPDATE inventory set old_stock = current_stock, current_stock = current_stock - ?, updated_by = ?, date_updated = GETDATE() where product = ? and status = 1", array($p->result()[0]->unit, $this->session->userdata('USERID'), $p->result()[0]->product));

				//Add to office's Expense
				$qd = $this->db->query("SELECT office_id, product, unit qty, ri.added_by 
										FROM request_item ri 
										INNER JOIN request_item_line ril 
										ON ril.request_item_id = ri.id
										WHERE ril.id = ?",$liid);

				$prod_id = $qd->result()[0]->product;

				$data =  array(
					'office' => $qd->result()[0]->office_id, 
					'product' => $prod_id, 
					'year_' => date('Y'),
					'requested_by' => $qd->result()[0]->added_by, 
					'added_by' => $this->session->userdata('USERID'));
				$this->db->insert('office_expense', $data);

				

				$id = $this->db->insert_id();
				$this->audit_trail('Add Office Expense '.$id);

				//Add Office Expense's line
				$q2 = $this->db->query("SELECT id, qty, price from inventory_price where product = ? and qty > 0 order by date_added asc", $prod_id);
				$temp_qty_requested = 0;
				$remaining = $qty_requested;
				$tot_amount = 0;
				foreach($q2->result() as $r)
				{
					if($qty_requested > $temp_qty_requested)
					{
						if($r->qty >= $remaining)
							$qty_taken = $remaining;
						else
							$qty_taken = $r->qty;

						$temp_qty_requested += $qty_taken;
						$remaining -= $qty_taken;

						$data = array(
							'office_expense_id' => $id,
							'qty' => $qty_taken,
							'unit_price' => $r->price,
							'added_by' => $this->session->userdata('USERID'));

						$this->db->insert('office_expense_line', $data);

						$temp_qty_taken = $qty_taken;
						while($temp_qty_taken != 0)
						{
							$q_prop = $this->db->query("SELECT property from product where id = ?", $prod_id);
							if($q_prop->result()[0]->property == 1)
								$this->db->insert('property_assignment', array('userid' => $qd->result()[0]->added_by, 'property_id' =>$prod_id, 
																			'unit_price' => $r->price,'item_request_line_id' => $liid, 'added_by' => $this->session->userdata('USERNAME')));
							$temp_qty_taken--;
						}
						$this->db->where('id', $r->id);
						$this->db->update('inventory_price', array('qty' => $r->qty-$qty_taken));

						$tot_amount+=($r->price*$qty_taken);

						$this->audit_trail('Add Office Expense Line '.$this->db->insert_id());


						$q_prop = $this->db->query("SELECT property from product where id = ?", $prod_id);
						if($q_prop->result()[0]->property == 1)
							$message = "Item Request has been successfully approved and released. The item/s has/have been added to Property Assignment. \n\nPlease proceed to property assignment to indicate the property Serial No. and additional remarks.";
					}
				}

				$this->db->where('id', $id);
				$this->db->update('office_expense', array('total_amount' => $tot_amount));
			}

			$this->audit_trail('Approve Item Request '.$id);			
		}
		else if($input['act'] == 'disapprove')
		{
			$remarks = $this->security->xss_clean($input['remarks']);

			$this->db->where('id', $id);
			$this->db->update('request_item_line', array('request_status' => 'Disapproved', 'remarks' => $remarks, 'updated_by' => $this->session->userdata('USERID'), 'date_updated' => date('Y-m-d h:i:s')));

			$q = $this->db->query("SELECT added_by from request_item ri inner join request_item_line ril on ril.request_item_id = ri.id where ril.id = ?", $id);
			$this->db->insert('notifications', array('userid' => $q->result()[0]->added_by, 'title' => 'Item Request Disapproved', 'content' => "Your item request has been disapproved. Please go to ITEM REQUESTS to check further details.", 'date_added' => date('Y-m-d H:i:s')));

			$data = array(
				'request_item_line_id' => $id,
				'approver' => $this->session->userdata('USERID'),
				'added_by' => $this->session->userdata('USERID'),
				'approval_status' => 0);
			
			$this->db->insert('request_line_approval',$data);
			$id = $this->db->insert_id();
			$this->audit_trail('Disapprove Item Request '.$id);

			
		}

		return array('mes' => 'Success', 'message' => $message);
	}

	public function purchase_order($input = array())
	{
		if($input['act'] == 'add')
		{
			$b_address = $this->security->xss_clean($input['b_address']);
			$b_company = $this->security->xss_clean($input['b_company']);
			$b_telno = $this->security->xss_clean($input['b_telno']);
			$b_mobile = $this->security->xss_clean($input['b_mobile']);

			$delivery_date = $this->security->xss_clean($input['delivery_date']);

			$s_address = $this->security->xss_clean($input['s_address']);
			$s_company = $this->security->xss_clean($input['s_company']);
			$s_telno = $this->security->xss_clean($input['s_telno']);
			$s_mobile = $this->security->xss_clean($input['s_mobile']);

			$supplier = $this->security->xss_clean($input['supplier']);
			$price = $this->security->xss_clean($input['price']);
			$unit = $this->security->xss_clean($input['unit']);
			$discount = $this->security->xss_clean($input['discount']);

			$item = $this->security->xss_clean($input['item']);

			$i = 0;
			$total = 0;
			foreach($price as $p)
			{
				$total+=$p*$unit[$i]-(($p*($discount[$i]/100))*$unit[$i]);
				$i++;
			}

			$data = array(
				'supplier_id' => $supplier,
				'added_by' => $this->session->userdata('USERNAME'),
				'added_by_id' => $this->session->userdata('USERID'),
				'total_price' => $total,
				'po_status' => 'New',
				'expected_delivery_date' => $delivery_date,
				'b_mobile' => $b_mobile,
				'b_address' => $b_address,
				'b_telno' => $b_telno,
				'b_company' => $b_company,
				's_company' => $s_company,
				's_address' => $s_address,
				's_telno' => $s_telno,
				's_mobile' => $s_mobile);
			$this->db->insert('purchase_order',$data);
			
			$poid = $this->db->insert_id();

			$i = 0;
			foreach($item as $r)
			{
				($discount[$i] == '')?$discount[$i] = 0:null;
				$data = array(
					'product' => $r,
					'added_by' => $this->session->userdata('USERNAME'),
					'unit_price' => $price[$i],
					'qty' => $unit[$i],
					'po_id' => $poid,
					'discount' => $discount[$i],
					'amount' => $price[$i]*$unit[$i]-($price[$i]*(($discount[$i]*$unit[$i])/100)));

				$this->db->insert('purchase_order_line',$data);

				$i++;
			}

			$this->audit_trail('Add Purchase Order '.$poid);

			
		}
		if($input['act'] == 'save')
		{
			$b_address = $this->security->xss_clean($input['b_address']);
			$b_company = $this->security->xss_clean($input['b_company']);
			$b_telno = $this->security->xss_clean($input['b_telno']);
			$b_mobile = $this->security->xss_clean($input['b_mobile']);

			$delivery_date = $this->security->xss_clean($input['delivery_date']);

			$s_address = $this->security->xss_clean($input['s_address']);
			$s_company = $this->security->xss_clean($input['s_company']);
			$s_telno = $this->security->xss_clean($input['s_telno']);
			$s_mobile = $this->security->xss_clean($input['s_mobile']);

			$supplier = $this->security->xss_clean($input['supplier']);
			$price = $this->security->xss_clean($input['price']);
			$unit = $this->security->xss_clean($input['unit']);
			$discount = $this->security->xss_clean($input['discount']);
			$item = $this->security->xss_clean($input['item']);

			$id = $this->security->xss_clean($input['id']);
			$i = 0;
			$total = 0;
			foreach($price as $p)
			{
				$total+=$p*$unit[$i]-(($p*($discount[$i]/100))*$unit[$i]);
				$i++;
			}

			$data = array(
				'supplier_id' => $supplier,
				'added_by' => $this->session->userdata('USERNAME'),
				'added_by_id' => $this->session->userdata('USERID'),
				'total_price' => $total,
				'po_status' => 'New',
				'expected_delivery_date' => $delivery_date,
				'b_mobile' => $b_mobile,
				'b_address' => $b_address,
				'b_telno' => $b_telno,
				'b_company' => $b_company,
				's_company' => $s_company,
				's_address' => $s_address,
				's_telno' => $s_telno,
				's_mobile' => $s_mobile,
				'po_status' => 'Changed Order');

			$this->db->where('id', $id);
			$this->db->update('purchase_order',$data);

			$this->db->where('po_id', $id);
			$this->db->update('purchase_order_line', array('status' => 0));

			$i = 0;
			foreach($item as $r)
			{
				$data = array(
					'product' => $r,
					'added_by' => $this->session->userdata('USERNAME'),
					'unit_price' => $price[$i],
					'qty' => $unit[$i],
					'po_id' => $id,
					'discount' => $discount[$i],
					'amount' => $price[$i]*$unit[$i]-(($price[$i]*($discount[$i]/100))*$unit[$i]));

				$this->db->insert('purchase_order_line',$data);

				$i++;
			}

			$this->audit_trail('Update Purchase Order '.$id);

			
		}
		if($input['act'] == 'delete')
		{
			$id = $this->security->xss_clean($input['id']);

			$this->db->where('id', $id);
			$this->db->update('purchase_order',array('po_status' => 'Cancelled'));

			$this->audit_trail('Cancel Purchase Order '.$id);
			
		}
		return array('mes' => 'Success');
	}


	public function delivery($input = array())
	{
		if($input['act'] == 'addDelivery')
		{
			$delivered_item = $this->security->xss_clean($input['delivered_item']);
			$returned_item = $this->security->xss_clean($input['returned_item']);
			$pol_id = $this->security->xss_clean($input['pol_id']);
			$remarks = $this->security->xss_clean($input['remarks']);
			$received_by = $this->security->xss_clean($input['received_by']);

			$actual_unit_price = $this->security->xss_clean($input['actual_unit_price']);
			$actual_discount = $this->security->xss_clean($input['actual_discount']);

			$actual_amount = (($delivered_item*$actual_unit_price)-(($delivered_item*$actual_unit_price)*($actual_discount/100)));

			if($delivered_item == "")
				return array('mes' => 'Please enter the no. of delivered item.');
			if($delivered_item == "")
				$returned_item = 0;
			if($pol_id == "")
				return array('mes' => 'There seem to be a problem with the form you just recently submitted. Please reload the page and try again.');

			$q = $this->getdata_model->delivery('loaddata', array('loadPOL' => 'loadPOL', 'id' => $pol_id));
			if(($q[0]['qty'] - $q[0]['accepted']) == 0)
				return array('mes' => 'This purchase order line item has received all its expected deliveries.');
			else if(($q[0]['qty'] - $q[0]['accepted']) < $delivered_item)
				return array('mes' => 'This purchase order line item only needs '.($q[0]['qty'] - $q[0]['accepted']).' delivered items to complete.');
			else if(($q[0]['qty'] - $q[0]['accepted']) >= $delivered_item)
			{
				$qp = $this->db->query("SELECT po_id, product from purchase_order_line where id = ?", $pol_id);
				$po_id = $qp->result()[0]->po_id;
				$qd = $this->db->query("SELECT (select sum(pol2.qty) from purchase_order_line pol2 where pol2.po_id = po.id) totalqty, SUM(d.qty_received) totaldelivered FROM purchase_order po
							INNER JOIN purchase_order_line pol 
							ON pol.po_id = po.id AND pol.status = 1
							LEFT JOIN delivery d 
							ON d.pol_id = pol.id AND d.status = 1
							WHERE po.id = ?
							GROUP by po.id", $po_id);

				// return array('mes' => $qd->result()[0]->totalqty.'=='.$qd->result()[0]->totaldelivered);
				($qd->result()[0]->totalqty == ($qd->result()[0]->totaldelivered+$delivered_item))?
					$po_status = 'Received':$po_status = 'Partially Received';

				$this->db->where('id', $po_id);
				$this->db->update('purchase_order', array('po_status' => $po_status));

				$this->db->query("INSERT INTO inventory_hist (product, current_stock, old_stock, added_by, remarks) (SELECT product, current_stock, old_stock, ?,? from inventory where product = ?)", array($this->session->userdata('USERNAME'), 'New Delivery',$q[0]['p_id']));
				$this->db->query("UPDATE inventory set old_stock = current_stock, current_stock = current_stock+?, updated_by = ?, date_updated = GETDATE() where product = ?", array(intval($delivered_item), $this->session->userdata('USERNAME'), $qp->result()[0]->product));


			}

			$data = array(
				'pol_id' => $pol_id,
				'added_by' => $this->session->userdata('USERNAME'),
				'qty_received' => $delivered_item,
				'qty_returned' => $returned_item,
				'product' => $q[0]['p_id'],
				'received_by' => $received_by,
				'actual_unit_price' => $actual_unit_price,
				'actual_discount' => $actual_discount,
				'actual_amount' => $actual_amount,
				'remarks' => $remarks);
			$this->db->insert('delivery',$data);

			$did = $this->db->insert_id();

			$this->db->insert('inventory_price', array('product' => $q[0]['p_id'], 'delivery_id' => $did, 'qty' => $delivered_item,'price' => $actual_amount/$delivered_item));

			$this->audit_trail('Add Delivery '.$did);
			
		}
		if($input['act'] == 'saveDelivery')
		{
			$delivered_item = $this->security->xss_clean($input['delivered_item']);
			$returned_item = $this->security->xss_clean($input['returned_item']);
			$pol_id = $this->security->xss_clean($input['pol_id']);
			$remarks = $this->security->xss_clean($input['remarks']);
			$received_by = $this->security->xss_clean($input['received_by']);
			$id = $this->security->xss_clean($input['d_id']);

			$actual_unit_price = $this->security->xss_clean($input['actual_unit_price']);
			$actual_discount = $this->security->xss_clean($input['actual_discount']);

			$actual_amount = (($delivered_item*$actual_unit_price)-(($delivered_item*$actual_unit_price)*($actual_discount/100)));

			$q = $this->getdata_model->delivery('loaddata', array('loadPOL' => 'loadPOL', 'id' => $pol_id, 'd_id' => $id));
			if(($q[0]['qty'] - $q[0]['accepted']) < $delivered_item)
				return array('mes' => 'This purchase order line item only needs '.($q[0]['qty'] - $q[0]['accepted']).' delivered items to complete.');

			$qdel = $this->db->query("SELECT qty_received from delivery where id = ?", $id);
			$diff = $delivered_item - $qdel->result()[0]->qty_received;

			$qp = $this->db->query("SELECT po_id, product from purchase_order_line where id = ?", $pol_id);
			$po_id = $qp->result()[0]->po_id;
			$qd = $this->db->query("SELECT SUM(pol.qty) totalqty, SUM(d.qty_received) totaldelivered FROM purchase_order po
						INNER JOIN purchase_order_line pol 
						ON pol.po_id = po.id AND pol.status = 1
						LEFT JOIN delivery d 
						ON d.pol_id = pol.id AND d.status = 1
						WHERE po.id = ?", $po_id);
			($qd->result()[0]->totalqty > $qd->result()[0]->totaldelivered)?
				$po_status = 'Partially Received':$po_status = 'Received';

			$this->db->where('id', $po_id);
			$this->db->update('purchase_order', array('po_status' => $po_status));

			$this->db->query("INSERT INTO inventory_hist (product, current_stock, old_stock, added_by, remarks) (SELECT product, current_stock, old_stock, ?,? from inventory where product = ?)", array($this->session->userdata('USERNAME'), 'Update Delivery',$q[0]['p_id']));
			if($diff >= 0)
				$this->db->query("UPDATE inventory set old_stock = current_stock, current_stock = current_stock+?, updated_by = ?, date_updated = GETDATE() where product = ?", array(intval($diff), $this->session->userdata('USERNAME'), $qp->result()[0]->product));
			else
				$this->db->query("UPDATE inventory set old_stock = current_stock, current_stock = current_stock-?, updated_by = ?, date_updated = GETDATE() where product = ?", array(intval($diff), $this->session->userdata('USERNAME'), $qp->result()[0]->product));

			$data = array(
				'pol_id' => $pol_id,
				'updated_by' => $this->session->userdata('USERNAME'),
				'date_updated' => date('Y-m-d'),
				'qty_received' => $delivered_item,
				'qty_returned' => $returned_item,
				'product' => $q[0]['p_id'],
				'received_by' => $received_by,
				'actual_unit_price' => $actual_unit_price,
				'actual_discount' => $actual_discount,
				'actual_amount' => $actual_amount,
				'remarks' => $remarks);

			$this->db->where('id', $id);
			$this->db->update('delivery',$data);

			$this->db->where('delivery_id', $id);
			$this->db->update('inventory_price', array('product' => $q[0]['p_id'], 'delivery_id' => $id, 'qty' => $delivered_item,'price' => $actual_amount/$delivered_item));

			$this->audit_trail('Update Delivery '.$id);
			
		}
		if($input['act'] == 'delete')
		{
			$id = $this->security->xss_clean($input['id']);

			$this->db->where('id', $id);
			$this->db->update('delivery',array('status' => 0));

			$qdel = $this->db->query("SELECT qty_received, pol_id from delivery where id = ?", $id);
			$diff = $qdel->result()[0]->qty_received;

			$pol_id = $qdel->result()[0]->pol_id;

			$qp = $this->db->query("SELECT po_id, product from purchase_order_line where id = ?", $pol_id);
			$po_id = $qp->result()[0]->po_id;
			$qd = $this->db->query("SELECT SUM(pol.qty) totalqty, SUM(d.qty_received) totaldelivered FROM purchase_order po
						INNER JOIN purchase_order_line pol 
						ON pol.po_id = po.id AND pol.status = 1
						LEFT JOIN delivery d 
						ON d.pol_id = pol.id AND d.status = 1
						WHERE po.id = ?", $po_id);
			($qd->result()[0]->totalqty > $qd->result()[0]->totaldelivered)?
				$po_status = 'Partially Received':$po_status = 'Received';

			$this->db->where('id', $po_id);
			$this->db->update('purchase_order', array('po_status' => $po_status));

			$this->db->query("INSERT INTO inventory_hist (product, current_stock, old_stock, added_by, remarks) (SELECT product, current_stock, old_stock, ?,? from inventory where product = ?)", array($this->session->userdata('USERNAME'), 'Deleted Delivery',$qp->result()[0]->product));
			
			$this->db->query("UPDATE inventory set old_stock = current_stock, current_stock = current_stock-?, updated_by = ?, date_updated = GETDATE() where product = ?", array(intval($diff), $this->session->userdata('USERNAME'), $qp->result()[0]->product));

			$this->db->where('id', $id);
			$this->db->update('delivery',array('status' => 0));

			$this->audit_trail('Delete Delivery '.$id);
			
		}
		if($input['act'] == 'outOfStock')
		{
			$id = $this->security->xss_clean($input['id']);

			$this->db->where('id', $id);
			$this->db->update('purchase_order_line', array('pol_status' => 'Closed'));

			$qp = $this->db->query("SELECT po_id, product from purchase_order_line where id = ?", $id);
			$po_id = $qp->result()[0]->po_id;

			$qd = $this->db->query("SELECT SUM(pol.qty) totalqty, SUM(d.qty_received) totaldelivered FROM purchase_order po
						INNER JOIN purchase_order_line pol 
						ON pol.po_id = po.id AND pol.status = 1 and pol_status = 'New'
						LEFT JOIN delivery d 
						ON d.pol_id = pol.id AND d.status = 1
						WHERE po.id = ?", $po_id);
			if(isset($qd->result()[0]->totalqty))
				($qd->result()[0]->totalqty > $qd->result()[0]->totaldelivered)?
					$po_status = 'Partially Received':$po_status = 'Received';
			else
				$po_status = 'Closed';

			$this->db->where('id', $po_id);
			$this->db->update('purchase_order', array('po_status' => $po_status));

			$this->audit_trail('Update Delivery '.$id.' data - '.json_encode(array('pol_status' => 'Closed')));
			
		}
		return array('mes' => 'Success');
	}

	public function notifications($input = array())
	{
		if($input['act'] == 'seen')
		{
			$id = $this->security->xss_clean($input['id']);
			$data = array('status' => 0, 'date_seen' => date('Y-m-d h:i:s'));
			$this->db->where('id', $id);
			$this->db->update('notifications',$data);
			$this->audit_trail('Update Notification '.$id." to ".json_encode($data));
		}
		
		return array('mes' => 'Success');
	}

	public function user_office_assignment($input = array())
	{
		if($input['act'] == 'add' || $input['act'] == 'save')
		{
			$user = $this->security->xss_clean($input['user']);
			$office = $this->security->xss_clean($input['office']);
		}

		if($input['act'] == 'delete' || $input['act'] == 'save')
			$id = $this->security->xss_clean($input['id']);

		if($input['act'] == 'add')
		{
			foreach($office as $r)
			{
				$data = array('userid' => $user, 'office' => $r, 'added_by' => $this->session->userdata('USERID'));
				$this->db->insert('user_office_assignment', $data);
				$id = $this->db->insert_id();
				$this->audit_trail('Add User/Office Assignment '.$id);
			}
		}
		else if($input['act'] == 'save')
		{
			$this->db->where('userid', $id);
			$this->db->update('user_office_assignment', array('status' => 0));

			foreach($office as $r)
			{
				$data = array('userid' => $user, 'office' => $r, 'added_by' => $this->session->userdata('USERID'));
			
				$this->db->insert('user_office_assignment', $data);
				$this->audit_trail('Update User/Office Assignment '.$id);
			}

		}
		else if($input['act'] == 'delete')
		{
			$this->db->where('userid', $id);
			$this->db->update('user_office_assignment',array('status' => 0, 'updated_by' => $this->session->userdata('USERID'), 'date_updated' => date('Y-m-d h:i:s')));
			$this->audit_trail('Delete User/Office Assignment USERID '.$id);
		}

		return array('mes' => 'Success');
	}

	public function budget_allocation($input = array())
	{
		if($input['act'] == 'add' || $input['act'] == 'save')
		{
			$budget = $this->security->xss_clean($input['budget']);
			$office = $this->security->xss_clean($input['office']);
			$year_ = $this->security->xss_clean($input['year_']);
		}

		if($input['act'] == 'delete' || $input['act'] == 'save')
			$id = $this->security->xss_clean($input['id']);

		if($input['act'] == 'add')
		{
			$data = array('budget' => $budget, 'office' => $office, 'year_budget' => $year_, 'added_by' => $this->session->userdata('USERID'));
			$this->db->insert('office_budget', $data);
			$id = $this->db->insert_id();
			$this->audit_trail('Add Office Budget '.$id);
		}
		else if($input['act'] == 'save')
		{
			$data = array('budget' => $budget, 'year_budget' => $year_, 'added_by' => $this->session->userdata('USERID'));
		
			$this->db->where('office', $office);
			$this->db->update('office_budget', $data);
			$this->audit_trail('Update Office Budget '.$id);
		}
		else if($input['act'] == 'delete')
		{
			$this->db->where('id', $id);
			$this->db->update('office_budget',array('status' => 0, 'updated_by' => $this->session->userdata('USERID'), 'date_updated' => date('Y-m-d h:i:s')));
			$this->audit_trail('Delete Office Budget '.$id);
		}

		return array('mes' => 'Success');
	}

	public function property_management($input = array())
	{
		if(isset($input['act']))
		{
			if($input['act'] == 'add')
			{
				$id = $this->security->xss_clean($input['p_id']);

				$user = $this->security->xss_clean($input['user']);
				$office = $this->security->xss_clean($input['office']);
				$property = $this->security->xss_clean($input['property']);

				$q = $this->db->query("SELECT * from property_assignment where id = ?", $id);

				$this->db->insert('property_assignment_history', array('pa_id'=> $id, 'unit_price' => $q->result()[0]->unit_price, 
										'property_id' => $q->result()[0]->property_id, 'remarks' => $q->result()[0]->remarks, 'property_code' => $q->result()[0]->property_code,
										'userid_from' => $q->result()[0]->userid, 'officeid_from' => $q->result()[0]->officeid, 'userid_to' => $user, 'officeid_to' => $office));

				$this->db->where('id', $id);
				$this->db->update('property_assignment', array('userid' => $user,'officeid' => $office, 'property_code' => $property, 'updated_by' => $this->session->userdata('USERID'), 'date_updated' => date('Y-m-d H:i:s')));
				$this->audit_trail('Update Property Assignment '.$this->db->insert_id());
			}
			else if($input['act'] == 'delete')
			{
				$id = $this->security->xss_clean($input['id']);
				$q = $this->db->query("SELECT * from property_assignment where id = ?", $id);

				$this->db->insert('property_assignment_history', array('pa_id'=> $id, 'unit_price' => $q->result()[0]->unit_price, 
										'property_id' => $q->result()[0]->property_id, 'remarks' => $q->result()[0]->remarks, 'property_code' => $q->result()[0]->property_code,
										'userid_from' => $q->result()[0]->userid, 'officeid_from' => $q->result()[0]->officeid));

				$this->db->query("UPDATE property_assignment set prev_userid = userid, prev_officeid = officeid, userid = NULL, officeid = NULL where id = ?", $id);
				$this->audit_trail('Update Property Assignment '.$id);
			}
		}
		if(isset($input['act2']))
		{
			$user = $this->security->xss_clean($input['n_employee']);
			$office = $this->security->xss_clean($input['n_office']);
			$property = $this->security->xss_clean($input['n_product']);
			$remarks = $this->security->xss_clean($input['n_remarks']);
			$property_code = $this->security->xss_clean($input['n_sn']);

			if($user == "" || $office == "" || $property == "")
				return array('mes' => 'Office, Employee and Item are required fields. Please review the form and try again.');

			$price = $this->db->query("SELECT id, price from inventory_price where qty > 0 and product = ? order by date_added asc", $property);
			$ip = $price->result()[0]->id;
			$data = array('userid' => $user,
				'property_id' => $property,
				'officeid' => $office,
				'unit_price' => $price->result()[0]->price,
				'remarks' => $remarks,
				'property_code' => $property_code,
				'added_by' => $this->session->userdata('USERID'));

			$this->db->insert('property_assignment', $data);

			$id = $this->db->insert_id();
			$this->db->insert('property_assignment_history', array('pa_id'=> $id, 'unit_price' => $price->result()[0]->price, 
									'property_id' => $property, 'remarks' => $remarks, 'property_code' => $property_code,
									'userid_from' => $user, 'officeid_from' => $office));

			$this->db->query("UPDATE inventory_price set qty = qty-1 where id = ?", $ip);

			$inventory = $this->db->query("SELECT * from inventory where product = ?", $property);
			$this->db->insert('inventory_hist', array('product' => $property, 'current_stock' => $inventory->result()[0]->current_stock, 'old_stock' => $inventory->result()[0]->old_stock, 'added_by' => $this->session->userdata('USERNAME'), 'remarks' => 'History prior deducting from inventory due by Property Assignment'));

			$this->db->query("UPDATE inventory set old_stock = current_stock, current_stock = current_stock-1, date_updated = GETDATE(), updated_by = ? where product = ?", array($this->session->userdata('USERNAME'), $property));

			$this->audit_trail('Add Property Assignment '.$id);
			
		}
		

		return array('mes' => 'Success');
	}
	public function stock_manual($input = array())
	{
		if($input['act'] == 'add' || $input['act'] == 'save')
		{
			$inventory = $this->security->xss_clean($input['inventory']);
			$item = $this->security->xss_clean($input['item']);
			$qty = $this->security->xss_clean($input['qty']);
			(isset($input['price']))? $price = $this->security->xss_clean($input['price']):$price = "";
			$remarks = $this->security->xss_clean($input['remarks']);

			if($input['act'] == 'save')
				$id = $this->security->xss_clean($input['id']);

			if($inventory != "")
			{
				$q = $this->db->query("SELECT price, qty from inventory_price where id = ?", $inventory);
				if(!isset($q->result()[0]->price))
					return array('mes' => "The item from the inventory you selected does not exist. Please reload the page and try again.");
				else if($qty <= 0 && $q->result()[0]->qty < abs($qty))
					return array('mes' => "The Quantity you are deducting from the inventory must no tbe greater than the qty of the item in the inventory.");
				else
					$price = $q->result()[0]->price;
			}
			else
				$inventory = null;

			if($input['act'] == 'add')
			{
				$data = array(
					'qty' => $qty,
					'product' => $item,
					'unit_price' => $price,
					'inventory_price_id' => $inventory,
					'remarks' => $remarks,
					'added_by' => $this->session->userdata('USERID'),
					'date_iv'=>date('Y-m-d'),
					'unit_issue'=>$qty 
					);

				$this->db->insert('manual_product_property', $data);
				$id = $this->db->insert_id();
			}
			else
			{
				$data = array(
					'qty' => $qty,
					'product' => $item,
					'unit_price' => $price,
					'inventory_price_id' => $inventory,
					'remarks' => $remarks,
					'date_updated' => date('Y-m-d'),
					'updated_by' => $this->session->userdata('USERID'),
					'unit_issue'=>$qty );
				$this->db->insert('manual_product_property', $data);
				$id = $this->db->insert_id();
			}

			if($inventory != "")
				$this->db->query("UPDATE inventory_price set qty = ?+qty where id = ?", array($qty, $inventory));
			else
			{
				$this->db->insert('inventory_price', array('product' => $item, 'qty' => $qty,'price' => $price));
			}

			$this->db->query("INSERT INTO inventory_hist (product, current_stock, old_stock, added_by, remarks) (SELECT product, current_stock, old_stock, ?,? from inventory where product = ?)", array($this->session->userdata('USERNAME'), 'Add/Deduct Stock Manually',$item));
			$this->db->query("UPDATE inventory set old_stock = current_stock, current_stock = ?+current_stock, date_updated = GETDATE(), updated_by = ?, date_iv=?,unit_of_issue=? where product = ?", array($qty, $this->session->userdata('USERID'),date('Y-m-d'),$qty, $item));

			$this->audit_trail('Add Stock Manually '.$id);
		}
		else if($input['act'] == 'delete')
		{
			$id = $this->security->xss_clean($input['id']);
			$q = $this->db->query("SELECT product, qty, inventory_price_id from manual_product_property where id = ?", $id);
			$inventory = $q->result()[0]->inventory_price_id;
			$qty = intval($q->result()[0]->qty);
			$item = $q->result()[0]->product;

			$this->db->where('id', $id);
			$this->db->update('manual_product_property', array('status' => 0, 'date_updated' => date('Y-m-d H:i:s'), 'updated_by' => $this->session->userdata('USERID')));
			
			if($inventory != "")
				($qty > -1)?
				$this->db->query("UPDATE inventory_price set qty = ABS(? - qty) where id = ?", array(abs($qty), $inventory)):
				$this->db->query("UPDATE inventory_price set qty = ABS(? + qty) where id = ?", array(abs($qty), $inventory));
			
			$this->db->query("INSERT INTO inventory_hist (product, current_stock, old_stock, added_by, remarks) (SELECT product, current_stock, old_stock, ?,? from inventory where product = ?)", array($this->session->userdata('USERNAME'), 'Add/Deduct Stock Manually',$item));
			($qty > -1)?
				$this->db->query("UPDATE inventory set old_stock = current_stock, current_stock = ABS(?-current_stock), date_updated = GETDATE(), updated_by = ? where product = ?", array(abs($qty), $this->session->userdata('USERID'), $item)):
				$this->db->query("UPDATE inventory set old_stock = current_stock, current_stock = ABS(?+current_stock), date_updated = GETDATE(), updated_by = ? where product = ?", array(abs($qty), $this->session->userdata('USERID'), $item));
			
			$this->audit_trail('Delete Stock Manually '.$id);
		}

		return array('mes' => 'Success');
	}
	
/*
if($input['act'] == 'disapprove')
		{
			$remarks = $this->security->xss_clean($input['remarks']);

			$this->db->where('id', $id);
			$this->db->update('request_item_line', array('request_status' => 'Disapproved', 'remarks' => $remarks, 'updated_by' => $this->session->userdata('USERID'), 'date_updated' => date('Y-m-d h:i:s')));

			$q = $this->db->query("SELECT added_by from request_item ri inner join request_item_line ril on ril.request_item_id = ri.id where ril.id = ?", $id);
			$this->db->insert('notifications', array('userid' => $q->result()[0]->added_by, 'title' => 'Item Request Disapproved', 'content' => "Your item request has been disapproved. Please go to ITEM REQUESTS to check further details.", 'date_added' => date('Y-m-d H:i:s')));

			$data = array(
				'request_item_line_id' => $id,
				'approver' => $this->session->userdata('USERID'),
				'added_by' => $this->session->userdata('USERID'),
				'approval_status' => 0);
			
			$this->db->insert('request_line_approval',$data);
			$id = $this->db->insert_id();
			$this->audit_trail('Disapprove Item Request '.$id);

			
		}

		return array('mes' => 'Success', 'message' => $message);
*/
	public function approve_purchase_requests($input = array()){
		$id = $this->security->xss_clean($input['id']);
		$liid = $this->security->xss_clean($input['id']);
		
		if($input['act']=='approve'){ 

			$data = array(
				'purchase_request_line_id' => $id,
				'approver' => $this->session->userdata('USERID'),
				'added_by' => $this->session->userdata('USERID'),
				'approval_status' => 1);
			$this->db->insert('purchase_request_line_approval',$data);

		

			$ilid = $id;
			$id = $this->db->insert_id();

			$in  = 0;
			$a = $this->db->query("SELECT concat(u.lname, ', ', u.fname) name, u.id,
									coalesce((SELECT TOP 1 approval_status FROM purchase_request_line_approval WHERE STATUS = 1 AND approver = u.id AND purchase_request_line_id = ? order by id desc),2) approval_status
									FROM approver a 
									INNER JOIN users u 
									ON u.id = a.userid
									WHERE trans = 'PR' AND a.status = 1
									order by heirarchy", $ilid);

			foreach($a->result() as $r){
				if($r->approval_status == 0 || $r->approval_status == 2)
				{
					$in = 1;
					$this->notifApproverPR($liid, 1);
				}
			}

		  if($in == 0){
			$this->db->where('id',$ilid);
			 $this->db->update('purchase_request_line',array('request_status'=>'Approved','updated_by'=>$this->session->userdata('USERID'),'date_updated'=>date('Y-m-d h:i:s')));
		
			$this->audit_trail('Approved Purchase Request '.$id);
	     	}
	    }
		if($input['act']=='disapprove'){
			$remarks = $this->security->xss_clean($input['remarks']);
			
			$this->db->where('id',$id);
			$this->db->update('purchase_request_line',array('request_status'=>'Disapproved','remarks'=>$remarks,'updated_by'=>$this->session->userdata('USERID'),'date_updated'=>date('Y-m-d h:i:s')));
            
            $q=$this->db->query("Select pr.added_by  from purchase_request as pr inner join purchase_request_line as prl on pr.id=prl.pr_id where prl.id=?",$id);

            $this->db->insert('notifications',
            	array('
            		userid' =>$q->result()[0]->added_by,
            		'title'=>'Purchase Request Disapproved',
            		'content'=>"Your Purchase Request has been disapproved. Please go to PURCHASE REQUESTS to check further details.",
            		'date_added'=>date('Y-m-d H:i:s')
            		));


            $data = array(
            	'purchase_request_line_id'=>$id,
            	'approver' => $this->session->userdata('USERID'),
				'added_by' => $this->session->userdata('USERID'),				
				'approval_status' => 0);
            	$this->db->insert('purchase_request_line_approval',$data);
			$id = $this->db->insert_id();
			$this->audit_trail('Disapprove Purchase Request '.$id);
		} return array('mes'=>'Success');
	}
	/*Approver Purchase*/

	public function notifApproverPR($id, $requested_by = 0)
	{
		$q = $this->db->query("SELECT * from (SELECT CONCAT(u.lname, ', ', u.fname) NAME, u.id,
									COALESCE((SELECT TOP 1 approval_status FROM purchase_request_line_approval WHERE STATUS = 1 AND approver = u.id AND purchase_request_line_id = ? ORDER BY id DESC),2) approval_status
									FROM approver a 
									INNER JOIN users u 
									ON u.id = a.userid
									WHERE trans = 'PR' AND a.status = 1) tbl
									where tbl.approval_status = 2", $id);
		$d = $this->db->query("SELECT CONCAT(ril.qty,' ',u.code,' ','of',' ',p.description) details FROM purchase_request_line ril 
									INNER JOIN product p 
									ON p.id = ril.product
									INNER JOIN units u 
									ON u.id = p.measurement
									WHERE ril.id = ?", $id);
		if($requested_by == 0)
			$content = $this->session->userdata('NAME')." requested ".$d->result()[0]->details." that requires your approval.";
		else
		{
			$q2 = $this->db->query("SELECT CONCAT(u.lname, ' ', u.fname) requested_by 
									FROM purchase_request_line ril
									INNER JOIN purchase_request ri 
									ON ri.id = ril.pr_id 
									INNER JOIN users u 
									ON u.id = ri.requested_by
									WHERE ril.id = ?", $id);
			$content = $q2->result()[0]->requested_by." requested ".$d->result()[0]->details." that requires your approval.";
		}
		$this->db->insert('notifications', array('userid' => $q->result()[0]->id, 'title' => 'Purchase Request', 'content' => $content, 'date_added' => date('Y-m-d H:i:s')));
	}

	// JERALD CODE
	public function purchase_request_to_po($input = array()){
		if($input['id'] == 'add')
		{

			$b_address = $this->security->xss_clean($input['b_address']);
			$b_company = $this->security->xss_clean($input['b_company']);
			$b_telno = $this->security->xss_clean($input['b_telno']);
			$b_mobile = $this->security->xss_clean($input['b_mobile']);

			$delivery_date = $this->security->xss_clean($input['delivery_date']);

			$s_address = $this->security->xss_clean($input['s_address']);
			$s_company = $this->security->xss_clean($input['s_company']);
			$s_telno = $this->security->xss_clean($input['s_telno']);
			$s_mobile = $this->security->xss_clean($input['s_mobile']);

			$supplier = $this->security->xss_clean($input['supplier']);
			$requested_item = $this->security->xss_clean($input['requested_item']);
			$requested_qty = $this->security->xss_clean($input['requested_qty']);
			$requested_unit = $this->security->xss_clean($input['requested_unit']);
			$requested_unit_price = $this->security->xss_clean($input['requested_unit_price']);
			$requested_item_discount = $this->security->xss_clean($input['requested_discount']);
			// $requested_item_discount = 0.00;
			$requested_total_amount = $this->security->xss_clean($input['requested_total_amount']);
			
			$requested_item_id=$this->security->xss_clean($input['request_item_id']);





			$data = array(
				'supplier_id' => $supplier,
				'added_by' => $this->session->userdata('USERNAME'),
				'added_by_id' => $this->session->userdata('USERID'),
				'total_price' => $requested_total_amount,
				'po_status' => 'New',
				'expected_delivery_date' => $delivery_date,
				'b_mobile' => $b_mobile,
				'b_address' => $b_address,
				'b_telno' => $b_telno,
				'b_company' => $b_company,
				's_company' => $s_company,
				's_address' => $s_address,
				's_telno' => $s_telno,
				's_mobile' => $s_mobile);
			$this->db->insert('purchase_order',$data);
			
			$poid = $this->db->insert_id();
			$data1=array(
					'product' => $requested_item_id, //product_id in the dropdown or accepted purchase_id request
					'added_by' => $this->session->userdata('USERNAME'),
					'unit_price' => $requested_unit_price,
					'qty' => $requested_qty,
					'po_id' => $poid,
					'discount' => $requested_item_discount,
					'amount' => $requested_total_amount
				//	'product_description' => $requested_item
				);
			$this->db->insert('purchase_order_line',$data1);
		} return array('mes'=>'Success');
	}


	public function furniture_request($input=array()){
		if($input['id']=='add'){

			$item=$this->security->xss_clean($input['item_desc']);
			$office_id=$this->security->xss_clean($input['office']);
		//	echo $office_id;die();
			$fund_cluster=$this->security->xss_clean($input['fund_cluster']);
			$qty=$this->security->xss_clean($input['qty']);
			$unit_cost=$this->security->xss_clean($input['unit_cost']);
		//wait!	$total_cost=$this->security->xss_clean($input['total_cost']);
			$purpose=$this->security->xss_clean($input['purpose']);
		    $units=$this->security->xss_clean($input['unit']);		
		     $data = array(
		     	'office_id' => $office_id,
		     	'fund_cluster' => $fund_cluster,
		     	'requested_by' => $this->session->userdata('USERID'),
		     	'date_added' =>date('Y-m-d h:i:s'),
		     	'added_by' => $this->session->userdata('USERID'));
			$this->db->insert('furniture_request', $data);
			$id = $this->db->insert_id();
			$frid = $this->db->insert_id();
			
            
			$ctr=0;
			foreach($item as $i){
				$items=array(
					'item_desc'=> $i,
					'qty'=> $qty[$ctr],
					'unit_cost'=>$unit_cost[$ctr],
					'total_cost'=>$total_cost=$unit_cost[$ctr]*$qty[$ctr],
					'purpose'=>$purpose[$ctr],
					'unit'=>$units[$ctr],
					'fr_id' => $frid,
					'added_by' => $this->session->userdata('USERID'),
					'date_added'=>date('Y-m-d h:i:s'),
					'request_status' => 'Pending',

					);
				$this->db->insert('furniture_request_line', $items);
				$id = $this->db->insert_id();
			$ctr++;
			}//lagay nalang sa db okay na

			$this->audit_trail('Add Furniture Request '.$frid);


		}

		return array('mes' => 'Success'); 
	}
	
		public function job_request($input = array()){

		if($input['id'] == 'add')
		{

			$item=$this->security->xss_clean($input['item_desc']);
			$office_id=$this->security->xss_clean($input['office']);
		//	echo $office_id;die();
			$fund_cluster=$this->security->xss_clean($input['fund_cluster']);
			$qty=$this->security->xss_clean($input['qty']);
			$unit_cost=$this->security->xss_clean($input['unit_cost']);
		//wait!	$total_cost=$this->security->xss_clean($input['total_cost']);
			$purpose=$this->security->xss_clean($input['purpose']);
		    $units=$this->security->xss_clean($input['unit']);		
		     $data = array(
		     	'office_id' => $office_id,
		     	'fund_cluster' => $fund_cluster,
		     	'requested_by' => $this->session->userdata('USERID'),
		     	'date_added' =>date('Y-m-d h:i:s'),
		     	'added_by' => $this->session->userdata('USERID'));
			$this->db->insert('job_request', $data);
			$id = $this->db->insert_id();
			$jrid = $this->db->insert_id();
			
            
			$ctr=0;
			foreach($item as $i){
				$items=array(
					'item_desc'=> $i,
					'qty'=> $qty[$ctr],
					'unit_cost'=>$unit_cost[$ctr],
					'total_cost'=>$total_cost=$unit_cost[$ctr]*$qty[$ctr],
					'purpose'=>$purpose[$ctr],
					'unit'=>$units[$ctr],
					'jr_id' => $jrid,
					'added_by' => $this->session->userdata('USERID'),
					'date_added'=>date('Y-m-d h:i:s'),
					'request_status' => 'Pending',

					);
				$this->db->insert('job_request_line', $items);
				$id = $this->db->insert_id();
			$ctr++;
			}//lagay nalang sa db okay na

			$this->audit_trail('Add Job Request '.$jrid);
		}
		return array('mes' => 'Success');

		
	}


	 public function job_order($input=array()){
	 	if($input['id']=='add'){
	 		$b_address=$this->security->xss_clean($input['b_address']);
	 		$b_company=$this->security->xss_clean($input['b_company']);
	 		$b_telno=$this->security->xss_clean($input['b_telno']);
			$b_mobile=$this->security->xss_clean($input['b_mobile']);	
			$s_company=$this->security->xss_clean($input['s_company']);
			$s_address=$this->security->xss_clean($input['s_address']);
			$s_telno=$this->security->xss_clean($input['s_telno']);
			$s_mobile=$this->security->xss_clean($input['s_mobile']);

			$supplier=$this->security->xss_clean($input['supplier']);
			$delivery_date=$this->security->xss_clean($input['delivery_date']);

			$item=$this->security->xss_clean($input['item']);
			$unit=$this->security->xss_clean($input['unit']);
			$price=$this->security->xss_clean($input['price']);
			$discount=$this->security->xss_clean($input['discount']);
			$purpose=$this->security->xss_clean($input['purpose']);
			
			$i = 0;
			$total = 0;
			foreach($price as $p)
			{
				$total+=$p*$unit[$i]-(($p*($discount[$i]/100))*$unit[$i]);
				$i++;
			}



		$data = array(
				'supplier_id' => $supplier,
				'added_by' => $this->session->userdata('USERNAME'),
				'added_by_id' => $this->session->userdata('USERID'),
				'total_price' => $total,
				'jo_status' => 'New',
				'expected_delivery_date' => $delivery_date,
				'b_mobile' => $b_mobile,
				'b_address' => $b_address,
				'b_telno' => $b_telno,
				'b_company' => $b_company,
				's_company' => $s_company,
				's_address' => $s_address,
				's_telno' => $s_telno,
				's_mobile' => $s_mobile,
				'date_added'=> date('Y-m-d'));
			$this->db->insert('job_order',$data);
			
			$joid = $this->db->insert_id();

			$i = 0;
			foreach($item as $r)
			{
				($discount[$i] == '')?$discount[$i] = 0:null;
				$data = array(
					'product' => $r,
					'added_by' => $this->session->userdata('USERNAME'),
					'unit_price' => $price[$i],
					'qty' => $unit[$i],
					'jo_id' => $joid,
					'date_added'=>date('Y-m-d'),
					'discount' => $discount[$i],
					'amount' => $price[$i]*$unit[$i]-($price[$i]*(($discount[$i]*$unit[$i])/100)));

				$this->db->insert('job_order_line',$data);

				$i++;
			}

			$this->audit_trail('Add Job Order '.$joid);



	 	}

	 	if($input['act'] == 'delete')
		{
			$id = $this->security->xss_clean($input['id']);

			$this->db->where('id', $id);
			$this->db->update('job_order',array('jo_status' => 'Cancelled'));

			$this->audit_trail('Cancel Job Order '.$id);
			
		}
	 		return array('mes' => 'Success');
	 }

	 public function furniture_order($input=array()){
	 	if($input['id']=='add'){
	 		$b_address=$this->security->xss_clean($input['b_address']);
	 		$b_company=$this->security->xss_clean($input['b_company']);
	 		$b_telno=$this->security->xss_clean($input['b_telno']);
			$b_mobile=$this->security->xss_clean($input['b_mobile']);	
			$s_company=$this->security->xss_clean($input['s_company']);
			$s_address=$this->security->xss_clean($input['s_address']);
			$s_telno=$this->security->xss_clean($input['s_telno']);
			$s_mobile=$this->security->xss_clean($input['s_mobile']);

			$supplier=$this->security->xss_clean($input['supplier']);
			$delivery_date=$this->security->xss_clean($input['delivery_date']);

			$item=$this->security->xss_clean($input['item']);
			$unit=$this->security->xss_clean($input['unit']);
			$price=$this->security->xss_clean($input['price']);
			$discount=$this->security->xss_clean($input['discount']);
			$purpose=$this->security->xss_clean($input['purpose']);
			
			$i = 0;
			$total = 0;
			foreach($price as $p)
			{
				$total+=$p*$unit[$i]-(($p*($discount[$i]/100))*$unit[$i]);
				$i++;
			}



		$data = array(
				'supplier_id' => $supplier,
				'added_by' => $this->session->userdata('USERNAME'),
				'added_by_id' => $this->session->userdata('USERID'),
				'total_price' => $total,
				'fo_status' => 'New',
				'expected_delivery_date' => $delivery_date,
				'b_mobile' => $b_mobile,
				'b_address' => $b_address,
				'b_telno' => $b_telno,
				'b_company' => $b_company,
				's_company' => $s_company,
				's_address' => $s_address,
				's_telno' => $s_telno,
				's_mobile' => $s_mobile,
				'date_added'=> date('Y-m-d'));
			$this->db->insert('furniture_order',$data);
			
			$foid = $this->db->insert_id();

			$i = 0;
			foreach($item as $r)
			{
				($discount[$i] == '')?$discount[$i] = 0:null;
				$data = array(
					'product' => $r,
					'added_by' => $this->session->userdata('USERNAME'),
					'unit_price' => $price[$i],
					'qty' => $unit[$i],
					'fo_id' => $foid,
					'date_added'=>date('Y-m-d'),
					'discount' => $discount[$i],
					'amount' => $price[$i]*$unit[$i]-($price[$i]*(($discount[$i]*$unit[$i])/100)));

				$this->db->insert('furniture_order_line',$data);

				$i++;
			}

			$this->audit_trail('Add Furniture Order '.$foid);



	 	}

	 	if($input['act'] == 'delete')
		{
			$id = $this->security->xss_clean($input['id']);

			$this->db->where('id', $id);
			$this->db->update('furniture_order',array('fo_status' => 'Cancelled'));

			$this->audit_trail('Cancel Furniture/Equipment Order '.$id);
			
		}
	 	return array('mes' => 'Success');
	 }

	 
	 

	 #############################################################
#															#
#				APPROVE FURNITURE REQUEST 					#
#															#
#	Created by : RBC 										#
# 	Date updated : 02/21/18									#
#############################################################
	public function approve_furniture_requests($input = array())
	{
		$id = $this->security->xss_clean($input['id']);
		$liid = $this->security->xss_clean($input['id']);

		/**************** APPROVE *****************/
		if($input['act']=='approve'){ 

			$data = array(
				'furniture_request_line_id' => $id,
				'approver' => $this->session->userdata('USERID'),
				'added_by' => $this->session->userdata('USERID'),
				'approval_status' => 1);
			$this->db->insert('furniture_request_line_approval',$data);

		

			$ilid = $id;
			$id = $this->db->insert_id();

			$in  = 0;
			$a = $this->db->query("SELECT concat(u.lname, ', ', u.fname) name, u.id,
									coalesce((SELECT TOP 1 approval_status FROM furniture_request_line_approval WHERE STATUS = 1 AND approver = u.id AND furniture_request_line_id = ? order by id desc),2) approval_status
									FROM approver a 
									INNER JOIN users u 
									ON u.id = a.userid
									WHERE trans = 'FER' AND a.status = 1
									order by heirarchy", $ilid);

			foreach($a->result() as $r){
				if($r->approval_status == 0 || $r->approval_status == 2)
				{
					$in = 1;
					$this->notifApproverFER($liid, 1);
				}
			}

		  if($in == 0){
			$this->db->where('id',$ilid);
			 $this->db->update('furniture_request_line',array('request_status'=>'Approved','updated_by'=>$this->session->userdata('USERID'),'date_updated'=>date('Y-m-d h:i:s')));
		
			$this->audit_trail('Approved Furniture/Equipment Request '.$id);
	     	}
	    }

	    /************** DISAPPROVE *****************/
		if($input['act']=='disapprove'){
			$remarks = $this->security->xss_clean($input['remarks']);
			
			$this->db->where('id',$id);
			$this->db->update('furniture_request_line',array('request_status'=>'Disapproved','remarks'=>$remarks,'updated_by'=>$this->session->userdata('USERID'),'date_updated'=>date('Y-m-d h:i:s')));
            
            $q=$this->db->query("Select fr.added_by  from furniture_request as fr inner join furniture_request_line as frl on fr.id=frl.fr_id where frl.id = ?",$id);

            $this->db->insert('notifications',
            	array('
            		userid' =>$q->result()[0]->added_by,
            		'title'=>'Furniture/Equipment Request Disapproved',
            		'content'=>"Your Furniture/Equipment Request has been disapproved. Please go to Furniture/Equipment REQUESTS to check further details.",
            		'date_added'=>date('Y-m-d H:i:s')
            		));


            $data = array(
            	'furniture_request_line_id'=>$id,
            	'approver' => $this->session->userdata('USERID'),
				'added_by' => $this->session->userdata('USERID'),				
				'approval_status' => 0);
            	$this->db->insert('furniture_request_line_approval',$data);
			$id = $this->db->insert_id();
			$this->audit_trail('Disapprove Furniture/Equipment Request '.$id);
		}
		return array('mes'=>'Success');
	}

	public function notifApproverFER($id, $requested_by = 0)
	{
		$q = $this->db->query("SELECT * from (SELECT CONCAT(u.lname, ', ', u.fname) NAME, u.id,
									COALESCE((SELECT TOP 1 approval_status FROM furniture_request_line_approval WHERE STATUS = 1 AND approver = u.id AND furniture_request_line_id = ? ORDER BY id DESC),2) approval_status
									FROM approver a 
									INNER JOIN users u 
									ON u.id = a.userid
									WHERE trans = 'FER' AND a.status = 1) tbl
									where tbl.approval_status = 2", $id);
		$d = $this->db->query("SELECT CONCAT(unit,' ',item_desc) details FROM furniture_request_line 
									WHERE id = ?", $id);
		if($requested_by == 0)
			$content = $this->session->userdata('NAME')." requested ".$d->result()[0]->details." that requires your approval.";
		else
		{
			$q2 = $this->db->query("SELECT CONCAT(u.lname, ' ', u.fname) requested_by 
									FROM furniture_request_line frl
									INNER JOIN furniture_request fr 
									ON fr.id = frl.fr_id 
									INNER JOIN users u 
									ON u.id = fr.requested_by
									WHERE frl.id = ?", $id);
			$content = $q2->result()[0]->requested_by." requested ".$d->result()[0]->details." that requires your approval.";
		}
		$this->db->insert('notifications', array('userid' => $q->result()[0]->id, 'title' => 'Furniture and Equipment Request', 'content' => $content, 'date_added' => date('Y-m-d H:i:s')));

	}

	#############################################################
#															#
#					APPROVE JOB REQUEST 					#
#															#
#	Created by : RBC 										#
# 	Date updated : 02/21/18									#
#############################################################
	public function approve_job_requests($input = array())
	{
		$id = $this->security->xss_clean($input['id']);
		$liid = $this->security->xss_clean($input['id']);

		/**************** APPROVE *****************/
		if($input['act']=='approve'){ 

			$data = array(
				'job_request_line_id' => $id,
				'approver' => $this->session->userdata('USERID'),
				'added_by' => $this->session->userdata('USERID'),
				'approval_status' => 1);
			$this->db->insert('job_request_line_approval',$data);

		

			$ilid = $id;
			$id = $this->db->insert_id();

			$in  = 0;
			$a = $this->db->query("SELECT concat(u.lname, ', ', u.fname) name, u.id,
									coalesce((SELECT TOP 1 approval_status FROM job_request_line_approval WHERE STATUS = 1 AND approver = u.id AND job_request_line_id = ? order by id desc),2) approval_status
									FROM approver a 
									INNER JOIN users u 
									ON u.id = a.userid
									WHERE trans = 'JR' AND a.status = 1
									order by heirarchy", $ilid);

			foreach($a->result() as $r){
				if($r->approval_status == 0 || $r->approval_status == 2)
				{
					$in = 1;
					$this->notifApproverJO($liid, 1);
				}
			}

		  if($in == 0){
			$this->db->where('id',$ilid);
			 $this->db->update('job_request_line',array('request_status'=>'Approved','updated_by'=>$this->session->userdata('USERID'),'date_updated'=>date('Y-m-d h:i:s')));
		
			$this->audit_trail('Approved Job Request '.$id);
	     	}
	    }

	    /************** DISAPPROVE *****************/
		if($input['act']=='disapprove'){
			$remarks = $this->security->xss_clean($input['remarks']);
			
			$this->db->where('id',$id);
			$this->db->update('job_request_line',array('request_status'=>'Disapproved','remarks'=>$remarks,'updated_by'=>$this->session->userdata('USERID'),'date_updated'=>date('Y-m-d h:i:s')));
            
            $q=$this->db->query("Select jr.added_by  from job_request as jr inner join job_request_line as jrl on jr.id=jrl.jr_id where jrl.id =?",$id);

            $this->db->insert('notifications',
            	array('
            		userid' =>$q->result()[0]->added_by,
            		'title'=>'Job Request Disapproved',
            		'content'=>"Your Job Request has been disapproved. Please go to JOB REQUESTS to check further details.",
            		'date_added'=>date('Y-m-d H:i:s')
            		));


            $data = array(
            	'job_request_line_id'=>$id,
            	'approver' => $this->session->userdata('USERID'),
				'added_by' => $this->session->userdata('USERID'),				
				'approval_status' => 0);
            	$this->db->insert('job_request_line_approval',$data);
			$id = $this->db->insert_id();
			$this->audit_trail('Disapprove Job Request '.$id);
		}
		return array('mes'=>'Success');
	}

	public function notifApproverJO($id, $requested_by = 0)
	{
		$q = $this->db->query("SELECT * from (SELECT CONCAT(u.lname, ', ', u.fname) NAME, u.id,
									COALESCE((SELECT TOP 1 approval_status FROM job_request_line_approval WHERE STATUS = 1 AND approver = u.id AND job_request_line_id = ? ORDER BY id DESC),2) approval_status
									FROM approver a 
									INNER JOIN users u 
									ON u.id = a.userid
									WHERE trans = 'JR' AND a.status = 1) tbl
									where tbl.approval_status = 2", $id);
		$d = $this->db->query("SELECT CONCAT(unit,' ',item_desc) details FROM job_request_line 
									WHERE id = ?", $id);
		if($requested_by == 0)
			$content = $this->session->userdata('NAME')." requested ".$d->result()[0]->details." that requires your approval.";
		else
		{
			$q2 = $this->db->query("SELECT CONCAT(u.lname, ' ', u.fname) requested_by 
									FROM job_request_line ril
									INNER JOIN job_request ri 
									ON ri.id = ril.jr_id 
									INNER JOIN users u 
									ON u.id = ri.requested_by
									WHERE ril.id = ?", $id);
			$content = $q2->result()[0]->requested_by." requested ".$d->result()[0]->details." that requires your approval.";
		}
		$this->db->insert('notifications', array('userid' => $q->result()[0]->id, 'title' => 'Job Request', 'content' => $content, 'date_added' => date('Y-m-d H:i:s')));

	}
}
?>