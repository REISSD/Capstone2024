<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Capstone</title>
        <link rel="stylesheet" type="text/css" href="style.css"/>
        <style>
            input[type=text] {
            height: 50px;
            margin: 10px 50px 10px 50px;
            padding-left: 20px;
            border-radius: 5px;
            font-size: 25px;
            }
        </style>
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
        <div class="login">
            <?php  
            if(isset($_SESSION['Members_Id'])) {
                // If user is already logged in
                echo '<h3 class="login-text">You are already logged in.</h3>';
            } else {
                // If user is not logged in, show login form
            ?>
                <form action="login.php" method="POST">
                    <div>
                        <h1 class="login-text">Hello</h1>
                        <h3 class="login-text">Sign in to Aqua Marine</h3>
                    </div>
                    <div>
                        <input class="Name" type="text" placeholder="Name" name="Name">
                    </div>
                    <div>
                        <input type="password" placeholder="Password" name="Password">
                    </div>
                    <div>
                        <input type="submit" placeholder="Submit" name="submit">
                        
                    </div>
                </form> 
                <div>
                    <h3 class="login-text">New Here? <a href="signup.php">Register Here</a></h3>
                </div>
            <?php } ?>
        </div>

        <?php  

        if(isset($_SESSION['Members_Id'])) {
            echo '<h3 class="login-text">You are already logged in.</h3>';
        }

        if(isset($_POST['submit'])) {
            $name = $_POST['Name'];
            $password = $_POST['Password'];

            $sql = "SELECT * FROM members WHERE Name = ?";
            
            if ($stmt = $conn->prepare($sql)) {
                // Bind parameters
                $stmt->bind_param("s", $name);
        
                // Execute the statement
                $stmt->execute();
        
                // Get the result
                $result = $stmt->get_result();
        
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    // Verify the password
                    if (password_verify($password, $row['Password'])) {
                        echo "Logged in";
                        $_SESSION['Members_Id'] = $row['Members_Id'];
                        header("Location: index.php");
                        exit();
                    } else {
                        echo "Login failed";
                    }
                } else {
                    echo "User not found";
                }
            } else {
                echo "Error: " . $conn->error;
            }
        }
        ?>
    </body>
    <footer>
        <div class="footer">
            <p>© 2024, Aqua Marine.com, Inc. or its affiliates</p>
        </div>
    </footer>
</html>