<?php
session_start();
include("db.php");
if(!isset($_SESSION['aid']) && $_SESSION['aid']==''){
  header("location:index.php");
}
if(isset($_GET['sid']))
{
    $student_id=$_GET['sid'];
}
$sql="SELECT * FROM students WHERE id='$student_id'";
$res=$con->query($sql);
$row=$res->fetch_assoc();
$name=$row['name'];
$email=$row['email'];
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
                    <a href="list_student.php" class="btn btn-success mb-2">< Back</a>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <div class="row">
                            <div class="col-md-6">
                                 <h4>Details of <?php echo  $name; ?></h4>
                            </div>
                            <div class="col-md-6">
                                <h4>Contests Participated in</h4>
                            </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 border border-dark p-4">
                                    <h3>Name : <?php echo $name; ?></h3>
                                    <hr>
                                    <h4>Email : <?php echo $email; ?></h4>
                                </div>
                                <div class="col-md-6 border border-dark p-4">
                                         <table class="table">
                                              <thead>
                                                   <tr>
                                                       <th scope="col">Contest Name</th>
                                                       <th scope="col">Report</th>
                                                   </tr>
                                              </thead>
                                               <tbody> 
                                                <?php
                                                $sql2="SELECT * FROM correct_question_count WHERE student_id='$student_id'";
                                                $res2=$con->query($sql2);
                                                if($res2->num_rows>0)
                                                {
                                                while($row2=$res2->fetch_assoc())
                                                {
                                                ?>
                                                 <tr>
                                                    <td><h5 class="text-primary"><?php echo $row2['exam_name']; ?></h5></td>
                                                    <td><p><a href="student_exam_report.php?sid=<?php echo $student_id; ?>&eid=<?php echo $row2['exam_id'] ?>" class="btn btn-warning">Report</a></p></td>
                                                 </tr>
                                                 <?php }}else{ ?>
                                                    <td>Not participated in any contest</td>
                                                    <?php } ?>
                                               </tbody>
                                         </table>
                                </div>
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

</body>

</html>