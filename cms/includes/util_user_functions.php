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

    //register new user in db
    function register_user($username, $email, $password) {
        global $pdo;
        if (username_exists($username)) {
            $_SESSION['error'] = "Username already exists";
            header("Location: registration.php");
        } else if (email_exists($email)) {
            $_SESSION['error'] = "Email already exists";
            header("Location: registration.php");
        } else {
            $password = crypt($password, '$2a$07$YourSaltIsA22ChrString$');

            $query = "INSERT INTO users (user_name, user_email, user_password, user_role) VALUES (:unm, :em, :pass, :role)";
            $stmt = $pdo->prepare($query);
            $stmt->execute(array(
                ':unm' => $username,
                ':em' => $email,
                ':pass' => $password,
                ':role' => 'subscriber'
            ));
            $_SESSION['success'] = "User succesfully registered";
            header("Location: index.php");
        } 
    }

    function isLoggedIn() {
        if (isset($_SESSION['user_role'])) {
            return true;
        } else {
            return false;
        }
    }

    function checkIfUserLoggedInAndRedirect($address) {
        if (isLoggedIn()) {
            header("Location: {$address}");
        }
    }
?>