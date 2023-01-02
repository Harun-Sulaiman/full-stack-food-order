<?php include ('../config/constants.php'); ?>
<?php ob_start(); ?>
<?php session_start();
    //check enter 
    if(isset($_POST['submit']))
    {
        //get data
        $user_name = $_POST['user_name'];
        $password = md5($_POST['password']);

        //sql query check
        $sql = "SELECT * FROM admin WHERE user_name='$user_name' AND password='$password'";

        //execute query
        $res = mysqli_query($conn, $sql);

        //count database to check the user
        $count = mysqli_num_rows($res);

            if($count==1)
            {
                //user correct
                $_SESSION ['login'] = "<div class='success'>Login Success.</div>";
                $_SESSION ['user'] = $user_name; //check user logged

                header('location:'.HOMEPAGE.'back-end/');
                exit();
                ob_end_flush();
            }
            else
            {
                //no user
                $_SESSION ['login'] = "<div class='error text-center'>Wrong Username or Password.</div>";
                header('location:'.HOMEPAGE.'back-end/login.php');
                exit();
                ob_end_flush();
            }
    }

?>

<html>
    <head>
        <title>Login</title>
        <link rel="stylesheet" href="../css/admin-page.css">
    </head>

    <body>
        <div class="login">
            <h1 class="text-center">Log In</h1>
            <br/>
            <form action="" method="POST">
                    
                <div class="div-login">
                    <input type="text" name="user_name" placeholder="Enter Username">
                    <br /><br />
                    
                    <input type="password" name="password" placeholder="Enter Password">
                    <br /><br />
                        
                    <input type="submit" name="submit" value="Enter" class="btn-login2">
                </div>
            </form>

            <br/><br/>
            <?php
                if(isset($_SESSION['login']))
                {
                    echo $_SESSION['login'];
                    unset ($_SESSION['login']);
                }

                if(isset($_SESSION['no-login']))
                {
                    echo $_SESSION['no-login'];
                    unset ($_SESSION['no-login']);
                }
            ?>

        <br /><br />
            <p class="text-center">IMS607 Food Order & Management System</p>

        </div>



    </body>
</html>
