<?php
session_start();
if(!isset($_SESSION['uid']) && $_SESSION['uid']==''){
    header("location:login.php");
  }
include("db.php");
$teacher_id=$_SESSION['uid'];
$teacher_name=$_SESSION['name'];

extract($_POST);
$description=$con->real_escape_string($_POST['description']); 
$buf=$_FILES['video']['tmp_name'];
$fn=time().$_FILES['video']['name'];

$arr_fn=explode(".",$fn);
$arr_count=count($arr_fn);
if($arr_fn[$arr_count-1]=='mp4' ){
    move_uploaded_file($buf,"video_uploads/".$fn);
    date_default_timezone_set('Asia/Kolkata');
    $currenttime=(date("Y/m/d h:i:s a"));
    $sql="INSERT INTO resource SET name='$name',description='$description',video='$fn',upload_time='$currenttime',course_id='$cid',course_name='$cname',teacher_id='$teacher_id',teacher_name='$teacher_name'";
    $con->query($sql);
    echo "<script>alert('Video Uploaded');
    window.location.href='list_videos.php';
    </script>";
}
else{
    echo "<script>alert('File type not supported')</script>";
}


?>