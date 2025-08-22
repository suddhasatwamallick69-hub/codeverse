<?php
session_start();
if(!isset($_SESSION['aid']) && $_SESSION['aid']==''){
  header("location:index.php");
}
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
                <div class="container">
                      <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h3 class="m-0 font-weight-bold text-danger">Live Contests</h3>
                            <p></p>
                        </div>
                        <div class="row">
                            <?php
                            include("db.php");
                            $sql="SELECT * FROM exam_status WHERE status='Live'";
                            $res=$con->query($sql);
                            if($res->num_rows)
                            {
                            while($row=$res->fetch_assoc())
                            {
                                        $exam_id=$row['exam_id'];
                                        $sql2="SELECT * FROM exam WHERE id='$exam_id'";
                                        $res2=$con->query($sql2);
                                        while($row2=$res2->fetch_assoc())
                                        {
                            ?>
                            <div class="col-md-12">
                                    <div class="card-body p-5">
                                          <div class="row">
                                            <div class="col-md-3">
                                               <h4><a href=""><?php echo $row2['exam_name']; ?></a></h4>
                                            </div>
                                            <div class="col-md-3">
                                               <h4><a href=""><?php echo $row2['exam_date']; ?></a></h4>
                                            </div>
                                            <div class="col-md-3">
                                               <h4><a href=""><?php echo $row2['duration']; ?> Mins</a></h4>
                                            </div>
                                            <div class="col-md-3">
                                               <h4><a href=""><?php echo $row2['exam_name']; ?></a></h4>
                                            </div>
                                          </div>
                                    </div>
                            </div>
                            <?php }}}else{ ?>
                                <div class="col-md-12">
                                    <div class="card-body p-5">
                                          <h3><h4>No Contests Live</h4></h3>
                                    </div>
                                </div>
                                
                                <?php } ?>
                        </div>
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


    <script src="js/jquery.js"></script>
    <script src="js/assign.js"></script>


</body>

</html>