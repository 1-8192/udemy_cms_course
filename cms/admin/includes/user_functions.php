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
?>