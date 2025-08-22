<?php
include("db.php");
session_start();
if(!isset($_SESSION['uid']) && $_SESSION['uid']==''){
    header("location:login.php");
  }

$did=$_GET['did'];
echo $did;



$del="DELETE FROM practical_questions WHERE id='$did'";
$con->query($del);
echo"<script>alert('Question Deleted Successsfully');
window.location.href='list_practical_questions.php';</script>";


?>