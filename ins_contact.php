<?php
session_start();
include("db.php");
extract($_POST);

$ins="INSERT INTO contacts SET name='$name',ph_no='$ph_no',email='$email',message='$message'";
$res=$con->query($ins);
if($res)
{
    $_SESSION['message_sent']='Message Sent!!!';
}
else
{
    $_SESSION['message_sent_error']='Some error occurred!!!';
}

header("location:contactus.php");

?>