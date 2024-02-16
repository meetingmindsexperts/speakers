<?php

session_start();

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    // Redirect to the index.php if not logged in
    header("Location: ../index.php");
    exit;
}

include_once "../inc/db.php";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $email = $_SESSION['email'];
    $name = $_POST['name'];
    $role = $_POST['role'];
    $organization = $_POST['organization'];
    
    // Photo handling
    $photo = $_FILES['photo']['name'];
    $photo_tmp = $_FILES['photo']['tmp_name'];
    $photo_error = $_FILES['photo']['error'];

    if ($photo_error === UPLOAD_ERR_OK) {
        $target_dir = "uploads/"; // Directory where the file will be stored
        $target_file = $target_dir . basename($photo);

        // Move uploaded file to the target directory
        if (move_uploaded_file($photo_tmp, $target_file)) {
            $_SESSION['message'] = "The file " . basename($photo) . " has been uploaded.";
        } else {
            $_SESSION['error'] = "Sorry, there was an error uploading your file.";
        }
    } else {
        $_SESSION['error'] = "File upload error: " . $photo_error;
    }

    $bio = $_POST['bio'];

    // Set modified_at timestamp
    $modified_at = date('Y-m-d H:i:s');

    // Update the user's profile information
    $sql = "UPDATE speaker_info SET name = '$name', role = '$role', organization = '$organization', photo = '$photo', bio = '$bio', modified_at = '$modified_at' WHERE email = '$email'";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['message'] = "Profile updated successfully";
    } else {
        $_SESSION['error'] = "Error updating profile: " . $conn->error;
    }

    $conn->close();

    // Redirect back to the form page
    header("Location: ../views/view_profile.php?email=".$email);
    exit();
}

?>
