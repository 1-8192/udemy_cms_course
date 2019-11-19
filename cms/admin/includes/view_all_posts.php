
<div class="col-xs-6">
    <div class="col-xs-6">
    <?php 
        include_once "post_functions.php";
        if (isset($_SESSION['success'])) {
            $message = $_SESSION['success'];
            echo '<p class="text-center" style="color:green">'."$message".'</p>';
            unset($_SESSION['success']);
        }
    ?>
    <?php
        if (isset($_POST['checkBoxArray'])) {
            foreach($_POST['checkBoxArray'] as $checkBoxValueId) {
                $bulk_options = $_POST['bulk_options'];

                switch($bulk_options) {
                    case 'published':
                        bulk_update_post_status($bulk_options, $checkBoxValueId);
                    break;

                    case 'draft':
                        bulk_update_post_status($bulk_options, $checkBoxValueId);
                    break;

                    case 'delete':
                        bulk_update_delete_post($checkBoxValueId);
                    break;

                    case 'clone':
                        clone_post($checkBoxValueId);
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
                <option value="clone">Clone</option>
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
                    <th>Hits</th>
                    <th>View</th>
                    <th>Edit</th>
                    <th>Delete</th>
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