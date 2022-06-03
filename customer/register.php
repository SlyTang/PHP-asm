<!DOCTYPE html>
<html lang="en">
<head>

    <link rel="stylesheet" href="../CSS/customer.css" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>

<body>

    <div class="dropdwn">
        <nav>
            <ul>
            <li><a href="../main.html">Home</a></li>
        </nav>
    </div>

    <?php
    
    session_start();

    if(!empty($_POST['customerEmail'])){
        require_once("../connect/mysqli_conn.php");

        $customerEmail=$_POST["customerEmail"];
        $firstName=$_POST["fName"];
        $lastName=$_POST["lName"];
        $password=$_POST["pwd"];
        $phoneNumber=$_POST["phoneNo"];

        $sql="SELECT * FROM customer WHERE customerEmail='".$customerEmail."'";
        $rs = mysqli_query($conn,$sql) or die(mysqli_error($conn));

        if(mysqli_num_rows($rs)>0){
            //echo "record already exist!";
            header("location:".$_SERVER['PHP_SELF']."?msg=".urlencode("You have registered!"));
        }else{
            $sql="INSERT INTO customer(customerEmail,firstName,lastName,password,phoneNumber)VALUES(
                '{$customerEmail}',
                '{$firstName}',
                '{$lastName}',
                '{$password}',
                '{$phoneNumber}'
            )";

            if(mysqli_query($conn,$sql)){
                header("location: ../login/loginForCustomer.php");
                exit;
            }else{
                echo ("error description:".mysqli_error($conn));
            }
        }
    }
    ?>

<div class = "mainContent">
    <form action="register.php" method="post">
        <h1>Sign Up For Customer Account</h1>
            <p>
                <label for="emailsignup">Customers Email:</label>
                <input id="customerEmail" name="customerEmail" required="required" type="email" />
            </p>
            <p>
                <label for="fName">Customers First Name:</label>
                <input id="fName" name="fName" input required="required" type="text" />
            </p>
            <p>
                <label for="lName">Customers Last Name:</label>
                <input id="lName" name="lName" input required="required" type="text" />
            </p>
            <p>
                <label for="phoneNo">Phone Number:</label>
                <input id="phoneNo" name="phoneNo"  required="required" type="number" />
            </p>
            <p> 
                <label for="password">password :</label>
                <input id="pwd" name="pwd" required="required" type="password"/>
            </p>
            <p style="text-align:center;">
                <input type="submit" value="Sign up"/>  
                <input type="Reset" value="Reset" />
            </p>
    </form>
</div>

<?php
    if(isset($_GET['msg'])){
        echo"<br><h2>".$_GET['msg']."</h2>";
    }
?>

</body>
</html>