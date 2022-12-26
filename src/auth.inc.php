<?php
##Protects unauthorized acces to pages, needs to be included in the page.


session_start();

if (!isset($_SESSION['isAdmin']) ||
    $_SESSION['isAdmin'] != 1) {
        header('Location: index.php');
    } else if (!isset($_SESSION['isUser']) ||
    $_SESSION['isUser'] != 1) {
        header('Location: index.php');
    }
?>