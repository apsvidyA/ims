<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="sales.css">
       <div style="align:'center'" ><b><u>Sales</u></b></div><br><br>
    </head>
    <body>
    <div id="salesblock">
		

		<br>
		

		<form action="sales.php" method="post">
<br><br><label>sales_id:</label><input type="text" name='sales_id'><br><br></div>
<br><br><label for="date">Date:</label>
<br><br><label>stock_id:</label><input type="text" name='stock_id'><br><br></div>
<br><br><label for="date">Date:</label>
<br><br><input type="date" name='sales_date' id="date">
<br><br><label for="time">Time:</label>
<br><br><input type="time" id="time" name='sales_time'>
<br><br><label>stock_name:</label><input type="text" name='sales_stock_Name'><br><br></div>
<br><br><label>consumable:</label><input type="text" id="q" name='consumable'><br><br></div>
<br><br><label>Quantity:</label><input type="text" id="q" name='quantity'><br><br></div>
<br><br><label>delivered:</label><input type="text" id="c" name='delivered_to'><br><br></div>
<br><br> <label>Cost:</label><input type="text" id="t" name='Cost'><br><br></div>
<br><br><label>report:</label><br>

<div class="form-check">
        <input class="form-check-input" type="radio" name='Consumable' id="exampleRadios1" value="option1" checked>
        <label class="form-check-label" for="exampleRadios1">
          Yes
        </label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="radio" name='Consumable' id="exampleRadios2" value="option2">
        <label class="form-check-label" for="exampleRadios2">
          No
        </label>
      </div>
      <label>delivered_to</label><input type="text" id="a" name='delivered_to' required>
      <label>Report</label><input type="text" id="a" name='Report'>
      <input type = "submit" value="Submit" placeholder="submit" name="Purchase">

 </body>
</html>
<?php
include 'connection.php';
if (isset($_POST['Sales'])){
$sales_id = mysqli_real_escape_string($db,$_POST['sales_id']);
$stock_id = mysqli_real_escape_string($db,$_POST['stock_id']);
$date= mysqli_real_escape_string($db, $_POST['sales_date']);
$time= mysqli_real_escape_string($db, $_POST['sales_time']);
$stock_Name = mysqli_real_escape_string( $db,$_POST['sales_stock_Name']);
$Consumable = mysqli_real_escape_string($db, $_POST['Consumable']); 
$Quantity = mysqli_real_escape_string($db, $_POST['quantity']);
$delivered = mysqli_real_escape_string($db, $_POST['delivered_to']);
$Cost=mysqli_real_escape_string($db, $_POST['cost']);

$sql = "INSERT INTO `sales`(`sales_id`,`stock_id`,`sales_date`, `sales_time`, `sales_stock_Name`,'Consumable',`quantity`,'delivered_to','cost') 
 VALUES ('$Salesid','$Stockid','$Date','$Time','$Stock_name','$Consumable','$Quantity','$Delivered_to','$Cost')";
   if(mysqli_query($db, $sql)){
    echo "<script>alert('Records added successfully'); window.open('','_self')</script>";
    
} else{
   echo "ERROR: Could not able to execute $sql. " . mysqli_error($db);
}
}
