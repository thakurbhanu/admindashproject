<?php

session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true ) {
    header("Location: index.php");
    exit;
}
elseif ($_SESSION['role'] != "admin"){
    header("Location: userloginhome.php");
    exit;
}
else{
include('includes/dbconnect.php');
    $id = $_GET['id'];
    $sql = "SELECT * FROM `stu_tech`  WHERE `stu_tech`.`reg id` = '$id'";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
if($row['auth'] == 0){
    $email = $row['email'];
    $to = $email;
                $subject = "Activation Confirmation";
                // $otp = rand(3000,8000);
                $message = "Your account has been activated , You can login now ";
                // $message .= "$otp";
                $headers = "From: bhanusinghbhadouriya5014@gmail.com";
                
                $res = mail($to, $subject, $message, $headers);
    $sql = "UPDATE `stu_tech` SET `auth` = '1' WHERE `stu_tech`.`reg id` = '$id'";
    $result = mysqli_query($conn, $sql);
    $_SESSION['active'] = "dlt";
    header("Location: admindash.php");

    
} 
else{
    $email = $row['email'];
    $to = $email;
                $subject = "Deactivation Confirmation";
                // $otp = rand(3000,8000);
                $message = "Your account has been De-activated , You can not login anymore..! ";
                // $message .= "$otp";
                $headers = "From: bhanusinghbhadouriya5014@gmail.com";
                
                $res = mail($to, $subject, $message, $headers);

    $sql = "UPDATE `stu_tech` SET `auth` = '0' WHERE `stu_tech`.`reg id` = '$id'";
    $result = mysqli_query($conn, $sql);
    $_SESSION['inactive'] = "dlt";
    header("Location: admindash.php");

}
    }
}


?>