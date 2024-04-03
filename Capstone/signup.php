<?php
    include 'db_connection.php';
?>
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
            input[type=password] {
            height: 50px;
            margin: 10px 50px 10px 50px;
            padding-left: 20px;
            border-radius: 5px;
            font-size: 25px;
            }
            input[name="search" i] {
            float: right;
            padding: 6px 20px;
            border-radius: 50px;
            color: black;
            background-color: rgb(132, 197, 223);
            border-color: white;
            margin-right: 30px;
            border: 0;
            }
            .signup {
            background-color: white;
            margin-top: 30px;
            margin-bottom: 30px;
            margin-left: 40%;
            margin-right: 40%;
            width: 455px;
            height: 804px;
        }
    </style>
   
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
    <div class="signup">
    <form method="POST" action="insert.php">
            <div>
                    <h1 class="login-text">Hello! New to Aqua Marine?</h1>
                    <h3 class="login-text">Register Here.</h3>
                </div>
                    <input type="text" name="name" placeholder="Name"  required>
                <div>
                    <input type="text" placeholder="Email" name="email" required>
                </div>
                <div>
                    <input type="password" class="form-control" placeholder="Password" name="password" required>
                </div>
                <div>
                    <input type="text" placeholder="Address" name="address" required>
                </div>
                <div>
                    <input type="submit" placeholder="Submit" name="submit">
                </div>
            </form>
                <div>
                <h3 class="login-text">Already a member? <a href="login.php">Login here</a></h3>
                </div>
        </div>
    
    </div>
    </body>
    <footer>
        <div class="footer">
            <p>© 2024, Aqua Marine.com, Inc. or its affiliates</p>
        </div>
    </footer>
</html>