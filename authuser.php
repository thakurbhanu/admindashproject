<?php

session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true ) {
    header("Location: logouthome.php");
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
    $sql = "UPDATE `stu_tech` SET `auth` = '1' WHERE `stu_tech`.`reg id` = '$id'";
    $result = mysqli_query($conn, $sql);
    $_SESSION['active'] = "dlt";
    header("Location: admindash.php");
    
} 
else{
    
    $sql = "UPDATE `stu_tech` SET `auth` = '0' WHERE `stu_tech`.`reg id` = '$id'";
    $result = mysqli_query($conn, $sql);
    $_SESSION['inactive'] = "dlt";
    header("Location: admindash.php");

}
    }
}


?>