<?php
// Include necessary files
include_once '../inc/auth.php'; // Include authentication check
include_once '../inc/db.php'; // Include database connection
include_once '../inc/header.php'; // Include header file

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    // Redirect to the index.php if not logged in
    header("Location: ../index.php");
    exit;
}

// Fetch user's profile information from the database
$email = $_SESSION['email'];
$sql = "SELECT * FROM speaker_info WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    $_SESSION['error'] = "User not found.";
    header("Location: ../views/profile_form.php");
    exit;
}
?>

<div class="container py-5 mt-5">
    <div class="row justify-content-start">
        <div class="col-md-6 col-lg-6 ">
            <div class="pb-5">
                <h2>Welcome <?php echo $row['name']; ?>!</h2>
                <p>This is your profile information.</p>
                
            </div>
            <div class="d-flex  flex-wrap align-items-center">
                <div class="image">
                    <?php if (!empty($row['photo'])): ?>
                        <img class="rounded-circle speaker_img"  src="../actions/uploads/<?php echo $row['photo']; ?>" alt="Profile Photo" class="img-thumbnail" style="max-width: 200px;">
                    <?php else: ?>
                        <p>No photo uploaded</p>
                    <?php endif; ?>
                </div>

                <div class="speaker_details px-4">
                    <h5 class="card-title mb-3"><?php echo $row['name'];?></h5>
                    <h6 class="card-subtitle mb-2 text-muted"><?php echo $row['role'];?></h6>
                    <h6 class="card-subtitle mb-2 text-muted"><?php echo $row['organization'];?></h6>
                </div>
            </div>
            <div class="pt-5 mb-3">
                <label for="bio" class="form-label">Bio</label>
                <textarea class="form-control" id="bio" rows="5" disabled><?php echo $row['bio']; ?></textarea>
            </div>
            <a href="<?php echo $baseUrl; ?>/views/edit_profile_form.php?email=<?php echo $email; ?>" class="btn btn-primary">Edit Profile</a>
        </div>
    </div>
</div>

<?php
// Include footer file
include_once '../inc/footer.php';
?>
