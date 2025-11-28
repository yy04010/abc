<?php
// 放在网站根目录的 index.php

$request_uri = $_SERVER['REQUEST_URI'];

// 解析路径，匹配 /abc/ 和可选的ID
if (preg_match('#^/abc(?:/(?<id>.+))?$#', $request_uri, $matches)) {
    $id = $matches['id'] ?? '';
    
    if (empty($id)) {
        // 没有ID，跳转到B域名
        $target_url = "http://B域名.com";
    } else {
        // 有ID，跳转到B域名/ID
        $target_url = "http://B域名.com/{$id}";
    }
    
    // 立即跳转
    header("Location: {$target_url}", true, 302);
    exit;
}

// 其他所有路径都重定向到 /abc/
header("Location: /abc", true, 302);
exit;
?>
