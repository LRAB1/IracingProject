<?php
//currently only uploads left front pressure
require 'auth.inc.php';
require 'config.inc.php';

echo 'Userpage, will be setup page';


    $LF_Pressure =              '';
    $RF_Pressure =              '';
    
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
        if ($ok) {
            //database go brrrrrr
            $db = new mysqli (MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_CARDATABASE);
            $sql = sprintf(
                "INSERT INTO mx5globaldev (LF_pressure, RF_pressure) VALUES ('%s', '%s')",
            $db->real_escape_string($LF_Pressure),
            $db->real_escape_string($LF_Pressure),
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
    <!-- Fuel level: <input type="text"name="FuelLevel"> liters<br>
    Front Toe in: <input type="text"name="Front_Toe"> milimeters<br>
    Front Anti Rollbar: <input type="text"name="Front_ARB"> stiffness<br> -->
    Left Front Pressure: <input type= "text" name= "LF_Pressure"> Psi<br>
<!--     Left Front Spring Perch Offset: <input type="text"name="LF_SpringPerch"> milimeters<br>
    Left Front Bump Stiffness: <input type="text"name="LF_Bumpstiffness"> clicks<br>
    Left Front Rebound Stiffnes: <input type="text"name="LF_ReboundStiffness"> clicks<br>
    Left Front Camber: <input type="text"name="LF_Camber"> milimeters<br> -->
    Right Front Pressure: <input type="text"name="RF_Pressure"> Psi<br>
    <!-- Right Front Spring Perch Offset: <input type="text"name="RF_SpringPerch"> milimeters<br>
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
    Rear Anti Rollbar: <input type="text"name="Rear_ARB"> stiffness<br> -->
</select><br>
<input type="submit" name="add" value="Add setup"><br>
</form>