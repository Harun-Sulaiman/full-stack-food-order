<?php include ('../config/constants.php'); ?>
<?php ob_start(); ?>
<?php 

    //check
    if(isset($_POST['submit']))
    {
        
        //get data
        $id=$_POST['id'];
        $current_password = md5($_POST['current_password']);
        $new_password = md5($_POST['new_password']);
        $confirm_password = md5($_POST['confirm_password']);

        //check id and pass
        $sql = "SELECT * FROM admin WHERE id=$id AND password='$current_password'";

            //execute
            $res = mysqli_query($conn, $sql);

            if($res==true)
            {
                //check data
                $count=mysqli_num_rows($res); 

                if($count==1)
                {
                    //user exist
                    //echo "User Found";
                    //check new and confirm
                    if($new_password==$confirm_password)
                    {
                        //update query
                        $sql2 = "UPDATE admin SET
                            password='$new_password'
                            WHERE id=$id
                        ";

                        //execute
                        $res2 = mysqli_query($conn, $sql2);

                        //check executed query
                        if($res2==true)
                        {
                            //display success
                            $_SESSION ['change-password-success'] = "<div class='success'> Password Changed. </div>";
                            header('location:'.HOMEPAGE.'back-end/manage-admin.php');
                            exit();
                            ob_end_flush();
                        }
                        else
                        {
                            //display error
                            $_SESSION ['change-password-failed'] = "<div class='error'> Failed To Change Password. </div>";
                            header('location:'.HOMEPAGE.'back-end/manage-admin.php');
                            exit();
                            ob_end_flush();
                        }

                    }
                    else
                    {
                        //redirect
                        $_SESSION ['password-not-match'] = "<div class='error'> Password Not Match. </div>";
                        header('location:'.HOMEPAGE.'back-end/manage-admin.php');
                        exit();
                        ob_end_flush();
                    }
                }

                else
                {
                    //user not exist
                    $_SESSION ['user-not-found'] = "<div class='error'> Error. User Not Found. </div>";

                    header('location:'.HOMEPAGE.'back-end/manage-admin.php');
                    exit();
                    ob_end_flush();
                }
            }
     }

?>

        <?php 
            if(isset($_GET['id']))
            {
                $id=$_GET['id'];
            }
        ?>

<?php include('partials/menu.php'); ?>

<div class="content">
    <div class="wrapper">
        <h1>Change Password</h1>

        <br /><br />


        

        <form action="" method="POST">

            <table class="tbl-40">
                <tr>
                    <td>Current Password</td>
                    <td>
                        <input type="password" name="current_password" placeholder="Current Password">
                    </td>
                </tr>

                <tr>
                    <td>New Password</td>
                    <td>
                        <input type="password" name="new_password" placeholder="New Password">
                    </td>
                </tr>

                <tr>
                    <td>Confirm Password</td>
                    <td>
                        <input type="password" name="confirm_password" placeholder="Confirm Password">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Change Password" class="btn-add">
                    </td>
                </tr>

            </table>
        </form>
    </div>
</div>




<?php include ('partials/footer.php'); ?>