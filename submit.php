<?php
session_start();

require 'vendor/autoload.php';  // Include Composer's autoloader

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Dotenv\Dotenv;

// Load environment variables from .env file
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['submitContact'])) {
    $fullname = $_POST['name'];
    $email = $_POST['email'];
    $phonenumber = $_POST['phone_number'];
    $company = $_POST['company'];
    $services = $_POST['services'];
    $additionaldetails = $_POST['additional_details'];

    // Create a new instance of PHPMailer
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();                                            // Send using SMTP
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Host       = $_ENV['SMTP_HOST'];                     // Set the SMTP server to send through
        $mail->Username   = $_ENV['SMTP_USERNAME'];                 // SMTP username
        $mail->Password   = $_ENV['SMTP_PASSWORD'];                 // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;          // Enable TLS encryption
        $mail->Port       = $_ENV['SMTP_PORT'];                     // TCP port to connect to

        // Recipients
        $mail->setFrom($_ENV['SMTP_FROM_EMAIL'], $_ENV['SMTP_FROM_NAME']);
        $mail->addAddress($_ENV['SMTP_FROM_EMAIL'], 'Joe User');    // Add a recipient

        // Content
        $mail->isHTML(true);                                       
        $mail->Subject = 'New Order - Halnet Services';
        $mail->Body    = '<h3>Hello, you got a new enquiry:</h3>
            <h3>Name: ' . htmlspecialchars($fullname) . '</h3>
            <h3>Email: ' . htmlspecialchars($email) . '</h3>
            <h3>Phone Number: ' . htmlspecialchars($phonenumber) . '</h3>
            <h3>Company: ' . htmlspecialchars($company) . '</h3>
            <h3>General Inquiry: ' . htmlspecialchars($services) . '</h3>
            <h3>Additional Details: ' . htmlspecialchars($additionaldetails) . '</h3>';

        // Send the email
        if ($mail->send()) {
            $_SESSION['status'] = "Thank you for reaching out to us - Halnet Services";
            header("Location: {$_SERVER["HTTP_REFERER"]}");
            exit(0);
        } else {
            $_SESSION['status'] = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            header("Location: {$_SERVER["HTTP_REFERER"]}");
            exit(0);
        }

    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    header('Location: index.html');
    exit(0);
}
?>
