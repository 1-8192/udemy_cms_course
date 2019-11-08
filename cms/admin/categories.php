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
                                <form action="">
                                    <div class="form-group">
                                        <label for="cat_title">Add Category</label>
                                        <input clas="form-control" type="text" name="cat_title">
                                    </div>
                                    <div class="form-group">
                                        <input class="btn btn-primary" type="submit" name="Add Category">
                                    </div>
                                </form>
                            </div>
                            <?php 
                              //grabbing categories from db
                              $query = "SELECT * FROM categories";
                              $stmt = $pdo->query($query);
                              $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                            ?>
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
                                            //looping through category names
                                            if (count($rows) > 0) {
                                                foreach($rows as $row) {
                                                    echo('<tr><td>'."$row[cat_id]".'</td><td>'."$row[cat_title]".'</td></tr>');
                                                }
                                            }
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