<?php
require_once 'includes/config_session.inc.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
    exit;
}

$body = json_decode(file_get_contents('php://input'), true);
if (!$body || empty($body['post_id'])) {
    echo json_encode(['success' => false, 'message' => 'Missing post ID.']);
    exit;
}

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Authentication required.']);
    exit;
}

$postId = $body['post_id'];
$postsFile = __DIR__ . '/../data/posts.json';

if (!file_exists($postsFile)) {
    echo json_encode(['success' => false, 'message' => 'No posts found.']);
    exit;
}

$posts = json_decode(file_get_contents($postsFile), true) ?? [];
$userId = $_SESSION['user_id'];

$found = false;
$remaining = [];
foreach ($posts as $post) {
    if ($post['id'] === $postId && $post['user_id'] == $userId) {
        $found = true;
        continue;
    }
    $remaining[] = $post;
}

if (!$found) {
    echo json_encode(['success' => false, 'message' => 'Post not found or not owned by you.']);
    exit;
}

$saved = file_put_contents($postsFile, json_encode($remaining, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
if ($saved === false) {
    echo json_encode(['success' => false, 'message' => 'Failed to delete the post.']);
    exit;
}

echo json_encode(['success' => true]);
