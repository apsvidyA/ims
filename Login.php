<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" href="design.css">
    <link href='https://fonts.googleapis.com/css?family=Henny Penny' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
	<div id="LoginBlock">
		<h1 id="Login">Login</h1>

		<br>

        <form action="Login.php" method="POST">
			<br><input type="text" placeholder="Username" id="userbox" name="username" required>
			<br>
			<br><input type = "password" name="password" id="userbox" placeholder="Password" required>
			<br><br><input type = "submit" value="Submit" name="login_user" id="submitbox1">
		</form>
		<br>

		<a href="register.php" id="refer"><strong>Don't have an account? Register here!</strong></a>
	</div>


</body>
</html>

<?php
    include 'connection.php';
    session_start();
    if (isset($_POST['login_user'])) {
        $username = mysqli_real_escape_string($db, $_POST['username']);
        $password = mysqli_real_escape_string($db, $_POST['password']);
      
        if (empty($username)) {
            echo "<script>alert('Username is required');</script>";
        }
        if (empty($password)) {
            echo "<script>alert('Password is required');</script>";
        }
        $query = "SELECT * FROM user_login WHERE username='$username' AND password='$password'";
          $results = mysqli_query($db, $query);
          if (mysqli_num_rows($results) == 1) {
            $_SESSION['username'] = $username;
            $_SESSION['success'] = "<script>alert('You are now logged in');</script>";
            header('location: current.php');
          }
          
          
          else {
              echo "<script>alert('Wrong username/password combination');</script>";
          }
        }
?>