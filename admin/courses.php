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
                            <h6 class="m-0 font-weight-bold text-primary">Courses List</h6>
                            <input type="search" id="searchcourse" class="form-control" placeholder="Search for courses...">
                        </div>
                        <div class="card-body">
                            <div class="table-responsive" id="results">
                                <table class="table table-bordered" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>Image</th>
                                            <th>Teacher Name</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    include("db.php");
                                    $result_per_page=3;
                                    $sql="SELECT * FROM course";
                                    $res=$con->query($sql);
                                    $no_of_result=$res->num_rows;

                                    $number_of_page=ceil($no_of_result/$result_per_page);

                                    if(!isset($_GET['page'])){
                                        $page=1;
                                    }else{
                                        $page=$_GET['page'];
                                    }

                                    $page_first_result=($page-1)* $result_per_page;
                                    $sel="SELECT * FROM course LIMIT $page_first_result,$result_per_page";
                                    $rs=$con->query($sel);
                                    if($rs->num_rows>0)
                                    {
                                    while($row=$rs->fetch_assoc())
                                    {
                                    ?>
                                        <tr>
                                            <td><?php echo $row['name'];  ?></td>
                                            <td><?php echo $row['description'];  ?></td>
                                            <td><img src="../teacher/uploads/<?php echo $row['image'];  ?>" style="width:100px"></td>
                                            <td><?php echo $row['teacher_name'];  ?></td>
                                        </tr>
                                        <?php }}else{ ?>
                                            <p>No Course</p>
                                            <?php } ?>
                                    </tbody>
                                </table>

                                <?php
                                for($i=1;$i<=$number_of_page;$i++){
                                    if($i==$page)
                                    {
                                        $class="btn btn-success";
                                    }
                                    else{
                                        $class="btn btn-primary";
                                    }
                                ?>
                                <a class="<?php echo $class; ?>" href="courses.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                                <?php } ?>
                            </div>
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
    <script src="js/searchcourse.js"></script>

</body>

</html>