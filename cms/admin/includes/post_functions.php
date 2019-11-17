<?php
    include_once "../includes/db.php";

    //functions related to posts in database 

    //bulk update for posts status
    function bulk_update_post_status($option, $id) {
        global $pdo;

        $query = "UPDATE posts SET post_status = :pstat WHERE post_id = :pid";
        $stmt = $pdo->prepare($query);
        $stmt->execute(array(
            ':pstat' => $option,
            ':pid' => $id
        ));
        $_SESSION['success'] = "Post Status updated";
        header("Location: posts.php");
    }

    //delete function for deleting post from db
    function bulk_update_delete_post($id) {
        global $pdo;
        $query = "DELETE FROM posts WHERE post_id = :pid";
        $stmt = $pdo->prepare($query);
        $stmt->execute(array(':pid' => $id));
        //refresh after delete
        $_SESSION['success'] = "Delete succesful";
        header("Location: posts.php");
    }

    //fetching post data from db for table
    function fetch_posts() {
        global $pdo;
        $query = "SELECT * FROM posts";
        $stmt = $pdo->query($query);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($rows) > 0) {
            foreach($rows as $row) {

                $cat_title = get_category_name_from_id($row['category_id']);
                $post_id = $row['post_id'];

                echo('<tr><td><input type="checkbox" class="checkBoxes" name="checkBoxArray[]" value="'."$post_id".'"></td><td>'."$row[post_id]".'</td><td>'."$row[post_author]".'</td><td>'."$row[post_title]".'</td><td>'."$cat_title".'</td><td>'."$row[post_status]".'</td><td><img class="img-responsive" src="../images/'."$row[post_image]".'"></td><td>'."$row[post_tags]".'</td><td>'."$row[post_comment_count]".'</td><td>'."$row[post_date]".'</td><td><a href="../post.php?p_id='."$row[post_id]".'">View Post</a></td><td><a href="posts.php?source=edit_post&p_id='."$row[post_id]".'">Edit</a></td><td><a href="posts.php?delete='."$row[post_id]".'">Delete</a></td></tr>');
            }
        }
    }

    function clone_post($id) {
        global $pdo;
        $query = "SELECT * FROM posts WHERE post_id = :pid";
        $stmt = $pdo->prepare($query);
        $stmt->execute(array(':pid' => $id));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        $post_title = $row['post_title'];
        $post_category_id = $row['category_id'];
        $post_date = $row['post_date'];
        $post_author = $row['post_author'];
        $post_status = $row['post_status'];
        $post_image = $row['post_image'];
        $post_tags = $row['post_tags'];
        $post_body = $row['post_body'];

        try {
            $query = "INSERT INTO posts (category_id, post_title, post_author, post_date, post_image, post_body, post_tags, post_status) VALUES (:cid, :title, :author, :date, :image, :body, :tags, :status)";
            $stmt = $pdo->prepare($query);
            $stmt->execute(array(
                ':cid' => $post_category_id,
                ':title' => $post_title,
                ':author' => $post_author,
                ':date' => $post_date,
                ':image' => $post_image,
                ':body' => $post_body,
                ':tags' => $post_tags,
                ':status' => $post_status
                ));
                $_SESSION['success'] = "Post cloned";
                header("Location: posts.php");
            } 
            catch(PDOException $exception) {
                return $exception;
            }

    }
?>