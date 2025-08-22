<?php
include("db.php");
$tid=$_POST['teacher_id'];
$examid=$_POST['exam_id'];
$sql="SELECT * FROM teacher WHERE id='$tid'";
$res=$con->query($sql);
$row=$res->fetch_assoc();

$teacher_name=$row['name'];
$up="UPDATE exam SET teacher_id='$tid',teacher_name='$teacher_name' WHERE id='$examid'";
$con->query($up);
?>
<table class="table table-bordered" id="result" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Duration(hrs)</th>
                                            <th>Date</th>
                                            <th>Start time</th>
                                            <th>Assign</th>
                                            <th>Teacher Name</th>
                                        </tr>
                                    </thead>
                                    <tbody >
                                    <?php
                                    include("db.php");
                                    $sql2="SELECT * FROM exam_status WHERE status='upcoming'";
                                    $res2=$con->query($sql2);
                                    while($row2=$res2->fetch_assoc())
                                    {
                                        $exam_id=$row2['exam_id'];
                                        $sql3="SELECT * FROM exam WHERE id='$exam_id'";
                                        $res3=$con->query($sql3);
                                        while($row3=$res3->fetch_assoc())
                                        {
                                    ?>
                                        <tr>
                                            <td><?php echo $row3['exam_name'];  ?></td>
                                            <td><?php echo $row3['duration'];  ?></td>
                                            <td><?php echo $row3['exam_date'];  ?></td>
                                            <td><?php echo $row3['exam_start'];  ?></td>
                                            <td>
                                                <select id="teacherSelect<?php echo $row3['id']; ?>" name="assign" class="form-control" onchange="assignTeacher(<?php echo $row3['id']; ?>)">
                                                <option value="">Teacher Assigned</option>
                                                </select><input name="examid" type="hidden" value="<?php echo $row3['id'];  ?>">
                                            </td>
                                                <td><?php echo $row3['teacher_name'] ?></td>
                                                
                                        </tr>
                                        <?php }} ?>
                                    </tbody>
                            </table>