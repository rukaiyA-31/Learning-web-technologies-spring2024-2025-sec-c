<?php
$conn = new mysqli('localhost', 'root', '', 'product_db');
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$sql = "SELECT *, (selling_price - buying_price) AS profit 
        FROM products WHERE display='Yes'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Product List</title>
    <script>
    function searchProduct() {
        const name = document.getElementById('search').value;
        const xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById('results').innerHTML = this.responseText;
            }
        };
        xhr.open("GET", `search.php?name=${name}`, true);
        xhr.send();
    }
    </script>
</head>
<body>
    <h1>PRODUCT LIST</h1>
    
    <!-- Part E: Search Feature -->
    <input type="text" id="search" placeholder="Search By Name" onkeyup="searchProduct()">
    
    <table border="1">
        <thead>
            <tr>
                <th>NAME</th>
                <th>PROFIT</th>
                <th>ACTIONS</th>
            </tr>
        </thead>
        <tbody id="results">
            <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['name'] ?></td>
                <td><?= $row['profit'] ?></td>
                <td>
                    <a href="edit_product.php?id=<?= $row['id'] ?>">Edit</a> | 
                    <a href="delete_product.php?id=<?= $row['id'] ?>">Delete</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>
<?php $conn->close(); ?>