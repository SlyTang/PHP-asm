<!DOCTYPE html>
<html lang="en">
<head>

<link rel="stylesheet" href="../CSS/customer.css" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generate Report</title>
</head>

<body>

<?php
    require_once "../connect/mysqli_conn.php"; 
    $sql="SELECT * FROM Orders 
        JOIN Orderitem ON Orders.orderID = Orderitem.orderID 
        JOIN Customer ON Orders.customerEmail = Customer.customerEmail 
        JOIN Shop ON Orders.shopID = Shop.shopID
        JOIN Goods ON Orderitem.goodsNumber = Goods.goodsNumber
        WHERE Orders.customerEmail IN (SELECT customerEmail FROM Customer WHERE customerEmail=customerEmail)
        ORDER BY Orders.orderDateTime DESC";
    $rs = mysqli_query($conn,$sql);

?>

<div class="dropdwn">
    <nav>
        <ul>
        <li><a href="tenantMain.php">Home</a></li>
        <li><a href="#">Tenant<i class="fas fa-caret-down"></i> </a>
            <ul>
                <li><a href="manageGoods.php">Managed goods'</a></li>
                <li><a href="generateReport.html">Generate Report</a></li>
                <li><a href="deleteUserOrder.php">Delete user order</a></li>
            </ul>
            <li class = "logout"><a href="../login/logout.php">Logout</a></li>
        </li>
    </nav>
</div>

<div class = "mainContent" style="width: 1300px;">
    <form action="generateReport.php" method="post">
        <h1>Generate Report</h1>
        <table border = "1">
        <tr>
                <th>Order Date</th>
                <th>Order ID</th>
                <th>Customer ID</th>
                <th>Customer Name</th>
                <th>Goods Number</th>
                <th>Goods Name</th>
                <th>QTY</th>
                <th>Selling Price</th>
                <th>Address</th>
                <th>Order Status</th>
                <th>Total Price</th>
            </tr>
        <?php
            while($rc=mysqli_fetch_assoc($rs)){
                echo "<tr>
                <td>$rc[orderDateTime]</td>
                <td>$rc[orderID]</td>
                <td>$rc[customerEmail]</td>
                <td>$rc[lastName]"." "."$rc[firstName]</td>
                <td>$rc[goodsNumber]</td>
                <td>$rc[goodsName]</td>
                <td>$rc[quantity]</td>
                <td>$rc[sellingPrice]</td>
                <td>$rc[address]</td>
                <td>$rc[status]</td>
                <td>$rc[totalPrice]</td>
                </tr>";
            }
?>
    </form>
</div>




        </body>
</html>