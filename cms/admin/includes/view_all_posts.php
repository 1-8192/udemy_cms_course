
<div class="col-xs-6">
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
                                            <th>Delete</th>
                                            <th>Edit</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        //grabbing posts from db and inserting into table
                                         fetch_posts();
                                        ?>

                                        <?php 
                                            // deleting post logic
                                            delete_post();
                                        ?>
                                    </tbody>    
                                </table>
                                <a href="posts.php?source=add_post">Add New Post</a>
                            </div>