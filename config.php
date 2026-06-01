<?php
$pdo = new PDO('mysql:host=127.0.0.1;dbname=random_thoughts;charset=utf8mb4', 'your_user', 'your_password');

$pdo->exec("CREATE TABLE IF NOT EXISTS users (
    cookie_id  VARCHAR(64) PRIMARY KEY,
    first_seen DATETIME DEFAULT CURRENT_TIMESTAMP
)");

$pdo->exec("CREATE TABLE IF NOT EXISTS posts (
    id         INT AUTO_INCREMENT PRIMARY KEY,
    content    TEXT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    cookie_id  VARCHAR(64) NOT NULL,
    FOREIGN KEY (cookie_id) REFERENCES users(cookie_id)
)");
?>
