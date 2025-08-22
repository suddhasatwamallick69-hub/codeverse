<?php
session_start();
include("db.php");
if(!isset($_SESSION['aid']) && $_SESSION['aid']==''){
  header("location:index.php");
}


$exam_id=$_GET['eid'];

$sql="SELECT * FROM exam_questions WHERE exam_id='$exam_id'";
$res=$con->query($sql);
$q_count=$res->num_rows;
$row=$res->fetch_assoc();
$exam_name=$row['exam_name'];

$count=0;
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
                  <a href="ended_contest.php" class="btn btn-success">< Back</a>
    <h3><?php echo $exam_name; ?> - LeaderBoard</h3>
    <?php
    $sql1="SELECT *
    FROM correct_question_count
    WHERE correct_count = '$q_count' AND exam_id='$exam_id'
    ORDER BY total_duration";
    $res1=$con->query($sql1);
    if($res1->num_rows>0)
    {
    ?>
  <table class="table">
  <thead>
    <tr>
      <th style="text-align: center;">Rank</th>
      <th style="text-align: center;">Top Contestants</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <?php
      // $count=0;
      while($row1=$res1->fetch_assoc()){
        $count++;
        // print_r($row1);
      ?>
      <td style="text-align: center;"><?php echo $count; ?> </td>
      <td style="text-align: center;"><p><span><?php echo $row1['student_name']; ?></span></p></td>
    </tr>
    <?php } ?>
  </tbody>
</table>
<?php } ?>

<div class="container">
  <?php
    $sql2="SELECT *
    FROM correct_question_count
    WHERE correct_count!='$q_count' AND exam_id='$exam_id'
    ORDER BY correct_count DESC, total_duration ASC";
    $res2=$con->query($sql2);
    if($res2->num_rows>0)
    {
  ?>
  <table class="table">
    <thead>
      <tr>
        <th style="text-align: center;">Rank</th>
        <th style="text-align: center;">Contestants</th>
      </tr>
    </thead>
    <tbody>
      <?php
        while($row2=$res2->fetch_assoc()){
          $count++;
          // print_r($row2);
           if($row2['correct_count']!=0)
           {
      ?>
      <tr>
        <td style="text-align: center;"><?php echo $count; ?></td>
        <td style="text-align: center;"><?php echo $row2['student_name'];?></td>
      </tr>
      <?php }} ?>
    </tbody>
  </table>
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