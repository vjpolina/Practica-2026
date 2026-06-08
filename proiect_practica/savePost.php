<?php
require_once 'includes/config_session.inc.php';

header('Content-Type: application/json');

if (!isset($_SESSION['user_id']) || !isset($_SESSION['user_name'])) {
    echo json_encode(['success' => false, 'message' => 'Not logged in.']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
    exit;
}

$body = json_decode(file_get_contents('php://input'), true);

if (!$body || empty(trim(strip_tags($body['content'])))) {
    echo json_encode(['success' => false, 'message' => 'Post content is empty.']);
    exit;
}

$username   = $_SESSION['user_name'];
$user_id    = $_SESSION['user_id'];
$content    = $content = $body['content'];
$is_private = isset($body['is_private']) ? (bool)$body['is_private'] : false;

$new_post = [
    'id'         => uniqid('post_', true),
    'user_id'    => $user_id,
    'username'   => $username,
    'content'    => $content,
    'is_private' => $is_private,
    'created_at' => date('Y-m-d H:i:s')
];


$posts_file = __DIR__ . '/../data/posts.json';


if (!is_dir(__DIR__ . '/../data')) {
    mkdir(__DIR__ . '/../data', 0755, true);
}

$posts = [];
if (file_exists($posts_file)) {
    $json = file_get_contents($posts_file);
    $posts = json_decode($json, true) ?? [];
}

$content = $body['content'];

$allowed_tags = '<p><br><b><strong><i><em><u><ul><ol><li>';
$content = strip_tags($content, $allowed_tags);

array_unshift($posts, $new_post); // newest first

$saved = file_put_contents(
    $posts_file,
    json_encode($posts, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
);

if ($saved === false) {
    echo json_encode(['success' => false, 'message' => 'Failed to write to file.']);
    exit;
}

echo json_encode(['success' => true, 'post_id' => $new_post['id']]);