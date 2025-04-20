<?php

session_start();

// Check if the user is authenticated
if (!isset($_SESSION["user_id"])) {
    // Set HTTP response code to 401 Unauthorized
    http_response_code(401);

    // Redirect to the login page
    header("Location: ../auth/sign-in/index.php");
    exit;
}

echo "Wow you are authenticated!!!";
