<?php
include_once 'init.php';

// Database configuration
if ($_SERVER['SERVER_NAME'] === 'localhost' || $_SERVER['SERVER_ADDR'] === '127.0.0.1') {
    // Localhost configuration
    $servername = "127.0.0.1";
    $username = "root";
    $password = "mysql";
    $dbname = "speakers";
} else {
   // Actual server configuration
    $servername = "162.214.96.162";
    $username = "meetingsexperts_speakersp02";
    $password = "KnvTlACIlPzJ";
    $dbname = "meetingsexperts_speakers_portal";
}

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



// Get the current server protocol (http or http
// RzUoi0nGwWKz
// UJ=7aweeAB$y
?>
