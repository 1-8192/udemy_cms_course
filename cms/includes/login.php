<?php 
    //login logic for website redirected from sidebar well
    include_once "db.php";

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
            $user_id = $row[user_id];
            $user_first_name = $row['user_first_name'];
            $user_last_name = $row['user_last_name'];
            $user_role = $row['user_role'];
            $user_image = $row['user_image'];
        }
    }
?>