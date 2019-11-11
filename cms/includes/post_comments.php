<!-- Blog Comments -->
                <?php 
                    include_once "util_functions.php";
                    //posting comment to db
                    if (isset($_POST['create_comment'])) {
                        insert_comment();
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
                    $query = "SELECT * FROM comments where post_id = :pid AND comment_status = 'approved' ORDER BY comment_id DESC";
                    $stmt = $pdo->prepare($query);
                    $stmt->execute(array(":pid" => $post_id));
                    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    if (count($rows) >0) {
                        foreach($rows as $row) {
                            $comment_author = $row['comment_author'];
                            $comment_body = $row['comment_body'];
                            $comment_date = $row['comment_date'];
                            
                            echo('<div class="media">
                                <a class="pull-left" href="#">
                                    <img class="media-object" src="http://placehold.it/64x64" alt="">
                                </a>
                                <div class="media-body">
                                    <h4 class="media-heading">'."$comment_author".'
                                        <small>'."$comment_date".'</small>
                                    </h4>'."$comment_body".'
                                </div>
                            </div>');
                            ?>
                       <?php }
                    }
                ?>
                <hr>