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
	      REPORT ON THE PHYSICAL COUNT OF PROPERTY, PLANT, AND EQUIPMENT <br>
	   <u> </h4>
	   (Type of Property, Plant and Equipment)</u><br>
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
			<td>ARTICLE</td>
			<td>DESCRIPTION</td>
			<td>PROPERTY NUMBER</td>
			<td style="width:4%;">UNIT OF MEASURE</td>
			<td>ACQUISITION DATE</td>			
			<td>LOCATION</td>
			<td>UNIT VALUE</td>
			<td>BALANCE PER CARD (Quantity)</td>
			<td>ON HAND PER COUNT </td>
			<td colspan="2">SHORTAGE/OVERAGE</td>
			<td>REMARKS</td>
		</tr>
  		<?php 
			foreach($property as $r)
			{?>
					<tr><!--D
						ata-->
				 				<td></td>
								<td><?php echo $r['description']?></td>	
								<td><?php echo $r['property_number'];?></td>
								<td><?php echo $r['code'];?></td>
								<td><?php echo $r['date_added'];?></td>
								<td><?php echo $r['office'];?></td>
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