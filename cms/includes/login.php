<?php 
    //login logic for website redirected from sidebar well
    include_once "db.php";
    session_start();

    if (isset($_POST['login'])) {
        $user_name = $_POST['user_name'];
        $password = $_POST['password'];

        $query = "SELECT * FROM users WHERE user_name = :name AND user_password = :pass";
        $stmt = $pdo->prepare($query);
        $stmt->execute(array(
            ':name' => $user_name,
            ':pass' => $password
        ));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (count($row) < 1) {
            die("Query failed");
        } else {
            $_SESSION['user_name'] = htmlentities($row['user_name']);
            $_SESSION['user_first_name'] = htmlentities($row['user_first_name']);
            $_SESSION['user_last_name'] = htmlentities($row['user_last_name']);
            $_SESSION['user_role'] = htmlentities($row['user_role']);
            
            header("Location: ../admin/index.php");
        }
    }
?>