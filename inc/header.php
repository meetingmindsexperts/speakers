<?php 
include_once "db.php";
include_once "functions.php";
//include_once 'auth.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Speakers</title>
    <link rel="icon" type="image/x-icon" href="../assets/favicon.ico">

    <!-- Include custom styles -->
    <link rel="stylesheet" href="<?php echo $baseUrl; ?>/css/style.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <!-- Change the href attribute to point to login.php -->
        <a class="navbar-brand" href="#"><img src="https://meetingmindsexperts.com/wp-content/uploads/2018/11/MME-WEB-LOGO-12-11-18.png" alt="MME   logo" style="width: 185px;">
</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
            <ul class="navbar-nav ml-auto w-100 justify-content-end pe-lg-5">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $baseUrl; ?>/views/view_profile.php">View Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $baseUrl; ?>/views/edit_profile_form.php">Edit Profile</a>
                </li>
                
            </ul>
            <div class="nav-item logout_btn">
                <a class="btn btn-primary nav-divnk" href="<?php echo $baseUrl; ?>/logout.php">Logout</a>
            </div>
        </div>
        
    </div>
</nav>

<div class="container mt-5">
