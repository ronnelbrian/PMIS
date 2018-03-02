<!DOCTYPE html>
<html>
<head>
	<title>Office Expense Report</title>
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
			<b>Office Expense Report</b>
		</td>
	</tr>
	</table>
	<table width="100%">
	<tr>
		<td style="width:125px">
			<b>Transaction Dates:</b>
		</td>
		<td style="">
			<?php echo strtoupper($dates[0]).' to '.strtoupper($dates[1]);?>
		</td>
	</tr>
	</table>
	<table width="100%" style="margin-top:5px;border-top: 1px solid;border-bottom: 1px solid; padding:0px; line-height:15px" id="tblExport">
		<tr style="border-bottom:1px solid">
		<?php if(in_array('item_no', $columns)){?>
			<td width="2%" style="text-align:center; border-bottom:1px solid">
				<b>#</b>
			</td>
		<?php }?>
		<?php if(in_array('id', $columns)){?>
			<td width="8%" style="text-align:center; border-bottom:1px solid">
				<b>ID</b>
			</td>
		<?php }?>
		<?php if(in_array('product', $columns)){?>
			<td width="10%" style="text-align:center; border-bottom:1px solid">
				<b>Item</b>
			</td>
		<?php }?>
		<?php if(in_array('office', $columns)){?>
			<td width="5%" style="text-align:center; border-bottom:1px solid">
				<b>Office</b>
			</td>
		<?php }?>
		
		<?php if(in_array('requested_by', $columns)){?>
			<td width="10%" style="text-align:center; border-bottom:1px solid">
				<b>Requested By</b>
			</td>
		<?php }?>
		<?php if(in_array('released_by', $columns)){?>
			<td width="10%" style="text-align:center; border-bottom:1px solid">
				<b>Released By</b>
			</td>
		<?php }?>
		<?php if(in_array('transaction_date', $columns)){?>
			<td width="10%" style="text-align:center; border-bottom:1px solid">
				<b>Transaction Date</b>
			</td>
		<?php }?>
		</tr>
		<?php
			$ctr = 0; 
			$no = 1;
			$page = 2;
			foreach($expense as $r)
			{
				$ctr++;
				echo '<tr>';
				if(in_array('item_no', $columns))
					echo '<td>'.$no.'</td>';
				if(in_array('id', $columns))
					echo '<td style="text-align:center">'.$r['id'].'</td>';
				if(in_array('product', $columns))
					echo '<td>'.$r['product'].'</td>';
				if(in_array('office', $columns))
					echo '<td style="text-align:center">'.$r['office'].'</td>';
				if(in_array('requested_by', $columns))
					echo '<td style="text-align:center">'.$r['requested_by'].'</td>';
				if(in_array('released_by', $columns))
					echo '<td style="text-align:center">'.$r['released_by'].'</td>';
				if(in_array('transaction_date', $columns))
					echo '<td style="text-align:center">'.$r['transaction_date'].'</td>';
				echo '</tr>';

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
	<script type='text/javascript' src='<?php echo base_url('assets')?>/js/jquery-1.10.2.min.js'></script> 
	<script type='text/javascript' src='<?php echo base_url('assets')?>/js/jqueryui-1.10.3.min.js'></script>
	<script type='text/javascript' src='<?php echo base_url('assets')?>/plugins/datatables/jquery.dataTables.min.js'></script> 
	<script type='text/javascript' src='<?php echo base_url('assets')?>/plugins/datatables/dataTables.bootstrap.js'></script> 
	<script type="text/javascript" src="<?php echo base_url('assets')?>/js/jquery.battatech.excelexport.js"></script>
	<script type="text/javascript">
	$("#tblExport").battatech_excelexport({
	        containerid: "tblExport"
	       , datatype: 'table'
	       , worksheetName: "Office Expense Report"
	});
	window.close();
	</script>
</body>
</html>