<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="purchase.css">
       <div style="align:'center'" ><b><u>Purchase</u></b></div><br><br>
    </head>
    <body>
    <div id="purchaseblock">
		

		<br>
		

		<form action="pur.php" method="post">
<br><br><label>Purchase_id:</label><input type="text" name='Purchase_id'><br><br></div>
<br><br><label for="date">Date:</label>
<br><br><input type="date" name='Purchase_date' id="date">
<br><br><label for="time">Time:</label>
<br><br><input type="time" id="time" name='Purchase_time'>
<br><br><label>Invoice name:</label><input type="text" name='Invoice_Name'><br><br></div>
<br><br><label>Quantity:</label><input type="text" id="q" name='quantity'><br><br></div>
<br><br><label>Cost Per Unit:</label><input type="text" id="c" name='cost_per_unit'><br><br></div>
<br><br> <label>Total Cost:</label><input type="text" id="t" name='Total_cost'><br><br></div>
<br><br><label>Consumable:</label><br>

<div class="form-check">
        <input class="form-check-input" type="radio" name='Consumable' id="exampleRadios1" value="yes" checked>
        <label class="form-check-label" for="exampleRadios1">
          Yes
        </label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="radio" name='Consumable' id="exampleRadios2" value="no">
        <label class="form-check-label" for="exampleRadios2">
          No
        </label>
      </div>
      <label>Invoice bought from</label><input type="text" id="a" name='Invoice_Bought_From' required>
      <label>Department Distributed</label><input type="text" id="a" name='Distributed_toDept' required>
      <label>Report</label><input type="text" id="a" name='Report'>
      <input type = "submit" value="Submit" placeholder="submit" name="Purchase">


<script
  src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous"></script>

  <script>
  
    $('#t').on('click', function(){
        var q = $('#q').val();
        var c = $('#c').val();

        var t =q*c;
        $('#t').val(t);


    })
  </script>
  </form>


</body>
</html>
<?php
include 'connection.php';
if (isset($_POST['Purchase'])){
 $Purchaseid = mysqli_real_escape_string($db,$_POST['Purchase_id']);
 $Date = mysqli_real_escape_string($db,$_POST['Purchase_date']);
 $Time= mysqli_real_escape_string($db, $_POST['Purchase_time']);
$InvoiceName = mysqli_real_escape_string( $db,$_POST['Invoice_Name']);
$Quantity = mysqli_real_escape_string($db, $_POST['quantity']);
$Costperunit = mysqli_real_escape_string($db, $_POST['cost_per_unit']);
$Totalcost = mysqli_real_escape_string($db, $_POST['Total_cost']); 
$Consumable = mysqli_real_escape_string($db, $_POST['Consumable']); 
$Invoiceboughtfrom = mysqli_real_escape_string($db,$_POST['Invoice_Bought_From']);
$DistributedtoDept = mysqli_real_escape_string($db, $_POST['Distributed_toDept']);
$Report = mysqli_real_escape_string($db, $_POST['Report']);

$sql = "INSERT INTO `purchase`( `purchase_id`,`purchase_date`, `purchase_time`, `invoice_name`, `quantity`, `cost_per_unit`, `total_cost`, `consumable`, `invoice_bought_from`, `distributed_to_dept`, `report`)
 VALUES ('$Purchaseid','$Date','$Time','$InvoiceName','$Quantity','$Costperunit','$Totalcost','$Consumable','$Invoiceboughtfrom','$DistributedtoDept','$Report')";

   if(mysqli_query($db, $sql)){
     $inc = "INSERT INTO stock_details(purchase_id, stock_name,quantity,dept_residing,consumable,report) values('$Purchaseid','$InvoiceName','$Quantity','$DistributedtoDept','$Consumable','$Report')";
     if(mysqli_query($db, $inc)){
       echo "<script> alert('Record entered to Current Statistics');</script>";
     }
    echo "<script>alert('Records added successfully'); window.open('','_self')</script>";
    
} else{
   echo "ERROR: Could not able to execute $sql. " . mysqli_error($db);
}
header("location: purchase.php");
}
?>