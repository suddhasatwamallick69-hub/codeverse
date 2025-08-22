<?php
session_start();
include("db.php");
ob_start();
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

    extract($_POST);
    $sel="SELECT * FROM teacher WHERE email='$email'";
    $res=$con->query($sel);
    if($res->num_rows==0)
    {
        $ins="INSERT INTO teacher SET name='$name',email='$email',username='$username',password='$password'";
        $con->query($ins);
        //Load Composer's autoloader
        require 'PHPmailer\Exception.php';
        require 'PHPmailer\PHPMailer.php';
        require 'PHPmailer\SMTP.php';


     //Create an instance; passing `true` enables exceptions
     $mail = new PHPMailer(true);

     try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'suddhasatwamallick7@gmail.com';                     //SMTP username
        $mail->Password   = '';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('suddhasatwamallick7@gmail.com', 'Codverse Admin');
        $mail->addAddress($email, $name);     //Add a recipient

        // Attach the image to be embedded
        $mail->addEmbeddedImage('img/codeverse.jpg', 'codeverse-logo');
   
    
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Login Credentials';
        $mail->Body    = "Hello $name <br> We are delighted to welcome you to Codeverse <br> 
        We believe that your skills and experience will be a valuable addition to our team, and we are excited to begin this journey with you.
        <br> To help you get started, we have created your employee account in our system. Below, you will find the details you need to log in to your Codeverse account and access our internal resources.
        <br> <h3>Login Details</h3> <br> Username:$username <br> Password:$password <br>We are thrilled to have you on board and look forward to your contributions to our team's success. Please feel free to reach out to your manager or HR if you have any questions or need further assistance.
        <br> <h4>Best Regards</h4><img src='cid:codeverse-logo' alt='Codeverse Logo'><br>" ;
    

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
        header("location:list_teacher.php");
        ob_end_flush();
    }
    else
    {
        echo "<script>alert('email already exists')
        window.location.href='registerteacher.php';
        </script>";

    }

?>
