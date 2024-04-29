<?php

    session_start();        

    //db
    include("db_connection.php");
    $conn = OpenCon();

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
        } 
        else {
            // Error updating status
            echo "Error: " . mysqli_error($conn);
        }       
        header("Location: admin.php");
        exit;
    } 
    else {
        // If form is not submitted, redirect back to admin page
        header("Location: admin.php");
        exit;
    }
?>