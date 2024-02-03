<?php

session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] = true) {
    header("Location: userloginhome.php");
    exit;
}


?>
<?php
$login = false;
$showalert = false;
$inpute = false;
$authe = false;


if (isset($_POST['submit'])) {
    include 'includes/dbconnect.php';

    // Sanitize and validate user inputs
    $email =  $_POST["email"];
    $password = $_POST["pass"];
    $recaptcha = $_POST['g-recaptcha-response'];


    // Check for empty fields
    if (empty($email) || empty($password) || empty($recaptcha)) {
        $inpute = true;
    } 
    else {
        

        

        // $sql = "select * from users1 where username = '$username' AND password = '$password'";
        $sql = "select * from stu_tech where email = '$email'";
        $result = mysqli_query($conn, $sql);
        $num = mysqli_num_rows($result);

        if($num == 1) {
            while($row = mysqli_fetch_assoc($result)){
                if(password_verify($password, $row['password'])){
                    $login = true;
            session_start();

            if($row['auth'] == "1"){
                if(isset($_POST['rememberme'])){
                    if (isset($_COOKIE['emailcookie'])) {
                        unset($_COOKIE['emailcookie']);
                        unset($_COOKIE['passwordcookie']);
                    }
                    setcookie('emailcookie',$email,time()+86400);
                    setcookie('passwordcookie',$password,time()+86400);
                    
                }
                

            if($row['role'] == "admin"){
                $_SESSION['loggedin'] = true;
                $_SESSION['id'] = $row['reg id'];
                $_SESSION['role'] = "admin";
                header("Location: admindash.php");
            }
            else if($row['role'] == "Employee"){
                $_SESSION['loggedin'] = true;
                $_SESSION['id'] = $row['reg id'];
                $_SESSION['role'] = "Employee";
                header("Location: admindash.php");
            }
            else{
                $_SESSION['loggedin'] = true;
            $_SESSION['id'] = $row['reg id'];
            $_SESSION['role'] = "Student";

            header("Location: userloginhome.php");
            }
        }
        else{
            $authe = true;
        }


            
                }
                else{
                    $showalert = true; 
                }
            }
            
            
        }
        else {
            $showalert = true;
        }
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
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <link rel="icon" type="image/x-icon" href="includes/logo.png">
    <link rel="stylesheet" href="includes/css.css" />
    <title>Login</title>
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
                  <!-- <li class="nav-item m-1"style="font-size:20px;">
                    <a href="">/</a>
                  </li> -->
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
            <strong>Warning!</strong> Please fill in all require fields !.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        }
        if($showalert){
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> Invalid Email or password !.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';}

          if($authe){
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Warning!</strong> Your Registration is yet not approved... !.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';}

?>
    <div class="row1 d-flex flex-row justify-content-center">
<div class="wrapper">
      <div class="title" style="color:blue;">Login</div>
      <form action="login.php" method="post">

        

        <!-- Email input -->
        <div class="field">
          <input
            oninput="validateEmail()"
            id="emailId"
            name="email"
            value="<?php if(isset($_COOKIE['emailcookie'])) {echo $_COOKIE['emailcookie'];} ?>"
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

        

        <!-- password input -->
        <div class="field">
          <input oninput="validatePass()" name="pass" 
          value="<?php if(isset($_COOKIE['passwordcookie'])) {echo $_COOKIE['passwordcookie'];} ?>"
          id="passwordF" type="password" />
          <i
            id="passNErrLogo"
            class="f-name-err-logo fa-solid fa-circle-exclamation"
            title="Create strong password (for ex- Abc@123)"
          ></i>
          <i id="passNCrrLogo" class="fa-solid fa-circle-check"></i>
          <label style="color:blue;">Password</label>
        </div>
        <br>

        <div class="g-recaptcha" data-sitekey="6LeM4F4pAAAAAMmWygkMoSdzZfq5KtsjZDtmVqTt"></div>
        <br>
        <div>
            <input type="checkbox" value="isrememberme" name="rememberme" id="remember">
            <label for="remember"> Remember me</label>
        </div>
        <div class="content">
          <a href="forgotpass1.php">Forgot Password?</a>
        </div>
        <div class="field d-flex flex-row justify-content-center">
          <input class="btn btn-primary" type="submit" name="submit" value="submit"  />
        </div>
      </form>
    </div>
    </div>
                
    </div>
    

    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.9/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
