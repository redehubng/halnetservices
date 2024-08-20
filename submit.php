<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if(isset($_POST['submitContact'])) 
{
    $fullname = $_POST['name'];
    $email = $_POST['email'];
    $phonenumber = $_POST['phone_number'];
    $company = $_POST['company'];
    $services = $_POST['services'];
    $additionaldetails = $_POST['additional_details'];


    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication

        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->Username   = 'johnvictordml@gmail.com';                     //SMTP username
        $mail->Password   = 'pdqr btfa xadg ejiy';                               //SMTP password
        
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //ENCRYPTION_SMTPS 465 - Enable implicit TLS encryption
        $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('johnvictordml@gmail.com', 'Halnet Services');
        $mail->addAddress('johnvictordml@gmail.com', 'Joe User');     //Add a recipient

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'New Order - Halnet Services';
        $mail->Body    = '<h3>Hello, you got a new enquiry:</h3>
            <h3>Name: '.$fullname.'</h3>
            <h3>Email: '.$email.'</h3>
            <h3>Phone Number: '.$phonenumber.'</h3>
            <h3>Company: '.$company.'</h3>
            <h3>General Inquiry: '.$services.'</h3>
            <h3>Aditional Details: '.$additionaldetails.'</h3>
        ';

        if($mail->send())
        {
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
}
else {
    header('Location: index.html');
    exit(0);
}

?>