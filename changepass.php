<?php

session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("Location: index.php");
    exit;
}


?>
<?php
// $login = false;
$showalert = false;
$inpute = false;
$sucess = false;
$otperr = false;
include 'includes/dbconnect.php';


if (isset($_POST['submit'])) {
    

    // Sanitize and validate user inputs
    $email =  $_POST["email"];
    $oldpass = $_POST["oldpass"];
    $newpass = $_POST["newpass"];
    $hpass = password_hash($newpass, PASSWORD_DEFAULT);


    // Check for empty fields
    if (empty($email) || empty($oldpass) || empty($newpass)) {
        $inpute = true;
    } 
    else {
        

        

        // $sql = "select * from users1 where username = '$username' AND password = '$password'";
        $sql = "select * from stu_tech where email = '$email'";
        $result = mysqli_query($conn, $sql);
        $num = mysqli_num_rows($result);

        if($num == 1) {
            while($row = mysqli_fetch_assoc($result)){
                if (!password_verify($oldpass, $row['password'])) {
                    // Passwords match
                    $showalert = true;
                    
                    

                } else {
                
                    $sucess = true;
                }
                
            }
            
            
        }
        else {
            $showalert = true;
        }
    }
    

}


$id = $_SESSION['id'];
$sql = "select * from stu_tech where `reg id` = '$id'";
$result = mysqli_query($conn, $sql);
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
    <title>Chanmge password</title>
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
            left: 10%;
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
            <a class="navbar-brand" href="userloginhome.php">
                <img src="includes/logo.png" width="80" height="80" class="d-inline-block align-top" alt="Logo">
            </a>
            <!-- Right side: Profile picture and username -->
            <div class="collapse navbar-collapse justify-content-end" style="margin-left:73%">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php
                            while($row = mysqli_fetch_assoc($result)){
                                
                           
                            echo '   
                            
                            <img src="'.$row['image'].'" width="50" height="50" class="rounded-circle profile-logo mx-3" alt="Profile">'
                            .$row['name'];
                            }?>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <?php
                            if ($_SESSION['role'] != "admin"){
                                echo '<a class="dropdown-item" href="userprofile.php">User Profile</a>';
                            }
                                


                            ?>
                            
                            <a class="dropdown-item" href="changepass.php">Change Password</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="logout.php">Logout</a>
                        </div>
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
            <strong>Warning!</strong> Please fill all the require fields !.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        }
        if($showalert){
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Warning!</strong> Invalid Email Or Current password !.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';}

          if($sucess){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> Password Chhanged Sucessfully.....!.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
          $sql = "UPDATE `stu_tech` SET `password` = '$hpass' WHERE `stu_tech`.`email` = '$email'";
          $result = mysqli_query($conn, $sql);

        }

          if($otperr){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Warning!</strong> OTP NOT matched... !.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';}

?>
    <div class="row1 d-flex flex-row justify-content-center">
<div class="wrapper">
      <div class="title" style="color:blue;">Change Account Password</div>
      <form action="changepass.php" method="post">

        

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

        <div class="field">
          <input oninput="validatePass()" name="oldpass" id="password0" type="password" />
          
          <label style="color:blue;">Current Password</label>
        </div>

        
        
        
        

        <!-- password input -->
        <div class="field">
          <input oninput="validatePass()" name="newpass" id="passwordF" type="password" />
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
            
          <button class="btn btn-sm btn-primary ml-2 mt-0" type="submit"   name="submit" value="submit">Change Password</button>
        </div>
       <p class="mx-3 mt-3 px-5"> Go to home Page<a href="admindash.php"> Home</a> </p>
      </form>
      
    </div>
    </div>
                
    </div>
    

    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script>
        function fillemail(){
            let eval = document.getElementById("emailId").value;
            document.getElementById("emailId").value = eval;
        }
        
        

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
