<?php
session_start();
include("db.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Learn to Code CODEVERSE</title>
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
<style>
</style>
<body class="starter-page-page">

   <?php  include("inc/header.php")  ?>
          <div class="page-title" id="starter-section">
              <div class="container d-lg-flex justify-content-between align-items-center" >
                        <h1 class="mb-2 mb-lg-0">All Courses</h1>
                        <nav class="breadcrumbs">
                              <ol>
                                  <li><a href="index.php">Home</a></li>
                                  <li class="current">courses</li>
                              </ol>
                        </nav>
              </div>
          </div>
    <section class="section">
      <div class="container mt-5">
        <div class="row">
            <div class="col-md-10 search-container">
                <input type="text" id="search-input" name="input" placeholder="Browse Courses...">
                <!-- <input type="submit" value="Search" id="searchbtn"> -->
            </div>
        </div>
      </div>
      <div class="container mt-5">
               <div class="row gx-5" id="result">
               <?php
               $sql="SELECT * FROM course";
               $res=$con->query($sql);
               if($res->num_rows>0)
               {
               while($row=$res->fetch_assoc())
               {
               ?>
                 <div class="col-md-4 mt-5">
                    <a href="startcourse.php?scid=<?php echo $row['id']; ?>">
                    <div class="card p-3">
                       <div class="row">
                          <div class="col-md-2 d-flex justify-content-start">
                              <img src="teacher/uploads/<?php echo $row['image'];  ?>" style="width:90px;height:90px;">
                          </div>
                          <div class="col-md-10 px-5 d-flex flex-column justify-content-start align-items-start">
                            <h5><?php echo $row['name'] ?></h5>
                            
                          </div>
                        </div>
                    </div>
                    </a>
                 </div>
                 <?php }}else{ ?>
                  <h4>No Courses till Now</h4>
                  <?php } ?>
               </div>
      </div>
    </section>
  <?php  
  include("inc/footer.php") 
  ?>

  


  <!-- Vendor JS Files -->
  <script src="wrapper/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="wrapper/vendor/php-email-form/validate.js"></script>
  <script src="wrapper/vendor/aos/aos.js"></script>
  <script src="wrapper/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="wrapper/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Main JS File -->
  <script src="wrapper/js/main.js"></script>
  <script src="wrapper/js/jquery.js"></script>
  <script src="wrapper/js/search_course.js"></script>
  <script src="wrapper/js/mode.js"></script>

</body>

</html>