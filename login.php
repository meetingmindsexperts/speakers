<?php
session_start();

// Include necessary files
include_once 'inc/db.php';
include_once 'inc/header.php';

$errors = $_SESSION['errors'] = [];
$messages = $_SESSION['messages'] = [];

// Function to sanitize input
function sanitizeInput($input) {
    return htmlspecialchars(trim($input));
}

// Handle email submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get email from the form
    $email = sanitizeInput($_POST['email']);
    
    // Check if the email is already registered
    $sql = "SELECT * FROM speaker_info WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Email is registered, proceed to the form
        $_SESSION['email'] = $email;
        header("Location: views/edit_profile_form.php?email=".$email."&action=edit");
        exit;
    } else {
        // Email is not registered, register the user and proceed to the form
        // For simplicity, let's assume default values for other columns
        $name = ""; // Provide default value for name
        $organization = ""; // Provide default value for organization
        $role = ""; // Provide default value for role
        $photo = null; // Provide default value for photo
        $bio = ""; // Provide default value for bio
        $created_at = date('Y-m-d H:i:s'); // Get current datetime for created_at
        $modified_at = $created_at; // Use created_at datetime for modified_at
        
        $sql = "INSERT INTO speaker_info (email, name, organization, role, photo, bio, created_at, modified_at) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssbsss", $email, $name, $organization, $role, $photo, $bio, $created_at, $modified_at);
        
        if ($stmt->execute()) {
            // Registration successful, proceed to the form
            $_SESSION['email'] = $email;
            header("Location: views/profile_form.php?email=".$email);
            exit;
        } else {
            // Registration failed, show error message
            $errors[] = 'Registration failed: ' . $stmt->error;
        }
    }
}
?>
<div class="container py-5 mt-5"> 
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <?php foreach ($errors as $error) { ?>
                <div class="alert alert-danger" role="alert"><?php echo $error; ?></div>
            <?php } ?>
            <div class="text-start">
                <img src="https://meetingmindsexperts.com/wp-content/uploads/2018/11/MME-WEB-LOGO-12-11-18.png" alt="logo" style="width: 185px;">
                <h4 class="mt-1 mb-5 pb-1">Meeting Minds Experts</h4>
            </div>
            <h2>Enter Your Email</h2>
            <form action="" method="post">
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>

<?php
// Include necessary files
include_once 'inc/footer.php';
?>
