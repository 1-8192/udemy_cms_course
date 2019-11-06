<?php

        $pdo = new PDO('mysql:host=localhost;port=8889;dbname=loginapp', 'test', 'testpass');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if ($pdo) {
            echo "connection success";
        } else {
            die("database connection fail");
        };

        $stmt = $pdo->prepare("SELECT * FROM users");
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!$rows) {
            die('query failed');
        }
?>

<!DOCTYPE html>
<html lang="en">
    <meta charset="UTF-8">
    <title>Login Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <body>
        <div class="container">
            <?php 
                    foreach($rows as $row) {
                        echo($row['username']);
                    }
            ?>
        </div>
    </body>
</html>