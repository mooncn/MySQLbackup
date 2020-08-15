<?php
/*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*
* Created By PhpStorm
* Author : MOONCN
* Date : 2020/8/14
* Time : 6:35:10
* Blog : http://mooncn.win
*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*/
/*
 * before use it please edit config.php.
 */
require_once "config.php";
require_once "MySQLDump.php";

//require_once "MySQLImport.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';


//Password Defined Prevent Not Kind People do something
$get_key = $_GET['key'];
if ($get_key != $key) {
    Header("HTTP/1.1 404 Not Found");
    exit();
}
$db = new mysqli($db_host, $db_user_name, $db_user_pass, $db_name);
try {
    $dump = new MySQLDump($db);
} catch (\Exception $e) {
}
$filename = $db_name . "_" . date("yymd_His") . rand(65535, 999999) . ".sql.gz";
//filename
try {
    $dump->save($filename);
} catch (\Exception $e) {
}


//Clean Overlap BackUp Files
$dir = dirname(__FILE__);
$file = scandir($dir);

$backup_files = array();
foreach ($file as $value) {

    if (strpos($value, $db_name."_") !== false) {
        array_push($backup_files, $value);
    }
}

$local_backup_files_num = count($backup_files);

if ($local_backup_files_num > $max_backup) {

    rsort($backup_files);//Order the array for delete files;
    for ($curr = $local_backup_files_num; $curr > $max_backup; $curr--) {
        unlink($backup_files[$curr - 1]);
        echo "Already Clear Old BackUp Files" . $backup_files[$curr - 1];
    }
}



//mail deliver
if (!$mail_deliver) exit("Mail deliver not enable");
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_OFF;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->CharSet = 'UTF-8';                                   //set the charset
    $mail->Host = $smtp_host;
    $mail->SMTPAuth = $smtp_auth;
    $mail->Username = $smtp_username;
    $mail->Password = $smtp_password;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port = $smtp_port;

    //Recipients
    $mail->setFrom('no-reply@mooncn.win', 'AutoSend');
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
    $mail->Subject = 'This Is An AutoBackUp Email';
    $mail->Body = 'This is Mail Body and Support <b>html</b>,The backup data is ' . $filename . ' which is attched.';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Mail has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
