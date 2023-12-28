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
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- <meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5"> -->
	<meta name="author" content="Kano Tourism Board ">
	<meta name="keywords" content="Kano Tourism Board">

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="img/icons/icon-48x48.png" />

	<link rel="canonical" href="https://demo-basic.Kano Tourism Board .io/pages-sign-in.html" />

	<title>Sign In | Kano Tourism Board</title>

	<link href="css/app.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
	<main class="d-flex w-100">
		<div class="container d-flex flex-column">
			<div class="row vh-100">
				<div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 mx-auto d-table h-100">
					<div class="d-table-cell align-middle">

						<div class="text-center mt-4">
							<h1 class="h2">Welcome back!</h1>
							<p class="lead">
								Sign in to your account to continue
							</p>
						</div>

						<div class="card">
							<div class="card-body">
								<div class="m-sm-3">
									<form method="post" action="">
										<div class="mb-3">


										<!-- <form method="post" action="">
        <label for="username">Username:</label>
        <input type="text" name="username" required>

        <label for="password">Password:</label>
        <input type="password" name="password" required>

        <button type="submit">Login</button>
    </form> -->


											<label class="form-label">Username</label>
											<input class="form-control form-control-lg" type="text" name="username" placeholder="Enter your Username" />
										</div>
										<div class="mb-3">
											<label class="form-label">Password</label>
											<input class="form-control form-control-lg" type="password" name="password" placeholder="Enter your password" />
										</div>
										<div>
											<div class="form-check align-items-center">
												<input id="customControlInline" type="checkbox" class="form-check-input" value="remember-me" name="remember-me" checked>
												<label class="form-check-label text-small" for="customControlInline">Remember me</label>
											</div>
										</div>
										<div class="d-grid gap-2 mt-3">
										<button type="submit" class="btn btn-lg btn-primary">Login</button>
											<!-- <a href="index.html" class="btn btn-lg btn-primary">Sign in</a> -->
										</div>
									</form>
								</div>
							</div>
						</div>
						<div class="text-center mb-3">
							<!-- Don't have an account? <a href="pages-sign-up.html">Sign up</a> -->
						</div>
					</div>
				</div>
			</div>
		</div>
	</main>

	<script src="js/app.js"></script>

</body>

</html>