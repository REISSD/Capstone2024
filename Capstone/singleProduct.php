<?php
function generateReviewSection($productID, $productType, $conn) {
    echo '<!-- review section -->
    <div class="product-text"><h2>Product Reviews</h2></div>
    <div class="review-section">
        <form class="comment-form" method="post" action="singleProduct.php?' . $productType . 'ID=' . $productID . '">
            <textarea class="comment-text" name="comment" placeholder="Write your review here"></textarea>
            <input type="hidden" name="' . $productType . 'ID" value="' . $productID . '">
            <button type="submit" name="submit-comment" class="submit-comment">Submit Review</button>
        </form>';

        // Query to fetch reviews for the product
        $stmt = $conn->prepare("SELECT * FROM comments WHERE Product_ID = ? AND Product_Type = ? ORDER BY Comments_id DESC");
        if (!$stmt) {
            die("Error preparing statement: " . $conn->error);
        }
        $stmt->bind_param("is", $productID, $productType);
        if (!$stmt->execute()) {
            die("Error executing statement: " . $stmt->error);
        }
        $result = $stmt->get_result();

        // Display existing reviews
        echo '<div class="comments-list">';
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // get members name
                $sqlMemberName = "SELECT * FROM members WHERE Members_Id = " . $row['Comments_members_id'];
                $resultName = $conn->query($sqlMemberName);
                if ($resultName) {
                    $rowName = $resultName->fetch_assoc();
                    $memberName = $rowName['Name'];
                    $resultName->free_result();
                } else {
                    echo "Error executing query: " . $conn->error;
                }
                echo '<div class="comment">';
                echo '<p class="memberName">' . $memberName . '</p>';
                echo '<p>' . $row['Comments_info'] . '</p>';
                echo '</div>';
            }
            echo '</div>';

            $stmt->close();
        } else {
            echo '<p style="text-align: center; font-family: Arial, Helvetica, sans-serif;">No reviews yet</p>';
        }
    echo '</div>';
}
?>
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
        
        if (isset($_POST['submit-comment'])) {
            // Check if user is logged in
            if(isset($_SESSION['Members_Id'])) {
        
                $comment = $_POST['comment'];
                $membersID = $_SESSION['Members_Id'];
                // Determine product type and ID
                $productType = '';
                $productID = null;
        
                if (!empty($_POST['fishID'])) {
                    $productType = 'fish';
                    $productID = intval($_POST['fishID']);
                } elseif (!empty($_POST['heaterID'])) {
                    $productType = 'heater';
                    $productID = intval($_POST['heaterID']);
                } elseif (!empty($_POST['plantID'])) {
                    $productType = 'plant';
                    $productID = intval($_POST['plantID']);
                } elseif (!empty($_POST['tankID'])) {
                    $productType = 'tank';
                    $productID = intval($_POST['tankID']);
                }
                else{
                    $productType = 'fail';
                    $productID = 100;
                }
        
                // Insert the review into the database
                $stmt = $conn->prepare("INSERT INTO comments (Comments_info, Comments_members_id, Product_ID, Product_Type) VALUES (?, ?, ?, ?)");
                if (!$stmt) {
                    die("Error preparing statement: " . $conn->error);
                }
                $stmt->bind_param("siis", $comment, $membersID, $productID, $productType);
                if (!$stmt->execute()) {
                    die("Error executing statement: " . $stmt->error);
                }
                $stmt->close();
                
            } else {
                // Redirect the user to the login page
                header("Location: login.php");
                exit();
            }
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
                                <label for='quantity'>Quantity:</label>
                                <div class='quantity-input'>
                                    <button type='button' class='quantity-minus'>-</button>
                                    <input type='text' name='quantity' id='quantity' value='1' readonly>
                                    <button type='button' class='quantity-plus'>+</button>
                                </div>
                                <button type='submit' class='addToCart'>Add to Cart</button>
                            </form></div></div>
        </div>";
                    }
                    $productType = "fish";
                    generateReviewSection($fishID, $productType, $conn);
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
                                <label for='quantity'>Quantity:</label>
                                <div class='quantity-input'>
                                    <button type='button' class='quantity-minus'>-</button>
                                    <input type='text' name='quantity' id='quantity' value='1' readonly>
                                    <button type='button' class='quantity-plus'>+</button>
                                </div>
                                <button type='submit' class='addToCart'>Add to Cart</button>
                            </form></div></div>
        </div>";
                    }
                    $productType = "tank";
                    generateReviewSection($tankID, $productType, $conn);
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
                                <label for='quantity'>Quantity:</label>
                                <div class='quantity-input'>
                                    <button type='button' class='quantity-minus'>-</button>
                                    <input type='text' name='quantity' id='quantity' value='1' readonly>
                                    <button type='button' class='quantity-plus'>+</button>
                                </div>
                                <button type='submit' class='addToCart'>Add to Cart</button>
                            </form></div></div>
        </div>";
                    }
                    $productType = "decor";
                    generateReviewSection($decorID, $productType, $conn);
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
                                <label for='quantity'>Quantity:</label>
                                <div class='quantity-input'>
                                    <button type='button' class='quantity-minus'>-</button>
                                    <input type='text' name='quantity' id='quantity' value='1' readonly>
                                    <button type='button' class='quantity-plus'>+</button>
                                </div>
                                <button type='submit' class='addToCart'>Add to Cart</button>
                            </form></div></div>
        </div>";
                    }
                    $productType = "plant";
                    generateReviewSection($plantID, $productType, $conn);
                } else {
                    // do nothing
                }
                
            ?>
            
        

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const minusButton = document.querySelector('.quantity-minus');
                const plusButton = document.querySelector('.quantity-plus');
                const quantityInput = document.getElementById('quantity');

                minusButton.addEventListener('click', function() {
                    const currentValue = parseInt(quantityInput.value);
                    if (currentValue > 1) {
                        quantityInput.value = currentValue - 1;
                    }
                });

                plusButton.addEventListener('click', function() {
                    const currentValue = parseInt(quantityInput.value);
                    quantityInput.value = currentValue + 1;
                });
            });
        </script>
    </body>
    <footer>
        <div class="footer">
            <p>© 2024, Aqua Marine.com, Inc. or its affiliates</p>
        </div>
    </footer>
</html>
