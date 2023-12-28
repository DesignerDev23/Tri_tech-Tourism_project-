<?php
// Include the admin functions file
include_once '../functions/admin_functions.php';
include_once 'loader.php';

// Check if the user is logged in and is an admin
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'user') {
    header("Location: ../index.php");
    exit();
}

// Initialize $conn variable
$conn = new mysqli("localhost", "tritech1_ktb", "Musa@abdulkadir", "tritech1_ktb");

// Check if the connection is successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle the add business form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $businessName = $_POST["business_name"];
    $address = $_POST["address"];
    $contactPhone = $_POST["contact_phone"];
    $email = $_POST["email"];
    $date = $_POST["date"];
    $typeOfBusiness = $_POST["type_of_business"];

    // Add business to the database
    $result = addBusiness($businessName, $address, $contactPhone, $email, $date, $typeOfBusiness);

    if ($result) {
        // Save business name in the session for certificate display
        $_SESSION['business_name'] = $businessName;

        // Get the business ID from the last inserted business
        $businessId = $conn->insert_id;

        // Insert data into the revenue table
        $rrrCode = $_POST["rrr_code"];
        $amountPaid = $_POST["amount_paid"];

        $revenueQuery = "INSERT INTO revenue (rrr_code, amount_paid) 
                         VALUES ('$rrrCode', '$amountPaid')";
        $revenueResult = $conn->query($revenueQuery);

        if (!$revenueResult) {
            echo "Error adding revenue information: " . $conn->error;
        }

        // Redirect to the certificate display page
        header("Location: certificate_display.php");
        exit();
    } else {
        echo "Error adding business: " . $conn->error;
    }

}

// Close the database connection
$conn->close();
?>
<!-- Your HTML content for the add business form goes here -->


<!-- Your HTML content for the add business form goes here -->




