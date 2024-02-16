<?php

// Include necessary files
include_once '../inc/auth.php';
include_once '../inc/db.php';
include_once '../inc/header.php';

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    // Redirect to the index.php if not logged in
    header("Location: ../index.php");
    exit;
}

// Fetch user's existing information from the database
$email = $_SESSION['email'];


// Function to display error or success message
function displayMessage() {
    if (isset($_SESSION['message'])) {
        echo '<div class="alert alert-success" role="alert">' . $_SESSION['message'] . '</div>';
        unset($_SESSION['message']);
    } elseif (isset($_SESSION['error'])) {
        echo '<div class="alert alert-danger" role="alert">' . $_SESSION['error'] . '</div>';
        unset($_SESSION['error']);
    }
}
// Your profile form HTML code goes here
?>

<div class="container py-5 mt-5"> 
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-6 col-xl-4 pb-5">
            <?php displayMessage(); ?>
            <div class="pb-5">
                <h2>Welcome <?php echo $_SESSION['email']; ?>!</h2>
                <p>This is your profile form. You can fill it out here.</p>
                <!-- Your profile form HTML code goes here -->
            </div>
            <form action="../actions/speaker-data.php" method="POST" enctype="multipart/form-data">
                <!-- <div class="mb-3">
                    <label for="name" class="form-label">Title</label>
                    <select class="form-select" aria-label="Default select example">
                        <option selected>Select Tile</option>
                        <option value="dr">Dr</option>
                        <option value="prof">Prof.</option>
                        <option value="-">-</option>
                    </select>
                </div> -->
                
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input required type="text" class="form-control" id="name" name="name" placeholder="Enter name">
                </div>
                <div class="mb-3">
                    <label for="role" class="form-label">Role</label>
                    <input required type="text" class="form-control" id="role" name="role" placeholder="Enter role">
                </div>
                <div class="mb-3">
                    <label for="organization" class="form-label">Organization</label>
                    <input required type="text" class="form-control" id="organization" name="organization" placeholder="Enter organization">
                </div>
                <div class="mb-3">
                    <label for="photo" class="form-label">Photo</label>
                    <input required type="file" class="form-control" id="photo" name="photo">
                </div>
                <div class="mb-3">
                    <label for="bio" class="form-label">Bio</label>
                    <textarea required class="form-control" id="bio" name="bio" rows="5" placeholder="Enter bio"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>

<?php
// Include necessary files
include_once '../inc/footer.php';
?>
