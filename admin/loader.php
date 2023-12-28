<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KTB Portal</title>
    <style>
        body {
            margin: 0;
            overflow: hidden;
        }

        #loader-wrapper {
            position: fixed;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            background-color: rgba(255, 255, 255, 0.7);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
        }

        #loader {
            border: 16px solid #f3f3f3;
            border-top: 16px solid #3498db;
            border-radius: 50%;
            width: 80px;
            height: 80px;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
    <div id="loader-wrapper">
        <div id="loader"></div>
    </div>
    <script>
        // Hide the loader after 5 seconds
        setTimeout(function() {
            document.getElementById("loader-wrapper").style.display = "none";
        }, 1050);
    </script>
</body>
</html>
