<?php
session_start();
if(!isset($_SESSION['uid']) && $_SESSION['uid']==''){
  header("location:index.php");
}
$teacher_id=$_SESSION['uid'];
$teacher_name=$_SESSION['name'];
$exam_id=$_GET['examid'];
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
                                    <form class="forms-sample material-form" action="ins_set_exam_questions.php" method="post">
                                          <p><select name="difficulty" id="" class="form-control" required>
                                            <option value="" disabled selected>Select Difficulty</option>
                                            <option value="Easy">Easy</option>
                                            <option value="Intermediate">Intermediate</option>
                                            <option value="Hard">Hard</option>
                                          </select></p>                                  

                                          <div class="form-group">
                                              <textarea name="question" class="form-control" rows="20" col="15" required></textarea>
                                              <label for="question" class="control-label">Problem Statement</label><i class="bar"></i>
                                          </div>
                                          <p></p>
                                          <p></p>
                                          
                                          <p>Input Format</p>
                                          <p><textarea name="input_format" class="form-control" rows="5" col="5" required></textarea></p>
            
                                          <p>Output Format</p>
                                          <p><textarea name="output" class="form-control" rows="5" col="5" required></textarea></p>
            
                                          <hr>
                                          <hr>
                                        <div class="row">
                                          <div class="col-md-6">
                                                    <h4>Hidden Test Case 1</h4>
                                                          <div class="form-group">
                                                               <textarea id="hidden_input_1" name="hidden_inputs[]" class="form-control" required></textarea>
                                                               <label for="hidden_input_1" class="control-label">Hidden Input:</label><i class="bar"></i>
                                                          </div>
                                                          <div class="form-group">
                                                               <textarea id="hidden_output_1" name="hidden_outputs[]" class="form-control" required></textarea>
                                                               <label for="hidden_output_1" class="control-label">Expected Hidden Output:</label><i class="bar"></i>
                                                          </div>
                                          </div>

                                          <div class="col-md-6">
                                                    <h4>Hidden Test Case 2</h4>
                                                          <div class="form-group">
                                                               <textarea id="hidden_input_1" name="hidden_inputs[]" class="form-control" required></textarea>
                                                               <label for="hidden_input_1" class="control-label">Hidden Input:</label><i class="bar"></i>
                                                          </div>
                                                          <div class="form-group">
                                                               <textarea id="hidden_output_1" name="hidden_outputs[]" class="form-control" required></textarea>
                                                               <label for="hidden_output_1" class="control-label">Expected Hidden Output:</label><i class="bar"></i>
                                                          </div>
                                          </div>
                                          <div>
                                            <hr>
                                          </div>
                                          
                                          <div class="col-md-6 mt-2">
                                                    <h4>Hidden Test Case 3</h4>
                                                          <div class="form-group">
                                                               <textarea id="hidden_input_1" name="hidden_inputs[]" class="form-control" required></textarea>
                                                               <label for="hidden_input_1" class="control-label">Hidden Input:</label><i class="bar"></i>
                                                          </div>
                                                          <div class="form-group">
                                                               <textarea id="hidden_output_1" name="hidden_outputs[]" class="form-control" required></textarea>
                                                               <label for="hidden_output_1" class="control-label">Expected Hidden Output:</label><i class="bar"></i>
                                                          </div>
                                          </div>

                                          <div class="col-md-6 mt-2">
                                                    <h4>Hidden Test Case 4</h4>
                                                          <div class="form-group">
                                                               <textarea id="hidden_input_1" name="hidden_inputs[]" class="form-control" required></textarea>
                                                               <label for="hidden_input_1" class="control-label">Hidden Input:</label><i class="bar"></i>
                                                          </div>
                                                          <div class="form-group">
                                                               <textarea id="hidden_output_1" name="hidden_outputs[]" class="form-control" required></textarea>
                                                               <label for="hidden_output_1" class="control-label">Expected Hidden Output:</label><i class="bar"></i>
                                                          </div>
                                          </div>

                                          <div>
                                            <hr>
                                          </div>

                                          <div class="col-md-6">
                                                    <h4>Hidden Test Case 5</h4>
                                                          <div class="form-group">
                                                               <textarea id="hidden_input_1" name="hidden_inputs[]" class="form-control" required></textarea>
                                                               <label for="hidden_input_1" class="control-label">Hidden Input:</label><i class="bar"></i>
                                                          </div>
                                                          <div class="form-group">
                                                               <textarea id="hidden_output_1" name="hidden_outputs[]" class="form-control" required></textarea>
                                                               <label for="hidden_output_1" class="control-label">Expected Hidden Output:</label><i class="bar"></i>
                                                          </div>
                                          </div>

                                          <div>
                                            <hr>
                                          </div>
                                          <p><input type="text" name="expected_keywords" placeholder="keywords" class="form-control"></p>
                                        </div>
                                        <div class="form-group">
                                             <textarea name="description" id="description" cols="10" rows="8"></textarea>
                                              <label for="description" class="control-label">Question Description</label><i class="bar"></i>
                                        </div>

                                        
                                        <input type="hidden" name="examid" value="<?php echo $exam_id ?>">
                                        <div class="button-container">
                                             <input type="submit" class="btn btn-warning mt-3" name="submit" value="Submit">
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
                                   $sql="SELECT * FROM exam WHERE teacher_id='$teacher_id' AND id='$exam_id'";
                                   $res=$con->query($sql);
                                   $row=$res->fetch_assoc();
                                   $sql1="SELECT COUNT(*) AS submitted_questions FROM exam_questions WHERE teacher_id = '$teacher_id' AND exam_id = '$exam_id'";
                                   $res1 = $con->query($sql1);
                                   $row1 = $res1->fetch_assoc();
                                   $submitted_questions = $row1['submitted_questions'];
                                   $remaining_questions=$row['total_questions']-$submitted_questions;
                                   ?>
                                  <div class="row">
                                    <h4>Set Questions for the contest</h4>
                                    <h3><u>Instructions:</u></h3>
                                    <h4>Contest - <?php echo $row['exam_name']; ?></h4><br><br>
                                    <h4>Total questions to be set <?php echo $row['total_questions'] ?> Questions</h4><br><br>
                                    <h4>Remaining questions to be set <?php echo $remaining_questions; ?></h4>
                                    <br>
                                    <br>
                                    <h4>Date -  <?php echo $row['exam_date'] ?></h4>

                                    <a href="contest_questions.php?eid=<?php echo $exam_id; ?>&exam_name=<?php echo $row['exam_name']; ?>">List of Questions</a>
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