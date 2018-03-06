<!DOCTYPE html>
<html>
<head>
	<title>Furniture/Equipment Order</title>
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
	   <h3><b>FURNITURE/EQUIPMENT ORDER</b></h3>
	   	<u>MTRCB</u><br>
	  <b> Entity Name </b>
	</caption><br>
	<table width="100%">
	    <tr>
			<td style="text-align:left">
				Supplier: <b><?php if(isset($product[0]['supplier_name']) )echo $product[0]['supplier_name']?></b>	<br>
				Address: <?php  if(isset($product[0]['supplier_address']) ) echo $product[0]['supplier_address']?><br>
				TIN:<u></u>
		     </td>
		     <td style="text-align:left">
				P.O. No. : <?php if(isset($product[0]['fo_no']) )echo $product[0]['fo_no'];?>	<br>
				Date:  <?php if(isset($product[0]['delivery_date']) )echo $product[0]['delivery_date']?>	<br>
				Mode of Procurement: Cash
			</td>
		</tr>
		<tr>
         <td colspan="2">Gentleman:<br>
			<p align="center">	Please furnish this Office the following articles subject to the terms and conditions contained herein:</p>			
				
          </td>
		</tr>
		 <tr>
			<td style="text-align:left">
				Place of Delivery: <?php if(isset($product[0]['s_address']) )echo $product[0]['s_address']?><br>
				Date of Delivery: <?php if(isset($product[0]['delivery_date']) )echo $product[0]['delivery_date']?><br>
				
		     </td>
		     <td style="text-align:left">
				Deliverty Term: 7 working days	<br>
				Payment Term: 	<br>
				
			</td>
		</tr>
		</table>
		<table width="100%">
		<thead>
		<tr>
			<th  style="width : 10%">Stock/<br>Property No.</th>
			<th  style="width : 10%">Unit</th>
			<th  style="width : 40%">Description</th>
			<th >Quantity</th>
			<th  >Unit Cost</th>
			<th  >Amount</th>
		</tr>
		</thead>
		<tbody ><?php foreach($product as $r)
		{  
			?>
		<tr height="500" >
		
			<td></td>
			<td><?php echo $r['unit'] ?></td>
			<td ><?php echo $r['product'] ?></td>
			<td><?php echo $r['qty']?></td>
			<td><?php echo number_format($r['unit_price'],2)?></td>
			<td><?php echo number_format($r['amount'],2)?></td>


		
		</tr><?php } ?>
		<tr>
			<td colspan="5">(Total Amount in Words) 
			<?php 

			if(isset($r['total_price']))
			echo convert_number_to_words($r['total_price']) 
			?>
				
			</td>
			<td><b> P <?php if(isset($product[0]['total_price']) )echo number_format($product[0]['total_price'],2)?></b></td>
		</tr>
		<tr>
			<td colspan="6"> <br>
					<p> &nbsp;&nbsp; In case of failure to make the full delivery within the time specified above, a penalty of one-tenth (1/10) of one percent for every day of delay shall be imposed on the undelivered item/s</p><br>
					<div align="left" >Conforme: <br><br>
							____________________________________<br>
							Signature over Printed Name of Supplier <br><br>

							_____________________________________<br>
							Date

				    </div>
				    	<div align="right" >
					    
					      Very truly yours, <br><br>
					      ____________________________________<br>
							Signature over Printed Name of Authorized <br><br>

							_____________________________________<br>
							Designation</div>
						  

			</td>

		</tr>
		<tr>
				<td colspan="3">
				<b>Fund Cluster:</b> Special Account - Locally Funded (151)<br>
				<b>Funds Available: </b> 
				<br><br>
				<p align="right">
				_______________________________________<br>
				Signature over Printed Name of Chief <br>
				Accountant/Head of Accounting Division/Unit
				</p>
				</td>
				<td colspan="3">
					<p><b>ORS/BURS No.:</b>    <br>
					<b>Date of the ORS/BURS: </b>  <br><br>
					<b>Amount:</b></p> 
				</td>
		</tr>
		</tbody>
	</table>
			

 <?php
function convert_number_to_words($number) {
   
    $hyphen      = '-';
    $conjunction = '  ';
    $separator   = ' ';
    $negative    = 'negative ';
    $decimal     = ' and ';
    $dictionary  = array(
        0                   => 'zero',
        1                   => 'One',
        2                   => 'Two',
        3                   => 'Three',
        4                   => 'Four',
        5                   => 'Five',
        6                   => 'Six',
        7                   => 'Seven',
        8                   => 'Eight',
        9                   => 'Nine',
        10                  => 'Ten',
        11                  => 'Eleven',
        12                  => 'Twelve',
        13                  => 'Thirteen',
        14                  => 'Fourteen',
        15                  => 'Fifteen',
        16                  => 'Sixteen',
        17                  => 'Seventeen',
        18                  => 'Eighteen',
        19                  => 'Nineteen',
        20                  => 'Twenty',
        30                  => 'Thirty',
        40                  => 'Fourty',
        50                  => 'Fifty',
        60                  => 'Sixty',
        70                  => 'Seventy',
        80                  => 'Eighty',
        90                  => 'Ninety',
        100                 => 'Hundred',
        1000                => 'Thousand',
        1000000             => 'Million',
        1000000000          => 'Billion',
        1000000000000       => 'Trillion',
        1000000000000000    => 'Quadrillion',
        1000000000000000000 => 'Quintillion'
    );
   
    if (!is_numeric($number)) {
        return false;
    }
   
    if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
        // overflow
        trigger_error(
            'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
            E_USER_WARNING
        );
        return false;
    }

    if ($number < 0) {
        return $negative . convert_number_to_words(abs($number));
    }
   
    $string = $fraction = null;
   
    if (strpos($number, '.') !== false) {
        list($number, $fraction) = explode('.', $number);
    }
   
    switch (true) {
        case $number < 21:
            $string = $dictionary[$number];
            break;
        case $number < 100:
            $tens   = ((int) ($number / 10)) * 10;
            $units  = $number % 10;
            $string = $dictionary[$tens];
            if ($units) {
                $string .= $hyphen . $dictionary[$units];
            }
            break;
        case $number < 1000:
            $hundreds  = $number / 100;
            $remainder = $number % 100;
            $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
            if ($remainder) {
                $string .= $conjunction . convert_number_to_words($remainder);
            }
            break;
        default:
            $baseUnit = pow(1000, floor(log($number, 1000)));
            $numBaseUnits = (int) ($number / $baseUnit);
            $remainder = $number % $baseUnit;
            $string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
            if ($remainder) {
                $string .= $remainder < 100 ? $conjunction : $separator;
                $string .= convert_number_to_words($remainder);
            }
            break;
    }
   
    if (null !== $fraction && is_numeric($fraction)) {
        $string .= $decimal;
        $words = array();
        foreach (str_split((string) $fraction) as $number) {
            $words[] = $dictionary[$number];
        }
        $string .= implode(' ', $words);
    }
   
    return $string;
}

//echo '<b>'.convert_number_to_words($r['amount']).'</b>';

?>



</body>
</html>