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

include("db.php");
$qsid=$_GET['pqid'];
$sel="SELECT * FROM practical_questions WHERE id='$qsid'";
$res=$con->query($sel);
$row=$res->fetch_assoc();
$problem_statement=$row['problem_statement'];
$input_format=$row['input_format'];
$input=$row['input'];
$output_format=$row['output'];
$explanation=$row['explanation'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Solve Problems</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="wrapper/img/logo.png" rel="icon">
  <link href="wrapper/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Bootstrap CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <!--Bootstrap Icons-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">


  <!-- Main CSS File -->
  <link id="theme-stylesheet" href="wrapper/css/main2.css" rel="stylesheet">


  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"> -->
<!-- Latest compiled JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="codemirror-5.65.17/lib/codemirror.css">
<script src="codemirror-5.65.17/lib/codemirror.js"></script>
<script src="https://unpkg.com/@codemirror/autocomplete@0.19.0/dist/codemirror-autocomplete.js"></script>

<link rel="stylesheet" href="codemirror-5.65.17/theme/midnight.css">
<link rel="stylesheet" href="codemirror-5.65.17/theme/colorforth.css">
<link rel="stylesheet" href="codemirror-5.65.17/theme/blackboard.css">
<link rel="stylesheet" href="codemirror-5.65.17/theme/twilight.css">
<link rel="stylesheet" href="codemirror-5.65.17/theme/rubyblue.css">
<link rel="stylesheet" href="codemirror-5.65.17/theme/dracula.css">
<link rel="stylesheet" href="codemirror-5.65.17/theme/darcula.css">
<link rel="stylesheet" href="codemirror-5.65.17/theme/idea.css">
<link rel="stylesheet" href="codemirror-5.65.17/theme/lucario.css">
<link rel="stylesheet" href="codemirror-5.65.17/theme/hopscotch.css">
<link rel="stylesheet" href="codemirror-5.65.17/theme/yonce.css">
<link rel="stylesheet" href="codemirror-5.65.17/theme/cobalt.css">
<link rel="stylesheet" href="codemirror-5.65.17/theme/solarized.css">
<link rel="stylesheet" href="codemirror-5.65.17/theme/hopscotch.css">

<script src="codemirror-5.65.17/addon/edit/closebrackets.js"></script>

<script src="codemirror-5.65.17/mode/clike/clike.js"></script>
<script src="codemirror-5.65.17/mode/python/python.js"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<style>
  .CodeMirror {
    font-size: 16px; /* Adjust the size as needed */
}
</style>
</head>
<body>
<?php  include("inc/header.php")  ?>
   <section id="solve-section">
        <div class="container-fluid">
           <div class="row">
            <div class="col-md-8">
                <!-- <form action="contest_compile.php" method="post"> -->
               <div class="d-flex justify-content-between mb-2 bg-dark p-2">
                  <div class="col-12 w-25">
                    <select class="form-select bg-dark text-white" id="selectlang" name="language" required>
                      <option value="0" disabled selected>--Choose Language--</option>
                      <option value="python3" selected>Python</option>
                      <option value="c">C</option>
                      <option value="java">Java</option>
                    </select>
                  </div>

                  <div class="col-12 w-25">
                    <select class="form-select bg-dark text-white" id="theme" onchange="theme();">
                      <option disabled>Themes</option>
                      <option value="blackboard">Blackboard</option>
                      <option value="midnight" selected>Midnight</option>
                      <option value="colorforth" >Colorforth</option>
                    </select>
                  </div>
                  <div>
                    <button type="submit" id="run" class="btn btn-success">RUN</button>
                    <!-- <button id="checkcomplexity" class="btn btn-light">Time Complexity</button> -->
                  </div>
               </div>
               <textarea name="code" id="editor" class="form-control"></textarea>
                <!-- </form> -->
                    <div class="container-fluid border border-white p-5">
                        <div class="row">
                              <div class="col-md-12">
                                <h4><u>Problem Statement:</u></h4>
                                <h5><?php echo $problem_statement; ?></h5> 
                              </div>
                              <div class="col-md-12 mt-4">                               
                                <h4>Description - </h4>
                                <p><?php echo $explanation; ?></p>
                                <h5>Input Format and Explanation</h5>
                                <p>(<?php echo $input_format; ?>)</p>
                              </div>
                              <div class="col-md-6 mt-3">
                                <h4>Input<a href=""> <i class="bi bi-copy"></i></a></h4>
                                <textarea rows="4" cols="15" disabled><?php echo $input; ?></textarea>
                             </div>
                             <div class="col-md-6 mt-3">
                               <h4>Output</h4>
                               <textarea rows="4" cols="15" disabled><?php echo $output_format; ?></textarea>
                             </div>
                             <!-- <div class="col-md-12 mt-4">
                               <h4>Constraints - </h4>
                               <h5>1< n < 10 ^ 9</h5>
                            </div> -->
                        </div>
                    </div>
            </div>
            <div class="col-md-4">
                <div class="">
                    <div class="col bg-dark px-2 pb-5">
                        <div class="pt-2">
                                <textarea id="input" name="input" cols="4" rows="4" placeholder="Enter Input here" class="form-control text-dark h-50 mb-2" style="background-color:#b2b2b2f0;font-weight:bold;" ><?php  echo $input; ?></textarea>
                               <p class="bg-secondary p-2" style="color:rgb(255, 254, 235);font-weight:bold;">If your code takes input, add it in the above box before running.</p>
                                 <p id='queue'></p>
                        </div>
                         <p class="mt-2" id="error"></p>
                         <div>
                            <h6 class="mt-2" id="success"></h6>
                            <label for="output" class="text-light m-2">Output</label>
                            <textarea name="" cols="" rows="18" id="output" style="background-color:#0b0b0bd3;color:white;font-weight:bold;height:85%" class="form-control" disabled></textarea>
                         </div>
                    </div>
                </div>
            </div>
           </div>  
        </div>
   </section>
    <!-- <div class="container">
      <div class="row">
        <h4 id="complexity"></h4>
      </div>
    </div> -->

    <script src="wrapper/js/script2.js"></script>
    <script src="wrapper/js/jquery.js"></script>
    <script src="wrapper/js/ajax.js"></script>
    <script src="wrapper/js/complexity.js"></script>
    <script src="wrapper/js/mode.js"></script>


    <?php include("inc/footer.php") ?>
   <script>

   </script>
</body>


</html>
