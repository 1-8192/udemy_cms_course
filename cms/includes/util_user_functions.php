<?php 
    include_once "db.php";

    //gets rand_salt value for encryption
    function encryptPassword($pass) {
        global $pdo;
        $query = "SELECT rand_salt FROM users";
        $stmt = $pdo->query($query);

        if (!$stmt) {
            die("Query failed" . PDOException($exception));
        }

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $salt = $row['rand_salt'];

        return crypt($pass, $salt);
    }
?>