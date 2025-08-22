<?php
session_start();
include("db.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Online Coding Practice - CODEVERSE</title>
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

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>

<body class="starter-page-page">

   <?php  include("inc/header.php")  ?>
          <div class="page-title" id="starter-section">
              <div class="container d-lg-flex justify-content-between align-items-center" >
                        <h1 class="mb-2 mb-lg-0">Contact Us</h1>
                        <nav class="breadcrumbs">
                              <ol>
                                  <li><a href="index.php">Home</a></li>
                                  <li class="current">Contact Us</li>
                              </ol>
                        </nav>
              </div>
          </div>
    <section class="section contact-us" id="contact-us">
        <div class="container">
            <div class="row g-5">
                <div class="col-md-4 col-sm-6">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="details-box">
                                  <h3><i class="bi bi-exclamation-square-fill"></i>  General</h3>
                                  <p>For general, contest & platform related queries</p>
                                  <a href="mailto:codeversequeries@gmail.com">codeversequeries@gmail.com <i class="bi bi-envelope-at-fill"></i></a>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="details-box mt-5">
                               <h3><i class="bi bi-geo-alt-fill"></i> Locate Us at </h3>
                               <p>ABC Road, #14, CODEVERSE, 5th floor,Airport Road,Domlur Layout, Kolkata - 700101, West Bengal</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 col-sm-6">
                           <form action="ins_contact.php" method="post" class="contact-form">
                                  <p>Feel free to reach out !! Tell us your queries or Suggest us Regarding our website. Happy Coding !!</p>
                                      <?php
                                      if(isset($_SESSION['message_sent']))
                                      {
                                        ?>
                                  <div class="alert alert-success" role="alert">     
                                      <?php 
                                      echo $_SESSION['message_sent']; 
                                      unset($_SESSION['message_sent']);
                                      ?>
                                  </div>
                                  <?php }elseif(isset($_SESSION['message_sent_error'])){ ?>
                                    <div class="alert alert-danger" role="alert">
                                         <?php 
                                         echo $_SESSION['message_sent_error']; 
                                         unset($_SESSION['message_sent_error']); 
                                         ?>
                                    </div>
                                    <?php } ?>
                                 <div class="row gy-4">
                                    <div class="col-md-6">
                                      <input type="text" name="name" class="form-control" placeholder="Your Name" required>
                                    </div>
             
                                    <div class="col-md-6 ">
                                      <input type="number" class="form-control" name="ph_no" placeholder="Ph No" required>
                                    </div>

                                    <div class="col-md-12">
                                      <input type="email" class="form-control" name="email" placeholder="Your Email" required>
                                    </div>

                                    <div class="col-md-12">
                                      <textarea class="form-control" name="message" rows="6" placeholder="Message" required></textarea>
                                    </div>

                                    <div class="col-md-12 text-center">
                                      <button type="submit">Send Message</button>
                                    </div>
                                </div>
                          </form>
                </div>
            </div>
        </div>
    </section>

  <?php  include("inc/footer.php") ?>

  <!-- Vendor JS Files -->
  <script src="wrapper/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="wrapper/vendor/php-email-form/validate.js"></script>
  <script src="wrapper/vendor/aos/aos.js"></script>
  <script src="wrapper/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="wrapper/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Main JS File -->
  <script src="wrapper/js/main.js"></script>
  <script src="wrapper/js/jquery.js"></script>
  <script src="wrapper/js/mode.js"></script>

</body>

</html>