<?php
session_start();

// Check if the business name is in the session
if (isset($_SESSION['business_name'])) {
    $businessName = $_SESSION['business_name'];

    // Generate the certificate image
    $certificateImage = generateCertificateImage($businessName);

    // Output the image to the browser
    header('Content-Type: image/png');
    header('Content-Disposition: attachment; filename="certificate.png"');
    
    // Output the image content
    imagepng($certificateImage);
    imagedestroy($certificateImage);
    exit();
} else {
    echo "Business name not found in session.";
}

// Function to generate the certificate image dynamically
function generateCertificateImage($businessName)
{
    // Set the image dimensions
    $width = 800;
    $height = 600;

    // Create a blank image
    $certificate = imagecreatetruecolor($width, $height);

    // Set background color to white
    $backgroundColor = imagecolorallocate($certificate, 255, 255, 255);
    imagefill($certificate, 0, 0, $backgroundColor);

    // Set text color to black
    $textColor = imagecolorallocate($certificate, 0, 0, 0);

    // Add business name text to the certificate
    imagestring($certificate, 5, 100, 200, $businessName, $textColor);

    // Return the generated image resource
    return $certificate;
}
?>
