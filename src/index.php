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
// Check if the user is logged in
if (isset($_SESSION['IsLoggedIn']) && $_SESSION['IsLoggedIn'] > 0) {
    // If the user is logged in, show the user page or logout option
    echo '<p>Welcome, ' . $_SESSION['username'] . '!</p>';
    echo '<a href="logout.php">Logout</a>'; // Add a logout option
    require('userpage.php'); // Optionally require the userpage here
} else {
    // If not logged in, check if an action is set in the URL
    if (isset($_GET['action'])) {
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
    } else {
        // If no action is set, show default links
        ?>
        <a href="/index.php?action=login">Login</a>
        <a href="/index.php?action=register">Register</a>
        <?php
    }
}
?>
