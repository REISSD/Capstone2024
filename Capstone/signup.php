<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Capstone</title>
        <link rel="stylesheet" type="text/css" href="style.css"/>
        
        <?php
        define('DB_SERVER', 'localhost');
        define('DB_USERNAME', 'root');
        define('DB_PASSWORD', '');
        define('DB_NAME', 'capstonefish');
        $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

        if ($conn->connect_error) {
            die("Connection failed: " .  $conn->connect_error);
        }
    ?>
    
    </head>
    <header>
        <div class = "header">
            <a href="index.php" class="logo"><img src="./graphic/Logo.png" alt="Logo"></a>
            <div class="header-text">
                <a>Aqua Marine</a>
                <a>Selling Fish, Tanks, and More</a>
            </div>
            <div class="header-right">
                <form action="search.php">
                    <input type="text" placeholder="Search" name="search">
                </form>
                <!-- NavBar -->
                <a href="products.php">Products</a>
                <a href="aboutus.html">About Us</a>
                <a href="signup.php">Signup</a>
                <a href="login.php">Login</a>
                <a href="orders.php">Orders</a>
                <a href="cart.php">Cart</a>
            </div>
        </div>
    
    </header>
    <body>
    <div class="signup">
    <form action="signup.php">
            <div>
                    <h1 class="login-text">Hello! New to Aqua Marine?</h1>
                    <h3 class="login-text">Register Here.</h3>
                </div>
                <div>
                    <input type="text" placeholder="First Name" name="signup">
                </div>
                <div>
                    <input type="text" placeholder="Last Name" name="signup">
                </div>
                <div>
                    <input type="text" placeholder="Email" name="signup">
                </div>
                <div>
                    <input type="text" placeholder="Address" name="signup">
                </div>
                <div>
                    <input type="text" placeholder="Zipcode" name="signup">
                </div>
                <div>
                    <input type="submit" placeholder="Submit" name="submit">
                </div>
        </div>
    </form>
    </div>
    </body>
    <footer>
        <div class="footer">
            <p>© 2024, Aqua Marine.com, Inc. or its affiliates</p>
        </div>
    </footer>
</html>