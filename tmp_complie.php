<?php

$code = $_POST['code'];
$input = $_POST['input'];
$lang=$_POST['language']; 


if($lang=='python3')
{
  file_put_contents('code_files/main.py', $code);
  file_put_contents('code_files/input.txt', $input);

  $command = 'python code_files/main.py < code_files/input.txt 2>&1';

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
    file_put_contents("code_files/main.c", $code);
    file_put_contents("code_files/input.txt", $input);

    // Compile the C program
    $compile_command = "gcc -o \"code_files/program.exe\" \"code_files/main.c\" 2>&1";
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
      exit;
    }

    // Execute the compiled c program
    $execute_command = "\"code_files/program.exe\" < \"code_files/input.txt\" 2>&1";
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
      exit;
    }

    // Output the result
    $output=implode("\n", $execute_output);
    echo json_encode([
    'output' => $output,
    'successmsg'=>'Successfully executed!!!',
    'isExecutionSuccess'=>true,
  ]);
    unlink('code_files/program.exe');
}
elseif($lang=='java')
{
    file_put_contents("code_files/Main.java", $code);
    file_put_contents("code_files/input.txt", $input);

    // Compile the C program
    $compile_command = "javac code_files/Main.java 2>&1";
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
      exit;
    }

    // Execute the compiled c program
    $execute_command = "java -cp code_files Main < code_files/input.txt 2>&1";
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
      exit;
    }

    // Output the result
    $output=implode("\n", $execute_output);
    echo json_encode([
    'output' => $output,
    'successmsg'=>'Successfully executed!!!',
    'isExecutionSuccess'=>true,
  ]);
    unlink('code_files/Main.class');
}
?>































