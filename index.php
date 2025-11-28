<?php
// index.php - 放在网站根目录

$request_path = $_SERVER['REQUEST_URI'];
$request_method = $_SERVER['REQUEST_METHOD'];
$query_string = $_SERVER['QUERY_STRING'];
$timestamp = date('Y-m-d H:i:s');

$request_info = [
    'path' => $request_path,
    'method' => $request_method,
    'query' => $query_string,
    'timestamp' => $timestamp,
    'ip' => $_SERVER['REMOTE_ADDR']
];

// 根据Accept头返回不同内容
$accept = $_SERVER['HTTP_ACCEPT'] ?? '';

if (strpos($accept, 'application/json') !== false) {
    header('Content-Type: application/json');
    echo json_encode($request_info, JSON_PRETTY_PRINT);
} else {
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>PHP万能路由 - <?= htmlspecialchars($request_path) ?></title>
        <style>
            body { font-family: Arial, sans-serif; margin: 40px; }
            .info { background: #f5f5f5; padding: 20px; border-radius: 5px; margin: 10px 0; }
            pre { background: #eee; padding: 10px; overflow-x: auto; }
        </style>
    </head>
    <body>
        <h1>路径: <?= htmlspecialchars($request_path) ?></h1>
        <div class="info">
            <h3>请求信息:</h3>
            <pre><?= json_encode($request_info, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) ?></pre>
        </div>
        <p><a href="/">返回首页</a></p>
    </body>
    </html>
    <?php
}
?>
