<?php
session_start();
include("db.php");

extract($_POST);

$start_time = new DateTime($stime);
$end_time = new DateTime($etime);

$interval = $start_time->diff($end_time);

$duration = ($interval->h * 60) + $interval->i;
echo $duration;

if ($end_time < $start_time) {
    die("End time must be after start time.");
}

$sql = "SELECT * FROM exam WHERE exam_date = '$date' AND ((exam_start < '$etime' AND exam_end > '$stime'))";
$res=$con->query($sql);
$row=$res->fetch_assoc();

if($res->num_rows>0){
?>
<script>
    alert('A contest is already set on - <?php echo $row['exam_date']?> between <?php echo $row['exam_start'] ?> and <?php echo $row['exam_end']; ?> . You cannot set another exam in between these times. Choose another day or time.')
    window.location.href='set_exam.php';
    </script>
<?php }
else
{
    $ins = "INSERT INTO exam (exam_name, exam_date, duration, total_questions, exam_start, exam_end, teacher_name, teacher_id) VALUES ('$name', '$date', '$duration', '$tquestions', '$stime', '$etime','Not Assigned', 'Not Assigned')";
$con->query($ins);
$exam_id = $con->insert_id;

$ins2 = "INSERT INTO exam_status (status, exam_id, exam_name) VALUES ('upcoming', '$exam_id', '$name')";
$con->query($ins2);

header("location: assign_task.php");
} 
?>
