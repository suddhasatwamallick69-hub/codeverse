<?php
include("db.php");
if(isset($_GET['option']))
{
$option=$_GET['option'];
$sql="SELECT * FROM teacher WHERE name LIKE '%$option%'";
$res=$con->query($sql);
?>
<table class="table table-bordered" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Username</th>
                                            <th></th>
                                            <th>EDIT</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    while($row=$res->fetch_assoc())
                                    {
                                    ?>
                                        <tr>
                                            <td><?php echo $row['name'];  ?></td>
                                            <td><?php echo $row['email'];  ?></td>
                                            <td><?php echo $row['username'];  ?></td>
                                            <td><a href="teacher_details.php?tid=<?php echo $row['id'];  ?>">View More Details</a></td>
                                            <td><a class="btn btn-success" href="edit_details.php?tid=<?php echo $row['id'];  ?>">Edit Details</a></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>

<?php 
} 
elseif($_GET['option_none']=='')
{ 
$sql="SELECT * FROM teacher";
$res=$con->query($sql);
    ?>
    <table class="table table-bordered" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Username</th>
                                            <th></th>
                                            <th>EDIT</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    while($row=$res->fetch_assoc())
                                    {
                                    ?>
                                        <tr>
                                            <td><?php echo $row['name'];  ?></td>
                                            <td><?php echo $row['email'];  ?></td>
                                            <td><?php echo $row['username'];  ?></td>
                                            <td><a href="teacher_details.php?tid=<?php echo $row['id'];  ?>">View More Details</a></td>
                                            <td><a class="btn btn-success" href="edit_details.php?tid=<?php echo $row['id'];  ?>">Edit Details</a></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                                <?php } ?>