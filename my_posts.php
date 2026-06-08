<?php
require 'config.php';

$uid = $_COOKIE['uid'] ?? null;

// Handle delete
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id']) && $uid) {
    $stmt = $pdo->prepare("DELETE FROM posts WHERE id = ? AND cookie_id = ?");
    $stmt->execute([$_POST['delete_id'], $uid]);
    header('Location: my_posts.php');
    exit;
}

if ($uid) {
    $stmt = $pdo->prepare("SELECT id, content, created_at FROM posts WHERE cookie_id = ? ORDER BY created_at DESC");
    $stmt->execute([$uid]);
    $posts = $stmt->fetchAll();
} else {
    $posts = [];
}

function linkify($text) {
    $text = htmlspecialchars($text);
    $pattern = '/(https?:\/\/[^\s]+)/';
    return preg_replace($pattern, '<a href="$1" target="_blank">$1</a>', $text);
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
        .post-footer { display: flex; justify-content: space-between; align-items: center; margin-top: 8px; }
        button { padding: 4px 12px; cursor: pointer; background: #fff; border: 1px solid #ddd; border-radius: 4px; color: #c00; }
        button:hover { background: #fee; }
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
                <p><?= linkify($p['content']) ?></p>
                <div class="post-footer">
                    <time><?= $p['created_at'] ?></time>
                    <form method="POST">
                        <input type="hidden" name="delete_id" value="<?= $p['id'] ?>">
                        <button type="submit" onclick="return confirm('Delete this post?')">Delete</button>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</body>
</html>
