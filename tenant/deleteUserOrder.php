<?php
    require_once "../connect/mysqli_conn.php";
    $sql="SELECT * FROM orders";
    $rs=mysqli_query($conn,$sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../CSS/customer.css" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Order</title>
</head>

<body>

<div class="dropdwn">
    <nav>
        <ul>
        <li><a href="tenantMain.php">Home</a></li>
        <li><a href="#">Tenant<i class="fas fa-caret-down"></i> </a>
            <ul>
                <li><a href="manageGoods.php">Managed goods'</a></li>
                <li><a href="generateReport.php">Generate Report</a></li>
                <li><a href="deleteUserOrder.php">Delete user order</a></li>
            </ul>
            <li class = "logout"><a href="../login/logout.php">Logout</a></li>
        </li>
    </nav>
</div>

<div class = "mainContent">
    <form action="deleteOrder.php" method="GET" >
        <h1>Delete Order</h1>
        <table border=1>
        <tr>
            <th>Action</th>
            <th>Order ID</th>
            <th>customerEmail</th>
            <th>consignmentStoreID</th>
            <th>shopID</th>
            <th>orderDateTime</th>
            <th>status</th>
            <th>totalPrice</th>
        </tr>
        <?php
            while($rc=mysqli_fetch_assoc($rs)){
        ?>  
            <tr>
                <?php
                    printf("<td><a href='deleteOrder.php?orderID=%s'>Delete</a></td>",$rc['orderID']);

                ?>
                <td><?php echo $rc['orderID'] ?></td>
                <td><?php echo $rc['customerEmail'] ?></td>
                <td><?php echo $rc['consignmentStoreID'] ?></td>
                <td><?php echo $rc['shopID'] ?></td>
                <td><?php echo $rc['orderDateTime'] ?></td>
                <td><?php echo $rc['status'] ?></td>
                <td><?php echo "$".$rc['totalPrice'] ?></td>
            </tr>
        <?php
            };
            mysqli_free_result($rs);
            mysqli_close($conn);
        ?>
        </table>
    </form>
</div>

</body>
</html>