<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!-- <meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5"> -->
	<meta name="author" content="Kano Tourism Board ">
	<meta name="keywords" content="Kano Tourism Board , bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="../img/icons/icon-48x48.png" />

	<link rel="canonical" href="https://demo-basic.Kano Tourism Board .io/pages-blank.php" />

	<title>Add Business | Kano Tourism Board</title>
    <script src="https://js.paystack.co/v1/inline.js"></script>
	<link href="../css/app.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
	<div class="wrapper">
	<nav id="sidebar" class="sidebar js-sidebar">
			<div class="sidebar-content js-simplebar">
				<a class="sidebar-brand" href="index.php">
          <span class="align-middle">Kano Tourism Board</span>
        </a>

				<ul class="sidebar-nav">
					<li class="sidebar-header">
						Management
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="index.php">
              <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
            </a>
					</li>

					<!-- <li class="sidebar-item">
						<a class="sidebar-link" href="profile.php">
              <i class="align-middle" data-feather="user"></i> <span class="align-middle">Profile</span>
            </a>
					</li> -->

					<li class="sidebar-header">
						Manage Users
					</li>


					<!-- <li class="sidebar-item ">
						<a class="sidebar-link" href="add_user.php">
              <i class="align-middle" data-feather="user-plus"></i> <span class="align-middle">Add User</span>
            </a>
					</li> -->

					<!-- <li class="sidebar-item">
						<a class="sidebar-link" href="manage_users.php">
              <i class="align-middle" data-feather="users"></i> <span class="align-middle">Manage Users</span>
            </a>
					</li>

					<li class="sidebar-header">
						Manage Business
					</li> -->


					<li class="sidebar-item active">
						<a class="sidebar-link" href="add_business.php">
              <i class="align-middle" data-feather="file-plus"></i> <span class="align-middle">Add Business</span>
            </a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="manage_businesses.php">
              <i class="align-middle" data-feather="folder"></i> <span class="align-middle">Manage Businesses</span>
            </a>
					</li>

					<!-- <li class="sidebar-item">
						<a class="sidebar-link" href="view_revenue.php">
              <i class="align-middle" data-feather="dollar-sign"></i> <span class="align-middle">View Revenue</span>
            </a>
					</li> -->

					<li class="sidebar-item">
						<a class="sidebar-link" href="view_report.php">
              <i class="align-middle" data-feather="book"></i> <span class="align-middle">View Report</span>
            </a>
					</li>

			

					<li class="sidebar-header">
						Activities
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="transactions.php">
              <i class="align-middle" data-feather="credit-card"></i> <span class="align-middle">Transactions</span>
            </a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="reports.php">
              <i class="align-middle" data-feather="file-plus"></i> <span class="align-middle">Generate Report</span>
            </a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="remita/index.php">
              <i class="align-middle" data-feather="file-plus"></i> <span class="align-middle">Generate Invoice</span>
            </a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="remita/checktransactionstatus.php">
              <i class="align-middle" data-feather="file-plus"></i> <span class="align-middle">Check Payment Status</span>
            </a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="settings.php">
              <i class="align-middle" data-feather="settings"></i> <span class="align-middle">Settings</span>
            </a>
					</li>


					<li class="sidebar-header">
						log out
					</li>

				
					<li class="sidebar-item">
						<a class="sidebar-link" href="logout.php">
              <i class="align-middle" data-feather="log-out"></i> <span class="align-middle">Logout</span>
            </a>
					</li>
				
				

				
			</div>
		</nav>

		<div class="main">
			<nav class="navbar navbar-expand navbar-light navbar-bg">
				<a class="sidebar-toggle js-sidebar-toggle">
          <i class="hamburger align-self-center"></i>
        </a>

				<div class="navbar-collapse collapse">
					<ul class="navbar-nav navbar-align">
						<li class="nav-item dropdown">
							<a class="nav-icon dropdown-toggle" href="#" id="alertsDropdown" data-bs-toggle="dropdown">
								<div class="position-relative">
									<i class="align-middle" data-feather="bell"></i>
									<span class="indicator">4</span>
								</div>
							</a>
							<div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0" aria-labelledby="alertsDropdown">
								<div class="dropdown-menu-header">
									4 New Notifications
								</div>
								<div class="list-group">
									<a href="#" class="list-group-item">
										<div class="row g-0 align-items-center">
											<div class="col-2">
												<i class="text-danger" data-feather="alert-circle"></i>
											</div>
											<div class="col-10">
												<div class="text-dark">Update completed</div>
												<div class="text-muted small mt-1">Restart server 12 to complete the update.</div>
												<div class="text-muted small mt-1">30m ago</div>
											</div>
										</div>
									</a>
									<a href="#" class="list-group-item">
										<div class="row g-0 align-items-center">
											<div class="col-2">
												<i class="text-warning" data-feather="bell"></i>
											</div>
											<div class="col-10">
												<div class="text-dark">Lorem ipsum</div>
												<div class="text-muted small mt-1">Aliquam ex eros, imperdiet vulputate hendrerit et.</div>
												<div class="text-muted small mt-1">2h ago</div>
											</div>
										</div>
									</a>
									<a href="#" class="list-group-item">
										<div class="row g-0 align-items-center">
											<div class="col-2">
												<i class="text-primary" data-feather="home"></i>
											</div>
											<div class="col-10">
												<div class="text-dark">Login from 192.186.1.8</div>
												<div class="text-muted small mt-1">5h ago</div>
											</div>
										</div>
									</a>
									<a href="#" class="list-group-item">
										<div class="row g-0 align-items-center">
											<div class="col-2">
												<i class="text-success" data-feather="user-plus"></i>
											</div>
											<div class="col-10">
												<div class="text-dark">New connection</div>
												<div class="text-muted small mt-1">Christina accepted your request.</div>
												<div class="text-muted small mt-1">14h ago</div>
											</div>
										</div>
									</a>
								</div>
								<div class="dropdown-menu-footer">
									<a href="#" class="text-muted">Show all notifications</a>
								</div>
							</div>
						</li>
						<li class="nav-item dropdown">
							<a class="nav-icon dropdown-toggle" href="#" id="messagesDropdown" data-bs-toggle="dropdown">
								<div class="position-relative">
									<i class="align-middle" data-feather="message-square"></i>
								</div>
							</a>
							<div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0" aria-labelledby="messagesDropdown">
								<div class="dropdown-menu-header">
									<div class="position-relative">
										4 New Messages
									</div>
								</div>
								<div class="list-group">
									<a href="#" class="list-group-item">
										<div class="row g-0 align-items-center">
											<div class="col-2">
												<img src="../img/avatars/avatar-5.jpg" class="avatar img-fluid rounded-circle" alt="Vanessa Tucker">
											</div>
											<div class="col-10 ps-2">
												<div class="text-dark">Vanessa Tucker</div>
												<div class="text-muted small mt-1">Nam pretium turpis et arcu. Duis arcu tortor.</div>
												<div class="text-muted small mt-1">15m ago</div>
											</div>
										</div>
									</a>
									<a href="#" class="list-group-item">
										<div class="row g-0 align-items-center">
											<div class="col-2">
												<img src="../img/avatars/avatar-2.jpg" class="avatar img-fluid rounded-circle" alt="William Harris">
											</div>
											<div class="col-10 ps-2">
												<div class="text-dark">William Harris</div>
												<div class="text-muted small mt-1">Curabitur ligula sapien euismod vitae.</div>
												<div class="text-muted small mt-1">2h ago</div>
											</div>
										</div>
									</a>
									<a href="#" class="list-group-item">
										<div class="row g-0 align-items-center">
											<div class="col-2">
												<img src="../img/avatars/avatar-4.jpg" class="avatar img-fluid rounded-circle" alt="Christina Mason">
											</div>
											<div class="col-10 ps-2">
												<div class="text-dark">Christina Mason</div>
												<div class="text-muted small mt-1">Pellentesque auctor neque nec urna.</div>
												<div class="text-muted small mt-1">4h ago</div>
											</div>
										</div>
									</a>
									<a href="#" class="list-group-item">
										<div class="row g-0 align-items-center">
											<div class="col-2">
												<img src="../img/avatars/avatar-3.jpg" class="avatar img-fluid rounded-circle" alt="Sharon Lessman">
											</div>
											<div class="col-10 ps-2">
												<div class="text-dark">Sharon Lessman</div>
												<div class="text-muted small mt-1">Aenean tellus metus, bibendum sed, posuere ac, mattis non.</div>
												<div class="text-muted small mt-1">5h ago</div>
											</div>
										</div>
									</a>
								</div>
								<div class="dropdown-menu-footer">
									<a href="#" class="text-muted">Show all messages</a>
								</div>
							</div>
						</li>
						<li class="nav-item dropdown">
							<a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
                <i class="align-middle" data-feather="settings"></i>
              </a>

							<a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                <img src="../img/avatars/avatar.jpg" class="avatar img-fluid rounded me-1" alt="Charles Hall" /> <?php echo "<span>Welcome, {$_SESSION['full_name']}!</span>";
