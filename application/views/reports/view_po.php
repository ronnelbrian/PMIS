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
	</style>
</head>
<body style="font-family: 'Source Sans Pro','Segoe UI','Droid Sans',Tahoma,Arial,sans-serif;">
	<table width="100%">
	<tr>
		<td style="text-align:right">
			<b>Purchase Order</b>
		</td>
	</tr>
	</table>
	<table width="100%" style="margin-top:20px">
		<tr>
			<td>
				<b><?php echo $product[0]['b_company']?></b>
			</td>
			<td style="text-align:right">
				<?php echo $product[0]['po_no']?>
			</td>
		</tr>
		<tr>
			<td>
				<?php echo $product[0]['b_address']?>
			</td>
			<td style="text-align:right">
				<?php echo date('F d, Y');?>
			</td>
		</tr>
		<tr>
			<td>
				<?php if($product[0]['b_telno'] != "") {echo $product[0]['b_telno']; if($product[0]['b_mobile'] != "") echo '/';} if($product[0]['b_mobile']) echo $product[0]['b_mobile'];?>
			</td>
			<td>
				
			</td>
		</tr>
	</table>
	<table width="100%" style="margin-top:20px">
		<tr>
			<td width="10%" style="vertical-align:top">
				<b>Supplier</b>
			</td>
			<td width="40%" style="vertical-align:top">
				<?php echo $product[0]['contact_person']?>
			</td>
			<td width="10%" style="vertical-align:top">
				<b>Ship To</b>
			</td>
			<td width="40%" style="vertical-align:top">
				<?php echo $product[0]['s_company']?>
			</td>
		</tr>
		<tr>
			<td width="10%" style="vertical-align:top">
				
			</td>
			<td width="40%" style="vertical-align:top">
				<?php echo $product[0]['supplier_name']?>
			</td>
			<td width="10%" style="vertical-align:top">
				
			</td>
			<td width="40%" style="vertical-align:top">
				<?php echo $product[0]['s_company']?>
			</td>
		</tr>
		<tr>
			<td width="10%" style="vertical-align:top">
				
			</td>
			<td width="40%" style="vertical-align:top">
				<?php echo $product[0]['supplier_address']?>
			</td>
			<td width="10%" style="vertical-align:top">
				
			</td>
			<td width="40%" style="vertical-align:top">
				<?php echo $product[0]['s_address']?>
			</td>
		</tr>
		<tr>
			<td width="10%" style="vertical-align:top">
				
			</td>
			<td width="40%" style="vertical-align:top">
				<?php if($product[0]['supplier_telno'] != "") {echo $product[0]['supplier_telno']; if($product[0]['supplier_mobile'] != "") echo '/';} if($product[0]['supplier_mobile']) echo $product[0]['supplier_mobile'];?>
			</td>
			<td width="10%" style="vertical-align:top">
				
			</td>
			<td width="40%" style="vertical-align:top">
				<?php if($product[0]['s_telno'] != "") {echo $product[0]['s_telno']; if($product[0]['s_mobile'] != "") echo '/';} if($product[0]['s_mobile']) echo $product[0]['s_mobile'];?>
			</td>
		</tr>
	</table>

	<table width="100%" style="margin-top:20px" border="1px solid" cellpadding="5" cellspacing="0">
		<tr>
			<td width="40%" style="vertical-align:middle; text-align:center">
				<b>Shipping Method</b>
			</td>
			<td width="40%" style="vertical-align:middle; text-align:center">
				<b>Shipping Terms</b>
			</td>
			<td width="20%" style="vertical-align:middle; text-align:center">
				<b>Delivery Date</b>
			</td>
		</tr>
		<tr>
			<td style="vertical-align:middle; min-height:20px">
				
			</td>
			<td style="vertical-align:middle; min-height:20px">
				
			</td>
			<td style="vertical-align:middle; min-height:20px; text-align:center">
				<?php echo $product[0]['delivery_date']?>
			</td>
		</tr>
	</table>

	<table width="100%" style="margin-top:20px" border="1px solid" cellpadding="5" cellspacing="0">
		<tr>
			<td width="3%" style="vertical-align:middle; text-align:center">
				<b>#</b>
			</td>
			<td width="5%" style="vertical-align:middle; text-align:center">
				<b>Qty</b>
			</td>
			<td width="50%" style="vertical-align:middle; text-align:center">
				<b>Item Description</b>
			</td>
			
			<td width="15%" style="vertical-align:middle; text-align:center">
				<b>Unit Price</b>
			</td>
			<td width="12%" style="vertical-align:middle; text-align:center">
				<b>Discount %</b>
			</td>
			<td width="15%" style="vertical-align:middle; text-align:center">
				<b>Line Total</b>
			</td>
		</tr>
		<?php $ctr = 0;foreach($product as $r)
		{
			$ctr++;
			echo '
				<tr>
					<td style="vertical-align:middle; text-align:right; min-height:20px">
						'.$ctr.'.
					</td>
					<td style="vertical-align:middle; min-height:20px">
						'.$r['qty'].'
					</td>
					<td style="vertical-align:middle; min-height:20px">
						'.$r['product'].'
					</td>
					
					<td style="vertical-align:middle; text-align:right; min-height:20px">
						P '.number_format($r['unit_price'],2).'
					</td>
					<td style="vertical-align:middle; text-align:right; min-height:20px">
						'.number_format($r['discount'],2).' %
					</td>
					<td style="vertical-align:middle; text-align:right; min-height:20px">
						P '.number_format($r['amount'],2).'
					</td>
				</tr>';
		}	
		?>
	</table>
	</table>
	<table width="100%" style="margin-top:20px" cellpadding="5" cellspacing="0">
		<tr>
			<td width="85%" style="vertical-align:middle; text-align:right">
				<b>SUBTOTAL (excl. VAT)</b>
			</td>
			<td width="15%" style="vertical-align:middle; text-align:right">
				<b><?php echo number_format($product[0]['total_price'] - ($product[0]['total_price']*.12),2)?></b>
			</td>
		</tr>
		<tr>
			<td width="85%" style="vertical-align:middle; text-align:right">
				<b>SALES TAX</b>
			</td>
			<td width="15%" style="vertical-align:middle; text-align:right">
				<b><?php echo number_format($product[0]['total_price']*.12,2)?></b>
			</td>
		</tr>
		<tr>
			<td width="85%" style="vertical-align:middle; text-align:right">
				<b>TOTAL</b>
			</td>
			<td width="15%" style="vertical-align:middle; text-align:right">
				<b>P <?php echo number_format($product[0]['total_price'],2)?></b>
			</td>
		</tr>
	</table>

	<table width="100%" style="margin-top:30px" cellpadding="5" cellspacing="0">
		<tr>
			<td width="30%" style="vertical-align:middle; text-align:center; border-top:1px solid">
				<b>Authorized By</b>

			</td>
			<td width="70%" style="vertical-align:middle; ">
							
			</td>
		</tr>
	</table>


	
	

</body>
</html>