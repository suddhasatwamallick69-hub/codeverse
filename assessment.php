<?php
session_start();
include("db.php");
$ast=$_GET['ast'];

if(!isset($_SESSION['stu_name']) && $_SESSION['stu_name']=='')
{
    header("location:index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>CODEVERSE Assessment</title>
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

<?php  include("inc/header_Login.php")  ?>
    <!-- Starter Section Section -->
    <?php
     $sql="SELECT * FROM course WHERE id='$ast'";
     $res=$con->query($sql);
     $row=$res->fetch_assoc();
     $cname=$row['name'];  
     $cid=$row['id'];
     $sel="SELECT * FROM course_questions WHERE course_id='$cid'";
     $rs=$con->query($sel);
     $question_count = $rs->num_rows;  
     ?>
     <div class="page-title" id="starter-section">
       <div class="container d-lg-flex justify-content-between align-items-center">
         <h1 class="mb-2 mb-lg-0">Course: <?php echo $cname; ?> | Total Questions: <?php echo $question_count; ?></h1>
         <nav class="breadcrumbs">
          <ol>
            <li class="current">MCQ Questions</li>
          </ol>
         </nav>
       </div>
     </div>
    <section id="starter-section" class="section">
      <!-- Section Title -->
      <div class="container mt-5">
        <div class="row">
            <div class="col-md-12 d-flex justify-content-center align-items-center">
                <h3><u>Test your skills with CODEVERSE Assessment</u></h3>
            </div>
        </div>
      </div><!-- End Section Title -->
      
      <div class="container  mt-4">
      <form id="myForm">
          <?php
          $sel="SELECT * FROM course_questions WHERE course_id='$cid' ORDER BY RAND() LIMIT 10";
          $rs=$con->query($sel);
          $no_of_question=$rs->num_rows;
          $current_question=1;
          $qno=1;
          while($row2=$rs->fetch_assoc()){
          ?>
        <div class="question" style="<?php if($current_question==1){ ?>display:block;<?php }else{ ?> display:none;<?php } ?>">
           <h3>Question <?php echo $qno; ?>:<h3><br>
           <h5><?php echo $row2['name']; ?></h5>
            <p><input type="radio" id="options" name="<?php  echo $row2['question_no'];?>" value="<?php  echo $row2['op1'];?>">     <?php  echo $row2['op1'];?></p>
            <p><input type="radio" id="options" name="<?php  echo $row2['question_no'];?>" value="<?php  echo $row2['op2'];?>">     <?php  echo $row2['op2'];?></p>
            <p><input type="radio" id="options" name="<?php  echo $row2['question_no'];?>" value="<?php  echo $row2['op3'];?>">     <?php  echo $row2['op3'];?></p>
            <p><input type="radio" id="options" name="<?php  echo $row2['question_no'];?>" value="<?php  echo $row2['op4'];?>">     <?php  echo $row2['op4'];?></p>
        </div>
        <?php
        $current_question++;
        $qno++;
        }  
        ?>
        <div class="row">
          <div class="col-md-6">
               <button type="button" id="prev-btn" class="btn btn-success">Previous</button>
          </div>
          <div class="col-md-6 d-flex justify-content-center">
               <button type="button" id="next-btn" class="btn btn-primary">Next</button>
               <button type="submit" id="submit-btn" onclick="return confirm('Are you Sure that you want to submit?')" class="btn btn-danger" style="display:none;">Submit</button>
          </div>
        </div>
          <input type="hidden" name="cid" value="<?php echo $cid; ?>">
        </form>
      </div>
      

    </section><!-- /Starter Section Section -->


  <!-- Vendor JS Files -->
  <script src="wrapper/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="wrapper/vendor/php-email-form/validate.js"></script>
  <script src="wrapper/vendor/aos/aos.js"></script>
  <script src="wrapper/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="wrapper/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Main JS File -->
  <script src="wrapper/js/main.js"></script>
  <script src="wrapper/js/jquery.js"></script>
  <script src="wrapper/js/check_ans.js"></script>
  <script src="wrapper/js/mode.js"></script>
  

  <script>
//     window.addEventListener('beforeunload', function (event) {
//     event.preventDefault(); // This is required for most browsers
//     event.returnValue = ''; // For older browsers
// });

    $(document).ready(function(){
      var questions=$('.question');
      var currentIndex=0;

      function updateButtons() {
        $('#prev-btn').toggle(currentIndex > 0);
        console.log(currentIndex);
        console.log(questions.length);
        $('#next-btn').toggle(currentIndex < questions.length - 1);
        console.log(questions.length);
        console.log(currentIndex);
        $('#submit-btn').toggle(currentIndex == questions.length - 1);
      }
      updateButtons();

      $('#next-btn').click(function() {
        if (currentIndex < questions.length - 1) {
          questions.eq(currentIndex).hide();
          console.log(currentIndex);
          currentIndex++;
          questions.eq(currentIndex).show();
          console.log(currentIndex);
          updateButtons();
        }
      });

      $('#prev-btn').click(function() {
        if (currentIndex > 0) {
          questions.eq(currentIndex).hide();
          currentIndex--;
          questions.eq(currentIndex).show();
          console.log(currentIndex);
          updateButtons();
        }
      });
    });


  </script>
</body>

</html>