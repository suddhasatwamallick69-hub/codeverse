<?php
session_start();
include("db.php");
if(!isset($_SESSION['stu_name']) && $_SESSION['stu_name']=='')
{
    header("location:index.php");
    exit;
}
if(isset($_GET['qid']) && isset($_GET['examid']))
{

$contest_id=$_GET['examid'];

$sql="SELECT * FROM exam WHERE id='$contest_id'";
$res=$con->query($sql);
$row=$res->fetch_assoc();
$examId = $row['id'];
$duration=$row['duration'];
$exam_name=$row['exam_name'];
$start_time=$row['exam_start'];
$end_time=$row['exam_end'];
$exam_date=$row['exam_date'];
// student details
$student_id=$_SESSION['sid'];
$student_name=$_SESSION['stu_user_name'];

$sql2="SELECT * FROM exam_questions WHERE id='$_GET[qid]' AND exam_id='$examId'";
$res2=$con->query($sql2);
$row2=$res2->fetch_assoc();
$problem_statement=$row2['question_name'];
$input_format=$row2['input_format'];
$output_format=$row2['output_format'];
$description=$row2['description'];
// $output_format=explode(" ",$output_format);

$question_id=$row2["id"];

$sql3="SELECT * FROM exam_question_status WHERE question_id='$question_id' AND exam_id='$examId' AND student_id='$student_id'";
$res3=$con->query($sql3);

if($res3->num_rows>0)
{
    $row3=$res3->fetch_assoc();
    // print_r($row3);
    if($row3['status']=='Correct' || $row3['status']=='Incorrect')
    {
        $question_status=$row3['status'];   
    }
    else
    {
        $question_status="Not Attempted";   
    }
}
else 
{
    $question_status="Not Attempted";
    date_default_timezone_set('Asia/Kolkata');
    $start_time = date("Y-m-d H:i:s");
    $ins="INSERT INTO exam_question_status SET exam_id='$examId',exam_name='$exam_name',question_id='$question_id',status='Not Attempted',student_id='$student_id',student_name='$student_name',start_time='$start_time'";
    $con->query($ins);
}


$sql4="SELECT * FROM correct_question_count WHERE  exam_id='$examId' AND student_id='$student_id'";
$res4=$con->query($sql4);

if($res4->num_rows==0)
{
    $ins1="INSERT INTO correct_question_count SET exam_id='$examId',exam_name='$exam_name',student_id='$student_id',student_name='$student_name',correct_count=0,total_duration=0";
    $con->query($ins1);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title><?php echo $_SESSION['exam_name']; ?> Contest</title>
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
  <link href="wrapper/css/main3.css" rel="stylesheet">

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
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
<link rel="stylesheet" href="codemirror-5.65.17/theme/hopscotch.css">

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

<body>

   <?php  include("inc/contest_header.php")  ?>
   <section id="starter-section" class="starter-section section">
        <div class="">
            <p id="countdown"></p>
           <div class="row">
            <div class="col-md-5 mt-2 border border-primary">
                <div class="container mt-4">
                    <div class="row">
                        <div class="col-md-12">
                            <h4><u>Problem Statement:</u></h4>
                            <h5><?php echo $problem_statement; ?></h5>
                        </div>
                        <div class="col-md-12 mt-4">
                            <h4>Description-</h4><p> <?php echo $description ?></p>
                        </div>
                        <div class="col-md-6 mt-3">
                            <h4>Input <a href=""><i class="bi bi-copy"></i></a></h4>
                            <h5><?php echo $input_format; ?></h5>
                        </div>
                        <div class="col-md-6 mt-3">
                            <h4>Output Format- </h4>
                            <h5>
                                <?php 
                                // foreach ($output_format as $output) {
                                //     echo $output . "<br>";  
                                // } 
                                
                                if (strpos($output_format, '\n') !== false) {
                                    $output_format=explode(" ",$output_format);
                                    $output_format = str_replace('\n', "\n", $row2['output_format']);
                                    echo nl2br($output_format);
                                } else {
                                    echo $output_format;
                                }
                                ?>
                            </h5>
                        </div>
                       
                        <!-- <div class="col-md-12 mt-4">
                            <h4>Constraints - </h4>
                            <h5>1< n < 10 ^ 9</h5>
                        </div> -->
                        <div class="mt-5">
                            <h4 id="inputerror"></h4>
                        </div>

                        <div class="mt-5">
                            <h3 id="successmsg"></h3>
                        </div>

                        <div>
                             <h3 id="errormsg"></h3>
                        </div>

                        <div class="mt-4 mb-5">
                             <h4 id="testresults"></h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <!-- <form action="contest_compile.php" method="post"> -->
               <div class="d-flex justify-content-between mb-2 bg-dark rounded p-2">
                  <div>
                     <button type="button" id="run" class="btn btn-primary"><i class="bi bi-play-fill"></i> Run</button>
                  </div>
                <div class="col-12 w-25">
                    <select class="form-select bg-dark text-white" id="selectlang" name="language" required>
                      <option value="" disabled selected>--Choose Language--</option>
                      <option value="python3" selected>Python</option>
                      <option value="c">C</option>
                      <option value="java">Java</option>
                    </select>
                </div>

                <div class="col-12 w-25">
                        <button title="settings" id="settings" data-toggle="modal" data-target="#idesettings"><i class="fa fa-cog" aria-hidden="true"></i></button>
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
                                               <option value="darcula" selected>Darcula</option>
                                               <option value="idea" >Idea</option>
                                               <option value="midnight">Midnight</option>lucario
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
                </div>
               </div>
               <div class="row">
                <div class="col-md-12">
                   <textarea name="code" id="editor" class="form-control"></textarea>
                </div>
                <div class="col-md-12">
                    <div class="container bg-dark px-3 pb-4">
                        <div class="">
                            <p id="errinput"></p>
                            <label for="input" class="text-light m-2" id="">Input</label>
                            <textarea id="input" name="input" cols="" rows="" placeholder="Enter Input here" class="form-control text-dark h-50 mb-2" style="background-color:#b2b2b2f0;font-weight:bold;" ></textarea>
                            <p style="color:rgb(255, 254, 235);font-weight:bold;">If your code takes input, add it in the above box before running.</p>
                            <p id='queue'></p>
                        </div>
                        <p class="mt-2" id="error"></p>
                        <div>
                            <h6 class="mt-2" id="success"></h6>
                            <div id="output"></div>
                        </div>
                      <input type="hidden" name="question_id" id="qid" value="<?php echo $_GET['qid']; ?>">
                      <input type="hidden" name="exam_id" id="eid" value="<?php echo $examId; ?>">
                      <?php
                      if($question_status=='Correct' || $question_status=='Incorrect')
                      {
                          echo "<h4 style='color:red;'>You have submitted your code</h4>";
                      }
                      elseif($question_status=='Not Attempted'){
                      ?>
                      <button type="button" id="submit" class="btn btn-success mt-2">Submit</button>
                      <?php } ?>
                      <!-- <button type="submit" id="submit" class="btn btn-success mt-2">Submit</button> -->
                   </div>
                </div>
               </div>
               <!-- </form>  -->
            </div>
           </div>  
        </div>
   </section>
  
  <!-- Vendor JS Files -->
  <script src="wrapper/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="wrapper/vendor/aos/aos.js"></script>
  <script src="wrapper/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="wrapper/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Main JS File -->
  <!-- <script src="wrapper/js/script.js"></script> -->
  <script src="wrapper/js/code_editor.js"></script>
  <script src="wrapper/js/main.js"></script>
  <script src="wrapper/js/mode.js"></script>
  <script src="wrapper/js/jquery.js"></script>
  <script src="wrapper/js/contest_compile.js"></script>
  <script src="wrapper/js/ajax2.js"></script>

  <script>
    function loadData() {
    const qid = new URLSearchParams(window.location.search).get('qid');
    const inputKey = `input_${qid}`;
    const editorKey = `editor_${qid}`;
    const langKey = `lang_${qid}`;

    const inputValue = localStorage.getItem(inputKey);
    const editorValue = localStorage.getItem(editorKey);
    const langValue = localStorage.getItem(langKey);

    if (inputValue) {
        document.getElementById('input').value = inputValue;
    }
    if (editorValue) {
        editor.setValue(editorValue);
    }   

    if(langValue)
    {
        document.getElementById('selectlang').value.options.selectedIndex.text = langValue;   
    }
}

// Function to save data to localStorage when input changes
function saveData() {
    const qid = new URLSearchParams(window.location.search).get('qid');
    const inputKey = `input_${qid}`;
    const editorKey = `editor_${qid}`;
    const langKey = `lang_${qid}`;

    localStorage.setItem(inputKey, document.getElementById('input').value);
    localStorage.setItem(editorKey, editor.getValue());

    document.getElementById('selectlang').addEventListener('change', function() {
      var lang = this.value;
      localStorage.setItem('langKey', lang);
    });
}

// Load data when the page loads
window.onload = loadData;

// Save data when the user types in the input fields
document.getElementById('input').addEventListener('input', saveData);
editor.on('change', saveData);

    

    $(document).ready(function () {        
            const startDateTime = new Date("<?php echo $start_time; ?>").getTime();
            const endDateTime = new Date("<?php echo $end_time; ?>").getTime();
            const countdownId = $('#countdown'); // Unique ID for this row
            console.log(startDateTime);

            const countdownFunction = setInterval(function () {
                const now = new Date().getTime();
                const timeUntilStart = startDateTime - now;
                const timeUntilEnd = endDateTime - now;

                if (timeUntilStart > 0) 
                {
                    // Contest has not started yet
                    const days = Math.floor(timeUntilStart / (1000 * 60 * 60 * 24));
                    const hours = Math.floor((timeUntilStart % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    const minutes = Math.floor((timeUntilStart % (1000 * 60 * 60)) / (1000 * 60));
                    const seconds = Math.floor((timeUntilStart % (1000 * 60)) / 1000);

                    $(countdownId).html("<span style='color:green;'>Contest Starts In - "+ days + "d " + hours + "h " + minutes + "m " + seconds + "s </span>");
                    $("#countdownIdtable").html("<span>Exam Questions will be displayed after - "+ days + "d " + hours + "h " + minutes + "m " + seconds + "s </span>");
                }
                else if (timeUntilEnd > 0) 
                {
                    // Contest is live
                    const days = Math.floor(timeUntilEnd / (1000 * 60 * 60 * 24));
                    const hours = Math.floor((timeUntilEnd % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    const minutes = Math.floor((timeUntilEnd % (1000 * 60 * 60)) / (1000 * 60));
                    const seconds = Math.floor((timeUntilEnd % (1000 * 60)) / 1000);

                    $(countdownId).html("<span style='color:red;'>Contest Ends In "+ days + "d " + hours + "h " + minutes + "m " + seconds + "s - Contest Live</span>");
                }
                else {
                    // Contest has ended
                    localStorage.clear();
                    window.location.href='index.php';
                    clearInterval(countdownFunction);
                    $(countdownId).html("<span style='color:red;'>Contest Ended</span>");
                    $(startbtn).empty();
                }
            }, 1000); // Update the countdown every second
    });
  </script>

</body>

</html>
<?php
}else{echo "<h1 style='text-align:center'>404 <br>Page not found!</h1>";}
?>