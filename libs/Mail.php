<?php


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

class Mail
{
    private $useLocal;
    private $recipient;
    private $recipientName;//'edward.burton@closettocleaners.com'
    function __construct($recipient = 'muhzubairali@gmail.com',
                         $recipientName='Muhammad Zubair',
                         $local = true)
    {
        $this->useLocal = $local;
        $this->recipient = $recipient;
        $this->recipientName = $recipientName;
    }

    function send($senderName,$senderMail, $subject, $htmlMsg, $txtMsg='', $attachments=null, $useLocal=false){
        if($this->useLocal){
            $message = empty($htmlMsg) ? $txtMsg : $htmlMsg;
            return $this->sendLocal($senderMail,$senderName,$subject,$message);
        }

        $subject = strip_tags($subject);

        $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
        try {
            //Server settings
            //$mail->SMTPDebug = 2;                                 // Enable verbose debug output
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'mail.smtp2go.com';  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'etherconnect@outlook.com';                 // SMTP username
            $mail->Password = 'London@1pakistan';                           // SMTP password
            $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 443;                                    // TCP port to connect to

            //Recipients
            $mail->setFrom($senderMail, $senderName);
            $mail->addAddress($this->recipient,$this->recipientName);     // Add a recipient

            $mail->addReplyTo($senderMail, $senderName);

            //Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body    = $htmlMsg;
            if(!empty($txtMsg))
                $mail->AltBody = $txtMsg;

            $mail->send();
            return array(
                "status" => 1,
                "msg" => "Successfully sent email by '{$senderMail}'"
            );
        } catch (Exception $e) {
            return array(
                "status" => 0,
                "errmsg" => 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo
            );
        }
    }


    function sendLocal($sender,$senderName, $subject, $message){
        $subject = strip_tags($subject);

        $headers = "From: {$senderName} <" . $sender . ">\r\n";
        $headers .= "To: {$this->recipient}\r\n";
        $headers .= "Reply-To: {$sender}\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

        if(mail($sender, $subject, $message, $headers))
            $result = array(
                "status" => 1
            );
        else
            $result = array(
                "status" => 0,
                "errmsg" => "Failed to send email"
            );
        return $result;
    }

}

