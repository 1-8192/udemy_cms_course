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
?>