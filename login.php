<?php
    if(isset($_POST['submit'])) {

        $username = $_POST['username'];
        $password = $_POST['password'];

        $pdo = new PDO('mysql:host=localhost;port=8889;dbname=loginapp', 'test', 'testpass');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if ($pdo) {
            echo "connection success";
        } else {
            die("database connection fail");
        };

        $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (:name, :pass)");
        $stmt->execute(array(
            ':name' => $username,
            ':pass' => $password
        ));

        if ($username && $password) {

        } else {
            echo "fields cannot be blank";
        };
    };
?>

<!DOCTYPE html>
<html lang="en">
    <meta charset="UTF-8">
    <title>Login Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <body>
        <div class="container">
            <div class="col-xs-6">
                <form action="login.php" method="POST">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="passwprd">Password</label>
                        <input type="password" name="password" class="form-control">
                    </div>
                    <input class="btn-primary" type="submit" name="submit" value="Submit">
                </form>
            </div>
        </div>
    </body>
</html>