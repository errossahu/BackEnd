<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
class Email extends CI_Controller{

    function  __construct(){
        parent::__construct();
    }

    function send(){
        require 'vendor/autoload.php';
        $mail = new PHPMailer(true);   

        try {
            //Server settings
            $mail->SMTPDebug = 0;                                 // Enable verbose debug output
            $mail->isSMTP();                                      // Setmailer touse SMTP
            $mail->Host = 'smtp.gmail.com';  // Specify main andbackup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'tubespaw1920@gmail.com';                 // SMTP username
            $mail->Password= 'tubespaw1234567890';                           // SMTP password
            $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 465;                                    // TCP port toconnectto
            //Recipients
            $mail->setFrom('tubespaw1920@gmail.com', 'MakanYuk');
            $mail->addAddress('chrisnamahendra@gmail.com', 'greg');     // Adda recipient
            //$mail->addAddress('ellen@example.com');               // Nameisoptional
            //$mail->addReplyTo('info@example.com', 'Information');
            //$mail->addCC('cc@example.com');
            //$mail->addBCC('bcc@example.com');
            //Attachments
            //$mail->addAttachment('/var/tmp/file.tar.gz');         // Addattachments
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
            //Content
            $mail->isHTML(true);                                  // Setemail format toHTML
            $mail->Subject = 'RESET PASSWORD';
            $mail->Body    = 'Hallo ini emailnya pbp bos';
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo 'Please cek your email, your password has been reseted', $mail->ErrorInfo;
        }
    }

}