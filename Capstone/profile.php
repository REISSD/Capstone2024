<?php
    include 'db_connection.php';
    $conn = OpenCon();
    //echo "Connected Successfully";
?>

 <?php session_start(); ?>

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
        <div class="profile">
            <form method="POST" action="profile.php" >
                <div>
                    <h1 class="login-text">User Profile Page</h1>
                    <h3 class="login-text">Welcome back to Aqua Marine</h3>
                </div>
            
                <?php
                $currentUser = $_SESSION['Members_Id'];
                $sql = "SELECT * FROM members WHERE Members_Id = $currentUser";
                $results = $conn->query($sql);
                
                if($results){
                    if(mysqli_num_rows($results)>0){
                        while($rows = mysqli_fetch_array($results)){
                            //print_r($rows['Name']);
                            ?>
                            <label for="Name" style= padding-left:50px; >Name</label>
                             <div>
                            <input type="text" value="<?php echo $rows['Name']?>" name="Name"   required>
                            </div>
                            
                            <label for="email" style= padding-left:50px; >Email</label>
                            <div>
                            <input type="text" value="<?php echo $rows['email']?>" name="email" required>
                            </div>
                            
                            <label for="password" style= padding-left:50px; >Password</label>
                            <div>
                            <input type="password" value="" name="password" required>
                            </div>
                            
                            <label for="Address" style= padding-left:50px; >Address</label>
                            <div>
                            <input type="text" value="<?php echo $rows['address']?>" name="Address" required>
                            </div>
                            
                            <div>
                            <input type="submit" placeholder="Update" Name="Update">
                            </div>
                <?php
                            if(isset($_POST['Update']))
                                {
                                //Taking all 4 values from the form data(input)
                                $name = $_POST['Name'];
                                $email = $_POST['email'];
                                $unHashedPassword = $_POST['password'];
                                $password = password_hash($unHashedPassword, PASSWORD_DEFAULT);
                                $address = $_POST['Address'];
                                        
                                // Performing insert query execution
                                // (Name, email, password, address)
                                        
                                $sql = "UPDATE members SET Name = '$name', email= '$email', password='$password', Address='$address'
                                        WHERE Members_Id = $currentUser";
                                    
                                if(mysqli_query($conn, $sql))
                                    {
                                        echo "<p>Status Updated</p>";
                                    } 
                                    else
                                    {
                                        echo "ERROR:" .mysqli_error($conn);
                                    }
                                    mysqli_close($conn);
                                }                       
                        }                  
                    }
                    else
                    {
                    header("Location: signup.php");
                    exit();
                    }
                
                }
                 
                    

    
		?>
               
            </form>
            </div>
        </div>
    </body>
    <footer>
        <div class="footer">
            <p>© 2024, Aqua Marine.com, Inc. or its affiliates</p>
        </div>
    </footer>
</html>