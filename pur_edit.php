<?php
    include 'connection.php';
    include 'purchase.php';

?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="purchase.css">
       <div style="align:'center'" ><b><u>Purchase</u></b></div><br><br>
    </head>
    <body>
    <div id="purchaseblock">
		

		<br>
		

		<form action="pur_edit.php" method="post">
<br><br><label>Purchase_id:</label><input type="text" name='purchase_id' value="<?php echo "$purchaseId";?>"><br><br></div>
<br><br><label for="date">Date:</label>
<br><br><input type="date" name='newdate' id="date" value='<?php echo "$purchaseDate";?>'>
<br><br><label for="time">Time:</label>
<br><br><input type="time" id="time" name='newtime' value='<?php echo "$purchasetime";?>'>
<br><br><label>Invoice name:</label><input type="text" name='newName' value='<?php echo "$invoiceName";?>'><br><br></div>
<br><br><label>Quantity:</label><input type="text" id="q" name='newquantity'value='<?php echo "$quanTity";?>'><br><br></div>
<br><br><label>Cost Per Unit:</label><input type="text" id="c" name='newpercost'value='<?php echo "$costPerUnit";?>'><br><br></div>
<br><br> <label>Total Cost:</label><input type="text" id="t" name='newtcost' value="<?php echo "$totalCost";?>"><br><br></div>
<br><br><label>Consumable:</label><br><br>

<div class="form-check">
        <input class="form-check-input" type="radio" name='newconsumable' id="exampleRadios1" value="yes" checked>
        <label class="form-check-label" for="exampleRadios1">
          Yes
        </label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="radio" name='newconsumable' id="exampleRadios2" value="no">
        <label class="form-check-label" for="exampleRadios2">
          No
        </label>
      </div><br><br>
      <label>Invoice bought from</label><input type="text" id="a" name='newinvoice' value="<?php echo "$invoiceBroughtFrom";?>" required><br><br>
      <label>Department Distributed</label><input type="text" id="a" name='newdept' value="<?php echo "$distributedToDept";?>" required><br><br>
      <label>Report</label><input type="text" id="a" name='newreport' value="<?php echo "$report";?>"><br><br>
      <input type = "submit" value="Update" placeholder="submit" name="update">


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

  <?php

  $Newdate =   $_POST['newdate'];
  $Newtime =     $_POST['newtime'];
  $NewName = $_POST['newName'];
  
    if(isset($_POST['update'])){
  if( $_POST['newdate'] != $purchaseDate || $_POST['newtime'] != $purchasetime || $_POST['newName'] != $invoiceName || $_POST['newquantity'] != $quanTity || $_POST['newpercost'] != $costPerUnit || $_POST['newtcost'] != $totalCost || $_POST['newinvoice'] != $invoiceBroughtFrom || $_POST['newdept'] != $distributedToDept || $_POST['newreport'] != $report ){
      $sql = 'UPDATE purchase MODIFY purchase_date = $_POST[newdate], purchase_time = $_POST[newtime], invoice_name = $_POST[newName], quantity =  $_POST[newquantity], cost_per_unit = $_POST[newpercost], total_cost = $_POST[newtcost], invoice_bought_from = $_POST[newinvoice], distributed_to_dept = $_POST[newdept], report = $_POST[newreport] where purchase_id = $purchaseId';
      $result = $db -> query($sql);
      if (mysqli_num_rows($results) == 1){
          echo "<script>alert('updated successfully');</script>";
      }
      else{
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($db);
      }
  }
}

  ?>


</body>
</html>



