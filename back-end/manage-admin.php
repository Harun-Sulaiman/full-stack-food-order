<?php include ('partials/menu.php'); ?>

        <div class=Content>
            <div class="wrapper">
                <h1>Manage Admin</h1>
                <br/> <br/>
                <a href="add-admin.php" class="btn-add">Add Admin</a>

                <br/> <br/> <br/>

                <table class="tbl-full">
                    <tr>
                        <th>S.No.</th>
                        <th>Full Name</th>
                        <th>Username</th>
                        <th>Actions</th>
                    </tr>

                    <?php
                        //retrieve all admins from database
                        $sql = "SELECT * FROM admin";
                        $res = mysqli_query($conn, $sql); //connect sql

                        if($res==TRUE) //check database for data
                        {
                            $count = mysqli_num_rows($res); //retrieve all rows
                            
                            $sn=1;//create number for data

                            if($count>0)
                            {
                                //if have > retrieve
                                while($rows=mysqli_fetch_assoc($res))
                                {
                                    //retreive each
                                    $id=$rows['id'];
                                    $full_name=$rows['full_name'];
                                    $user_name=$rows['user_name'];

                                    //display after retrieved

                                ?>
                                    <tr>
                                        <td><?php echo $sn++;?>.</td>
                                        <td><?php echo $full_name; ?></td>
                                        <td><?php echo $user_name; ?></td>
                                        <td>
                                            <a href="#" class="btn-update">Update</a>
                                            <a href="<?php echo HOMEPAGE; ?>back-end/delete-admin.php?id=<?php echo $id; ?>" class="btn-delete">Delete</a>
                                        </td>
                                    </tr>
                                <?php

                                }
                            }
                          
                        }
                        else
                        {
                            //no data
                        }


                    ?>


                </table>

                <br />
                
                    <?php //variable session part
                        if(isset($_SESSION['add'])) //variable session add
                        {
                            echo $_SESSION['add']; //display
                            unset ($_SESSION['add']); //remove after refresh
                        }
                    ?>

                    <?php
                        if(isset($_SESSION['delete'])) //variable session delete
                        {
                            echo $_SESSION['delete']; //display
                            unset ($_SESSION['delete']); //remove after refresh
                        }
                    ?>
                


            </div>
        </div>

<?php include ('partials/footer.php'); ?>
