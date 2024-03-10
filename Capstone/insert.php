<!DOCTYPE html>
<html>

<head>
	<title>Insert Page</title>
</head>

<body>

		<?php
		
	


		include 'db_connection.php';
		$conn = OpenCon();
		echo "Connected Successfully";
		
		
		// Taking all 4 values from the form data(input)
		$userName = $_REQUEST['userName'];
		$email = $_REQUEST['email'];
		$password = $_REQUEST['password'];
		$address = $_REQUEST['address'];
		
		
		// Performing insert query execution
		$sql = "INSERT INTO user (userName, email, password, address) VALUES ('$userName', 
			'$email','$password','$address')";
		
		if(mysqli_query($conn, $sql)){
			echo "<h3>data stored in a database successfully."
				. " Please browse your localhost php my admin"
				. " to view the updated data</h3>"; 

			echo nl2br("\n$userName\n $email\n "
				. "$password\n $address");
		} else{
			echo "ERROR: Hush! Sorry $sql. "
				. mysqli_error($conn);
		}
		var_dump($_POST);
		// Close connection
		//mysqli_close($conn);
		CloseCon($conn);
		?>
	
</body>

</html>
