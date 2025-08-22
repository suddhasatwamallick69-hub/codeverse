<?php
session_start();
if(!isset($_SESSION['aid']) && $_SESSION['aid']==''){
  header("location:index.php");
}
$tid=$_GET['tid'];
include("db.php");
$sql="SELECT * FROM teacher WHERE id='$tid'";
$res=$con->query($sql);
$row=$res->fetch_assoc();
$tname=$row['name'];
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php  include("inc/sidebar.php"); ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
                
                <!-- Topbar -->
                <?php  include("inc/topbar.php"); ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <h4>Courses Uploaded by Teacher <span><?php  echo $tname; ?></span></h4>
                      <div class="row">
                      <?php
                                    include("db.php");
                                    $sql="SELECT * FROM course WHERE teacher_id='$tid'";
                                    $res=$con->query($sql);
                                    while($row=$res->fetch_assoc())
                                    {
                                    ?>
                         <div class="col-xs-12 col-sm-6 col-md-4 mt-2">
                            <div class="card" style="width:400px">
                            <img class="card-img-bottom" src="../teacher/uploads/<?php echo $row['image']; ?>" alt="Card image" style="width:340px;height:250px">
                               <div class="card-body">
                                  <h4 class="card-title"><?php echo $row['name'];  ?></h4>
                                  <p class="card-text"><?php echo $row['description']; ?></p>
                                  <a href="view_course.php?vcid=<?php echo $row['id'];  ?>" class="btn btn-primary">View Course</a>
                                  <a href="view_quesions.php?qcid=<?php echo $row['id'];  ?>" class="btn btn-success">View Quesions</a>
                               </div>
                                 
                            </div>
                         </div>
                          <?php } ?>
                      </div>

                      
                        
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php  include("inc/footer.php"); ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <?php include("inc/logoutmodal.php"); ?>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>