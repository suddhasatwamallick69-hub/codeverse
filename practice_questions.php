<?php
session_start();
include("db.php");
if(isset($_GET['val'])){
  $val=$_GET['val'];
}
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
         <h1 class="mb-2 mb-lg-0">Topics</h1>
         <nav class="breadcrumbs">
          <ol>
            <?php
            $sql="SELECT DISTINCT category FROM practical_questions";
            $rs=$con->query($sql);
            while($row=$rs->fetch_assoc()){
            ?>
            <li><a href="practice_questions.php?val=<?php echo $row['category']; ?>" class="abtn"><?php echo $row['category']; ?></a></li>
            <?php } ?>
            <!-- <li class="current">Practice Problems</li> -->
          </ol>
         </nav>
         </form>
       </div>
    </div>
    <section  class="section">
      <!-- Section Title -->
      <div class="container section-title mt-3">
        <h2>Practice Questions</h2>
      </div><!-- End Section Title -->
      
      <?php
      if(isset($_GET['val'])){
      ?>
      <div class="container">
        <div class="row">
          <div class="col-md-6">
                <select id="searchSelect2" class="form-control mb-2 w-50">
                   <option value="" disabled selected>-Select Difficulty-</option>
                   <option value="Easy">Easy</option>
                   <option value="Intermediate">Intermediate</option>
                   <option value="Hard">Hard</option>
                </select>
                <input type="hidden" id="val" value="<?php  echo $val; ?>">
          </div>
        </div>
      </div>
      <div class="container">
        <h3 style="text-align:center">Problems : <?php  echo $val; ?></h3>
            <table class=""  id="table">
                <thead class="p-5">
                <tr>
                    <th>Q No</th>
                    <th>Problem Statement</th>
                    <th>Difficulty</th>
                    <th>Solve</th>
                    <th>Solution</th>
                </tr>
                </thead>
                <tbody id="results">
                    <?php
                    $sel="SELECT * FROM practical_questions WHERE category='$val'";
                    $res=$con->query($sel);
                    $count=0;
                    while($row=$res->fetch_assoc()){
                      $count++;
                    ?>
                <tr>
                    <td><?php echo $count; ?></td>
                    <td><?php echo $row['problem_statement']; ?></td>
                    <td><?php echo $row['difficulty']; ?></td>
                    <?php
                       if(isset($_SESSION['stu_user_name']))
                       {
                        ?>
                    <td><a href="solve.php?pqid=<?php echo $row['id']; ?>" class="" target="_blank">Start Solving</a></td>
                    <?php 
                       }else{
                       ?>
                       <td><a href="" onclick="abc();" class="">Start Solving</a></td>
                       <?php }?>
                    <td><a href="">Solution</a></td>
                </tr>
                <?php } ?>
                </tbody>
            </table>
      </div>
      <?php }else{ ?>
      <div class="container">
        <div class="row">
          <div class="col-md-6">
                <select id="searchSelect" class="form-control mb-2 w-50">
                   <option value="" disabled selected>-Select Difficulty-</option>
                   <option value="Easy">Easy</option>
                   <option value="Intermediate">Intermediate</option>
                   <option value="Hard">Hard</option>
                </select>
          </div>
        </div>
      </div>
      <div class="container">
            <table class=""  id="table">
                <thead>
                <tr>
                    <th>Q No</th>
                    <th>Problem Statement</th>
                    <th>Difficulty</th>
                    <th>Solve</th>
                    <th>Solution</th>
                </tr>
                </thead>
                <tbody id="results">
                    <?php
                    $sel="SELECT * FROM practical_questions";
                    $res=$con->query($sel);
                    $count=0;
                    while($row=$res->fetch_assoc()){
                      $count++;
                    ?>
                <tr>
                    <td><?php echo $count; ?></td>
                    <td><?php echo $row['problem_statement']; ?></td>
                    <td><?php echo $row['difficulty']; ?></td>
                    <?php
                       if(isset($_SESSION['stu_user_name']))
                       {
                        ?>
                    <td><a href="solve.php?pqid=<?php echo $row['id']; ?>" class="" target="_blank">Start Solving</a></td>
                    <?php 
                       }else{
                       ?>
                       <td><a href="login_signup.php?destination=practice_questions.php" onclick="return alert('Login to continue')">Start Solving</a></td>
                       <?php }?>
                    <td><a href="">Solution</a></td>
                </tr>
                <?php } ?>
                </tbody>
            </table>
      </div>
      <?php } ?>
    </section><!-- /Starter Section Section -->

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
  <script src="wrapper/js/search.js"></script>
  <script src="wrapper/js/search_a.js"></script>
  <script src="wrapper/js/mode.js"></script>
  <!-- <script>
    function abc(){
      window.location.href='login_signup.php';
    }
  </script> -->

</body>

</html>