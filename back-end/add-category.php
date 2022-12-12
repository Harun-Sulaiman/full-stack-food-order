<?php include('partials/menu.php')?>

<div class="content">
    <div class="wrapper">
        <h1>Add Category</h1>

        <br /><br />

        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Category Tittle">
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