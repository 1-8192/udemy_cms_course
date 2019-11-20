<?php
    include_once "../includes/db.php";

    //setting up sessions to keep track of users online
    function getOnlineUserCount() {
        global $pdo;

        $session = session_id();
        $time = time();
        $time_out_in_seconds = 60;
        $time_out = $time - $time_out_in_seconds;
        
        $query = "SELECT * FROM users_online WHERE session = '$session'";
        $stmt = $pdo->query($query);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $count = count($rows);

        if ($count == null) {
            $query = "INSERT INTO users_online (session, time) VALUES ('$session', '$time')";
            $pdo->query($query);
        } else {
            $query = "UPDATE users_online SET time = '$time' WHERE session = '$session'";
            $pdo->query($query);
        }

        $query = "SELECT * FROM users_online WHERE time > '$time_out'";
        $stmt = $pdo->query($query);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return count($rows);
    }

    //add user function to insert new user in db
    function insert_user() {
        global $pdo;
            $user_first_name = $_POST['user_first_name'];
            $user_last_name = $_POST['user_last_name'];
            $user_email = $_POST['user_email'];
            $user_name = $_POST['user_name'];
            $user_password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 5));
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
                $_SESSION['success'] = "Profile added";
                header("Location: users.php");
            } 
            catch(PDOException $exception) {
                return $exception;
            }
    }

    //updates user data in db
    function update_user($id) {
        global $pdo;
        $user_id = intval($id);
        $user_first_name = $_POST['user_first_name'];
        $user_last_name = $_POST['user_last_name'];
        $user_email = $_POST['user_email'];
        $user_name = $_POST['user_name'];
        $user_password = password_hash($_POST['user_password'], PASSWORD_BCRYPT, array('cost' => 5));
        $user_role = $_POST['user_role'];
        $user_image = $_FILES['user_image']['name'];
        $user_image_temp = $_FILES['user_image']['tmp_name'];

        //moving file name for image to images folder
        move_uploaded_file($user_image_temp, "../images/$user_image");

        if (empty($user_image)) {
            $query = "SELECT user_image FROM users WHERE user_id = $user_id";
            $stmt = $pdo->query($query);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $user_image = $row[user_image];
        }
    
        try {
        $query = "UPDATE users SET user_first_name = :ufn, user_last_name = :uln, user_email = :em, user_name = :unm, user_password = :pass, user_role = :rol, user_image = :img WHERE user_id = :uid";
        $stmt = $pdo->prepare($query);
        $stmt->execute(array(
            ':uid' => $user_id,
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
?>