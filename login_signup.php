<?php
session_start();
if(isset($_SESSION['stu_user_name']))
{
  header("location:index.php");
}
// $email = isset($_GET['email']) ? htmlspecialchars($_GET['email']) : '';
if(isset($_GET['email']))
{
  $email=$_GET['email'];
}
else
{
  $email='';
}

if(isset($_GET['destination']))
{
  $destination=$_GET['destination'];
}
else{
  $destination='index.php';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>CODEVERSE Login/Signup</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="wrapper/img/logo.png" rel="icon">
  <link href="wrapper/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Bootstrap CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  
  <!--Bootstrap Icons-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  
  <!-- Main CSS File -->
  <link id="theme-stylesheet" href="wrapper/css/main.css" rel="stylesheet">
  <link href="wrapper/css/style.css" rel="stylesheet">
</head>

<body class="index-page">

<?php  include("inc/header_Login.php")  ?>
    <section id="hero" class="">
      <!-- <div class="hero-bg">
        <img src="wrapper/img/hero-bg-light.webp" alt="">
      </div> -->
      <div class="container text-center">
        <div class="d-flex flex-column justify-content-center align-items-center">
          <div class="wrapper">
    
    <div class="form-container me-2">
                                  <!--login error-->
                                      <?php
                                      if(isset($_SESSION['wrong_password']))
                                      {
                                      ?>
                                  <div class="alert alert-danger" role="alert">     
                                      <?php 
                                      echo $_SESSION['wrong_password']; 
                                      unset($_SESSION['wrong_password']);
                                      ?>
                                  </div>
                                    <?php 
                                     }
                                     elseif(isset($_SESSION['wrong_credentials']))
                                     { 
                                     ?>
                                    <div class="alert alert-danger" role="alert">     
                                      <?php 
                                      echo $_SESSION['wrong_credentials']; 
                                      unset($_SESSION['wrong_credentials']);
                                      ?>
                                    </div>
                                  <?php } ?>
                                  <!--Signup error-->
                                  <?php
                                      if(isset($_SESSION['email_error']))
                                      {
                                        ?>
                                  <div class="alert alert-danger" role="alert">     
                                      <?php 
                                      echo $_SESSION['email_error']; 
                                      unset($_SESSION['email_error']);
                                      ?>
                                  </div>
                                    <?php 
                                     }
                                     elseif(isset($_SESSION['username_error']))
                                     { 
                                     ?>
                                    <div class="alert alert-danger" role="alert">     
                                      <?php 
                                      echo $_SESSION['username_error']; 
                                      unset($_SESSION['username_error']);
                                      ?>
                                    </div>
                                  <?php } ?>
      <div class="slide-controls">
        <input type="radio" name="slide" id="login">
        <input type="radio" name="slide" id="signup">
        <label for="login" class="slide login">Login</label>
        <label for="signup" class="slide signup">Signup</label>
        <div class="slider-tab"></div>
      </div>
      <div class="form-inner">

        <!-- LOGIN -->
        <form  action="logcheck.php" method="post" class="login">
          <div class="field">
            <input type="text" name="name" placeholder="Email or username" required>
          </div>
          <div class="field">
            <input type="password" class="mt-3" name="pass" placeholder="Password" required>
          </div>
             <input type="hidden" name="destination" value="<?php echo $destination; ?>">
            <input type="submit" class="mt-5" value="Login" name="save" id="btn">
        </form>

        <!-- SIGNUP -->

        <form action="ins_otp.php" method="post" class="signup">
          <div class="field">
            <?php
            $position=strpos($email,'@');
            $name=substr($email,0,$position);
            ?>
            <input type="text" name="name" placeholder="NAME"  required>
          </div>
          <div class="field">
            <input type="email" name="email" placeholder="EMAIL" value="<?php echo $email; ?>" required>
          </div>
          <div class="field">
            <input type="text" name="username" placeholder="USER NAME" value="<?php echo $name; ?>" required>
          </div>
          <div class="field">
            <input type="password" name="pass" placeholder="password" required>
          </div>
          <div class="form-check form-check-inline mt-2">
               <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1" require>
               <label class="form-check-label" for="inlineCheckbox1">I agree to <a href="terms.php">Codeverse's Terms</a> and <a href="privacy_policy.php">Privacy Policy</a></label>
          </div>
            <input type="submit" name="save" value="Signup" id="btn">
        </form>
      </div>
    </div>
  </div>
  <p class="mt-2">For any issues or assistance, email <a href="mailto:codeversequeries@gmail.com">codeversequeries@gmail.com <i class="bi bi-envelope-at-fill"></i></a></p>
        </div>
      </div>
    </section>


  <!-- Vendor JS Files -->
  <script src="wrapper/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="wrapper/vendor/php-email-form/validate.js"></script>
  <script src="wrapper/vendor/aos/aos.js"></script>
  <script src="wrapper/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="wrapper/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Main JS File -->
  <script src="wrapper/js/main.js"></script>
  <script src="wrapper/js/js.js"></script>
  <script src="wrapper/js/jquery.js"></script>
  <script src="wrapper/js/mode.js"></script>

</body>

</html>