<?php
session_start();

// Check if the total price is passed from the previous page
if (isset($_POST['totalPrice'])) {
    $totalPrice = $_POST['totalPrice'];
} else {
    // Redirect the user if the total price is not available
    header("Location: supplier.php");
    exit();
}

// Retrieve the list of available trucks from the database
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

    // Query to retrieve the available trucks with shipping fees
    $query = "SELECT * FROM trucks";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $trucks = $stmt->fetchAll();
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html>
<head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Truck Selection</title>
</head>
<body>
    <h1>Current available trucks</h1>

    <?php
    // Retrieve the total price from the previous page (supplier.php)
    if (isset($_POST['totalPrice'])) {
        $totalPrice = $_POST['totalPrice'];
    } else {
        // Redirect the user if the total price is not available
        header("Location: supplier.php");
        exit();
    }
    ?>

    <h2>Total Price: <?php echo $totalPrice; ?></h2>

    <h3>Select a truck:</h3>
    <form action="checkout.php" method="post">
        <?php
        // Retrieve the list of available trucks from the database
        try {
            $pdo = new PDO($dsn, $user, $pass, $options);

            // Query to retrieve the available trucks
            $query = "SELECT * FROM trucks";
            $stmt = $pdo->query($query);
            $trucks = $stmt->fetchAll();
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }

        // Display the list of available trucks
        foreach ($trucks as $truck) {
            echo '<input type="radio" name="truckId" value="' . $truck['truck_id'] . '">' . $truck['truck_model'] . ' - ' . $truck['truck_type'] . ' (Capacity: ' . $truck['truck_capacity'] . ', Shipping Fee: ' . $truck['truck_shipping_price'] .'$'. ')<br>';
        }
        ?>

        <button type="submit">Proceed to Checkout</button>
        <input type="hidden" name="totalPrice" value="<?php echo $totalPrice; ?>">
    </form>
</body>
</html>