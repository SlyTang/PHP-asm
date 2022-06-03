<!DOCTYPE html>
<html lang="en">
<head>

    <link rel="stylesheet" href="../CSS/customer.css" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Order Record</title>
</head>

<body>
<?php
require_once "../connect/mysqli_conn.php"; 
$sql="SELECT * FROM Orders
        JOIN Orderitem ON Orders.orderID = Orderitem.orderID 
        JOIN Customer ON Orders.customerEmail = Customer.customerEmail 
        JOIN Shop ON Orders.shopID = Shop.shopID
        JOIN Consignmentstore_shop ON Shop.shopID = Consignmentstore_shop.shopID
        JOIN Consignmentstore ON Consignmentstore_shop.consignmentStoreID = Consignmentstore.consignmentStoreID
        JOIN Goods ON Orderitem.goodsNumber = Goods.goodsNumber
        WHERE Orders.customerEmail IN (SELECT customerEmail FROM Customer WHERE customerEmail=customerEmail)";
$rs = mysqli_query($conn,$sql);

?>


    <div class="dropdwn">
        <nav>
            <ul>
            <li><a href="customerMain.php">Home</a></li>
                <li><a href="#">Customer<i class="fas fa-caret-down"></i> </a>
                    <ul>
                    <li><a href="upDateCusProfile.php">Update Customer Profile</a></li>
                    <li><a href="makeOrder.php">Make the order</a></li>
                    <li><a href="viewOrderRecord.php">View Order Record</a></li>
                    </ul>
                    <li class = "logout"><a href="../login/logout.php">Logout</a></li>
                </li>
        </nav>
    </div>

<div class = "mainContent" style="width:50%">
    <form action="viewOrderRecord.php" method="post">
        <h1>View Order Record</h1>
        <table border = "1">
            <tr>
                <th>Order Date</th>
                <th>Order ID</th>
                <th>Goods Name</th>
                <th>QTY</th>
                <th>Selling Price</th>
                <th>Shop Name</th>
                <th>Shop's Address</th>
                <th>Total Price</th>
                <th>Status</th>
            </tr>

        <?php

            while($rc=mysqli_fetch_assoc($rs)){
                echo "<tr>";
                echo "<td>$rc[orderDateTime]</td>";
                echo "<td>$rc[orderID]</td>";
                echo "<td>$rc[goodsName]</td>";
                echo "<td>$rc[quantity]</td>";
                echo "<td>"." $"."$rc[sellingPrice]</td>";
                echo "<td>$rc[ConsignmentStoreName]</td>";
                echo "<td>$rc[address]</td>";
                echo "<td>"." $"."$rc[totalPrice]</td>";
                $sqlStatus="SELECT * FROM Orders WHERE orderID={$rc["orderID"]}";
                $rsStatus=mysqli_query($conn,$sqlStatus);
                $rcStatus=mysqli_fetch_assoc($rsStatus);
                if($rcStatus['status']==1)
                    echo "<td>Delivery</td>";
                 else if($rcStatus['status']==2)
                    echo "<td>Awaiting</td>";
                else
                    echo "<td>Completed</td>";
                echo "</tr>";
            }
            
?>
    </form>
</div>




        </body>
</html>