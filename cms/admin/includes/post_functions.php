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
    }
?>