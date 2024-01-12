<?php
session_start();
session_unset();
session_destroy();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("Location: logouthome.php");
    exit;
}
?>