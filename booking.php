<?php
// Define some variables
$name = $email = $phone = $date = $service = $message = "";
$nameErr = $emailErr = $phoneErr = $dateErr = $serviceErr = $messageErr = "";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate name
    if (empty($_POST["name"])) {
        $nameErr = "Name is required";
    } else {
        $name = test_input($_POST["name"]);
    }

    // Validate email
    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = test_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        }
    }

    // Validate phone
    if (empty($_POST["phone"])) {
        $phoneErr = "Phone is required";
    } else {
        $phone = test_input($_POST["phone"]);
    }

    // Validate date
    if (empty($_POST["date"])) {
        $dateErr = "Preferred date is required";
    } else {
        $date = test_input($_POST["date"]);
    }

    // Validate service
    if (empty($_POST["service"])) {
        $serviceErr = "Service is required";
    } else {
        $service = test_input($_POST["service"]);
    }

    // Validate message
    if (empty($_POST["message"])) {
        $message = "";
    } else {
        $message = test_input($_POST["message"]);
    }

    // If no errors, send email
    if ($nameErr == "" && $emailErr == "" && $phoneErr == "" && $dateErr == "" && $serviceErr == "") {
        $to = "info@ultraadetech.com";
        $subject = "New Booking Request";
        $body = "Name: $name\nEmail: $email\nPhone: $phone\nPreferred Date: $date\nService: $service\nMessage: $message";
        $headers = "From: $email";

        if (mail($to, $subject, $body, $headers)) {
            header("Location: thank-you.html");
        } else {
            echo "Error sending email";
        }
    }
}

// Function to clean input data
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
