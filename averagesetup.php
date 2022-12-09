<?php
//Page for getting an average setup, in its current state it only builds an average for 2 tuples and 1 car.

echo 'Under construction'

/* $db = new mysqli (MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_CARDATABASE);

$sql = sprintf ("SELECT AVG(LF_Pressure), AVG(`RF_pressure`), AVG(`LF_SpringPerchOffset`), AVG(`Front_Toe`) from mx5globaldev;"); */

?>

<form
    action=""
    method="post">
    <?php     
        if (isset($_POST['setuppage'])) {
        header('Location: setuppage.php');
        } 
        
        if (isset($_POST['userpage'])) {
            header('Location: userpage.php');
        }

        ?>
<input type="submit" name="userpage" value="Home"><br>
<input type="submit" name="setuppage" value="Add setup"><br>