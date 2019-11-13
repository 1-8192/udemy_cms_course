<?php 
    //logout logic
    include_once "db.php";
    session_start();

    $_SESSION = array();
    session_destroy();
    
    header("Location: ../index.php");
?>