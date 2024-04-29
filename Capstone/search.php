<?php
// Start session and include database connection
session_start();
include("db_connection.php");
$conn = OpenCon();

// Check if the search query is set and not empty
if(isset($_GET['search']) && !empty($_GET['search'])) {
    // Sanitize the search query to prevent SQL injection
    $searchQuery = mysqli_real_escape_string($conn, $_GET['search']);
    
    // Perform search query for fish
    $sqlFish = "SELECT Fishs_id AS id, Name, Cost FROM fishs WHERE Name LIKE '%$searchQuery%'";
    $resultFish = $conn->query($sqlFish);

    // Perform search query for tanks
    $sqlTanks = "SELECT Tanks_id AS id, Name, Cost FROM tanks WHERE Name LIKE '%$searchQuery%'";
    $resultTanks = $conn->query($sqlTanks);

    // Perform search query for decorations
    $sqlDecorations = "SELECT Decorations_id AS id, Name, Cost FROM decorations WHERE Name LIKE '%$searchQuery%'";
    $resultDecorations = $conn->query($sqlDecorations);

    // Perform search query for plants
    $sqlPlants = "SELECT Plants_id AS id, Name, Cost FROM plants WHERE Name LIKE '%$searchQuery%'";
    $resultPlants = $conn->query($sqlPlants);

    // Display search results for fish
    if ($resultFish->num_rows > 0) {
        while($row = $resultFish->fetch_assoc()) {    
            echo "<a href='singleProduct.php?fishID=" . $row['id'] . "' class='product-link'><div class='product'>
                        <img src='./graphic/fish/" . $row['Name'] . ".jpg' alt='fish' class='product-img'/>
                        <div class='product-text'>
                        <p>" . $row['Name'] . "</p>
                        <p>$" . $row['Cost'] . "</p>
                        </div></div></a>";
        }
    }

    // Display search results for tanks
    if ($resultTanks->num_rows > 0) {
        while($row = $resultTanks->fetch_assoc()) {    
            echo "<a href='singleProduct.php?tankID=" . $row['id'] . "' class='product-link'><div class='product'>
                        <img src='./graphic/tanks/" . $row['Name'] . ".jpg' alt='tank' class='product-img'/>
                        <div class='product-text'>
                        <p>" . $row['Name'] . "</p>
                        <p>$" . $row['Cost'] . "</p>
                        <p>" . $row['Length'] . 'x' . $row['Width'] . 'x' . $row['Height'] . "</p>
                        <p>" . $row['Measurement'] . "</p>
                        </div></div></a>";
        }
    }

    // Display search results for decorations
    if ($resultDecorations->num_rows > 0) {
        while($row = $resultDecorations->fetch_assoc()) {    
            echo "<a href='singleProduct.php?decorID=" . $row['id'] . "' class='product-link'><div class='product'>
                        <img src='./graphic/accessories/" . $row['Name'] . ".jpg' alt='acc' class='product-img'/>
                        <div class='product-text'>
                        <p>" . $row['Name'] . "</p>
                        <p>$" . $row['Cost'] . "</p>
                        </div></div></a>";
        }
    }

    // Display search results for plants
    if ($resultPlants->num_rows > 0) {
        while($row = $resultPlants->fetch_assoc()) {    
            echo "<a href='singleProduct.php?plantID=" . $row['id'] . "' class='product-link'><div class='product'>
                        <img src='./graphic/accessories/" . $row['Name'] . ".jpg' alt='acc' class='product-img'/>
                        <div class='product-text'>
                        <p>" . $row['Name'] . "</p>
                        <p>$" . $row['Cost'] . "</p>
                        </div></div></a>";
        }
    }

    // If no results found in any table
    if ($resultFish->num_rows == 0 && $resultTanks->num_rows == 0 && $resultDecorations->num_rows == 0 && $resultPlants->num_rows == 0) {
        echo "No results found.";
    }
}
?>
