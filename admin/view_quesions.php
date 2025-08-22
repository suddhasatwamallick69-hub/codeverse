<?php

session_start();
if(!isset($_SESSION['aid']) && $_SESSION['aid']==''){
  header("location:index.php");
}
include("db.php");
$qcid=$_GET['qcid'];
$_SESSION['qcid']=$qcid;
 $sql="SELECT * FROM course WHERE id='$qcid'";
$res=$con->query($sql);
while($row=$res->fetch_assoc()){
$course_name=$row['name'];
$teacher_name=$row['teacher_name'];
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
                <div class="container-fluid">
                      <h3>Course : <?php  echo $course_name; ?></h3>
                      <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Quesions by <?php echo $teacher_name; ?></h6>
                        </div>
                        <div class="card-body">
                        <form action="" method="post">
                      <div class="row">
                        <div class="col-md-6">
                          <p><input type="text" class="form-control" id="cname" name="cname" placeholder="search questions..."></p>
                        </div>
                        <div class="col-md-6">
                          <p><input type="submit" value="Search" class="btn btn-primary ml-2" name="search"></p>
                        </div>
                      </div>
                    </form>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                       <th>Course</th>
                                       <th>No</th>
                                       <th> Name </th>
                                       <th style="color:green"> Option1 </th>
                                       <th style="color:green"> Option2 </th>
                                       <th style="color:green">Option3</th>
                                       <th style="color:green">Option4</th>
                                       <th style="color:red">Answer</th>
                                       <!-- <th>Edit</th>
                                       <th>Delete</th> -->
                                    </tr>
                                    </thead>
                                    <tbody id="results">
                                     <?php
                                         include("db.php");
                                         if(isset($_POST['search'])){
                                           $cname=$_POST['cname'];
                                         $sql="SELECT * FROM course_questions WHERE course_id='$qcid' AND (name LIKE '%$cname%')";
                                       $res=$con->query($sql);
                                       while($row=$res->fetch_assoc()){
                                         ?>
                                       <tr>
                                         <td><?php  echo $row['course_name'] ?> </td>
                                         <td> <?php  echo $row['question_no'] ?> </td>
                                         <td> <?php  echo $row['name'] ?> </td>
                                         <td><?php if($row['op1']==$row['answer']){echo "<span style='color:blue;font-weight:700px'>".$row['op1']."</span>";}else{ echo $row['op1']; }   ?></td>
                                         <td><?php if($row['op2']==$row['answer']){echo "<span style='color:blue;font-weight:700px'>".$row['op2']."</span>";}else{ echo $row['op2']; } ?></td>
                                         <td><?php if($row['op3']==$row['answer']){echo "<span style='color:blue;font-weight:700px'>".$row['op3']."</span>";}else{ echo $row['op3']; }?></td>
                                         <td><?php if($row['op4']==$row['answer']){echo "<span style='color:blue;font-weight:700px'>".$row['op4']."</span>";}else{ echo $row['op4']; }  ?></td>
                                         <td><?php echo "<span style='color:blue;font-weight:700px'>".$row['answer']."</span>";  ?></td>
                                         <td><a href="update_q.php?uid=<?php echo $row['id'];  ?>">Edit</a></td>
                                         <td><a onclick="return confirm('Are you Sure??')" href="del_q.php?did=<?php echo $row['id'];  ?>" >Delete</a></td>
                                       </tr>
                                       
                                       <?php }} else{
                                         $sql="SELECT * FROM course_questions WHERE course_id='$qcid'";
                                         $res=$con->query($sql);
                                         while($row=$res->fetch_assoc()){
                                         ?>
                                       <tr>
                                         <td><?php  echo $row['course_name'] ?> </td>
                                         <td> <?php  echo $row['question_no'] ?> </td>
                                         <td> <?php  echo $row['name'] ?> </td>
                                         <td><?php if($row['op1']==$row['answer']){echo "<span style='color:blue;font-weight:700px'>".$row['op1']."</span>";}else{ echo $row['op1']; }   ?></td>
                                         <td><?php if($row['op2']==$row['answer']){echo "<span style='color:blue;font-weight:700px'>".$row['op2']."</span>";}else{ echo $row['op2']; } ?></td>
                                         <td><?php if($row['op3']==$row['answer']){echo "<span style='color:blue;font-weight:700px'>".$row['op3']."</span>";}else{ echo $row['op3']; }?></td>
                                         <td><?php if($row['op4']==$row['answer']){echo "<span style='color:blue;font-weight:700px'>".$row['op4']."</span>";}else{ echo $row['op4']; }  ?></td>
                                         <td><?php echo "<span style='color:blue;font-weight:700px'>".$row['answer']."</span>";  ?></td>
                                         <!-- <td><a href="update_q.php?uid=<?php echo $row['id'];  ?>" class="btn btn-success">Edit</a></td>
                                         <td><a onclick="return confirm('Are you Sure??')" href="del_q.php?did=<?php echo $row['id'];  ?>" class="btn btn-danger">Delete</a></td> -->
                                       </tr>
                                       <?php }} ?>
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


    <script src="js/search_questions.js"></script>
    <script src="js/jquery.js"></script>

</body>

</html>