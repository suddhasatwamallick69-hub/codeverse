<?php
session_start();
if(!isset($_SESSION['uid']) && $_SESSION['uid']==''){
  header("location:login.php");
}

include("db.php");
$teacher_id=$_SESSION['uid'];
$teacher_name=$_SESSION['name'];

$question_id=$_GET['uid'];
$sql="SELECT * FROM practical_questions WHERE id='$question_id'";
$res=$con->query($sql);
$row=$res->fetch_assoc();
$category=$row['category'];
$problem_statement=$row['problem_statement'];
$input_format=$row['input_format'];
$output=$row['output'];
$explanation=$row['explanation'];
$difficulty=$row['difficulty'];
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
                    <h4 class="card-title">Update Practical Question</h4>
                    <p class="card-description"></p>
                    <form class="forms-sample material-form" action="" method="post" enctype="multipart/form-data">

                      <div class="form-group">
                        <select name="difficulty" id="" class="" required>
                          <option value="" disabled selected>Select Difficulty</option>
                          <option value="Easy" <?php if($difficulty=='Easy'){echo "selected";}  ?>>Easy</option>
                          <option value="Intermediate" <?php if($difficulty=='Intermediate'){echo "selected";}  ?>>Intermediate</option>
                          <option value="Hard" <?php if($difficulty=='Hard'){echo "selected";}  ?>>Hard</option>
                        </select>
                      </div>
                      <div class="form-group">
                      <p>Category</p>
                        <select name="category" id="" class="" required>
                          <option value="" disabled selected>Select Category</option>
                          <option value="General" <?php if($category=='General'){echo "selected";}  ?>>General</option>
                          <option value="Arrays" <?php if($category=='Arrays'){echo "selected";}  ?>>Arrays</option>
                          <option value="Stack" <?php if($category=='Stack'){echo "selected";}  ?>>Stack</option>
                          <option value="Queues" <?php if($category=='Queues'){echo "selected";}  ?>>Queues</option>
                          <option value="Linked List" <?php if($category=='Linked List'){echo "selected";}  ?>>Linked List</option>
                          <option value="Hash" <?php if($category=='Hash'){echo "selected";}  ?>>Hash</option>
                          <option value="Tree" <?php if($category=='Tree'){echo "selected";}  ?>>Tree</option>
                          <option value="Graphs" <?php if($category=='Graphs'){echo "selected";}  ?>>Graphs</option>
                        </select>
                      </div>
                      

                      <div class="form-group">
                        <input type="text" required="required" name="name" id="name" value="<?php echo $problem_statement ?>" />
                        <label for="name" class="control-label" >Problem Statement</label><i class="bar"></i>
                      </div>

                      <div class="form-group">
                        <textarea name="input_format" id="desc" rows="5" col="5" ><?php echo $input_format ?></textarea>
                        <label for="desc" class="control-label">Input Format</label><i class="bar"></i>
                      </div>

                      <div class="form-group">
                        <textarea name="output" id="desc" rows="5" col="5" ><?php echo $output ?></textarea>
                        <label for="desc" class="control-label">Output Format</label><i class="bar"></i>
                      </div>
                      <div class="form-group">
                        <textarea name="explanation" id="explanation" rows="5" col="5" ><?php echo $explanation ?></textarea>
                        <label for="explanation" class="control-label">Explanation</label><i class="bar"></i>
                      </div>
                      <div class="button-container">
                        <input type="submit" class="button btn btn-primary" name="add_p_question" value="Update Question">
                      </div>
                    </form>
                  </div>
                  <?php
                  if(isset($_POST['add_p_question'])){
                    extract($_POST);
                    $up="UPDATE practical_questions SET category='$category',problem_statement='$name',input_format='$input_format',output='$output',input='$input',difficulty='$difficulty',explanation='$explanation' WHERE id='$question_id'";
                    $con->query($up);
                    echo"<script>alert('Problem Updated');window.location.href='list_practical_questions.php';</script>";
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