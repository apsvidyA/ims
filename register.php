<!DOCTYPE html>
<html>
<head>
	<title>Register</title>
	<link rel="stylesheet" href="design2.css">
	<link href='https://fonts.googleapis.com/css?family=Macondo' rel='stylesheet'>
	<link href='https://fonts.googleapis.com/css?family=Aclonica' rel='stylesheet'>
</head>
<body>
	<div id="registerblock">
		<h1 id="register">Register</h1>

		<br>
		

		<form action="register.php" method="POST">
			<br><br><input type="text" placeholder="Username" id="box" name="username" required>
			<br><br><input type="email" placeholder="Email" id="box" name="email" required>
			<br><br><input type="password" placeholder="Password" id="box" name="password" required>
			<br><br><input type="submit" value="Submit"  name="reg_user" id="Subbox">

		</form>
	</div>
</body>
</html>

<?php
   include 'connection.php';
   if (isset($_POST['reg_user'])) {
   $username = mysqli_real_escape_string($db, $_POST['username']);
   
   $email = mysqli_real_escape_string($db, $_POST['email']);
   $password = mysqli_real_escape_string($db, $_POST['password']); 
   // Attempt insert query execution
   $sql = "INSERT INTO user_login (username, email, password) VALUES ('$username', '$email', '$password')";
   if(mysqli_query($db, $sql)){
        echo "\n<script>alert('Records added successfully.');</script>";
        
   } else{
       echo "ERROR: Could not able to execute $sql. " . mysqli_error($db);
   }
   }
?>
