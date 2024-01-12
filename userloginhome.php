<?php

session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("Location: logouthome.php");
    exit;
}

elseif ($_SESSION['role'] == "admin"){
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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <title>Home</title>
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
        .service-names{
            margin: 20px;
            font-family: Arial, Helvetica, sans-serif;
            /* color:blue; */
            
            color:#fff;
            /* display:inline; */
            width:300px;
            padding:20px;
            margin-left:155px;
            border-radius:10px;
            background-color:skyblue;
            cursor: pointer;

        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-sm navbar-light bg-light fixed-top">
        <div class="container ml-5">
            <!-- Left side: Logo -->
            <a class="navbar-brand" href="#">
                <img src="includes/logo.png" width="80" height="80" class="d-inline-block align-top" alt="Logo">
            </a>
            <!-- Right side: Profile picture and username -->
            <div class="collapse navbar-collapse justify-content-end" style="margin-left:74%">
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
                            <a class="dropdown-item" href="userprofile.php">User Profile</a>
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
    <!-- <nav class="d-none d-md-block sidebar">
        <div class="sidebar-sticky">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="loginhome.php">
                        Home
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="admindash.php">
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
    <div class="container main-content-container col-md-10 mx-0 px-0">
        <div id="carouselExampleInterval" class="carousel slide mx-0 px-0" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active" data-bs-interval="2000">
                    <img src="includes/cp1 (3).jpg" class="d-block w-100" alt="img1">
                </div>
                <div class="carousel-item" data-bs-interval="2000">
                    <img src="includes/cp1 (2).jpg" class="d-block w-100" alt="img2">
                </div>
                <div class="carousel-item" data-bs-interval="2000">
                    <img src="includes/cp1 (1).jpg" class="d-block w-100" alt="img3">
                </div>
                <div class="carousel-item" data-bs-interval="2000">
                    <img src="includes/cp1 (4).jpg" class="d-block w-100" alt="img4">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        
        <div class="aboutsection">
            <h3 class="abt-head text-center">
                About Us
            </h3>
            <p class="abt-para">
            **Gaurish Technologies Private Limited** is an unlisted private company incorporated on 31 March, 2010. It is classified as a private limited company and is located in Gwalior, Madhya Pradesh¹. The company provides IT services and training to freshers ⁶. However, I do not have any information on the specifics of their training programs. You can visit their official website ⁵ or contact them directly to learn more about their training programs. Good luck with your research! 😊

Source: Conversation with Bing, 8/1/2024
(1) GAURISH TECHNOLOGIES PRIVATE LIMITED - Tofler. https://www.tofler.in/gaurish-technologies-private-limited/company/U72200MP2010PTC023316.
(2) Training | Gaurish Technology Pvt Ltd. https://www.gaurish.com/training.html.
(3) Gaurish Technology Pvt Ltd. https://www.gaurish.com/.
(4) Gaurish Technologies Private Limited - Email & Phone of top management .... https://www.easyleadz.com/company/gaurish-technologies.
(5) Gaurish Technologies | Company Profile | The Company Check. https://www.thecompanycheck.com/company/gaurish-technologies-private-limited/U72200MP2010PTC023316.
(6) Gaurish Technologies Company Profile & Overview | AmbitionBox. https://www.ambitionbox.com/overview/gaurish-technologies-pvt-dot-ltd-dot-overview.
(7) GTPL is seeking Fresher and... - Gaurish Technologies Pvt Ltd - Facebook. https://www.facebook.com/Gaurishtech/posts/802359399860336/.
            </p>
        </div>
        <hr>
        <div class="wcu-section">
            <h3 class="abt-head text-center">Sevices We provides:</h3>
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <h4 class="service-names">Website Development</h4>
                    </div>
                    <div class="col-md-6">
                        <h4 class="service-names">Website management</h4>
                    </div>
                    <div class="col-md-6">
                        <h4 class="service-names">App Development</h4>
                    </div>
                    <div class="col-md-6">
                        <h4 class="service-names">Development Trainning </h4>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="cont-us">
            <h3 class="abt-head text-center">
                Contact Us
            </h3>
            <div class="cnt-dtl text-center mt-5">
                
                <p>Email: gtpl@youritcompany.com</p>
                <p>Phone: +123 456 7890</p>
                <p>Address: 123 Pinto Park, Gwalior City</p>

            </div>
        </div>
        <hr>
        <footer>
            <div class="text-center">
            <p>&copy; 2024 Your IT Company. All rights reserved.</p>
        </div>
        </footer>
                
    </div>
    

    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.9/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
