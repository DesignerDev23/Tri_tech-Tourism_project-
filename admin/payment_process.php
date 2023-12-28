<?php
error_reporting(E_ERROR | E_PARSE);
ini_set('display_errors', 0);

include 'loader.php';

// Replace 'your_paystack_secret_key' with your actual Paystack secret key
$paystackSecretKey = 'sk_test_cc20824a5bc9e5a3771d289406179f2e1c3f4a84';
// Get payment reference from the URL
$paymentReference = $_GET['reference'];

// Call Paystack API to verify payment
$paystackVerifyUrl = 'https://api.paystack.co/transaction/verify/' . $paymentReference;
$headers = [
    'Authorization: Bearer ' . $paystackSecretKey,
];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $paystackVerifyUrl);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);

// Check if cURL request was successful
if ($response === false) {
    // Handle the case where the cURL request failed
    echo 'Error: cURL request failed.';
    exit;
}

curl_close($ch);

$paymentData = json_decode($response, true);

// Check if payment was successful
if ($paymentData['data']['status'] === 'success') {
    // Payment successful, you can save details to the database or perform other actions
    echo 'Payment successful!';
} else {
    // Payment failed, handle accordingly
    // echo 'Payment failed.';
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Form</title>
    <script src="https://js.paystack.co/v1/inline.js"></script>
</head>

<style>
        
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&display=swap');
      
      
              body {
                  font-family: 'Poppins', sans-serif;
                  margin: 0;
                  padding: 0;
                  background-color: #f5f5f5;
                  display: flex;
                  flex-direction: column;
                  align-items: center;
                  justify-content: center;
                  min-height: 100vh;
              }
              h1{
                  font-size: 18px;
                  color: black;
              }
              p{
                  font-size: 14px;
                  margin-top: -10px;
                  color: black;
              }
              header {
                  background-color: #fff;
                  color: #fff;
                  padding-top: 20px;
                  z-index: 999;
                  border-radius: 10px;
                  height: 5rem;
                  margin-top: 0;
                  /* padding: 20px; */
                  text-align: center;
                  width: 22%;
                  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
              }
      
              form {
                  background-color: #fff;
                  border-radius: 8px;
                  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                  padding: 20px;
                  width: 300px;
                  text-align: center;
                  margin-top: 20px;
              }
      
              label {
                  display: block;
                  margin-top: 10px;
                  text-align: left;
              }
      
              input {
                  width: 100%;
                  padding: 8px;
                  margin-top: 5px;
                  box-sizing: border-box;
                  outline: none; /* Remove outline border */
              }
      
              button {
                  background-color: #4caf50;
                  color: #fff;
                  padding: 10px;
                  border: none;
                  border-radius: 5px;
                  cursor: pointer;
                  margin-top: 10px;
              }
      
              button:hover {
                  background-color: #45a049;
              }
          </style>
<body>
<header>
        <h1>Kano Tourism Board</h1>
        <p>Make a Payment</p>
        
        <!-- Add your logo here if needed -->
    </header>
    <form onsubmit="return initiatePayment(event)">
        <!-- Make the amount constant (e.g., $50) -->
        <input type="hidden" id="amount" name="amount" value="5000">

        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="description">Narrasion:</label>
        <input type="text" id="description" name="description" required>

        <button type="submit">Pay Now</button>
    </form>

    <script>
        function initiatePayment(event) {
            event.preventDefault();

            var amount = document.getElementById('amount').value;
            var name = document.getElementById('name').value;
            var email = document.getElementById('email').value;
            var description = document.getElementById('description').value;

            // Call Paystack Inline Checkout
            var handler = PaystackPop.setup({
                key: 'pk_test_12658c234f2075a824b3e5862ac5a6b31fc5cd4f', // Replace with your actual Paystack public key
                email: email,
                amount: 5000.00, // Use the constant amount
                ref: 'ref_' + Math.floor((Math.random() * 1000000000) + 1),
                metadata: {
                    custom_fields: [
                        {
                            display_name: "Name",
                            variable_name: "name",
                            value: name
                        },
                        {
                            display_name: "Description",
                            variable_name: "description",
                            value: description
                        }
                    ]
                },
                callback: function (response) {
                    // Handle the response after payment (e.g., redirect to success page)
                    window.location.href = 'http://localhost/tourism/admin/payment_callback.php?reference=' + response.reference;
                },
                onClose: function () {
                    alert('Payment closed');
                }
            });

            handler.openIframe();
        }
    </script>
</body>
</html>
