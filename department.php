<?php 
  session_start(); 

  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: Login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: Login.php");
  }
?>
<!-- <!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>


	<h2>Home Page</h2>

  	 //notification message
  	<?php if (isset($_SESSION['success'])) : ?>
      	<h3>
          <?php 
          	echo $_SESSION['success']; 
          	unset($_SESSION['success']);
          ?>
      	</h3>
  	<?php endif ?>

    // logged in user information
    <?php  if (isset($_SESSION['username'])) : ?>
    	<p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>
    	<p> <a href="index.php?logout='1'" style="color: red;">logout</a> </p>
    <?php endif ?>
</div>
		
</body>
</html> -->

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
  font-family: "Lato", sans-serif;
}

.sidenav {
  height: 100%;
  width: 0;
  position: fixed;
  z-index: 1;
  top: 0;
  left: 0;
  background-color: #111;
  overflow-x: hidden;
  transition: 0.5s;
  padding-top: 60px;
}

.sidenav a {
  padding: 8px 8px 8px 32px;
  text-decoration: none;
  font-size: 25px;
  color: #818181;
  display: block;
  transition: 0.3s;
}

.sidenav a:hover {
  color: #f1f1f1;
}

.sidenav .closebtn {
  position: absolute;
  top: 0;
  right: 25px;
  font-size: 36px;
  margin-left: 50px;
}

#main {
  transition: margin-left .5s;
  padding: 16px;
}

@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}

table{
  border-collapse: collapse;
  width: 100%;
  text-align: center;
  
}

td,th{
  border: 1px #603cba;
  padding: 8px;
  text-align: center;
}

tr:nth-child(even){background-color: #f2f2f2;}

tr:hover {background-color: #ddd;}

th {
  padding-top: 12px;
  padding-bottom: 12px;
  padding: 12px;
  text-align: center;
  background-color: #603cba;
  color: white;
}

td{
  text-align: center;
  padding:10px;
}




</style>
</head>
<body>

<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a href="index.php">Current Statistics</a>
  <a href="dept.php">Departmental Statistics</a>
  <a href="purchase.php">Purchase</a>
  <a href="sales.php">Sales</a>
  <a href="about.html">About</a>
  <a href="index.php?logout='1'">Logout</a>
</div>

<div id="main">
  
  <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; </span>


<script>
function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
  document.getElementById("main").style.marginLeft = "250px";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
  document.getElementById("main").style.marginLeft= "0";
}
</script>


<table>
<tr>
  <th>Purchase ID</th>
  <th>Stock ID</th>
  <th>Stock Name</th>
  <th>Quantity</th>
  <th>Department Residing</th>
  <th>Consumable</th>
  <th>Report</th>
  <th>Product Status</th>
  <th>Direct to Sales</th>
  </tr>

<?php
  include "connection.php";
  include "dept.php";
  if(isset($_POST['dept_srh'])){
     $department =  mysqli_real_escape_string($db, $_POST['department']);
     $sql = "SELECT * FROM dept_wise_details WHERE dept_residing='$department'";
    $result = $db -> query($sql);
 
 if ($result->num_rows > 0){
   while($row = $result->fetch_assoc()){
     echo "<tr><td>" . $row['purchase_id']."</td><td>" . $row['stock_id']."</td><td>".$row['stock_name']."</td><td>".$row['quantity']."</td><td>".$row['dept_residing']."</td><td>".$row['consumable']."</td><td>".$row['report']."</td><td>".$row['product_status']."</td></tr>";
   }
   echo "</table>";
 }
 else{
   echo "<script>alert('no entries added yet'); window.open('','_self')</script>";
 }
}
?>

</table>
</div>   
</body>
</html>