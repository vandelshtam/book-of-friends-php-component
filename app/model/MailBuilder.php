<?php 
namespace App\model;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

class MailBuilder{

    private $mail;
    
    public function __construct(
        PHPMailer $mail)
    {
        $this->mail = $mail;
    }
    
    public function mail_to($email, $username, $body_mail){

       
try {
    //Server settings
    //$this->mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $this->mail->isSMTP();                                            //Send using SMTP
    $this->mail->Host       = 'smtp.mailtrap.io';                     //Set the SMTP server to send through
    $this->mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $this->mail->Username   = 'd27b253b09edb2';                       //SMTP username
    $this->mail->Password   = '717e3dd6eaf3e0';                       //SMTP password
    $this->mail -> SMTPSecure = 'tls' ;                               //Enable implicit TLS encryption
    $this->mail->Port       = 2525;                                   //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $this->mail->setFrom('from@example.com', 'book-of-friends-php-component');
    $this->mail->addAddress($email, $username);                 //Add a recipient
    $this->mail->addAddress('ellen@example.com');               //Name is optional
    $this->mail->addReplyTo('info@example.com', 'Information');
    $this->mail->addCC('cc@example.com');
    $this->mail->addBCC('bcc@example.com');

    

    //Content
    $this->mail->isHTML(true);                                  //Set email format to HTML
    $this->mail->Subject = 'Here is the subject';
    $this->mail->Body    = $body_mail;
    $this->mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $this->mail->send();
    flash()->warning('Message has been sent');
    //echo 'Message has been sent';
} catch (Exception $e) {
    flash()->error("Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
    header('Location: /book-of-friends-php-component/registerShow');  
   // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

}
}