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
            <h1>Cart</h1>
    </div>
        <div class="productPage">
            <?php
            // fish insert
            if(isset($_POST['chosenFishID'])) {
                $fishID = $_POST['chosenFishID'];
                
                // Insert the product into the cart table 
                $quantity = 1; 
                $sql = "INSERT INTO cart (user_id, productTable, incart_product, Amount) VALUES ('$userID', 'fishs', '$fishID', '$quantity')";
                
                if ($conn->query($sql) === TRUE) {
                    echo "Product added to cart successfully!";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }

            // tank insert
            if(isset($_POST['chosenTankID'])) {
                $tankID = $_POST['chosenTankID'];
                
                // Insert the product into the cart table
                $quantity = 1; 
                $sql = "INSERT INTO cart (user_id, productTable, incart_product, Amount) VALUES ('$userID', 'tanks', '$tankID', '$quantity')";
                
                if ($conn->query($sql) === TRUE) {
                    echo "Product added to cart successfully!";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }

            // decor insert
            if(isset($_POST['chosenDecorID'])) {
                $decorID = $_POST['chosenDecorID'];
                
                // Insert the product into the cart table
                $quantity = 1; 
                $sql = "INSERT INTO cart (user_id, productTable, incart_product, Amount) VALUES ('$userID', 'decorations', '$decorID', '$quantity')";
                
                if ($conn->query($sql) === TRUE) {
                    echo "Product added to cart successfully!";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }

            // plant insert
            if(isset($_POST['chosenPlantID'])) {
                $plantID = $_POST['chosenPlantID'];
                
                // Insert the product into the cart table
                $quantity = 1; 
                $sql = "INSERT INTO cart (user_id, productTable, incart_product, Amount) VALUES ('$userID', 'plants', '$plantID', '$quantity')";
                
                if ($conn->query($sql) === TRUE) {
                    echo "Product added to cart successfully!";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }


            // remove fish
            if(isset($_POST['removeFishID'])) {
                $removeFishID = $_POST['removeFishID'];
                
                // Delete the product from the cart table
                $sql = "DELETE FROM cart WHERE User_id = $userID AND productTable = 'fishs' AND incart_product = $removeFishID";
                
                if ($conn->query($sql) === TRUE) {
                    echo "Product removed from cart successfully!";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }

            // remove tank
            if(isset($_POST['removeTankID'])) {
                $removeTankID = $_POST['removeTankID'];
                
                // Delete the product from the cart table
                $sql = "DELETE FROM cart WHERE User_id = $userID AND productTable = 'tanks' AND incart_product = $removeTankID";
                
                if ($conn->query($sql) === TRUE) {
                    echo "Product removed from cart successfully!";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }

            // remove decor
            if(isset($_POST['removeDecorID'])) {
                $removeDecorID = $_POST['removeDecorID'];
                
                // Delete the product from the cart table
                $sql = "DELETE FROM cart WHERE User_id = $userID AND productTable = 'decorations' AND incart_product = $removeDecorID";
                
                if ($conn->query($sql) === TRUE) {
                    echo "Product removed from cart successfully!";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }

            // remove plant
            if(isset($_POST['removePlantID'])) {
                $removePlantID = $_POST['removePlantID'];
                
                // Delete the product from the cart table
                $sql = "DELETE FROM cart WHERE User_id = $userID AND productTable = 'plants' AND incart_product = $removePlantID";
                
                if ($conn->query($sql) === TRUE) {
                    echo "Product removed from cart successfully!";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
            // get fish from cart sql
            $sqlFish = "SELECT cart.*, fishs.*
            FROM cart
            LEFT JOIN fishs ON cart.incart_product = fishs.Fishs_id
            WHERE cart.User_id = $userID
            AND cart.productTable = 'fishs'";
            $resultFish = $conn->query($sqlFish);


            // get tanks from cart sql
            $sqlTanks = "SELECT cart.*, tanks.*
            FROM cart
            LEFT JOIN tanks ON cart.incart_product = tanks.Tanks_id
            WHERE cart.User_id = $userID
            AND cart.productTable = 'tanks'";
            $resultTanks = $conn->query($sqlTanks);

            // get decorations from cart sql
            $sqlDecor = "SELECT cart.*, decorations.*
            FROM cart
            LEFT JOIN decorations ON cart.incart_product = decorations.Decorations_id
            WHERE cart.User_id = $userID
            AND cart.productTable = 'decorations'";
            $resultDecor = $conn->query($sqlDecor);

            // get plants from cart sql
            $sqlPlants = "SELECT cart.*, plants.*
            FROM cart
            LEFT JOIN plants ON cart.incart_product = plants.Plants_id
            WHERE cart.User_id = $userID
            AND cart.productTable = 'plants'";
            $resultPlants = $conn->query($sqlPlants);

            if ($resultFish->num_rows == 0 && $resultTanks->num_rows == 0 && $resultDecor->num_rows == 0 && $resultPlants->num_rows == 0) {
                // show cart empty if no products in cart
                echo "Cart is empty";
            } else {
                // show fish
                if ($resultFish->num_rows > 0) {
                    // Output cart items
                    while ($row = $resultFish->fetch_assoc()) {
                        echo "<div class='productSingle'>
                        <img src='./graphic/fish/" . $row['Name'] . ".jpg' alt='fish' class='product-imgSingle'/>
                        <div class='product-textSingle'>
                        <p>" . $row['Name'] . "</p>
                        <p id='description'>Future description</p>
                        <p>$" . $row['Cost'] . "</p>
                        <form method='post' action='cart.php'>
                                <input type='hidden' name='removeFishID' value='" . $row['incart_product'] . "'>
                                <button type='submit' class='addToCart'>Remove</button>
                        </form>
                        </div></div>";
                    }
                }

                // show tanks
                if ($resultTanks->num_rows > 0) {
                    // Output cart items
                    while ($row = $resultTanks->fetch_assoc()) {
                        echo "<div class='productSingle'>
                        <img src='./graphic/tanks/" . $row['Name'] . ".jpg' alt='tank' class='product-imgSingle'/>
                        <div class='product-textSingle'>
                        <p>" . $row['Name'] . "</p>
                        <p id='description'>Future description</p>
                        <p>" . $row['Length'] . 'x' . $row['Width'] . 'x' . $row['Height'] . ' ' . $row['Measurement'] . "</p>
                        <p>$" . $row['Cost'] . "</p>
                        <form method='post' action='cart.php'>
                                <input type='hidden' name='removeTankID' value='" . $row['incart_product'] . "'>
                                <button type='submit' class='addToCart'>Remove</button>
                        </form>
                        </div></div>";
                    }
                }

                // show decor
                if ($resultDecor->num_rows > 0) {
                    // Output cart items
                    while ($row = $resultDecor->fetch_assoc()) {
                        echo "<div class='productSingle'>
                        <img src='./graphic/accessories/" . $row['Name'] . ".jpg' alt='acc' class='product-imgSingle'/>
                        <div class='product-textSingle'>
                        <p>" . $row['Name'] . "</p>
                        <p id='description'>Future description</p>
                        <p>$" . $row['Cost'] . "</p>
                        <form method='post' action='cart.php'>
                                <input type='hidden' name='removeDecorID' value='" . $row['incart_product'] . "'>
                                <button type='submit' class='addToCart'>Remove</button>
                        </form>
                        </div></div>";
                    }
                }

                // show plants
                if ($resultPlants->num_rows > 0) {
                    // Output cart items
                    while ($row = $resultPlants->fetch_assoc()) {
                        echo "<div class='productSingle'>
                        <img src='./graphic/accessories/" . $row['Name'] . ".jpg' alt='acc' class='product-imgSingle'/>
                        <div class='product-textSingle'>
                        <p>" . $row['Name'] . "</p>
                        <p id='description'>Future description</p>
                        <p>$" . $row['Cost'] . "</p>
                        <form method='post' action='cart.php'>
                                <input type='hidden' name='removePlantID' value='" . $row['incart_product'] . "'>
                                <button type='submit' class='addToCart'>Remove</button>
                        </form>
                        </div></div>";
                    }
                }
            }
            ?>
            <!-- Form for submitting the order -->
            <form method="post" action="orders.php">
                <input type="submit" name="submitOrder" value="Place Order">
            </form>
        </div>
    </body>
    <footer>
        <div class="footer">
            <p>© 2024, Aqua Marine.com, Inc. or its affiliates</p>
        </div>
    </footer>
</html>