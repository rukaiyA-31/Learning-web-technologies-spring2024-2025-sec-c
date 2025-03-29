<?php
$conn = new mysqli('localhost', 'root', '', 'product_db');
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$name = $conn->real_escape_string($_GET['name']);
$sql = "SELECT *, (selling_price - buying_price) AS profit 
        FROM products 
        WHERE display='Yes' AND name LIKE '%$name%'";
$result = $conn->query($sql);

while($row = $result->fetch_assoc()): ?>
<tr>
    <td><?= $row['name'] ?></td>
    <td><?= $row['profit'] ?></td>
    <td>
        <a href="edit_product.php?id=<?= $row['id'] ?>">Edit</a> | 
        <a href="delete_product.php?id=<?= $row['id'] ?>">Delete</a>
    </td>
</tr>
<?php endwhile;
$conn->close();
?>