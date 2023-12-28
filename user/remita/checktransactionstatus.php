<!-- 
@company - SystemSpecs
@product - Remita
@author - Oshadami Mike
-->
<?php 


error_reporting(E_ALL);
ini_set('display_errors', 0);

include 'remita_constants.php';
$rrr = $_POST["rrr"];
//$orderID = $_POST["orderID"];
//$responseurl = PATH . "/sample-receipt-page.php";
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
	//	$response = remita_transaction_details($orderID);
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
	<style>
		
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,400;1,500;1,600;1,700&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding-top: 90px;
            display: block;
            justify-content: space-around;
			text-decoration: none;
        }
		a{
			text-decoration: none;
		}
        h3 {
            text-align: center;
            color: #333;
        }
		form:nth-child(2){
			height: 170px;
			margin-top: 10%;
			margin-bottom: 20%;
			max-width: 30%;
		}
        form{
            width: 40%;
			height: 40%;
            margin: 20px auto;
			position: relative;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }
		.container {
            text-align: center;
            /* margin-top: 100px; */
            background-color: #ffffff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 41%;
            margin-left: auto;
			margin-bottom: 20px;
			z-index: 9999;
			height: 90px;
            margin-right: 28%;
            /* margin-left: 30px; */
        }

        h2 {
            color: #28a745;
        }

        h3 {
            color: #333;
        }

        p {
            color: #555;
            margin: 10px 0;
        }

        b {
            color: #007bff;
        }

        span {
            color: #6c757d;
        }
        table {
            width: 100%;
        }
		.check-status-button {
            position: fixed;
            top: 10px;
            right: 10px;
            padding: 10px;
            background-color: #28a745;
            color: #fff;
            border: none;
            cursor: pointer;
            border-radius: 3px;
            z-index: 999; /* Ensures the button is on top of other elements */
        }

        .check-status-button:hover {
            background-color: #218838;
        }

        td {
            padding: 10px;
        }

        input[type="text"],
        input[type="email"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
            border-radius: 3px;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        font[color="red"] {
            color: red;
        }
    
	</style>
 <div class="container">
        <?php if ($response_code == '01' || $response_code == '00') { ?>
            <h2>Transaction Successful</h2>
            <h3><?php echo $response_message; ?></h3>
            <p><b>Remita Retrieval Reference: </b><?php echo $response['RRR']; ?></p>
        <?php } else if ($response_code == '021') { ?>
            <h2><?php echo $response_message; ?></h2>
            <p><b>Remita Retrieval Reference: </b><?php echo $response['RRR']; ?></p>
        <?php } else { ?>
            <?php if ($rrr != null) { ?>
                <p>Your Remita Retrieval Reference is <span><b><?php echo $rrr; ?></b></span></p>
            <?php } ?>
            <p><b>Reason: </b><?php echo $response_message; ?></p>
        <?php } ?>
    </div>


    <form action="checktransactionstatus.php" method="post" name="RemitaPaymentStatusForm" class="check">
        <h3>Check Transaction Status</h3>
        <table>
            <tbody>
                <tr>
                    <td>Remita RRR: <font color="red">*</font></td>
                    <td><input name="rrr" value="" type="text" required="true"></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" name="" value="Check Status"></td>
                </tr>
				<tr>
					<td></td>
					<td>
						
						<!-- <a href="your-page.html" class="check-status-button">Go Back</a> -->
					</td>
				</tr>
            </tbody>
        </table>
		
    </form>    
</body>
</html>


