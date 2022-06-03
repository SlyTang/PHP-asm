<?php
    require_once "../connect/mysqli_conn.php";
    $sql="SELECT * FROM goods";
    $rs=mysqli_query($conn,$sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../CSS/customer.css" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Managed goods'</title>
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

</head>
<body>
<div class = "mainContent">
<div class="container">
        <div class="goodsData">
            <h2> Managed Goods</h2>
            <hr>
<div class="row">
    <a href = "addGoods.php" class = "btn btn-success" style = "margin-left:80%;"> ADD GOODS </a>    
</div>            
<br/>
<table border=1>
        <tr>
            <th> Number </th>
            <th> StoreID </th>
            <th> Goods Name </th>
            <th> Stock Price </th>
            <th> Remaining Stock </th>
            <th> Status </th>
            <th> EDIT </th>
        </tr>    
<?php
    if($rs){
        while($row = mysqli_fetch_array($rs)){
            ?>
            <tbody>
                <tr>
                    <th> <?php echo $row['goodsNumber'];?> </th>
                    <th> <?php echo $row['consignmentStoreID'];?> </th>
                    <th> <?php echo $row['goodsName'];?> </th>
                    <th> <?php echo $row['stockPrice'];?> </th>
                    <th> <?php echo $row['remainingStock'];?> </th>
                    <th> <?php echo $row['status'];?> </th>
                    <form action = "editGoods.php" method = "post">
                        <input type = "hidden" name = "goodsNumber" value = "<?php echo $row['goodsNumber']?>">
                    <th> <input type = "submit" style="padding: 14px 38px;" name = "edit" class = "btn btn-succcess" value = "EDIT"> </th>
                    </form>
                </tr>
            </tbody>    
            <?php
            
        }
    }else{
        echo "NO Record Found!";
    }
?>     
</table>       
        </div>
    </div>
</div>
</body>
</html>