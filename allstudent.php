<?php

session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true ) {
    header("Location: index.php");
    exit;
}
elseif ($_SESSION['role'] != "admin"){
    header("Location: userloginhome.php");
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
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.9/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> -->
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#myTable').DataTable();
        });
    </script>

    <link rel="icon" type="image/x-icon" href="includes/logo.png">
    <title>Dashboard</title>
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
            left: 22.5%;
            top: 10%;
            width: 77.5%;
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
            <a class="navbar-brand" href="admindash.php">
                <img src="includes/logo.png" width="80" height="80" class="d-inline-block align-top" alt="Logo">
            </a>
            <!-- Right side: Profile picture and username -->
            <div class="collapse navbar-collapse justify-content-end" style="margin-left:73%">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown mx-0">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php
                            while($row = mysqli_fetch_assoc($result)){
                                
                           
                            echo '   
                            
                            <img src="'.$row['image'].'" width="50" height="50" class="rounded-circle profile-logo mx-3" alt="Profile">'
                            .$row['name'];
                            }?>
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
                    <a class="nav-link" href="#">
                        Student
                    </a>
                </li>
            </ul>
        </div>
    </nav>
    <!-- crousal -->
    <div class="container main-content-container col-md-10 mt-5 px-0">
        <?php
        if(isset($_SESSION['dlt'])){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> Target User Deleted Sucessfully !.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
          unset($_SESSION['dlt']);
        }
        if(isset($_SESSION['active'])){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> Target User Activated Sucessfully !.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
          unset($_SESSION['active']);
        }
        if(isset($_SESSION['inactive'])){
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Success!</strong> Target User Deativated Sucessfully !.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
          unset($_SESSION['inactive']);
        }


?>
    <h3 class="my-3" style="text-decoration:underline;">All registerd students:</h3>
      <table id="myTable" class="display">
    <thead>
        <tr>
            <th>S no.</th>
            <th>Name</th>
            <th>E-mail</th>
            <th>Phone</th>
            <th>Role</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    <?php
    $sql = "SELECT * FROM `stu_tech`";
    $result = mysqli_query($conn, $sql);
      $sr = 1;
while ($row = mysqli_fetch_assoc($result)) {
    if($row['role'] != 'admin' && $row['role'] == "student"){
        echo'<tr>
        <td >'.$sr.'</td>
        <td>'.$row['name'] .'</td>
        <td>'. $row['email'].'</td>
        <td>'. $row['phone']. '</td>
        <td>'. $row['role']. '</td>
        <td>
        <a href="viewuser.php?id='.$row['reg id'].'"><button class="btn btn-info">View</button></a>
        <button type="button"  class="btn btn-danger delete" id="'.$row['reg id'].'">Delete</button>
        ';
        if($row['auth'] == 1){
            echo'<button class="btn btn-success active " id="'.$row['reg id'].'">Active</button>';
        }
        else{
            echo'<button class="btn btn-danger inactive" id="'.$row['reg id'].'">Inactive</button>';
        }
        
        echo '
        
        </td>
        </tr>';
          $sr++;
    }

}
      ?>  
        
        

    </tbody>
</table>
                
    </div>
    

    
    <script>
deletes = document.getElementsByClassName('delete');
    Array.from(deletes).forEach((element) => {
      element.addEventListener("click", (e) => {
        // console.log("edit ");
        sno = e.target.id;
        // console.log(sno);

        if (confirm("Are you sure you want to delete this User!")) {
        //   console.log("yes");
          window.location = `deleteuser.php?id=${sno}`;
          
        }
        else {
        //   console.log("no");
        }
      })
    })

    active = document.getElementsByClassName('active');
    Array.from(active).forEach((element) => {
      element.addEventListener("click", (e) => {
        // console.log("edit ");
        sno = e.target.id;
        // console.log(sno);

        if (confirm("Are you sure you want to de-activate this User!")) {
        //   console.log("yes");
          window.location = `authuser.php?id=${sno}`;
          
        }
        else {
        //   console.log("no");
        }
      })
    })

    inactive = document.getElementsByClassName('inactive');
    Array.from(inactive).forEach((element) => {
      element.addEventListener("click", (e) => {
        // console.log("edit ");
        sno = e.target.id;
        // console.log(sno);

        if (confirm("Are you sure you want to activate this User!")) {
        //   console.log("yes");
          window.location = `authuser.php?id=${sno}`;
          
        }
        else {
        //   console.log("no");
        }
      })
    })
</script> 

</body>
</html>
