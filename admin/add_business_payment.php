<!-- admin/add_business_payment.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Include your head content, like meta tags, styles, and scripts -->
</head>
<body>
    <script src="https://js.paystack.co/v1/inline.js"></script>
    
    <script>
        function payAndRedirect() {
            var handler = PaystackPop.setup({
                key: 'pk_test_12658c234f2075a824b3e5862ac5a6b31fc5cd4f',
                email: 'user@example.com', // Replace with user's email
                amount: 500000, // Replace with the actual amount
                currency: 'NGN', // Replace with the appropriate currency code
                ref: 'business_payment_' + Math.floor((Math.random() * 1000000000) + 1),
                callback: function (response) {
                    // Handle payment success
                    if (response.status === 'success') {
                        // Redirect to the business registration page
                        window.location.href = 'add_business.php';
                    } else {
                        alert('Payment was not completed');
                    }
                },
                onClose: function () {
                    alert('Payment was not completed');
                }
            });

            handler.openIframe();
        }
    </script>

    <button onclick="payAndRedirect()">Pay for Business Registration</button>

    <!-- Include your footer content if needed -->
</body>
</html>
