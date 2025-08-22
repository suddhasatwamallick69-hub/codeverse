<?php
session_start();
include("db.php");
if(isset($_SESSION['sid']))
{
  $student_id=$_SESSION['sid'];
  $student_name=$_SESSION['stu_name'];
}
$exam_id=$_GET['eid'];

$sql="SELECT * FROM exam_questions WHERE exam_id='$exam_id'";
$res=$con->query($sql);
$q_count=$res->num_rows;
$row=$res->fetch_assoc();
$exam_name=$row['exam_name'];

$sql3="SELECT * FROM exam_question_status WHERE exam_id='$exam_id'";
$res3=$con->query($sql3);
$l_count=$res3->num_rows;
// echo $l_count;

$count=0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>LeaderBoard - <?php echo $exam_name; ?></title>
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
</head>

<body class="">

   <?php  include("inc/header.php")  ?>
    <section  class="section">
      <div class="container">
        <h3><?php echo $exam_name; ?> - LeaderBoard</h3>
        <?php
        if($l_count==0)
        {
          echo"<h4>No one appeared for $exam_name </h4>";
        }
        else{
        ?>
        <ul>
          <li>The top contestant is the one who answers every question correctly.</li>
        </ul>
        <div class="row">
            <div class="col-md-4">
              <?php
               $sql1="SELECT *
               FROM correct_question_count
               WHERE correct_count = '$q_count' AND exam_id='$exam_id'
               ORDER BY total_duration";
               $res1=$con->query($sql1);
               if($res1->num_rows>0)
               {
               ?>
                <table id="table">
                  <thead>
                    <tr>
                      <th style="text-align: center;">Rank</th>
                      <th style="text-align: center;">Top Contestants</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <?php
                      while($row1=$res1->fetch_assoc()){
                        $count++;
                      ?>
                      <td style="text-align: center;"><?php echo $count; ?> </td>
                      <td style="text-align: center;"><p><span><?php echo $row1['student_name']; ?></span></p></td>
                    </tr>
                    <?php } ?>
                  </tbody>
                </table>
               <?php }else{ ?>
                <h4>No Top Contestants in this contest</h4>
                <?php } ?>
            </div>
        
            <div class="col-md-8">
             <?php
              $sql2="SELECT *
              FROM correct_question_count
              WHERE correct_count!='$q_count' AND correct_count!=0 AND exam_id='$exam_id'
               ORDER BY correct_count DESC, total_duration ASC"; //AND correct_count!=0 
              $res2=$con->query($sql2);
              if($res2->num_rows>0)
              {
             ?>
              <table id="table">
                <thead>
                  <tr>
                    <th style="text-align: center;">Rank</th>
                    <th style="text-align: center;">Contestants</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    while($row2=$res2->fetch_assoc())
                    {
                      $count++;
                      // if($row2['correct_count']!=0)
                      // {
                  ?>
                  <tr>
                    <td style="text-align: center;"><?php echo $count; ?></td>
                    <td style="text-align: center;"><?php echo $row2['student_name'];?></td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
             <?php } ?>
            </div>
        </div>
        <?php } ?>
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