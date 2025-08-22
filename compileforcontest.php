<?php
session_start();


if(!isset($_SESSION['stu_name']) && $_SESSION['stu_name']=='')
{
    header("location:index.php");
    exit;
}else{
  $student_id=$_SESSION['sid'];
  $student_name=$_SESSION['stu_name'];
}



$code = $_POST['code'];
$input = $_POST['input'];
$lang=$_POST['language']; 

$directory = "C:/xampp/htdocs/minor_project/$_SESSION[stu_user_name]";
if (!is_dir($directory)) 
{
   mkdir($directory, 0777, true);
}

$pattern = '/\b(input|scanf)\s*\(/';
if(preg_match($pattern, $code))
{

if($lang=='python3')
{
    $code_file = "$directory/main.py";
    $input_file = "$directory/input.txt";

    // Write code and input to the respective files
    file_put_contents($code_file, $code);
    file_put_contents($input_file, $input);


  $command ="python \"$code_file\" < \"$input_file\" 2>&1";

  $output=[];
  $return_var = 0;

  exec($command, $output, $return_var);

  $output=implode("\n", $output);
    if ($return_var !== 0) 
    {
    echo json_encode([
        'output' => $output,
        'errormsg'=>'Compilation Error',
        'isExecutionSuccess'=>false,
    ]);
    unlink($code_file);
    unlink($input_file);
    rmdir($directory);
    exit;
    }

    // Output the result
    echo json_encode([  
    'output' => $output,
    'successmsg'=>'Successfully executed',
    'isExecutionSuccess'=>true,
  ]);
}
elseif($lang=='c')
{
    $code_file = "$directory/main.c";
    $input_file = "$directory/input.txt";

    // Write code and input to the respective files
    file_put_contents($code_file, $code);
    file_put_contents($input_file, $input);

    // Compile the C program
    $compile_command = "gcc -o \"$directory/program.exe\" \"$code_file\" 2>&1";
    $compile_output = [];
    $compile_return_var = 0;
    exec($compile_command, $compile_output, $compile_return_var);

    if ($compile_return_var !== 0) 
    {
        $output=implode("\n", $compile_output);
        echo json_encode([
        'output' => $output,
        'errormsg'=>'Compilation Error!!!',
        'isExecutionSuccess'=>false,
      ]);
      unlink($code_file);
      unlink($input_file);
      rmdir($directory);
      exit;
    }

    // Execute the compiled c program
    $execute_command = "\"$directory/program.exe\" < \"$input_file\" 2>&1";
    $execute_output = [];
    $execute_return_var = 0;
    exec($execute_command, $execute_output, $execute_return_var);

    if ($execute_return_var !== 0) 
    {
        $output=implode("\n", $execute_output);
        echo json_encode([
        'output' => $output,
        'errormsg'=>'Runtime Error!!!',
        'isExecutionSuccess'=>false,
      ]);
      unlink($code_file);
      unlink($input_file);
      unlink("$directory/program.exe");
      rmdir($directory);
      exit;
    }

    // Output the result
    $output=implode("\n", $execute_output);
    echo json_encode([
    'output' => $output,
    'successmsg'=>'Successfully executed!!!',
    'isExecutionSuccess'=>true,
  ]);
    unlink("$directory/program.exe");
}
elseif($lang=='java')
{
    $code_file = "$directory/Main.java";
    $input_file = "$directory/input.txt";
  
    // Write code and input to the respective files
    file_put_contents($code_file, $code);
    file_put_contents($input_file, $input);

    // Compile the java program
    $compile_command = "javac \"$code_file\" 2>&1";
    $compile_output = [];
    $compile_return_var = 0;
    exec($compile_command, $compile_output, $compile_return_var);

    if ($compile_return_var !== 0) 
    {
        $output=implode("\n", $compile_output);
        echo json_encode([
        'output' => $output,
        'errormsg'=>'Compilation Error!!!',
        'isExecutionSuccess'=>false,
      ]);
      unlink($code_file);
      unlink($input_file);
      rmdir($directory);
      exit;
    }

    // Execute the compiled java program
    $execute_command = "java -cp \"$directory\" Main < \"$input_file\" 2>&1";
    $execute_output = [];
    $execute_return_var = 0;
    exec($execute_command, $execute_output, $execute_return_var);

    if ($execute_return_var !== 0) 
    {
        $output=implode("\n", $execute_output);
        echo json_encode([
        'output' => $output,
        'errormsg'=>'Runtime Error!!!',
        'isExecutionSuccess'=>false,
      ]);
      unlink($code_file);
      unlink($input_file);
      rmdir($directory);
      unlink("$directory/Main.class");
      exit;
    }

    // Output the result
    $output=implode("\n", $execute_output);
    echo json_encode([
    'output' => $output,
    'successmsg'=>'Successfully executed!!!',
    'isExecutionSuccess'=>true,
  ]);
    unlink("$directory/Main.class");
}
elseif($lang=='cpp')
{
    $code_file = "$directory/main.cpp";
    $input_file = "$directory/input.txt";

    // Write code and input to the respective files
    file_put_contents($code_file, $code);
    file_put_contents($input_file, $input);

    // Compile the C program
    $compile_command = "g++ \"$code_file\" -o \"$directory/program.exe\" 2>&1";
    $compile_output = [];
    $compile_return_var = 0;
    exec($compile_command, $compile_output, $compile_return_var);

    if ($compile_return_var !== 0) 
    {
        $output=implode("\n", $compile_output);
        echo json_encode([
        'output' => $output,
        'errormsg'=>'Compilation Error!!!',
        'isExecutionSuccess'=>false,
      ]);
      unlink($code_file);
      unlink($input_file);
      rmdir($directory);
      exit;
    }

    // Execute the compiled c program
    $execute_command = "\"$directory/program.exe\" < \"$input_file\" 2>&1";
    $execute_output = [];
    $execute_return_var = 0;
    exec($execute_command, $execute_output, $execute_return_var);

    if ($execute_return_var !== 0) 
    {
        $output=implode("\n", $execute_output);
        echo json_encode([
        'output' => $output,
        'errormsg'=>'Runtime Error!!!',
        'isExecutionSuccess'=>false,
      ]);
      unlink($code_file);
      unlink($input_file);
      unlink("$directory/program.exe");
      rmdir($directory);
      exit;
    }

    // Output the result
    $output=implode("\n", $execute_output);
    echo json_encode([
    'output' => $output,
    'successmsg'=>'Successfully executed!!!',
    'isExecutionSuccess'=>true,
  ]);
    unlink("$directory/program.exe");
}

unlink($code_file);
unlink($input_file);
rmdir($directory);
}
else
{
  echo json_encode([
    'output'=>'Wrong Answer(input error)',
    'errormsg'=>'Your Code desnot take any input from the user!! Check if functions for taking input are present in your code!!',
    'isExecutionSuccess'=>false,
]);
}
?>
