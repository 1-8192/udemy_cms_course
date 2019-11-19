<?php 
    include_once "db.php";

    function incrementPostViews($id) {
        global $pdo;

        $query = "UPDATE posts SET post_views = post_views + 1 WHERE post_id = :pid";
        $stmt = $pdo->prepare($query);
        $stmt->execute(array(':pid' => $id));
    }

?>