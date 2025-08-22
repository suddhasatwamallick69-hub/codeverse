<?php
session_start();
include("db.php");
    extract($_POST);
    $sel="SELECT * FROM teacher WHERE email='$email'";
    $res=$con->query($sel);
    if($res->num_rows==0)
    {
        $ins="INSERT INTO teacher SET name='$name',email='$email',username='$username',password='$password'";
        $con->query($ins);
        $sel="SELECT * FROM teacher WHERE(username='$username' OR email='$email') AND password='$password'";
        $rs=$con->query($sel);
        if($rs->num_rows>0)
        {
            while($row=$rs->fetch_assoc())
            {
                $_SESSION['uid']=$row['id'];
                $_SESSION['name']=$row['name'];
                $_SESSION['username']=$row['username'];
                $_SESSION['email']=$row['email'];
                $_SESSION['password']=$row['password'];
                header("location:dashboard.php");
            }
        }
        else
        {
            echo "Some error occured";
        }
    }
    else
    {
        echo "username already exists";

    }



?>