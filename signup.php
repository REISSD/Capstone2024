<?php
    session_start();
    include 'db_connection.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Capstone</title>
        <link rel="stylesheet" type="text/css" href="style.css"/>
        
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
                    } 
                    else {
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
    </body>
    <footer>
        <div class="footer">
            <p>© 2024, Aqua Marine.com, Inc. or its affiliates</p>
        </div>
    </footer>
</html>