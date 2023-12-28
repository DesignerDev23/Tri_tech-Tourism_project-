<?php

// Include the database connection file
include_once 'db.php';

// Function to generate a payment invoice
function generateInvoice($userId, $businessId, $amount) {
    global $conn;

    $sql = "INSERT INTO Invoices (user_id, business_id, amount) VALUES ($userId, $businessId, $amount)";
    $result = $conn->query($sql);

    return $result;
}

// Function to register a business
function registerBusiness($businessName, $address, $contactPhone, $email, $date, $typeOfBusiness) {
    global $conn;

    $sql = "INSERT INTO Businesses (business_name, address, contact_phone, email, date, type_of_business) VALUES ('$businessName', '$address', '$contactPhone', '$email', '$date', '$typeOfBusiness')";
    $result = $conn->query($sql);

    return $result;
}

// Add other user-related functions as needed

?>
