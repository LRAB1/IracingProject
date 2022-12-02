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
    $RF_ReboundStiffness =      '';
    $RF_Camber =                '';
    $RR_Pressure =              '';
    $RR_SpringPerch =           '';
    $RR_BumpStiffness =         '';
    $RR_ReboundStiffness =      '';
    $RR_Camber =                '';
    $LR_Pressure =              '';
    $LR_SpringPerch =           '';
    $LR_BumpStiffness =         '';
    $LR_ReboundStiffnes =       '';
    $LR_Camber =                '';
    $Rear_toe =                 '';
    $Rear_ARB =                 '';
    
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
        if (!isset($_POST['RF_ReboundStiffness']) || $_POST['RF_ReboundStiffness'] === '') {
            $ok = false;
                } else { $RF_ReboundStiffness = $_POST['RF_ReboundStiffness'];
        };
        if (!isset($_POST['RF_Camber']) || $_POST['RF_Camber'] === '') {
            $ok = false;
                } else { $RF_Camber = $_POST['RF_Camber'];
        };
        if (!isset($_POST['RR_Pressure']) || $_POST['RR_Pressure'] === '') {
            $ok = false;
                } else { $RR_Pressure = $_POST['RR_Pressure'];
        };
        if (!isset($_POST['RR_SpringPerch']) || $_POST['RR_SpringPerch'] === '') {
            $ok = false;
                } else { $RR_SpringPerch = $_POST['RR_SpringPerch'];
        };
        if (!isset($_POST['RR_BumpStiffness']) || $_POST['RR_BumpStiffness'] === '') {
            $ok = false;
                } else { $RR_BumpStiffness = $_POST['RR_BumpStiffness'];
        };
        if (!isset($_POST['RR_ReboundStiffness']) || $_POST['RR_ReboundStiffness'] === '') {
            $ok = false;
                } else { $RR_ReboundStiffness = $_POST['RR_ReboundStiffness'];
        };
        if (!isset($_POST['RR_Camber']) || $_POST['RR_Camber'] === '') {
            $ok = false;
                } else { $RR_Camber = $_POST['RR_Camber'];
        };
        if (!isset($_POST['LR_Pressure']) || $_POST['LR_Pressure'] === '') {
            $ok = false;
                } else { $LR_Pressure = $_POST['LR_Pressure'];
        };
        if (!isset($_POST['LR_SpringPerch']) || $_POST['LR_SpringPerch'] === '') {
            $ok = false;
                } else { $LR_SpringPerch = $_POST['LR_SpringPerch'];
        };
        if (!isset($_POST['LR_BumpStiffness']) || $_POST['LR_BumpStiffness'] === '') {
            $ok = false;
                } else { $LR_BumpStiffness = $_POST['LR_BumpStiffness'];
        };
        if (!isset($_POST['LR_ReboundStiffnes']) || $_POST['LR_ReboundStiffnes'] === '') {
            $ok = false;
                } else { $LR_ReboundStiffnes = $_POST['LR_ReboundStiffnes'];
        };
        if (!isset($_POST['LR_Camber']) || $_POST['LR_Camber'] === '') {
            $ok = false;
                } else { $LR_Camber = $_POST['LR_Camber'];
        };
        if (!isset($_POST['Rear_toe']) || $_POST['Rear_toe'] === '') {
            $ok = false;
                } else { $Rear_toe = $_POST['Rear_toe'];
        };
        if (!isset($_POST['Rear_ARB']) || $_POST['Rear_ARB'] === '') {
            $ok = false;
                } else { $Rear_ARB = $_POST['Rear_ARB'];
        };
        if ($ok) {
            //database go brrrrrr
            $db = new mysqli (MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_CARDATABASE);
            $sql = sprintf(
                "INSERT INTO mx5globaldev (LF_pressure, RF_pressure, LF_SpringPerchOffset, FuelLevel, Front_Toe, Front_ARB, LF_Bumpstiffness, LF_ReboundStiffness, LF_Camber, RF_SpringPerch, RF_BumpStiffness, RF_ReboundStiffness,
                    RF_Camber, RR_Pressure, RR_SpringPerch, RR_BumpStiffness, RR_ReboundStiffness, RR_Camber, LR_Pressure, LR_SpringPerch, LR_BumpStiffness, LR_ReboundStiffnes, LR_Camber, Rear_toe, Rear_ARB)
                    VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')",
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
            $db->real_escape_string($RF_ReboundStiffness),
            $db->real_escape_string($RF_Camber),
            $db->real_escape_string($RR_Pressure),
            $db->real_escape_string($RR_SpringPerch),
            $db->real_escape_string($RR_BumpStiffness),
            $db->real_escape_string($RR_ReboundStiffness),
            $db->real_escape_string($RR_Camber),
            $db->real_escape_string($LR_Pressure),
            $db->real_escape_string($LR_SpringPerch),
            $db->real_escape_string($LR_BumpStiffness),
            $db->real_escape_string($LR_ReboundStiffnes),
            $db->real_escape_string($LR_Camber),
            $db->real_escape_string($Rear_toe),
            $db->real_escape_string($Rear_ARB),
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
    Fuel level: <input type="number"name="FuelLevel"> liters<br>
    Front Toe in: <input type="number"name="Front_Toe"> milimeters<br>
    Front Anti Rollbar: <input type="text"name="Front_ARB"> stiffness<br>
    Left Front Pressure: <input type= "number" name= "LF_Pressure"> Psi<br>
    Left Front Spring Perch Offset: <input type="number"name="LF_SpringPerchOffset"> milimeters<br>
    Left Front Bump Stiffness: <input type="number"name="LF_Bumpstiffness"> clicks<br>
    Left Front Rebound Stiffnes: <input type="number"name="LF_ReboundStiffness"> clicks<br>
    Left Front Camber: <input type="number"name="LF_Camber"> milimeters<br>
    Right Front Pressure: <input type="number"name="RF_Pressure"> Psi<br>
    Right Front Spring Perch Offset: <input type="number"name="RF_SpringPerch"> milimeters<br>
    Right Front Bump Stiffness: <input type="number"name="RF_BumpStiffness"> clicks<br>
    Right Front Rebound Stiffnes: <input type="number"name="RF_ReboundStiffness"> clicks<br>
    Right Front Camber: <input type="text"name="number"> milimeters<br>
    Right Rear Pressure: <input type="text"name="number"> Psi<br>
    Right Rear Spring Perch Offset: <input type="number"name="RR_SpringPerch"> milimeters<br>
    Right Rear Bump Stiffness: <input type="number"name="RR_BumpStiffness"> clicks<br>
    Right Rear Rebound Stiffnes: <input type="number"name="RR_ReboundStiffness"> clicks<br>
    Right Rear Camber: <input type="number"name="RR_Camber"> milimeters<br>
    Left Rear Pressure: <input type="number"name="LR_Pressure"> Psi<br>
    Left Rear Spring Perch Offset: <input type="number"name="LR_SpringPerch"> milimeters<br>
    Left Rear Bump Stiffness: <input type="number"name="LR_BumpStiffness"> clicks<br>
    Left Rear Rebound Stiffnes: <input type="number"name="LR_ReboundStiffnes"> clicks<br>
    Left Rear Camber: <input type="number"name="LR_Camber"> milimeters<br>
    Rear Toe in: <input type="number"name="Rear_toe"> milimeters<br>
    Rear Anti Rollbar: <input type="text"name="Rear_ARB"> stiffness<br>
</select><br>
<input type="submit" name="add" value="Add setup"><br>
</form>