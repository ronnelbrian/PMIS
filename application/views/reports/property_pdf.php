<!DOCTYPE html>
<html>
<head>
	<title>Property</title>
	<style type="text/css">
		body{
			
			font-size: 12px;
			font-style: normal;
			font-weight: 500;
			line-height: 13.2px;
		}

		.pb {
			page-break-after: always;
		}
	</style>
</head>
<body style="font-family: 'Source Sans Pro','Segoe UI','Droid Sans',Tahoma,Arial,sans-serif;">
	<table width="100%">
	<tr>
		<td>
			<b>List of Property</b>
		</td>
	</tr>
	</table>
	<table width="100%" style="margin-top:5px;border-top: 1px solid;border-bottom: 1px solid; padding:0px; line-height:15px">
		<tr>
		<?php if(in_array('id', $columns)){?>
			<td width="8%" style="text-align:center;">
				<b>Item ID</b>
			</td>
		<?php }?>
		<?php if(in_array('description', $columns)){?>
			<td width="10%" style="text-align:center;">
				<b>Description</b>
			</td>
		<?php }?>
		<?php if(in_array('units', $columns)){?>
			<td width="5%" style="text-align:center;">
				<b>Units</b>
			</td>
		<?php }?>
		<?php if(in_array('property_code', $columns)){?>
			<td width="10%" style="text-align:center;">
				<b>Property Code</b>
			</td>
		<?php }?>
		<?php if(in_array('office', $columns)){?>
			<td width="10%" style="text-align:center;">
				<b>Office</b>
			</td>
		<?php }?>
		<?php if(in_array('employee', $columns)){?>
			<td width="10%" style="text-align:center;">
				<b>Employee</b>
			</td>
		<?php }?>
		<?php if(in_array('category', $columns)){?>
			<td width="20%" style="text-align:center;">
				<b>Category</b>
			</td>
		<?php }?>
		<?php if(in_array('date_added', $columns)){?>
			<td width="10%" style="text-align:center;">
				<b>Date Added</b>
			</td>
		<?php }?>
		<?php if(in_array('added_by', $columns)){?>
			<td width="10%" style="text-align:center;">
				<b>Added By</b>
			</td>
		<?php }?>
		</tr>
		<?php 
			foreach($property as $r)
			{
				echo '<tr>';
				if(in_array('id', $columns))
					echo '<td>'.$r['id'].'</td>';
				if(in_array('description', $columns))
					echo '<td>'.$r['description'].'</td>';
				if(in_array('units', $columns))
					echo '<td style="text-align:center">'.$r['code'].'</td>';
				if(in_array('property_code', $columns))
					echo '<td style="text-align:center">'.$r['property_code'].'</td>';
				if(in_array('office', $columns))
					echo '<td style="text-align:center">'.$r['office'].'</td>';
				if(in_array('employee', $columns))
					echo '<td style="text-align:center">'.$r['employee'].'</td>';
				if(in_array('category', $columns))
					echo '<td>'.$r['category'].'</td>';
				if(in_array('date_added', $columns))
					echo '<td>'.$r['date_added'].'</td>';
				if(in_array('added_by', $columns))
					echo '<td>'.$r['added_by'].'</td>';
				echo '</tr>';
			}
		?>
	</table>

	
	<div>
		<table style="border-top:0.5px solid" width="100%">
			<tr>
				<td>
					Printed on: <?php date_default_timezone_set('Asia/Manila'); echo date("F j, Y g:i a")."<br>/".$this->session->userdata('USERNAME')?>
				</td>
			</tr>
		</table>
			
	</div>

	
	

</body>
</html>