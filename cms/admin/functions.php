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
?>