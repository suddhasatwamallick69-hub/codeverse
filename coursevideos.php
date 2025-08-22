<?php
include("db.php");
session_start();

if(!isset($_SESSION['stu_name']) && $_SESSION['stu_name']=='')
{
    header("location:index.php");
    exit;
}else{
  $student_id=$_SESSION['sid'];
  $student_name=$_SESSION['stu_name'];
}

$cvid=$_GET['cvid'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title><?php if(isset($_SESSION['stu_user_name'])){?>Dashboard<?php }else{ ?>CODEVERSE<?php } ?></title>
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
  <link id="theme-stylesheet" href="wrapper/css/main.css" rel="stylesheet">


  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<body class="starter-page-page">
<?php  include("inc/header.php")  ?>
    <section class="section">
    <div class="container-fluid">
        <!-- <a href="startcourse.php?scid=<?php echo $cvid; ?>" class="btn btn-primary mb-2">Back</a> -->
        <div class="row g-4">
            <!-- Main Video -->
            <div class="col-md-8">
                <?php
                if(isset($_GET['vid'])&& isset($_GET['cvid'])){
                    $vid=$_GET['vid'];
                    $sql1="SELECT * FROM resource WHERE id='$vid' AND course_id='$cvid'";
                    $res1=$con->query($sql1);
                    $row1=$res1->fetch_assoc();
                    $cname=$row1['course_name'];
                ?>
                <div id="main-video-thumbnail">
                    <video id="main-video" controls>
                        <source src="teacher/video_uploads/<?php echo $row1['video'] ?>" type="video/mp4">
                    </video>
                </div>
                         <div class="video-details">
                                <h3 class="" id="main-video-title"><?php echo $row1['name'] ?></h3>
                                <h6 class="" id="main-video-title"><?php echo $row1['description'] ?></h6>
                         </div> 
                 <?php }else {  
                    $sql2="SELECT * FROM resource WHERE  course_id='$cvid'";
                    $res2=$con->query($sql2);
                    if($res2->num_rows>0){
                    $row2=$res2->fetch_assoc();
                    $cname=$row2['course_name'];
                    ?>
                    <div id="main-video-thumbnail">
                         <video id="main-video" controls>
                              <source src="teacher/video_uploads/<?php echo $row2['video'] ?>" type="video/mp4">
                         </video>
                   </div>
                         <div class="video-details">
                                <h3 class="" id="main-video-title"><?php echo $row2['name'] ?></h3>
                                <h6 class="" id="main-video-title"><?php echo $row2['description'] ?></h6>
                         </div> 
                    <?php }else{echo"No Videos uploaded yet";}} ?>
            </div>
            <!-- Sidebar -->
            <div class="col-md-4 sidebar">
                <h3><?php if(isset($cname)){echo $cname;} ?> - Playlist</h3>
                <?php
                $sql="SELECT * FROM resource WHERE course_id='$cvid'";
                $res=$con->query($sql);
                $count=0;
                while($row=$res->fetch_assoc())
                {
                    $count++;
                ?>
                <!-- Video List -->
                    <div class="container-fluid">
                    <div class="row" style="<?php if(isset($vid) && $vid==$row['id']){?> background-color:#17223d;color:white;<?php } ?>">
                    <div class="col-md-7">
                       <a href="coursevideos.php?cvid=<?php echo $cvid; ?>&vid=<?php echo $row['id']; ?>"><video src="teacher/video_uploads/<?php echo $row['video'] ?>" muted></video></a>
                    </div>
                    <div class="col-md-5">
                         <p class="video-title p-2"><?php echo $count; ?>. <?php echo $row['name'] ?></p>
                    </div>
                    <div class="col-md-12">
                        
                    </div>
                    </div>
                    </div>
                <?php } ?>
                
            </div>
        </div>
    </div>
    </section>

    <script src="wrapper/js/jquery.js"></script>
    <script src="wrapper/js/mode.js"></script>
    <script src="wrapper/js/main.js"></script>
</body>
</html>