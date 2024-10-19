<?php session_start(); ?>

<h1><header>The Setup Project</header></h1>

<body>
    <h2>What is the setup project?</h2>
    <h4>Well, a little side project that I'm running with some colleagues of mine. To be more clear; it aims to gather data for specific cars in Iracing (currently the Mx5 only)
    to get an average setup for all the tracks and give that back to the user. In later stages I'm looking to add the tracks and make the back-end generate an average setup for each car and track combination.
    This website is in its very early stages and does not either look nice or function all that intuitively. So bear with us as I make this website more functional and user friendly. Sign up and add data,
    or just lurk around and get data.</h4>
</body>

<?php
switch($_GET['action']) {
    case 'login': {
        require('login.php');
        break;
    }
    case 'register': {
        require('register.php');
        break;
    }
    default: {
        ?>
        <a href="/index.php?action=login">Login</a>
        <a href="/index.php?action=register">Register</a>
        <?php
    }
}
?>