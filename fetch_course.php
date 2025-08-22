<?php
include("db.php");
if(isset($_POST['input']))
{
$input=$_POST['input'];
$sel = "SELECT * FROM course WHERE name LIKE '%$input%'";
$res=$con->query($sel);
if($res->num_rows>0)
{
while($row=$res->fetch_assoc())
{
?>

                  <div class="col-md-4 mt-5">
                    <a href="startcourse.php?scid=<?php echo $row['id']; ?>">
                    <div class="card p-3">
                       <div class="row">
                          <div class="col-md-2 d-flex justify-content-start">
                              <img src="teacher/uploads/<?php echo $row['image'];  ?>" style="width:90px;height:90px;">
                          </div>
                          <div class="col-md-10 px-5 d-flex flex-column justify-content-start align-items-start">
                            <h5><?php echo $row['name'] ?></h5>
                          </div>
                        </div>
                    </div>
                    </a>
                  </div>


<?php 
}
}else{
  echo"<h4>No courses to show</h4>";
}
}
elseif($_POST['input_none']=='')
{
$sel = "SELECT * FROM course";
$res=$con->query($sel);
while($row=$res->fetch_assoc())
{
?>
<div class="col-md-4 mt-5">
                    <a href="startcourse.php?scid=<?php echo $row['id']; ?>">
                    <div class="card p-3">
                       <div class="row">
                          <div class="col-md-2 d-flex justify-content-start">
                              <img src="teacher/uploads/<?php echo $row['image'];  ?>" style="width:90px;height:90px;">
                          </div>
                          <div class="col-md-10 px-5 d-flex flex-column justify-content-start align-items-start">
                            <h5><?php echo $row['name'] ?></h5>
                          </div>
                        </div>
                    </div>
                    </a>
                 </div>

<?php
 }} 
 ?>