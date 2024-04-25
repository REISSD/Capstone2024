<?php
    session_start();
    include 'db_connection.php';
?>
<!DOCTYPE html>
<html lang="en">
        <meta charset="UTF-8">
        <title>Capstone</title>
        <link rel="stylesheet" type="text/css" href="style.css"/>
          
    <header>
        <div class="header">
            <a href="index.php" class="logo"><img src="./graphic/Logo.png" alt="Logo"></a>
            <div class="header-text">
                <a>Aqua Marine</a>
                <a>Selling Fish, Tanks, and More</a>
            </div>
            <div class="header-right">
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
    <div class="signup">
    <form method="POST" action="insert.php">
            <div>
                    <h1 class="login-text">Hello! New to Aqua Marine?</h1>
                    <h3 class="login-text">Register Here.</h3>
                </div>
                    <input type="text" placeholder="Name" name="name" required>
                <div>
                    <input type="text" placeholder="Email" name="email" required>
                </div>
                <div>
                    <input type="password" class="form-control" placeholder="Password" name="password" required>
                </div>
                <div>
                    <input type="text" placeholder="address" name="address" required>
                </div>
                <div>
                    <input type="submit" placeholder="Submit" name="submit">
                </div>
            </form>
                <div>
                <h3 class="login-text">Already a member? <a href="login.php">Login here</a></h3>
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