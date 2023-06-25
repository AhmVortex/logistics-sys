<?php
session_start();

// Check if the truck ID and total price are passed from the previous page
if (isset($_POST['truckId']) && isset($_POST['totalPrice'])) {
    $truckId = $_POST['truckId'];
    $totalPrice = $_POST['totalPrice'];
} else {
    // Redirect the user if the truck ID or total price is not available
    header("Location: supplier.php");
    exit();
}

// Retrieve the truck details from the database
$host = 'localhost';
$db = 'logistics_test_db';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);

    // Query to retrieve the selected truck details
    $query = "SELECT * FROM trucks WHERE truck_id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$truckId]);
    $truck = $stmt->fetch();

    // Check if the truck shipping price is numeric
    if (is_numeric($truck['truck_shipping_price'])) {
        $totalPrice += $truck['truck_shipping_price'];
    } else {
        // Handle the case when the truck shipping price is not numeric
        // You can display an error message or take appropriate action here
    }
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html>
<head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Checkout</title>
</head>
<body>
    <h1>Checkout</h1>

    <h2>Selected Truck:</h2>
    <p>Truck Model: <?php echo $truck['truck_model']; ?></p>
    <p>Truck Type: <?php echo $truck['truck_type']; ?></p>
    <p>Truck Capacity: <?php echo $truck['truck_capacity']; ?></p>
    <p>Shipping Fee: <?php echo $truck['truck_shipping_price']; ?></p>

    <h2>Total Price (including shipping fee): <?php echo $totalPrice; ?></h2>

    <h3>Payment and Order Confirmation</h3>
    <!-- Add your payment and order confirmation form here -->

</body>
</html>
