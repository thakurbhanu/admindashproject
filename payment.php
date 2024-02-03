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

?>


<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>Payment gateway integration</title>

        <!-- Template Stylesheet -->
        <link href="css/style.css" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    </head>

    <body>
        <input type="number" id="amt" placeholder="enter amount">

	<button onclick="pay_now()">Pay</button>

    </body>

</html>
<script>
    function pay_now(){
        //var name=jQuery('#name').val();
        var amt=jQuery('#amt').val();
        <?php
        while($row = mysqli_fetch_assoc($result)){
            echo '

        var name="'.$row['name'].'" ';
        };

        ?>
        // var name = "bhanu"
        // var amt=1;
         jQuery.ajax({
               type:'post',
               url:'payment_process.php',
               data:"amt="+amt+"&name="+name,
               success:function(result){
                   var options = {
                        "key": "rzp_test_nwcDgAQWpzrqNL", 
                        "amount": amt*100, 
                        "currency": "INR",
                        "name": "Test",
                        "description": "Test Transaction",
                        "image": "https://image.freepik.com/free-vector/logo-sample-text_355-558.jpg",
                        "handler": function (response){
                           jQuery.ajax({
                               type:'post',
                               url:'payment_process.php',
                               data:"payment_id="+response.razorpay_payment_id,
                               success:function(result){
                                   window.location.href="thank_you.php";
                               }
                           });
                        }
                    };
                    var rzp1 = new Razorpay(options);
                    rzp1.open();
               }
           });
        
        
    }
</script>