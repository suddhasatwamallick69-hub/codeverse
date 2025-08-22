<?php
session_start();
include("db.php");
$teacher_id=$_SESSION['uid'];
$teacher_name=$_SESSION['name'];
$option=$_GET['option'];
$sql="SELECT * FROM course WHERE teacher_id='$teacher_id' AND name LIKE '%$option%'";
$rs=$con->query($sql);
if($rs->num_rows>0){
            while($row=$rs->fetch_assoc()){
                echo "<tr>";
                echo "<td>{$row['name']}</td>";
                echo "<td>{$row['description']}</td>";
                echo "<td><a href='add_resources.php?addid={$row['id']}' ><i class='fa fa-cloud-upload'></i></a></td>";
                echo "</tr>";
            }
}
?>