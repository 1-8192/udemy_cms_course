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
                                </form>
                            </div>
                            <div class="col-xs-6">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Author</th>
                                            <th>Title</th>
                                            <th>Category</th>
                                            <th>Status</th>
                                            <th>Image</th>
                                            <th>Tags</th>
                                            <th>Comments</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        //grabbing posts from db and inserting into table
                                         fetch_posts();
                                        ?>

                                        <?php 
                                            // deleting category logic
                                            delete_category();
                                        ?>
                                    </tbody>    
                                </table>
                            </div>