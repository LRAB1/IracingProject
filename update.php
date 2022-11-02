<?php
//update.php?id=2
if (isset($_GET['id']) && ctype_digit($_GET['id'])) {
    $id = $_GET['id'];
} else {
    header('Location: select.php');
}

    $name = '';
    $gender = '';
    $color = '';

    if (isset($_POST['submit'])) {
        $ok = true;

        if (!isset($_POST['name']) || $_POST['name'] === '') {
            $ok = false;
                } else { $name = $_POST['name'];
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
            $db = new mysqli (
                'localhost:3306',
                'root',
                'Xf@82vosD&aB',
                'php');
            $sql = sprintf(
                "UPDATE users SET name='%s', gender ='%s', color='%s' WHERE id=%s",
            $db->real_escape_string($name),
            $db->real_escape_string($gender),
            $db->real_escape_string($color),
            $id);
        $db->query($sql);
        echo '<p>User updated.</p>';
        $db->close();
        } else {
        $db = new mysqli (
            'localhost:3306',
            'root',
            'Xf@82vosD&aB',
            'php');
            $sql = "SELECT * FROM users WHERE id=$id";
            $result = $db->query($sql);
            foreach ($result as $row) {
                $name = $row['name'];
                $gender = $row['gender'];
                $color = $row['color'];
            }
        $db->close();
    }
?>

<form
    action=""
    method="post">
    Username: <input type="text"name="name"><br>
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
<input type="submit" name="submit" value="Update">
</form>