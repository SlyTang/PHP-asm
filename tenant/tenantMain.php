<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../CSS/customer.css" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tenant Main</title>
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
    <form>
        <h1>Welcome To Tenant Main,
        <?php 
            if(!isset($_SESSION['user'])){
                echo "<br>You are not logged in!";
            }else{
                echo $_SESSION['user'];
            }
        ?>
        </h1>
    </form>
</div>
</body>
</html>