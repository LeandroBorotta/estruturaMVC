<?php

namespace App\Services;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class EmailService {
    protected static $host = 'smtp.gmail.com';
    protected static $emailSuporte = "leandroborotta2006@gmail.com";
    protected static $senhaSuporte = "sjktqofsswdlfyil";
    protected static $smtpSecure = "tls";
    protected static $port = 587;


    public static function enviarEmail($para, $assunto, $mensagem) {
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = self::$host;
            $mail->SMTPAuth = true;
            $mail->Username = self::$emailSuporte;
            $mail->Password = self::$senhaSuporte;
            $mail->SMTPSecure = self::$smtpSecure;
            $mail->Port = self::$port;

            $mail->setFrom(self::$emailSuporte);
            $mail->addAddress($para);

            $mail->isHTML(true);
            $mail->Subject = $assunto;
            $mail->Body = $mensagem;

            $mail->send();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}