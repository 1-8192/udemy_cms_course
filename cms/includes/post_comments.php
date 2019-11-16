<!-- Blog Comments -->
                <?php 
                    include_once "util_functions.php";
                    //posting comment to db
                    if (isset($_POST['create_comment'])) {
                        if (!empty($_POST['comment_author']) && !empty($_POST['comment_email']) && !empty($_POST['comment_body'])) {
                        insert_comment();
                        }
                    }
                ?>
                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form action="" role="form" method="POST">
                        <div class="form-group">
                            <label for="comment_author">Author</label>
                            <input type="text" class="form-control" name="comment_author">
                        </div>
                        <div class="form-group">
                            <label for="comment_email">Email</label>
                            <input type="email" class="form-control" name="comment_email">
                        </div>
                        <div class="form-group">
                            <label for="comment_body">Comment</label>
                            <textarea class="form-control" name="comment_body" rows="3"></textarea>
                        </div>
                        <button type="submit" name="create_comment" class="btn btn-primary">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->
                <?php 
                    //grabs comments for post and populates (util_functions.php)
                    fetch_comments_for_post($post_id);
                ?>
                <hr>