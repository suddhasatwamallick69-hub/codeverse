<?php

session_start();
include("db.php");
$teacher_id=$_SESSION['uid'];
$teacher_name=$_SESSION['name'];
                   if(isset($_POST['addquestion']))
                   {
                    extract($_POST);
                    $op1=$con->real_escape_string($_POST['op1']);
                    $op2=$con->real_escape_string($_POST['op2']);
                    $op3=$con->real_escape_string($_POST['op3']);
                    $op4=$con->real_escape_string($_POST['op4']);
                    $answer=$con->real_escape_string($_POST['answer']);

                    $loop=0;
                    $count=0;

                    $res="SELECT * FROM course_questions WHERE course_name='$cname' ORDER BY id ASC";
                    $rs=$con->query($res);
                    $count=$rs->num_rows;
                    echo $count;
                    if($count==0){

                    }
                    else{
                        while($row=$rs->fetch_array()){
                            $loop=$loop+1;
                            $id=$row['id'];
                            $up="UPDATE course_questions SET question_no='$loop' WHERE id='$id'";
                            $con->query($up);
                        }
                    }
                    $loop=$loop+1;
                    
                        
                        $sql="INSERT INTO course_questions SET question_no='$loop',name='$name',op1='$op1',op2='$op2',op3='$op3',op4='$op4',answer='$answer',course_id='$cid',course_name='$cname',teacher_id='$teacher_id',teacher_name='$teacher_name'";
                        $con->query($sql);
                    ?>
                    <script>
                        alert('Question Added');
                        window.location.href='add_questions.php?addqid='+<?php echo $cid?>
                    </script>
                    <?php } ?>