<?php
require_once 'includes/config_session.inc.php';

header('Content-Type: application/json');

$posts_file = __DIR__ . '/../data/posts.json';

if (!file_exists($posts_file)) {
    echo json_encode([]);
    exit;
}

$posts = json_decode(file_get_contents($posts_file), true) ?? [];

$filter = $_GET['filter'] ?? 'public';

if ($filter === 'mine') {
    if (!isset($_SESSION['user_id'])) {
        echo json_encode([]);
        exit;
    }
    $user_id = $_SESSION['user_id'];
    $result = array_values(array_filter($posts, fn($p) => $p['user_id'] == $user_id));

} else {
    $result = array_values(array_filter($posts, fn($p) => $p['is_private'] === false));
}

echo json_encode($result);
