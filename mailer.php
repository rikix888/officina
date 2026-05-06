<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require __DIR__.'/vendor/PHPMailer-master/src/Exception.php';
require __DIR__.'/vendor/PHPMailer-master/src/PHPMailer.php';
require __DIR__.'/vendor/PHPMailer-master/src/SMTP.php';
require_once __DIR__."/classi/database.php";

$db = new database();
$r = $db->query("SELECT CodiceOTP FROM user WHERE email='{$_SESSION['email']}'");
$cod = $r->fetch_assoc();


//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'esercizio-5binf@ismonnet.eu';                     //SMTP username
    $mail->Password   = 'hjmr bcab tegm oshp';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('esercizio-5binf@ismonnet.eu', 'NoReply');
    $mail->addAddress($_SESSION['email']);     //Add a recipient
    //$mail->addReplyTo('info@example.com', 'Information');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    //Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Account activation';
    $mail->Body    = '<p>Thank you for registering! Please click the link below to activate your account:</p>
                    <a href="http://localhost/rick/esEsame/active.php?otp='.$cod['CodiceOTP'].'">Activate Account</a>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mail</title>
</head>
<body>
    <h2>Controlla la tua casella di posta elettronica e attiva il tuo account</h2>
    <h3>Una volta attivato, potrai accedere al sistema</h3>
</body>
</html>