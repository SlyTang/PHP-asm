<?php
    session_start();
    require_once "../connect/mysqli_conn.php";

    $array=array();

?>
<!DOCTYPE html>
<html lang="en">
<head>

    <link rel="stylesheet" href="../CSS/customer.css" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Make The Order</title>
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

<script>
function changeURL(id) {
    var elementID1 = "input" + id;
    var elementID2 = "pass" + id;
    var quantity = document.getElementById(elementID1).value;
    var url = "makeOrder2.php?goodsNumber=" + id + "&quantity=" + quantity ;
    document.getElementById(elementID2).href=url;
    return false;
}
</script>

</head>
<body>
    <center>
    <div class="container" style="width: 65%">
    <h1>Make The Order</h1>
    <h2>Shopping Cart</h2>
    <?php
        $sql = "SELECT * FROM Goods WHERE status=1 ORDER BY goodsNumber ";
        $result = mysqli_query($conn,$sql);
        if(mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
    ?>
    <div class="col-md-3">
        <table>
        <div>
        <div class="product">
                <h5 class="text-info"><?php echo "Product ID : ".$row["goodsNumber"]; ?></h5>
                <h5 class="text-info"><?php echo "Product : ".$row["goodsName"]; ?></h5>
                <h5 class="text-danger"><?php echo "Price : $ ".$row["stockPrice"]; ?></h5>
                <h5 class="text-info">
                <?php
                echo "Available "; 
                echo "Remaining Stock: ",$row["remainingStock"]; ?></h5>
                <h5 class="text-info"><?php echo "Consignment Store ID: ".$row["consignmentStoreID"]; ?></h5>
                <?php
                $sqlShopID="SELECT * FROM consignmentStore_shop WHERE consignmentStoreID={$row["consignmentStoreID"]}";
                $rsShopID=mysqli_query($conn,$sqlShopID);
                $rcShopID=mysqli_fetch_assoc($rsShopID); 
                ?>
                <h5 class="text-info"><?php echo "Shop ID: ",$rcShopID["shopID"]; ?></h5>
                <input type="number" id="input<?php echo $row["goodsNumber"]; ?>" onchange="changeURL(<?php echo $row['goodsNumber']; ?>)" min="1" value="1" name="quantity">
                <input type="hidden" name="goodsName" value="<?php echo $row["goodsName"]; ?>">
                <input type="hidden" name="stockPrice" value="<?php echo $row["stockPrice"]; ?>">
                <input type="hidden" name="remainingStock" value="<?php echo $row["remainingStock"]; ?>">
            <?php
            printf("<a id=\"pass%s\" href=\"makeOrder2.php?quantity=%s&goodsNumber=%s&&&&&&\" 
            id=\"pass{$row["goodsNumber"]}\">",$row["goodsNumber"], 1 ,$row["goodsNumber"]);
            
            ?>
                <button>Order</button></a>



        </div>
        </div>
    </table>
    <?php
            }
        }
    ?>

        
</div>
</center>

</body>
</html>


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