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
                        <h1 class="mb-2 mb-lg-0">Privacy Policy</h1>
                        <nav class="breadcrumbs">
                              <ol>
                                  <li><a href="index.php">Home</a></li>
                                  <li class="current">Privacy Policy</li>
                              </ol>
                        </nav>
              </div>
          </div>
    <section class="section about-us" id="about-us">
          <div class="container">
              <h1>Privacy Policy</h1>
              <p>Last Updated on 30th October 2024, 12:23:00 PM IST</p>
              <h2>Data Usage Policy</h2>
              <p>This document outlines how Codeverse collects, stores, and uses your data. It also provides you with information on how to remove your stored data on request, and what data will be removed. Please read this document carefully before proceeding with using the Codeverse website. By reading this page, you agree to abide by the terms of this policy. We reserve the right to update this policy as and when needed and will update you about the same on the email ID associated with your Codeverse account. Additionally, please also read our Terms of Use, Privacy Policy, and Community Guidelines before using the Codeverse website.</p>

                <div id="accordion">
                   <div class="card" id="card_of_pp">
                        <div class="card-header" id="headingOne">
                            <button class="btn btn-none collapsed" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            <h2>Do I have ownership over all my data?</h2>
                            </button>
                        </div>

                        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                          <div class="card-body">
                            <p>Codeverse retains ownership over some of your data which includes the username which you reserved while                 registering. However, personally identifiable data associated with these, such as your real name, email ID, age, gender, and others will be removed on request. Note however that we retain the rights to publicly display the submissions that you had made, as detailed here.</p>
                          </div>
                        </div>
                   </div>
                </div>
                <hr>
                <div id="accordion">
                    <div class="card" id="card_of_pp">
                         <div class="card-header" id="headingTwo">
                             <button class="btn btn-none collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseOne">
                             <h2>How does Codeverse collect my data and why?</h2>
                             </button>
                         </div>
 
                         <div id="collapseTwo" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                           <div class="card-body">
                             <p>When you browse our website, we also automatically receive your computer's internet protocol (IP) address in order to provide us with information that helps us learn about your browser and operating system.<br>
                                Codeverse collects data from you to identify you as a user, to be able to communicate with you, and to help ensure that all our users get the best experience while using our services. With your permission, we may use your registered email address to send you communication about our newsletters, your submission results and other updates.Codeverse does not share your data with any third parties without your explicit consent. We also store your data with adequate security features and remove personally identifiable information for analytics purposes.</p>
                           </div>
                         </div>
                    </div>
                </div>
                <hr>
                <div id="accordion">
                    <div class="card" id="card_of_pp">
                         <div class="card-header" id="headingThree">
                             <button class="btn btn-none collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseOne">
                             <h2>What about third parties that collect my data?</h2>
                             </button>
                         </div>
 
                         <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                           <div class="card-body">
                             <p>In general, the third-party providers used by us will only collect, use and disclose your information to the extent necessary to allow them to perform the services they provide to us. However, certain third-party service providers, such as payment gateways and other payment transaction processors, have their own privacy policies in respect to the information we are required to provide to them for your purchase-related transactions.<br>
                                For these providers, we recommend that you read their privacy policies so you can understand the manner in which your personal information will be handled by these providers. In particular, remember that certain providers may be located in or have facilities that are located a different jurisdiction than either you or us. So if you elect to proceed with a transaction that involves the services of a third-party service provider, then your information may become subject to the laws of the jurisdiction(s) in which that service provider or its facilities are located. <br>
                                Once you leave our website or are redirected to a third-party website or application, you are no longer governed by this Privacy Policy or our website's Terms of Service.
                                When you click on links on our store, they may direct you away from our site. We are not responsible for the privacy practices of other sites and encourage you to read their privacy statements.
                            </p>
                           </div>
                         </div>
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