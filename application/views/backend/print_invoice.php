<html lang="en"><head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <title></title>
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

@media print and (min-height:335mm) and (max-height: 305mm) {
    .chrome.container::before { content: "EXECUTIVE"; }
	.page-break	{ display: block; page-break-before: always; };
     thead   { display: table-header-group;};
     
@page{
    size: 335mm 305mm;
}
}
@page{
    size: 335mm 305mm;
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
                    <?php $amount_words= convert_number($total); ?>
               <tr>
                   <th colspan="11" class="p_d"style=" border-top: 2px solid #ddd;">
                       <p>Amount on words:</p>
                       <p><?= $amount_words.' naira only'; ?></p>
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
                   <th colspan="3" style="border-top: 2px solid #fff;border-right: 2px solid #fff;"><hr><span>Prepared By</span></th>
                   <th colspan="4" style="border-top: 2px solid #fff;border-right: 2px solid #fff;"><hr><span>Checked By</span></th>
                   <th colspan="4" style="border-top: 2px solid #fff;"><hr><span>Approved By</span></th>
               </tr>
           </table>
           
        </div>


</body>
<script>
</script>
</html>

<?php

function convert_number($number) {
    if (($number < 0) || ($number > 999999999)) {
        throw new Exception("Number is out of range");
    }
    $giga = floor($number / 1000000);
    // Millions (giga)
    $number -= $giga * 1000000;
    $kilo = floor($number / 1000);
    // Thousands (kilo)
    $number -= $kilo * 1000;
    $hecto = floor($number / 100);
    // Hundreds (hecto)
    $number -= $hecto * 100;
    $deca = floor($number / 10);
    // Tens (deca)
    $n = $number % 10;
    // Ones
    $result = "";
    if ($giga) {
        $result .= convert_number($giga) .  "Million";
    }
    if ($kilo) {
        $result .= (empty($result) ? "" : " ") .convert_number($kilo) . " Thousand";
    }
    if ($hecto) {
        $result .= (empty($result) ? "" : " ") .convert_number($hecto) . " Hundred";
    }
    $ones = array("", "One", "Two", "Three", "Four", "Five", "Six", "Seven", "Eight", "Nine", "Ten", "Eleven", "Twelve", "Thirteen", "Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eightteen", "Nineteen");
    $tens = array("", "", "Twenty", "Thirty", "Fourty", "Fifty", "Sixty", "Seventy", "Eigthy", "Ninety");
    if ($deca || $n) {
        if (!empty($result)) {
            $result .= " and ";
        }
        if ($deca < 2) {
            $result .= $ones[$deca * 10 + $n];
        } else {
            $result .= $tens[$deca];
            if ($n) {
                $result .= "-" . $ones[$n];
            }
        }
    }
    if (empty($result)) {
        $result = "zero";
    }
    return $result;
}
?>