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

    //fetching post data from db for table
    function fetch_posts() {
        global $pdo;
        $query = "SELECT * FROM posts";
        $stmt = $pdo->query($query);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($rows) > 0) {
            foreach($rows as $row) {
                echo('<tr><td>'."$row[post_id]".'</td><td>'."$row[post_author]".'</td><td>'."$row[post_title]".'</td><td>'."$row[category_id]".'</td><td>'."$row[post_status]".'</td><td><img class="img-responsive" src="../images/'."$row[post_image]".'"></td><td>'."$row[post_tags]".'</td><td>'."$row[post_comment_count]".'</td><td>'."$row[post_date]".'</td><td><a href="posts.php?delete='."$row[post_id]".'">Delete</a></td><td><a href="posts.php?source=edit_post&p_id='."$row[post_id]".'">Edit</a></td></tr>');
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
    
            // try {
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
            // } 
            // catch(PDOException $exception) {
            //     return $exception;
            // }
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
?>