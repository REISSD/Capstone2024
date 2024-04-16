<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Capstone</title>
    <link rel="stylesheet" type="text/css" href="style.css"/>

    <?php
    session_start();
    //db
        define('DB_SERVER', 'localhost');
        define('DB_USERNAME', 'root');
        define('DB_PASSWORD', '');
        define('DB_NAME', 'capstone');
        $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
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
                <a href="aboutus.php">About Us</a>
                <?php
                // Check if user is logged in
                if(isset($_SESSION['Members_Id'])) {
                    echo '<a href="logout.php">Logout</a>'; // Show logout button
                } else {
                    echo '<a href="signup.php">Signup</a>';
                    echo '<a href="login.php">Login</a>';
                }
                ?>
                <a href="orders.php">Orders</a>
                <a href="cart.php">Cart</a>
                <a href="profile.php">Profile</a>
            </div>
        </div>
    </header>
    <body>   
        <div class="product-text">
            <h1>Product</h1>
        </div>
        <div class="productPage">
            <?php
                
                // Check if productID is set in the URL
                if(isset($_GET['fishID'])) {
                    // Retrieve the productID from the link
                    $fishID = $_GET['fishID'];
                    //echo "Product ID: " . $fishID;
                    $sql = "SELECT * FROM fishs WHERE Fishs_id = $fishID";
                    $result = $conn->query($sql);
                    while($row = $result->fetch_assoc()) {    
                        echo "<div class='productSingle'>
                            <img src='./graphic/fish/" . $row['Name'] . ".jpg' alt='fish' class='product-imgSingle'/>
                            <div class='product-textSingle'>
                            <p>" . $row['Name'] . "</p>
                            <p id='description'>Future description</p>
                            <p>$" . $row['Cost'] . "</p>
                            <form method='post' action='cart.php'>
                                <input type='hidden' name='chosenFishID' value='$fishID'>
                                <button type='submit' class='addToCart'>Add to Cart</button>
                            </form>";
                    }
                } else {
                    // do nothing
                }

                // Check if productID is set in the URL
                if(isset($_GET['tankID'])) {
                    // Retrieve the productID from the link
                    $tankID = $_GET['tankID'];
                    //echo "Product ID: " . $fishID;
                    $sql = "SELECT * FROM tanks WHERE Tanks_id = $tankID";
                    $result = $conn->query($sql);
                    while($row = $result->fetch_assoc()) {    
                        echo "<div class='productSingle'>
                            <img src='./graphic/tanks/" . $row['Name'] . ".jpg' alt='tank' class='product-imgSingle'/>
                            <div class='product-textSingle'>
                            <p>" . $row['Name'] . "</p>
                            <p id='description'>Future description</p>
                            <p>" . $row['Length'] . 'x' . $row['Width'] . 'x' . $row['Height'] . ' ' . $row['Measurement'] . "</p>
                            <p>$" . $row['Cost'] . "</p>
                            <form method='post' action='cart.php'>
                                <input type='hidden' name='chosenTankID' value='$tankID'>
                                <button type='submit' class='addToCart'>Add to Cart</button>
                            </form>";
                    }
                } else {
                    // do nothing
                }

                // Check if productID is set in the URL
                if(isset($_GET['decorID'])) {
                    // Retrieve the productID from the link
                    $decorID = $_GET['decorID'];
                    //echo "Product ID: " . $fishID;
                    $sql = "SELECT * FROM decorations WHERE Decorations_Id = $decorID";
                    $result = $conn->query($sql);
                    while($row = $result->fetch_assoc()) {    
                        echo "<div class='productSingle'>
                            <img src='./graphic/accessories/" . $row['Name'] . ".jpg' alt='acc' class='product-imgSingle'/>
                            <div class='product-textSingle'>
                            <p>" . $row['Name'] . "</p>
                            <p id='description'>Future description</p>
                            <p>$" . $row['Cost'] . "</p>
                            <form method='post' action='cart.php'>
                                <input type='hidden' name='chosenDecorID' value='$decorID'>
                                <button type='submit' class='addToCart'>Add to Cart</button>
                            </form>";
                    }
                } else {
                    // do nothing
                }

                // Check if productID is set in the URL
                if(isset($_GET['plantID'])) {
                    // Retrieve the productID from the link
                    $plantID = $_GET['plantID'];
                    //echo "Product ID: " . $fishID;
                    $sql = "SELECT * FROM plants WHERE Plants_id = $plantID";
                    $result = $conn->query($sql);
                    while($row = $result->fetch_assoc()) {    
                        echo "<div class='productSingle'>
                            <img src='./graphic/accessories/" . $row['Name'] . ".jpg' alt='acc' class='product-imgSingle'/>
                            <div class='product-textSingle'>
                            <p>" . $row['Name'] . "</p>
                            <p id='description'>Future description</p>
                            <p>$" . $row['Cost'] . "</p>
                            <form method='post' action='cart.php'>
                                <input type='hidden' name='chosenPlantID' value='$plantID'>
                                <button type='submit' class='addToCart'>Add to Cart</button>
                            </form>";
                    }
                } else {
                    // do nothing
                }
                
                echo "</div></div>";
            ?>
            
        </div>
    </body>
    <footer>
        <div class="footer">
            <p>© 2024, Aqua Marine.com, Inc. or its affiliates</p>
        </div>
    </footer>
</html>