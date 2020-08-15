<?php
/*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*
* Created By PhpStorm
* Author : MOONCN
* Date : 2020/8/15
* Time : 15:04:29
* Blog : http://mooncn.win
*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*/

//DB information
$db_host = "localhost";
$db_user_name = "root";
$db_user_pass = "root";
$db_name = "test";

//access key
$key = "mooncn.win";

//SMTP Server Information
$mail_deliver = true; //Default Enable The Mail Deliver data function.
$smtp_host = "smtp.sample.com";// Set the SMTP server to send through
$smtp_auth = true;//true or false Enable SMTP authentication
$smtp_username = "username@sample.com";// SMTP username
$smtp_password = "password";// SMTP password
$smtp_port = "465";// TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

//max server space backup files nums.
$max_backup = 0;