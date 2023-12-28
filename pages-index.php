<?php
// Include the database connection file
include_once 'config/config.php';

// Check if the user is already logged in, redirect to the appropriate dashboard
session_start();
if (isset($_SESSION['user_id'])) {
    if ($_SESSION['role'] == 'admin') {
        header("Location: admin/index.php");
        exit();
    } elseif ($_SESSION['role'] == 'user') {
        header("Location: user/index.php");
        exit();
    }
}

// Handle login form submission
// ... (previous code)

// ... (previous code)

// Handle login form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Use prepared statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();

        // Set session variables
        $_SESSION['user_id'] = $row['user_id'];
        $_SESSION['role'] = $row['role'];
        $_SESSION['username'] = $row['username'];

        // Set the full name in the session
        $_SESSION['full_name'] = $row['full_name'];

        // Redirect to the appropriate dashboard
        if ($row['role'] == 'admin') {
            header("Location: admin/index.php");
            exit();
        } elseif ($row['role'] == 'user') {
            header("Location: user/index.php");
            exit();
        }
    } else {
        $error_message = "Invalid username or password";
    }

    $stmt->close();
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- You can add additional stylesheets or scripts here -->
</head>
<body>

    <h2>Login</h2>

    <?php
    if (isset($error_message)) {
        echo "<p style='color:red;'>$error_message</p>";
    }
    ?>

    <form method="post" action="">
        <label for="username">Username:</label>
        <input type="text" name="username" required>

        <label for="password">Password:</label>
        <input type="password" name="password" required>

        <button type="submit">Login</button>
    </form>

    <!-- You can add additional HTML content or links here -->

</body>
</html>
