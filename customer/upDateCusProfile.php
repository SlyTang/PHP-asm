<?php
    session_start();
    require_once "../connect/mysqli_conn.php";
    $sql = "SELECT * FROM customer WHERE customerEmail = '{$_SESSION["user"]}';";
    $rs = mysqli_query($conn,$sql) or die(mysql_error($conn));
    $rc=mysqli_fetch_assoc($rs);
    $customerEmail=$rc['customerEmail'];
    $firstName=$rc['firstName'];
    $lastName=$rc['lastName'];
    $password=$rc['password'];
    $phoneNumber=$rc['phoneNumber'];
    
    
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <link rel="stylesheet" href="../CSS/customer.css" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Customer's Profile</title>
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
        </nav>
    </div>

<div class = "mainContent">
    <form action="processCusProfile.php" method="post" >
        <h1>Update Customer's Profile</h1>
        <p>
            <label>Customer Email:</label>
            <input id="customerEmail" name="customerEmail" readonly type="text" value="<?php echo $customerEmail; ?>">
        </p>
        <p>
            <label for="firstName">First Name:</label>
            <input id="firstName" name="firstName" required="required" type="text" value="<?php echo $firstName; ?>">
        </p>
        <p>
            <label for="lName">Last Name:</label>
            <input id="lName" name="lName" required="required" type="text" value="<?php echo $lastName; ?>">
        </p>
        <p>
            <label for="phoneNo">Phone Number:</label>
            <input id="phoneNo" name="phoneNo"  required="required" type="number" value="<?php echo $phoneNumber; ?>">
        </p>
        <p> 
            <label for="password">password :</label>
            <input id="password" name="password" required="required" type="text" value="<?php echo $password; ?>">
        </p>
        <p style="text-align:center;">
            <input type="radio" name="updateOrDelete" value="Updata" required>Updata Account Profile
            <input type="radio" name="updateOrDelete" value="DeleteAccount">Delete Account
        </p>
        <p style="text-align:center;">
            <input type="submit"/>
        </p>
    </form>
</div>

</form>
</body>
</html>