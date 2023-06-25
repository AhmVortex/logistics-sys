<?php
session_start();

// Establish database connection
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
} catch (PDOException $e) {
    echo "Database connection failed: " . $e->getMessage();
    exit;
}

// Retrieve the selected supplier ID from the form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['supplier'])) {
        $selectedSupplierId = $_POST['supplier'];

        // Retrieve the selected supplier's information from the database
        $query = "SELECT * FROM suppliers WHERE supplier_id = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$selectedSupplierId]);
        $supplier = $stmt->fetch();

        // Retrieve the items associated with the selected supplier from the database
        $query = "SELECT * FROM items WHERE supplier_id = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$selectedSupplierId]);
        $items = $stmt->fetchAll();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Supplier Page</title>
    <script>
        // Function to calculate and update the total price based on selected items
        function calculateTotalPrice() {
    var checkboxes = document.querySelectorAll('input[name="items[]"]');
    var totalPriceInput = document.getElementById('totalPrice');
    var totalPrice = 0;

    for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i].checked) {
            var itemPrice = parseFloat(checkboxes[i].getAttribute('data-price'));
            var quantitySelect = checkboxes[i].nextElementSibling;
            var quantity = parseInt(quantitySelect.value);
            totalPrice += itemPrice * quantity;
        }
    }

    totalPriceInput.value = totalPrice.toFixed(2) + "$";

    var proceedButton = document.getElementById('proceedButton');
    if (totalPrice > 0) {
        proceedButton.disabled = false;
    } else {
        proceedButton.disabled = true;
    }
}

    </script>
</head>
<body>
    <h1>Select prefered supplier then select from available products</h1>

    <form method="POST" action="supplier.php">
        <label for="supplier">Current available Suppliers:</label>
        <select id="supplier" name="supplier">
            <option value="" selected disabled>Select Supplier</option>
            <?php
            // Fetch and display the list of suppliers from the database
            $query = "SELECT * FROM suppliers";
            $stmt = $pdo->query($query);
            while ($row = $stmt->fetch()) {
                $supplierId = $row['supplier_id'];
                $supplierName = $row['supplier_name'];
                echo "<option value=\"$supplierId\">$supplierName</option>";
            }
            ?>
        </select>
        <button type="submit">Select</button>
    </form>

    <?php
    // Display the selected supplier's items and prices
    if (isset($supplier)) {
    echo "<h2>Items for Supplier: " . $supplier['supplier_name'] . "</h2>";

    if (count($items) > 0) {
        echo "<form method=\"POST\" action=\"truck.php\">";
        echo "<ul>";
        foreach ($items as $item) {
            $itemId = $item['item_id'];
            $itemName = $item['item_name'];
            $itemPrice = $item['price'];

            echo "<li>";
            echo "<label>";
            echo "<input type=\"checkbox\" name=\"items[]\" value=\"$itemId\" data-price=\"$itemPrice\" onchange=\"calculateTotalPrice()\">";
            echo "$itemName ($itemPrice$)";

            // Quantity dropdown
            echo "<select name=\"quantity[]\" onchange=\"calculateTotalPrice()\">";
            for ($i = 1; $i <= 10; $i++) {
                echo "<option value=\"$i\">$i</option>";
            }
            echo "</select>";

            echo "</label>";
            echo "</li>";
        }
        echo "</ul>";

        // Total Price and Proceed to Truck button
        echo "<label for=\"totalPrice\">Total Price:</label>";
        echo "<input type=\"text\" id=\"totalPrice\" name=\"totalPrice\" value=\"0$\" readonly>";

        echo "<button type=\"submit\" id=\"proceedButton\" disabled>Proceed to Truck</button>";
        echo "</form>";
    } else {
        echo "<p>No items available for this supplier.</p>";
    }
}
    ?>
</body>
</html>
