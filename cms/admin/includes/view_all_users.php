<div class="col-xs-6">
                            <div class="col-xs-6">
                                <table class="table table-bordered table-hover">
                                <?php 
                                    if (isset($_SESSION['success'])) {
                                        $message = $_SESSION['success'];
                                        echo '<h3 style="color:green">'."$message".'</h3>';
                                    }
                                ?>
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>username</th>
                                            <th>first name</th>
                                            <th>last name</th>
                                            <th>email</th>
                                            <th>role</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            //grabbing users from db and inserting into table (functions.php)
                                            fetch_users();
                                        ?>

                                        <?php 
                                            // deleting user logic (functions.php)
                                            delete_user();
                                        ?>
                                    </tbody>    
                                </table>
                                <?php 
                                    //unapproving comment if clicked (functions.php)
                                    if (isset($_GET['unapprove'])) {
                                       unapprove_comment();
                                    }
                                    
                                    //approving comment on click (functions.php)
                                    if (isset($_GET['approve'])) {
                                        approve_comment();
                                    }
                                
                                ?>
                            </div>