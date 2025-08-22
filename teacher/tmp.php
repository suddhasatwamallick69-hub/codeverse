<?php
session_start();
if(!isset($_SESSION['uid']) && $_SESSION['uid']==''){
  header("location:index.php");
}
$teacher_id=$_SESSION['uid'];
$teacher_name=$_SESSION['name'];
include("db.php");
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
              <div class="col-sm-12">
                <div class="home-tab">
                  <div class="tab-content tab-content-basic">
                    <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">
                      <div class="row">
                        <div class="col-lg-8 d-flex flex-column">
                          <div class="row flex-grow">
                            <div class="col-12 col-lg-4 col-lg-12 grid-margin stretch-card">
                              <div class="card card-rounded">
                                <div class="card-body">
                                  <?php
                                   $sql="SELECT * FROM exam WHERE teacher_id='$teacher_id'";
                                   $res=$con->query($sql);
                                   if($res->num_rows>0){
                                   ?>
                                  <h4><u>Assigned Task by Admin</u></h4>
                                    <form class="forms-sample material-form" action="" method="post">
                                        <div class="form-group">
                                          <select name="difficulty" id="" class="" required>
                                            <option value="" disabled selected>Select Difficulty</option>
                                            <option value="Easy">Easy</option>
                                            <option value="Intermediate">Intermediate</option>
                                            <option value="Hard">Hard</option>
                                          </select>
                                        </div>                                        
                  
                                        <div class="form-group">
                                          <textarea name="question" id="question" rows="5" col="5" required></textarea>
                                          <label for="question" class="control-label">Question</label><i class="bar"></i>
                                        </div>

                                        <div class="form-group">
                                          <textarea name="input_format" id="desc" rows="5" col="5" required></textarea>
                                          <label for="desc" class="control-label">Input Format</label><i class="bar"></i>
                                        </div>

                                        <div class="form-group">
                                          <textarea name="output" id="desc" rows="5" col="5" required></textarea>
                                          <label for="desc" class="control-label">Output Format</label><i class="bar"></i>
                                        </div>

                                        <div class="form-group">
                                          <textarea name="h_input_format" id="desc" rows="5" col="5" required></textarea>
                                          <label for="desc" class="control-label">Hidden Input Format</label><i class="bar"></i>
                                        </div>

                                        <div class="form-group">
                                          <textarea name="output" id="desc" rows="5" col="5" required></textarea>
                                          <label for="desc" class="control-label">Hidden Output Format</label><i class="bar"></i>
                                        </div>
                                        <!-- <div class="button-container">
                                          <input type="submit" class="button btn btn-primary" name="add_p_question" value="Add Question">
                                        </div> -->
                                        <div class="button-container">
                                             <input type="submit" class="btn btn-warning" value="Submit">
                                        </div>
                                    </form>
                                    <?php }else{ ?>
                                        <h4><u>No Assigned Task by Admin</u></h4>
                                        <?php } ?>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-4 d-flex flex-column">
                          <div class="row flex-grow">
                            <div class="col-md-6 col-lg-12 grid-margin stretch-card">
                              <div class="card card-rounded">
                                <div class="card-body">
                                   <?php
                                   $sql="SELECT * FROM exam WHERE teacher_id='$teacher_id'";
                                   $res=$con->query($sql);
                                   $row=$res->fetch_assoc();
                                   if($res->num_rows>0){
                                   ?>
                                  <div class="row">
                                    <h4>Set Questions for the contest</h4>
                                    <h3><u>Instructions:</u></h3>
                                    <h4>Contest - <?php echo $row['exam_name']; ?></h4><br><br>
                                    <h4>Set <?php echo $row['total_questions'] ?> Questions</h4><br><br>
                                    <h4>Date -  <?php echo $row['exam_date'] ?></h4>
                                  </div>
                                  <?php } ?>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
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