<?php
session_start();
include("db.php");
$exam_id=$_GET['eid'];

if(!isset($_SESSION['stu_name']) && $_SESSION['stu_name']=='')
{
    header("location:index.php");
    exit;
}else{
  $student_id=$_SESSION['sid'];
  $student_name=$_SESSION['stu_name'];
}


$sql4="SELECT * FROM exam WHERE id='$exam_id'";
$res4=$con->query($sql4);
$row4=$res4->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Learn to Code CODEVERSE</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="wrapper/img/logo.png" rel="icon">
  <link href="wrapper/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Bootstrap CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <!--Bootstrap Icons-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  <!-- Main CSS File -->
  <link id="theme-stylesheet" href="wrapper/css/main.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<style>
    .starter-page-page .main .starter-section {
    padding: 30px 0;
    background-color: #e3f2fd;
  }
</style>
</head>

<body class="starter-page-page">

   <?php  include("inc/header.php")  ?>
    <!-- Starter Section Section -->
    <section class="section">
   

    <div class="container mt-5">
       <div class="card p-5 mb-5 rounded shadow p-5">
        <div class="row">
                <?php
                $correct_count=0;
                $incorrect_count=0;
                $unattempted=0;
                $swl="SELECT * FROM exam_questions WHERE exam_id='$exam_id'";
                $rws=$con->query($swl);
                while($ro=$rws->fetch_assoc())
                {
                  $ques_id=$ro['id'];
                  $sel="SELECT * FROM exam_question_status WHERE exam_id='$exam_id' AND student_id='$student_id' AND question_id='$ques_id'";
                  $rs=$con->query($sel);
                  $rw=$rs->fetch_assoc();
                  if($rs->num_rows>0)
                  {
                    if($rw['status']=='Correct')
                    {
                      $correct_count++;
                    }
                    else if($rw['status']=='Incorrect')
                    {
                      $incorrect_count++;
                    }
                    else
                    {
                      $unattempted++;
                    }
                  }
                  else
                  {
                    $unattempted++;
                  }
                }

                ?>
            <div class="col-md-7">
                <h2 class=""><?php echo $row4['exam_name'] ?> - Performance Report</h2>
                  <div class="row">
                    <div class="col-md-4">
                      <h5 class="btn btn-success">Correct Answers - <?php echo $correct_count; ?></h5>
                    </div>
                    <div class="col-md-4">
                      <h5 class="btn btn-danger">Wrong Answers - <?php echo $incorrect_count; ?></h5 class="">
                    </div>
                    <div class="col-md-4">
                      <h5 class="btn btn-warning">Unattempted - <?php echo $unattempted; ?></h5 class="">
                    </div>
                  </div>
            </div>
        </div>
      <table class="" id="table">
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
                  else{
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
      <div class="container">
        <p><a class="btn btn-info" href="leaderboard.php?eid=<?php echo $row4['id']; ?>">Leaderboard</a></p>
      </div>

    </section><!-- /Starter Section Section -->



  <?php  
  include("inc/footer.php"); 
  ?>

  <!-- Vendor JS Files -->
  <script src="wrapper/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="wrapper/vendor/php-email-form/validate.js"></script>
  <script src="wrapper/vendor/aos/aos.js"></script>
  <script src="wrapper/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="wrapper/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Main JS File -->
  <script src="wrapper/js/main.js"></script>
  <script src="wrapper/js/jquery.js"></script>
  <script src="wrapper/js/assessment.js"></script>
  <script src="wrapper/js/mode.js"></script>

</body>

</html>