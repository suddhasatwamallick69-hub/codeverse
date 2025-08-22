<?php
session_start();
if(!isset($_SESSION['uid']) && $_SESSION['uid']==''){
  header("location:login.php");
}

include("db.php");
$teacher_id=$_SESSION['uid'];
$teacher_name=$_SESSION['name'];

$qid=$_GET['uid'];
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
                    <?php
                    $sql="SELECT * FROM course_questions WHERE id='$qid'";
                    $res=$con->query($sql);
                    $row=$res->fetch_assoc();
                    $question_name=$row['name'];
                    $cname=$row['course_name'];
                    ?>
                    <h4 class="card-title">Update the Question : <?php echo $question_name; ?></h4>
                    <p class="card-description"></p>
                    <form class="forms-sample material-form" action="" method="post" enctype="multipart/form-data">
                      <div class="form-group">
                        <input type="text" required="required" name="name" id="name" value="<?php echo $row['name'] ?>" required/>
                        <label for="name" class="control-label">Question Name</label><i class="bar"></i>
                      </div>

                      <div class="form-group">
                        <input type="text" required="required" name="op1" id="op1" value="<?php echo $row['op1'] ?>" required/>
                        <label for="op1" class="control-label">Option 1</label><i class="bar"></i>
                      </div>

                      <div class="form-group">
                        <input type="text" required="required" name="op2" id="op2" value="<?php echo $row['op2'] ?>" required/>
                        <label for="op2" class="control-label">Option 2</label><i class="bar"></i>
                      </div>

                      <div class="form-group">
                        <input type="text" required="required" name="op3" id="op3" value="<?php echo $row['op3'] ?>" required/>
                        <label for="op3" class="control-label">Option 3</label><i class="bar"></i>
                      </div>

                      <div class="form-group">
                        <input type="text" required="required" name="op4" id="op4" value="<?php echo $row['op4'] ?>" required/>
                        <label for="op4" class="control-label">Option 4</label><i class="bar"></i>
                      </div>

                      <div class="form-group">
                        <input type="text" required="required" name="answer" value="<?php echo $row['answer'] ?>" id="answer"/>
                        <label for="answer" class="control-label">Answer</label><i class="bar"></i>
                      </div>
                      <div class="button-container">
                        <input type="submit" class="button btn btn-primary" name="addquestion" value="Update">
                      </div>
                    </form>
                    <?php
                   if(isset($_POST['addquestion']))
                   {
                    extract($_POST);
                    $op1=$con->real_escape_string($_POST['op1']);
                    $op2=$con->real_escape_string($_POST['op2']);
                    $op3=$con->real_escape_string($_POST['op3']);
                    $op4=$con->real_escape_string($_POST['op4']);
                    $answer=$con->real_escape_string($_POST['answer']);
                    
                    $loop=0;
                    $count=0;

                    $res="SELECT * FROM course_questions WHERE course_name='$cname' ORDER BY id ASC";
                    $rs=$con->query($res);
                    $count=$rs->num_rows;
                    echo $count;
                    if($count==0){

                    }
                    else{
                        while($row=$rs->fetch_array()){
                            $loop=$loop+1;
                            $id=$row['id'];
                            $up="UPDATE course_questions SET question_no='$loop' WHERE id='$qid'";
                            $con->query($up);
                        }
                    }
                    $loop=$loop+1;
                    
                        
                        $sql="UPDATE course_questions SET name='$name',op1='$op1',op2='$op2',op3='$op3',op4='$op4',answer='$answer' WHERE id='$qid'";
                        $con->query($sql);
                    ?>
                    <script>
                        alert('Question Updated');
                        window.location.href='list_questions.php';
                    </script>
                    <?php } ?>
                  </div>
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