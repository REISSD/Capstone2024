<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Capstone</title>
        <link rel="stylesheet" type="text/css" href="style.css"/>
        
        <?php
        define('DB_SERVER', 'localhost');
        define('DB_USERNAME', 'root');
        define('DB_PASSWORD', '');
        define('DB_NAME', 'db');
       $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

       if ($conn->connect_error) {
          die("Connection failed: " .  $conn->connect_error);
       }
    ?>
    
    </head>
    <header>
        <div class = "header">
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
            </div>
        </div>
       
    </header>

 <div class="signup">
  <form action="/signup.php">
        <label for="fname">
          First Name
          <input type="text" id="fname" name="firstname" placeholder="Your first name..">
        </label>
 <br> <br>
      <label for="lname">Last Name
      <input type="text" id="lname" name="lastname" placeholder="Your last name..">
      </label>
      <br>  <br>
      <label for="email">Email

      <input type="text" id="email" name="email" placeholder="Your Email">
      </label>
      <br> <br>
      <label for="add">Street Address

      <input type="text" id="add" name="add" placeholder="Your Address">
      </label>
      <br> <br>
      <label for="zip">Zipcode

      <input type="text" id="zip" name="zip" placeholder="Your Zip">
      </label>
      <br> <br>
      <label for="gender">Gender

        <input type="text" id="gender" name="gender" placeholder="Your Gender">
        </label>
        <br>  <br>

  <div class="row">
    <input type="submit" value="Submit">
  </div>
  </form>
</div>

    </body>
</html>
