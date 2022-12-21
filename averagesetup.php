<?php

require 'auth.inc.php';
require 'config.inc.php';
echo 'Under construction';

//Page for getting an average setup, in its current state it only builds an average for 1 car.

?>
<br>
<?php


// Connect to the database
$connection = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_CARDATABASE);

// Check for errors
if (mysqli_connect_errno()) {
    die('Failed to connect to the database: ' . mysqli_connect_error());
}

// Execute the query
$result = mysqli_query($connection, 'SELECT AVG(RF_pressure), AVG(LF_Pressure), AVG(LF_SpringPerchOffset), AVG(FuelLevel), AVG(Front_Toe), AVG(Front_ARB), AVG(LF_Bumpstiffness),
AVG(LF_ReboundStiffness), AVG(LF_Camber), AVG(RF_SpringPerch), AVG(RF_BumpStiffness), AVG(RF_ReboundStiffness), AVG(RF_Camber), AVG(RR_Pressure),
AVG(RR_SpringPerch), AVG(RR_BumpStiffness), AVG(RR_ReboundStiffness), AVG(RR_Camber), AVG(LR_Pressure), AVG(LR_SpringPerch),AVG(LR_BumpStiffness),
AVG(LR_ReboundStiffnes), AVG(LR_Camber), AVG(Rear_toe), AVG(Rear_ARB) from mx5globalcup');

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