<!-- $merchantId = "8824468874";
$apiKey = "768321";
$serviceTypeId = "8799249766"; -->

<?php
$merchantId = "8824468874";
$apiKey = "768321";
$serviceTypeId = "8799249766";

if (isset($_POST['payerName'], $_POST['amount'])) {
    $payerName = $_POST['payerName'];
    $amount = $_POST['amount'];

    $apiUrl = "https://www.remita.net/remita/exapp/api/v1/send/api";

    $requestData = [
        'serviceTypeId' => $serviceTypeId,
        'amount' => $amount,
        'orderId' => uniqid(),
        'payerName' => $payerName,
        // Add other required parameters
    ];

    $jsonData = json_encode($requestData);

    $ch = curl_init($apiUrl);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Content-Length: ' . strlen($jsonData),
        'Authorization: ' . base64_encode("$merchantId:$apiKey"),
    ]);

    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        echo json_encode(['success' => false, 'error' => 'Curl error: ' . curl_error($ch)]);
    } else {
        $responseData = json_decode($response, true);
        $responseData['success'] = true;
        echo json_encode($responseData);
    }

    curl_close($ch);
} else {
    echo json_encode(['success' => false, 'error' => 'Missing payerName or amount in the request.']);
}
?>
