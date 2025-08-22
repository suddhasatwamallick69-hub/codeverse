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
                    <h4 class="card-title">List of Questions</h4>
                    <form action="" method="post">
                      <div class="row">
                        <div class="col-md-6">
                          <p><input type="text" id="cname" class="form-control" placeholder="Search for Course or Questions"></p>
                      </div>
                      </div>
                    </form>
                    </p>
                    <div class="table-responsive pt-3">
                      <table class="table table-dark">
                        <thead>
                          <tr>
                            <th>Course</th>
                            <th>No</th>
                            <th> Name </th>
                            <th> Option1 </th>
                            <th> Option2 </th>
                            <th>Option3</th>
                            <th>Option4</th>
                            <th>Answer</th>
                            <th>Edit</th>
                            <th>Delete</th>
                          </tr>
                        </thead>
                        <tbody id="results">
                        <?php
                            include("db.php");
                            $sql="SELECT * FROM course_questions WHERE teacher_id='$teacher_id'";
                            $res=$con->query($sql);
                            while($row=$res->fetch_assoc()){
                            ?>
                          <tr>
                            <td><?php  echo $row['course_name'] ?> </td>
                            <td> <?php  echo $row['question_no'] ?> </td>
                            <td> <?php  echo $row['name'] ?> </td>
                            <td><?php if($row['op1']==$row['answer']){echo "<span style='color:pink;font-weight:700px'>".$row['op1']."</span>";}else{ echo $row['op1']; }   ?></td>
                            <td><?php if($row['op2']==$row['answer']){echo "<span style='color:pink;font-weight:700px'>".$row['op2']."</span>";}else{ echo $row['op2']; } ?></td>
                            <td><?php if($row['op3']==$row['answer']){echo "<span style='color:pink;font-weight:700px'>".$row['op3']."</span>";}else{ echo $row['op3']; }?></td>
                            <td><?php if($row['op4']==$row['answer']){echo "<span style='color:pink;font-weight:700px'>".$row['op4']."</span>";}else{ echo $row['op4']; }  ?></td>
                            <td><?php echo "<span style='color:pink;font-weight:700px'>".$row['answer']."</span>";  ?></td>
                            <td><a href="update_q.php?uid=<?php echo $row['id'];  ?>"><i class="fa fa-pencil-square-o"></i></a></td>
                            <td><a onclick="return confirm('Are you Sure??')" href="del_q.php?did=<?php echo $row['id'];  ?>" ><i class="fa fa-trash-o"></i></a></td>
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
    <!-- <script src="assets/js/Chart.roundedBarCharts.js"></script> -->

    <script src="js/jquery.js"></script>
    <script src="js/search4.js"></script>
    <!-- End custom js for this page-->
  </body>
</html>