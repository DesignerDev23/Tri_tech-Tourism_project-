<?php
// Start the session
session_start();

// Destroy all session data
session_destroy();

// Redirect to the main login page
header("Location: ../index.php");
exit();
?>
