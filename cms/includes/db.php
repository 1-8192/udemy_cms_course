<?php 
    //establishing PDO connnection to server
    $pdo = new PDO('mysql:host=localhost;port=8889;dbname=cms', 'root', 'root');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>