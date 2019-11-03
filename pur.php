<?php
include 'connection.php';


if(isset($_POST['Purchase'])){
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
    
    
    if($_POST['Purchase_id'] == 0){
        
        //add new student
        $sql = "INSERT INTO `purchase`(`purchase_date`, `purchase_time`, `invoice_name`, `quantity`, `cost_per_unit`, `total_cost`, `consumable`, `invoice_bought_from`, `distributed_to_dept`, `report`)
 VALUES ('$Date','$Time','$InvoiceName','$Quantity','$Costperunit','$Totalcost','$Consumable','$Invoiceboughtfrom','$DistributedtoDept','$Report')";
            
        if(mysqli_query($db, $sql)){
            $last_id = mysqli_insert_id($db);

            $ins = "INSERT INTO stock_details(purchase_id, stock_name,quantity,dept_residing,consumable,report) values('$last_id','$InvoiceName','$Quantity','$DistributedtoDept','$Consumable','$Report')";
            if(mysqli_query($db, $ins)){
                echo "<script> alert('Record entered to Current Statistics');</script>";
            }
            echo "<script>alert('Records added successfully');</script>";
            header('location: purchase.php');
        }
        else{
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($db);
        }

    }
    else{

        //update exist student
        $sql = "UPDATE purchase SET purchase_date = '$Date' , purchase_time = '$Time' , invoice_name = '$InvoiceName' , quantity = '$Quantity' , cost_per_unit = '$Costperunit', total_cost = '$Totalcost', invoice_bought_from = '$Invoiceboughtfrom', distributed_to_dept = '$DistributedtoDept' , report = '$Report' where purchase_id = '$Purchaseid'";
      if(mysqli_query($db, $sql)){
          $upp = "UPDATE stock_details SET stock_name = '$InvoiceName', quantity = '$Quantity', dept_residing = '$DistributedtoDept', consumable = '$Consumable', report = '$Report' where purchase_id = '$Purchaseid'";
          if(mysqli_query($db, $upp)){
        echo "<script>alert('Record updated successfully');</script>"; 
        header('location: purchase.php');       
      }
      else{
        echo "ERROR: Could not able to execute $upp. " . mysqli_error($db);
      }
    }
    else{
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($db);
      }
    }

}


//check edit id
if(isset($_GET['edited'])){
    $sql = "select * from purchase where purchase_id = '{$_GET['pid']}'";
    $query = mysqli_query($db, $sql);
    $row = $query -> fetch_assoc();
    $Purchaseid = $row['purchase_id'];
    $Date = $row['purchase_date'];
    $Time = $row['purchase_time'];
    $InvoiceName = $row['invoice_name'];
    $Quantity = $row['quantity'];
    $Costperunit = $row['cost_per_unit'];
    $Totalcost = $row['total_cost'];
    $Invoiceboughtfrom = $row['invoice_bought_from'];
    $DistributedtoDept = $row['distributed_to_dept'];
    $Report = $row['report'];
}

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
		

		<form action="pur.php" method="post">
<br><br><!-- <label>Purchase_id:</label> --><input type="hidden" name='Purchase_id' value="<?php echo $Purchaseid; ?>"><br><br></div>
<br><br><label for="date">Date:</label>
<br><br><input type="date" name='Purchase_date' id="date" value="<?php echo $Date; ?>">
<br><br><label for="time">Time:</label>
<br><br><input type="time" id="time" name='Purchase_time' value="<?php echo $Time; ?>">
<br><br><label>Invoice name:</label><input type="text" name='Invoice_Name' value="<?php echo $InvoiceName; ?>"><br><br></div>
<br><br><label>Quantity:</label><input type="text" id="q" name='quantity' value="<?php  echo $Quantity; ?>"><br><br></div>
<br><br><label>Cost Per Unit:</label><input type="text" id="c" name='cost_per_unit'value="<?php echo $Costperunit; ?>"><br><br></div>
<br><br> <label>Total Cost:</label><input type="text" id="t" name='Total_cost' value="<?php echo $Totalcost ?>"><br><br></div>
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
      <label>Invoice bought from</label><input type="text" id="a" name='Invoice_Bought_From' value="<?php echo $Invoiceboughtfrom;  ?>" required>
      <label>Department Distributed</label><input type="text" id="a" name='Distributed_toDept'  value="<?php echo $DistributedtoDept; ?>"required>
      <label>Report</label><input type="text" id="a" name='Report' value="<?php  echo $Report; ?>">
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
