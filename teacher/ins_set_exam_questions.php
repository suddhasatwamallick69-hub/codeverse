<?php
session_start();
if(!isset($_SESSION['uid']) && $_SESSION['uid']==''){
  header("location:index.php");
}
$teacher_id=$_SESSION['uid'];
$teacher_name=$_SESSION['name'];
include("db.php");
extract($_POST);
// print_r($_POST);
$description=$con->real_escape_string($_POST['description']);

$sql = "SELECT * FROM exam WHERE teacher_id = '$teacher_id' AND id='$examid'";
$res = $con->query($sql);
$row = $res->fetch_assoc();
$total_questions = $row['total_questions'];
$exam_name=$row['exam_name'];

echo $total_questions;
echo "<br>";

$sql1 = "SELECT COUNT(*) AS submitted_questions FROM exam_questions WHERE teacher_id = '$teacher_id' AND exam_id = '$examid'";
$res1 = $con->query($sql1);
$row1 = $res1->fetch_assoc();
$submitted_questions = $row1['submitted_questions'];

echo $submitted_questions;
echo "<br>";

// Calculate remaining questions
$remaining_questions = $total_questions - $submitted_questions;
echo $remaining_questions;

$hidden_inputs = $_POST['hidden_inputs'];
$hidden_outputs = $_POST['hidden_outputs'];

// echo "<br>";


// echo "<pre>";
// print_r($hidden_inputs);
// echo "</pre>";

// echo "<br>";

// echo "<pre>";
// print_r($hidden_outputs);   
// echo "</pre>";

if(isset($_POST['submit'])&& $remaining_questions > 0)
{
    $ins="INSERT INTO exam_questions SET question_name='$question',difficulty='$difficulty',input_format='$input_format',	description='$description',output_format='$output',exam_name='$exam_name',exam_id='$examid',teacher_name='$teacher_name',teacher_id='$teacher_id'";
    $con->query($ins);
    $question_id = $con->insert_id;
     $submitted_questions += 1;
     $remaining_questions = $total_questions - $submitted_questions;


     foreach ($hidden_inputs as $index => $input) {
        $output = $hidden_outputs[$index];
        $sql = "INSERT INTO test_cases SET question_id='$question_id', input='$input', expected_output='$output',expected_keywords='$expected_keywords',exam_id='$examid'";
        $con->query($sql);
    }
     if($remaining_questions==0)
     {
        echo "all questions submitted";
     }
     header("Location: set_exam_questions.php?examid=" . $examid);
}
else
{ 
    echo "<script> alert('You have submitted all questions') </script>"; 
} 
?>