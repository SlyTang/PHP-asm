<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../CSS/customer.css" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Goods</title>
</head>
<body>

<div class="dropdwn">
    <nav>
        <ul>
        <li><a href="tenantMain.php">Home</a></li>
        <li><a href="#">Tenant<i class="fas fa-caret-down"></i> </a>
            <ul>
                <li><a href="manageGoods.php">Managed goods</a></li>
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
    <?php
    require_once "../connect/mysqli_conn.php";

    $goodsNumber = $_POST['goodsNumber'];
    
    $sql = "SELECT * FROM goods WHERE goodsNumber = $goodsNumber ";
    $rs = mysqli_query($conn,$sql);
    if($rs){
        while($row = mysqli_fetch_array($rs,MYSQLI_ASSOC)){
            ?>
    <div class="container">
        <div class="goodsData">
            <h2> Update Data </h2>
            <hr>
            <form action = "<?php echo $_SERVER['PHP_SELF'];?>" method = "post">
                <input type = "hidden" name = "goodsNumber" value = "<?php echo $row['goodsNumber']?>">
                <div class="newGoods">
                    <label for = ""> Consignment Store ID </label>
                    <input type = "text" name = "storeID" class = "goods" value = "<?php echo $row['consignmentStoreID']?>" placeholder = "Enter Consignment Store ID" require>
                </div>
                <div class="newGoods">
                    <label for = ""> Goods Name </label>
                    <input type = "text" name = "gName" class = "goods" value = "<?php echo $row['goodsName']?>" placeholder = "Enter Goods Name" require>
                </div>
                <div class="newGoods">
                    <label for = ""> Stock Price </label>
                    <input type = "text" name = "sPrice" class = "goods" value = "<?php echo $row['stockPrice']?>" placeholder = "Enter Stock Price" require>
                </div>
                <div class="newGoods">
                    <label for = ""> Stock QTY </label>
                    <input type = "text" name = "qty" class = "goods" value = "<?php echo $row['remainingStock']?>" placeholder = "Enter Stock Price" require>
                </div>
                <div class="newGoods">
                    <label for = ""> Status</label>
                    <input type = "text" name = "status" class = "goods" value = "<?php echo $row['status']?>" placeholder = "1 = Available 2 = unavailable" require>
                </div>

                <button type = "submit" name = "update" class = "btn btn-primary" value = "update"> UPDATE </button>

                <a href = "manageGoods.php" class = "btn btn-danger"> CANCEL </a>
            </form>

            <?php
            if(isset($_POST['update'])){
                $consignmentStoreID = $_POST['storeID'];
                $goodsName = $_POST['gName'];
                $stockPrice = $_POST['sPrice'];
                $remainingStock = $_POST['qty'];
                $status = $_POST['status'];
                
                $sql = "UPDATE goods SET consignmentStoreID = '$consignmentStoreID', goodsName = '$goodsName', stockPrice = '$stockPrice',
                remainingStock = '$remainingStock', status = '$status' WHERE goodsNumber = '$goodsNumber'";
                $rs = mysqli_query($conn,$sql);

                if($rs){
                    echo'<script> alert("Date UPDATED!"); window.location.assign("manageGoods.php");</script>';            
                }else{
                    echo'<script> alert("Data NOT Updated!");</script>';
                }
            }
            ?>
        </div>
    </div>
            <?php
        }
    }else{
        echo'<script> alert("NO Record Foound!");</script>';
    }
    ?>
</div>
</body>
</html>