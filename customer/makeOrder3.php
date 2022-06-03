<?php

session_start();
    require_once("../connect/mysqli_conn.php");



    $cart=$_SESSION["cart"];
    if (isset($_SESSION["cart"])) {
        $shoppingCart = $_SESSION["cart"];
    }
    $_SESSION["cart"] = $shoppingCart;


    //$shoppingCart[0] = array($quantity, $remainingStock,$goodsNumber,$stockPrice,$goodsName);

    $timezone = date_default_timezone_get();

    for ($i = 0; $i < count($shoppingCart); $i++) {
        $quantity=$cart[$i][0];
        $remainingStock=$cart[$i][1];
        $goodsNumber=$cart[$i][2];
        $stockPrice=$cart[$i][3];
        $goodsName=$cart[$i][4];
    }

    
    (int)$setA = $stockPrice*$quantity;
    
    $customerEmail=$_SESSION['user'];
    echo "1";

    $sql = "SELECT * FROM orders";
    $rs = mysqli_query($conn,$sql) or die(mysqli_error($conn));
    $rc=mysqli_fetch_assoc($rs);
    $sql="INSERT INTO orders(customerEmail, consignmentStoreID, shopID,status,orderDateTime,totalPrice)
    VALUES  ('{$_SESSION["user"]}' , '{$rc['consignmentStoreID']}' , '{$rc['shopID']}' , '{$rc['status']}' , '$timezone' ,  '$setA' )";

    $rs = mysqli_query($conn,$sql);
    if(mysqli_affected_rows($conn)>0)
    echo "2";



    

    $sql = "SELECT * FROM goods";
    $rs = mysqli_query($conn,$sql);
    $rc=mysqli_fetch_assoc($rs);
    $r1 = $rc["remainingStock"]-$quantity;
    $sql="UPDATE goods SET remainingStock ='$r1'
                            WHERE goodsNumber ='$goodsNumber'";
    mysqli_query($conn,$sql);
    if(mysqli_affected_rows($conn)>0){
    echo '<script>
            alert("Make Order Successfully!");
            window.location.assign("makeOrder.php");
            </script>';
           print_r(1);     
    }
    
        
?>