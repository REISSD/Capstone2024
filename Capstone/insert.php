		<?php
		include 'db_connection.php';
		$conn = OpenCon();
		echo "Connected Successfully";
		
		if(isset($_POST['submit']))
		{
		 //Taking all 4 values from the form data(input)
		$name = $_POST['name'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$address = $_POST['address'];
		
		// Performing insert query execution
		// (Name, Username, email, pass, address)
		$sql = "INSERT INTO members (name, email, password, address) 
				  VALUES ('$name','$email','$password', '$address')";
		
		
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
		?>
