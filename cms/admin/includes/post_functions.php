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
?>