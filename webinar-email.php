<?php
// Set the recipient email address
$to = 'info@ultraadetech.com';

// Set the subject of the email
$subject = 'New Webinar Registration: Pending Payment';

// Check if the waiver code is provided and valid
$waiverCode = isset($_POST['waiverCode']) ? $_POST['waiverCode'] : '';
if ($waiverCode === 'WEBINAR31') {
    $subject = 'New Webinar Registration: Waiver Code Applied';
    $successPage = 'success.html';
} else {
    $successPage = 'https://mainstack.store/ultraadetech/2G5_0-63V8iD';
}

// Set the message body of the email
$message = 'First Name: ' . $_POST['firstname'] . "\n";
$message .= 'Last Name: ' . $_POST['lastname'] . "\n";
$message .= 'Email: ' . $_POST['email'] . "\n";
$message .= 'Phone: ' . $_POST['phone'] . "\n";
$message .= 'Work Status: ' . $_POST['workStatus'] . "\n";
$message .= 'Education Status: ' . $_POST['educationStatus'] . "\n";
$message .= 'Reason for Publishing: ' . $_POST['publishReason'] . "\n";
$message .= 'Waiver Code Option: ' . $_POST['waiverCodeOption'] . "\n";
if ($waiverCode) {
    $message .= 'Waiver Code: ' . $waiverCode . "\n";
}

// Set the headers of the email
$headers = 'From: ' . $_POST['email'];

// Send the email
if (mail($to, $subject, $message, $headers)) {
    // The email was sent successfully
    // Redirect the user to the appropriate success page
    header('Location: ' . $successPage);
} else {
    // The email was not sent successfully
    // Redirect the user to an error page
    header('Location: error.html');
}
?>
