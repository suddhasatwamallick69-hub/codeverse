<?php
extract($_POST);
include("db.php");
session_start();
if(isset($_GET['option']))
{
$option=$_GET['option'];
$sql="SELECT * FROM course WHERE name LIKE '%$option%'";
$rs=$con->query($sql);
?>
<table class="table table-bordered" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>Image</th>
                                            <th>Teacher Name</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    while($row=$rs->fetch_assoc())
                                    {
                                    ?>
                                        <tr>
                                            <td><?php echo $row['name'];  ?></td>
                                            <td><?php echo $row['description'];  ?></td>
                                            <td><img src="../teacher/uploads/<?php echo $row['image'];  ?>" style="width:100px"></td>
                                            <td><?php echo $row['teacher_name'];  ?></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
<?php }elseif($_GET['option_none']==''){ 
    $sql="SELECT * FROM course";
    $rs=$con->query($sql);
    ?>
    <table class="table table-bordered" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>Image</th>
                                            <th>Teacher Name</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    while($row=$rs->fetch_assoc())
                                    {
                                    ?>
                                        <tr>
                                            <td><?php echo $row['name'];  ?></td>
                                            <td><?php echo $row['description'];  ?></td>
                                            <td><img src="../teacher/uploads/<?php echo $row['image'];  ?>" style="width:100px"></td>
                                            <td><?php echo $row['teacher_name'];  ?></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                                <?php } ?>