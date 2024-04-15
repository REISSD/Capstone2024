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
        $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        session_start();
        //$_SESSION['user_id'] = 1;
        $userID = $_SESSION['user_id'];
        
        // Check if the user is logged in
        if (!isset($_SESSION['user_id'])) {
            // Redirect the user to the login page if they're not logged in
            header("Location: login.php");
            exit();
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
                <a href="aboutus.html">About Us</a>
                <a href="signup.php">Signup</a>
                <a href="login.php">Login</a>
                <a href="orders.php">Orders</a>
                <a href="cart.php">Cart</a>
                <a href="profile.php">Profile</a>
            </div>
        </div>
</header>
<body>   
    <?php
    // Check if the user submits the order
    if(isset($_POST['submitOrder'])) {
        // Retrieve user's cart items
        $sqlCart = "SELECT * FROM cart WHERE User_id = $userID";
        $resultCart = $conn->query($sqlCart);

        $sqlOrderNumber = "SELECT orderNumber FROM members WHERE Members_id = $userID";
        $resultOrderNumber = $conn->query($sqlOrderNumber);

        // Check if the user has an existing order number
        if ($resultOrderNumber->num_rows > 0) {
            $row = $resultOrderNumber->fetch_assoc();
            $orderNumber = $row['orderNumber'];
            $orderNumber++; // Increment the order number
        } else {
            $orderNumber = 1; // Start with 1 if no order number exists
        }
        
        // update orderNumber in memebers table
        $sqlUpdateOrderNumber = "UPDATE members SET orderNumber = $orderNumber WHERE Members_id = $userID";
        if ($conn->query($sqlUpdateOrderNumber) !== TRUE) {
            echo "Error updating order number: " . $conn->error;
        }

        // Insert cart items into the order table
        while ($row = $resultCart->fetch_assoc()) {
            $productId = $row['incart_product'];
            $productTable = $row['productTable'];
            $quantity = $row['Amount'];
            $status = "pending"; 
            
            // Insert cart item into the order table
            $sqlOrder = "INSERT INTO orders (status, orderNumber, user_id, incart_product, Amount, productTable) VALUES ('$status', '$orderNumber', $userID, '$productId', '$quantity', '$productTable')";
            if ($conn->query($sqlOrder) !== TRUE) {
                echo "Error inserting order: " . $conn->error;
            }
        }
        
        /*
        // Optionally clear the user's cart
        $sqlClearCart = "DELETE FROM cart WHERE User_id = $userID";
        if ($conn->query($sqlClearCart) !== TRUE) {
            echo "Error clearing cart: " . $conn->error;
            // Handle error if needed
        }
        */
        // Provide feedback to the user
        echo "Order placed successfully!";
    }
    ?>
</body>

<footer>
        <div class="footer">
            <p>© 2024, Aqua Marine.com, Inc. or its affiliates</p>
        </div>
</footer>
</html>