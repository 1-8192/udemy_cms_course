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

    //validation for unique email
    function email_exists($email) {
        global $pdo;
        $query = "SELECT user_email FROM users WHERE user_email = :em";
        $stmt = $pdo->prepare($query);
        $stmt->execute(array(
            ':em' => $email
        ));
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($rows) > 0) {
            return true;
        } else {
            return false;
        }
    }
?>