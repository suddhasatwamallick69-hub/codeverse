<?php
session_start();
include("db.php");
$scid=$_GET['scid'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>CODEVERSE Learn Course</title>
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

<body class="service-details-page">

<?php  include("inc/header.php")  ?>
    <!-- Course Details Section -->
    <section id="course-details" class="course-details section">
      <div class="container">
        <div class="row gy-5">
             <?php
             $sql="SELECT * FROM course WHERE id='$scid'";
             $res=$con->query($sql);
             $row=$res->fetch_assoc();
             $cname=$row['name'];  
             $cid=$row['id'];  
             ?>
          <div class="col-lg-4">
            <div class="details-box">
              <h4><?php  echo $cname; ?></h4>
              <div class="list-topic">
                <?php
                 $sel="SELECT * FROM resource WHERE course_id='$scid'";
                 $rs=$con->query($sel);
                 while($row2=$rs->fetch_assoc()){
                 ?>
                <a href="" class="active"><i class="bi bi-arrow-right-circle"></i><span><?php echo $row2['name']; ?></span></a>
                <?php } ?>
              </div>
            </div>

            <div class="details-box">
              <h4>Download Notes</h4>
              <div class="download-catalog">
                <a href="" target=""><i class="bi bi-filetype-pdf"></i><span>PDF</span></a>
              </div>
            </div>

          </div>

          <div class="col-lg-8 ps-lg-5">
            <img src="teacher/uploads/<?php echo $row['image'];  ?>" alt="" class="img-fluid course-img">
            <h3 style="margin-top:30px"><?php  echo $cname; ?></h3>
            <p><?php echo $row['description'];  ?></p>
            <div>
              <p><i class="bi bi-check-circle"></i> <span>Clear Objectives: Defines what students are expected to learn by the end.</span></p>
              <p><i class="bi bi-check-circle"></i> <span>Organizes material in a logical, progressive order.</span></p>
              <p><i class="bi bi-check-circle"></i> <span>Flexibility: Accommodates different learning paces and styles.</span></p>
            </div>
            <p>
            Welcome to our course - <?php echo $cname; ?>!! Dive into a comprehensive learning experience designed to enhance your skills and knowledge. 
            </p>
            <p>
            Our course offers clear objectives, structured content, and engaging delivery methods to cater to diverse learning styles. You'll benefit from interactive elements, practical applications, and valuable resources, all supported by personalized feedback and robust support systems. Flexible learning options ensure you can progress at your own pace. Join us to unlock new opportunities and achieve your goals with a dynamic and supportive learning environment. Get started today and take the next step in your educational journey!
            </p>
            <?php
                if(isset($_SESSION['stu_user_name'])){
                ?>
            <a href="coursevideos.php?cvid=<?php echo $row['id']; ?>" class="abtnn">Start Learning<i class="bi bi-arrow-right"></i></a>
            <a class="btn btn-primary" href="assessment.php?ast=<?php echo $row['id']; ?>">Give Assessment</a>
            <?php }else{ ?>
              <a href="login_signup.php?destination=startcourse.php?scid=<?php echo $scid; ?>" onclick="return alert('Login to continue')" class="abtnn"><span>Start Learning</span><i class="bi bi-arrow-right"></i></a>
              <?php } ?>
          </div>

        </div>

      </div>

    </section>



  <?php  include("inc/footer.php") ?>

  <!-- Vendor JS Files -->
  <script src="wrapper/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="wrapper/vendor/aos/aos.js"></script>
  <script src="wrapper/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="wrapper/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Main JS File -->
  <script src="wrapper/js/main.js"></script>
  <script src="wrapper/js/jquery.js"></script>
  <script src="wrapper/js/mode.js"></script>

</body>

</html>