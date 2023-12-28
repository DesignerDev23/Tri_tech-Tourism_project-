<?php

include_once 'loader.php';

?>

<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Remita Payment Gateway</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,400;1,500;1,600;1,700&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding-top: 90px;
            display: flex;
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
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
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
</head>
<body>
	
    <form action="processpayment.php" method="post" name="RemitaPaymentForm">
        <h3>Generate Remita Invoice</h3>
        <table>
            <tbody>
                <tr>
                    <td>Payer Name:</td>
                    <td><input name="payerName" value="" type="text"></td>
                </tr>
                <tr>
                    <td>Payer Email: <font color="red">*</font></td>
                    <td><input name="payerEmail" required="true" value="" type="email"></td>
                </tr>
                <tr>
                    <td>Payer Phone:</td>
                    <td><input name="payerPhone" value="" type="text"></td>
                </tr>
                <tr>
                    <td>Amount: <font color="red">*</font></td>
                    <td><input name="amt" required="true" value="" type="text"></td>
                </tr>
                <tr>
                    <td>Description: <font color="red">*</font></td>
                    <td><input name="description" required="true" value="" type="text"></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" name="" value="Generate RRR"></td>
                </tr>
            </tbody>
        </table>
    </form>

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
	<a href="../index.php" class="check-status-button">Go Back</a>
</body>
</html>


<!-- <form action="processpayment.php" method="post" name="RemitaPaymentForm">
	<h3>Generate Remita Invoice</h3>
	<table>
		<tbody>
			<tr>
				<td>Payer Name:</td>
				<td><input name="payerName" value="" type="text"></td>
			</tr>
			<tr>
				<td>Payer Email: <font color="red">*</font></td>
				<td><input name="payerEmail" required="true" value="" type="email"></td>
			</tr>
			<tr>
				<td>Payer Phone:</td>
				<td><input name="payerPhone" value="" type="text"></td>
			</tr>
			<tr>
				<td>Amount: <font color="red">*</font></td>
				<td><input name="amt" required="true" value="" type="text"></td>
			</tr>
			<tr>
				<td>Description: <font color="red">*</font></td>
				<td><input name="description" required="true" value="" type="text"></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" name="" value="Generate RRR"></td>
			</tr>
		</tbody>
	</table>
</form>

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