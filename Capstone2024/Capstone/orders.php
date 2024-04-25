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
        $userID = $_SESSION['Members_Id'];
        
        // Check if the user is logged in
        if (!isset($_SESSION['Members_Id'])) {
            // Redirect the user to the login page if they're not logged in
            header("Location: login.php");
            exit();
        }

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
            
            
            // Optionally clear the user's cart
            $sqlClearCart = "DELETE FROM cart WHERE User_id = $userID";
            if ($conn->query($sqlClearCart) !== TRUE) {
                echo "Error clearing cart: " . $conn->error;
                // Handle error if needed
            }
            
            // Provide feedback to the user
            echo "Order placed successfully!";
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
    <?php
    // Check if user is logged in
    if(isset($_SESSION['Members_Id'])) {

        // Retrieve the logged-in user's ID
        $membersID = $_SESSION['Members_Id'];

        // Query to fetch orders for the logged-in user
        $sql = "SELECT * FROM orders WHERE user_id = $membersID ORDER BY orderNumber DESC";
        $result = $conn->query($sql);

        // Check if there are any orders for the user
        if ($result->num_rows > 0) {
            $currentOrderNumber = null;
            $itemNumber = 1;
            $totalCost = 0;
            // Output each product in the user's orders
            while ($row = $result->fetch_assoc()) {
                $productTable = $row['productTable'];
                $productID = $row['incart_product'];
                $quantity = $row['Amount'];
                $orderNumber = $row['orderNumber'];
                $status = $row['Status'];
                
                
                if ($orderNumber !== $currentOrderNumber) {
                    if ($currentOrderNumber !== null) {
                        echo "<h2>Total Cost: $totalCost</h2>";
                        echo "</div>";
                    }
                    echo "<div class='order-container'>";
                    echo "<h2 style='display: inline-block; margin-right: 10px;'>Order Number $orderNumber</h2>";
                    echo "<span class='order-status'>Status: $status</span>";
                    $currentOrderNumber = $orderNumber; // Update the current order number
                    $itemNumber = 1; // reset item number and cost
                    $totalCost = 0;
                }

                // Fetch product details based on $productID from the respective tables
                $productDetailsSql = "SELECT * FROM $productTable WHERE ";
                // Adjust the condition based on the structure of your product tables
                if ($productTable === 'fishs') {
                    $productDetailsSql .= "Fishs_id = $productID";
                    $productDetailsResult = $conn->query($productDetailsSql);
                    if ($productDetailsResult && $productDetailsResult->num_rows > 0) {
                        // Output product details
                        $productDetails = $productDetailsResult->fetch_assoc();
                        echo "<div class='order-item'>";
                        echo "<img src='./graphic/fish/{$productDetails['Name']}.jpg' alt='fish' class='order-img'>";
                        echo "<div class='order-item-details'>";
                        echo "<p class='product-name'>{$productDetails['Name']}</p>";
                        echo "<p class='product-quantity'>Quantity: $quantity</p>";
                        echo "<p class='product-price'>Price: {$productDetails['Cost']}</p>"; 
                        echo "</div>"; 
                        echo "</div>"; 
                        $totalCost += $productDetails['Cost'] * $quantity;
                        $itemNumber++;
                    } else {
                        echo "<p>Product details not found.</p>";
                    }
                } 
                elseif ($productTable === 'decorations'){
                    $productDetailsSql .= "Decorations_Id = $productID";
                    $productDetailsResult = $conn->query($productDetailsSql);
                    if ($productDetailsResult && $productDetailsResult->num_rows > 0) {
                        // Output product details
                        $productDetails = $productDetailsResult->fetch_assoc();
                        echo "<div class='order-item'>";
                        echo "<img src='./graphic/accessories/{$productDetails['Name']}.jpg' alt='decor' class='order-img'>";
                        echo "<div class='order-item-details'>";
                        echo "<p class='product-name'>{$productDetails['Name']}</p>";
                        echo "<p class='product-quantity'>Quantity: $quantity</p>";
                        echo "<p class='product-price'>Price: {$productDetails['Cost']}</p>"; 
                        echo "</div>"; 
                        echo "</div>"; 
                        $totalCost += $productDetails['Cost'] * $quantity;
                        $itemNumber++;
                    } else {
                        echo "<p>Product details not found.</p>";
                    }
                }
                elseif ($productTable === 'tanks'){
                    $productDetailsSql .= "Tanks_id = $productID";
                    $productDetailsResult = $conn->query($productDetailsSql);
                    if ($productDetailsResult && $productDetailsResult->num_rows > 0) {
                        // Output product details
                        $productDetails = $productDetailsResult->fetch_assoc();
                        echo "<div class='order-item'>";
                        echo "<img src='./graphic/tanks/{$productDetails['Name']}.jpg' alt='tank' class='order-img'>";
                        echo "<div class='order-item-details'>";
                        echo "<p class='product-name'>{$productDetails['Name']}</p>";
                        echo "<p class='product-quantity'>Quantity: $quantity</p>";
                        echo "<p class='product-price'>Price: {$productDetails['Cost']}</p>"; 
                        echo "</div>"; 
                        echo "</div>"; 
                        $totalCost += $productDetails['Cost'] * $quantity;
                        $itemNumber++;
                    } else {
                        echo "<p>Product details not found.</p>";
                    }
                }
                elseif ($productTable === 'plants'){
                    $productDetailsSql .= "Plants_id = $productID";
                    $productDetailsResult = $conn->query($productDetailsSql);
                    if ($productDetailsResult && $productDetailsResult->num_rows > 0) {
                        // Output product details
                        $productDetails = $productDetailsResult->fetch_assoc();
                        echo "<div class='order-item'>";
                        echo "<img src='./graphic/accessories/{$productDetails['Name']}.jpg' alt='fish' class='order-img'>";
                        echo "<div class='order-item-details'>";
                        echo "<p class='product-name'>{$productDetails['Name']}</p>";
                        echo "<p class='product-quantity'>Quantity: $quantity</p>";
                        echo "<p class='product-price'>Price: {$productDetails['Cost']}</p>"; 
                        echo "</div>"; 
                        echo "</div>"; 
                        $totalCost += $productDetails['Cost'] * $quantity;
                        $itemNumber++;
                    } else {
                        echo "<p>Product details not found.</p>";
                    }
                }
                
            }
            echo "<h2>Total Cost: $totalCost</h2>";
            echo "</div>";
        } else {
            // If there are no orders for the user
            echo "No orders found for this user.";
        }

        // Close the database connection
        $conn->close();
    } else {
        // If user is not logged in
        echo "User not logged in!";
    }
    ?>
</body>

<footer>
        <div class="footer">
            <p>© 2024, Aqua Marine.com, Inc. or its affiliates</p>
        </div>
</footer>
</html>