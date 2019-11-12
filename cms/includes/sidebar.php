<div class="col-md-4">

                <!-- Blog Search Well plus a form to send info to the db for search results-->
                <div class="well">
                    <h4>Blog Search</h4>
                    <form action="search.php" method="POST">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control">
                        <span class="input-group-btn">
                            <button name="submit" class="btn btn-default" type="submit">
                                <span class="glyphicon glyphicon-search"></span>
                        </button>
                        </span>
                    </div>
                    </form>
                    <!-- /.input-group -->
                </div>

                <!-- login sends to login.php-->
                <div class="well">
                    <h4>Log In</h4>
                    <form action="includes/login.php" method="POST">
                    <div class="form-group">
                        <input type="text" name="user_name" class="form-control" placeholder="enter username">
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="enter password">
                        <span class="innput-group-btn">
                            <button class="btn btn-primary" name="login" type="submit">Login</button>
                        </span>
                    </div>
                    </form>
                    <!-- /.input-group -->
                </div>

                <!-- Blog Categories Well -->
                <div class="well">
                <?php 
                        //grabbing categories from db
                        $query = "SELECT * FROM categories";
                        $stmt = $pdo->query($query);
                        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    ?>
                    <h4>Blog Categories</h4>
                    <div class="row">
                        <div class="col-lg-6">
                            <ul class="list-unstyled">
                            <?php 
                            //looping through category names
                             if (count($rows) > 0) {
                                foreach($rows as $row) {
                                    echo('<li><a href="category.php?category='."$row[cat_id]".'">'."$row[cat_title]".'</a></li>');
                                }
                        }
                            ?>
                            </ul>
                        </div>
                        <!-- /.col-lg-6 -->
                        <div class="col-lg-6">
                            <ul class="list-unstyled">
                            </ul>
                        </div>
                        <!-- /.col-lg-6 -->
                    </div>
                    <!-- /.row -->
                </div>

                <!-- Side Widget Well -->
                <?php include_once "widget.php" ?>

            </div>

        </div>