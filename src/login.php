<header> Homepage </header>


<?php

require 'config.inc.php';

$message = '';

if (isset($_POST['name']) && isset($_POST['password'])) {
    $db = new mysqli (
        MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
    $sql = sprintf("SELECT * FROM users WHERE name='%s'",
        $db->real_escape_string($_POST['name']));

        $result = $db->query($sql);
        $row = $result->fetch_object();

        if ($row != null) {
            $hash = $row->hash;
            if (password_verify($_POST['password'], $hash)) {
                $message = 'Login succesful.';

                require('userpage.php');
                
                $_SESSION['username'] = $row->name;
                $_SESSION['isAdmin'] = $row->isAdmin;
                $_SESSION['isUser'] = $row->isUser;                
            } else {
                $message = 'Invalid Username or password.';
            } 
        } else {
            $message = 'Invalid Username or password.';
        }
    
        $db->close();
}

?>

<?php
echo "<div class='text-info'>$message</div>";
?>

<form method="post" action="">
    <div class="form-group">
        <label for="name">User name<label> <input type="text" name="name" class="form-control">
    </div>
    <div class="form-group">
        <label for="password">Password</label> <input type="password" name="password" class="form-control">
</div>
<input type="submit" value="Login" class="btn btn-primary">
<!-- <input type="submit" value="Register" class="btn btn-secondary"> -->
</form>
</div>
</div>

<footer>
  <p>Author: Lex Bant</p>
  <!-- <p><a href="mailto:hege@example.com">hege@example.com</a></p> -->
</footer>
