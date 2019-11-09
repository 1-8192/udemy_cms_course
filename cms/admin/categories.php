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
                                <?php 
                                    //logic for posting new category to db
                                    if (isset($_POST['submit'])) {
                                        $cat_title = $_POST['cat_title'];

                                        if ($cat_title === "" || empty($cat_title)) {
                                            echo "Empty field.";
                                        } else {
                                            $query = "INSERT INTO categories (cat_title) VALUES (:title)";
                                            $stmt = $pdo->prepare($query);
                                            $check = $stmt->execute(array(':title' => $cat_title));
                                        }
                                    }
                                ?>
                                <form action="" method="POST">
                                    <div class="form-group">
                                        <label for="cat_title">Add Category</label>
                                        <input class="form-control" type="text" name="cat_title">
                                    </div>
                                    <div class="form-group">
                                        <input class="btn btn-primary" type="submit" name="submit" value="Add">
                                    </div>
                                <?php 
                                    //update logic
                                    if (isset($_GET['edit'])) {
                                        $cat_id = $_GET['edit'];

                                        $query = 'SELECT * FROM categories WHERE cat_id = :cid';
                                        $stmt = $pdo->prepare($query);
                                        $stmt->execute(array(':cid' => $cat_id));
                                        $row = $stmt->fetch(PDO::FETCH_ASSOC);
                                        $cat_title = $row['cat_title'];
                                        $cat_id = $row['cat_id'];
                                    }

                                    if (isset($_POST['update'])) {
                                        $cat_title = $_POST['cat_title'];
                                        $query = "UPDATE categories SET cat_title = :ctitle WHERE cat_id = :cid";
                                        $stmt = $pdo->prepare($query);
                                        $stmt->execute(array(
                                            ':cid' => $cat_id,
                                            ':ctitle' => $cat_title));
                                        header("location: categories.php");
                                    }

                                    //conditional HTML display for update form
                                    if (isset($row)) {
                                        echo('</form>
                                        <form action="" method="POST">
                                            <div class="form-group">
                                                <label for="cat_title">Update Category</label>
                                                <input class="form-control" type="text" name="cat_title" value='."$cat_title".'>
                                            </div>
                                            <div class="form-group">
                                                <input class="btn btn-primary" type="submit" name="update" value="Update">
                                            </div>
                                        </form>');
                                    }    
                                ?>
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
                                            //looping through category ids and names
                                            if (count($rows) > 0) {
                                                foreach($rows as $row) {
                                                    echo('<tr><td>'."$row[cat_id]".'</td><td>'."$row[cat_title]".'</td><td><a href="categories.php?delete='."$row[cat_id]".'">Delete</a></td><td><a href="categories.php?edit='."$row[cat_id]".'">Edit</a></td></tr>');
                                                }
                                            }
                                        ?>

                                        <?php 
                                            // deleting category logic
                                            if (isset($_GET['delete'])) {
                                                $cat_id = $_GET['delete'];

                                                $query = "DELETE FROM categories WHERE cat_id = :cid";
                                                $stmt = $pdo->prepare($query);
                                                $stmt->execute(array(':cid' => $cat_id));
                                                //refresh after delete
                                                header("Location: categories.php");
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