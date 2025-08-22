<p>Assign Duty to Teacher</p>
                        <p><select name="tid" id="teacher" class="form-control">
                            <option value="">Select Teacher</option>
                            <?php
                            include("db.php");
                            $sql="SELECT * FROM teacher";
                            $res=$con->query($sql);
                            while($row=$res->fetch_assoc())
                            {
                            ?>
                            <option value="<?php echo $row['id'] ?>"><?php echo $row['name']; ?></option>
                            <?php } ?>
                        </select></p>
                        <p><textarea name="message" class="form-control"></textarea></p>