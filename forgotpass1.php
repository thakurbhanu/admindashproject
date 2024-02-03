<?php

session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] = true) {
    header("Location: loginhome.php");
    exit;
}


?>
<?php
// $login = false;
$showalert = false;
$inpute = false;
$sucess = false;
$otperr = false;


if (isset($_POST['otp'])) {
    include 'includes/dbconnect.php';

    // Sanitize and validate user inputs
    $email =  $_POST["email"];
    // $password = $_POST["pass"];


    // Check for empty fields
    if (empty($email)) {
        $inpute = true;
    } 
    else {
        

        

        // $sql = "select * from users1 where username = '$username' AND password = '$password'";
        $sql = "select * from stu_tech where email = '$email'";
        $result = mysqli_query($conn, $sql);
        $num = mysqli_num_rows($result);

        if($num == 1) {

        
        $to = $email;
        $subject = "OTP";
        $otp = rand(3000,8000);
        $message = "this is OTP to reset password dont't share with anyone ";
        $message .= "$otp";
        $headers = "From: bhanusinghbhadouriya5014@gmail.com";
        
        $res = mail($to, $subject, $message, $headers);
        
        if ($res){
            $sucess = true;
            $_SESSION['otpset'] = $otp;
            $_SESSION['emailset'] = $email;
        }
        else{
            $showalert = true;
        }

            // while($row = mysqli_fetch_assoc($result)){
            //     if(password_verify($password, $row['password'])){
            //         $login = true;
            // session_start();
            // $_SESSION['loggedin'] = true;

            // header("Location: loginhome.php");
            //     }
            //     else{
            //         $showalert = true; 
            //     }
            // }
            
            
        }
        else {
            $showalert = true;
        }
    }
    

}

