<?php
// Establish database connection
session_start();

// Check if an error message is set in the session
if (isset($_SESSION['error'])) {
    // Display the error message
    echo "<p>Error: " . $_SESSION['error'] . "</p>";

    // Unset the error message session variable
    unset($_SESSION['error']);
}
$host = 'localhost';
$db   = 'logistics_test_db';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, 'root', '', $options);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}


// Process sign-up form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
     if (strlen($password) < 6 || strlen($password) > 50) {
        // Store the error message in a session variable
        $_SESSION['error'] = "Invalid password length. Password must be at least 6 characters and less than 50 characters.";

        // Redirect back to the sign-up page
        header("Location: signup.php");
        exit;
    }

    // Generate a random 10-digit user ID
    $userId = rand(10000, 99999);

    // Insert user information into the database
    $stmt = $pdo->prepare("INSERT INTO users (id, username, password) VALUES (?, ?, ?)");
    $stmt->execute([$userId, $username, $password]);

    // Redirect to registration success page
    header("Location: registration_success.php?id=$userId");
    exit;
}
?>
