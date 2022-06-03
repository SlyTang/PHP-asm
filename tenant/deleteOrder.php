<?php
$orderID=$_GET['orderID'];
require_once "../connect/mysqli_conn.php";
$sql="DELETE FROM orders WHERE orderID='$orderID'";

$rs=mysqli_query($conn,$sql);
if(mysqli_affected_rows($conn)>0){
    header("Location: deleteUserOrder.php");
}

?>