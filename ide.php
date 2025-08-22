<?php
session_start();
include("db.php");
if(isset($_GET['lang']))
{
  $lang=$_GET['lang'];
}

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

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <!-- Main CSS File -->
  <link id="theme-stylesheet" href="wrapper/css/main.css" rel="stylesheet">

<!-- Latest compiled JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="codemirror-5.65.17/lib/codemirror.css">
<script src="codemirror-5.65.17/lib/codemirror.js"></script>

<!-- <script src="https://unpkg.com/@codemirror/autocomplete@0.19.0/dist/codemirror-autocomplete.js"></script> -->

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

<script src="codemirror-5.65.17/addon/edit/closebrackets.js"></script>

<script src="codemirror-5.65.17/mode/clike/clike.js"></script>
<script src="codemirror-5.65.17/mode/python/python.js"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<style>
  .CodeMirror {
    font-size: 18px;
}
</style>
</head>
<body class="">
   <?php  include("inc/header.php")  ?>

    <section id="" class="section">
        <div class="container-fluid">
        <div class="row">
        <div class="col-md-8">
          <!-- <form action="compile.php" method="post"> -->
            <div class="d-flex justify-content-between mb-2 rounded p-2" id="editorbar">
                <div class="col-12 w-25">
                    <select class="form-select bg-dark text-white" id="selectlang" name="language">
                      <option value="0" disabled>--Choose Language--</option>
                      <option value="python3" <?php if(isset($lang) && $lang == 'python3'){echo"selected";}?> >Python3</option>
                      <option value="c"       <?php if(isset($lang) && $lang == 'c'){echo"selected";}?>    >C</option>
                      <option value="java"    <?php if(isset($lang) && $lang == 'java'){echo"selected";}?> >Java</option>
                      <option value="cpp" <?php if(isset($lang) && $lang == 'cpp'){echo"selected";}?>>C++</option>
                      <option value="javascript" <?php if(isset($lang) && $lang == 'js'){echo"selected";}?>>Javascript</option>
                      <option value="csharp">C#</option>
                      <option value="typescript">Typescript</option>
                      <option value="kotlin">kotlin</option>
                      <option value="go">Go</option>
                      <option value="rust">Rust</option>
                      <option value="r">R</option>
                    </select>
                </div>

                <div class="col-12 w-25 d-flex bg-warning justify-content-center px-2 rounded">
                        <button title="settings" id="settings" data-toggle="modal" data-target="#idesettings" class="me-4"><i class="bi bi-gear"></i></button>
                        <div id="idesettings" class="modal fade" role="dialog">
                          <div class="modal-dialog">
                               <!-- Modal content-->
                              <div class="modal-content">
                                   <div class="modal-header  bg-dark">
                                        <h4 class="modal-title text-white">Editor Settings</h4>
                                   </div>
                                   <div class="modal-body  bg-dark">
                                        <div class="row">
                                          <div class="col-md-6">
                                              <h4 class="text-white">Themes</h4>
                                          </div>
                                          <div class="col-md-6">
                                            <select class="form-select bg-dark text-white" id="theme" onchange="theme();">
                                               <option disabled>Themes</option>
                                               <option value="blackboard">Blackboard</option>
                                               <option value="twilight" >Twilight</option>
                                               <option value="rubyblue">Rubyblue</option>
                                               <option value="dracula">Dracula</option>
                                               <option value="darcula" >Darcula</option>
                                               <option value="idea" >Idea</option>
                                               <option value="midnight" selected>Midnight</option>lucario
                                               <option value="colorforth" >Colorforth</option>
                                               <option value="lucario" >Lucario</option>
                                               <option value="hopscotch" >hopscotch</option>
                                               <option value="yonce" >Yonce</option>
                                               <option value="cobalt" >Cobalt</option>
                                               <option value="solarized" >Solarized</option>
                                             </select>
                                          </div>
                                          <div class="col-md-6 mt-2">
                                              <h4 class="text-white">Font Size</h4>
                                          </div>
                                          <div class="col-md-6 mt-2">
                                               <input type="number" value="18" min="16" max="30" id="fontsize" class="form-control bg-dark text-white">
                                          </div>
                                        </div>
                                   </div>
                                   <div class="modal-footer  bg-dark">
                                         <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
                                   </div>
                              </div>
                          </div>
                        </div>
                       <button id="reset" title="reset editor" class="me-4"><i class="bi bi-arrow-counterclockwise"></i></button>
                       <button id="reset" title="download code"><i class="bi bi-download"></i></button>
                </div>
                  <div>
                    <?php
                    if(isset($_SESSION['stu_user_name']))
                    {
                    ?>
                    <button type="submit" id="run" class="btn btn-primary">RUN</button>
                    <button id="checkcomplexity" class="btn btn-light" data-toggle="modal" data-target="#myModal">Time Complexity</button>
                    <?php } ?>
                  </div>
            </div>
            <?php
             if(isset($_SESSION['stu_user_name']))
             {
             ?>
            <textarea name="code" id="editor" class="form-control" disabled></textarea>
            <?php }else{ ?>
              <textarea name="code" id="editor" class="form-control"></textarea>
              <div class="logindiv">
                <p>Login or SignUp to Start Coding!!</p>
                <a href="login_signup.php?destination=ide.php" class="btn btn-primary">Login</a>
              </div>
              <?php } ?>
            <!-- </form> -->
            <div id="myModal" class="modal fade" role="dialog">
               <div class="modal-dialog">
                  <!-- Modal content-->
                  <div class="modal-content">
                      <div class="modal-header">
                          <h4 class="modal-title text-dark">Time Complexity Analysis</h4>
                      </div>
                      <div class="modal-body">
                          <p id="analysing" style="text-align:center"></p>
                          <h5 id="complexity" class="text-dark"></h5>
                      </div>
                      <div class="modal-footer">
                           <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
                      </div>
                  </div>
               </div>
            </div>
        </div>
        <div class="col-md-4 d-flex flex-column rounded bg-dark">
            <div class="">
                <label for="input" class="text-light m-2">Input</label>
                <textarea id="input" name="input" placeholder="Enter Input here" class="form-control text-dark h-50 mb-2" style="background-color:#b2b2b2f0;font-weight:bold;"></textarea>
                <!-- <input type="text" placeholder="Enter Input here" id="input" class="form-control h-50 mb-2" style="background-color:#e6e6e6ac;color:rgb(22, 2, 2);font-weight:bold;"> -->
                <p style="color:rgb(255, 254, 235);font-weight:bold;" class="bg-secondary p-2">If your code takes input, add it in the above box before running.</p>
                <p id='queue'></p>
            </div>

            
            <p class="mt-3" id="error"></p>
            <div style="height:100%">
                <h6 class="mb-3" id="success"></h6>
                <label for="output" class="text-light">Output</label>
                <textarea name="" id="output" style="background-color:#02070b;color:white;font-weight:bold;height:85%" class="form-control" disabled></textarea>
            </div>
        </div>
        
        </div>
        </div>
    </section>

    <script src="wrapper/js/script.js"></script>
    <script src="wrapper/js/jquery.js"></script>
    <script src="wrapper/js/ajax.js"></script>
    <script src="wrapper/js/complexity.js"></script>
    <script src="wrapper/js/mode.js"></script>
    <script src="wrapper/js/main.js"></script>


    <?php include("inc/footer.php") ?>

   <script>
    function loadData() 
    {
    const inputKey = `input`;
    const editorKey = `editor`;

    const inputValue = localStorage.getItem(inputKey);
    const editorValue = localStorage.getItem(editorKey);

    if (inputValue) {
        document.getElementById('input').value = inputValue;
    }
    if (editorValue) {
        editor.setValue(editorValue);
    }
   }

  // Function to save data to localStorage when input changes
  function saveData() 
  {
    const inputKey = `input`;
    const editorKey = `editor`;

    localStorage.setItem(inputKey, document.getElementById('input').value);
    localStorage.setItem(editorKey, editor.getValue());
  }

    // Load data when the page loads
     window.onload = loadData;

    // Save data when the user types in the input fields
     document.getElementById('input').addEventListener('input', saveData);
     editor.on('change', saveData);
   </script>
</body>


</html>
