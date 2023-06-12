<?php
require 'PHPMailer.php';
require 'Exception.php';
require 'SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate form fields
    $name = isset($_POST["name"]) ? $_POST["name"] : "";
    $email = isset($_POST["email"]) ? $_POST["email"] : "";
    $message = isset($_POST["message"]) ? $_POST["message"] : "";

    // Check if required fields are empty
    if (empty($name) || empty($email) || empty($message)) {
        echo "Please fill in all required fields.";
        exit;
    }

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format.";
        exit;
    }

    try {
        // Set up PHPMailer
        $mail = new PHPMailer(true);
        
        // SMTP configuration
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Replace with your SMTP server
        $mail->Port = 587; // Replace with the appropriate port number
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'tls'; // Use 'tls' for STARTTLS encryption
        
        // Replace with your email address and password
        $mail->Username = 'sohamchakraborty18.edu@gmail.com';
        $mail->Password = 'uiccsennnewlluqn';
        
        // Email content
        $mail->setFrom($email, $name);
        $mail->addAddress('sohamchakraborty18.edu@gmail.com'); // Replace with the recipient email address
        $mail->Subject = 'New message from your portfolio website';
        $mail->Body = $message;
        
        // Send the email
        $mail->send();
        
        echo "Message sent successfully.";
    } catch (Exception $e) {
        echo "Failed to send message. Please try again." . $mail->ErrorInfo;
    }
}
?>