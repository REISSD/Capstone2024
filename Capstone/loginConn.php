
<?php
session_start();
include "db_connection.php";


$sql = "SELECT * FROM members WHERE Name='$name' AND Password='$password'";

$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) === 1){
    $row = mysqli_fetch_assoc($result);
    if($row['Name'] === $name && $row['Password'] === $password){
        echo "Logged In!";
        $_SESSION['Name'] = $row['Name'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['members_id'] = $row['members_id'];
      
        
        //header("Location: index.php");
        exit();
    }
    else{
       // header("Location: index.php?error=Incorrect User Name or Password");
        exit();
    }
}
else{
    //header("Location: index.php");
    exit();
}
if(isset($_POST['name']) && isset($_POST['password'])){

    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
  
}
if(empty($name)){
    header("Location: index.php?error=User Name is required");
    exit();
}
else if(empty($password)){
    header("Location: index.php?error=Password is required");
    exit();
}
?>
