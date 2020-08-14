<?php
/*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*
* Created By PhpStorm
* Author : MOONCN
* Date : 2020/8/14
* Time : 6:35:10
* Blog : http://mooncn.win
*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*/
/*
 * before use it please edit this area for mysql server information
 */
require_once "MySQLDump.php";
//require_once "MySQLImport.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

//DB information
$db_host = "localhost";
$db_user_name = "root";
$db_user_pass = "root";
$db_name = "test";


//Password Defined Prevent Not Kind People do something
$key = $_GET['key'];
if ($key != "mooncn.win") {
    Header("HTTP/1.1 404 Not Found");
    exit();
}
$db = new mysqli($db_host, $db_user_name, $db_user_pass, $db_name);
try {
    $dump = new MySQLDump($db);
} catch (Exception $e) {
}
$filename = $db_name . "_" . date("yymd_hms") . rand(65535, 999999). ".sql.gz";
//filename
$dump->save($filename);
//mail deliver
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_OFF;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->CharSet = 'UTF-8';                                   //set the charset
    $mail->Host = 'smtp.example.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth = true;                                   // Enable SMTP authentication
    $mail->Username = 'no-reply@mooncn.win';                     // SMTP username
    $mail->Password = 'password here';                               // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port = 456;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('no-reply@mooncn.win', '自动邮件');
//    $mail->addAddress('joe@example.net', 'Joe User');     // Add a recipient
    $mail->addAddress('Joho@163.com');               // Name is optional
    $mail->addReplyTo('no-reply@mooncn.win', 'Information');
//    $mail->addCC('cc@example.com');
//    $mail->addBCC('bcc@example.com');

    // Attachments
    $mail->addAttachment($filename);         // Add attachments
//    $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'This Is Subject';
    $mail->Body = 'This is Mail Body and Support <b>html</b>'.$filename;
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Mail has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
