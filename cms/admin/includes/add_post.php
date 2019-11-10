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
        <label for="post_category">Post Category ID</label>
        <input type="text" class="form-control" name="post_category">
    </div>
    <div class="form-group">
        <label for="author">Post Author</label>
        <input type="text" class="form-control" name="author">
    </div>
    <div class="form-group">
        <label for="post_status">Post Status</label>
        <input type="text" class="form-control" name="post_status">
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
        <textarea class="form-control" name="post_body" cols="30" rows="10">
        </textarea>
    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="add_post" value="Publish Post">
        <input class="btn btn-primary" type="submit" name="cancel" value="Cancel">
    </div>
</form>