<?php
include("db.php");
$exam_id = $_POST['exam_id'];
$new_status = $_POST['status'];

$sql= "SELECT * FROM exam_status WHERE exam_id = '$exam_id'";
$result = $con->query($sql);
$row = $result->fetch_assoc();
$status = $row['status'];

    if ($status !== $new_status) {
        // $up= "UPDATE exam SET status = '$new_status' WHERE id = '$exam_id'";
        // $con->query($up);

        $up1 = "UPDATE exam_status SET status = '$new_status' WHERE exam_id = '$exam_id'";
        $con->query($up1);
        echo 'success';
    } 
    else 
    {
        echo 'already_updated';
    }
?>
