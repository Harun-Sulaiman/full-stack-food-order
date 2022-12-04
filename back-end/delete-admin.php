<?php

    //include constants.php
    include('../config/constants.php');

    //1. get id of admin
    $id = $_GET ['id'];

    //2. create instruction to delete
    $sql = "DELETE FROM admin WHERE id=$id";

        // execute
        $res = mysqli_query($conn, $sql);

        //success or not
        if($res==true)
        {
            //success
            //echo "Admin Successfully Deleted";
            //var display message
            $_SESSION['delete'] = "<div class='success'>Admin Successfully Deleted</div>";
            //direct to homepage then to manage admin page
            header("location:".HOMEPAGE.'back-end/manage-admin.php');
        }
        else
        {
            //failed
            //echo "Failed to Delete";
             //var display message
             $_SESSION['delete'] = "<div class='error'>Delete Admin Failed</div>";
             //direct to homepage then to add admin page
             header("location:".HOMEPAGE.'back-end/manage-admin.php');
        }
    //3. redirect to manage-admin page if success/error


?>