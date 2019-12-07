<?php 
    session_start(); 
    include_once "util_user_functions.php";
    ?>
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="./index.php">Ale's Blog</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <?php 
                        $query = "SELECT * FROM categories LIMIT 2";
                        $stmt = $pdo->query($query);
                        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        if (count($rows) > 0) {
                            foreach($rows as $row) {
                                $category_class= "";

                                if(isset($_GET['category']) && $_GET['category'] == $row['cat_id']) {
                                    $category_class = 'active';
                                } 
                                echo('<li class='."$category_class".'><a href="#">'."$row[cat_title]".'</a></li>');
                            }
                    }
                    ?>
                    <li>
                        <a href="registration.php">REGISTER</a>
                    </li>
                    <li>
                        <a href="contact.php">CONTACT US</a>
                    </li>
                    <?php if(isLoggedIn()): ?>
                    <li>
                        <a href="admin">ADMIN</a>
                    </li> 
                    <li>
                        <a href="includes/logout.php">Logout</a>
                    </li> 
                    <?php else: ?>
                    <li>
                        <a href="main_login.php">LOG IN</a>
                    </li>
                    <?php endif; ?>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>