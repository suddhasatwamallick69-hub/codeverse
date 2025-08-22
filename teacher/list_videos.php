<?php
session_start();
$teacher_id=$_SESSION['uid'];
$teacher_name=$_SESSION['name'];


if(!isset($_SESSION['uid']) && $_SESSION['uid']==''){
  header("location:login.php");
}
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
  <!-- <style>
    .table th, .table td {
    vertical-align: middle;
    line-height: 1;
    white-space: pre-wrap;
    padding: 1.125rem 0.9375rem;
    cursor: pointer;
   }
  </style> -->
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
          <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Uploaded Videos</h4>
                    <form action="" method="post">
                      <div class="row">
                        <div class="col-md-6">
                      <select name="" id="course" class="form-control" >
                        <option value="">-SEARCH BY COURSE-</option>
                        <?php   
                         include("db.php");
                         $sql="SELECT * FROM course WHERE teacher_id='$teacher_id'";
                         $res=$con->query($sql);
                         while($row=$res->fetch_assoc()){
                        ?>
                        <option value="<?php  echo $row['name'] ?>"><?php  echo $row['name'] ?></option>
                        <?php } ?>
                      </select>
                      </div>
                      </div>
                    </form>
                    </p>
                    <div class="table-responsive pt-3">
                      <table class="table table-dark">
                        <thead>
                          <tr>
                            <th>ID</th>
                            <th> Title </th>
                            <th>Course</th>
                            <th> Video </th>
                            <!-- <th> Description </th> -->
                            <th>Upload Date & Time</th>
                            <th>Edit</th>
                            <th>Delete</th>
                          </tr>
                        </thead>
                        <tbody id="results">
                        <?php
                            include("db.php");
                            $sql="SELECT * FROM resource WHERE teacher_id='$teacher_id'";
                            $res=$con->query($sql);
                            $count=0;
                            while($row=$res->fetch_assoc()){
                              $count++;
                            ?>
                          <tr>
                            <td><?php echo $count; ?></td>
                            <td> <?php  echo $row['name'] ?> </td>
                            <td><?php  echo $row['course_name'] ?> </td>
                            <td> <video width="250" height="150" controls>
                                <source src="video_uploads/<?php  echo $row['video'] ?>" type="video/mp4">
                                </video> </td>
                            <!-- <td> <?php  echo $row['description'] ?> </td> -->
                            <td><?php echo $row['upload_time']  ?></td>
                            <td><a href="update_video.php?uid=<?php echo $row['id'];  ?>"><i class="fa fa-pencil-square-o"></i></a></td>
                            <td><a onclick="return confirm('Are you Sure??')" href="del_video.php?did=<?php echo $row['id'];  ?>" ><i class="fa fa-trash-o"></i></a></td>
                          </tr>
                          <?php } ?>
                        </tbody>
                      </table>
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
    <script src="js/search2.js"></script>
    <!-- <script src="assets/js/Chart.roundedBarCharts.js"></script> -->
    <!-- End custom js for this page-->
  </body>
</html>