<?php 
    //login logic for website redirected from sidebar well
    include_once "db.php";
    include_once "util_user_functions.php";
    session_start();

    if (isset($_POST['login'])) {
        $user_name = $_POST['user_name'];
        $password = $_POST['user_password'];
        $check = crypt($password, '$2a$07$YourSaltIsA22ChrString$');

        $query = "SELECT * FROM users WHERE user_name = :name AND user_password = :pw";
        $stmt = $pdo->prepare($query);
        $stmt->execute(array(
            ':name' => $user_name,
            ':pw' => $check
        ));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row === false) {
            $_SESSION['error'] = "Incorrect username or password";
            header("Location: ../main_login.php");
            return;
        } else {
            if (password_verify($password, $row['user_password'])) {
                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['user_name'] = htmlentities($row['user_name']);
                $_SESSION['user_first_name'] = htmlentities($row['user_first_name']);
                $_SESSION['user_last_name'] = htmlentities($row['user_last_name']);
                $_SESSION['user_email'] = $row['user_email'];
                $_SESSION['password'] = $row['user_password'];
                $_SESISON['user_image'] = htmlentities($row['user_image']);
                $_SESSION['user_role'] = htmlentities($row['user_role']);
                
                header("Location: ../admin/index.php");
            }
        }
    }
?>