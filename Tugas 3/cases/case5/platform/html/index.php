<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Case 5 - Multi-Container App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-dark bg-primary">
        <div class="container">
            <span class="navbar-brand mb-0 h1">Case 5: PHP + MySQL + Redis</span>
        </div>
    </nav>
    
    <div class="container mt-5">
        <h1>Welcome to Multi-Container Application</h1>
        <p class="lead">This application demonstrates Docker multi-container architecture with PHP, MySQL, and Redis.</p>
        
        <div class="row mt-4">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Database Test</h5>
                        <p class="card-text">Test MySQL connection and display products.</p>
                        <a href="db-test.php" class="btn btn-primary">Test Database</a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Cache Test</h5>
                        <p class="card-text">Test Redis caching functionality.</p>
                        <a href="cache-test.php" class="btn btn-success">Test Cache</a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">PHP Info</h5>
                        <p class="card-text">View PHP configuration and extensions.</p>
                        <a href="info.php" class="btn btn-info">View Info</a>
                    </div>
                </div>
            </div>
        </div>

        <?php
        // Record visitor
        try {
            $mysql_host = getenv('MYSQL_HOST') ?: 'mysql';
            $mysql_db = getenv('MYSQL_DATABASE') ?: 'myapp';
            $mysql_user = getenv('MYSQL_USER') ?: 'appuser';
            $mysql_pass = getenv('MYSQL_PASSWORD') ?: 'apppass123';
            
            $pdo = new PDO("mysql:host=$mysql_host;dbname=$mysql_db", $mysql_user, $mysql_pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $ip = $_SERVER['REMOTE_ADDR'];
            $page = $_SERVER['REQUEST_URI'];
            $stmt = $pdo->prepare("INSERT INTO visitors (ip_address, page_visited) VALUES (?, ?)");
            $stmt->execute([$ip, $page]);
            
            // Get total visitors
            $stmt = $pdo->query("SELECT COUNT(*) as total FROM visitors");
            $total = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
            
            echo "<div class='alert alert-info mt-4'>Total Visitors: $total</div>";
        } catch (Exception $e) {
            echo "<div class='alert alert-warning mt-4'>Database connection pending...</div>";
        }
        ?>
    </div>
</body>
</html>
