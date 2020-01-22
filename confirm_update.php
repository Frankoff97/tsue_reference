<?php 
        session_start();
        require "./functions.php";
        $events= new Events;

        $events -> UPDATE($_SESSION['category'], $_Post['id']);
?>