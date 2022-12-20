<?php include('partials/menu.php'); ?>

<div class="content">
    <div class="wrapper">
        <h1>Update Category</h1>

        <br /><br />

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" value="">
                    </td>
                </tr>

                <tr>
                    <td>Current Image: </td>
                    <td>
                        Image Here
                    </td>
                </tr>

                <tr>
                    <td>New Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Featured Menu: </td>
                    <td>
                        <input type="radio" name="featured_menu" value="Yes"> Yes
                        <input type="radio" name="featured_menu" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td> Active Menu: </td>
                    <td>
                        <input type="radio" name="active_menu" value="Yes"> Yes
                        <input type="radio" name="active_menu" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>
                        <input type="submit" name="submit" value="Update Category" class="btn-update">
                    </td>
                </tr>

            </table>
        </form>


    </div>
</div>




<?php include ('partials/footer.php'); ?>