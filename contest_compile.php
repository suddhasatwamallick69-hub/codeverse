<?php
session_start();
include("db.php");

if(!isset($_SESSION['stu_name']) && $_SESSION['stu_name']=='')
{
    header("location:index.php");
    exit;
}else{
  $student_id=$_SESSION['sid'];
  $student_name=$_SESSION['stu_user_name'];
}


$code = $_POST['code'];
$lang=$_POST['language'];
$question_id = $_POST['question_id'];
$exam_id=$_POST['exam_id'];




$res = $con->query("SELECT * FROM test_cases WHERE question_id = '$question_id' AND exam_id='$exam_id'");
$row=$res->fetch_assoc();
$expected_keywords=explode(',',$row['expected_keywords']);
$count_of_keyword=count($expected_keywords);
// echo $count_of_keyword;


$pattern = '/\b(input|scanf|Scanner)\s*\(/';
if(preg_match($pattern, $code))
{

// $found = 0;
$found = true;
$test_results = [];

// Check if any element from the array exists in the code
foreach ($expected_keywords as $keyword) 
{  
  // if(preg_match("/\b$keyword\b/i",$code))
  // {
  //   $found++;
  // }
  if (strpos($code, $keyword) == true) 
  {
    $found = true;
    break; // Stop checking after the first match
  }
  else
  {
    echo json_encode([
      'InvalidCode' => 'Test cases failed (Wrong Answer)!!',
      'isMatched' => false,
    ]);
    $up="UPDATE exam_question_status SET status='Incorrect' WHERE question_id='$question_id' AND exam_id='$exam_id' AND student_id='$student_id'";
    $con->query($up);
    exit;
  }
}

// Output based on whether a keyword was found or not
// if ($found==$count_of_keyword)
if ($found)
{

  $directory = "C:/xampp/htdocs/minor_project/$_SESSION[stu_user_name]";
  if (!is_dir($directory)) 
  {
     mkdir($directory, 0777, true);
  }


$all_tests_passed = true;

$res1 = $con->query("SELECT * FROM test_cases WHERE question_id = '$question_id' AND exam_id='$exam_id'");
while ($row1 = $res1->fetch_assoc()) 
{
    $input = $row1['input'];
    $expected_output = $row1['expected_output'];
    
    if($lang == 'python3') 
    {
        $code_file = "$directory/main.py";
        $input_file = "$directory/input.txt";
        // Write code and input to the respective files
        file_put_contents($code_file, $code);
        file_put_contents($input_file, $input);
        // Execute the Python code
        $command = "python \"$code_file\" < \"$input_file\" 2>&1";
        $output = [];
        $return_var = 0;
        exec($command, $output, $return_var);

        // print_r($output);
        // echo"<br>";
        // $output = implode(" ", $output);
        // echo $output;
        // echo"<br>";

        if($return_var !== 0 ){
          $output = implode(" ", $output);
          echo json_encode([
            'output' => $output,
            'errormsg'=>'Compilation Error',
            'isExecutionSuccess'=>false,
          ]);
          $up="UPDATE exam_question_status SET status='Incorrect' WHERE question_id='$question_id' AND exam_id='$exam_id' AND student_id='$student_id'";
          $con->query($up);
          unlink($code_file);
          unlink($input_file);
          rmdir($directory);
          exit;
        }
        $output = implode(" ", $output);
        $output = preg_replace('/\s+/', ' ', trim($output));
        $expected_output=preg_replace('/\s+/',' ',trim($expected_output));
      
          if(preg_match("/\b\s*$expected_output\s*\b/i", $output,$output_arr))
          {
            $test_results[] = [
              'input' => $input,
              'expected_output' => $expected_output,
              'output' => $output,
              'status' => 'Pass'
            ];
            // echo"<pre>";
            // echo $expected_output;
            // print_r($output_arr);
            // echo"</pre>";
            // echo"Match";
          }
           else 
           {
            // echo"No match";
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
        $code_file = "$directory/main.c";
        $input_file = "$directory/input.txt";
  
        // Write code and input to the respective files
        file_put_contents($code_file, $code);
        file_put_contents($input_file, $input);

        // Compile the C code
        $compile_command = "gcc -o \"$directory/program.exe\" \"$code_file\" 2>&1";
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
            unlink($code_file);
            unlink($input_file);
            rmdir($directory);
            exit;
        }

        // Execute the compiled C program
        $execute_command = "\"$directory/program.exe\" < \"$input_file\" 2>&1";
        exec($execute_command, $execute_output, $execute_return_var);

        $output = implode(" ", $execute_output);

        $output = preg_replace('/\s+/', ' ', trim($output));
        $expected_output=preg_replace('/\s+/','',trim($expected_output));

        if ($execute_return_var !== 0) 
        {
          echo json_encode([
              'output' => $output,
              'errormsg'=>'Runtime Error!!!',
              'isExecutionSuccess'=>false,
            ]);
            $up="UPDATE exam_question_status SET status='Incorrect' WHERE question_id='$question_id' AND exam_id='$exam_id' AND student_id='$student_id'";
            $con->query($up);
            unlink($code_file);
            unlink($input_file);
            unlink("$directory/program.exe");
            rmdir($directory);
            exit;
        } 
        elseif(preg_match("/\b\s*$expected_output\s*\b/i", $output,$output_arr))
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
          unlink("$directory/program.exe");
    }
    elseif($lang=='java')
    {
      $code_file = "$directory/Main.java";
      $input_file = "$directory/input.txt";
  
      // Write code and input to the respective files
      file_put_contents($code_file, $code);
      file_put_contents($input_file, $input);

      // Compile the java code
      $compile_command = "javac \"$code_file\" 2>&1";
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
          unlink($code_file);
          unlink($input_file);
          rmdir($directory);
          exit;
      }

      // Execute the compiled java program
      $execute_command = "java -cp \"$directory\" Main < \"$input_file\" 2>&1";
      exec($execute_command, $execute_output, $execute_return_var);

      $output = implode(" ", $execute_output);
      $output = preg_replace('/\s+/', ' ', trim($output));
      $expected_output=preg_replace('/\s+/','',trim($expected_output));

      if ($execute_return_var !== 0) 
      {
        echo json_encode([
            'output' => $output,
            'errormsg'=>'Runtime Error!!!',
            'isExecutionSuccess'=>false,
          ]);
          $up="UPDATE exam_question_status SET status='Incorrect' WHERE question_id='$question_id' AND exam_id='$exam_id' AND student_id='$student_id'";
          $con->query($up);
          unlink($code_file);
          unlink($input_file);
          unlink("$directory/Main.class");
          rmdir($directory);
          exit;
      } 
      elseif(preg_match("/\b\s*$expected_output\s*\b/i", $output,$output_arr))
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
        unlink("$directory/Main.class");
    }
}





if ($all_tests_passed) 
{

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
      'successmsg' => 'Successfully executed all hidden test cases!',
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
    $new_count=intval($count)+1;
    $total_duration=$row4['total_duration'];
    $new_total_duration=intval($total_duration)+intval($duration);
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
unlink($code_file);
unlink($input_file);
rmdir($directory);
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
}
else
{
  echo json_encode([
    'output'=>'Wrong Answer(input error)',
    'inputerror'=>'Your Code desnot take any input from the user!! Check if functions for taking input are present in your code!!',
]);
}

?>