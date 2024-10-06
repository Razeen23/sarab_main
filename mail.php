<?php 
// print_r($_POST);
// exit;

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $formType = $_POST['form_type'];
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $mobile = htmlspecialchars($_POST['number']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

    $mail = new PHPMailer(true);
    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'shippingsarab@gmail.com';
        $mail->Password = 'ykvn dgjj sqwn kkqf'; // Use an app-specific password if using Gmail
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Recipients
        $mail->setFrom('shippingsarab@gmail.com', 'Enquiry Message');
        $mail->addAddress('info@sarabshipping.ae'); // Set recipient email

        // Handle different form types
        if ($formType == 'service_form') {
            $mail->Subject = "Service Request from $name: $subject";
            $mail->Body = "Name: $name\nEmail: $email\nMessage: {$_POST['subject']}";
        } elseif ($formType == 'contact_form') {
            $mail->Subject = "Contact Form Submission from $name: $subject";
            $mail->Body = "Name: $name\nEmail: $email\nPhone: $mobile\nMessage: $message";
        }

        $mail->send();
        echo 'Email sent successfully!';
    } catch (Exception $e) {
        echo "Failed to send email. Error: {$mail->ErrorInfo}";
    }
}







/* 1. step one
 1.	Once 2FA is enabled, go back to your Google Account page.
	2.	Go to Security again.
	3.	Under “Signing in to Google”, find and click App passwords. You may need to verify your account login again.
	4.	In the Select App dropdown, choose Mail (or select Other if you prefer a custom name for the app).
	5.	In the Select Device dropdown, choose Other (or pick from the provided options), and give it a name like “PHPMailer”.
	6.	Click Generate.
Google will give you a 16-character app-specific password. Copy this password—you won’t be able to view it again once you close the window.

2. step two Use the App-Specific Password in PHPMailer

Once you have the app-specific password, use it in place of your Gmail password in your PHPMailer configuration.
 */