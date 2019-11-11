<?php 
    include_once "db.php";

    //inserts new comment into db
    function insert_comment() {
        global $pdo;
        $post_id = $_GET['p_id'];
        $comment_author = $_POST['comment_author'];
        $comment_email = $_POST['comment_email'];
        $comment_body = $_POST['comment_body'];
        $comment_date = date('d-m-y');

        try {
        $query = "INSERT INTO comments (post_id, comment_author, comment_email, comment_body, comment_date) VALUES (:pid, :auth, :em, :bod, :dat)";
        $stmt = $pdo->prepare($query);
        $stmt->execute(array(
            ':pid' => $post_id,
            ':auth' => $comment_author,
            ':em' => $comment_email,
            ':bod' => $comment_body,
            ':dat' => $comment_date
        ));
        }
        catch(PDOException $exception) {
            return $exception;
        }
    }
?>