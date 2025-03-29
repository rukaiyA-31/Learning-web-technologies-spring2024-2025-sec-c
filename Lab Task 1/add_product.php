<?php
$conn = new mysqli('localhost', 'root', '', 'product_db');
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $conn->real_escape_string($_POST['name']);
    $buying = $_POST['buying_price'];
    $selling = $_POST['selling_price'];
    $display = $_POST['display'];

    $sql = "INSERT INTO products (name, buying_price, selling_price, display)
            VALUES ('$name', $buying, $selling, '$display')";
    
    if ($conn->query($sql)) {
        echo "Product added successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Product</title>
</head>
<body>
    <h1>ADD PRODUCT</h1>
    <form method="POST">
        Name: <input type="text" name="name" required><br>
        Buying Price: <input type="number" name="buying_price" step="0.01" required><br>
        Selling Price: <input type="number" name="selling_price" step="0.01" required><br>
        Display: 
        <select name="display" required>
            <option value="Yes">Yes</option>
            <option value="No">No</option>
        </select><br>
        <input type="submit" value="SAVE">
    </form>
</body>
</html>