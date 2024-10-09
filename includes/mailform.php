<?php
header("Content-Type: text/html; charset=utf-8",true);
require 'PHPMailerAutoload.php';
require 'class.phpmailer.php';

    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $message = filter_input(INPUT_POST, 'message', FILTER_DEFAULT);

    $email = filter_var($email, FILTER_VALIDATE_EMAIL);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $output = json_encode(array('success' => false, 'text' => 'O email inserido nao e valido!'));
        header("Content-Type: application/json", true);
        die($output);
    }

$mail = new PHPMailer;

$mail->IsSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.live.com';                 // Specify main and backup server
$mail->Port = 587;                                    // Set the SMTP port
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'bruno.m.onofre@hotmail.com';                // EMAIL AQUI CARALHO!
$mail->Password = 'vermelhao!!!123';                  // PASSE SENAO NAO ENTRAS!!!
$mail->SMTPSecure = 'tls';                            // Enable encryption, 'ssl' also accepted

$mail->From = $email;
$mail->FromName = $name;
$mail->AddAddress('geral.costaphone@gmail.com');  // LEANDRO!! ESTE E O EMAIL QUE RECEBE OS EMAILS! AQUELE EMAIL EM CIMA E O QUE OS ENVIA! NAO FAZ MAL SE FOR O MESMO!

$mail->IsHTML(true);                                  // Set email format to HTML

$mail->Subject = "Contacto ProMobile - " . $name;
$mail->Body = $message . "\r\n \r\n" . $name . "\r\n" . $email;
$mail->AltBody = $message . "\r\n \r\n" . $name . "\r\n" . $email;

if(!$mail->Send()) {
    $output = json_encode(array('success' => false, 'text' => 'Ocorreu um erro durante o envio do seu e-mail, por favor tente de novo!'));
    header("Content-Type: application/json", true);
    die($output);
}else{
    $output = json_encode(array('success' => true, 'text' => 'O seu e-mail foi enviado com sucesso!'));
    header("Content-Type: application/json", true);
    die($output);
}