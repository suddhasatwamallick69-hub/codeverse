<?php
session_start();
include("db.php");
    extract($_POST);
    $sel="SELECT * FROM teacher WHERE(username='$username' OR email='$username') AND password='$password'";
    $rs=$con->query($sel);
    if($rs->num_rows>0)
    {
        while($row=$rs->fetch_assoc())
        {
            $_SESSION['uid']=$row['id'];
            $_SESSION['name']=$row['name'];
            $_SESSION['email']=$row['email'];
            $_SESSION['username']=$row['username']; 
            header("location:dashboard.php");
        }
    }
    else
    {
        echo "username not found";
        $sel="SELECT * FROM teacher WHERE(username='$username' or email='$username')";
        $res = $con->query($sel);
        if($res->num_rows==0)
        {
            $_SESSION['wrong_credentials']='Invalid email or Username !!!';
            header("location:index.php");
            exit;
        }
        $sel="SELECT * FROM teacher WHERE password='$password'";
        $res = $con->query($sel);
        $row = $res->fetch_assoc();
        if($res->num_rows==0)
        {
            $_SESSION['wrong_password']='Invalid Password !!!';
            header("location:index.php");
            exit;
        }
    }
?>