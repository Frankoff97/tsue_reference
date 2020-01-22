<?php 
    session_start();
    require './functions.php';
    $delete = new Events;
    $delete -> DELETE($_SESSION['category'] ,$_GET['pass']);
    header("Location: /edit.php");
?>