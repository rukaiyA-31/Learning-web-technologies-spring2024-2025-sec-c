<?php
$conn = new mysqli('localhost', 'root', '', 'product_db');
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $name = $conn->real_escape_string($_POST['name']);
    $buying = $_POST['buying_price'];
    $selling = $_POST['selling_price'];
    $display = $_POST['display'];

    $sql = "UPDATE products SET 
            name='$name', 
            buying_price=$buying, 
            selling_price=$selling, 
            display='$display' 
            WHERE id=$id";
    
    if ($conn->query($sql)) {
        header("Location: view_products.php");
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

$id = $_GET['id'];
$sql = "SELECT * FROM products WHERE id=$id";
$product = $conn->query($sql)->fetch_assoc();
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Product</title>
</head>
<body>
    <h1>EDIT PRODUCT</h1>
    <form method="POST">
        <input type="hidden" name="id" value="<?= $product['id'] ?>">
        Name: <input type="text" name="name" value="<?= $product['name'] ?>" required><br>
        Buying Price: <input type="number" name="buying_price" step="0.01" 
                          value="<?= $product['buying_price'] ?>" required><br>
        Selling Price: <input type="number" name="selling_price" step="0.01" 
                           value="<?= $product['selling_price'] ?>" required><br>
        Display: 
        <select name="display" required>
            <option value="Yes" <?= $product['display'] == 'Yes' ? 'selected' : '' ?>>Yes</option>
            <option value="No" <?= $product['display'] == 'No' ? 'selected' : '' ?>>No</option>
        </select><br>
        <input type="submit" value="SAVE">
    </form>
</body>
</html>