<?php
$redis_host = getenv('REDIS_HOST') ?: 'redis';
$redis_port = getenv('REDIS_PORT') ?: 6379;
?>
<!DOCTYPE html>
<html>
<head>
    <title>Redis Cache Test</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Redis Cache Test</h2>
        <a href="index.php" class="btn btn-secondary mb-3">Back to Home</a>
        
        <?php
        try {
            $redis = new Redis();
            $redis->connect($redis_host, $redis_port);
            
            echo "<div class='alert alert-success'>✓ Connected to Redis successfully!</div>";
            
            // Test cache operations
            $key = 'page_views';
            $redis->incr($key);
            $views = $redis->get($key);
            
            echo "<div class='card mt-3'>";
            echo "<div class='card-body'>";
            echo "<h5>Cache Statistics:</h5>";
            echo "<p>Total page views (cached): <strong>$views</strong></p>";
            
            // Set and get test
            $testKey = 'test_data';
            $testValue = 'Hello from Redis Cache! Time: ' . date('Y-m-d H:i:s');
            $redis->setex($testKey, 60, $testValue);
            $retrieved = $redis->get($testKey);
            
            echo "<p>Cached data: <code>$retrieved</code></p>";
            echo "<p><small>This data will expire in 60 seconds</small></p>";
            echo "</div></div>";
            
        } catch (Exception $e) {
            echo "<div class='alert alert-danger'>✗ Redis Error: " . $e->getMessage() . "</div>";
        }
        ?>
    </div>
</body>
</html>
