<?php include('partials/menu.php'); ?>

<div class="content">
    <div class="wrapper">
        <h1>Manage Category</h1>

        <br /><br />

        <a href="<?php echo HOMEPAGE; ?>back-end/add-category.php" class="btn-add">Add Category<a/>

        <br /><br />
        
            <?php
                if(isset($_SESSION['add-category']))
                {
                    echo $_SESSION['add-category'];
                    unset ($_SESSION['add-category']);
                }
            ?>

    </div>
</div>



<?php include ('partials/footer.php'); ?>