<?php
//currently only uploads left front pressure
require 'auth.inc.php';
require 'config.inc.php';

echo 'Userpage, will be setup page';


    $LF_Pressure =              '';
    $RF_Pressure =              '';
    $LF_SpringPerchOffset =     '';
    $FuelLevel =                '';
    $Front_Toe =                '';
    $Front_ARB =                '';
    $LF_Bumpstiffness =         '';
    $LF_ReboundStiffness =      '';
    $LF_Camber =                '';
    $RF_SpringPerch =           '';
    $RF_BumpStiffness =         '';
    
    if (isset($_POST['add'])) {
        $ok = true;
        if (!isset($_POST['LF_Pressure']) || $_POST['LF_Pressure'] === '') {
            $ok = false;
                } else { $LF_Pressure = $_POST['LF_Pressure'];
        };
        if (!isset($_POST['RF_Pressure']) || $_POST['RF_Pressure'] === '') {
            $ok = false;
                } else { $RF_Pressure = $_POST['RF_Pressure'];
        };
        if (!isset($_POST['LF_SpringPerchOffset']) || $_POST['LF_SpringPerchOffset'] === '') {
            $ok = false;
                } else { $LF_SpringPerchOffset = $_POST['LF_SpringPerchOffset'];
        };
        if (!isset($_POST['FuelLevel']) || $_POST['FuelLevel'] === '') {
            $ok = false;
                } else { $FuelLevel = $_POST['FuelLevel'];
        };
        if (!isset($_POST['Front_Toe']) || $_POST['Front_Toe'] === '') {
            $ok = false;
                } else { $Front_Toe = $_POST['Front_Toe'];
        };
        if (!isset($_POST['Front_ARB']) || $_POST['Front_ARB'] === '') {
            $ok = false;
                } else { $Front_ARB = $_POST['Front_ARB'];
        };
        if (!isset($_POST['LF_Bumpstiffness']) || $_POST['LF_Bumpstiffness'] === '') {
            $ok = false;
                } else { $LF_Bumpstiffness = $_POST['LF_Bumpstiffness'];
        };
        if (!isset($_POST['LF_ReboundStiffness']) || $_POST['LF_ReboundStiffness'] === '') {
            $ok = false;
                } else { $LF_ReboundStiffness = $_POST['LF_ReboundStiffness'];
        };
        if (!isset($_POST['LF_Camber']) || $_POST['LF_Camber'] === '') {
            $ok = false;
                } else { $LF_Camber = $_POST['LF_Camber'];
        };
        if (!isset($_POST['RF_SpringPerch']) || $_POST['RF_SpringPerch'] === '') {
            $ok = false;
                } else { $RF_SpringPerch = $_POST['RF_SpringPerch'];
        };
        if (!isset($_POST['RF_BumpStiffness']) || $_POST['RF_BumpStiffness'] === '') {
            $ok = false;
                } else { $RF_BumpStiffness = $_POST['RF_BumpStiffness'];
        };
        if ($ok) {
            //database go brrrrrr
            $db = new mysqli (MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_CARDATABASE);
            $sql = sprintf(
                "INSERT INTO mx5globaldev (LF_pressure, RF_pressure, LF_SpringPerchOffset, FuelLevel, Front_Toe, Front_ARB, LF_Bumpstiffness, LF_ReboundStiffness, LF_Camber, RF_SpringPerch, RF_BumpStiffness)
                    VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')",
            $db->real_escape_string($LF_Pressure),
            $db->real_escape_string($LF_Pressure),
            $db->real_escape_string($LF_SpringPerchOffset),
            $db->real_escape_string($FuelLevel),
            $db->real_escape_string($Front_Toe),
            $db->real_escape_string($Front_ARB),
            $db->real_escape_string($LF_Bumpstiffness),
            $db->real_escape_string($LF_ReboundStiffness),
            $db->real_escape_string($LF_Camber),
            $db->real_escape_string($RF_SpringPerch),
            $db->real_escape_string($RF_BumpStiffness),
            );
        $db->query($sql);
        echo '<p>Data added.</p>';
        $db->close();
        } else if (!$ok) {
            echo '<p>Data not sent.</p>';
        }
    }
?>
<br>
<br>
<br>
<br>
<form
    action=""
    method="post">
    Fuel level: <input type="text"name="FuelLevel"> liters<br>
    Front Toe in: <input type="text"name="Front_Toe"> milimeters<br>
    Front Anti Rollbar: <input type="text"name="Front_ARB"> stiffness<br>
    Left Front Pressure: <input type= "text" name= "LF_Pressure"> Psi<br>
    Left Front Spring Perch Offset: <input type="text"name="LF_SpringPerchOffset"> milimeters<br>
    Left Front Bump Stiffness: <input type="text"name="LF_Bumpstiffness"> clicks<br>
    Left Front Rebound Stiffnes: <input type="text"name="LF_ReboundStiffness"> clicks<br>
    Left Front Camber: <input type="text"name="LF_Camber"> milimeters<br>
    Right Front Pressure: <input type="text"name="RF_Pressure"> Psi<br>
    Right Front Spring Perch Offset: <input type="text"name="RF_SpringPerch"> milimeters<br>
    Right Front Bump Stiffness: <input type="text"name="RF_BumpStiffness"> clicks<br>
    <!-- Right Front Rebound Stiffnes: <input type="text"name="RF_ReboundStiffness"> clicks<br>
    Right Front Camber: <input type="text"name="RF_Camber"> milimeters<br>
    Right Rear Pressure: <input type="text"name="RR_Pressure"> Psi<br>
    Right Rear Spring Perch Offset: <input type="text"name="RR_SpringPerch"> milimeters<br>
    Right Rear Bump Stiffness: <input type="text"name="RR_BumpStiffness"> clicks<br>
    Right Rear Rebound Stiffnes: <input type="text"name="RR_ReboundStiffness"> clicks<br>
    Right Rear Camber: <input type="text"name="RR_Camber"> milimeters<br>
    Left Rear Pressure: <input type="text"name="LR_Pressure"> Psi<br>
    Left Rear Spring Perch Offset: <input type="text"name="LR_SpringPerch"> milimeters<br>
    Left Rear Bump Stiffness: <input type="text"name="LR_BumpStiffness"> clicks<br>
    Left Rear Rebound Stiffnes: <input type="text"name="LR_ReboundStiffnes"> clicks<br>
    Left Rear Camber: <input type="text"name="LR_Camber"> milimeters<br>
    Rear Toe in: <input type="text"name="Rear_toe"> milimeters<br>
    Rear Anti Rollbar: <input type="text"name="Rear_ARB"> stiffness<br> -->
</select><br>
<input type="submit" name="add" value="Add setup"><br>
</form>