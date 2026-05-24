<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

$uid = $_COOKIE['uid'] ?? bin2hex(random_bytes(8));
$content = trim($_POST['content'] ?? '');

if ($content === '') {
    header('Location: index.php');
    exit;
}

$stmt = $pdo->prepare("INSERT INTO posts (content, cookie_id) VALUES (?, ?)");
$stmt->execute([$content, $uid]);

header('Location: index.php');
exit;
?>
