<?php include ('../config/constants.php'); ?>
<?php ob_start(); ?>
<?php
        if(isset($_POST['submit']))
    {
        header("location:".HOMEPAGE.'back-end/manage-admin.php');
        ob_end_flush();

    }

?>

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

