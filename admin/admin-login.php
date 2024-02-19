<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once "../inc/init.php";
include_once "../inc/header.php";

// Define the sanitizeInput function if not already defined
function sanitizeInput($input)
{
    return htmlspecialchars(trim($input));
}

// Check if there's a message in the session and assign it to a variable
$message = isset($_SESSION['message']) ? $_SESSION['message'] : "";

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize input email or username
    $input = sanitizeInput($_POST['input']); 

    // Prepare SQL statement to check if email or username is already registered
    $sql = "SELECT * FROM admin WHERE email = ? OR username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $input, $input); // Bind parameters
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the email or username is registered
    if ($result->num_rows > 0) {
        // Email or username is registered, proceed to the form
        $_SESSION['input'] = $input;

        $url = $baseUrl.'/admin/view_data.php';
        header("Location: $url");
        exit;
    } else {
        // Email or username is not registered, set error message and exit
        $_SESSION['message'] = "You entered an invalid email address or username";
        header("Location: {$_SERVER['PHP_SELF']}"); // Redirect back to the same page
        exit;
    }
}
?>

<div class="login_page">
    <div class="container py-5 mt-5">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <?php if (!empty($message)) { // Display the message if it's not empty ?>
                    <div class="alert alert-danger" role="alert"><?php echo $message; ?></div>
                    <?php unset($_SESSION['message']); ?>
                <?php } ?>
                <div class="text-start">
                    <h1 class="mt-1 mb-5 pb-1">Welcome!</h1>
                </div>
                <h4>Please enter your email or username to continue</h4>
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="input" class="form-label">Email / Username</label>
                        <input type="text" class="form-control" id="input" name="input" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include_once "../inc/footer.php"; ?>
