<?php
session_start();
    require_once "../connect/mysqli_conn.php";
    $sql = "SELECT * FROM customer WHERE customerEmail = '{$_SESSION["user"]}';";
    $rs = mysqli_query($conn,$sql) or die(mysqli_error($conn));
    $rc=mysqli_fetch_assoc($rs);
    $customerEmail=$_POST['customerEmail'];
    $firstName=$_POST['firstName'];
    $lastName=$_POST['lName'];
    $password=$_POST['password'];
    $phoneNumber=$_POST['phoneNo'];

    $updateOrDelete=$_POST["updateOrDelete"];

    if($updateOrDelete=="DeleteAccount" && $_POST["password"]==$rc['password']){

        $customerEmail=$_POST['customerEmail'];
        $sql="DELETE FROM customer WHERE customerEmail='$customerEmail'";

        $rs=mysqli_query($conn,$sql);
        if(mysqli_affected_rows($conn)>0){
            session_destroy();
            echo '<script>
            alert("Account Deleted!");
            window.location.assign("../main.html");
            </script>';

        }
    }else 
    if($updateOrDelete=="Updata"){

        $sql="UPDATE customer SET firstName='$firstName',
                                    lastName='$lastName',
                                    password='$password',
                                    phoneNumber='$phoneNumber' 
                                    WHERE customerEmail = '{$_SESSION["user"]}';
        ";
        mysqli_query($conn,$sql);
            if(mysqli_affected_rows($conn)>0){
                echo '<script>
                alert("Update Succses!");
                window.location.assign("upDateCusProfile.php");
                </script>';

            }
            
        }else{
        echo '<script>
            alert("Wrong Password!");
            window.location.assign("upDateCusProfile.php");
            </script>';
    }
    
   
?>