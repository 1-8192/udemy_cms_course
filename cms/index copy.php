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
        <?php 
            if (isset($_SESSION['success'])) {
                $message = $_SESSION['success'];
                echo '<p class="text-center" style="color:green">'."$message".'</p>';
                unset($_SESSION['success']);
            }
        ?>

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
            <h1 class="page-header">
                    Blog Articles
        
                <?php 
                    //grabbing posts and looping through to populate posts in index
                    $query = "SELECT * FROM posts WHERE post_status = 'published'";
                    $stmt = $pdo->query($query);
                    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    if (count($rows) > 0) {
                        foreach($rows as $row) {
                            $post_id = $row['post_id'];
                            $post_title = $row['post_title'];
                            $post_author = $row['post_author'];
                            $post_date = $row['post_date'];
                            $post_image = $row['post_image'];
                            $post_body = substr($row['post_body'], 0, 120);
                 ?>
                </h1>

                <!-- Blog Posts -->
                <h2>
                    <a href="post.php?p_id=<?php echo $post_id ?>"><?php echo $post_title ?></a>
                </h2>
                <p class="lead">
                    by <a href="author_posts.php?author=<?php echo $post_author ?>"><?php echo $post_author ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date ?></p>
                <hr>
                <a href="post.php?p_id=<?php echo $post_id ?>" alt="post-header-image"><img class="img-responsive" src="images/<?php echo $post_image ?>" alt=""></a>
                <hr>
                <p><?php echo $post_body ?></p>
                <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>



                        <?php } 
                } else {
                    echo '<h2 class="text-center">No approved posts, sorry :-(</h2>';
                }
                ?>
           

                <hr>


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
