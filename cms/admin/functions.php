<?php 
    //logic for posting new category to db
    include_once "../includes/db.php";

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
        $query = "SELECT * FROM categories WHERE cat_id = $id";
        $stmt = $pdo->query($query);
        $cat_row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $cat_row['cat_title'];
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

                echo('<tr><td>'."$row[post_id]".'</td><td>'."$row[post_author]".'</td><td>'."$row[post_title]".'</td><td>'."$cat_title".'</td><td>'."$row[post_status]".'</td><td><img class="img-responsive" src="../images/'."$row[post_image]".'"></td><td>'."$row[post_tags]".'</td><td>'."$row[post_comment_count]".'</td><td>'."$row[post_date]".'</td><td><a href="posts.php?delete='."$row[post_id]".'">Delete</a></td><td><a href="posts.php?source=edit_post&p_id='."$row[post_id]".'">Edit</a></td></tr>');
            }
        }
    }

    //add post function to insert new post in db
    function insert_post() {
        global $pdo;
            $post_title = $_POST['post_title'];
            $post_category_id = $_POST['post_category'];
            $post_author = $_POST['author'];
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
            $query = "INSERT INTO posts (category_id, post_title, post_author, post_date, post_image, post_body, post_tags, post_comment_count, post_status) VALUES (:cid, :title, :author, :date, :image, :body, :tags, :coms, :status)";
            $stmt = $pdo->prepare($query);
            $stmt->execute(array(
                ':cid' => $post_category_id,
                ':title' => $post_title,
                ':author' => $post_author,
                ':date' => $post_date,
                ':image' => $post_image,
                ':body' => $post_body,
                ':tags' => $post_tags,
                ':coms' => $post_comment_count,
                ':status' => $post_status
                ));
                header("Location: posts.php");
            } 
            catch(PDOException $exception) {
                return $exception;
            }
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
            header("Location: posts.php");
        }
    }

    //updates post data in db
    function update_post($id) {
        global $pdo;
            $post_id = intval($id);
            $post_title = $_POST['post_title'];
            $post_category_id = $_POST['post_category'];
            $post_author = $_POST['author'];
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
            $query = "UPDATE posts SET category_id = :cid, post_title = :title, post_author = :author, post_image = :image, post_body = :body, post_tags = :tags, post_status = :status WHERE post_id = :pid";
            $stmt = $pdo->prepare($query);
            $stmt->execute(array(
                ':cid' => $post_category_id,
                ':title' => $post_title,
                ':author' => $post_author,
                ':image' => $post_image,
                ':body' => $post_body,
                ':tags' => $post_tags,
                ':status' => $post_status,
                ':pid' => $post_id
                ));
                header("Location: posts.php");
            } 
            catch(PDOException $exception) {
                return $exception;
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

                echo('<tr><td>'."$row[user_id]".'</td><td>'."$row[user_name]".'</td><td>'."$row[user_first_name]".'</td><td>'."$row[user_last_name]".'</td><td>'."$row[user_email]".'</td><td>'."$row[user_role]".'</td><td><a href="users.php?source=edit_user&p_id='."$row[user_id]".'">Edit</a></td><td><a href="users.php?delete='."$row[user_id]".'">Delete</a></td></tr>');
            }
        }
    }

    //add user function to insert new user in db
    function insert_user() {
        global $pdo;
            $user_first_name = $_POST['user_first_name'];
            $user_last_name = $_POST['user_last_name'];
            $user_email = $_POST['user_email'];
            $user_name = $_POST['user_name'];
            $user_password = $_POST['user_password'];
            $user_role = $_POST['user_role'];
            $user_image = $_FILES['user_image']['name'];
            $user_image_temp = $_FILES['user_image']['tmp_name'];

    
            //moving file name for image to images folder
            move_uploaded_file($user_image_temp, "../images/$user_image");
    
            try {
            $query = "INSERT INTO users (user_first_name, user_last_name, user_email, user_name, user_password, user_role, user_image) VALUES (:ufn, :uln, :em, :unm, :pass, :rol, :img)";
            $stmt = $pdo->prepare($query);
            $stmt->execute(array(
                ':ufn' => $user_first_name,
                ':uln' => $user_last_name,
                ':em' => $user_email,
                ':unm' => $user_name,
                ':pass' => $user_password,
                ':rol' => $user_role,
                ':img' => $user_image
                ));
                header("Location: users.php");
            } 
            catch(PDOException $exception) {
                return $exception;
            }
    }

    //delete function for deleting user from db
    function delete_user() {
        global $pdo;
        if (isset($_GET['delete'])) {
            $user_id = $_GET['delete'];

            $query = "DELETE FROM users WHERE user_id = :uid";
            $stmt = $pdo->prepare($query);
            $stmt->execute(array(':uid' => $user_id));
            //refresh after delete
            header("Location: users.php");
        }
    }
?>