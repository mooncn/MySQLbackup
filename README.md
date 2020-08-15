# MySQLbackup
MySQL Database backup and use the file as attachment mail to an mail address
# Description
This Program IS a little tool for mysql database backup ande mail to some address,  
Add Automatic delete old backup files. please edit it in config.php
use [PHPMailer](https://github.com/PHPMailer/PHPMailer) and [MySQL-dump](https://github.com/dg/MySQL-dump) to compose.  
lisence obey BSD-3-Clause License and LGPL-2.1 License
# USE IT 
It is very easy to use  
1.Clone the source code to local 
2.Install PHPMailer```composer install```  
3.Edit the config.php
change it for your own's db information.  
and next change the smtp server information.  
You can decide to enable or disable the mail deliver function.

```
//DB information
$db_host = "localhost";
$db_user_name = "root";
$db_user_pass = "root";
$db_name = "test";

//access key 
$key = "mooncn.win";

//SMTP Server Information
$mail_deliver = true; //Default Enable The Mail Deliver data function.
$smtp_host = "";// Set the SMTP server to send through
$smtp_auth = true;//true or false Enable SMTP authentication
$smtp_username = "";// SMTP username
$smtp_password = "";// SMTP password
$smtp_port = "";// TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

//max server space backup files nums.
$max_backup = 3;
```
### upload those files to you site, it also support second-level directory
Then set a time job .  
access the file ```http://sample.com/yourdir/autobackupdb.php?key=yourkey```  
