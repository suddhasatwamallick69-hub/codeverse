<?php 

session_start();


include("db.php");
extract($_POST);

$sel="SELECT * FROM admin WHERE(name='$ename' or email='$ename') AND pass='$passw'";
$res = $con->query($sel);
if($res->num_rows>0){
    while($row = $res->fetch_assoc()){
        $_SESSION['aid']=$row['id'];
        $_SESSION['adminname']=$row['name'];
        $_SESSION['upassword']=$row['pass'];
    }

    header("location:dashboard.php");
}
else{
    header("location:index.php");
}
?>

<!-- log check -->