<?php 
    //logic for posting new category to db
    include_once "../includes/db.php";
    include_once "../includes/util_user_functions.php";

    function insert_categories() {
        global $pdo;
        if (isset($_POST['submit'])) {
            $cat_title = $_POST['cat_title'];

            if ($cat_title === "" || empty($cat_title)) {
                echo "Empty field.";
            } else {
                $query = "INSERT INTO categories (cat_title) VALUES (:title)";
                $stmt = $pdo->prepare($query);
                $check = $stmt->execute(array(':title' => $cat_title));
            }
        }
    }

    //fetching categories from db and looping through results to create table entries
    function fetch_categories() {
        global $pdo;
        $query = "SELECT * FROM categories";
        $stmt = $pdo->query($query);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($rows) > 0) {
            foreach($rows as $row) {
                echo('<tr><td>'."$row[cat_id]".'</td><td>'."$row[cat_title]".'</td><td><a href="categories.php?delete='."$row[cat_id]".'">Delete</a></td><td><a href="categories.php?edit='."$row[cat_id]".'">Edit</a></td></tr>');
            }
        }
    }

    //delete function for deleting category from db
    function delete_category() {
        global $pdo;
        if (isset($_GET['delete'])) {
            $cat_id = $_GET['delete'];

            $query = "DELETE FROM categories WHERE cat_id = :cid";
            $stmt = $pdo->prepare($query);
            $stmt->execute(array(':cid' => $cat_id));
            //refresh after delete
            header("Location: categories.php");
        }
    }

    //grab category name from id
    function get_category_name_from_id($id) {
        global $pdo;
        $query = "SELECT * FROM categories WHERE cat_id = :cid";
        $stmt = $pdo->prepare($query);
        $stmt->execute(array(':cid' => $id));
        $cat_row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $cat_row['cat_title'];
    }

    //delete function for deleting post from db
    function delete_post() {
        global $pdo;
        if (isset($_GET['delete'])) {
            $post_id = $_GET['delete'];

            $query = "DELETE FROM posts WHERE post_id = :pid";
            $stmt = $pdo->prepare($query);
            $stmt->execute(array(':pid' => $post_id));
            //refresh after delete
            $_SESSION['success'] = "Post Deleted";
            header("Location: posts.php");
        }
    }

    //grab post name from id
    function get_post_name_from_id($id) {
        global $pdo;
        $query = "SELECT * FROM posts WHERE post_id = $id";
        $stmt = $pdo->query($query);
        $post_row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $post_row['post_title'];
    }

    //fetch comments to populate admin index page
    function fetch_comments() {
        global $pdo;
        $query = "SELECT * FROM comments";
        $stmt = $pdo->query($query);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($rows) > 0) {
            foreach($rows as $row) {
                $post_id = $row['post_id'];
                $post_title = get_post_name_from_id($post_id);

                echo('<tr><td>'."$row[comment_id]".'</td><td>'."$row[comment_author]".'</td><td>'."$row[comment_email]".'</td><td>'."$row[comment_body]".'</td><td>'."$row[comment_status]".'</td><td><a href="../post.php?p_id='."$post_id".'">'."$post_title".'</a></td><td>'."$row[comment_date]".'</td><td><a href="comments.php?approve='."$row[comment_id]".'">Approve</a></td><td><a href="comments.php?unapprove='."$row[comment_id]".'">Unapprove</a></td><td><a href="comments.php?delete='."$row[comment_id]".'">Delete</a></td></tr>');
            }
        }
    }

    //delete function for deleting comments from db
    function delete_comment() {
        global $pdo;
        if (isset($_GET['delete'])) {
            $comment_id = $_GET['delete'];

            $query = "DELETE FROM comments WHERE comment_id = :pid";
            $stmt = $pdo->prepare($query);
            $stmt->execute(array(':pid' => $comment_id));
            //refresh after delete
            header("Location: comments.php");
        }
    }

    //toggles the comment to approved status from pending
    function approve_comment() {
        global $pdo;
        $comment_id = $_GET['approve'];

        $query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = :cid";
        $stmt = $pdo->prepare($query);
        $stmt->execute(array(':cid' => $comment_id));
        header("Location: comments.php");
    }

    //toggles the comment to pending status from approved
    function unapprove_comment() {
        global $pdo;
        $comment_id = $_GET['unapprove'];

        $query = "UPDATE comments SET comment_status = 'pending' WHERE comment_id = :cid";
        $stmt = $pdo->prepare($query);
        $stmt->execute(array(':cid' => $comment_id));
        header("Location: comments.php");
    }

    //grabs user info from db to display in admin 
    function fetch_users() {
        global $pdo;
        $query = "SELECT * FROM users";
        $stmt = $pdo->query($query);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($rows) > 0) {
            foreach($rows as $row) {

                echo('<tr><td>'."$row[user_id]".'</td><td>'."$row[user_name]".'</td><td>'."$row[user_first_name]".'</td><td>'."$row[user_last_name]".'</td><td>'."$row[user_email]".'</td><td>'."$row[user_role]".'</td><td><a href="users.php?source=edit_user&u_id='."$row[user_id]".'">Edit</a></td><td><a href="users.php?delete='."$row[user_id]".'">Delete</a></td></tr>');
            }
        }
    }

    function get_count($table) {
        global $pdo;
        $query = "SELECT * FROM " . $table;
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        return $stmt->rowCount();
    }

    function check_status($table, $column, $value) {
        global $pdo;
        $query = "SELECT * FROM $table WHERE $column = '$value' ";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        return $stmt->rowCount();
    }
?>