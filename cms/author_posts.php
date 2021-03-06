<!DOCTYPE html>
<html lang="en">
<?php include_once "includes/db.php" ?>
<!-- header -->
<?php include_once "includes/header.php"; ?>
<body>

    <!-- Navigation -->
    <?php include_once "includes/navigation.php"; ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
                <?php 
                    if (isset($_GET['author'])) {
                        $post_author = $_GET['author'];
                        $query = "SELECT * FROM posts WHERE post_author = :auth";
                        $stmt = $pdo->prepare($query);
                        $stmt->execute(array(':auth' => $post_author));
                        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        if (count($rows) > 0) {
                            foreach($rows as $row) {
                                $post_id = $row['post_id'];
                                $post_title = $row['post_title'];
                                $post_author = $row['post_author'];
                                $post_date = $row['post_date'];
                                $post_image = $row['post_image'];
                                $post_body = $row['post_body'];
            
                ?>
                <!-- First Blog Post -->
                <h2>
                    <a href="#"><?php echo $post_title ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_author ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date ?></p>
                <?php 
                    if (isset($_SESSION['user_name'])) {
                        echo '<a href="admin/posts.php?source=edit_post&p_id='."$post_id".'">Edit Post</a>';
                    }
                    ?>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image ?>" alt="">
                <hr>
                <p><?php echo $post_body ?></p>
           
                <hr>
                <?php include_once "includes/post_comments.php" ?>
                <?php 
                }
            }
        }
            ?>

            <!-- Blog Sidebar Widgets Column -->
            <?php include_once "includes/sidebar.php"; ?>

        <!-- /.row -->

        <hr>
        </div>
        <!-- Footer -->
        <?php include_once "includes/footer.php"; ?>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>