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
                                    echo "checked";
                                } 
                            ?> 
                            
                        type="radio" name="featured_menu" value="Yes"> Yes

                        <input 
                            <?php 
                                if($featured_menu=="No")
                                {
                                    echo "checked";
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
                                    echo "checked";
                                } 
                            ?> 
                        type="radio" name="active_menu" value="Yes"> Yes

                        <input 
                            <?php 
                                if($active_menu=="No")
                                {
                                    echo "checked";
                                } 
                            ?> 
                        type="radio" name="active_menu" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Category" class="btn-update">
                    </td>
                </tr>

            </table>
        </form>

        <?php
            if(isset($_POST['submit']))
            {
                //echo "clicked";
                //get all values from form
                $id = $_POST['id'];
                $title = $_POST['title'];
                $current_image = $_POST['current_image'];
                $featured_menu = $_POST['featured_menu'];
                $active_menu = $_POST['active_menu'];

                //update new images if uploaded
                if(isset($_FILES['image']['name']))
                {
                    //get the image details
                    $image_name = $_FILES['iamge']['name'];

                    //check if image uploaded
                    if($image_name !="")
                    {
                        //if image uploaded
                        //1st - upload the new image
                        //renaming duplicate images
                                //get extension of image
                                $ext = end(explode('.', $image_name));

                                //after that randomize rename image
                                $image_name = "Food_Category_".rand(000,999).'.'.$ext;

                            $source_path = $_FILES['image']['tmp_name'];
                            $destination_path = "../images/category/".$image_name;
                            
                            //upload
                            $upload = move_uploaded_file($source_path, $destination_path);

                            //check wether the image is uploaded
                            //if not uploaded, stop process, redirect
                            if($upload==false)
                            {
                                //session
                                $_SESSION['upload'] = "<div class='error'> Image Upload Failed. </div>";
                                header('location:'.HOMEPAGE.'back-end/manage-category.php');
                                //stop process
                                die();
                            }

                        //2nd - remove current image if uploaded
                        if($current_image != "")
                        {
                            $remove_path = "../images/category/".$current_image;

                            $remove = unlink($remove_path);
                            
                                //check if image removed
                                if($remove==false)
                                {
                                    //failed
                                    $_SESSION['remove-failed'] = "<div class='error'> Failed To Remove Current Image. </div>";
                                    header('location:'.HOMEPAGE.'back-end/manage-category.php');
                                    die();
                                }
                        }
                       
                    }
                    else
                    {
                        $image_name = $current_image;
                    }
                }
                else
                {
                    $image_name = $current_image;
                }
            

                //save all to DB
                $sql2 = "UPDATE category SET
                    title = '$title',
                    image_name = '$image_name',
                    featured_menu = '$featured_menu',
                    active_menu = '$active_menu'
                    WHERE id=$id
                ";

                    //execute query
                    $res2 = mysqli_query($conn, $sql2);

                    //check the query if executed
                    if($res2==true)
                    {
                        //category updated
                        $_SESSION['update-category'] = "<div class='success'> Category Updated.</div>";
                        header('location:'.HOMEPAGE. 'back-end/manage-category.php');
                    }
                    else
                    {
                    //failed to update category 
                        $_SESSION['update-category'] = "<div class='error'> Category Failed To Update.</div>";
                        header('location:'.HOMEPAGE. 'back-end/manage-category.php');
                    }
            }
        ?>


    </div>
</div>




<?php include ('partials/footer.php'); ?>