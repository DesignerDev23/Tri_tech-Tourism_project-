<?php

// Include the database connection file
include_once 'db.php';

// Function to add a user
function addUser($username, $password, $role, $full_name) {
    global $conn;

    $sql = "INSERT INTO Users (username, password, role, full_name) VALUES ('$username', '$password', '$role', '$full_name')";
    $result = $conn->query($sql);

    return $result;
}

// Function to remove a user
function removeUser($userId) {
    global $conn;

    // Using prepared statement to prevent SQL injection
    $stmt = $conn->prepare("DELETE FROM users WHERE user_id = ?");
    $stmt->bind_param("i", $userId); // "i" represents an integer

    $result = $stmt->execute();

    $stmt->close();

    return $result;
}

// Function to add a business
function addBusiness($businessName, $address, $contactPhone, $email, $date, $typeOfBusiness) {
    global $conn;

    $sql = "INSERT INTO Businesses (business_name, address, contact_phone, email, date, type_of_business) VALUES ('$businessName', '$address', '$contactPhone', '$email', '$date', '$typeOfBusiness')";
    
    $result = $conn->query($sql);

    return $result;
}

// Add other admin-related functions as needed

?>