if (isset($_POST['submit'])){

    include 'includes/dbconnect.php';

    // Sanitize and validate user inputs
    $email =  $_SESSION['emailset'];
    $password = $_POST["pass"];
    $eotp = $_POST["eotp"];

    if($eotp == $_SESSION['otpset']){
        $hpass = password_hash($password, PASSWORD_DEFAULT); 
        $sql = "UPDATE `stu_tech` SET `password` = '$hpass' WHERE `stu_tech`.`email` = '$email'";
        $result = mysqli_query($conn, $sql);

        if($result){
            header("Location: login.php");
            session_unset($_SESSION['otpset']);
        }
    }
    else{
        $otperr = true;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script
      src="https://kit.fontawesome.com/ce7a0231d9.js"
      crossorigin="anonymous"
    ></script>
    <link rel="stylesheet" href="includes/css.css" />
    <link rel="icon" type="image/x-icon" href="includes/logo.png">
    <title>Forgot Password</title>
    <style>
        body {
            padding-top: 56px;
        }
        @media (min-width: 768px) {
            body {
                padding-top: 0;
            }
        }
        .sidebar {
            height: 100%;
            position: fixed;
            top: 10%;
            left: 0;
            width: 250px;
            padding-top: 56px;
            background-color: #343a40;
            color: #fff;
        }
        .sidebar a {
            padding: 15px;
            text-decoration: none;
            font-size: 18px;
            color: #fff;
            display: block;
        }
        .sidebar a:hover {
            background-color: #555;
        }
        .navbar {
            box-shadow: 3px 3px 40px black;
        }
        .carousel-item img {
            height: 500px;
            object-fit: cover; /* Ensure images fill the carousel item */
        }
        .carousel-control-prev, .carousel-control-next {
            width: 5%; /* Adjust the width as needed */
        }
        .carousel-indicators {
            bottom: 10px;
        }
        .main-content-container{
            position:absolute;
            left: 10.3%;
            top: 10%;
            /* width: 80.5%; */
        }
        .abt-head{
            margin: 10px;
            font-weight: bold;
            color: #555;
            text-decoration: underline;
        }
        .abt-para{
            margin: 20px;
            color: #7d7c7c;
        }
        .service-names{
            margin: 20px;
            font-family: Arial, Helvetica, sans-serif;
        }
        #otp{
            border-radius:10px;
            border:1px solid grey;
            padding:5px;
            width:45%;
            color:blue;
        }
        .fa-eye{
        color:blue;
        position: absolute;
        top: 17px;
        right: 40px;
        display: block;
      }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-sm navbar-light bg-light fixed-top">
        <div class="container ml-5">
            <!-- Left side: Logo -->
            <a class="navbar-brand" href="index.php">
                <img src="includes/logo.png" width="80" height="80" class="d-inline-block align-top" alt="Logo">
            </a>
            <!-- Right side: Profile picture and username -->
            <div class=" justify-content-end " style="margin-left: 80%;" id="navbarNav">
                <ul class="navbar-nav ">
                  <li class="nav-item mr-2 mx-2 " style="font-size:30px;">
                    <a href="login.php"><button class="btn btn-primary mr-2">Login</button></a>
                  </li>
                 
                  <li class="nav-item"style="font-size:30px;">
                    <a href="register.php"><button class="btn btn-outline-info">Register</button></a>
                  </li>
                </ul>
              </div>
        </div>
    </nav>

    <!-- crousal -->
    <div class="container main-content-container col-md-10 mt-5 pt-3 px-0">

     <?php
        if ($inpute){
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Warning!</strong> Please enter your registerd email adress !.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        }
        if($showalert){
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Warning!</strong> This Email is not matched with any registerd account !.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';}

          if($sucess){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> OTP sent Successfully to given Email-id !.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';}

          if($otperr){
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Warning!</strong> OTP NOT matched... !.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';}

?>
    <div class="row1 d-flex flex-row justify-content-center">
<div class="wrapper">
      <div class="title" style="color:blue;">Reset Account Password</div>
      <form action="forgotpass1.php" method="post">

        

        <!-- Email input -->
        <div class="field">
          <input
            oninput="validateEmail()"
            id="emailId"
            name="email"
            style="padding-right: 43px"
            type="email"
          />
          <i
            id="emailErrLogo"
            class="f-name-err-logo fa-solid fa-circle-exclamation"
            title="Invalid Email (for ex- abc123@gmail.com)"
          ></i>
          <i id="emailCrrLogo" class="fa-solid fa-circle-check"></i>
          <label style="color:blue;">Email Address</label>
        </div>

        

        
        
        
        <div class="m-4">
         <input oninput="validatePass()" name="eotp" id="otp" type="number" placeholder="Enter otp" />
          <button class="btn btn-sm btn-outline-primary ml-2 mt-0" type="submit" onclick="fillEmail()"  name="otp" value="otp">Send OTP</button>
        </div>

        <!-- password input -->
        <div class="field">
          <input oninput="validatePass()" name="pass" id="passwordF" type="password" />
          <i
            id="passNErrLogo"
            class="f-name-err-logo fa-solid fa-circle-exclamation"
            title="Create strong password (for ex- Abc@123)"
          ></i>
          <i id="passNCrrLogo" class="fa-solid fa-circle-check"></i>
          <i id="show-btn" onclick="togglePassword()" class="fa-solid fa-eye"></i>
          <label style="color:blue;">Create New Password</label>
        </div>

        <div class="field">
          <input oninput="validatePassC()" id="passwordC" type="password" />
          <i
            id="passCErrLogo"
            class="f-name-err-logo fa-solid fa-circle-exclamation"
            title="Confirm password does not match"
          ></i>
          <i id="passCCrrLogo" class="fa-solid fa-circle-check"></i>
          <label style="color:blue;">Confirm Password</label>
        </div>


        <div class="field ml-2 d-flex flex-row justify-content-center">
          <button class="btn btn-sm btn-primary ml-2 mt-0" type="submit"   name="submit" value="submit">Reset Password</button>
        </div>

      </form>
    </div>
    </div>
                
    </div>
    

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script>
        function fillemail(){
            let eval = document.getElementById("emailId").value;
            document.getElementById("emailId").value = eval;
        }
        // document.getElementById("emailId").value = eval;
        

      <?php
    include('includes/jsvalidation.php')
      ?>
    
    </script>
    <?php

if($sucess){
    echo '
    <script>
    document.getElementById("emailId").value = '. "'$email'" .';
    </script>
    ';}
    ?>
</body>
</html>
