<?php
    //authorization user
    
    //check logged in user
    if(!isset($_SESSION['user'])) //if there no user session (use ! in if)
    {
        //user not logged in
        //redirect to login page
        $_SESSION['no-login'] = "<div class='error text-center'> Please Log In To Access. </div>";

        //redirect
        header('location:'.HOMEPAGE. 'back-end/login.php');
    }
?>