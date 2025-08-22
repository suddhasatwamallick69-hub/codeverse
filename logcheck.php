<?php 
session_start();
include("db.php");
extract($_POST);
$index='index.php';
if(isset($_POST['destination']))
{
    $destination=$_POST['destination'];
}
$sel="SELECT * FROM students WHERE(username='$name' or email='$name') AND password='$pass'";
$res = $con->query($sel);
if($res->num_rows>0)
{
        $row = $res->fetch_assoc();
        $_SESSION['sid']=$row['id'];
        $_SESSION['stu_user_name']=$row['username'];
        $_SESSION['stu_name']=$row['name'];
        $_SESSION['semail']=$row['email'];
        $_SESSION['spassword']=$row['password'];
        // echo "<script>window.location.href = '$destination';</script>";
        header("location:$destination");
}
else
{
    $sel="SELECT * FROM students WHERE(username='$name' or email='$name')";
    $res = $con->query($sel);
    if($res->num_rows==0)
    {
        $_SESSION['wrong_credentials']='Invalid email or Username!!!';
        header("location:login_signup.php");
        exit;
    }
    $sel="SELECT * FROM students WHERE password='$pass'";
    $res = $con->query($sel);
    $row = $res->fetch_assoc();
    if($res->num_rows==0)
    {
        $_SESSION['wrong_password']='Invalid Password!!!';
        header("location:login_signup.php");
        exit;
    }
}
?>