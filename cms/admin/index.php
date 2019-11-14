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
                            Welcome, <?php echo $_SESSION['user_first_name']; ?>
                        </h1>
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                            </li>
                    </div>
                </div>
                <!-- /.row -->   
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-file-text fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                <?php
                                    $query = "SELECT * FROM posts";
                                    $stmt = $pdo->prepare($query);
                                    $stmt->execute();
                                    $post_count = $stmt->rowCount();

                                ?>
                                <div class='huge'><?php echo $post_count; ?></div>
                                        <div>Posts</div>
                                    </div>
                                </div>
                            </div>
                            <a href="./posts.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-comments fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                    <?php
                                    $query = "SELECT * FROM comments";
                                    $stmt = $pdo->prepare($query);
                                    $stmt->execute();
                                    $com_count = $stmt->rowCount();

                                    ?>
                                    <div class='huge'><?php echo $com_count; ?></div>
                                    <div>Comments</div>
                                    </div>
                                </div>
                            </div>
                            <a href="./comments.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-user fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                    <?php
                                    $query = "SELECT * FROM users";
                                    $stmt = $pdo->prepare($query);
                                    $stmt->execute();
                                    $user_count = $stmt->rowCount();

                                    ?>
                                    <div class='huge'><?php echo $user_count; ?></div>
                                        <div> Users</div>
                                    </div>
                                </div>
                            </div>
                            <a href="./users.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-list fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                    <?php
                                    $query = "SELECT * FROM categories";
                                    $stmt = $pdo->prepare($query);
                                    $stmt->execute();
                                    $cat_count = $stmt->rowCount();

                                    ?>
                                        <div class='huge'><?php echo $cat_count; ?></div>
                                        <div>Categories</div>
                                    </div>
                                </div>
                            </div>
                            <a href="./categories.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

                <?php 
                    //queries for graph data

                    //draft posts
                    $query = "SELECT * FROM posts WHERE post_status = 'draft'";
                    $stmt = $pdo->prepare($query);
                    $stmt->execute();
                    $post_draft_count = $stmt->rowCount();

                    //unapproved comments
                    $query = "SELECT * FROM comments WHERE comment_status = 'pending'";
                    $stmt = $pdo->prepare($query);
                    $stmt->execute();
                    $com_count_unap = $stmt->rowCount();

                    //non-admin users
                    $query = "SELECT * FROM users WHERE user_role = 'subscriber'";
                    $stmt = $pdo->prepare($query);
                    $stmt->execute();
                    $user_count_sub = $stmt->rowCount();
                ?>

                <div class="row">
                    <script type="text/javascript">
                    google.charts.load('current', {'packages':['bar']});
                    google.charts.setOnLoadCallback(drawChart);

                    function drawChart() {
                        var data = google.visualization.arrayToDataTable([
                        ['Date', 'Count'],
                        <?php 
                            $element_text = ['All Posts', 'Drafts', 'Comments', 'Pending Comments', 'Users', 'Subscribers','Categories'];
                            $element_count = [$post_count, $post_draft_count, $com_count, $com_count_unap, $user_count, $user_count_sub, $cat_count];

                            for ($i = 0; $i < 6; $i++) {
                                echo "['{$element_text[$i]}'" . "," ."{$element_count[$i]}],";
                            }

                        ?>
                        ]);

                        var options = {
                        chart: {
                            title: '',
                            subtitle: '',
                        }
                        };

                        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                        chart.draw(data, google.charts.Bar.convertOptions(options));
                    }
                    </script>
                    <div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>
                </div>

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
