<?php
session_start();

if(!isset($_SESSION['uid']) && $_SESSION['uid']==''){
  header("location:login.php");
}
include("db.php");
$update_id=$_GET['uid'];
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
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <?php
                    include("db.php");
                    $sql="SELECT * FROM resource WHERE id='$update_id'";
                    $res=$con->query($sql);
                    $row=$res->fetch_assoc();
                    ?>
                    <h4 class="card-title">Update Video Details - Course : <?php echo $row['course_name'];  ?></h4>
                    <form class="forms-sample material-form" action="" method="post" enctype="multipart/form-data">
                      <div class="form-group">
                        <input type="text" value="<?php echo $row['name'];  ?>" class="form-control" id="exampleInputName1" placeholder="Video Title" name="name">
                        <label for="exampleInputName1" class="control-label">Video Title</label><i class="bar"></i>
                      </div>

                      <div class="form-group">
                        <textarea class="" id="description" rows="15" col="15" name="description"><?php echo $row['description'];  ?></textarea>
                        <label for="description" class="control-label">Video Description</label><i class="bar"></i>
                      </div>

                      <div class="form-group">
                        <label>Video upload</label>
                        <input type="file" name="video" class="file-upload">
                      </div>

                      <div class="form-group">
                        <label>Video</label>
                        <p><video width="250" height="150" controls>
                                <source src="video_uploads/<?php  echo $row['video'] ?>" type="video/mp4">
                                </video></p>
                      </div>
                      
                      <input type="submit" class="btn btn-primary me-2" value="Update" name="update">
                    </form>
                    <?php
                    if(isset($_POST['update']))
                    {
                       include("db.php");

                       extract($_POST);
                       $description=$con->real_escape_string($_POST['description']);
                       $buf=$_FILES['video']['tmp_name'];
                       $fn=time().$_FILES['video']['name'];

                       if($_FILES['video']['name'] && $_FILES['video']['name']!=NULL){
                         unlink("video_uploads/".$row['video']);
                         move_uploaded_file($buf,"video_uploads/".$fn);
                         $sql="UPDATE resource SET name='$name',description='$description',video='$fn' WHERE id='$update_id'";
                         $con->query($sql);
                         echo "<script>alert('Video Details Updated');
                         window.location.href='list_videos.php';
                         </script>";
                        }
else{
  $sql="UPDATE resource SET name='$name',description='$description' WHERE id='$update_id'";
  $con->query($sql);
  echo "<script>alert('Video Details Updated');
  window.location.href='list_videos.php';
  </script>";
} 
}
             
?>
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