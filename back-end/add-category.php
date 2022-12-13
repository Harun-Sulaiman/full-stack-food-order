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

        <br /><br />

            <?php
                if(isset($_SESSION['add-category']))
                {
                    echo $_SESSION['add-category'];
                    unset ($_SESSION['add-category']);
                }
            ?>


        <?php
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
                        $source_path = $_FILES['image']['tmp_name'];
                        $destination_path = "../images/category/".$image_name;

                        //upload
                        $upload = move_uploaded_file($source_path, $destination_path);
                    }
                    else
                    {
                        //dont upload, change to blank
                        $image_name = "";
                    }

                //sql query
                $sql = "INSERT INTO category SET
                    title = '$title',
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
                }
                else
                {
                    //failed
                    $_SESSION['add-category'] = "<div class='error'> Add Category Failed. </div>";
                    //redirect
                    header('location:'.HOMEPAGE.'back-end/add-category.php');
                }
            }
        ?>

    </div>
</div>






<?php include('partials/footer.php')?>