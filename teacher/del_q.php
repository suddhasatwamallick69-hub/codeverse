<?php
include("db.php");
$did=$_GET['did'];

$sel="SELECT * FROM course_questions WHERE id='$did'";
$res=$con->query($sel);
$row=$res->fetch_assoc();
$cid=$row['course_id'];
echo $cid;

$del="DELETE FROM course_questions WHERE id='$did'";
$con->query($del);
$loop=0;
$count=0;

$res="SELECT * FROM course_questions WHERE course_id='$cid' ORDER BY id ASC";
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
    ?>
    <?php } ?>
<script>
alert('Question Added');
window.location.href='list_questions.php';
</script>
<?php  ?>
