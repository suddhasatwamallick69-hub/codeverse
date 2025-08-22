<?php
session_start();
if(!isset($_SESSION['uid']) && $_SESSION['uid']==''){
  header("location:login.php");
}

include("db.php");
$teacher_id=$_SESSION['uid'];
$teacher_name=$_SESSION['name'];
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Teacher Pannel</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/vendors/feather/feather.css">
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="assets/vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/vendors/typicons/typicons.css">
    <link rel="stylesheet" href="assets/vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
    <link rel="stylesheet" type="text/css" href="assets/js/select.dataTables.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- endinject -->
    <!--<link rel="shortcut icon" href="assets/images/favicon.png" />-->
  </head>

  <body class="with-welcome-text">
    <div class="container-scroller">
      <!--navbar -->
      <?php include("inc/navbar.php");  ?>
      <!-- navbar -->
      <div class="container-fluid page-body-wrapper">
        <!--sidebar -->
        <?php include("inc/sidebar.php");  ?>
        <!-- sidebar -->
       <div class="main-panel">
          <div class="content-wrapper">
           <div class="row">
              <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Practical Questions</h4>
                    <p class="card-description"></p>
                    <form class="forms-sample material-form" action="" method="post" enctype="multipart/form-data">

                      <div class="form-group">
                        <select name="difficulty" id="" class="" required>
                          <option value="" disabled selected>Select Difficulty</option>
                          <option value="Easy">Easy</option>
                          <option value="Intermediate">Intermediate</option>
                          <option value="Hard">Hard</option>
                        </select>
                      </div>
                      <div class="form-group">
                      <p>Category</p>
                        <select name="category" id="" class="" required>
                          <option value="" disabled selected>Select Category</option>
                          <option value="General">General</option>
                          <option value="Arrays">Arrays</option>
                          <option value="Stack">Stack</option>
                          <option value="Queues">Queues</option>
                          <option value="Linked List">Linked List</option>
                          <option value="Hash">Hash</option>
                          <option value="Tree">Tree</option>
                          <option value="Graphs">Graphs</option>
                        </select>
                      </div>
                      

                      <div class="form-group">
                        <input type="text" required="required" name="name" id="name" required/>
                        <label for="name" class="control-label">Problem Statement</label><i class="bar"></i>
                      </div>

                      <div class="form-group">
                        <textarea name="input_format" id="desc" rows="8" col="8" required></textarea>
                        <label for="desc" class="control-label">Input Format and Expected Output </label><i class="bar"></i>
                      </div>

                      <div class="form-group">
                        <textarea name="input" id="input" rows="5" col="5" required></textarea>
                        <label for="input" class="control-label">Input</label><i class="bar"></i>
                      </div>

                      <div class="form-group">
                        <textarea name="output" id="desc" rows="8" col="8" required></textarea>
                        <label for="desc" class="control-label">Output</label><i class="bar"></i>
                      </div>

                      <div class="form-group">
                        <textarea name="explanation" id="explanation" rows="5" col="5" required></textarea>
                        <label for="explanation" class="control-label">Explanation</label><i class="bar"></i>
                      </div>
                      <div class="button-container">
                        <input type="submit" class="button btn btn-primary" name="add_p_question" value="Add Question">
                      </div>
                    </form>
                  </div>
                  <?php
                  if(isset($_POST['add_p_question'])){
                    extract($_POST);
                    $explanation=$con->real_escape_string($_POST['explanation']);
                    $ins="INSERT INTO practical_questions SET category='$category',problem_statement='$name',input_format='$input_format',output='$output',input='$input',difficulty='$difficulty',explanation='$explanation',teacher_id='$teacher_id',teacher_name='$teacher_name'";
                    $con->query($ins);
                    echo"<script>alert('Problem Added');window.location.href='add_practical_questions.php';</script>";
                  }
                  ?>
                </div>
              </div>
            </div>
                
              </div>
            
            </div>

          </div>
          
          <!-- content-wrapper ends -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="assets/vendors/chart.js/chart.umd.js"></script>
    <script src="assets/vendors/progressbar.js/progressbar.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/template.js"></script>
    <script src="assets/js/settings.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="assets/js/jquery.cookie.js" type="text/javascript"></script>
    <script src="assets/js/dashboard.js"></script>
    <!-- <script src="assets/js/Chart.roundedBarCharts.js"></script> -->
    <!-- End custom js for this page-->
  </body>
</html>