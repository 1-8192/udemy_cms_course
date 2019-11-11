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

        //increment comment count for related post
        increment_comment_count($post_id);
    }

    function increment_comment_count($post_id) {
        global $pdo;
        try {
        $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 WHERE post_id = :pid";
        $stmt = $pdo->prepare($query);
        $stmt->execute(array(':pid' => $post_id));
        }
        catch(PDOException $exception) {
            return $exception;
        }
    }

    //grabs comments related to post and displays in html
    function fetch_comments_for_post($post_id) {
        global $pdo;
        $query = "SELECT * FROM comments where post_id = :pid AND comment_status = 'approved' ORDER BY comment_id DESC";
        $stmt = $pdo->prepare($query);
        $stmt->execute(array(":pid" => $post_id));
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($rows) >0) {
            foreach($rows as $row) {
                $comment_author = $row['comment_author'];
                $comment_body = $row['comment_body'];
                $comment_date = $row['comment_date'];
                
                echo('<div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">'."$comment_author".'
                            <small>'."$comment_date".'</small>
                        </h4>'."$comment_body".'
                    </div>
                </div>');
            }
        }
    }
?>