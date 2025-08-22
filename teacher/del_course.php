<?php
session_start();
if(!isset($_SESSION['uid']) && $_SESSION['uid']==''){
    header("location:login.php");
  }
include("db.php");
$did=$_GET['did'];
echo $did;



$sel="SELECT * FROM course WHERE id='$did'";
$rs=$con->query($sel);
$row=$rs->fetch_assoc();
unlink("uploads/".$row['image']);

$sel="SELECT * FROM resource WHERE course_id='$did'";
$rs=$con->query($sel);
while($row=$rs->fetch_assoc()){
unlink("video_uploads/".$row['video']);
}
$del="DELETE FROM resource WHERE course_id='$did'";
$con->query($del);

$del2="DELETE FROM course_questions WHERE course_id='$did'";
$con->query($del2);

$del="DELETE FROM course WHERE id='$did'";
$con->query($del);
echo"<script>alert('Course and Related Resources Deleted Successsfully');
window.location.href='add_course.php';</script>";


?>