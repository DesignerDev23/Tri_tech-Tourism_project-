<?php
include_once '../config/config.php'; // Adjust the path as needed

// Check if user ID is provided
if (isset($_POST['userId'])) {
    $userId = $_POST['userId'];

    // Perform deletion
    $sql = "DELETE FROM users WHERE user_id = $user_id";
    
    if ($conn->query($sql) === TRUE) {
        $response = array('success' => true, 'message' => 'User deleted successfully');
    } else {
        $response = array('success' => false, 'message' => 'Error deleting user: ' . $conn->error);
    }
} else {
    $response = array('success' => false, 'message' => 'User ID not provided');
}

// Return JSON response
header('Content-Type: application/json');
echo json_encode($response);

// Close the database connection
$conn->close();
?>
