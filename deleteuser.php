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
include('includes/dbconnect.php');
$id = $_GET['id'];
$sql = "DELETE FROM `stu_tech` WHERE `stu_tech`.`reg id` = '$id'";
$result = mysqli_query($conn, $sql);
$_SESSION['dlt'] = "dlt";
header("Location: admindash.php");



?>