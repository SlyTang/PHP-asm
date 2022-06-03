<?php
    session_start();
    require_once "../connect/mysqli_conn.php"; 



    $goodsNumber=$_GET['goodsNumber'];



    $sql = " SELECT * FROM Goods WHERE goodsNumber=$goodsNumber ";
        $result = mysqli_query($conn,$sql);
        if(mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
                $remainingStock=$row['remainingStock'];
                $stockPrice=$row['stockPrice'];
                $goodsName=$row['goodsName'];
                $consignmentStoreID=$row['consignmentStoreID'];

            }
        }

    $quantity=$_GET['quantity'];
    if (isset($_SESSION["cart"])) {

        $shoppingCart = $_SESSION["cart"];

        $isTrue = false;
        
        for ($i = 0; $i < count($shoppingCart); $i++) {
            if ($shoppingCart[$i][2] == $goodsNumber) {
                if(($shoppingCart[$i][0]+$quantity) > $remainingStock){
                    echo "<script type='text/javascript'>alert('Not Enought Remaining Stock:');</script>";
                    echo "<script>window.location= 'makeOrder.php' </script>";
                }else{
                    $shoppingCart[$i][0] += $quantity;
                }
                $isTrue = true;
            }
        }

        if (!$isTrue) {
            $shoppingCart[] = array($quantity, $remainingStock,$goodsNumber,$stockPrice,$goodsName);
        }
    } else {
        $shoppingCart[0] = array($quantity, $remainingStock,$goodsNumber,$stockPrice,$goodsName);
        
    }
    $_SESSION["cart"] = $shoppingCart;
        
?>

<!doctype html>
<html>
<head>
    <link rel="stylesheet" href="../CSS/customer.css" type="text/css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Make the Order</title>
</head>
<body>


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
        </ul>
    </nav>
</div>
<center>
    <div class="container" >
        <div style="clear: both"></div>
        <h3 class="title2">Shopping Cart Details</h3>
        <div class="table-responsive">
            <table class="table table-bordered">
            <tr>
                <th width="20%">Product ID</th>
                <th width="40%">Product Name</th>
                <th width="20%">Quantity</th>
                <th width="20%">Product Price</th>
                <th width="30%">Total Price</th>
            </tr>
        <?php
        for($i=0;$i < count($shoppingCart); $i++){
            $sql = "SELECT * FROM Goods ORDER BY goodsNumber ";
            $result = mysqli_query($conn,$sql);
            if(mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_array($result)
    ?>
            <tr>
                <th><?php echo $shoppingCart[$i][2]; ?></th>
                <th><?php echo $shoppingCart[$i][4]; ?></th>
                <th><?php echo $shoppingCart[$i][0]; ?></th>
                <th><?php echo $shoppingCart[$i][3]; ?></th>
                <th><?php echo $shoppingCart[$i][3]*$shoppingCart[$i][0]; ?></th>
            </tr>
<?php
            
            }
        }
?>
        </table>
        </div>
        <form action="makeOrder3.php" mehtod="POST">
            <input type="hidden" value="<?php $consignmentStoreID ?>">
            <?php $_SESSION["cart"]; ?>
            <input type="submit" value="Make Order">
        <form>

    </div>
</center>

</body>
<style>
        @import url('https://fonts.googleapis.com/css?family=Titillium+Web');

        *{
            font-family: 'Titillium Web', sans-serif;
        }
        .product{
            border: 1px solid #eaeaec;
            margin: -1px 19px 3px -1px;
            padding: 10px;
            text-align: center;
            background-color: #efefef;
        }
        table, th, tr{
            text-align: center;
        }
        .title2{
            text-align: center;
            color: #66afe9;
            background-color: #efefef;
            padding: 2%;
        }
        h2{
            text-align: center;
            color: #66afe9;
            background-color: #efefef;
            padding: 2%;
        }
        table th{
            background-color: #efefef;
        }
    </style>
</html>