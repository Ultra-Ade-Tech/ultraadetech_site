<?php
    // Define some variables
    $name = $email = $subject = $message = "";
    $nameErr = $emailErr = $subjectErr = $messageErr = "";

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

        // Validate subject
        if (empty($_POST["subject"])) {
            $subject = "New Enquiries From The Website";
        } else {
            $subject = test_input($_POST["subject"]);
        }

        // Validate message
        if (empty($_POST["message"])) {
            $messageErr = "Message is required";
        } else {
            $message = test_input($_POST["message"]);
        }

        // If no errors, send email
        if ($nameErr == "" && $emailErr == "" && $subjectErr == "" && $messageErr == "") {
            $to = "info@ultraadetech.com";
            $body = "From: $name\nSubject: $subject\nMessage:\n$message";
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