?>
              </a>
							<div class="dropdown-menu dropdown-menu-end">
								<a class="dropdown-item" href="profile.php"><i class="align-middle me-1" data-feather="user"></i> Profile</a>
								<a class="dropdown-item" href="#"><i class="align-middle me-1" data-feather="pie-chart"></i> Analytics</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="index.php"><i class="align-middle me-1" data-feather="settings"></i> Settings & Privacy</a>
								<a class="dropdown-item" href="#"><i class="align-middle me-1" data-feather="help-circle"></i> Help Center</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="logout.php">Log out</a>
							</div>
						</li>
					</ul>
				</div>
			</nav>

			<main class="content">
            <div class="container-fluid p-0">
                <h1 class="h3 mb-3">Create New Business</h1>
                <form method="post" action="add_business.php" class="col-12 col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Add Business</h5>
                        </div>
                        <div class="card-body">
                            <p style="font-size: 14px; margin-bottom: 5px; margin-top: 15px;">Business Name</p>
                            <input type="text" name="business_name" class="form-control" required>

                            <p style="font-size: 14px; margin-bottom: 5px; margin-top: 15px;">Address</p>
                            <input type="text" name="address" class="form-control" required>

                            <p style="font-size: 14px; margin-bottom: 5px; margin-top: 15px;">Contact Phone</p>
                            <input type="text" name="contact_phone" class="form-control" required>

                            <p style="font-size: 14px; margin-bottom: 5px; margin-top: 15px;">Email</p>
                            <input type="text" name="email" class="form-control" required>

                            <p style="font-size: 14px; margin-bottom: 5px; margin-top: 15px;">Date</p>
                            <input type="date" name="date" class="form-control" required>

                            <p style="font-size: 14px; margin-bottom: 5px; margin-top: 15px;">Business Type</p>
							<select name="type_of_business" class="form-control" required>
								<option value="">-- select --</option>
								<option value="Hotel">Hotel</option>
								<option value="Restaurant">Restaurant</option>
								<option value="Event Center">Event Center</option>
								<option value="Travel Agency">Travel Agency</option>
								<option value="Bakery">Bakery</option>
								<option value="Suya Spot">Suya Spot</option>
								<option value="Recreation center">Recreation center</option>
							</select>
							<p style="font-size: 14px; margin-bottom: 5px; margin-top: 15px;">RRR Code</p>
							<input type="text" name="rrr_code" class="form-control" required>

							<p style="font-size: 14px; margin-bottom: 5px; margin-top: 15px;">Amount Paid</p>
							<input type="text" name="amount_paid" class="form-control" required>

							<!-- <p style="font-size: 14px; margin-bottom: 5px; margin-top: 15px;">Created At</p>
							<input type="text" name="created_at" class="form-control" required>

							<p style="font-size: 14px; margin-bottom: 5px; margin-top: 15px;">Status</p>
							<input type="text" name="status" class="form-control" required> -->


                            <button type="submit" class="btn btn-success" style="width: 93%; margin: 20px;">Add Business</button>
                        </div>
                    </div>
                </form>
            </div>
        </main>
			<footer class="footer">
				<div class="container-fluid">
					<div class="row text-muted">
						<div class="col-6 text-start">
							<p class="mb-0">
								<a class="text-muted" href="https://Kano Tourism Board .io/" target="_blank"><strong>Kano Tourism Board </strong></a> - <a class="text-muted" href="https://Kano Tourism Board .io/" target="_blank"><strong>Tri-Tech Consaltancy LTD</strong></a>								&copy;
							</p>
						</div>
						<div class="col-6 text-end">
							<ul class="list-inline">
								<li class="list-inline-item">
									<a class="text-muted" href="https://Kano Tourism Board .io/" target="_blank">Support</a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" href="https://Kano Tourism Board .io/" target="_blank">Help Center</a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" href="https://Kano Tourism Board .io/" target="_blank">Privacy</a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" href="https://Kano Tourism Board .io/" target="_blank">Terms</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</footer>
		</div>
	</div>

	<script src="js/app.js"></script>


    <!-- <script>
        function payWithPaystack() {
            var businessId = document.getElementsByName("business_id")[0].value;

            var handler = PaystackPop.setup({
                key: 'pk_test_12658c234f2075a824b3e5862ac5a6b31fc5cd4f', // Replace with your Paystack public key
                email: 'user@example.com', // Replace with the customer's email
                amount: 500000, // Replace with the amount to charge in kobo
                currency: 'NGN', // Replace with the currency code
                ref: 'business_registration_' + Math.floor((Math.random() * 1000000000) + 1), // Replace with a unique reference for the transaction
                callback: function (response) {
                    // Handle the payment success
                    // Fetch the required information from the Paystack response
                    var transactionReference = response.reference;
                    var amountPaid = response.amount;
                    var paymentStatus = response.status;

                    // Now call the function to save payment information
                    savePaymentInfoToRevenue(businessId, transactionReference, amountPaid, paymentStatus);

                    // You can also submit the form if needed
                    document.forms[0].submit();
                },
                onClose: function () {
                    alert('Payment was not completed');
                }
            });
            handler.openIframe();
        }
    </script> -->
</body>

</html>