<?php
session_start();
include_once '../inc/init.php';

// // Debugging
// echo '<pre>';
// print_r($_SESSION);
// echo '</pre>';

// Redirect to the login page if the user is not logged in
if (!isset($_SESSION['email'])) {
    $url = getBaseUrl() . "/admin/admin-login.php";
    header("Location: $url");
    exit();
}
// Your page content goes here
?>
