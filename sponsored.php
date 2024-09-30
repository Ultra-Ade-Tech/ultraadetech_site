<?php
// Initialize variables to store form data and error messages
$firstname = $lastname = $email = $phone = $workStatus = $educationStatus = $publishReason = $waiverCode = "";
$firstnameErr = $lastnameErr = $emailErr = $waiverCodeErr = "";

// Array of 5 valid waiver codes
$validWaiverCodes = [
    'WAIVER2024',
    'STUDENT50',
    'EARLYBIRD',
    'ULTRA001',
    'PAPER001'
];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize first name
    if (empty($_POST["firstname"])) {
        $firstnameErr = "First name is required";
    } else {
        $firstname = test_input($_POST["firstname"]);
        if (!preg_match("/^[a-zA-Z-' ]*$/", $firstname)) {
            $firstnameErr = "Only letters and white space allowed";
        }
    }

    // Validate and sanitize last name
    if (empty($_POST["lastname"])) {
        $lastnameErr = "Last name is required";
    } else {
        $lastname = test_input($_POST["lastname"]);
        if (!preg_match("/^[a-zA-Z-' ]*$/", $lastname)) {
            $lastnameErr = "Only letters and white space allowed";
        }
    }

    // Validate and sanitize email
    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = test_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        }
    }

    // Sanitize other inputs
    $phone = test_input($_POST["phone"]);
    $workStatus = test_input($_POST["workStatus"]);
    $educationStatus = test_input($_POST["educationStatus"]);
    $publishReason = test_input($_POST["publishReason"]);

    // Validate waiver code
    $waiverCode = test_input($_POST["waiverCode"]);
    if (!empty($waiverCode) && !in_array($waiverCode, $validWaiverCodes)) {
        $waiverCodeErr = "Invalid waiver code";
    }

    // If there are no errors, process the form and send email
    if (empty($firstnameErr) && empty($lastnameErr) && empty($emailErr) && empty($waiverCodeErr)) {
        // Prepare email content
        $to = "info@ultraadetech.com";
        $subject = "New Webinar Registration";
        $message = "A new webinar registration has been submitted:\n\n";
        $message .= "Name: $firstname $lastname\n";
        $message .= "Email: $email\n";
        $message .= "Phone: $phone\n";
        $message .= "Work Status: $workStatus\n";
        $message .= "Education Status: $educationStatus\n";
        $message .= "Reason for Publishing: $publishReason\n";
        $message .= "Waiver Code: " . ($waiverCode ? $waiverCode : "No code used") . "\n";

        $headers = "From: webmaster@ultraadetech.com" . "\r\n" .
                   "Reply-To: $email" . "\r\n" .
                   "X-Mailer: PHP/" . phpversion();

        // Send email
        if(mail($to, $subject, $message, $headers)) {
            // Determine the next step based on waiver code
            if (!empty($waiverCode) && in_array($waiverCode, $validWaiverCodes)) {
                echo "Registration successful! Your waiver code has been applied. You're all set for the webinar!";
                // Redirect to a thank you page for waiver users
                // header("Location: waiver-thank-you.php");
            } else {
                echo "Registration successful! Please proceed to make the payment.";
                // Redirect to payment page
                // header("Location: payment.php");
            }
            // exit();
        } else {
            echo "Sorry, there was an error processing your registration. Please try again later.";
        }
    }
}

// Function to sanitize input data
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>