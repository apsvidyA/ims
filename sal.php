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
<!-- 
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
 -->


<?php
  include 'connection.php';

  if (isset($_POST['Sales'])){
    $Purchase_id = mysqli_real_escape_string($db, $_POST['Purchase_id']);
    $sales_id = mysqli_real_escape_string($db,$_POST['sales_id']);
    $stock_id = mysqli_real_escape_string($db,$_POST['stock_id']);
    $date= mysqli_real_escape_string($db, $_POST['sales_date']);
    $time= mysqli_real_escape_string($db, $_POST['sales_time']);
    $stock_Name = mysqli_real_escape_string( $db,$_POST['sales_stock_Name']);
    $Consumable = mysqli_real_escape_string($db, $_POST['consumable']); 
    $Quantity = mysqli_real_escape_string($db, $_POST['quantity']);
    $deliveredfrom = mysqli_real_escape_string($db, $_POST['delivered_from']);
    $deliveredto = mysqli_real_escape_string($db, $_POST['delivered_to']);
    $Cost=mysqli_real_escape_string($db, $_POST['Cost']);
    $Report = mysqli_real_escape_string($db, $_POST['report']);

    if($_POST['sales_id'] == 0){
      $sql = "INSERT INTO sales(purchase_id, stock_id, sales_date,sales_time,stock_name,quantity,consumable,delivered_from,delivered_to,cost,report) values('$Purchase_id','$stock_id','$date','$time','$stock_Name','$Quantity','$Consumable','$deliveredfrom','$deliveredto','$Cost','$Report')";
      
      if(mysqli_query($db, $sql)){
        $las_id = mysqli_insert_id($db);
        $ver = "SELECT * from stock_details where stock_id = '$stock_id'";
        $result = mysqli_query($db, $ver);
        $row = $result -> fetch_assoc();
        $qty = $row['quantity'];
        $Qty = $qty - $Quantity;
        $purchase_id = $row['purchase_id'];
        $stock_Id = $row['stock_id'];
        $stock_ame = $row['stock_name'];
        $deliveredFrom = $row['dept_residing'];
        $consumable = $row['consumable'];
        $report = $row['report'];
        $sales_Id = $row['sales_id'];

        if ($sales_Id == 0){
          $up = "UPDATE stock_details SET quantity = '$Qty', sales_id = '$las_id' where stock_id = '$stock_id'";
          
          if(mysqli_query($db, $up)){
            echo "<script>alert('Records added successfully');</script>";
          }
          
          else{
            echo "ERROR: Could not able to execute $up. " . mysqli_error($db);
          }
        }

        else{
          $up = "INSERT INTO stock_details(purchase_id,stock_name,quantity,dept_residing,consumable,report,sales_id) VALUES('$purchase_id','$stock_ame','$Qty','$deliveredFrom','$consumable','$report','$las_id')";
          
          if(mysqli_query($db, $up)){
            echo "<script>alert('Records added successfully');</script>";
          }
          else{
            echo "ERROR: Could not able to execute $up. " . mysqli_error($db);
          }
        }
        
        header('location: sales.php');  
      }
      
      else{
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($db);
      }
    }

    else{
      $sql = "UPDATE sales SET sales_date = '$date', sales_time = '$time', stock_name = '$stock_Name', quantity = '$Quantity', consumable = '$Consumable', delivered_from = '$deliveredfrom',delivered_to = '$deliveredto', cost= '$Cost',report = '$Report' WHERE sales_id = '$sales_id'";
      
      if(mysqli_query($db, $sql)){
        $ver = "SELECT quantity from stock_details where stock_id = '$stock_id'";
        $result = mysqli_query($db, $ver);
        $row = $result -> fetch_assoc();
        $qty = $row['quantity'];
        $Qty = $qty - $Quantity;
        $upp = "UPDATE stock_details SET quantity = '$Qty', sales_id = '$sales_id' where stock_id = '$stock_id'";
        
        if(mysqli_query($db, $upp)){
          echo "<script>alert('Records updated successfully');</script>";
        }
      
        else{
          echo "ERROR: Could not able to execute $upp. " . mysqli_error($db);
        }

        header('location:sales.php');
      }
      
      else{
          echo "ERROR: Could not able to execute $sql. " . mysqli_error($db);
      }
    }
  }

  // check id for insert
  if(isset($_GET['saled'])){
    $sql = "select * from stock_details where stock_id = '{$_GET['sid']}'";
    $query = mysqli_query($db, $sql);
    $row = $query -> fetch_assoc();
    $Purchase_id = $row['purchase_id'];
    $stock_id = $row['stock_id'];
    $stock_Name = $row['stock_name'];
    $Quantity = $row['quantity'];
    $deliveredfrom = $row['dept_residing'];
    $Consumable = $row['consumable'];
    $Report = $row['report'];
  }


  //check id for edit
  if(isset($_GET['edited'])){
    $sql = "SELECT * FROM sales where sales_id = '{$_GET['eid']}'";
    $query = mysqli_query($db, $sql);
    $row = $query -> fetch_assoc();
    $Purchase_id = $row['purchase_id'];
    $stock_id = $row['stock_id'];
    $sales_id = $row['sales_id'];
    $date = $row['sales_date'];
    $time = $row['sales_time'];
    $stock_Name = $row['stock_name'];
    $Quantity = $row['quantity'];
    $deliveredfrom = $row['delivered_from'];
    $deliveredto = $row['delivered_to'];
    $Consumable = $row['consumable'];
    $Report = $row['report'];
    $Cost = $row['cost'];
  }
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">

      <link rel="stylesheet" href="iconic.css">
      
  
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
  <a href="current.php">Current Statistics</a>
  <a href="dept.php">Departmental Statistics</a>
  <a href="purchase.php">Purchase</a>
  <a href="sales.php">Sales</a>

  <a href="current.php?logout='1'">Logout</a>
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


  
<div style="text-align:'center'" ><b><u>Sales</u></b></div><br><br>
    
    <div id="salesblock">
		
    <br>
		
    <form action="sal.php" method="post">
    <input type="hidden" name="Purchase_id" value="<?php echo $Purchase_id;?>">
    <br><br><label>stock_id : </label><?php echo  $stock_id;?><input type="hidden" name="stock_id" value="<?php echo $stock_id;?>"><br><br></div>
    <br><br><label>sales_id:</label><?php echo $sales_id;?>  <input type="hidden" name='sales_id' value="<?php  echo $sales_id;?>" ><br><br></div>
    <br><br><label for="date">Date:</label><input type="date" name='sales_date' id="date" value="<?php echo $date;?>">
    <br><br><label for="time">Time:</label><input type="time" id="time" name='sales_time' value="<?php echo $time;?>">
    <br><br><label>stock_name:</label><input type="text" name='sales_stock_Name' value="<?php echo $stock_Name;?>"><br><br></div>
    <br><br><label>consumable:</label><input type="text" id="q" name='consumable' value="<?php echo $Consumable;?>"><br><br></div>
    <br><br><label>Quantity:</label><input type="text" id="q" name='quantity' value="<?php echo $Quantity;?>"><br><br></div>
    <br><br><label>Saled from Department:</label><input type="text" id="c" name='delivered_from' value="<?php echo $deliveredfrom;?>"><br><br></div>
    <br><br><label>Saled to:</label><input type="text" id="c" name='delivered_to' value="<?php echo $deliveredto;?>"><br><br></div>
    <br><br> <label>Cost:</label><input type="text" id="t" name='Cost' value="<?php echo $Cost;?>"><br><br></div>
    <br><br><label>Report</label><input type="text" id="a" name='report' value="<?php echo  $Report;?>">
    <br><br><input type = "submit" value="Submit" placeholder="submit" name="Sales">

 </body>
</html>

