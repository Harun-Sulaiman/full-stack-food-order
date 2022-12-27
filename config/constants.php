<?php
        //session
    session_start();


        //store no repeat
    define('HOMEPAGE','http://localhost/ims607-food-order/full-stack-food-order/');
    //define('LOCALHOST','localhost');
    //define('DB_USERNAME','root');
    //define('DB_PASSWORD','');
    //define('DB_NAME','ims607');

    define('LOCALHOST','localhost');
    define('DB_USERNAME','ricomtrc_8ag5'); //online
    define('DB_PASSWORD','8ag5#vHy@2938'); //online
    define('DB_NAME','ricomtrc_8ag5'); //online

        //for live database use this code, $conn = mysqli_connect('localhost','username','passsword') or die(mysqli_error());
    $conn = mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD) or die(mysqli_error()); //connect database
    $db_select = mysqli_select_db($conn,DB_NAME) or die(mysqli_error()); //select db, change the 'ims607'




?>