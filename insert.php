<?php

    require 'config.inc.php';

    $name = '';
    $gender = '';
    $color = '';
    $password = '';    

    if (isset($_POST['submit'])) {
        $ok = true;

        if (!isset($_POST['name']) || $_POST['name'] === '') {
            $ok = false;
                } else { $name = $_POST['name'];
        };
        if (!isset($_POST['password']) || $_POST['password'] === '') {
            $ok = false;
                } else { $password = $_POST['password'];
        };
        if (!isset($_POST['gender']) || $_POST['gender'] === '') {
            $ok = false;
                } else { $gender = $_POST['gender'];
        };
        if (!isset($_POST['color']) || $_POST['color'] === '') {
            $ok = false;
                } else { $color = $_POST['color'];
        };
        if ($ok) {
            //database go brrrrrr
            $db = new mysqli (MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
            $sql = sprintf(
                "INSERT INTO users (name, gender, color, password) VALUES ('%s', '%s', '%s', '%s')",
            $db->real_escape_string($name),
            $db->real_escape_string($gender),
            $db->real_escape_string($color),
            $db->real_escape_string($password));
        $db->query($sql);
        echo '<p>User added.</p>';
        $db->close();
        };
    }
?>

<form
    action=""
    method="post">
    Username: <input type="text"name="name"><br>
    Password: <input type="text"name="password"><br>
    Gender:
        <input type="radio" name="gender" value="f"<?php 
            if ($gender === 'f') {
                echo  'checked';
            }
        ?>> Female
        <input type="radio" name="gender" value="m"<?php 
            if ($gender === 'm') {
                echo  'checked';
            }
        ?>> Male
        <input type="radio" name="gender" value="o"<?php 
            if ($gender === 'o') {
                echo  'checked';
            }
        ?>> Other<br>
    Favorite color:
        <select name="color">
            <option value="">Please select</option>
            <option value="#f00">Red</option><?php
            if ($color === '#f00' ) {
                echo ' selected';
            }
            ?>
            <option value="#0f0">Green</option><?php
            if ($color === '#0f0' ) {
                echo ' selected';
            }
            ?>
            <option value="#00f">Blue</option><?php
            if ($color === '#00f' ) {
                echo ' selected';
            }
            ?>
</select><br>
<input type="submit" name="submit" vale="Register">
</form>