<?php include('partials/menu.php'); ?>

<div class="content">
    <div class="wrapper">
        <h1>Change Password</h1>

        <br/><br/>


        <?php 
            if(isset($_GET['id']))
            {
                $id=$_GET['id'];
            }
        ?>

        <form action="" method="POST"></form>

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
                        <input type="submit" name="submit" value="Change Password" class="btn-update">
                    </td>
                </tr>


            </table>
    </div>
</div>

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
                $count=mysqli_num_rows($res); //check data

                if($count==1)
                {
                    //user exist
                    echo "User Found";
                }
                else
                {
                    //user not exist
                    $_SESSION['user-not-found'] = "<div class='error'> User Not Found. </div>";

                    header('location:'.HOMEPAGE.'back-end/manage-admin.php');
                }
            }
        //check new and confirm matched

        //change pass


    }

?>


<?php include ('partials/footer.php'); ?>