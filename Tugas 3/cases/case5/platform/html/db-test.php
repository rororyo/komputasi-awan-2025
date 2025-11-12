<?php
$mysql_host = getenv('MYSQL_HOST') ?: 'mysql';
$mysql_db = getenv('MYSQL_DATABASE') ?: 'myapp';
$mysql_user = getenv('MYSQL_USER') ?: 'appuser';
$mysql_pass = getenv('MYSQL_PASSWORD') ?: 'apppass123';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Database Test</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>MySQL Database Test</h2>
        <a href="index.php" class="btn btn-secondary mb-3">Back to Home</a>
        
        <?php
        try {
            $pdo = new PDO("mysql:host=$mysql_host;dbname=$mysql_db", $mysql_user, $mysql_pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            echo "<div class='alert alert-success'>✓ Connected to MySQL successfully!</div>";
            
            // Fetch products
            $stmt = $pdo->query("SELECT * FROM products");
            $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            echo "<h3>Products in Database:</h3>";
            echo "<table class='table table-striped'>";
            echo "<thead><tr><th>ID</th><th>Name</th><th>Price (Rp)</th><th>Stock</th></tr></thead>";
            echo "<tbody>";
            foreach ($products as $product) {
                echo "<tr>";
                echo "<td>{$product['id']}</td>";
                echo "<td>{$product['name']}</td>";
                echo "<td>" . number_format($product['price'], 0, ',', '.') . "</td>";
                echo "<td>{$product['stock']}</td>";
                echo "</tr>";
            }
            echo "</tbody></table>";
            
        } catch (PDOException $e) {
            echo "<div class='alert alert-danger'>✗ Database Error: " . $e->getMessage() . "</div>";
        }
        ?>
    </div>
</body>
</html>
