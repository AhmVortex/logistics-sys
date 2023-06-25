<?php
// Establish database connection (similar to signup.php)

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

// Handle login form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve user ID and password from the form
    $userId = $_POST['userId'];
    $password = $_POST['password'];

    // Prepare and execute the SQL query to check user credentials
    $query = "SELECT * FROM users WHERE id = ? AND password = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$userId, $password]);

    // Check if a matching user is found
    $user = $stmt->fetch();
    if ($user) {
        // Successful login

echo nl2br("Login successful!\nWelcome, " . $user['username'] . " with ID: " . $user['id'] . "\nLogin is done succesfully, You are now ready to proceed to your order\nClick <a href='supplier.php'>here</a> to redirect you to the order page");




    } else {
        // Invalid credentials
        echo "Invalid user ID or password. Please try again.";
    }
}
?>
