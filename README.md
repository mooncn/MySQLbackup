# MySQLbackup
MySQL Database backup and use the file as attachment mail to an mail address
# Description
This Program IS a little tool for mysql database backup ande mail to some address,  
use [PHPMailer](https://github.com/PHPMailer/PHPMailer) and [MySQL-dump](https://github.com/dg/MySQL-dump) to compose.  
lisence obey BSD-3-Clause License and LGPL-2.1 License
# USE IT 
It is very easy to use  
1.clone the source code  
2.```composer install```  
3.edit the source code
```
//DB information
$db_host = "localhost";
$db_user_name = "root";
$db_user_pass = "root";
$db_name = "test";
```
change it for your own's db information.  
and next change the smtp server information.

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



