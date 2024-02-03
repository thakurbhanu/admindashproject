<?php
$showresult = false;
$filealert = false;
$success = false;
$uploadOK = 1;
session_start();
if ($_SESSION['role'] == "admin"){
    header("Location: adminloginhome.php");
    exit;
}



if(isset($_POST['submit'])){
  $id = $_SESSION['id'];
    include 'includes/dbconnect.php';
  
    $name = $_POST["name"];
      
      $phone = $_POST["phone"];
      
      // $role = $_POST["role"];
      $fname = $_FILES['photo']['name'];
      if($fname !="" ){

        $target_dir = "includes/uploads/";
      $tempfname = $_FILES['photo']['tmp_name'];
      $fsize = $_FILES['photo']['size'];
      $ftype = $_FILES['photo']['type'];
      $target_file = $target_dir . basename($fname);
      $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
  
      // Check file size
      if ($fsize > 2000000) {
        $uploadOK = 0;
        $filealert = true;
    }
  
    // Allow certain file formats
    $allowedFileTypes = array("jpg", "jpeg", "png", "gif");
    if (!in_array($imageFileType, $allowedFileTypes)) {
        $uploadOK = 0;
        $filealert = true;
    }
    if ($uploadOK == 0) {
        $filealert = true;
        } else {
            move_uploaded_file($tempfname, $target_dir . $fname);
        }
        $existsql = "SELECT * FROM `stu_tech` WHERE `reg id` = $id";
          $result = mysqli_query($conn, $existsql);
          $numExistsRows = mysqli_num_rows($result);
  
          if ($numExistsRows = 0) {
              $showresult = true;
          } else {
              $sql = "UPDATE `stu_tech` SET `name` = '$name', `phone` = '$phone', `image` = '$target_file' WHERE `stu_tech`.`reg id` = $id;";
              $result = mysqli_query($conn, $sql);
  
              if ($result) {
                  // header("Location: login.php");
                  
                    $success = true;
                  
              }
          }
      }
      else{
        $existsql = "SELECT * FROM `stu_tech` WHERE `reg id` = $id";
        $result = mysqli_query($conn, $existsql);
        $numExistsRows = mysqli_num_rows($result);

        if ($numExistsRows = 0) {
            $showresult = true;
        } else {
            $sql = "UPDATE `stu_tech` SET `name` = '$name', `phone` = '$phone' WHERE `stu_tech`.`reg id` = $id;";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                // header("Location: login.php");
                
                  $success = true;
                
            }
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
    <link rel="icon" type="image/x-icon" href="includes/logo.png">
    <link rel="stylesheet" href="includes/css.css" />
    <title>Register</title>
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
        .fa-eye{
        color:#39a1ad;
        position: absolute;
        top: 17px;
        right: 40px;
        display: block;
      }
      .back-btn{
        position: relative;
        top: 5px;
    
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
                    <a href="userloginhome.php"><button class="btn btn-primary mr-2">Home</button></a>
                  </li>
                  <li class="nav-item m-1"style="font-size:20px;">
                    <a class="back-btn" href="javascript:window. history. back();"><button class=" btn btn-outline-primary">Back</button>
                   </a>
                  </li>
                </ul>
              </div>
        </div>
    </nav>

    <!-- crousal -->
    <div class="container main-content-container col-md-10 mt-5 pt-3 px-0">
    <?php
           if($filealert){
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                  <strong>Warning!</strong> Invalid image sizr or format !.
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
          }
          if($showresult) {
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Warning!</strong> This Email is already registerd !.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        }
        if($success) {
          echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>Success!</strong> Profile Updated Sucessfully !.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
      }
        ?>
    <div class="row1 d-flex flex-row justify-content-center">
<div class="wrapper">
<div class="title">Update Profile</div>
      <form action="edituser.php" method="post" enctype="multipart/form-data">

        <!--first name -->
        <div class="field">
          <input oninput="validateFname()" type="text" name="name" id="fname" />
          <i
            id="fNameErrLogo1"
            class="fa-solid fa-circle-exclamation"
            title="Name have only alphabet leters"
          ></i>
          <i
            id="fNameErrLogo2"
            class="fa-solid fa-circle-exclamation"
            title="Name length should bettween (3-21)"
          ></i>
          <i id="fNameCrrLogo" class="fa-solid fa-circle-check"></i>
          <label>Full Name</label>
        </div>

        <!-- phone number input -->
        <div class="field">
          <input oninput="validatePhone()" id="phoneNumber" name="phone" type="text" />
          <i
            id="phoneErrLogo"
            class="f-name-err-logo fa-solid fa-circle-exclamation"
            title="Enter a valid phone number"
          ></i>
          <i id="phoneCrrLogo" class="fa-solid fa-circle-check"></i>
          <label>Phone No.</label>
        </div>

        

        
        <div class="content">
        <label style="color:#39a1ad;" for="role">Choose a Photo:</label>
          <input style="color:#39a1ad;" type="file" accept="image/*" id="file-input" name="photo" onchange="previewImage()">
        
        </div>
        <!-- Image preview container -->
        
        <div id="image-preview"></div>

        <div class="field d-flex flex-row justify-content-center">
          <button class="btn btn-info" type="submit" name="submit" value="submit">Update</button>
        </div>
      </form>
    </div>
    </div>
                
    </div>
    
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    
    <script>

      <?php
    include('includes/jsvalidation.php');
    
      ?>
    </script>
    <?php
    include('includes/dbconnect.php');


    $id = $_SESSION['id'];
    $sql = "select * from stu_tech where `reg id` = '$id'";
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)){
     $name = $row['name'];
     $phone = $row['phone'];
     $role = $row['role'];
     $image = $row['image'];
    
    }
echo '
<script>
document.getElementById("fname").value = '. "'$name'" .';
document.getElementById("phoneNumber").value = '. "'$phone'" .';



</script>
';

?>
    

</body>
</html>