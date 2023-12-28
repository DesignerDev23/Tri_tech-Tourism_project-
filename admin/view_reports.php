<?php
// Include the admin functions file
include_once '../functions/admin_functions.php';

// Check if the user is logged in and is an admin
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../index.php");
    exit();
}

// Your code to retrieve and display reports goes here

echo "<h2>View Reports</h2>";

// Implement functions to retrieve and display reports in admin_functions.php

?>

<!-- Your HTML content for displaying reports goes here -->
