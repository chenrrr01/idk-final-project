<?php
require 'config.php';

if (empty($_COOKIE['uid'])) {
    $uid = bin2hex(random_bytes(8));
    setcookie('uid', $uid, time() + 86400 * 365, '/');
} else {
    $uid = $_COOKIE['uid'];
}

$posts = $pdo->query("SELECT content, created_at FROM posts WHERE created_at >= NOW() - INTERVAL 12 HOUR ORDER BY created_at DESC")->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Random Thoughts</title>
    <style>
        body { font-family: sans-serif; max-width: 600px; margin: 40px auto; padding: 0 1rem; }
        textarea { width: 100%; height: 80px; padding: 8px; }
        button { margin-top: 8px; padding: 8px 20px; cursor: pointer; }
        .post { border: 1px solid #ddd; border-radius: 6px; padding: 12px; margin: 12px 0; }
        .post time { font-size: 0.8rem; color: #999; }
        nav a { margin-right: 12px; }
    </style>
</head>
<body>
    <h1>Random Thoughts</h1>
    <nav><a href="index.php">Wall</a><a href="my_posts.php">My posts</a></nav>

    <form action="post.php" method="POST">
        <textarea name="content" placeholder="What's on your mind?" required></textarea>
        <button type="submit">Post</button>
    </form>

    <?php foreach ($posts as $p): ?>
        <div class="post">
            <p><?= htmlspecialchars($p['content']) ?></p>
            <time><?= $p['created_at'] ?></time>
        </div>
    <?php endforeach; ?>

    <?php if (empty($posts)): ?>
        <p>No posts yet.</p>
    <?php endif; ?>
</body>
</html>
