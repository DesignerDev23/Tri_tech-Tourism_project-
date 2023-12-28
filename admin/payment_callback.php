<!-- payment_callback.php -->
<?php

// Replace 'your_paystack_secret_key' with your actual Paystack secret key
$paystackSecretKey = 'sk_test_cc20824a5bc9e5a3771d289406179f2e1c3f4a84';

// Retrieve payment details from Paystack
$paymentReference = $_GET['reference'];

$verifyPaymentUrl = 'https://api.paystack.co/transaction/verify/' . $paymentReference;
$headers = [
    'Authorization: Bearer ' . $paystackSecretKey,
];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $verifyPaymentUrl);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
curl_close($ch);

$paymentData = json_decode($response, true);

// Connect to your database (replace 'your_database_connection_details' with your actual details)
$pdo = new PDO('mysql:host=localhost;dbname=tourism', 'root', '');

// Save payment details to the revenue table
$insertStatement = $pdo->prepare('INSERT INTO revenue (payment_reference, amount_paid, status) VALUES (?, ?, ?)');
$insertStatement->execute([$paymentReference, $paymentData['data']['amount'] / 100, $paymentData['data']['status']]);

// Redirect the user to the add business page
header('Location: /tourism/admin/add_business.php');
exit;
?>