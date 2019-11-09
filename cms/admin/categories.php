<!DOCTYPE html>
<html lang="en">

<?php include_once "includes/admin_header.php" ?>

<body>

    <div id="wrapper">
        <?php include_once "includes/admin_navigation.php" ?>
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome, Admin
                            <small>Author</small>
                        </h1>
                            <!-- Add category form -->
                            <div class="col-xs-6">
                                <!-- submit function for new category -->
                                <?php insert_categories(); ?>
                                <form action="" method="POST">
                                    <div class="form-group">
                                        <label for="cat_title">Add Category</label>
                                        <input class="form-control" type="text" name="cat_title">
                                    </div>
                                    <div class="form-group">
                                        <input class="btn btn-primary" type="submit" name="submit" value="Add">
                                    </div>
                                <?php include_once "includes/update_categories.php"; ?>
                            </div>
                            <div class="col-xs-6">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Title</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        //grabbing categories from db and inserting into table
                                         fetch_categories();
                                        ?>

                                        <?php 
                                            // deleting category logic
                                            delete_category();
                                        ?>
                                    </tbody>    
                                </table>
                            </div>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>