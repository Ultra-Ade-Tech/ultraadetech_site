<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Define variables and set to empty values
    $name = $valuableInfo = $objectives = $presenterRating = $paceDuration = $visualAids = $audioVideoQuality = $technicalIssues = $futureTopics = $recommendation = $suggestions = $learned = $impact = $exploreFurther = "";

    // Validate and sanitize input data
    if (isset($_POST['name'])) {
        $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    }

    if (isset($_POST['valuableInfo'])) {
        $valuableInfo = filter_var($_POST['valuableInfo'], FILTER_SANITIZE_STRING);
    }

    if (isset($_POST['objectives'])) {
        $objectives = filter_var($_POST['objectives'], FILTER_SANITIZE_STRING);
    }

    if (isset($_POST['presenterRating'])) {
        $presenterRating = filter_var($_POST['presenterRating'], FILTER_SANITIZE_STRING);
    }

    if (isset($_POST['paceDuration'])) {
        $paceDuration = filter_var($_POST['paceDuration'], FILTER_SANITIZE_STRING);
    }

    if (isset($_POST['visualAids'])) {
        $visualAids = filter_var($_POST['visualAids'], FILTER_SANITIZE_STRING);
    }

    if (isset($_POST['audioVideoQuality'])) {
        $audioVideoQuality = filter_var($_POST['audioVideoQuality'], FILTER_SANITIZE_STRING);
    }

    if (isset($_POST['technicalIssues'])) {
        $technicalIssues = filter_var($_POST['technicalIssues'], FILTER_SANITIZE_STRING);
    }

    if (isset($_POST['futureTopics'])) {
        $futureTopics = filter_var($_POST['futureTopics'], FILTER_SANITIZE_STRING);
    }

    if (isset($_POST['recommendation'])) {
        $recommendation = filter_var($_POST['recommendation'], FILTER_SANITIZE_STRING);
    }

    if (isset($_POST['suggestions'])) {
        $suggestions = filter_var($_POST['suggestions'], FILTER_SANITIZE_STRING);
    }

    if (isset($_POST['learned'])) {
        $learned = filter_var($_POST['learned'], FILTER_SANITIZE_STRING);
    }

    if (isset($_POST['impact'])) {
        $impact = filter_var($_POST['impact'], FILTER_SANITIZE_STRING);
    }

    if (isset($_POST['exploreFurther'])) {
        $exploreFurther = filter_var($_POST['exploreFurther'], FILTER_SANITIZE_STRING);
    }

    // Prepare the email content
    $to = "info@ultraadetech.com";
    $subject = "Webinar Feedback";
    $message = "Name: $name\n";
    $message .= "Most Valuable Info: $valuableInfo\n";
    $message .= "Objectives: $objectives\n";
    $message .= "Presenter Rating: $presenterRating\n";
    $message .= "Pace and Duration: $paceDuration\n";
    $message .= "Visual Aids: $visualAids\n";
    $message .= "Audio/Video Quality: $audioVideoQuality\n";
    $message .= "Technical Issues: $technicalIssues\n";
    $message .= "Future Topics: $futureTopics\n";
    $message .= "Recommendation Likelihood: $recommendation\n";
    $message .= "Suggestions: $suggestions\n";
    $message .= "Learned Application: $learned\n";
    $message .= "Understanding Impact: $impact\n";
    $message .= "Explore Further: $exploreFurther\n";

    // Additional headers
    $headers = "From: webinar@ultraadetech.com\r\n";
    $headers .= "Reply-To: webinar@ultraadetech.com\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();

    // Send the email
    if (mail($to, $subject, $message, $headers)) {
        // Redirect to a thank you page or display a thank you message
        header("Location: thank-you.html");
        exit;
    } else {
        // Handle email sending failure
        echo "Failed to send email.";
    }
} else {
    // If the form is not submitted, redirect to the form page
    header("Location: feedback-form.html");
    exit;
}
?>
