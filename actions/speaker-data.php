<?php

include_once "../inc/db.php";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

     // Function to sanitize input
    function sanitizeInput($input) {
        return htmlspecialchars(trim($input));
    }
    // Sanitize form data
    $email = $_SESSION['email'];
    $name = sanitizeInput($_POST['name']);
    $role = sanitizeInput($_POST['role']);
    $organization = sanitizeInput($_POST['organization']);
    $bio = sanitizeInput($_POST['bio']);
    
    // Sanitize photo name
    $photo = sanitizeInput($_FILES['photo']['name']);
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

    // Set created_at and modified_at timestamps
    $created_at = date('Y-m-d H:i:s');
    $modified_at = $created_at;

    // Insert data into database
    $update_sql = "UPDATE speaker_info SET name = '$name', role = '$role', organization = '$organization', photo = '$photo', bio = '$bio', modified_at = '$modified_at' WHERE email = '$email'";


    if ($conn->query($update_sql) === TRUE) {
        $_SESSION['message'] = "New record created successfully";
    } else {
        $_SESSION['error'] = "Error: " . $update_sql . "<br>" . $conn->error;
    }

    $conn->close();

    // Redirect back to the form page
    header("Location: ../views/profile_form.php?email=".$email);
    exit();
}
?>