<!DOCTYPE html>
<html>
<head>
	<title>Inventory Report</title>
	<style type="text/css">
		body{
			
			font-size: 12px;
			font-style: normal;
			font-weight: 500;
			line-height: 13.2px;
		}

		.pb {
			page-break-before: always;
		}
	</style>
</head>
<body style="font-family: 'Source Sans Pro','Segoe UI','Droid Sans',Tahoma,Arial,sans-serif;">
	<table width="100%">
	<tr>
		<td>
			<b>Inventory Report</b>
		</td>
		<td style="text-align:right">
			<b><i>Page 1</i></b>
		</td>
	</tr>
	</table>
	<table width="100%" style="margin-top:5px;border-top: 1px solid;border-bottom: 1px solid; padding:0px; line-height:15px">
		<tr style="border-bottom:1px solid">
		<?php if(in_array('item_no', $columns)){?>
			<td width="2%" style="text-align:center; border-bottom:1px solid">
				<b>#</b>
			</td>
		<?php }?>
		<?php if(in_array('id', $columns)){?>
			<td width="8%" style="text-align:center; border-bottom:1px solid">
				<b>Item ID</b>
			</td>
		<?php }?>
		<?php if(in_array('product', $columns)){?>
			<td width="10%" style="text-align:center; border-bottom:1px solid">
				<b>Item</b>
			</td>
		<?php }?>
		<?php if(in_array('unit_price', $columns)){?>
			<td width="10%" style="text-align:center; border-bottom:1px solid">
				<b>Unit Price</b>
			</td>
		<?php }?>
		<?php if(in_array('current_stock', $columns)){?>
			<td width="10%" style="text-align:center; border-bottom:1px solid">
				<b>Current Stock</b>
			</td>
		<?php }?>
		<?php if(in_array('critical_level', $columns)){?>
			<td width="5%" style="text-align:center; border-bottom:1px solid">
				<b>Critical Level</b>
			</td>
		<?php }?>
		
		<?php if(in_array('purchase_order', $columns)){?>
			<td width="10%" style="text-align:center; border-bottom:1px solid">
				<b>Pending P.O.</b>
			</td>
		<?php }?>
		<?php if(in_array('date_updated', $columns)){?>
			<td width="10%" style="text-align:center; border-bottom:1px solid">
				<b>Date Updated</b>
			</td>
		<?php }?>
		<?php if(in_array('updated_by', $columns)){?>
			<td width="10%" style="text-align:center; border-bottom:1px solid">
				<b>Updated By</b>
			</td>
		<?php }?>
		</tr>
		<?php
			$ctr = 0; 
			$no = 1;
			$page = 2;
			foreach($product as $r)
			{
				$ctr++;
				echo '<tr>';
				if(in_array('item_no', $columns))
					echo '<td>'.$no.'</td>';
				if(in_array('id', $columns))
					echo '<td style="text-align:center">'.$r['id'].'</td>';
				if(in_array('product', $columns))
					echo '<td>'.$r['description'].'</td>';
				if(in_array('unit_price', $columns))
					echo '<td style="text-align:right">'.$r['unit_price'].'</td>';
				if(in_array('current_stock', $columns))
					echo '<td style="text-align:center">'.$r['current_stock'].'</td>';
				if(in_array('critical_level', $columns))
					echo '<td style="text-align:center">'.$r['critical_level'].'</td>';
				if(in_array('purchase_order', $columns))
					echo '<td style="text-align:center">'.$r['purchase_order'].'</td>';
				if(in_array('date_updated', $columns))
					echo '<td>'.$r['date_updated'].'</td>';
				if(in_array('updated_by', $columns))
					echo '<td>'.$r['updated_by'].'</td>';
				echo '</tr>';

				if($ctr == 35)
				{
					 echo '</table>
					 	<table width="100%" class="pb">
						<tr>
							<td>
								<b>Inventory Report</b>
							</td>
							<td style="text-align:right">
								<b><i>Page '.$page.'</i></b>
							</td>
						</tr>
						</table>
						<table width="100%" style="margin-top:5px;border-top: 1px solid;border-bottom: 1px solid; padding:0px; line-height:15px">
						<tr style="border-bottom:1px solid">';
						$page++;
					 if(in_array('item_no', $columns)){
						echo '<td width="2%" style="text-align:center; border-bottom:1px solid">
							<b>#</b>
						</td>';
					 }
					 if(in_array('id', $columns)){
						echo '<td width="8%" style="text-align:center; border-bottom:1px solid">
							<b>Item ID</b>
						</td>';
					 }
					 if(in_array('product', $columns)){
						echo '<td width="10%" style="text-align:center; border-bottom:1px solid">
							<b>Item</b>
						</td>';
					 }
					 if(in_array('current_stock', $columns)){
						echo '<td width="10%" style="text-align:center; border-bottom:1px solid">
							<b>Current Stock</b>
						</td>';
					 }
					 if(in_array('critical_level', $columns)){
						echo '<td width="5%" style="text-align:center; border-bottom:1px solid">
							<b>Critical Level</b>
						</td>';
					 }
					
					 if(in_array('purchase_order', $columns)){
						echo '<td width="10%" style="text-align:center; border-bottom:1px solid">
							<b>Pending P.O.</b>
						</td>';
					 }
					 if(in_array('date_updated', $columns)){
						echo '<td width="10%" style="text-align:center; border-bottom:1px solid">
							<b>Date Updated</b>
						</td>';
					  }
					if(in_array('updated_by', $columns)){
						echo '<td width="10%" style="text-align:center; border-bottom:1px solid">
							<b>Updated By</b>
						</td>';
					 }
					echo '</tr>';
					$ctr = 0;
				}
				$no++;
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