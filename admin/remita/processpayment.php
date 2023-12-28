<!-- 
@company - SystemSpecs
@product - Remita
@author - Oshadami Mike
-->


<?php 
include 'remita_constants.php';
$amount = $_POST["amt"];
$timesammp=time();		
$orderID = $timesammp . rand(1000000000,99999999999);
$payerName = $_POST["payerName"];
$payerEmail = $_POST["payerEmail"];
$payerPhone = $_POST["payerPhone"];
$responseurl = PATH . "/sample-receipt-page.php";
$concatString = MERCHANTID . SERVICETYPEID . $orderID . $amount . APIKEY;
$hash = hash('sha512', $concatString);
//$paymenttype = $_POST["paymenttype"];
$description = $_POST["description"];

$remitaResult = generate_rrr($amount, $orderID, $payerName, $payerEmail, $payerPhone, $hash,$description );

function generate_rrr($amount, $orderID, $payerName, $payerEmail, $payerPhone, $hash,$description ){
		    
		    //The JSON data.
		    $content = '{"merchantId":"'. MERCHANTID
		    .'"'.',"serviceTypeId":"'. SERVICETYPEID
		    .'"'.",".'"amount":"'.$amount
			.'"'.",".'"hash":"'.$hash
		    .'","description":"'. $description
		    .'"'.',"orderId":"'.$orderID
		    .'"'.",".'"apiKey":"'. APIKEY
		    .'","payerName":"'. $payerName
		    .'"'.',"payerEmail":"'. $payerEmail 
		    .'"'.",".'"payerPhone":"'.$payerPhone 
		    .'"}';
		    
		    $header = array(
		        'Content-Type: application/json',
		        'Authorization: remitaConsumerKey=' . MERCHANTID .
		        ',remitaConsumerToken=' . $hash 
		    );
		    //to prevent non loading if REMITA WEBSITE FAIL
		    try {
		        //  Initiate curl
		        $ch = curl_init();
		        
		        // Disable SSL verification
		        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		        // Will return the response, if false it print the response
		        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		        
		        // Set the url
		        curl_setopt($ch, CURLOPT_URL, GATEWAYINITIATEURL);
		        
		        // Set the header
		        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		        curl_setopt($ch, CURLOPT_POST, true);
		        curl_setopt($ch, CURLOPT_POSTFIELDS, $content);
		        
		        // Execute
		        $result = curl_exec($ch);
		        
		        // Closing
		        curl_close($ch);
		        
		        // decode json
		        $result_response = json_decode(trim(
		            str_replace(')', '',
		                str_replace('(', '', 
		                  str_replace('jsonp', '', $result))
		            )), 
		            true);
		 
		        //jsonp ({"statuscode":"025","RRR":"140007752615","status":"Payment Reference generated"})
		        /* { "status": "DUPLICATE_REQUEST",
		            "statusMessage": "Duplicate Order Ref",
		            "uniqueReference": "",
		            "responseParams": {}
		        } */
		        
		    } catch (Exception $e) {
		        error_log($e->getMessage());
		    }
		    
		    return $result_response;
		}
?>
<html>
	<head>
		<link rel="stylesheet" href="style.css">
	</head>
<div style="text-align: center;" class="invoice-container">
<h3>KANO STATE TOURISM BOARD</h3>
<h4>KANO STATE, NIGERIA</h4>


<strong>
	
<div class="invoice-details">
<h3>PAYMENT INVOICE FOR REGISTRATION</h3>
           <div class="invoice-info">
            <div class="info-item">
                <span class="info-label">RRR Code:</span>
                <span class="info-value"><?php echo $remitaResult['RRR']; ?></span>
            </div>

            <div class="info-item">
                <span class="info-label">Amount:</span>
                <span class="info-value">₦<?php echo $_POST["amt"]; ?></span>
            </div>

            <div class="info-item">
                <span class="info-label">Payer Name:</span>
                <span class="info-value"><?php echo $_POST["payerName"]; ?></span>
            </div>

            <div class="info-item">
                <span class="info-label">Payer Phone:</span>
                <span class="info-value"><?php echo $_POST["payerPhone"]; ?></span>
            </div>

            <div class="info-item">
                <span class="info-label">Date Generated:</span>
                <span class="info-value"><?php echo date('D, d M Y H:i:s', time()); ?></span>
            </div>

            <div class="info-item">
                <span class="info-label">Descriptio:</span>
                <span class="info-value"><?php echo $_POST["description"]; ?></span>
            </div>

            <div class="info-item">
                <span class="info-label">Service Type ID:</span>
                <span class="info-value"><?php echo SERVICETYPEID; ?></span>
            </div>

            <div class="info-item">
                <span class="info-label">Order ID:</span>
                <span class="info-value"><?php echo $orderID; ?></span>
            </div>
        </div>
    </div>
<ol>
<li>Payment for this invoice can be made at any bank branch nationwide, card, or ATM or e-wallet payment.</li>
  <li>After making payment, visit: <a href="https://tourism.igr.ng">https://tourism.igr.ng</a>.</li>
  <li>Enter the RRR code on this invoice and your phone number. This will allow you to access the registration form.</li>
  <li>Upload your picture by clicking on "Upload Picture" on the registration form.</li>
  <li>Enter all relevant data on the registration form.</li>
  <li>Click on submit to save the record, then print a copy of the registration form.</li>
	</ol>
	</strong>


<?php if(@$remitaResult['statuscode'] == '025'){ 
echo 'RRR Generated successully:<br /> <strong>RRR: '. $remitaResult['RRR'] . '</strong><br />';

$pay_concatString =  MERCHANTID . $remitaResult['RRR']. APIKEY;
        $pay_hash = hash('sha512', $pay_concatString);
        
		//KANO TOURISM RECEIPT
		?>
<form id="SubmitRemitaForm" action="<?php echo GATEWAYRRRPAYMENTURL; ?>" name="SubmitRemitaForm" method="POST" >
                  <input name="merchantId" value="<?php echo MERCHANTID; ?>" type="hidden">
                   <input name="hash" value="<?php echo $pay_hash; ?>" type="hidden">
                  <input name="rrr" value="<?php echo  $remitaResult['RRR']; ?>" type="hidden">
                  <input name="responseurl" value="<?php echo $responseurl; ?>" type="hidden">
<input type ="submit" name="submit" value="Proceed and Pay with Remita">
<button onclick="window.print()">Print this page</button>
</form>
<?php }else{
 echo '<p>'. print_r($remitaResult) . '</p>';

}	//end if ?>
</div>

</html>