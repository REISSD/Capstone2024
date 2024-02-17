<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Capstone</title>
    <link rel="stylesheet" type="text/css" href="style.css"/>

    <?php
    //db
        define('DB_SERVER', 'localhost');
        define('DB_USERNAME', 'root');
        define('DB_PASSWORD', '');
        define('DB_NAME', 'capstone');
        //$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

        //if ($conn->connect_error) {
        //    die("Connection failed: " . $conn->connect_error);
        //}
    ?>
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
        <!-- testProducts -->
        <div class="body-image body-welcome">
            <h1>WELCOME TO AQUA MARINE</h1>
            <p>Where the best Fish, Tanks, and Accessories are Sold!</p>
            <p>Check out Our Best Products Below</p>
        </div>
        <div class="product-text">
            <h1>Most Popular Products</h1>
        </div>
        <div class="product-list">
            <div class="product">
                <p><img src="./graphic/fish/fish1.jpg" alt="testProduct" class="product-img"/></p>
                <div class="product-text">
                    <p>Test product</p>
                    <p>$12.99</p>
                </div>
            </div>   
            <div class="product">
                <p><img src="./graphic/tanks/tank3.jpg" alt="testProduct" class="product-img"/></p>
                <div class="product-text">
                    <p>Test product</p>
                    <p>$129.99</p>
                </div>
            </div>
            <div class="product">
                <p><img src="./graphic/tanks/tank3.jpg" alt="testProduct" class="product-img"/></p>
                <div class="product-text">
                    <p>Test product</p>
                    <p>$129.99</p>
                </div>
            </div>
            <div class="product">
                <p><img src="./graphic/tanks/tank3.jpg" alt="testProduct" class="product-img"/></p>
                <div class="product-text">
                    <p>Test product</p>
                    <p>$129.99</p>
                </div>
            </div>
        </div>
    </body>
    <footer>
        <div class="footer">
            <p>© 2024, Aqua Marine.com, Inc. or its affiliates</p>
        </div>
    </footer>
</html>