<?php

session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true ) {
    header("Location: index.php");
    exit;
}
elseif ($_SESSION['role'] != "admin" && $_SESSION['role'] != "Employee"){
    header("Location: userloginhome.php");
    exit;
}
include('includes/dbconnect.php');



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <title>User Profile</title>
    <link rel="icon" type="image/x-icon" href="includes/logo.png">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .profile-container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        img {
            max-width: 100%;
            height: auto;
            border-radius: 50%;
        }
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
            left: 19%;
            top: 10%;
            width: 80.5%;
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
        .profile-logo{
            height:50px;
            width:50px;
        }
        .profile-pic{
            height:150px;
            width:150px;
        }
        .back-btn{
            position:absolute;
            top:5%;
            left:25%;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-sm navbar-light bg-light fixed-top">
        <div class="container ml-5">
            <!-- Left side: Logo -->
            <a class="navbar-brand" href="admindash.php">
                <img src="includes/logo.png" width="80" height="80" class="d-inline-block align-top" alt="Logo">
            </a>
            <!-- Right side: Profile picture and username -->
            <div class="collapse navbar-collapse justify-content-end" style="margin-left:73%">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php
                        $id = $_SESSION['id'];
                        $sql = "select * from stu_tech where `reg id` = '$id'";
                        $result = mysqli_query($conn, $sql);
                            while($row = mysqli_fetch_assoc($result)){
                                
                           
                            echo '   
                            
                            <img src="'.$row['image'].'" width="50" height="50" class="rounded-circle profile-logo mx-3" alt="Profile">'
                            .$row['name'] ;}?>
                        
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <!-- <a class="dropdown-item" href="userprofile.php">User Profile</a> -->
                            <a class="dropdown-item" href="changepass.php">Change Password</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="logout.php">Logout</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Sidebar -->
     <nav class="d-none d-md-block sidebar">
        <div class="sidebar-sticky">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="admindash.php">
                        Admin Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="allemployee.php">
                        Employee
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="allstudent.php">
                        Student
                    </a>
                </li>
            </ul>
        </div>
    </nav>

<div class="container main-content-container col-md-10 mt-3 px-0">
<div class="container profile-container">

    <div class="text-center ">
    <a class="back-btn" href="javascript:window. history. back();"><button class=" btn btn-outline-primary">Back</button>
</a>
        
    <?php
$id = $_GET['id'];
$sql = "select * from stu_tech where `reg id` = '$id'";
$result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)){
        
   
    echo '   

        <img src="'.$row['image'].'" width="200" height="200" alt="User Photo" class="profile-pic img-fluid">

        
            


        <h2 class="mt-3">'.$row['name'].'</h2>
        <p class="text-muted">'.$row['role'].'</p>
    </div>

    <div class="mt-4">
        <h3>About Me</h3>
        <p>As a seasoned full-stack web developer, I bring a diverse skill set and a passion for crafting seamless and engaging digital experiences. My proficiency spans across various technologies, making me a versatile professional capable of handling both front-end and back-end development with finesse..</p>
        <ul>
            <li>Front-End technologies</li>
            <li>Javascript & Jquery</li>
            <li>Backend Development</li>
            <li>Database Management</li>
            <li>Versions Controls With GitHub</li>
            <li>Problem-Solving and Debugging</li>
        </ul>

        <h4>Contact Information</h4>
        <ul>
            <li>Email: '.$row['email'].'</li>
            <li>Phone: +91 '.$row['phone'].'</li>
        </ul>';
    }
    ?>
    </div>
</div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
