
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
                                            <th>Edit</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        //grabbing posts from db and inserting into table
                                         fetch_comments();
                                        ?>

                                        <?php 
                                            // deleting post logic
                                            delete_post();
                                        ?>
                                    </tbody>    
                                </table>
                            </div>