<?php
##Protects unauthorized acces to pages, needs to be included in the page.


session_start();

if (!isset($_SESSION['isAdmin']) ||
    $_SESSION['isAdmin'] != 1) {
        echo ('You do not have dev acces');        
        header('Location: index.php');
    }
    
    
?>