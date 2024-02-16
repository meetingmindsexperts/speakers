<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    // Redirect to the index.php if not logged in
    header("Location: ../index.php");
    exit;
}

// Include necessary files
include_once '../inc/auth.php';
include_once '../inc/db.php';
include_once '../inc/header.php';

// Fetch user's existing information from the database
$email = $_SESSION['email'];
$sql = "SELECT * FROM speaker_info WHERE email = '$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    //print_r($row);
} else {
    $_SESSION['error'] = "User not found.";
    header("Location: ../views/profile_form.php");
    exit;
}

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
?>

<div class="container py-5 mt-5"> 
    <div class="row justify-content-center">
        <div class="col-md-7 col-lg-6 col-xl-4 pb-5">
            <?php displayMessage(); ?>
            <div class="pb-5">
                <h2>Welcome <?php echo $_SESSION['email']; ?>!</h2>
                <p>You can update your profile information here.</p>
                <!-- Your edit profile form HTML code goes here -->
            </div>
            <form action="../actions/update_profile.php" method="POST" enctype="multipart/form-data">
                <!-- Populate form fields with existing user data -->
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" value="<?php echo $row['name']; ?>">
                </div>
                <div class="mb-3">
                    <label for="role" class="form-label">Role</label>
                    <input type="text" class="form-control" id="role" name="role" placeholder="Enter role" value="<?php echo $row['role']; ?>">
                </div>
                <div class="mb-3">
                    <label for="organization" class="form-label">Organization</label>
                    <input type="text" class="form-control" id="organization" name="organization" placeholder="Enter organization" value="<?php echo $row['organization']; ?>">
                </div>
                <div class="mb-3">
                    <label for="photo" class="form-label">Photo</label>
                    <input type="file" class="form-control" id="photo" name="photo">
                    <!-- Display current photo -->
                    <img src="../actions/uploads/<?php echo $row['photo']; ?>" alt="Current Photo" style="max-width: 100px;">
                </div>
                <div class="mb-3">
                    <label for="bio" class="form-label">Bio</label>
                    <textarea class="form-control" id="bio" name="bio" rows="5" placeholder="Enter bio"><?php echo $row['bio']; ?></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Update Profile</button>
            </form>
        </div>
    </div>
</div>

<?php
// Include necessary files
include_once '../inc/footer.php';
?>
