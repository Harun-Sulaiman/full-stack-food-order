<?php include ('partials/menu.php'); ?>

<div class="content">
    <div class="wrapper">
        <h1>Update Admin</h1>

        <br/><br/>

        <?php 
        
            //retrive current admin to update
            $id=$_GET['id']; 

            //sql query
            $sql="SELECT * FROM admin WHERE id=$id";

            //execute
            $res=mysqli_query($conn, $sql);

            //check 
            if($res==true)
            {
                $count = mysqli_num_rows($res); //check data

                if($count==1)
                {
                    //details
                    $rows=mysqli_fetch_assoc($res);

                    $full_name = $rows['full_name'];
                    $user_name = $rows['user_name'];

                }
                else
                {
                    //no data, redirect to admin page
                    header('location:'.HOMEPAGE.'back-end/manage-admin.php');
                }

            }
        
        ?>

        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>
                        Full Name: 
                    </td>
                    <td>
                        <input type="text" name="full_name" value="<?php echo $full_name; ?>">
                    </td>
                </tr>

                <tr>
                    <td>
                        Username:
                    </td>
                    <td>
                        <input type="text" name="user_name" value="<?php echo $user_name; ?>">
                    </td>
                </tr>


                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value ="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Admin" class="btn-add">

                    </td>
                </tr>
            </table>
    </div>
</div>

<?php

    //check submit/not
    if(isset($_POST['submit']))
    {
        //echo "Button clicked";
        //get value from form
        $id =  $_POST['id'];
        $full_name = $_POST['full_name'];
        $user_name = $_POST['user_name'];

        //sql query to update database admin
        $sql = "UPDATE admin SET
        full_name = '$full_name',
        user_name = '$user_name'
        WHERE id = '$id'
        ";

        //execute query
        $res = mysqli_query($conn,$sql);

        //check
        if($res==true)
        {
            //updated
            $_SESSION ['update'] = "<div class='success'>Admin Updated.</div>";
            header('location:'.HOMEPAGE.'back-end/manage-admin.php');
        }
        else
        {
            //failed
            $_SESSION ['update'] = "<div class='error'>Update Failed.</div>";
            header('location:'.HOMEPAGE.'back-end/manage-admin.php');
        }

    }




?>









<?php include ('partials/footer.php'); ?>