<?php 
include 'connection.php';

if(isset($_GET['deleted'])){
    $sal_id = $_GET['eid'];
    $esq = "SELECT stock_id FROM sales WHERE sales_id = '$sal_id'";
    $query = mysqli_query($db, $esq);
    $row = $query -> fetch_assoc();
    $stk_id = $row['stock_id'];
    $sql = "delete from sales where sales_id = '{$_GET['eid']}'";
    if(mysqli_query($db, $sql)){
        
        $con = "UPDATE stock_details SET sales_id = NULL where stock_id = '$stk_id'";
        if(mysqli_query($db, $con)){
            echo "\n<script>alert('Records deleted successfully.');</script>";
        }
        header('location: sales.php');  
    }

    else{
       echo "ERROR: Could not able to execute $sql. " . mysqli_error($db);
   }
}

?>