<?php include ('../config/constants.php'); ?>
<?php ob_start(); ?>

<?php session_start();
            //check button submit
            if(isset($_POST['submit']))
            {
                //get value from form
                $title = $_POST['title'];

                    //input=radio need check if selected
                    if(isset($_POST['featured_menu']))
                    {
                        //get value
                        $featured_menu = $_POST['featured_menu'];
                    }
                    else
                    {
                        //if no select then set to default No
                        $featured_menu = "No";
                    }

                    if(isset($_POST['active_menu']))
                    {
                        $active_menu = $_POST['active_menu'];
                    }
                    else
                    {
                        $active_menu = "No";
                    }

                    //check if image selected
                    //print_r($_FILES['image']);

                    //die(); //dont upload to DB

                    if(isset($_FILES['image']['name']))
                    {
                        //upload image
                        //get image name/source path/destination
                        $image_name = $_FILES['image']['name'];
                        
                        //save if image uploaded
                        if($image_name !="")
                        {
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
                                header('location:'.HOMEPAGE.'back-end/add-category.php');
                                //stop process
                                die();
                                ob_end_flush();
                            }

                        }
                    }
                    else
                    {
                        //if there no image uploaded, change to blank
                        $image_name="";
                    }

                //sql query
                $sql = "INSERT INTO category SET
                    title = '$title',
                    image_name = '$image_name',
                    featured_menu = '$featured_menu',
                    active_menu = '$active_menu'
                ";

                //execute query
                $res = mysqli_query($conn, $sql);

                //check executed query
                if($res==true)
                {
                    //executed
                    $_SESSION['add-category'] = "<div class='success'> Category Added. </div>";
                    //redirect
                    header('location:'.HOMEPAGE.'back-end/manage-category.php');
                    exit();
                    ob_end_flush();
                }
                else
                {
                    //failed
                    $_SESSION['add-category'] = "<div class='error'> Add Category Failed. </div>";
                    //redirect
                    header('location:'.HOMEPAGE.'back-end/add-category.php');
                    exit();
                    ob_end_flush();
                }
            }
        ?>

<?php include('partials/menu.php')?>


<div class="content">
    <div class="wrapper">
        <h1>Add Category</h1>

        <br /><br />

        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Category Tittle">
                    </td>
                </tr>

                <tr>
                    <td>Upload Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Featured Menu: </td>
                    <td>
                        <input type="radio" name="featured_menu" value="Yes"> Yes
                        <input type="radio" name="featured_menu" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td> Active Menu: </td>
                    <td>
                        <input type="radio" name="active_menu" value="Yes"> Yes
                        <input type="radio" name="active_menu" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn-add">
                    </td>
                </tr>
            </table>
        </form>

        <br /><br /><br /><br />
        

            <?php
                if(isset($_SESSION['add-category']))
                {
                    echo $_SESSION['add-category'];
                    unset ($_SESSION['add-category']);
                }

                if(isset($_SESSION['upload']))
                {
                    echo $_SESSION['upload'];
                    unset ($_SESSION['upload']);
                }
            ?>
    </div>
</div>






<?php include('partials/footer.php')?>