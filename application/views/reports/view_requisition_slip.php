<!DOCTYPE html>
<html>
<head>
	<title>Purchase Order</title>
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
		table, th, td {
		    border: 1px solid black;
		    border-collapse: collapse;
		}
		th, td {
		    padding: 10px;
		}
		 #page-border{
               width: 100%;
               height: 100%;
               
           }

	</style>
</head>
<body style="font-family: 'Source Sans Pro','Segoe UI','Droid Sans',Tahoma,Arial,sans-serif;">
	<caption>
	   <h3><b>REQUISITION AND ISSUE SLIP</b></h3>
	   	<u>MTRCB</u><br>
	  <b> Entity Name </b>
	</caption><br>
	<p >Fund Cluster:<?php echo $requested_item->fund_cluster; ?></p>
	<table width="100%">
	    <tr>
			<td colspan="5" style="text-align:left">
				Division: <b><?php echo $requested_item->office;?></b>	<br>
				Office: <?php echo $requested_item->office;?>			
		     </td>
		     <td colspan="3" style="text-align:left">
				Responsibility Center Code : <?php echo $requested_item->code;?>	<br>
				RIS No. :  <?php echo $requested_item->r_id;?>				
			</td>
		</tr>
		<tr>
         <td colspan="4"  sty
         le="text-align:center"><b><i>Requisition</i></b>	</td>
         <td colspan="2"  style="text-align:center"><b><i>Stock Available?</i></b></td>
		 <td colspan="2"  style="text-align:center"><b><i>Issue</i></b></td>
		</tr>
		<tr style="text-align: center;"><!--Headings-->
			<td>Stock No.</td>
			<td width="5%">Unit</td>
			<td width="25%">Description</td>
			<td width="5%">Quantity</td>
			<td>Yes</td>
			<td>No</td>
			<td>Quantity</td>
			<td>Remarks</td>
		</tr>
		<tr><!--Data-->
			<td><?php echo $requested_item->stock_number;?></td>	
			<td><?php echo $requested_item->units?></td>
			<td><?php echo $requested_item->product_desc;?></td>
			<td><?php echo $requested_item->qty?></td>
			<td><?php echo "/"?></td>
			<td></td>
			<td><?php echo $requested_item->qty;?></td>
			<td><?php echo $requested_item->remarks?></td>
		</tr>
		
		</table>
		<table width="100%"> 
		<tr>
			<td colspan="5" style="text-align:left">
				Purpose:		
		     </td>		    
		</tr>
		<tr>
			<td></td>
			<td><b>Requested by:</b></td>
			<td><b>Approved by:</b></td>
			<td><b>Issued by:</b></td>
			<td><b>Received by:</b></td>
		</tr>
		<tr>
			<td>Signature</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td>Printed Name:</td>
			<td><?php echo $requested_item->requested_by;?></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td>Designation:</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td>Date:</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		</table>
	


</body>
</html>