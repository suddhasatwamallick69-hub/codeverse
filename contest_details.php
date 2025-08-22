<?php
session_start();

if(isset($_SESSION['sid'])){
  $student_id=$_SESSION['sid'];
  $student_name=$_SESSION['stu_name'];
}
include("db.php");
if(isset($_GET['cid']))
{
  $contest_id=$_GET['cid'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title><?php echo $_SESSION['exam_name']; ?> CODEVERSE CONTEST</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="wrapper/img/logo.png" rel="icon">
  <link href="wrapper/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <!--Bootstrap Icons-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  <!-- Main CSS File -->
  <link href="wrapper/css/main2.css" id="theme-stylesheet" rel="stylesheet">

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>

<body>

   <?php  include("inc/header.php")  ?>
    <!-- Service Details Section -->
    <section id="contest-details" class="contest-details section">

      <div class="container-fluid">

        <div class="row gy-5">
          <?php
          date_default_timezone_set('Asia/Kolkata');
          $current_time = date("Y-m-d H:i:s");
          $sql="SELECT * FROM exam WHERE id='$contest_id'";
          $res=$con->query($sql);
          $row=$res->fetch_assoc();
          $examId = $row['id'];
          $duration=$row['duration'];
          $_SESSION['exam_name']=$row['exam_name'];
          $start_time=$row['exam_start'];
          $end_time=$row['exam_end'];
          $exam_date=$row['exam_date'];
          ?>

          <div class="col-lg-7 ps-lg-5">
            <img src="wrapper/img/codingcompetitionblog-23489.webp" alt="" class="img-fluid">
            <h4>Problem Statements</h4>
            <table class="" id="table">
                 <thead>
                     <tr>
                        <th>Question ID</th>
                        <th scope="col">Name</th>
                        <th>Difficulty</th>
                        <th scope="col">Code</th>
                        <th scope="col">Status</th>
                     </tr>
                 </thead>
                 <tbody>
                  <?php
                  date_default_timezone_set('Asia/Kolkata');
                  $current_time = date("Y-m-d H:i:s");
                  if($current_time>=$start_time && $current_time < $end_time)
                  {
                    $sql2="SELECT * FROM exam_questions WHERE exam_id='$contest_id'"; 
                    $res2=$con->query($sql2);
                    $count=0;
                    while($row2=$res2->fetch_assoc())
                    {
                      $count++;
                    ?>
                    <tr>
                       <td><?php echo $count; ?></td>
                       <td><?php echo $row2['question_name']; ?></td>
                       <td><?php echo $row2['difficulty']; ?></td>
                       <td>
                        <?php
                        if(isset($_SESSION['stu_name'])){
                         ?> 
                         <a href="contest.php?qid=<?php echo $row2['id'];?>&examid=<?php echo $examId ?>">Solve</a>
                         <?php 
                         }
                         else{
                          ?>
                          <a href="login_signup.php?destination=contest_details.php?cid=<?php echo $contest_id; ?>" onclick="return alert('Login to continue')">solve</a>
                          <?php } ?>
                      </td>
                       <td>
                        <?php
                        if(isset($_SESSION['stu_name'])){
                        $sql3="SELECT * FROM exam_question_status WHERE exam_id='$examId' AND question_id='$row2[id]' AND student_id='$student_id'";
                        $res3=$con->query($sql3);
                        $row3=$res3->fetch_assoc();

                        if($res3->num_rows>0)
                        {
                          if($row3['status']=='Incorrect')
                          {
                            echo "Incorrect <i class='bi bi-emoji-frown-fill'></i>";
                          }
                          else if($row3['status']=='Correct')
                          {
                            echo "Correct <i class='bi bi-emoji-laughing-fill'></i>";
                          }
                          else{
                            echo $row3['status'];
                          }
                        }
                        else
                        {
                          echo "----";
                        }
                        }
                        else{ echo"---";}
                        ?>
                       </td>
                    </tr>
                    <?php  }}elseif($current_time>=$end_time){ ?>
                      <h5></h5>
                      <tr>
                        <td>Exam Ended</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                      </tr>
                      <?php }else{ ?>
                        <h5 id="countdownIdtable"></h5>
                        <?php } ?>
                 </tbody>
            </table>
          </div>
          
          <div class="col-lg-5">

            <div class="details-box">
              <h4><span class="text-danger" id="countdown"></span> </h4>
              <h3><?php echo $_SESSION['exam_name']; ?></h3>
              <h4>Date : <?php  echo $exam_date; ?></h4>
              <h4>Start Time : <?php  echo $start_time; ?></h4>
              <h5>Duration: <?php echo $duration;  ?>mins</h5>
              <div class="list-rules">
                <h5><u>Contest Rules</u></h5>
                <p>Read the below instructions before you proceed to code</p>
                <p><i class="bi bi-1-circle me-3"></i><span><b>Code Submission Guidelines: </b></span>Ensure that your code is properly formatted and follows the problem's constraints and input/output format. Submissions with syntax errors or incorrect formats will not be considered.</p>
                <p><i class="bi bi-2-circle me-3"></i><span><b>Test Cases: </b></span>Thoroughly test your code with the provided test cases. Your code must pass all hidden test cases to be considered correct. Once submitted you cannot access your code anymore. </p>
                <p><i class="bi bi-3-circle me-3"></i><span><b>Plagiarism Policy: </b></span>Any form of code plagiarism, including copying from online sources or other participants, will result in immediate disqualification from the contest.</p>
              </div>
              <div class="list-rules">
                <h6><u><b>General Rules</b></u></h6>
                <p>Read the below instructions before you proceed to code</p>
                <p><i class="bi bi-1-circle me-3"></i>Logging out during an ongoing contest may reset all the progress done</p>
                <p><i class="bi bi-2-circle me-3"></i>After time limit of the contest exceeds, you will be redirected to the home page</p>
              </div>
              <?php
            if($current_time>=$start_time && $current_time < $end_time)
            {
              $up="UPDATE exam_status es JOIN exam e ON es.exam_id = e.id SET es.status = 'Live' WHERE e.id = '$examId'";
              $con->query($up);
              // $up1a="UPDATE exam SET status = 'Live' WHERE id = '$examId'";
              // $con->query($up1a);
              
            ?>
            <p class="btn btn-dark"><i class="bi bi-circle-fill" style="color: #ff0000;"></i> Contest Live</p>
            <?php }elseif($current_time>=$end_time)
            {
              $up1="UPDATE exam_status es JOIN exam e ON es.exam_id = e.id SET es.status = 'ended' WHERE e.id = '$examId'";
              $con->query($up1);
              // $up1b="UPDATE exam SET status = 'ended' WHERE id = '$examId'";
              // $con->query($up1b);
              
            ?>
              <p class="btn btn-dark"><i class="bi bi-circle-fill" style="color: rgb(15, 165, 15);"></i> Contest Over</p>
              <p><a href="leaderboard.php?eid=<?php echo $contest_id; ?>" class="btn btn-success">Leaderboard</a></p>
              <?php }
              else
              { 
                ?>
                    <a href="" class="btn btn-warning"><i class="bi bi-bell-fill me-2"></i>Set Reminder</a>
                <?php } ?>
            </div>
          </div>

        </div>

      </div>

    </section>

  <?php  include("inc/footer.php") ?>


  <!-- Vendor JS Files -->
  <script src="wrapper/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="wrapper/vendor/aos/aos.js"></script>
  <script src="wrapper/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="wrapper/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Main JS File -->
  <script src="wrapper/js/main.js"></script>
  <script src="wrapper/js/jquery.js"></script>
  <script src="wrapper/js/mode.js"></script>

  <script>
    $(document).ready(function () {        
            const startDateTime = new Date("<?php echo $start_time; ?>").getTime();
            const endDateTime = new Date("<?php echo $end_time; ?>").getTime();
            const countdownId = $('#countdown');
            console.log(startDateTime);
            console.log(endDateTime);
            let liveUpdated = false;
            let endUpdated = false; 

            const countdownFunction = setInterval(function () {
                const now = new Date().getTime();
                const timeUntilStart = startDateTime - now;
                const timeUntilEnd = endDateTime - now;

                if (timeUntilStart > 0) 
                {
                    const days = Math.floor(timeUntilStart / (1000 * 60 * 60 * 24));
                    const hours = Math.floor((timeUntilStart % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    const minutes = Math.floor((timeUntilStart % (1000 * 60 * 60)) / (1000 * 60));
                    const seconds = Math.floor((timeUntilStart % (1000 * 60)) / 1000);

                    $(countdownId).html("<span style='color:green;'>Contest Starts In - "+ days + "d " + hours + "h " + minutes + "m " + seconds + "s </span>");
                    $("#countdownIdtable").html("<span style='color:red;'>Contest Questions will be displayed after - "+ days + "d " + hours + "h " + minutes + "m " + seconds + "s </span>");
                }
                else if (timeUntilStart <= 0 && timeUntilEnd > 0) 
                {
                    // Contest is live
                    const days = Math.floor(timeUntilEnd / (1000 * 60 * 60 * 24));
                    const hours = Math.floor((timeUntilEnd % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    const minutes = Math.floor((timeUntilEnd % (1000 * 60 * 60)) / (1000 * 60));
                    const seconds = Math.floor((timeUntilEnd % (1000 * 60)) / 1000);

                    if(liveUpdated==false){
                      $.ajax({
                        url:'update_exam_status.php',
                        method:"POST",
                        data:{
                          exam_id:<?php echo $examId;  ?>,
                          status:"Live"
                        },
                        success:function (response) {
                            if (response == 'success') {
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

                    $(countdownId).html("<span style='color:red;'>Contest Ends In "+ days + "d " + hours + "h " + minutes + "m " + seconds + "s - Contest Live</span>");
                }
                else if (timeUntilEnd <= 0){
                    // Contest has ended
                    if(!endUpdated)
                    {
                      $.ajax({
                        url:'update_exam_status.php',
                        method:"POST",
                        data:{
                          exam_id:<?php echo $examId;  ?>,
                          status:"ended"
                        },
                        success: function (response) 
                        {
                            if (response == 'success') 
                            {
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
                    clearInterval(countdownFunction);
                    $(countdownId).html("<span style='color:red;'>Contest Ended</span>"); 
                }
            }, 1000); // Update the countdown every second
    });
  </script>


</body>

</html>