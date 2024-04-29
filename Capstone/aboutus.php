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
    <div class="aboutus">
        <h1 class="aboutH">Welcome to Aqua Marine</h1>
        <p class="aboutP">At Aqua Marine, we're dedicated to creating a convenient space for aquatic enthusiasts to find everything they need for their aquariums. Our project began as a Capstone endeavor by four students who noticed a gap in the market for a comprehensive online aquarium store.</p>
    
        <h3 class="aboutH">Our Story</h3>
        <p class="aboutP">Aqua Marine is the result of a Capstone project undertaken by four students. Recognizing the absence of an all-encompassing online aquarium store, we set out to fill that void.</p>
    
        <h3 class="aboutH">Our Mission</h3>
        <p class="aboutP">Our mission at Aqua Marine is straightforward – to be a one-stop destination for all your aquarium needs. Whether you're an experienced hobbyist or just starting, we're here to assist you. We aim to provide a diverse range of high-quality products, reliable advice, and an online community where knowledge is shared.</p>

        <h3 class="aboutH">What Sets Us Apart</h3>
        <p class="aboutP">Expertise: Our team consists of aquarium enthusiasts and experts ready to share their knowledge for your benefit.</p>
        <p class="aboutP">Wide Selection: Explore our extensive range of aquarium supplies, from tanks and filters to exotic fish species and vibrant coral selections, helping you bring your envisioned aquarium to life.</p>
        <p class="aboutP">Community Focus: Join our online forums to connect with fellow enthusiasts and share experiences.</p>
        <p class="aboutP">Sustainability: We're committed to promoting sustainable practices. Our products are responsibly sourced to ensure the well-being of aquatic life and the environment.</p>

        <h3 class="aboutH">Visit Us Today</h3>
        <p class="aboutP">Whether you're a seasoned aquarist or just starting your underwater journey, Aqua Marine welcomes you. Dive into the world of aquatic wonders with us, and let's build a community together.</p>
        <p class="aboutP">Thank you for considering Aqua Marine for your aquatic needs.</p>
        <p class="aboutP">Aqua Marine</p>
    </div>
</body>
<footer>
    <div class="footer">
        <p>© 2024, Aqua Marine.com, Inc. or its affiliates</p>
    </div>
</footer>
</html>