<?php
$conn = new mysqli('localhost', 'root', '', 'product_db');
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM products WHERE id=$id";
    
    if ($conn->query($sql)) {
        header("Location: view_products.php");
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}
$conn->close();
?>