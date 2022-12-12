<?php include ('partials/menu.php'); ?>

<div class="content">
    <div class="wrapper">
        <h1>Add Admin</h1>

        <br /><br />

        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>
                        Full Name: 
                    </td>
                    <td>
                        <input type="text" name="full_name" placeholder="Enter your name">
                    </td>
                </tr>

                <tr>
                    <td>
                        Username:
                    </td>
                    <td>
                        <input type="text" name="user_name" placeholder="Enter your username">
                    </td>
                </tr>

                <tr>
                    <td>
                        Password:
                    </td>
                    <td>
                        <input type="password" name="password" placeholder="Enter your password">
                    </td>
                </tr>

                <tr>

                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-add">

                    </td>
                </tr>
            </table>

            <br />
                <div>
                    <?php
                        if(isset($_SESSION['add'])) //check create success/not success
                        {
                            echo $_SESSION['add']; //display
                            unset ($_SESSION['add']); //remove after refresh
                        }
                    ?>
                </div>
        </form>

    </div>
</div>


<?php include ('partials/footer.php'); ?>

<?php
    //form save>database
    //check submit or not

    if(isset($_POST['submit']))
    {
        //submitted
        
        //1.data entered
        $full_name = $_POST['full_name'];
        $user_name = $_POST['user_name'];
        $password = md5($_POST['password']); //encrypt password with md5

        //2.SQL query save into database
        $sql = "INSERT INTO admin SET
            full_name='$full_name',
            user_name='$user_name',
            password='$password'
        ";

        //3. execute the sql query submit into database (success or error)
        // the codes inside constants.php
        $res = mysqli_query($conn,$sql) or die(mysqli_error());

        //4. check data
        if($res==TRUE)
        {
            //var display message
            $_SESSION['add'] = "<div class='success'>Admin Successfully Added</div>";
            //direct to homepage then to manage admin page
            header("location:".HOMEPAGE.'back-end/manage-admin.php');
        }
        else
        {
            //var display message
            $_SESSION['add'] = "<div class='error'>Add Admin Failed</div>";
            //direct to homepage then to add admin page
            header("location:".HOMEPAGE.'back-end/add-admin.php');
        }







    }

?>