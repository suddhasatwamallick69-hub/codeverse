<?php
session_start();
include("db.php");
$qcid=$_SESSION['qcid'];
$option=$_GET['option'];
$sql="SELECT * FROM course_questions WHERE course_id='$qcid' AND (name LIKE '%$option%')";
$rs=$con->query($sql);
if($rs->num_rows>0){
            while($row=$rs->fetch_assoc())
            {
                echo "<tr>";
        echo "<td>" . $row['course_name'] . "</td>";
        echo "<td>" . $row['question_no'] . "</td>";
        echo "<td>" . $row['name'] . "</td>";

        // Output options with conditional formatting
        echo "<td>";
        echo $row['op1'] == $row['answer'] ? "<span style='color:blue;font-weight:700'>" . ($row['op1']) . "</span>" : ($row['op1']);
        echo "</td>";

        echo "<td>";
        echo $row['op2'] == $row['answer'] ? "<span style='color:blue;font-weight:700'>" . ($row['op2']) . "</span>" : ($row['op2']);
        echo "</td>";

        echo "<td>";
        echo $row['op3'] == $row['answer'] ? "<span style='color:blue;font-weight:700'>" . ($row['op3']) . "</span>" : ($row['op3']);
        echo "</td>";

        echo "<td>";
        echo $row['op4'] == $row['answer'] ? "<span style='color:blue;font-weight:700'>" . ($row['op4']) . "</span>" : ($row['op4']);
        echo "</td>";

        echo "<td>";
        echo "<span style='color:blue;font-weight:700'>" . ($row['answer']) . "</span>";
        echo "</td>";

        echo "<td><a href='update_q.php?uid=" . ($row['id']) . "'><i class='fa fa-pencil-square-o'></i></a></td>";
        echo "<td><a onclick=\"return confirm('Are you sure?')\" href='del_q.php?did=" . ($row['id']) . "'><i class='fa fa-trash-o'></i></a></td>";
        echo "</tr>";
            }
}
?>