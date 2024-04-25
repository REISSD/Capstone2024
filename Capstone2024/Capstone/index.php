<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>AquaMarine</title>
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
                <?php
                    if(isset($_SESSION['Members_Id'])) {
                        // Retrieve the logged-in user's ID
                        $membersID = $_SESSION['Members_Id'];
                
                        // Query to fetch user data
                        $sql = "SELECT * FROM members WHERE Members_Id = $membersID";
                        $result = $conn->query($sql);
                
                        if ($result->num_rows > 0) {
                            $userData = $result->fetch_assoc();
                            if ($userData['isAdmin'] == 1) {
                                // User is an admin, show admin link
                                echo '<a href="admin.php">AdminPage</a>';
                            }
                        } else {
                            echo "Error retrieving user data.";
                        }
                    }
                ?>
                <form action="search.php">
                    <input type="text" placeholder="Search" name="search" class="search">
                    <div class="result"></div>
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
                <?php
                // Check if user is logged in
                if(isset($_SESSION['Members_Id'])) {
                    $membersID = $_SESSION['Members_Id'];
                    $cartCountQuery = "SELECT COUNT(*) AS cartCount FROM cart WHERE User_id = $membersID";
                    $cartCountResult = $conn->query($cartCountQuery);
                    if ($cartCountResult) {
                        $cartCountRow = $cartCountResult->fetch_assoc();
                        $cartCount = $cartCountRow['cartCount'];
                        // Output the cart link with the number of items in parentheses
                        echo "<a href='cart.php'>Cart";
                        if ($cartCount > 0) {
                            echo " ($cartCount)";
                        }
                        echo "</a>";
                    } else {
                        // Handle error if needed
                        echo "Error retrieving cart count.";
                    }
                } else {
                    echo '<a href="cart.php">Cart</a>';
                }
                ?>
                <a href="profile.php">Profile</a>
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
            <?php
                // fish
                $sql = "SELECT * FROM fishs WHERE Fishs_id > 4 ";
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
                $sql = "SELECT * FROM tanks WHERE Tanks_id = 3";
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

                $sql = "SELECT * FROM plants WHERE Plants_id = 5";
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