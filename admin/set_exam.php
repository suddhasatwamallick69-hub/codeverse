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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
                      <h3>Set Contest</h3>
                      <form action="ins_exam.php" method="post">
                        <p>Set Contest Name : <input type="text" name="name" class="form-control" required></p>
                        <p>Total Question: <input type="number" name="tquestions" required></p>
                        <p>Set Contest Date : <input type="date" name="date" id="" class="form-control" required></p>
                        <!-- <p><input type="datetime-local" name="" id=""></p>
                        <p><input type="datetime" name="" id=""></p> -->

                        <div class="row">
                            <div class="col-md-3">
                                 <p>Set Start Time : <input type="datetime-local" name="stime" id="" class="form-control" required></p>
                            </div>

                            <div class="col-md-3">
                                 <p>Set End Time : <input type="datetime-local" name="etime" id="" class="form-control" required></p>
                            </div>
                        </div>
                        
                        <p><input type="submit" value="Set Contest" class="btn btn-primary"></p>
                      </form>
                </div>
                <hr>
                <div class="container">
                    <h3>Upcoming and Live Contests</h3>
                    <table class="table table-bordered" id="result" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Duration</th>
                                            <th>Date</th>
                                            <th>Start time</th>
                                            <th>End time</th>
                                            <th>Status</th>
                                            <th>Edit Contest Details</th>
                                        </tr>
                                    </thead>
                                    <tbody >
                                    <?php
                                    include("db.php");
                                    $sql="SELECT * FROM exam_status WHERE status='upcoming' OR status='Live'";
                                    $res=$con->query($sql);
                                    if($res->num_rows>0)
                                    {
                                    while($row=$res->fetch_assoc())
                                    {
                                        $exam_id=$row['exam_id'];
                                        $sql2="SELECT * FROM exam WHERE id='$exam_id'";
                                        $res2=$con->query($sql2);
                                        while($row2=$res2->fetch_assoc())
                                        {
                                     ?>
                                        <tr>
                                            <td><a href=""><?php echo $row2['exam_name'];  ?></a></td>
                                            <td><?php echo $row2['duration'];  ?> Mins</td>
                                            <td><?php echo $row2['exam_date'];  ?></td>
                                            <td><?php echo $row2['exam_start'];  ?></td>
                                            <td><?php echo $row2['exam_end'];  ?></td>
                                            <td>
                                                <?php
                                                if($row['status']=='upcoming')
                                                {
                                                ?>
                                                <?php echo "<span class='btn btn-primary'>Upcoming</span>";  ?>
                                                <?php }else{ ?>
                                                    <?php echo "<span class='btn btn-danger'>Live</span>";  ?>
                                                    <?php } ?>
                                            </td>
                                            <td>
                                                <?php
                                                if($row['status']=='upcoming'){
                                                ?>
                                                <a href="">Edit</a>
                                                <?php }else{ ?>
                                                    <p>Cannot Edit During an Live Contest</p>
                                                    <?php } ?>
                                            </td>
                                        </tr>
                                        <?php }}}else{ ?>
                                            <td>No Upcoming Contest</td>
                                            <?php } ?>
                                    </tbody>
                            </table>
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