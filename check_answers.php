<?php
session_start();
include("db.php");
extract($_POST);


if(!isset($_SESSION['stu_name']) && $_SESSION['stu_name']=='')
{
    header("location:index.php");
    exit;
}
// print_r($_POST);
// echo"<br>";
$correct_answers=array();
$sql="SELECT * FROM course_questions WHERE course_id='$cid'";
$res=$con->query($sql);
$all_questions=$res->num_rows;
while($row=$res->fetch_assoc()){
    $correct_answers[$row['question_no']]=$row['answer'];
}
// print_r($correct_answers);

$right_count=0;

foreach($_POST as $qid=>$ans){
    if($qid=='cid')continue;

    if(isset($correct_answers[$qid])){
        $right_ans=$correct_answers[$qid];
        if($right_ans==$ans){
            $right_count++;
        }
        else{

        }

    }
    else{
        echo"No answer fetched for question $qid";
    }
}
$total_questions_attempted=count($_POST)-1;
echo "Total Questions: $all_questions"."<br>";
echo "Questions Attempted: $total_questions_attempted"."<br>";
echo "Correct Answers: $right_count"."<br>";
if($all_questions==$right_count){
    echo"Congratulations!! You got $right_count questions correct out of $all_questions. You got all right!!  :)";
}
elseif($right_count==0){
    echo "You didn't get a single question right!!";
}


?>