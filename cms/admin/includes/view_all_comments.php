
<div class="col-xs-6">
                            <div class="col-xs-6">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Author</th>
                                            <th>Email</th>
                                            <th>Comment</th>
                                            <th>Status</th>
                                            <th>Post</th>
                                            <th>Date</th>
                                            <th>Approve</th>
                                            <th>Unapprove</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        //grabbing posts from db and inserting into table (functions.php)
                                         fetch_comments();
                                        ?>

                                        <?php 
                                            // deleting post logic (functions.php)
                                            delete_comment();
                                        ?>
                                    </tbody>    
                                </table>
                                <?php 
                                    if (isset($_GET['unapprove'])) {
                                       unapprove_comment();
                                    }

                                    if (isset($_GET['approve'])) {
                                        approve_comment();
                                    }
                                
                                ?>
                            </div>