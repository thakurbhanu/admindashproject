<?php
session_start();
if ($_SESSION['role'] == "admin"){
    header("Location: adminloginhome.php");
    exit;
}
include('includes/dbconnect.php');

$id = $_SESSION['id'];
$sql = "select * from stu_tech where `reg id` = '$id'";
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_assoc($result)){
 echo $row['name'];

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>