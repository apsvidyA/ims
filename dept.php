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
*{
	margin: 0;
	padding: 0;
}


body {
  font-family: "Lato", sans-serif;
  background-image: url("3.jpg");
	background-size: cover;
	background-repeat: no-repeat;
	background-attachment: fixed;
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

form {
    width:500px;
    margin:50px auto;
}
.search {
    padding:8px 15px;
    background:rgba(50, 50, 50, 0.2);
    border:0px solid #dbdbdb;
}
.button {
    position:relative;
    padding:6px 15px;
    left:-8px;
    border:2px solid #207cca;
    background-color:#207cca;
    color:#fafafa;
}
.button:hover  {
    background-color:#fafafa;
    color:#207cca;
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

tr:nth-child(odd){background-color: #ffffff;}

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
  <a href="current.php">Current Statistics</a>
  <a href="dept.php">Departmental Statistics</a>
  <a href="purchase.php">Purchase</a>
  <a href="sales.php">Sales</a>
  
  <a href="current.php?logout='1'">Logout</a>
</div>

<div id="main">
  
  <span style="font-size:30px;cursor:pointer;color:white;" onclick="openNav()">&#9776; </span>


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
<div class="search">
<form action = 'dept.php' method="POST"> 
    <input type="text" placeholder="Department..."  name="department" required>
    <input type="submit" value="Search" name="dept_srh">
</form>
</div>




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

if(isset($_POST['dept_srh'])){
$dept = $_POST['department']; 

    $dept = mysqli_real_escape_string($db, $_POST['department']);
    $qi = "SELECT * FROM stock_details WHERE dept_residing = '$dept'";
    $raw_results = $db -> query($qi);
         
    // * means that it selects all fields, you can also write: `id`, `title`, `text`
    // articles is the name of our table
     
    // '%$query%' is what we're looking for, % means anything, for example if $query is Hello
    // it will match "hello", "Hello man", "gogohello", if you want exact match use `title`='$query'
    // or if you want to match just full word so "gogohello" is out use '% $query %' ...OR ... '$query %' ... OR ... '% $query'
     
    if(mysqli_num_rows($raw_results) > 0){ // if one or more rows are returned do following
         
        while($row = $raw_results->fetch_assoc()){
        // $results = mysql_fetch_array($raw_results) puts data from database into array, while it's valid it does the loop
         
            


     
     echo "<tr><td>" . $row['purchase_id']."</td><td>" . $row['stock_id']."</td><td>".$row['stock_name']."</td><td>".$row['quantity']."</td><td>".$row['dept_residing']."</td><td>".$row['consumable']."</td><td>".$row['report']."</td><td>".$row['product_status']."</td></tr>";
   }
   echo "</table>";
 }
 else{
  echo "No results";

 }
}
else{ // if query length is less than minimum
  echo "Minimum length is ".$min_length;
}
// posts results gotten from database(title and text) you can also show id ($results['id'])
        
         
    

?>


</table>
</div>
</body>
</html>