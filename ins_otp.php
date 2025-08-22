<?php
session_start();
include("db.php");
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

extract($_POST);
$sql="SELECT * FROM students WHERE email='$email'";
$res=$con->query($sql);
if($res->num_rows>0)
{
  $_SESSION['email_error']='Email Already taken';
  header("location:login_signup.php");
  exit;
}
else
{
  $sql="SELECT * FROM students WHERE username='$username'";
  $res=$con->query($sql);
  if($res->num_rows>0)
  {
    $_SESSION['username_error']='Username Already taken';
    header("location:login_signup.php");
    exit;
  }
}
$otp=rand(1111,9999);
$ins="INSERT INTO otp SET email='$email',otp='$otp'";
$con->query($ins);

//Load Composer's autoloader
require 'admin\PHPmailer\Exception.php';
require 'admin\PHPmailer\PHPMailer.php';
require 'admin\PHPmailer\SMTP.php';
//Create an instance; passing true enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'suddhasatwamallick7@gmail.com';                     //SMTP username
    $mail->Password   = 'ilte nibl bzvh towt';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS

    //Recipients
    $mail->setFrom('suddhasatwamallick7@gmail.com', 'Codverse OTP');
    $mail->addAddress($email, $name);     //Add a recipient

    // Attach the image to be embedded
    $mail->addEmbeddedImage('wrapper/img/codeverse.jpg', 'codeverse-logo');


    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'OTP Credentials';
    $mail->Body    = "Your One time password is:$otp <br> <img src='cid:codeverse-logo' alt='Codeverse Logo'><br>" ;


    $mail->send();
     $msg='An OTP has been sent to your mail '.$email;
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>OTP Authentication</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <link href="wrapper/img/logo.png" rel="icon">
</head>
<body>

  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          
          <div class="card-body">
            <!-- User Input for OTP -->
            <form action="ins.php" method="post">
              <div class="form-group mt-4">
                <label for="inputOtp"><h1>Enter OTP</h1></label>
                <input type="text" class="form-control" name="otpf" id="inputOtp" placeholder="Enter OTP">
              </div>
              <input type="hidden" name="name" value="<?php echo $name; ?>">
              <input type="hidden" name="email" value="<?php echo $email; ?>">
              <input type="hidden" name="username" value="<?php echo $username; ?>">
              <input type="hidden" name="pass" value="<?php echo $pass; ?>">
             <input type="submit" class="btn btn-success btn-block" name="save" value="Verify OTP" id="verifyOtpBtn">
             
              <!-- Feedback Alerts -->
              <div id="alertBox" class="alert alert-info mt-3 d-none" role="alert">
                <span id="alertMessage"><?php echo $msg; ?></span>
              </div>
            </form>
            <div class="mt-5" id="countdown"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
<script>
        $(document).ready(function() {
            var totalTime = 150; // Total countdown duration in seconds

            // Check if the countdown start time is already stored in localStorage
            var startTime = localStorage.getItem('startTime');
            var currentTime = Math.floor(Date.now() / 1000); // Current time in seconds

            if (!startTime) {
                // If no start time is set, set the start time to the current time
                startTime = currentTime;
                localStorage.setItem('startTime', startTime);
            }

            // Calculate the time elapsed since the countdown started
            var elapsedTime = currentTime - startTime;

            // Calculate remaining time
            var timeLeft = totalTime - elapsedTime;

            if (timeLeft <= 0) {
                // If time has already expired, redirect immediately
                window.location.href = "login_signup.php";
            }

            // Start the countdown
            var countdownInterval = setInterval(function() {
                timeLeft--;

                // Update the countdown display
                $('#countdown').text("Time Left: " + timeLeft + " seconds");

                // When the time runs out, clear the interval and redirect
                if (timeLeft <= 0) {
                    clearInterval(countdownInterval);
                    localStorage.removeItem('startTime'); // Clear the saved start time
                    window.location.href = "login_signup.php";
                }
            }, 1000); // Update every second (1000 ms)
        });
    </script>
</html>