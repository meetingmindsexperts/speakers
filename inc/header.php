<?php 
include_once "db.php";
//include_once 'auth.php';

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    $d_none = "d-none";
} else {
    $d_none = "d-flex";
}

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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

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
            <ul class="navbar-nav ml-auto w-100 justify-content-end pe-lg-5 <?php echo $d_none; ?>">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $baseUrl; ?>/views/view_profile.php">View Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $baseUrl; ?>/views/edit_profile_form.php">Edit Profile</a>
                </li>
                
            </ul>
            <div class="nav-item logout_btn ms-auto">
                <a class="btn btn-primary nav-divnk" href="<?php echo $baseUrl; ?>/logout.php">Logout</a>
            </div>
        </div>
        
    </div>
</nav>

<div class="container mt-5">
