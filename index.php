<header>Homepage</header>

<body>
    What is the setup project? Well, a little side project that I'm running with some colleagues of mine. To be more clear; it aims to gather data for specific cars in Iracing (currently the Mx5 only)
    to get an average setup for all the tracks and give that back to the user. In later stages I'm looking to add the tracks and make the back-end generate an average setup for each car and track combination.
    This website is in it's very early stages and does not either look nice or function all that intuitively. So bear with us as I make this website more functional and user friendly. Sign up and add data,
    or just lurk around and get data.
</body>


<form
    action=""
    method="post">
    <?php     
        if (isset($_POST['Login'])) {
        header('Location: login.php');
        } 
        
        if (isset($_POST['Register'])) {
            header('Location: register.php');
        }
        ?>

<input type="submit" name="Register" value="Register" class="btn btn-primary">
<input type="submit" name="Login"value="Login" class="btn btn-secondary">