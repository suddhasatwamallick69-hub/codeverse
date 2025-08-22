<?php
session_start();
include("db.php");

if(!isset($_SESSION['stu_name']) && $_SESSION['stu_name']=='')
{
    header("location:index.php");
    exit;
}else{
  $student_id=$_SESSION['sid'];
  $student_name=$_SESSION['stu_name'];
}


$code = $_POST['code'];
$lang=$_POST['language'];
$question_id = $_POST['question_id'];
$exam_id=$_POST['exam_id'];






$res = $con->query("SELECT * FROM test_cases WHERE question_id = '$question_id' AND exam_id='$exam_id'");
$row=$res->fetch_assoc();
$expected_keywords=explode(',',$row['expected_keywords']);


$found = false;
$test_results = [];

// Check if any element from the array exists in the code
foreach ($expected_keywords as $keyword) {
  if (strpos($code, $keyword) == true) {
      $found = true;
      break; // Stop checking after the first match
  }
}

// Output based on whether a keyword was found or not
if ($found)
{

$all_tests_passed = true;

while ($row = $res->fetch_assoc()) 
{
    $input = $row['input'];
    $expected_output = $row['expected_output'];
    $expected_output=explode(" ",$expected_output);
    $expected_output=implode("\n",$expected_output);
    
    if($lang == 'python3') {
        // Write code and input files
        file_put_contents('contest_code_files/main.py', $code);
        file_put_contents('contest_code_files/input.txt', $input);

        // Execute the Python code
        $command = 'python contest_code_files/main.py < contest_code_files/input.txt 2>&1';
        $output = [];
        $return_var = 0;
        exec($command, $output, $return_var);

        $output = implode("\n", $output);

        if($return_var !== 0 ){
          echo json_encode([
            'output' => $output,
            'errormsg'=>'Compilation Error',
            'isExecutionSuccess'=>false,
          ]);
          $up="UPDATE exam_question_status SET status='Incorrect' WHERE question_id='$question_id' AND exam_id='$exam_id' AND student_id='$student_id'";
          $con->query($up);
          exit;
        }

       
        
          if (preg_match("/\b$expected_output\b/", $output)) 
          {
            $test_results[] = [
              'input' => $input,
              'expected_output' => $expected_output,
              'output' => $output,
              'status' => 'Pass'
            ];     
                
          }
           else 
           {
            $test_results[] = [
              'input' => $input,
              'expected_output' => $expected_output,
              'output' => $output,
              'status' => 'Fail'
             ];
             $all_tests_passed = false;
            
             
           }
        
    } 
    elseif ($lang == 'c') 
    {
        // Write code and input files
        file_put_contents("contest_code_files/main.c", $code);
        file_put_contents("contest_code_files/input.txt", $input);

        // Compile the C code
        $compile_command = "gcc -o \"contest_code_files/program.exe\" \"contest_code_files/main.c\" 2>&1";
        exec($compile_command, $compile_output, $compile_return_var);

        if ($compile_return_var !== 0) {
          $output=implode("\n", $compile_output);
            echo json_encode([
              'output' => $output,
              'errormsg'=>'Compilation Error!!!',
              'isExecutionSuccess'=>false,
            ]);
            $up="UPDATE exam_question_status SET status='Incorrect' WHERE question_id='$question_id' AND exam_id='$exam_id' AND student_id='$student_id'";
            $con->query($up);
            exit;
        }

        // Execute the compiled C program
        $execute_command = "\"contest_code_files/program.exe\" < \"contest_code_files/input.txt\" 2>&1";
        exec($execute_command, $execute_output, $execute_return_var);

        $output = implode("\n", $execute_output);

        if ($execute_return_var !== 0) 
        {
          echo json_encode([
              'output' => $output,
              'errormsg'=>'Runtime Error!!!',
              'isExecutionSuccess'=>false,
            ]);
            $up="UPDATE exam_question_status SET status='Incorrect' WHERE question_id='$question_id' AND exam_id='$exam_id' AND student_id='$student_id'";
            $con->query($up);
            exit;
        } 
        elseif(preg_match("/\b$expected_output\b/", $output)) 
          {
            $test_results[] = [
                'input' => $input,
                'expected_output' => $expected_output,
                'output' => $output,
                'status' => 'Pass'
            ];  
          }
          else
          {
            $test_results[] = [
              'input' => $input,
              'expected_output' => $expected_output,
              'output' => $output,
              'status' => 'Fail'
             ];
             $all_tests_passed = false;
          }
        unlink('contest_code_files/program.exe');
    }
    elseif($lang=='java')
    {
      // Write code and input files
      file_put_contents("contest_code_files/Main.java", $code);
      file_put_contents("contest_code_files/input.txt", $input);

      // Compile the java code
      $compile_command = "javac contest_code_files/Main.java 2>&1";
      exec($compile_command, $compile_output, $compile_return_var);

      if ($compile_return_var !== 0) {
        $output=implode("\n", $compile_output);
          echo json_encode([
            'output' => $output,
            'errormsg'=>'Compilation Error!!!',
            'isExecutionSuccess'=>false,
          ]);
          $up="UPDATE exam_question_status SET status='Incorrect' WHERE question_id='$question_id' AND exam_id='$exam_id' AND student_id='$student_id'";
          $con->query($up);
          exit;
      }

      // Execute the compiled java program
      $execute_command = "java -cp contest_code_files Main < contest_code_files/input.txt 2>&1";
      exec($execute_command, $execute_output, $execute_return_var);

      $output = implode("\n", $execute_output);

      if ($execute_return_var !== 0) 
      {
        echo json_encode([
            'output' => $output,
            'errormsg'=>'Runtime Error!!!',
            'isExecutionSuccess'=>false,
          ]);
          $up="UPDATE exam_question_status SET status='Incorrect' WHERE question_id='$question_id' AND exam_id='$exam_id' AND student_id='$student_id'";
          $con->query($up);
          exit;
      } 
      elseif(preg_match("/\b$expected_output\b/", $output)) 
        {
          $test_results[] = [
              'input' => $input,
              'expected_output' => $expected_output,
              'output' => $output,
              'status' => 'Pass'
          ];  
        }
        else
        {
          $test_results[] = [
            'input' => $input,
            'expected_output' => $expected_output,
            'output' => $output,
            'status' => 'Fail'
           ];
           $all_tests_passed = false;
        }
      // unlink('contest_code_files/Main.class');
    }
}





if ($all_tests_passed) {

  date_default_timezone_set('Asia/Kolkata');
  $time_submitted = date("Y-m-d H:i:s");
  $sql2="SELECT * FROM exam_question_status WHERE question_id='$question_id' AND exam_id='$exam_id' AND student_id='$student_id'";
  $res2=$con->query($sql2);
  $row2=$res2->fetch_assoc();
  $status=$row2['status'];
  $start_time=$row2['start_time'];
  $start_time_obj=new DateTime($start_time);
  $time_submitted_obj=new DateTime($time_submitted);
  $interval = $start_time_obj->diff($time_submitted_obj);
  $duration = ($interval->days * 24 * 60 * 60) + ($interval->h * 60 * 60) + ($interval->i * 60) + $interval->s;
 



  echo json_encode([
      'successmsg' => 'Successfully executed all test cases!',
      'isPassed' => true,
      'testResults' => $test_results,
  ]);
  if($status=='Correct')
  {
    $up="UPDATE exam_question_status SET status='Correct' WHERE question_id='$question_id' AND exam_id='$exam_id' AND student_id='$student_id'";
    $con->query($up);
  }
  else
  {
    $up="UPDATE exam_question_status SET status='Correct',time_submitted='$time_submitted',duration='$duration' WHERE question_id='$question_id' AND exam_id='$exam_id' AND student_id='$student_id'";
    $con->query($up);

    $sql4="SELECT * FROM correct_question_count WHERE  exam_id='$exam_id' AND student_id='$student_id'";
    $res4=$con->query($sql4);
    $row4=$res4->fetch_assoc();
    $count=$row4['correct_count'];
    // echo gettype($count);
    // echo $count;
    $new_count=intval($count)+1;
    $total_duration=$row4['total_duration'];
    // echo $total_duration;
    // echo gettype($total_duration);
    $new_total_duration=intval($total_duration)+intval($duration);
    // echo gettype($new_total_duration);
    $up1="UPDATE correct_question_count SET correct_count='$new_count',total_duration='$new_total_duration' WHERE student_id='$student_id' AND exam_id='$exam_id'";
    $con->query($up1);
  }

  
} else {

  date_default_timezone_set('Asia/Kolkata');
  $time_submitted = date("Y-m-d H:i:s");
  $sql2="SELECT * FROM exam_question_status WHERE question_id='$question_id' AND exam_id='$exam_id' AND student_id='$student_id'";
  $res2=$con->query($sql2);
  $row2=$res2->fetch_assoc();
  $start_time=$row2['start_time'];
  $start_time_obj=new DateTime($start_time);
  $time_submitted_obj=new DateTime($time_submitted);
  $interval = $start_time_obj->diff($time_submitted_obj);
  $duration = ($interval->days * 24 * 60 * 60) + ($interval->h * 60 * 60) + ($interval->i * 60) + $interval->s;


  echo json_encode([
      'error' => 'Test cases failed!',
      'isFailed' => true,
      'testResults' => $test_results
  ]);
  

  $up="UPDATE exam_question_status SET status='Incorrect',time_submitted='$time_submitted',duration='$duration' WHERE question_id='$question_id' AND exam_id='$exam_id' AND student_id='$student_id'";
  $con->query($up);
}

}
else
{
  echo json_encode([
    'InvalidCode' => 'Test cases failed!',
    'isMatched' => false,
]);
$up="UPDATE exam_question_status SET status='Incorrect' WHERE question_id='$question_id' AND exam_id='$exam_id' AND student_id='$student_id'";
$con->query($up);
}


?>