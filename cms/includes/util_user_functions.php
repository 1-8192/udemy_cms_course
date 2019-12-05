<?php 
    include_once "db.php";

    //validation for unique username
    function username_exists($username) {
        global $pdo;
        $query = "SELECT user_name FROM users WHERE user_name = :unm";
        $stmt = $pdo->prepare($query);
        $stmt->execute(array(
            ':unm' => $username
        ));
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($rows) > 0) {
            return true;
        } else {
            return false;
        }
    }
?>