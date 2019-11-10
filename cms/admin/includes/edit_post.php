<?php 
    include_once "./functions.php";
    
    if (isset($_POST['edit_post'])) {
        insert_post();
    }

    if (isset($_POST['cancel'])) {
        header("Location: ./posts.php");
    }

    //grabbing existing post data from db
    if (isset($_GET['p_id'])) {  

        $query = "SELECT * FROM posts WHERE post_id = :pid";
        $stmt = $pdo->prepare($query);
        $stmt->execute(array(":pid" => $_GET['p_id']));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $post_title = $row['post_title'];
        $post_category_id = $row['category_id'];
        $post_author = $row['post_author'];
        $post_image = $row['post_image'];
        $post_tags = $row['post_tags'];
        $post_body = $row['post_body'];
        $post_date = $row['post_date'];
        $post_comment_count = $row['post_comment_count'];
        $post_status = $row['post_status'];
    } else {
        die("Oops no ID");
    }
  
?>

<form action ="" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name="post_title" value="<?php echo $post_title ?>">
    </div>
    <div class="form-group">
        <select name="" id="">
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
        <input type="text" class="form-control" name="author" value="<?php echo $post_author ?>">
    </div>
    <div class="form-group">
        <label for="post_status">Post Status</label>
        <input type="text" class="form-control" name="post_status" value="<?php echo $post_status ?>">
    </div>
    <div class="form-group">
        <img width="100" src="../images/<?php echo $post_image; ?>" alt="post-image">
    </div>
    <div class="form-group">
        <label for="poast_tags">Post Tags</label>
        <input type="text" class="form-control" name="post_tags" value="<?php echo $post_tags ?>">
    </div>
    <div class="form-group">
        <label for="post_body">Post Body</label>
        <textarea class="form-control" name="post_body" cols="30" rows="10"><?php echo $post_title ?></textarea>
    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="edit_post" value="Update Post">
        <input class="btn btn-primary" type="submit" name="cancel" value="Cancel">
    </div>
</form>