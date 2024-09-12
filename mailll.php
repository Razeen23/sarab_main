<?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get the form fields and remove whitespace.
        $name = strip_tags(trim($_POST["name"]));
        $name = str_replace(array("\r","\n"),array(" "," "),$name);
        $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
        $form_subject = trim($_POST["subject"]);
        $number = trim($_POST["number"]);
        $message = trim($_POST["message"]);


//         echo "Name: " . $name;
// echo "Email: " . $email;
// echo "Subject: " . $form_subject;
// echo "Number: " . $number;
// echo "Message: " . $message;
        // Validate input data.
        if (empty($name) || empty($message) || empty($number) || empty($form_subject) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            http_response_code(400);
            echo "Please complete the form and try again.";
            exit;
        }

        // Set the recipient email address.
        $recipient = "makerrazeen2301@gmail.com"; 

        // Set the email subject.
        $subject = "New contact from " . htmlspecialchars($form_subject, ENT_QUOTES, 'UTF-8');

        // Build the email content.
        $email_content = "Name: $name\n";
        $email_content .= "Subject: $form_subject\n";
        $email_content .= "Email: $email\n\n";
        $email_content .= "Message:\n$message\n";

        // Build the email headers.
        $email_headers = "From: " . filter_var($email, FILTER_SANITIZE_EMAIL) . "\r\n";

        // Send the email.
        if (mail($recipient, $subject, $email_content, $email_headers)) {
            http_response_code(200);
            echo "Thank You! Your message has been sent.";
        } else {
            http_response_code(500);
            echo "Oops! Something went wrong and we couldn't send your message.";
        }

    } else {
        http_response_code(403);
        echo "There was a problem with your submission, please try again.";
    }

?>