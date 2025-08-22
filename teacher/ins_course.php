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
$buf=$_FILES['pimg']['tmp_name'];
$fn=time().$_FILES['pimg']['name'];

$arr_fn=explode(".",$fn);
$arr_count=count($arr_fn);
if($arr_fn[$arr_count-1]=='jpg' || $arr_fn[$arr_count-1]=='jpeg' || $arr_fn[$arr_count-1]=='png'){
    move_uploaded_file($buf,"uploads/".$fn);
    $sql="INSERT INTO course SET name='$name',description='$description',teacher_name='$teacher_name',teacher_id='$teacher_id',image='$fn'";
    $con->query($sql);
    echo "<script>alert('Course Added')
    window.location.href='add_course.php';
    </script>";
}
else{
    echo "<script>alert('File type not supported')</script>";
}

?>