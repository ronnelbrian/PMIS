<!DOCTYPE html>
<html>
<head>
	<title>Physical Inventory</title>
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
	   <h4><b>MOVIE AND TELEVISION REVIEW AND CLASSIFICATION BOARD</b><br>
	      REPORT ON THE PHYSICAL COUNT OF INVENTORIES <br>
	   <u>  OF SUPPLIES AND MATERIALS - AVAILABLE FROM PROCUREMENT SERVICE</h4>
	   (Type of Inventory Item)</u><br>
	  <b>As of <u> DATE 2017</u> </b>
	</caption><br>
	<p >For which <u></u> is accountable, having assumed such accountability on <u></u><br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(Name of Accountable Officer)
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(Official Designation)
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(Agent/Office)
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(Date of Assumption)
	</p>
	<table width="100%">
	   
		<tr style="text-align: center;"><!--Headings-->
			<th>ARTICLE</th>
			<th>DESCRIPTION</th>
			<th>STOCK NUMBER</th>
			<th>UNIT OF MEASURE</th>
			<th>UNIT VALUE</th>
			<th>BALANCE PER CARD (Quantity)</th>
			<th>ON HAND PER COUNT </th>
			<th colspan="2">SHORTAGE/OVERAGE</th>
			<th>REMARKS</th>
		</tr>
  		<?php 
			foreach($product as $r)
			{?>
					<tr><!--D
						ata-->
				 
								<td><?php echo $r['description']?></td>	
								<td><?php echo $r['category'];?></td>
								<td><?php echo $r['stock_number'];?></td>
								<td><?php echo $r['unit'];?></td>
								<td><?php echo $r['unit_value'];?></td>
								<td><?php echo $r['stock']?></td>
								<td><?php echo $r['stock']?></td>
								<td></td>
								<td></td>
								<td></td>
				
					</tr>
		<?php }?>
		</table><br><br>
	<p>Prepared by:
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		Certified Correct by:
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		Witnessed by:
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		Noted by:

	</p>


</body>
</html>