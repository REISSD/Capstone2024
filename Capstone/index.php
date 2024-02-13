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
        define('DB_PASSWORD', 'mysql');
        define('DB_NAME', 'capstone');
        $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
    ?>
</head>

<body>
    <div class="topDiv">
        <h1>Title of project</h1>
        <div>
            <!-- NavBar -->
            <a href="index.php">Home</a>
            <a href="products.php">Products</a>
            <a href="aboutus.html">About Us</a>
            <a href="signup.php">Signup</a>
            <a href="login.php">Login</a>
        </div>
    </div>

    <!-- testProducts -->
    <div class="productList">
        <div class="product">
            <p><img src="./graphic/fish/fish1.jpg" alt="testProduct" /></p>
            <p>Test product</p>
            <p>$12.99</p>
        </div>

        <div class="product">
            <p><img src="./graphic/tanks/tank3.jpg" alt="testProduct" /></p>
            <p>Test product</p>
            <p>$129.99</p>
        </div>

        <div class="product">
            <p><img src="./graphic/tanks/tank3.jpg" alt="testProduct" /></p>
            <p>Test product</p>
            <p>$129.99</p>
        </div>

        <div class="product">
            <p><img src="./graphic/tanks/tank3.jpg" alt="testProduct" /></p>
            <p>Test product</p>
            <p>$129.99</p>
        </div>
    </div>
</body>
</html>
