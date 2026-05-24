<?php
$pdo = new PDO('mysql:host=127.0.0.1;dbname=random_thoughts;charset=utf8mb4', 'your_user', 'your_password');

$pdo->exec("CREATE TABLE IF NOT EXISTS posts (
    id        INT AUTO_INCREMENT PRIMARY KEY,
    content   TEXT NOT NULL,
    cookie_id VARCHAR(64) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
)");
?>
