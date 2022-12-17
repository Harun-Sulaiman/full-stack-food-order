<?php
    //include constants.php
    include('../config/constants.php');

    //check id and image's name
    if(isset($_GET['id']) AND isset($_GET['image_name']))
    {
        //get value and delete after
        //echo "get value";
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        //remove there an image file
        if($image_name != "")
        {
            //image available
            $path = "../images/category/".$image_name;

            //remove the file
            $remove = unlink($path);

            //if failed to remove
            if($remove==false)
            {
                //set session > redirect > stop process
                $_SESSION['remove-category'] = "<div class='error'>Failed to Remove Image's File</div>";
                header('location'.HOMEPAGE.'back-end/manage-category.php');

            }
        }

        //delete data from DB - query
        $sql = "DELETE FROM category WHERE id=$id";

            //execute
            $res = mysqli_query($conn,$sql);

            //check if deleted
            if($res==true)
            {
                //success msg and redirect
                $_SESSION['delete-category'] = "<div class='success'>Category Deleted</div>";
                header('location'.HOMEPAGE.'back-end/manage-category.php');
            }
            else
            {
                //failed msg and redirect
                $_SESSION['delete-category'] = "<div class='error'>Failed to Delete</div>";
                header('location'.HOMEPAGE.'back-end/manage-category.php');
            }
        
    }
    else
    {
        //redirect to manage category's page
        header ('location:'.HOMEPAGE.'back-end/manage-category.php');
    }
?>