<?php
include 'db_connection.php';
$conn = OpenCon();
echo "Connected Successfully";
?>

 <?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Capstone</title>
        <link rel="stylesheet" type="text/css" href="style.css"/>      
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
                <?php
                // Check if user is logged in
                if(isset($_SESSION['Members_Id'])) {
                    echo '<a href="logout.php">Logout</a>'; // Show logout button
                } else {
                    echo '<a href="signup.php">Signup</a>';
                    echo '<a href="login.php">Login</a>';
                }
                ?>
                <a href="aboutus.php">About Us</a>
                <a href="signup.php">Signup</a>
                <a href="login.php">Login</a>
                <a href="orders.php">Orders</a>
                <a href="cart.php">Cart</a>
                <a href="profile.php">Profile</a>
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
                $sql = "SELECT * FROM members WHERE Members_Id = '$currentUser'";
                $results = $conn->query($sql);
                
                if($results){
                    if(mysqli_num_rows($results)>0){
                        while($rows = mysqli_fetch_array($results)){
                            //print_r($rows['Name']);
                            ?>
                             <div>
                            <input type="text" value="<?php echo $rows['Name']?>" name="Name"   required>
                            </div>
                            <label for="Name" style= padding-left:50px; >Name</label>
                            <div>
                            <input type="text" value="<?php echo $rows['email']?>" name="email" required>
                            </div>
                            <label for="email" style= padding-left:50px; >Email</label>
                            <div>
                            <input type="password" value="<?php echo $rows['Password']?>" name="password" required>
                            </div>
                            <label for="password" style= padding-left:50px; >Password</label>
                            <div>
                            <input type="text" value="<?php echo $rows['address']?>" name="Address" required>
                            </div>
                            <label for="Address" style= padding-left:50px; >Address</label>
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
                                //$sql = "INSERT INTO members (name, email, password, address) 
                                //		  VALUES ('$name','$email','$password', '$address')";
                                        
                                $sql = "UPDATE members SET Name = '$name', email= '$email', password='$password', Address='$address',
                                        WHERE Members_Id =$currentUser";
                                    
                                if(mysqli_query($conn, $sql))
                                    {
                                        echo "<script>alert('new record inserted')</script>"; 
                                        echo "<script>window.open('signup.php','_self')</script>";
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