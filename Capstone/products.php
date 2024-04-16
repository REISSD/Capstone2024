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
            <h1>Products List</h1>
        </div>
        <div class="product-list">
            <?php
                // fish
                $sql = "SELECT * FROM fishs";
                $result = $conn->query($sql);
                while($row = $result->fetch_assoc()) {    
                    echo "<a href='singleProduct.php?fishID=" . $row['Fishs_id'] . "' class='product-link'><div class='product'>
                        <img src='./graphic/fish/" . $row['Name'] . ".jpg' alt='fish' class='product-img'/>
                        <div class='product-text'>
                        <p>" . $row['Name'] . "</p>
                        <p>$" . $row['Cost'] . "</p>
                        </div></div></a>";
                }

                // tanks
                $sql = "SELECT * FROM tanks";
                $result = $conn->query($sql);
                while($row = $result->fetch_assoc()) {    
                    echo "<a href='singleProduct.php?tankID=" . $row['Tanks_id'] . "' class='product-link'><div class='product'>
                        <img src='./graphic/tanks/" . $row['Name'] . ".jpg' alt='tank' class='product-img'/>
                        <div class='product-text'>
                        <p>" . $row['Name'] . "</p>
                        <p>$" . $row['Cost'] . "</p>
                        <p>" . $row['Length'] . 'x' . $row['Width'] . 'x' . $row['Height'] . "</p>
                        <p>" . $row['Measurement'] . "</p>
                        </div></div></a>";
                }

                // decorations
                $sql = "SELECT * FROM decorations";
                $result = $conn->query($sql);
                while($row = $result->fetch_assoc()) {    
                    echo "<a href='singleProduct.php?decorID=" . $row['Decorations_Id'] . "' class='product-link'><div class='product'>
                        <img src='./graphic/accessories/" . $row['Name'] . ".jpg' alt='acc' class='product-img'/>
                        <div class='product-text'>
                        <p>" . $row['Name'] . "</p>
                        <p>$" . $row['Cost'] . "</p>
                        </div></div></a>";
                }

                // plants
                $sql = "SELECT * FROM plants";
                $result = $conn->query($sql);
                while($row = $result->fetch_assoc()) {    
                    echo "<a href='singleProduct.php?plantID=" . $row['Plants_id'] . "' class='product-link'><div class='product'>
                        <img src='./graphic/accessories/" . $row['Name'] . ".jpg' alt='acc' class='product-img'/>
                        <div class='product-text'>
                        <p>" . $row['Name'] . "</p>
                        <p>$" . $row['Cost'] . "</p>
                        </div></div></a>";
                }
            ?>
            
        </div>
    </body>
    <footer>
        <div class="footer">
            <p>© 2024, Aqua Marine.com, Inc. or its affiliates</p>
        </div>
    </footer>
</html>