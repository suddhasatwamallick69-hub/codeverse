<?php
session_start();
if(!isset($_SESSION['uid']) && $_SESSION['uid']==''){
  header("location:login.php");
}
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
            <div class="col-md-12">
                <div class="card">
                  <div class="card-body">
                  <h3>Add Questions</h3>
                  <div class="table-responsive">
                    <?php include("db.php");
                          $sql="SELECT * FROM exam WHERE teacher_id='$teacher_id'";
                          $res=$con->query($sql);
                          if($res->num_rows>0)
                          {
                            ?>
                      <table class="table table-hover">
                        <thead>
                          <tr>
                            <th>Contest</th>
                            <th>Date</th>
                            <th>Duration</th>
                            <th>Total Questions</th>
                            <th>Status</th>
                          </tr>
                        </thead>
                        <tbody id="results">
                          <?php
                          while($row=$res->fetch_assoc()){
                          ?>
                            <tr>
                                            <td><?php echo $row['exam_name'];  ?></td>
                                            <td><?php echo $row['exam_date'];  ?></td>
                                            <td><?php echo $row['duration'];  ?></td>
                                            <td><?php echo $row['total_questions'] ?></td>

                                            <td><?php 
                                            $sql2="SELECT * FROM exam_status WHERE exam_id='$row[id]'";
                                            $res2=$con->query($sql2);
                                            $row2=$res2->fetch_assoc();
                                            if($row2['status']=='Live')
                                            {
                                              echo "<span style='color:red'>".$row2['status']."</span>";
                                            }
                                            elseif($row2['status']=='ended')
                                            {
                                              echo "<span style='color:green'>".$row2['status']."</span>";
                                            }
                                            elseif($row2['status']=='upcoming')
                                            {
                                              echo "<span style='color:blue'>".$row2['status']."</span>";
                                            } 
                                            ?>
                                            </td>

                                            <td><a href="contest_questions.php?eid=<?php echo $row['id'] ?>&exam_name=<?php echo $row['exam_name']; ?>">View Questions</a></td>
                            </tr>
                          <?php  } ?>
                        </tbody>
                      </table>
                      <?php }else{ echo "<tr>No contest assigned to you</tr>";} ?>
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
    <script src="js/jquery.js"></script>
    <script src="js/search3.js"></script>
    <!-- <script src="assets/js/Chart.roundedBarCharts.js"></script> -->
    <!-- End custom js for this page-->
  </body>
</html>