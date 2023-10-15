<?php
require_once 'Git.php';
require_once 'Utils.php';
Utils::init();
header('Content-Type: application/json');

if (
    $_SERVER['REQUEST_METHOD'] === 'POST' &&
    isset($_SERVER['CONTENT_TYPE']) &&
    $_SERVER['CONTENT_TYPE'] === 'application/json'
) {
    $data = json_decode(file_get_contents('php://input'), true);
    if (isset($data['folder']) && Utils::isValidDirectory($data['folder'])) {
        Git::pull($data['folder']);
        echo json_encode(['message' => 'done']);
    } else {
        http_response_code(400);
        echo json_encode(['error' => 'Oh shit! Houston, we have a problem']);
    }
} else {
    http_response_code(405);
    echo json_encode(['error' => 'Invalid request method']);
}