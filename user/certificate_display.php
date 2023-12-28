<?php
session_start();
include_once 'loader.php';
// Check if the business name is in the session
if (isset($_SESSION['business_name'])) {
    $businessName = $_SESSION['business_name'];

    // Display the certificate dynamically
    echo generateCertificateHTML($businessName);
} else {
    echo "Business name not found in session.";
}

// Function to generate the certificate HTML dynamically
function generateCertificateHTML($businessName)
{
    // Certificate template background image URL
    $certificateBackground = 'certificates/certificate.png';

    // Business name styles
    $businessNameStyles = "
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        font-size: 14px;
        // width: 100%;
        font-weight: bold;
        color: #000; /* Set text color to white */
        /* Add a subtle text shadow for better visibility */
        letter-spacing: 2px; /* Adjust letter spacing for better readability */
        max-width: 100%; /* Limit the width of the business name for responsiveness */
        line-height: 1.5; /* Set line height for better spacing */
        text-align: center; /* Center the text */
    ";

    // Certificate HTML
    $certificateHTML = "
        <!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Certificate</title>
            <style>
           
            @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@600&display=swap');
       
                body {
                    font-family: 'Outfit', sans-serif;
                    margin: 0;
                    padding: 0;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    height: 100vh;
                    
                    background-size: cover;
                 
                }

                #certificate {
                    position: absolute;
                    // margin-left: -300px;
                }

                #businessName {
                    $businessNameStyles
                    // margin-top: 40px;
                    // margin-left: 100px;
                }

                #certificate img {
                    width: 80%; /* Make the image fill the container */
                    height: auto; /* Maintain aspect ratio */
                    display: block; /* Remove any extra spacing */
                    margin: 0 auto; /* Center the image */
                }
                
                button {
                    margin-top: 40%;/* Add spacing between the business name and the button */
                    padding: 10px 20px;
                    z-index: 19;
                    font-size: 16px;
                    background-color: #4caf50; /* Green background color */
                    color: #fff; /* White text color */
                    border: none;
                    border-radius: 5px;
                    cursor: pointer;
                }

                button:hover {
                    background-color: #45a049; /* Darker green color on hover */
                }
            </style>
            <style media='print'>
                body {
                    background: url('$certificateBackground') no-repeat center center;
                    background-size: cover;
                }
                button {
                    display: none; /* Hide the button when printing */
                }
            </style>
        </head>
        <body>
            <div id='certificate'>
                <img src='$certificateBackground' alt='Certificate Background'>
                <div id='businessName'>$businessName</div>
            </div>
            <button onclick='printCertificate()'>Print Certificate</button>

            <script>
                function printCertificate() {
                    window.print();
                }
            </script>
        </body>
        </html>
    ";

    return $certificateHTML;
}
?>
