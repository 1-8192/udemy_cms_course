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

                    if (isset($_GET['category'])) {
                        $post_category_id = $_GET['category'];
                    }
                    //grabbing posts and looping through to populate posts in index
                    $query = "SELECT * FROM posts WHERE category_id = :cid";
                    $stmt = $pdo->prepare($query);
                    $stmt->execute(array(':cid' => $post_category_id));
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

                             <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- Blog Posts -->
                <h2>
                    <a href="post.php?p_id=<?php echo $post_id ?>"><?php echo $post_title ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_author ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image ?>" alt="">
                <hr>
                <p><?php echo $post_body ?></p>
                <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>



                        <?php } 
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