<html lang="en">
    <head>  
    <meta charset="utf-8">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta name="author" content="kayode Faluyi">
        <link href="<?= base_url() ?>public/dist/images/logo.svg" rel="shortcut icon">
    <title>Invoice</title>
<style>
    .body{margin:1% 10%; width: 78%; font-family: "Trebuchet MS", Arial, Helvetica, sans-serif; }
    .mid_body{ width:45%; margin: 2.5%;}
    .row{display: flex}
    .column1{flex: 60%}
    .column2{flex: 40%}
    .invoice-text{text-align: center; margin:1px}
    #customers {
 
  border-collapse: collapse;
  width: 100%;
}
.p_d > p{text-align: left;}
p{font-size: 13px; margin:7px}
#customers td, #customers th {
  border: 1px solid #ddd;
  font-size: 12px;
  padding: 8px;
}

@media print{
    .chrome.container::before { content: "A4"; }
	.page-break	{ display: block; page-break-before: always; };
     
    .body{margin:20% 10%; width: 80%; font-family: "Trebuchet MS", Arial, Helvetica, sans-serif; }
    .mid_body{ width:45%; margin: 2.5%;}
    .row{display: flex}
    .column1{flex: 60%}
    .column2{flex: 40%}
    .invoice-text{text-align: center; margin:1px}
    #customers {
 
  border-collapse: collapse;
  width: 100%;
}
.p_d > p{text-align: left;}
p{font-size: 13px; margin:7px}
#customers td, #customers th {
  border: 1px solid #ddd;
  font-size: 12px;
  padding: 8px;
}
#clickMe{ display:none;}

@page{
    size: 335mm 305mm;
}
}

