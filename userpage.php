<?php
//currently only uploads left front pressure
require 'auth.inc.php';
require 'config.inc.php';

echo 'Userpage, will be setuppage';


    $LF_Pressure =          ''; ##dummy values
    $LF_SpringPerch =       ''; ##dummy values
    $LF_BumpStiffness =     ''; ##dummy values
    $LF_Camber =            ''; ##dummy values
    $RF_Pressure =          ''; ##dummy values
    $RF_SpringPerch =       ''; ##dummy values
    $RF_BumpStiffness =     ''; ##dummy values
    $RF_ReboundStiffness =  ''; ##dummy values
    $RF_Camber =            ''; ##dummy values
    $RR_Pressure =          ''; ##dummy values
    $RR_SpringPerch =       ''; ##dummy values
    $RR_BumpStiffness =     ''; ##dummy values
    $RR_Camber =            ''; ##dummy values
    $LR_Pressure =          ''; ##dummy values
    $LR_SpringPerch =       ''; ##dummy values
    $LR_BumpStiffness =     ''; ##dummy values
    $LR_ReboundStiffness =  ''; ##dummy values
    $LR_Camber =            ''; ##dummy values
    $FuelLevel =            ''; ##dummy values
    $Front_Toe =            ''; ##dummy values
    $Rear_Toe =             ''; ##dummy values
    $Front_ARB =            ''; ##dummy values
    $Rear_ARB =             ''; ##dummy values

    if (isset($_POST['submit'])) {
        $ok = true;

        if (!isset($_POST['LF_Pressure']) || $_POST['LF_Pressure'] === '') {
            $ok = false;
                } else { $LF_Pressure = $_POST['LF_Pressure'];
        };
/*        if (!isset($_POST['LF_SpringPerch']) || $_POST['LF_SpringPerch'] === '') {
            $ok = false;
                } else { $LF_SpringPerch = $_POST['LF_SpringPerch'];
        };
        if (!isset($_POST['LF_BumpStiffness']) || $_POST['LF_BumpStiffness'] === '') {
            $ok = false;
                } else { $LF_BumpStiffness = $_POST['LF_BumpStiffness'];
        };
        if (!isset($_POST['LF_Camber']) || $_POST['LF_Camber'] === '') {
            $ok = false;
                } else { $LF_Camber = $_POST['LF_Camber'];
        };
        if (!isset($_POST['RF_Pressure']) || $_POST['RF_Pressure'] === '') {
            $ok = false;
                } else { $RF_Pressure = $_POST['RF_Pressure'];
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
        if (!isset($_POST['LR_ReboundStiffness']) || $_POST['LR_ReboundStiffness'] === '') {
            $ok = false;
                } else { $LR_ReboundStiffness = $_POST['LR_ReboundStiffness'];
        };
        if (!isset($_POST['LR_Camber']) || $_POST['LR_Camber'] === '') {
            $ok = false;
                } else { $LR_Camber = $_POST['LR_Camber'];
        };
        if (!isset($_POST['FuelLevel']) || $_POST['FuelLevel'] === '') {
            $ok = false;
                } else { $FuelLevel = $_POST['FuelLevel'];
        };
        if (!isset($_POST['Front_Toe']) || $_POST['Front_Toe'] === '') {
            $ok = false;
                } else { $Front_Toe = $_POST['Front_Toe'];
        };
        if (!isset($_POST['Rear_Toe']) || $_POST['Rear_Toe'] === '') {
            $ok = false;
                } else { $Rear_Toe = $_POST['Rear_Toe'];
        };
        if (!isset($_POST['Front_ARB']) || $_POST['Front_ARB'] === '') {
            $ok = false;
                } else { $Front_ARB = $_POST['Front_ARB'];
        };
        if (!isset($_POST['Rear_ARB']) || $_POST['Rear_ARB'] === '') {
            $ok = false;
                } else { $Rear_ARB = $_POST['Rear_ARB'];
        }; */
        if ($ok) {
            //database go brrrrrr

            $db = new mysqli (MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_IRACINGDATABASE);
            $sql = sprintf(
                "INSERT INTO mx5globaldev (LF_pressure, LF_SpringPerch/* , LF_BumpStiffness, LF_ReboundStiffness, LF_Camber, RF_Pressure, RF_SpringPerch, RF_BumpStiffness, RF_ReboundStiffness, RF_Camber, RR_Pressure,
                RR_SpringPerch, RR_BumpStiffness, RR_ReboundStiffness, RR_Camber, LR_Pressure, LR_SpringPerch, LR_BumpStiffness, LR_ReboundStiffness, LR_Camber, FuelLevel, Front_Toe, Rear_Toe, Front_ARB, Rear_ARB */)
                VALUES ('%s','%s')",
            $db->real_escape_string($LF_Pressure),
            $db->real_escape_string($LF_SpringPerch),
/*             $db->real_escape_string($LF_BumpStiffness),
            $db->real_escape_string($LF_Camber),
            $db->real_escape_string($RF_Pressure),
            $db->real_escape_string($RF_SpringPerch),
            $db->real_escape_string($RF_BumpStiffness),
            $db->real_escape_string($RF_ReboundStiffness),
            $db->real_escape_string($RF_Camber),
            $db->real_escape_string($RR_Pressure),
            $db->real_escape_string($RR_SpringPerch),
            $db->real_escape_string($RR_BumpStiffness),
            $db->real_escape_string($RR_Camber),
            $db->real_escape_string($LR_Pressure),
            $db->real_escape_string($LR_SpringPerch),
            $db->real_escape_string($LR_BumpStiffness),
            $db->real_escape_string($LR_ReboundStiffness),
            $db->real_escape_string($LR_Camber),
            $db->real_escape_string($FuelLevel),
            $db->real_escape_string($Front_Toe),
            $db->real_escape_string($Rear_Toe),
            $db->real_escape_string($Front_ARB),
            $db->real_escape_string($Rear_ARB), */
            );
        $db->query($sql);
        echo '<p>Data added.</p>';
        $db->close();
        };
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
    Left Front Pressure: <input type="text"name="LF_Pressure"> Psi<br>
    Left Front Spring Perch Offset: <input type="text"name="LF_SpringPerch"> milimeters<br>
    Left Front Bump Stiffness: <input type="text"name="LF_Bumpstiffness"> clicks<br>
    Left Front Rebound Stiffnes: <input type="text"name="LF_ReboundStiffness"> clicks<br>
    Left Front Camber: <input type="text"name="LF_Camber"> milimeters<br>
    Right Front Pressure: <input type="text"name="RF_Pressure"> Psi<br>
    Right Front Spring Perch Offset: <input type="text"name="RF_SpringPerch"> milimeters<br>
    Right Front Bump Stiffness: <input type="text"name="RF_BumpStiffness"> clicks<br>
    Right Front Rebound Stiffnes: <input type="text"name="RF_ReboundStiffness"> clicks<br>
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
    Rear Anti Rollbar: <input type="text"name="Rear_ARB"> stiffness<br>
</select><br>
<input type="submit" name="add setup" value="Add setup"><br>
</form>