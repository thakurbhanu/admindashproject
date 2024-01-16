<?php

session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] = true) {
    header("Location: loginhome.php");
    exit;
}


?>
<?php
$uploadOK = 1;
$showresult = false;
$filealert = false;
$success = false;

if(isset($_POST['submit'])){
  include 'includes/dbconnect.php';

  $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $password = $_POST["pass"];
    $role = $_POST["role"];

    $target_dir = "includes/uploads/";
    $fname = $_FILES['photo']['name'];
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
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $existsql = "SELECT * FROM `stu_tech` WHERE email = '$email'";
        $result = mysqli_query($conn, $existsql);
        $numExistsRows = mysqli_num_rows($result);

        if ($numExistsRows > 0) {
            $showresult = true;
        } else {
            $sql = "INSERT INTO `stu_tech` (`name`, `email`, `phone`, `password`, `role`, `image`, `auth`, `time`) VALUES ('$name', '$email', '$phone', '$hashed_password', '$role', '$target_file', '0', current_timestamp())";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                // header("Location: login.php");
                $to = $email;
                $subject = "Registration Confirmation";
                // $otp = rand(3000,8000);
                $message = "Your account has been registerd , Wait until next mail when your registration approved by admin ";
                // $message .= "$otp";
                $headers = "From: bhanusinghbhadouriya5014@gmail.com";
                
                $res = mail($to, $subject, $message, $headers);
                if ($res){
                  $success = true;
                }
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

    <!-- Sidebar
    <nav class="d-none d-md-block sidebar">
        <div class="sidebar-sticky">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="logouthome.php">
                        Home
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        Admin Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        Employee
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        Student
                    </a>
                </li>
            </ul>
        </div>
    </nav> -->
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
          <strong>Success!</strong> You have registerd check email for confirmation !.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
      }
        ?>
    <div class="row1 d-flex flex-row justify-content-center">
<div class="wrapper">
<div class="title">Registration</div>
      <form action="register.php" method="post" enctype="multipart/form-data">

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
          <label>Email Address</label>
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

        <!-- password input -->
        <div class="field">
          <input oninput="validatePass()" id="passwordF" name="pass" type="password" />
          <i
            id="passNErrLogo"
            class="f-name-err-logo fa-solid fa-circle-exclamation"
            title="Create strong password (for ex- Abc@123)"
          ></i>
          <i id="passNCrrLogo" class="fa-solid fa-circle-check"></i>
          <i id="show-btn" onclick="togglePassword()" class="fa-solid fa-eye"></i>
          <label>Password</label>
          <!-- <button id="show-password-btn" onclick="togglePassword()">Show Password</button> -->

        </div>

        <!-- confirm password input -->
        <div class="field">
          <input oninput="validatePassC()" id="passwordC" type="password" />
          <i
            id="passCErrLogo"
            class="f-name-err-logo fa-solid fa-circle-exclamation"
            title="Confirm password does not match"
          ></i>
          <i id="passCCrrLogo" class="fa-solid fa-circle-check"></i>
          <label>Confirm Password</label>
        </div>
        <hr>
        <div class="content">
        <label style="color:#39a1ad; margin-right:10%;" for="role">Choose a Role:</label>
          <select style="color:#39a1ad; margin-right:40%;" name="role" id="role">
          <option value="NULL">SELECT</option>
            <option value="employee">Employee</option>
            <option value="student">Student</option>
          </select>
        </div>
        <div class="content">
        <label style="color:#39a1ad;" for="role">Choose a Photo:</label>
          <input style="color:#39a1ad;" type="file" accept="image/*" id="file-input" name="photo" onchange="previewImage()">
        
        </div>
        <!-- Image preview container -->
        
        <div id="image-preview"></div>

        <div class="field d-flex flex-row justify-content-center">
          <button class="btn btn-info" type="submit" name="submit" value="submit">Register</button>
        </div>
      </form>
    </div>
    </div>
                
    </div>
    

    
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.9/dist/umd/popper.min.js"></script> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script> -->
    <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> -->
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <!-- <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script> -->
    <script>

      <?php
    include('includes/jsvalidation.php')
      ?>
    </script>
    <script>
        function previewImage() {
            var fileInput = document.getElementById('file-input');
            var imagePreview = document.getElementById('image-preview');

            // Clear any previous preview
            imagePreview.innerHTML = '';

            // Check if a file is selected
            if (fileInput.files.length > 0) {
                var file = fileInput.files[0];

                // Check if the file is an image
                if (file.type.match(/^image\//)) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        // Create an image element and set its source to the preview URL
                        var img = document.createElement('img');
                        img.src = e.target.result;
                        img.setAttribute("height", "100px");

                        // Append the image to the preview container
                        imagePreview.appendChild(img);
                    };

                    // Read the file as a data URL
                    reader.readAsDataURL(file);
                } else {
                    // Display an error message if the selected file is not an image
                    imagePreview.innerHTML = '<p>Selected file is not an image.</p>';
                }
            }
        }

        
    </script>

</body>
</html>
