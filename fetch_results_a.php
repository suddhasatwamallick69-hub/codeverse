<?php
session_start();


include("db.php");
$option=$_GET['option'];
$val=$_GET['val'];
$sql="SELECT * FROM practical_questions WHERE difficulty LIKE '%$option%' AND category='$val'";
$rs=$con->query($sql);
if($rs->num_rows>0){
  $count=0;
            while($row=$rs->fetch_assoc()){
              $count++;
?>
                <tr>
                    <td><?php echo $count; ?></td>
                    <td><?php echo $row['problem_statement']; ?></td>
                    <td><?php echo $row['difficulty']; ?></td>
                      <?php
                       if(isset($_SESSION['stu_user_name']))
                       {
                        ?>
                      <td><a href="solve.php?qid=<?php echo $row['id']; ?>" class="" target="_blank">Start Solving</a></td>
                    <?php 
                       }else{
                       ?>
                       <td><a href="" onclick="return alert('Login to continue')" class="">Start Solving</a></td>
                       <?php }?>
                    <td><a href="">Solution</a></td>
                </tr>
<?php }} ?>