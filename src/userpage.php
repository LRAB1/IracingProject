<?php
echo 'Select where you want to go!';
?>

<br>

<form
    action=""
    method="post">
    <?php     
        if (isset($_POST['add'])) {
        require('setuppage.php');
        } 
        
        if (isset($_POST['getsetup'])) {
            require('averagesetup.php');
        }
        if (isset($_POST['devcars'])) {
            require('devcars.php');
        }
        ?>
<input type="submit" name="add" value="Add setup"><br>
<input type="submit" name="getsetup" value="Get setup"><br>
<input type="submit" name="devcars" value="DevCars"><br>