<?php
session_start();
include("db.php");
$teacher_id=$_SESSION['uid'];
$teacher_name=$_SESSION['name'];
if(isset($_GET['option']))
{
    $option=$_GET['option'];
    $sql="SELECT * FROM practical_questions WHERE teacher_id='$teacher_id' AND  (difficulty LIKE '%$option%' OR problem_statement LIKE '%$option%')";
    $rs=$con->query($sql);
    if($rs->num_rows>0)
    {
            while($row=$rs->fetch_assoc())
            {
                echo "<tr>";
                echo "<td>" . $row['problem_statement'] . "</td>";
                echo "<td>" . $row['input_format'] . "</td>";
                echo "<td>" . $row['input'] . "</td>";
                echo "<td>" . $row['output'] . "</td>";
                echo "<td>" . $row['explanation'] . "</td>";
            }
    }
}
elseif($_GET['option_none']=='')
{
    $sql="SELECT * FROM practical_questions WHERE teacher_id='$teacher_id'";
    $rs=$con->query($sql);
    while($row=$rs->fetch_assoc())
    {
        echo "<tr>";
        echo "<td>" . $row['problem_statement'] . "</td>";
        echo "<td>" . $row['input_format'] . "</td>";
        echo "<td>" . $row['input'] . "</td>";
        echo "<td>" . $row['output'] . "</td>";
        echo "<td>" . $row['explanation'] . "</td>";
    }
}


?>