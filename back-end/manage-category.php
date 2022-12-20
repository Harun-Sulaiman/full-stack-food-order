<?php include('partials/menu.php'); ?>

<div class="content">
    <div class="wrapper">
        <h1>Manage Category</h1>

        <br /><br />

        <a href="<?php echo HOMEPAGE; ?>back-end/add-category.php" class="btn-add">Add Category<a/>

        <br /><br /><br /><br />

        <table class="tbl-full">
            <tr>
                <th>No.</th>
                <th>Title</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>

            <?php
                //query qet all from DB
                $sql = "SELECT * FROM category";

                //execute
                $res = mysqli_query($conn,$sql);

                //count rows
                $count = mysqli_num_rows($res);

                //create number of list for the table
                $sn=1;

                //check data in DB
                if($count>0)
                {
                    //have data
                    //get to display
                    while($row=mysqli_fetch_assoc($res))
                    {
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];
                        $featured_menu = $row['featured_menu'];
                        $active_menu = $row['active_menu'];
                        
                            //add html between php
                            ?>
                                <tr>
                                    <td><?php echo $sn++; ?>.</td>
                                    <td><?php echo $title; ?></td>

                                    <td>

                                        <?php 
                                            //check if image not empty
                                            if($image_name!="")
                                            {
                                                //display image. break php tu put html
                                                ?>
                                                    <img src="<?php echo HOMEPAGE; ?>images/category/<?php echo $image_name; ?>" width="150px"/>
                                                <?php
                                            }
                                            else
                                            {
                                                //display msg
                                                echo "<div class='error'>No Image Available.</div>";
                                            }
                                        ?>
                                    </td>

                                    <td><?php echo $featured_menu; ?></td>
                                    <td><?php echo $active_menu; ?></td>
                                    <td>
                                        <a href="<?php echo HOMEPAGE; ?>back-end/update-category.php?id=<?php echo $id; ?>" class="btn-update">Update</a>
                                        <a href="<?php echo HOMEPAGE; ?>back-end/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-delete">Delete</a>
                                    </td>
                                </tr>
                            <?php
                    }
                }
                else
                {
                    //no data
                    //create msg inside table
                    ?>
                        <tr>
                            <td colspan="6"><div class="error">No Category.</div></td>
                        </tr>

                    <?php
                }
            ?>


        </table>
        
            <?php
                if(isset($_SESSION['add-category']))
                {
                    echo $_SESSION['add-category'];
                    unset ($_SESSION['add-category']);
                }

                if(isset($_SESSION['remove-category']))
                {
                    echo $_SESSION['remove-category'];
                    unset ($_SESSION['remove-category']);
                }

                if(isset($_SESSION['delete-category']))
                {
                    echo $_SESSION['delete-category'];
                    unset ($_SESSION['delete-category']);
                }
            ?>

    </div>
</div>



<?php include ('partials/footer.php'); ?>