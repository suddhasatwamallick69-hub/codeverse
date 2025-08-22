<?php
include("db.php");
session_start();
if(!isset($_SESSION['uid']) && $_SESSION['uid']==''){
    header("location:login.php");
  }

$did=$_GET['did'];
echo $did;

$sel="SELECT * FROM resource WHERE id='$did'";
$rs=$con->query($sel);
$row=$rs->fetch_assoc();
unlink("video_uploads/".$row['video']);

$del="DELETE FROM resource WHERE id='$did'";
$con->query($del);
echo"<script>alert('Video Deleted Successsfully');
window.location.href='list_videos.php';</script>";


?>