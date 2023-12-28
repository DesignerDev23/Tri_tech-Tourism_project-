<!-- 
@company - SystemSpecs
@product - Remita
@author - Oshadami Mike
-->
<?php
require 'remita_constants.php';
//http://localhost/ex/remita/Remita/sample_post_to_remita/sample-receipt-page.php?RRR=250010098695&orderID=167385825110419534954
$rrr = "";
if( isset($_GET['RRR'])) {
$rrr = $_GET['RRR'];
}
$response_code ="";
$response_message = "";
//Verify Transaction
	 function remita_rrr_transaction_details($rrr){

			//http://www.remitademo.net/remita/ecomm/merchantId/RRR/hash/status.reg

			$concatString = $rrr .  APIKEY . MERCHANTID;
			$hash = hash('sha512', $concatString);
			$url 	= CHECKSTATUSURL . '/' .MERCHANTID  . '/' . $rrr . '/' . $hash . '/' . 'status.reg';

		$hash = hash('sha512', $concatString);
			//to prevent non loading if REMITA WEBSITE FAIL
			try {
			    //  Initiate curl
			    $ch = curl_init();
			    // Disable SSL verification
			    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			    // Will return the response, if false it print the response
			    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			    // Set the url
			    curl_setopt($ch, CURLOPT_URL,$url);
			    // Execute
			    $result=curl_exec($ch);
			    // Closing
			    curl_close($ch);
				//exit(var_dump($result));
				// '{"amount":1000.0,"RRR":"300010098688","orderId":"167385702312256829974","message":"Approved","paymentDate":"2023-01-16 08:18:54 AM","transactiontime":"2023-01-16 12:00:00 AM","status":"01"}' (length=189)
				
			    $response = json_decode($result, true);
			} catch (Exception $e) {
			    error_log($e);
			}

			return $response;
		}
		
	if($rrr !=null){
		//$response = remita_transaction_details($orderID);
		$response =  remita_rrr_transaction_details($rrr);
		$response_code = $response['status'];
		if (isset($response['RRR']))
			{
			$rrr = $response['RRR'];
			}
		$response_message = $response['message'];
}
?>
<html>
<head>
<title></title>
</head>
<body>
		<div style="text-align: center;">
		<?php if($response_code == '01' || $response_code == '00') { ?>
		<h2>Transaction Successful</h2>
		<h3><?php echo $response_message; ?><h3>
		<p><b>Remita Retrieval Reference: </b><?php echo $response['RRR']; ?><p>
		<?php }else if($response_code == '021') { ?>
						<h2><?php echo $response_message; ?></h2>
						<p><b>Remita Retrieval Reference: </b><?php echo $response['RRR']; ?><p>
		<?php }	else{ ?>
						<h2>Your Transaction was not Successful</h2>
						<?php if ($rrr !=null){ ?>
						 <p>Your Remita Retrieval Reference is <span><b><?php echo $rrr; ?></b></span><br />
						<?php } ?> 
						  <p><b>Reason: </b><?php echo $response_message; ?><p>
		 <?php }?>
	</div>
</body>
</html>