<?php
session_start();
if(!isset($_SESSION['uid']) && $_SESSION['uid']==''){
  header("location:login.php");
}
include("db.php");
$teacher_id=$_SESSION['uid'];
$teacher_name=$_SESSION['name'];
$update_id=$_GET['uid'];

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
                    <h4 class="card-title">Update Course</h4>
                    <?php
                          include("db.php");
                          $sql="SELECT * FROM course WHERE id='$update_id'";
                          $res=$con->query($sql);
                          $row=$res->fetch_assoc();
                          ?>
                    <p class="card-description"></p>
                    <form class="forms-sample material-form" action="" method="post" enctype="multipart/form-data">
                      <div class="form-group">
                        <input type="text" required="required" name="name" id="name" value="<?php echo $row['name'] ?>"/>
                        <label for="name" class="control-label">Course Title</label><i class="bar"></i>
                      </div>

                      <div class="form-group">
                        <textarea required="required" name="description" id="description" rows="15" col="15"><?php echo $row['description'] ?></textarea>
                        <label for="description" class="control-label">Description</label><i class="bar"></i>
                      </div>

                      <div class="form-group">
                        <p>Course Image</p>
                        <input type="file" name="pimg">
                        <p><img src="uploads/<?php echo $row['image'] ?>" style="width:100px"></p>
                      </div>

                      <div class="button-container">
                          <input type="submit" class="button btn btn-primary" name="addcourse" value="Update Course">
                      </div>
                    </form>
                    <?php  
                    if(isset($_POST['addcourse'])){
                    extract($_POST);
                    $description=$con->real_escape_string($_POST['description']); 
                    $buf=$_FILES['pimg']['tmp_name'];
                    $fn=time().$_FILES['pimg']['name'];
                    
                    $arr_fn=explode(".",$fn);
                    $arr_count=count($arr_fn);
                    if($_FILES['pimg']['name'] && $_FILES['pimg']['name']!=NULL)
                    {
                    if($arr_fn[$arr_count-1]=='jpg' || $arr_fn[$arr_count-1]=='jpeg' || $arr_fn[$arr_count-1]=='png')
                    {
                        move_uploaded_file($buf,"uploads/".$fn);
                        $sql="UPDATE course SET name='$name',description='$description',teacher_name='$teacher_name',teacher_id='$teacher_id',image='$fn' WHERE id='$update_id'";
                        $con->query($sql);
                        echo "<script>alert('Course Updated')
                        window.location.href='add_course.php';
                        </script>";
                    }
                    else{
                        echo "<script>alert('File type not supported')</script>";
                    }
                    }
                    else{
                        $sql="UPDATE course SET name='$name',description='$description',teacher_name='$teacher_name',teacher_id='$teacher_id' WHERE id='$update_id'";
                        $con->query($sql);
                        echo "<script>alert('Course Updated')
                        window.location.href='add_course.php';
                        </script>";
                    }
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