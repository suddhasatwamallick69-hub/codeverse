<?php
session_start();
include("db.php");
if(!isset($_SESSION['aid']) && $_SESSION['aid']==''){
  header("location:index.php");
}
$exam_id=$_GET['eid'];
$student_id=$_GET['sid'];


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
                    <a href="student_details.php?sid=<?php echo $student_id; ?>" class="btn btn-success mb-2">< Back</a>
                    <?php
                   $sql4="SELECT * FROM exam WHERE id='$exam_id'";
                   $res4=$con->query($sql4);
                   $row4=$res4->fetch_assoc();
                   ?>
                    <h4 class="mb-3 font-weight-bold text-primary">Performance Report of <?php echo $name; ?> for <?php echo $row4['exam_name'] ?></h4>
                      <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                  <table class="table">
                                       <thead>
                                          <tr>
                                            <th scope="col">Problem Statement</th>
                                            <th scope="col">Remarks</th>
                                          </tr>
                                       </thead>
                                        <tbody>
                                          <?php
                                          $sql="SELECT * FROM exam_questions WHERE exam_id='$exam_id'";
                                          $res=$con->query($sql);
                                          while($row=$res->fetch_assoc()){
                                              $qid=$row['id'];
                                              $sql1="SELECT * FROM exam_question_status WHERE exam_id='$exam_id' AND question_id='$qid' AND student_id='$student_id'";
                                              $res1=$con->query($sql1);
                                              $row1=$res1->fetch_assoc();
                                          ?>
                                          <tr>
                                            <td><?php echo $row['question_name']; ?></td>
                                            <td>
                                                
                                              <?php 
                                              if($res1->num_rows>0)
                                              {
                                                if($row1['status']=='Correct')
                                                      { 
                                                          echo "Correct";
                                                      }
                                                      else if($row1['status']=='Incorrect')
                                                      {
                                                          echo "Incorrect";
                                                      }
                                                     else
                                                      {
                                                          echo "Not Attempted";
                                                      }
                                             }    
                                             else
                                             {
                                                echo"Not Attempted";
                                             }   
                                              ?>
                                              </td>
                                          </tr>
                                          <?php } ?>
                                        </tbody>
                                  </table>
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
    <script src="js/search_teacher.js"></script>
</body>

</html>