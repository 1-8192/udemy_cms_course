
<div class="col-xs-6">
    <div class="col-xs-6">
    <?php 
        if (isset($_SESSION['success'])) {
            $message = $_SESSION['success'];
            echo '<h3 style="color:green">'."$message".'</h3>';
        }
    ?>
    <?php
        if (isset($_POST['checkBoxArray'])) {
            foreach($_POST['checkBoxArray'] as $checkBoxValueId) {
                $bulk_options = $_POST['bulk_options'];

                switch($bulk_options) {
                    case 'published':
                        $query = "UPDATE posts SET post_status = :pstat WHERE post_id = :pid";
                        $stmt = $pdo->prepare($query);
                        $stmt->execute(array(
                            ':pstat' => $bulk_options,
                            ':pid' => $checkBoxValueId
                        ));
                    break;

                    case 'draft':
                        $query = "UPDATE posts SET post_status = :pstat WHERE post_id = :pid";
                        $stmt = $pdo->prepare($query);
                        $stmt->execute(array(
                            ':pstat' => $bulk_options,
                            ':pid' => $checkBoxValueId
                        ));
                    break;

                    case 'delete':
                    break;

                    default:
                    break;
                }
            }
        }
    ?>
    <form action="./posts.php" method="POST">
        <div id="bulkOptionsContainer" clas="col-xs-4">
            <select class="form-control" name="bulk_options">
                <option value="">Select Bulk Option</option>
                <option value="published">Publish</option>
                <option value="draft">Draft</option>
                <option value="delete">Delete</option>
            </select>
        </div>
        <div class="col-xs-4">
            <input type="submit" value="Apply" class="btn btn-success">
            <a class="btn btn-primary" href="posts.php?source=add_post">Add New Post</a>
        </div>
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th><input type="checkbox" id="selectAllBoxes"></th>
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
        </form>
</div>