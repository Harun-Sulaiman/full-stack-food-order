<?php
    //include constants.php for homepage redirect
    include('../config/constants.php');

    //close all session and logout
    session_destroy();

    //redirect login page
    header('location:'.HOMEPAGE.'back-end/login.php');


?>