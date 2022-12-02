<?php include ('partials/menu.php'); ?>

<div class="content">
    <div class="wrapper">
        <h1>Add Admin</h1>

        <br/><br/>

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

        //for live database use this code, $conn = mysqli_connect('localhost','username','passsword') or die(mysqli_error());
        $conn = mysqli_connect('localhost','root','') or die(mysqli_error()); //connect database
        $db_select = mysqli_select_db($conn,'ims607') or die(mysqli_error()); //select db, change the 'ims607'


       // $res = mysqli_query($conn,$sql) or die(mysqli_error());

    }

?>