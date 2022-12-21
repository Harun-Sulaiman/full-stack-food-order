<?php include('partials/menu.php'); ?>

<div class="content">
    <div class="wrapper">
        <h1>Update Category</h1>

        <br /><br />

        <?php

            //check id
            if(isset($_GET['id']))
            {
                //get id
                $id = $_GET['id'];
                
                //sql query to get other data with that id
                $sql = "SELECT * FROM category WHERE id=$id";

                //execute
                $res = mysqli_query($conn, $sql);

                //count rows id
                $count = mysqli_num_rows($res);
                
                    if($count==1)
                    {
                        //get data
                         $row = mysqli_fetch_assoc($res);

                         //individual data
                        $title = $row['title'];
                        $current_image = $row['image_name'];
                        $featured_menu = $row['featured_menu'];
                        $active_menu = $row['active_menu'];
                    }
                    else
                    {
                        //redirect
                        $_SESSION['no-category-found'] = "<div class='error'>Category Not Found.</div>";
                        header('location:'.HOMEPAGE.'back-end/manage-category.php');
                    }

            }
            else
            {
                //redirect
                header('location:'.HOMEPAGE.'back-end/manage-category.php');
            }

        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Current Image: </td>
                    <td>
                        <?php 
                            if($current_image !="")
                            {
                                //display image //break php to add html
                                ?> 
                                    <img src="<?php echo HOMEPAGE; ?>images/category/<?php echo $current_image;?>" width="150px">
                                <?php
                            }
                            else
                            {
                                //display error
                                echo "<div class='error'> Image Not Added.</div>";
                            }
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>New Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Featured Menu: </td>
                    <td>
                        <input 
                            <?php 
                                if($featured_menu=="Yes")
                                {
                                    echo "Selected";
                                } 
                            ?> 
                            
                        type="radio" name="featured_menu" value="Yes"> Yes

                        <input 
                            <?php 
                                if($featured_menu=="No")
                                {
                                    echo "Selected";
                                } 
                            ?> 
                        type="radio" name="featured_menu" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td> Active Menu: </td>
                    <td>
                        <input 
                            <?php 
                                if($active_menu=="Yes")
                                {
                                    echo "Selected";
                                } 
                            ?> 
                        type="radio" name="active_menu" value="Yes"> Yes

                        <input 
                            <?php 
                                if($active_menu=="No")
                                {
                                    echo "Selected";
                                } 
                            ?> 
                        type="radio" name="active_menu" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>
                        <input type="submit" name="submit" value="Update Category" class="btn-update">
                    </td>
                </tr>

            </table>
        </form>


    </div>
</div>




<?php include ('partials/footer.php'); ?>