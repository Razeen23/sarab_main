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
        $mail->Username = 'rockrooki09@gmail.com';
        $mail->Password = 'ugej qjzf xvzq xode'; // Use an app-specific password if using Gmail
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Recipients
        $mail->setFrom('rockrooki09@gmail.com', 'Enquiry Message');
        $mail->addAddress('makerrazeen2301@gmail.com'); // Set recipient email

        // Handle different form types
        if ($formType == 'service_form') {
            $mail->Subject = "Service Request from $name: $subject";
            $mail->Body = "Name: $name\nEmail: $email\nWeight: {$_POST['number']}\nDistance: {$_POST['number3']}\nMessage: {$_POST['subject']}";
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