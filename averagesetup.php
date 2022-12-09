<?php
//Page for getting an average setup, in its current state it only builds an average for 2 tuples and 1 car.

$db = new mysqli (MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_CARDATABASE);

$sql = sprintf ("SELECT AVG(LF_Pressure), AVG(`RF_pressure`), AVG(`LF_SpringPerchOffset`), AVG(`Front_Toe`) from mx5globaldev;");

?>