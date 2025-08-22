<?php
session_start();
include("db.php");
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'admin\PHPmailer\Exception.php';
require 'admin\PHPmailer\PHPMailer.php';
require 'admin\PHPmailer\SMTP.php';

if(isset($_POST['save']))
{
    extract($_POST);
    $sel1="SELECT * FROM otp WHERE email='$email' AND otp='$otpf'";
    $res1=$con->query($sel1);
    $count=$res1->num_rows;
    if($count>0)
    {
        $ins="INSERT INTO students SET name='$name',email='$email',username='$username',password='$pass'";
        $con->query($ins);
        $sel="SELECT * FROM students WHERE email='$email'";
        $r=$con->query($sel);
        if($r->num_rows>0)
        {
            while($row=$r->fetch_assoc())
            {
                $_SESSION['sid']=$row['id'];
                $_SESSION['stu_user_name']=$row['username'];
                $_SESSION['stu_name']=$row['name'];
                $_SESSION['semail']=$row['email'];
                $_SESSION['spassword']=$row['password'];
                
            }
            
           //Create an instance; passing true enables exceptions
           $mail = new PHPMailer(true);

           try 
           {
                //Server settings
                // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                  //Enable SMTP authentication
                $mail->Username   = 'suddhasatwamallick7@gmail.com';                     //SMTP username
                $mail->Password   = '';                               //SMTP password 
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS
            
                //Recipients
                $mail->setFrom('suddhasatwamallick7@gmail.com', 'Codverse OTP');
                $mail->addAddress($email, $name);     //Add a recipient

                // Attach the image to be embedded
                $mail->addEmbeddedImage('wrapper/img/codeverse.jpg', 'codeverse-logo');


                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'Welcome to CODEVERSE! Account Successfully Created';
                $mail->Body    = "Dear $name,<br> Welcome to CODEVERSE!<br>We're thrilled to have you onboard as part of our growing community of coders and problem solvers. Your account has been successfully created, and you're just a step away from diving into exciting coding challenges.
                <br><h3>Here are your account details:</h3>
                <ul>
                <li>Username : $username</li>
                <li>Email: $email</li>
                </ul>
                <br>
                <h3>What sets us apart?<h3>
                <p>In addition to our coding contests and vast library of practice problems, we're proud to introduce a special feature that enhances your coding experience:</p>
                <p><span style='color:black;font-weight:bold;'>Time Complexity Analysis</span>: Our advanced IDE not only helps you write and test code but also analyzes the time complexity of your solutions in real-time. You can refine your algorithms and optimize your code with deeper insights into its performance.</p>
                <br>
                <h3>Ready to start coding?<h3>
                <ul>
                <li>Participate in live coding contests and rank up on the leaderboard.</li>
                <li>Practice with hundreds of coding problems across various topics.</li>
                <li>Sharpen your skills with hundreds of practice problems.</li>
                <li>Join the community forum to discuss, learn, and share coding knowledge.</li>
                </ul>
                <br>
                <p>If you have any questions or need help, don't hesitate to reach out. We're here to support you on your coding journey!</p>
                <p>Thanks for choosing CODEVERSE, Beyond Code,Beyond Limits.</p>
                
                <img src='cid:codeverse-logo' alt='Codeverse Logo'><br>" ;
            

                $mail->send();
                 $msg='An OTP has been sent to your mail '.$email;
            } 
            catch (Exception $e) 
            {
                //  echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
            $del="DELETE FROM otp WHERE email='$email'";
            $con->query($del);
            header("location:index.php");

        }
    }
    else
    {
        echo "<script>
        alert('Server error!! Try again later');
        window.location.href='login_signup.php';
        </script>";
    }
}
else
{
    
    echo "<script>
    alert('Some error occurred');
    window.location.href='login_signup.php';
    </script>";
}



?>
