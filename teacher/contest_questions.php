<?php
session_start();
if(!isset($_SESSION['uid']) && $_SESSION['uid']==''){
  header("location:login.php");
}
$teacher_id=$_SESSION['uid'];
$teacher_name=$_SESSION['name'];

$exam_id=$_GET['eid'];
$exam_name=$_GET['exam_name'];

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
            <div class="col-md-12">
                <div class="card">
                  <div class="card-body">
                  <h3>Add Questions</h3>
                  <div class="table-responsive">
                  <table class="table table-hover" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Q No</th>
                                            <th>Question Name</th>
                                            <th>Difficulty</th>
                                            <th>Duration</th>
                                            <th>Description</th>                                            
                                            <th>Input Format</th>
                                            <th>Output Format</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    include("db.php");
                                    $sql="SELECT * FROM exam_questions WHERE exam_id='$exam_id'";
                                    $res=$con->query($sql);
                                    if($res->num_rows>0)
                                    {
                                    $count=0;
                                    while($row=$res->fetch_assoc())
                                    {
                                        $count++;
                                    ?>
                                        <tr>
                                            <td><?php echo $count; ?></td>
                                            <td><?php echo $row['question_name'];  ?></td>
                                            <td><?php echo $row['difficulty'];  ?></td>
                                            <td><?php echo $row['difficulty'];  ?></td>
                                            <td><?php echo $row['description'] ?></td>
                                            <td><?php echo $row['input_format']; ?></td>
                                            <td>
                                                <?php  if (strpos($row['output_format'], '\n') !== false) 
                                                        {
                                                          $output_format=explode(" ",$row['output_format']);
                                                          $output_format = str_replace('\n', "\n", $row['output_format']);
                                                          echo nl2br($output_format);
                                                         } 
                                                         else 
                                                         {
                                                               echo $row['output_format'];
                                                         } ?>
                                            </td>
                                        </tr>
                                        <?php }}else{echo "<h2>Questions yet to be assigned!!!</h2>";} ?>
                                    </tbody>
                                </table>
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
    <script src="js/jquery.js"></script>
    <script src="js/search3.js"></script>
    <!-- <script src="assets/js/Chart.roundedBarCharts.js"></script> -->
    <!-- End custom js for this page-->
  </body>
</html>