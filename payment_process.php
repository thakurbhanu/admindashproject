<?php
session_start();
include('includes/dbconnect.php');
if(isset($_POST['amt']) && isset($_POST['name'])){
    $amt=$_POST['amt'];
    $name=$_POST['name'];
    $id = $_SESSION['id'];
    $payment_status="pending";
    $added_on=date('Y-m-d h:i:s');
    mysqli_query($conn,"insert into payment(regid,name,amount,payment_status,added_on) values('$id','$name','$amt','$payment_status','$added_on')");
    $_SESSION['OID']=mysqli_insert_id($conn);
}


if(isset($_POST['payment_id']) && isset($_SESSION['OID'])){
    $payment_id=$_POST['payment_id'];
    $id = $_SESSION['id'];
    // $sql = "UPDATE `payment` SET `payment_status` = 'complete', `payment_id` = '$payment_id' WHERE `payment`.`regid` = '$id'";
    // $result = ($conn, $sql);
    // mysqli_query($conn,"insert into payment(regid,name,amount,payment_status,added_on) values('99','$name','$amt','$payment_status','$added_on')");
    mysqli_query($conn,"UPDATE `payment` SET `payment_status` = 'complete', `payment_id` = '$payment_id' WHERE `payment`.`regid` = '$id'");
}
?>