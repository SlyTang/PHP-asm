<?php

    session_start();

    if(isset($_POST['user'],$_POST['password'])){
        $user=$_POST['user'];
        $password=$_POST['password'];

        require_once "../connect/mysqli_conn.php";

        $sql="select * from tenant where tenantID='$user' and password='$password'";
        $rs=mysqli_query($conn,$sql)or die(mysqli_error($conn));


        $row=mysqli_fetch_array($rs);
            if($row!=null){  
                $_SESSION['user']= $_POST['user'];
                header("location: ../tenant/tenantMain.php");
            }else{
                echo "<script type='text/javascript'>alert('invalid login');</script>";
            }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <link rel="stylesheet" href="../CSS/customer.css" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login For Tenant</title>
</head>
<body>

<div class="dropdwn">
    <nav>
        <ul>
        <li><a href="../main.html">Home</a></li>
    </nav>
</div>

</head>
<body>
<div class = "mainContent">
    <form action="loginForTenant.php" method="post">
        <h1>Tenant Login</h1>
            <p>
                <label>TenantID :</label>
                <input type="text" id="user" name="user" required="required" />
            </p>
            <p>
                <label>Password:</label>
                <input type="password" id="password" name="password" required="required" />
            </p>
            <p style="text-align:center;">
                <input type="submit" value="login" />
            </p>
    </form>
</div>
</body>
</html>