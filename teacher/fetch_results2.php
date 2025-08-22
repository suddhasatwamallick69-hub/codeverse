<?php
session_start();
include("db.php");
$teacher_id = $_SESSION['uid'];
$teacher_name = $_SESSION['name'];
$option = $_GET['option'];
$sql = "SELECT * FROM resource WHERE teacher_id='$teacher_id' AND course_name LIKE '%$option%'";
$rs = $con->query($sql);
if ($rs->num_rows > 0) {
    $count=0;
    while ($row = $rs->fetch_assoc()) {
        $count++;
        echo "<tr>";
        echo "<td>{$count}</td>";
        echo "<td>{$row['name']}</td>";
        echo "<td>{$row['course_name']}</td>";
        echo "<td> <video width='250' height='150' controls>
                    <source src='video_uploads/{$row['video']}' type='video/mp4'>
                    </video> </td>";
        // echo "<td>{$row['description']}</td>";
        echo "<td>{$row['upload_time']}</td>";
        echo "<td><a href='update_video.php?uid={$row['id']}'><i class='fa fa-pencil-square-o'></i></a></td>";
        echo "<td><a onclick=\"return confirm('Are you sure?')\" href='del_video.php?did={$row['id']}'><i class='fa fa-trash-o'></i></a></td>";
        echo "</tr>";
    }
}
?>