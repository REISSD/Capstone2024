<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Capstone</title>
        <link rel="stylesheet" type="text/css" href="style.css"/>
    </head>
    <header>
        <div class="header">
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
        <div class="login">
            <form action="loginForm.php">
                <div>
                    <h1 class="login-text">Hello</h1>
                    <h3 class="login-text">Sign in to Aqua Marine</h3>
                </div>
                <div>
                    <input type="text" placeholder="Email" name="login">
                </div>
                <div>
                    <input type="text" placeholder="Password" name="login">
                </div>
                <div>
                    <input type="submit" placeholder="Submit" name="submit">
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