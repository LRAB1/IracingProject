<?php

require 'auth.inc.php';
require 'config.inc.php';
echo 'Under construction';

//Page for getting an average setup, in its current state it only builds an average for 2 tuples and 1 car.


/* $db = new mysqli (MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_CARDATABASE);

$sql = sprintf ("SELECT AVG(LF_Pressure), AVG(`RF_pressure`), AVG(`LF_SpringPerchOffset`), AVG(`Front_Toe`) from mx5globaldev;"); */
?>

<?php


// Connect to the database
$connection = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_CARDATABASE);

// Check for errors
if (mysqli_connect_errno()) {
    die('Failed to connect to the database: ' . mysqli_connect_error());
}

// Execute the query
$result = mysqli_query($connection, 'SELECT AVG(RF_pressure) from mx5globaldev');

// Check for errors
if (!$result) {
    die('Failed to execute the query: ' . mysqli_error($connection));
}

// Loop over the results and print each row
while ($row = mysqli_fetch_assoc($result)) {
    print_r($row);
}

// Close the connection
mysqli_close($connection);
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
<input type="submit" name="setuppage" value="Go to add setup"><br>