<?php
    include_once "../includes/db.php";
    include_once "user_functions.php";

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
                $post_author = getUserNameFromId($row['post_user_id']);
                $post_title = $row['post_title'];
                $post_status = $row['post_status'];
                $post_image = $row['post_image'];
                $post_date = $row['post_date'];
                $post_tags = $row['post_tags'];
                $post_comment_count = $row['post_comment_count'];
                $post_views = $row['post_views'];

                echo "<tr><td><input type='checkbox' class='checkBoxes' name='checkBoxArray[]' value={$post_id}></td>";
                echo "<td>{$post_id}</td>";
                echo "<td>{$post_author}</td>";
                echo "<td>{$post_title}</td>";
                echo "<td>{$cat_title}</td>";
                echo "<td>{$post_status}</td>";
                echo "<td><img class='img-responsive' src='../images/{$post_image}'></td>";
                echo "<td>{$post_tags}</td>";
                echo "<td>{$post_comment_count}</td>";
                echo "<td>{$post_date}</td>";
                echo "<td>{$post_views}</td>";
                echo "<td><a href='../post.php?p_id={$post_id}'>View Post</a></td>";
                echo "<td><a href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>"; 
                echo "<td><a href='posts.php?delete={$post_id}'>Delete</a></td></tr>";
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
        $post_user_id = $row['post_user_id'];
        $post_status = $row['post_status'];
        $post_image = $row['post_image'];
        $post_tags = $row['post_tags'];
        $post_body = $row['post_body'];

        try {
            $query = "INSERT INTO posts (category_id, post_title, post_user_id, post_date, post_image, post_body, post_tags, post_status) VALUES (:cid, :title, :puid, :date, :image, :body, :tags, :status)";
            $stmt = $pdo->prepare($query);
            $stmt->execute(array(
                ':cid' => $post_category_id,
                ':title' => $post_title,
                ':puid' => $post_user_id,
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

    //add post function to insert new post in db
    function insert_post() {
        global $pdo;
            $post_title = $_POST['post_title'];
            $post_category_id = $_POST['post_category'];
            $post_user_id = $_POST['post_user'];
            $post_image = $_FILES['post_image']['name'];
            $post_image_temp = $_FILES['post_image']['tmp_name'];
            $post_tags = $_POST['post_tags'];
            $post_body = $_POST['post_body'];
            $post_date = date('d-m-y');
            $post_comment_count = 0;
            $post_status = $_POST['post_status'];
    
            //moving file name for image to images folder
            move_uploaded_file($post_image_temp, "../images/$post_image");
    
            try {
            $query = "INSERT INTO posts (category_id, post_title, post_user_id, post_date, post_image, post_body, post_tags, post_comment_count, post_status) VALUES (:cid, :title, :puid, :date, :image, :body, :tags, :coms, :status)";
            $stmt = $pdo->prepare($query);
            $stmt->execute(array(
                ':cid' => $post_category_id,
                ':title' => $post_title,
                ':puid' => $post_user_id,
                ':date' => $post_date,
                ':image' => $post_image,
                ':body' => $post_body,
                ':tags' => $post_tags,
                ':coms' => $post_comment_count,
                ':status' => $post_status
                ));
                $_SESSION['success'] = "Post added";
                header("Location: posts.php");
            } 
            catch(PDOException $exception) {
                return $exception;
            }
    }

    //updates post data in db
    function update_post($id) {
        global $pdo;
            $post_id = intval($id);
            $post_title = $_POST['post_title'];
            $post_category_id = $_POST['post_category'];
            $post_user_id = $_POST['post_user'];
            $post_tags = $_POST['post_tags'];
            $post_body = $_POST['post_body'];
            $post_status = $_POST['post_status'];
            $post_image = $_FILES['post_image']['name'];
            $post_image_temp = $_FILES['post_image']['tmp_name'];

            //moving file name for image to images folder
            move_uploaded_file($post_image_temp, "../images/$post_image");

            if (empty($post_image)) {
                $query = "SELECT post_image FROM posts WHERE post_id = $post_id";
                $stmt = $pdo->query($query);
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $post_image = $row[post_image];
            }
    
            try {
            $query = "UPDATE posts SET category_id = :cid, post_title = :title, post_user_id = :puid, post_image = :image, post_body = :body, post_tags = :tags, post_status = :status WHERE post_id = :pid";
            $stmt = $pdo->prepare($query);
            $stmt->execute(array(
                ':cid' => $post_category_id,
                ':title' => $post_title,
                ':puid' => $post_user_id,
                ':image' => $post_image,
                ':body' => $post_body,
                ':tags' => $post_tags,
                ':status' => $post_status,
                ':pid' => $post_id
                ));
                $_SESSION['success'] = "Post updated";
                header("Location: posts.php");
            } 
            catch(PDOException $exception) {
                return $exception;
            }
    }
?>