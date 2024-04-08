<?php
// Connect to the database
$servername = "localhost";
$username = "your_username";
$password = "your_password";
$dbname = "your_database";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Validate the email address
if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    echo "Invalid email address";
    exit();
}

// Check if the email address already exists in the database
$email = $_POST["email"];
$sql = "SELECT * FROM mailing_list WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo "Email address already exists in the mailing list";
    exit();
}

// Add the email address to the database
$sql = "INSERT INTO mailing_list (email) VALUES (?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();

// Send a confirmation email to the user
$to = $email;
$subject = "Thank you for subscribing!";
$body = "Thank you for subscribing to our mailing list! You will now receive updates and news from us.";
$headers = "From: your_email@example.com";

if (mail($to, $subject, $body, $headers)) {
    echo "Subscription successful! Please check your email for a confirmation message.";
} else {
    echo "Error sending confirmation email";
}

$stmt->close();
$conn->close();
?>
