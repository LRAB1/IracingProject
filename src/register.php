<header>Register here</header>

<?php

    require 'config.inc.php';

    $name = '';
    $password = '';    
//TODDO: failed to add user routine
//This connects to the dabase and allows for users to be added.
    if (isset($_POST['register'])) {
        $ok = true;

        if (!isset($_POST['name']) || $_POST['name'] === '') {
            $ok = false;
                } else { $name = $_POST['name'];
        };
        if (!isset($_POST['password']) || $_POST['password'] === '') {
            $ok = false;
                } else { $password = $_POST['password'];
        };
        if ($ok) {
            //database go brrrrrr
            $hash = password_hash($password, PASSWORD_DEFAULT);

            $db = new mysqli (MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_USERDATABASE);
            $sql = sprintf(
                "INSERT INTO users (name, hash) VALUES ('%s', '%s')",
            $db->real_escape_string($name),
            $db->real_escape_string($hash));
        $db->query($sql);
        echo '<p>User added.</p>';
        $db->close();
        };
    };
?>

<form
    action=""
    method="post">
    Username: <input type="text"name="name"><br>
    Password: <input type="password"name="password"><br>
</select><br>
<input type="submit" name="register" value="Register"><br>
<input type="submit" name="home" value="Home">
</form>