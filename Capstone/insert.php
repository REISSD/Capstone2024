		<?php
		include 'db_connection.php';
		$conn = OpenCon();
		echo "Connected Successfully";
		
		if(isset($_POST['submit']))
		{
		 //Taking all 4 values from the form data(input)
		$name = $_POST['name'];
		$email = $_POST['email'];
		$unHashedPassword = $_POST['password'];
		$password = password_hash($unHashedPassword, PASSWORD_DEFAULT);
		$address = $_POST['address'];
		
		// Performing insert query execution
		// (Name, email, pass, address)
		$sql = "INSERT INTO members (name, email, password, address) 
				  VALUES ('$name','$email','$password', '$address')";
		
		
		if(mysqli_query($conn, $sql))
		{
			header('Location: login.php');
        	exit();
		} 
		else
		{
			echo "ERROR:" .mysqli_error($conn);
		}
		mysqli_close($conn);
    	}
		?>
