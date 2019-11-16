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
?>