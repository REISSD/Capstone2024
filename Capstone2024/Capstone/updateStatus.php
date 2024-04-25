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

// Check if form is submitted
if(isset($_POST['submit'])) {
    // Get the order number and new status from the form
    $orderNumber = $_POST['orderNumber'];
    $newStatus = $_POST['status'];

    // Update the status in the database
    $sql = "UPDATE orders SET Status = '$newStatus' WHERE orderNumber = $orderNumber";

    if(mysqli_query($conn, $sql)) {
        // Status updated successfully
        //echo "<script>alert('Status updated successfully.');</script>";
        //echo "<script>window.location.href = 'admin_page.php';</script>";
    } else {
        // Error updating status
        echo "Error: " . mysqli_error($conn);
    }

    header("Location: admin.php");
    exit;
} else {
    // If form is not submitted, redirect back to admin page
    header("Location: admin.php");
    exit;
}
?>