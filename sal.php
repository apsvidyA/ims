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
      <link rel="stylesheet" href="sales.css">
      <div style="align:'center'" ><b><u>Sales</u></b></div><br><br>
  </head>
  
  <body>
    
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

