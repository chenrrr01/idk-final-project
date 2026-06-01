<?php
require 'config.php';

$uid = $_COOKIE['uid'] ?? null;

if ($uid) {
    $stmt = $pdo->prepare("SELECT content, created_at FROM posts WHERE cookie_id = ? ORDER BY created_at DESC");
    $stmt->execute([$uid]);
    $posts = $stmt->fetchAll();
} else {
    $posts = [];
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>My Posts - Random Thoughts</title>
    <style>
        body { font-family: sans-serif; max-width: 600px; margin: 40px auto; padding: 0 1rem; }
        .post { border: 1px solid #ddd; border-radius: 6px; padding: 12px; margin: 12px 0; }
        .post time { font-size: 0.8rem; color: #999; }
        nav a { margin-right: 12px; }
    </style>
</head>
<body>
    <h1>My Posts</h1>
    <nav><a href="index.php">Wall</a><a href="my_posts.php">My posts</a><a href="members.php">Members</a></nav>

    <?php if (empty($posts)): ?>
        <p>No posts yet.</p>
    <?php else: ?>
        <?php foreach ($posts as $p): ?>
            <div class="post">
                <p><?= htmlspecialchars($p['content']) ?></p>
                <time><?= $p['created_at'] ?></time>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</body>
</html>