</style>
</head>
<button id="clickMe" onclick="window.print()">Print/Save Invoice</button>
<body>

        <div id="block2" class="body">
           <div class="row">
           <br>
           <div class="column1">
               <h2 style="margin:1px"><?= $company->company_name ?></h2>
               <p>Email: <?= $company->company_email ?></p>
           </div>
          
           <div class="column2">
             <h4 style="margin:1px"><?= $company->company_address ?></h4>
             <p>Mobile: <?= $company->company_phones ?></p>
           </div>
           </div>
           <h3 class="invoice-text">INVOICE</h3>
           <div class="row">
           <div class="column1">
               <p>Invoice Clerk:  <?= $staff->staff_name ?></p>
               <p>Printed Date: <?= date('Y-m-d'); ?></p>
               <p>Vessel Arrival Date: <?= $container->arrivalDate ?></p>
               <p>Line Operator: <?= $container->lineOperator ?> </p>
           </div>
           <div class="column2">
             <p>Client: <?= $client->phone ?></p>
             <p>Address: <?= $client->address ?></p>
             <p>Invoice No: <?= $staff->invoiceNo ?></p>
             <p>Invoice Date: <?= $staff->dateCreated ?></p>
             <p>Due Date: <?= $container->dueDate ?></p>
           </div>
        </div>
           <h4>Comment: <?= $container->comments ?></h4>

           <table id="customers"> 
               <thead>
               <tr>
                   
                   <th>Call No</th>
                   <th>Vessel </th>
                   <th>Voyage No</th>
                   <th>Loading Port</th>
                   <th>Discharge Port</th>
                   <th>Manifest</th>
                   <th>Bill No</th>
                   <th>Mode</th>
                   <th>Package</th>
                   <th>Weight</th>
                   <th>Volume</th>
               </tr>
               </thead>
               <tr>
                   <td><?= $container->callNo ?></td>
                   <td><?= $container->vessel ?></td>
                   <td><?= $container->voyageNumber ?></td>
                   <td><?= $container->portOfLaden ?></td>
                   <td><?= $container->portOfDischarge ?></td>
                   <td><?= $container->manifest ?></td>
                   <td><?= $container->billNumber ?></td>
                   <td><?= $container->mode ?></td>
                   <td><?= $container->package ?></td>
                   <td><?= $container->weight ?></td>
                   <td><?= $container->volume ?></td>
               </tr>
               <tr>
                   <td colspan="11">Container No: <?= $container->containerNumber ?></td>
               </tr>
               <tr>
                   <th colspan="4">Invoice Label</th>
                   <th colspan="1">Unit</th>
                   <th colspan="3">Amount(&#8358;)</th>
                   <th colspan="3">Total(&#8358;)</th>
               </tr>
               <?php 
               $present_time=strtotime(date('Y-m-d'));
               $due_time=strtotime($container->dueDate);
               $diff_time=$present_time-$due_time;
               if($diff_time > 0){
                   $days= ceil($diff_time/(60*60*24));
               }else{
                   $days=0;
               }
               $days++;

               $vat_amount=0; $total=0; $subTotal=0;foreach($parameters as $p){
                    if(strtolower($p->name)=='vat'){
                        $vat_amount=$p->charges;
                    }
                    if(strtolower($p->name)!='vat' && $p->id != 9  && $p->id !=10  && $p->id !=7){$subTotal += $p->charges;
                ?>
               <tr>
                   <td colspan="4" style="border-bottom: 1px solid #fff;"><?= $p->name; ?></td>
                   <td colspan="1" style="border-bottom: 1px solid #fff;">1</td>
                   <td colspan="3" style="border-bottom: 1px solid #fff;"><?= number_format($p->charges, 2) ?></td>
                   <td colspan="3" style="border-bottom: 1px solid #fff;"><?= number_format($p->charges, 2) ?></td>
               </tr>
              
               <?php }
            if(($p->id == 9 && $container->earlyDelivery ==1)){ $subTotal += $p->charges; ?>
               <tr>
                   <td colspan="4" style="border-bottom: 1px solid #fff;"><?= $p->name; ?></td>
                   <td colspan="1" style="border-bottom: 1px solid #fff;">1</td>
                   <td colspan="3" style="border-bottom: 1px solid #fff;"><?= number_format($p->charges, 2) ?></td>
                   <td colspan="3" style="border-bottom: 1px solid #fff;"><?= number_format($p->charges, 2) ?></td>
               </tr>
               <?php }

            if(($p->id == 10 && $container->lateDelivery ==1)){ $subTotal += $p->charges; ?>
                <tr>
                    <td colspan="4" style="border-bottom: 1px solid #fff;"><?= $p->name; ?></td>
                    <td colspan="1" style="border-bottom: 1px solid #fff;">1</td>
                    <td colspan="3" style="border-bottom: 1px solid #fff;"><?= number_format($p->charges, 2) ?></td>
                    <td colspan="3" style="border-bottom: 1px solid #fff;"><?= number_format($p->charges, 2) ?></td>
                </tr>
                <?php }

            if(($p->id == 7)){ $subTotal += $p->charges * $days; ?>
                <tr>
                    <td colspan="4" style="border-bottom: 1px solid #fff;"><?= $p->name; ?>
                        <?php if($days > 1){ ?>
                            <p> <?= $container->dueDate.' to '.date('Y-m-d').' ('.$days.'days)'; ?></p>
                        <?php } ?>
                    </td>
                    <td colspan="1" style="border-bottom: 1px solid #fff;"><?= $days ?></td>
                    <td colspan="3" style="border-bottom: 1px solid #fff;"><?= number_format($p->charges, 2) ?></td>
                    <td colspan="3" style="border-bottom: 1px solid #fff;"><?= number_format(($p->charges * $days), 2) ?></td>
                </tr>
                <?php }
            
            } $vat = $vat_amount * $subTotal; $total=$vat + $subTotal;?>
               <tr>
                   <th colspan="2" style=" border-top: 2px solid #ddd;"></th>
                   <th colspan="3" style=" border-top: 2px solid #ddd;">Sub Total</th>
                   <th colspan="3" style=" border-top: 2px solid #ddd;"></th>
                   <th colspan="3" style=" border-top: 2px solid #ddd;"><?= number_format($subTotal, 2) ?></th>
               </tr>

               <tr>
                   <th colspan="2" style="border-bottom: 1px solid #fff; border-top: 2px solid #fff;"></th>
                   <th colspan="3" style="border-bottom: 1px solid #fff; border-top: 2px solid #fff;">VAT</th>
                   <th colspan="3" style="border-bottom: 1px solid #fff; border-top: 2px solid #fff;">7.5%</th>
                   <th colspan="3" style="border-bottom: 1px solid #fff; border-top: 2px solid #fff;"><?= number_format($vat, 2) ?></th>
               </tr>

               <tr>
                   <th colspan="2" style="border-bottom: 1px solid #fff;"></th>
                   <th colspan="3" style="border-bottom: 1px solid #fff;">Grand Total</th>
                   <th colspan="3" style="border-bottom: 1px solid #fff;"></th>
                   <th colspan="3" style="border-bottom: 1px solid #fff;"><?= number_format($total, 2) ?></th>
               </tr>
                    <?php $amount_words= numberTowords($total); ?>
               <tr>
                   <th colspan="11" class="p_d"style=" border-top: 2px solid #ddd;">
                       <p>Amount in words:</p>
                       <p><?= ucwords(strtolower('naira '.$amount_words.' kobo only')); ?></p>
                   </th>
                  
               </tr>

               <tr>
                   <th colspan="11" class="p_d">
                       <p>PAY TO:</p>
                       <p><?= $company->company_name.' @'.' '.$company->bank_name.':'.$company->account_number.' ,'.$company->company_address ?></p>
                       <p><?=$company->cac_no?></p>
                       <p><?=$company->company_name?></p>
                   </th>
                  
               </tr>
                
               <tr>
                   <th colspan="3" style="border-top: 2px solid #fff;border-right: 2px solid #fff;"><br><br><hr><span>Prepared By</span></th>
                   <th colspan="4" style="border-top: 2px solid #fff;border-right: 2px solid #fff;"><br><br><hr><span>Checked By</span></th>
                   <th colspan="4" style="border-top: 2px solid #fff;"><br><br><hr><span>Approved By</span></th>
               </>
           </table>
           
        </div>


</body>
<script>
</script>
</html>

<?php

function numberTowords($num)
{

$ones = array(
0 =>"ZERO",
1 => "ONE",
2 => "TWO",
3 => "THREE",
4 => "FOUR",
5 => "FIVE",
6 => "SIX",
7 => "SEVEN",
8 => "EIGHT",
9 => "NINE",
10 => "TEN",
11 => "ELEVEN",
12 => "TWELVE",
13 => "THIRTEEN",
14 => "FOURTEEN",
15 => "FIFTEEN",
16 => "SIXTEEN",
17 => "SEVENTEEN",
18 => "EIGHTEEN",
19 => "NINETEEN",
"014" => "FOURTEEN"
);
$tens = array( 
0 => "ZERO",
1 => "TEN",
2 => "TWENTY",
3 => "THIRTY", 
4 => "FORTY", 
5 => "FIFTY", 
6 => "SIXTY", 
7 => "SEVENTY", 
8 => "EIGHTY", 
9 => "NINETY" 
); 
$hundreds = array( 
"HUNDRED", 
"THOUSAND", 
"MILLION", 
"BILLION", 
"TRILLION", 
"QUARDRILLION" 
); /*limit t quadrillion */
$num = number_format($num,2,".",","); 
$num_arr = explode(".",$num); 
$wholenum = $num_arr[0]; 
$decnum = $num_arr[1]; 
$whole_arr = array_reverse(explode(",",$wholenum)); 
krsort($whole_arr,1); 
$rettxt = ""; 
foreach($whole_arr as $key => $i){
	
while(substr($i,0,1)=="0")
		$i=substr($i,1,5);
if($i < 20){ 
/* echo "getting:".$i; */
$rettxt .= $ones[$i]; 
}elseif($i < 100){ 
if(substr($i,0,1)!="0")  $rettxt .= $tens[substr($i,0,1)]; 
if(substr($i,1,1)!="0") $rettxt .= " ".$ones[substr($i,1,1)]; 
}else{ 
if(substr($i,0,1)!="0") $rettxt .= $ones[substr($i,0,1)]." ".$hundreds[0]; 
if(substr($i,1,1)!="0")$rettxt .= " ".$tens[substr($i,1,1)]; 
if(substr($i,2,1)!="0")$rettxt .= " ".$ones[substr($i,2,1)]; 
} 
if($key > 0){ 
$rettxt .= " ".$hundreds[$key]." "; 
}
} 
if($decnum > 0){
$rettxt .= " and ";
if($decnum < 20){
$rettxt .= $ones[$decnum];
}elseif($decnum < 100){
$rettxt .= $tens[substr($decnum,0,1)];
$rettxt .= " ".$ones[substr($decnum,1,1)];
}
}
return $rettxt;
}
?>