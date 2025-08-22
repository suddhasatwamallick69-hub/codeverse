<?php
session_start();
include("db.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title><?php if(isset($_SESSION['stu_user_name'])){?>Dashboard<?php }else{ ?>CODEVERSE<?php } ?></title>
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

<body>
  <?php  include("inc/header.php")  ?>
    <!-- Hero Section -->
          <?php
          if(!isset($_SESSION['stu_user_name'])){
          ?>
    <section id="hero" class="hero section">
      <div class="container">
        <div class="row">
          <div class="col-md-7">
             <h1>Welcome to <span>CODEVERSE</span></h1>
             <p>Start your coding journey today<br>Learn to code from scratch with job focussed <br>courses designed by experts.</p>
             <form action="login_signup.php" method="get">
                 <div class="row">
                  <div class="col-md-10 search-container">
                      <input type="email" id="search-input" placeholder="Enter Email..." name="email" required><input type="submit" value="Start Learning" id="searchbtn">
                  </div>
                 </div>
             </form>
          </div>
          <div class="col-md-5">
              <img src="wrapper/img/banner.png" class="img-fluid hero-img" alt="">
          </div>
        </div>
      </div>
    </section><!-- /Hero Section -->
    <?php } ?>


    <!-- Courses Section -->
    <section id="services" class="services section">
      <!-- Section Title -->
      <div class="container section-title">
        <h2>Learn to Code</h2>
        <p>Learn to code from scratch with job focussed courses designed by experts.</p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row g-5">
          <?php
          $sql="SELECT * FROM course LIMIT 6";
          $res=$con->query($sql);
          while($row=$res->fetch_assoc()){
          ?>
          <div class="col-lg-6">
            <div class="service-item item-cyan position-relative">
              <!--<i class="bi bi-activity icon"></i>-->
              
              <div class="row">
                 <div class="col-md-2">
                      <img src="teacher/uploads/<?php echo $row['image'];  ?>" style="width:50px;height:50px">
                 </div>
                 <div class="col-md-10 px-5">
                      <h3><?php echo $row['name']; ?></h3>
                      <a href='startcourse.php?scid=<?php echo $row['id']; ?>' class='read-more stretched-link'>Start Learning<i class='bi bi-arrow-right'></i></a>
                 </div>
              </div>
            </div>
          </div><!-- End Service Item -->
          <?php } ?>
        </div>
        <div class="row mt-5">
          <div class="col-md-12 d-flex justify-content-center align-items-center">
              <a href="courses.php" style="text-align:center" class="btn-get-started">View More Courses</a>
          </div>
        </div>

      </div>

    </section><!-- /Courses Section -->

    <!-- About Codeverse -->
    <section id="about" class="about section">
      <div class="container">
        <div class="row gy-4">
          <div class="col-lg-6 content">
            <p class="who-we-are">Learning courses</p>
            <h3>Unleashing Potential with Creative Strategy</h3>
            <p class="fst-italic">
            From Python to web development, you'll master concepts that are in demand, ensuring your smooth transition from beginner to professional.
            </p>
            <ul>
              <li><i class="bi bi-check-circle"></i> <span>Learn from courses</span></li>
              <li><i class="bi bi-check-circle"></i> <span>Practice daily</span></li>
              <li><i class="bi bi-check-circle"></i> <span>More than 100+ problems on each topic of DSA</span></li>
              <li><i class="bi bi-check-circle"></i> <span>Give Assessment on particular Courses</span></li>
            </ul>
            <a href="about.php" class="read-more"><span>About CODEVERSE</span><i class="bi bi-arrow-right"></i></a>
          </div>
          <div class="col-lg-6 about-images">
            <img src="wrapper/img/features.webp" class="img-fluid">
          </div>
        </div>
      </div>
    </section><!-- /About Codeverse -->

    <!--IDE Features Section -->
    <section id="features-details" class="features-details">
      <div class="container">
        <div class="row gy-4 justify-content-between">
          <div class="col-lg-6">
            <img src="wrapper/img/IDE.png" class="img-fluid" alt="">
          </div>
          <div class="col-lg-5 d-flex align-items-center order-2 order-lg-1">
            <div class="content">
              <h4>In Browser IDE</h4>
              <h3>Hands-on Learning Experience</h3>
              <p>
                 Practice as you learn with our built-in IDE. Each lesson is designed to be followed by a coding exercise to  apply the concepts and gain immediate feedback.
              </p>
              <ul>
                <li><i class="bi bi-box"></i> Get more than 10 Language Support.</li>
                <li><i class="bi bi-box"></i> Get interactive experience with standard input.</li>
                <li><i class="bi bi-box"></i> Know the time complexity of your code.</li>
              </ul>
              <p></p>
              <a href="ide.php" class="btn more-btn">Start Coding</a>
            </div>

          </div>
        </div><!-- Features Item -->
      </div>
    </section><!-- / IDE Features Section -->

    <section id="section" class="section main-feature">
      <div class="container">
        <div class="row gy-4 d-flex justify-content-between">
          <div class="col-md-6 d-flex align-items-center">
            <div class="content">
                <h4>Participate in Contests and move up in LeaderBoard</h4>
                <ul>
                  <li><i class="bi bi-check-circle"></i>Participate in Weekly Coding Contests and enhance your potential</li>
                  <li><i class="bi bi-check-circle"></i>Get your personalized report</li>
                  <li><i class="bi bi-check-circle"></i>Compete with others in Codeverse community and move up in Leaderboard</li>
                </ul>
                <a href="compete.php" class="read-more"><span>Contests </span></a>
            </div>
          </div>
          <div class="col-md-6 d-flex align-items-center justify-content-center">
            <!-- <video src="wrapper/img/ide_feature.mp4" class="img-fluid" muted autoplay></video> -->
            <img src="wrapper/img/features2.png" class="img-fluid">
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