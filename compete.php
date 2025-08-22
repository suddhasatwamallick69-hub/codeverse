<?php
session_start();
include("db.php");
if(isset($_SESSION['sid'])){
  $student_id=$_SESSION['sid'];
  $student_name=$_SESSION['stu_name'];
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Compete CODEVERSE</title>
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
  <link href="wrapper/css/main.css" id="theme-stylesheet" rel="stylesheet">

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>

<body class="">

   <?php  include("inc/header.php")  ?>
    <!-- Service Details Section -->
    <section id="service-details" class="service-details section">
        <div class="container">
          <div class="card">
            <div class="row">
                <div class="col-md-9">
                    <img src="wrapper\img\Weekly-Coding-Contest-Platforms.png" style="width:809px">
                </div>
                <div class="col-md-3 p-3">
                  <?php
                  include("db.php");
                  date_default_timezone_set('Asia/Kolkata');
                  $current_time = date("H:i:s");
                  $sel="SELECT * FROM exam_status WHERE status='Live'";
                  $rs=$con->query($sel);
                  if($rs->num_rows>0){
                  while($rw=$rs->fetch_assoc())
                  {
                  $ex_id=$rw['exam_id'];

                  $sql2="SELECT * FROM exam WHERE id='$ex_id'";
                  $res=$con->query($sql2);
                  
                  while($row=$res->fetch_assoc())
                  {
                    $targetTime=$row['exam_start'];
                    $end_time=$row['exam_end'];
                  ?>
                    <h4>Contest Live</h4>
                    <a href=""><?php echo $row['exam_name']; ?></a>
                    <p></p>
                      <?php 
                      }}}
                      else{ 
                        ?>
                      <h4>NO CONTEST LIVE</h4>
                  <?php } ?>
                </div>
            </div>
         </div>
            
            <div class="row mt-4">
                <h2><u>Contests & Upcoming Contests</u></h2>
                <table class="p-3" id="table">
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>Date</th>
                        <th>Duration</th>
                        <th id="endsin"></th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                                    <?php
                                    include("db.php");
                                    date_default_timezone_set('Asia/Kolkata');
                                    $current_time = date("Y-m-d H:i:s");
                                    $sql4="SELECT * FROM exam_status WHERE status='upcoming' OR status='Live'";
                                    $res=$con->query($sql4);
                                    while($row4=$res->fetch_assoc()){
                                    $exam_status_id=$row4['exam_id'];
                                    // echo $exam_status_id;
                                    $status=$row4['status'];
                                    // echo $status."<br>";
                                    $sql2="SELECT * FROM exam WHERE id='$exam_status_id'";
                                    $res2=$con->query($sql2);
                                    // echo "Current Time :".$current_time."<br>";
                                    while($row=$res2->fetch_assoc())
                                    {
                                      $examId = $row['id'];
                                      $targetDate=$row['exam_date'];
                                      $targetTime=$row['exam_start'];
                                      $end_time=$row['exam_end'];
                                      // echo "Start Time :".$targetTime."<br>";
                                      // echo "End Time: ".$end_time."<br>";

                                      // if($current_time>=$end_time){
                                      //   // echo "Ended";
                                      //   // echo $end_time;
                                      //   $up="UPDATE exam_status es
                                      //       JOIN exam e ON es.exam_id = e.id
                                      //       SET es.status = 'ended'
                                      //       WHERE e.id = '$examId'";
                                      //   $con->query($up);
                                      //   $up1a="UPDATE exam
                                      //             SET status = 'ended'
                                      //             WHERE id = '$examId'";
                                      //   $con->query($up1a);
                                      // }
                                      // elseif($current_time>=$targetTime)
                                      // {
                                      //   echo "LIVE";
                                      //   $up1="UPDATE exam_status es
                                      //       JOIN exam e ON es.exam_id = e.id
                                      //       SET es.status = 'Live'
                                      //       WHERE e.id = '$examId'";
                                      //   $con->query($up1);
                                      //   $up1b="UPDATE exam
                                      //             SET status = 'Live'
                                      //             WHERE id = '$examId'";
                                      //   $con->query($up1b);
                                        
                                      // }

                                      $examData[] = [
                                        'id' => $row['id'],
                                        'date' => $row['exam_date'],
                                        'start_time' => $row['exam_start'],
                                        'end_time' => $row['exam_end'],
                                        'duration' => $row['duration']
                                    ];
                                    ?>
                      <tr>
                        <td><a href=""><?php echo $row['exam_name']; ?></a></td>
                        <td><?php echo $row['exam_date']; ?></td>
                        <td><?php echo $row['duration']; ?> Mins</td>
                        <td id="countdown-<?php echo $examId; ?>"></td>
                        <td><a href="contest_details.php?cid=<?php echo $row['id'] ?>" class="abtnn" id="start-<?php echo $examId; ?>">Contest</a></td>
                        <?php } ?>
                      </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

            <div class="row mt-4">
                <h2><u>Previous Contests</u></h2>
                <table class="" id="table">
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>Date</th>
                        <th>Duration</th>
                        <th>Report</th>
                      </tr>
                    </thead>
                    <tbody>
                                   <?php
                                    include("db.php");
                                    $sql_chk="SELECT * FROM exam_status WHERE status='ended'";
                                    $res_chk=$con->query($sql_chk);
                                    while($row_chk=$res_chk->fetch_assoc())
                                    {
                                      $eid_chk=$row_chk['exam_id'];
                                    $sql2="SELECT * FROM exam WHERE id='$eid_chk' ORDER BY id DESC";
                                    $res=$con->query($sql2);
                                    while($row=$res->fetch_assoc())
                                    {
                                    ?>
                      <tr>
                        <td><a href="contest_details.php?cid=<?php echo $row['id'] ?>"><?php echo $row['exam_name']; ?></a></td>
                        <td><?php echo $row['exam_date']; ?></td>
                        <td><?php echo $row['duration']; ?> Mins</td>
                           <?php
                            if(isset($_SESSION['stu_user_name']))
                            {
                            $sql3="SELECT * FROM exam_question_status WHERE student_id='$student_id' AND exam_id='$row[id]'";  
                            $res3=$con->query($sql3);
                            if($res3->num_rows>0)
                            {
                            ?>
                           <td><a href="exam_report.php?eid=<?php echo $row['id']; ?>">View Report</a></td>
                           <?php 
                           }                        
                           else
                           {
                            ?>
                             <td><a href="leaderboard.php?eid=<?php echo $row['id']; ?>" class="btn btn-success">Leaderboard</a></td>
                           <?php 
                           }
                           }
                           else
                           { 
                           ?>
                           <td><a href="leaderboard.php?eid=<?php echo $row['id']; ?>" class="btn btn-success">Leaderboard</a></td>
                           <?php } ?>
                      </tr>
                      <?php }} ?>
                    </tbody>
                </table>
            </div>
            <?php
            
            ?>
        </div>
    </section><!-- /Service Details Section -->



  <?php  include("inc/footer.php") ?>


  <!-- Vendor JS Files -->
  <script src="wrapper/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="wrapper/vendor/php-email-form/validate.js"></script>
  <script src="wrapper/vendor/aos/aos.js"></script>
  <script src="wrapper/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="wrapper/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Main JS File -->
  <script src="wrapper/js/main.js"></script>
  <script src="wrapper/js/jquery.js"></script>
  <script src="wrapper/js/mode.js"></script>

  <script>
    $(document).ready(function () {
        const exams = <?php echo json_encode($examData); ?>;

        exams.forEach(function(exam) {
            const startDateTime = new Date(exam.start_time).getTime();
            const endDateTime = new Date(exam.end_time).getTime();
            const countdownId = "#countdown-" + exam.id;
            const startbtn = "#start-" + exam.id;
            let liveUpdated = false;
            let endUpdated = false; 

            const countdownFunction = setInterval(function () {
                const now = new Date().getTime();
                const timeUntilStart = startDateTime - now;
                const timeUntilEnd = endDateTime - now;

                if (timeUntilStart > 0) {
                  $('#endsin').html("<span>Starts In</span>");
                    const days = Math.floor(timeUntilStart / (1000 * 60 * 60 * 24));
                    const hours = Math.floor((timeUntilStart % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    const minutes = Math.floor((timeUntilStart % (1000 * 60 * 60)) / (1000 * 60));
                    const seconds = Math.floor((timeUntilStart % (1000 * 60)) / 1000);
                    
                    $(countdownId).html(days + "d " + hours + "h " + minutes + "m " + seconds + "s ");
                }
                else if (timeUntilStart <= 0 && timeUntilEnd > 0) {
                  const days = Math.floor(timeUntilEnd / (1000 * 60 * 60 * 24));
                    const hours = Math.floor((timeUntilEnd % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    const minutes = Math.floor((timeUntilEnd % (1000 * 60 * 60)) / (1000 * 60));
                    const seconds = Math.floor((timeUntilEnd % (1000 * 60)) / 1000);

                    if(liveUpdated==false){
                      $.ajax({
                        url:'update_exam_status.php',
                        method:"POST",
                        data:{
                          exam_id:exam.id,
                          status:"Live"
                        },
                          success:function (response) 
                          {
                            if (response == 'success') 
                            {
                                console.log('Exam status updated to Live');
                                liveUpdated = true;
                                window.location.reload();
                            }
                          },
                          error: function (err) {
                          console.error('Error updating exam status:', err);
                          }
                      });
                    }
                    $(countdownId).html(days + "d " + hours + "h " + minutes + "m " + seconds + "s <span style='color:red;'>Contest Live</span>");
                    $('#endsin').html("<span>Ends In</span>");
                }
                else if (timeUntilEnd <= 0) {
                    // clearInterval(countdownFunction);
                    $(countdownId).html("<span style='color:red;'>Contest Ended</span>");
                    $('#endsin').empty();

                    if(!endUpdated)
                    {
                      $.ajax({
                        url:'update_exam_status.php',
                        method:"POST",
                        data:{
                          exam_id:exam.id,
                          status:"ended"
                        },
                        success: function (response) {
                            if (response == 'success') {
                                endUpdated = true;
                                console.log('Exam status updated to Ended');
                                window.location.reload();
                            }
                        },
                        error: function (err) {
                            console.error('Error updating exam status:', err);
                        }
                      });
                      localStorage.clear();
                    }
                }
            }, 1000);
        });
    });
  </script>

</body>

</html>