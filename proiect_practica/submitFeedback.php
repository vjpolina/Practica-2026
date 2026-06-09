<?php
require_once 'includes/config_session.inc.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
    exit;
}

$body = json_decode(file_get_contents('php://input'), true);
if (!$body) {
    echo json_encode(['success' => false, 'message' => 'Invalid request body.']);
    exit;
}

$feedback = trim($body['feedback'] ?? '');
$email = trim($body['email'] ?? '');

if (strlen($feedback) < 10) {
    echo json_encode(['success' => false, 'message' => 'Feedback must be at least 10 characters.']);
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['success' => false, 'message' => 'Please enter a valid email address.']);
    exit;
}

$dataDir = __DIR__ . '/data';
if (!is_dir($dataDir)) {
    mkdir($dataDir, 0755, true);
}

$filePath = $dataDir . '/feedback.json';
$feedbackList = [];
if (file_exists($filePath)) {
    $json = file_get_contents($filePath);
    $feedbackList = json_decode($json, true) ?? [];
}

$record = [
    'id' => uniqid('feedback_', true),
    'user_id' => $_SESSION['user_id'] ?? null,
    'username' => $_SESSION['user_name'] ?? null,
    'email' => $email,
    'feedback' => strip_tags($feedback),
    'submitted_at' => date('Y-m-d H:i:s'),
    'page' => 'index'
];

array_unshift($feedbackList, $record);

$saved = file_put_contents($filePath, json_encode($feedbackList, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
if ($saved === false) {
    echo json_encode(['success' => false, 'message' => 'Failed to save feedback.']);
    exit;
}

echo json_encode(['success' => true, 'message' => 'Feedback submitted successfully.']);
