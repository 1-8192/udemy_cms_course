<?php 
    include_once "./functions.php";
    
    if (isset($_POST['add_post'])) {
        insert_post();
    }

    if (isset($_POST['cancel'])) {
        header("Location: ./posts.php");
    }
?>

<form action ="" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name="post_title">
    </div>
    <div class="form-group">
        <label for="post_category">Category</label>
        <select name="post_category" id="">
            <?php 
                $query = "SELECT * FROM categories";
                $stmt = $pdo->query($query);
                $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
                if (count($rows) > 0) {
                    foreach($rows as $row) {
                        $cat_id = $row['cat_id'];
                        $cat_title = $row['cat_title'];
                        echo "<option value='$cat_id'>{$cat_title}</option>";
                    }
                }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="author">Post Author</label>
        <select name="author" id="">
            <?php 
                $query = "SELECT * FROM users";
                $stmt = $pdo->query($query);
                $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
                if (count($rows) > 0) {
                    foreach($rows as $row) {
                        $user_id = $row['user_id'];
                        $user_name = $row['user_name'];
                        echo "<option value='$user_id'>{$user_name}</option>";
                    }
                }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="post_status">Post Status</label>
        <select name="post_status">
                <option value="draft">Select Status</option>
                <option value="draft">Draft</option>
                <option value="published">Published</option>
        </select>
    </div>
    <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" class="form-control" name="post_image">
    </div>
    <div class="form-group">
        <label for="poast_tags">Post Tags</label>
        <input type="text" class="form-control" name="post_tags">
    </div>
    <div class="form-group">
        <label for="post_body">Post Body</label>
        <textarea class="form-control" name="post_body" cols="30" rows="10" id="body">
        </textarea>
    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="add_post" value="Publish Post">
        <input class="btn btn-primary" type="submit" name="cancel" value="Cancel">
    </div>
</form>
<script>
    ClassicEditor
        .create( document.querySelector( '#body' ) )
        .catch( error => {
            console.error( error )
        } );
    </script>