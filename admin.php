<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>AboutUs</title>
    <link rel="stylesheet" type="text/css" href="style.css"/>

    <?php
        session_start();
        //db
        include("db_connection.php");
        $conn = OpenCon();
    ?> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        // Function to perform search and update results
        function performSearch(query) {
            if (query.length >= 1) {
                $.ajax({
                    url: 'search.php',
                    type: 'GET',
                    data: { search: query },
                    success: function(response) {
                        $('#search-results').html(response);
                    }
                });
            } else {
                $('#search-results').html('');
            }
        }

        // Listen for keyup event on search input
        $('#search').keyup(function() {
            var query = $(this).val();
            performSearch(query);
        });

        // Prevent form submission on Enter key press
        $('#search').keypress(function(event) {
            if (event.keyCode === 13) {
                event.preventDefault(); // Prevent default form submission behavior
            }
        });
    });
</script>

</head>

    <header>
        <div class="header">
            <a href="index.php" class="logo navBarButton"><img src="./graphic/Logo.png" alt="Logo"></a>
            <div class="header-text">
                <a class="navBarButton">Aqua Marine</a>
                <a class="navBarButton">Selling Fish, Tanks, and More</a>
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
                <form action="search.php" method="GET">
                    <input type="text" placeholder="Search" name="search" id="search">
                    <div id="search-results" class="searchResults"></div>
                </form>
                
                <!-- NavBar -->
                <a href="products.php" class="navBarButton">Products</a>
                <a href="aboutus.php" class="navBarButton">About Us</a>
                <?php
                // Check if user is logged in
                if(isset($_SESSION['Members_Id'])) {
                    echo '<a href="logout.php" class="navBarButton">Logout</a>'; // Show logout button
                } else {
                    echo '<a href="signup.php" class="navBarButton">Signup</a>';
                    echo '<a href="login.php" class="navBarButton">Login</a>';
                }
                ?>
                <a href="orders.php" class="navBarButton">Orders</a>
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
                        echo "<a href='cart.php' class='navBarButton'>Cart";
                        if ($cartCount > 0) {
                            echo " ($cartCount)";
                        }
                        echo "</a>";
                    } else {
                        // Handle error if needed
                        echo "Error retrieving cart count.";
                    }
                } else {
                    echo '<a href="cart.php" class="navBarButton">Cart</a>';
                }
                ?>
                <a href="profile.php" class="navBarButton">Profile</a>
            </div>
        </div>
    </header>
<body>   
<?php
$sql = "SELECT * FROM orders";
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
        $userid = $row['user_id'];
        $status = $row['Status'];
        
        
        if ($orderNumber !== $currentOrderNumber) {
            if ($currentOrderNumber !== null) {
                echo "<h2>Total Cost: $totalCost</h2>";
                echo "<form action='updateStatus.php' method='post' class='admin-drop'>";
                echo "<input type='hidden' name='orderNumber' value='$currentOrderNumber'>";
                echo "<select name='status'>";
                echo "<option value='Pending'>Pending</option>";
                echo "<option value='Processing'>Processing</option>";
                echo "<option value='Shipped'>Shipped</option>";
                echo "<option value='Delivered'>Delivered</option>";
                echo "</select>";
                echo "<input type='submit' name='submit' value='Update Status'>";
                echo "</form>";
                echo "</div>";
            }
            echo "<div class='order-container'>";
            echo "<h2 style='display: inline-block; margin-right: 10px;'>UserID: $userid | Order Number $orderNumber</h2>";
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
    echo "<form action='updateStatus.php' method='post' class=''>";
    echo "<input type='hidden' name='orderNumber' value='$currentOrderNumber'>";
    echo "<select name='status'>";
    echo "<option value='Pending'>Pending</option>";
    echo "<option value='Processing'>Processing</option>";
    echo "<option value='Shipped'>Shipped</option>";
    echo "<option value='Delivered'>Delivered</option>";
    echo "</select>";
    echo "<input type='submit' name='submit' value='Update Status'>";
    echo "</form>";
    echo "</div>";
} else {
    // If there are no orders for the user
    echo "No orders found for this user.";
}
?>
</body>
    <footer>
        <div class="footer">
            <p>© 2024, Aqua Marine.com, Inc. or its affiliates</p>
        </div>
    </footer>
</html>