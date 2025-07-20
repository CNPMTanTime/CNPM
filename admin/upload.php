<?php
header('Content-Type: application/json');

if (empty($_FILES['fileToUpload']) || $_FILES['fileToUpload']['error'] !== UPLOAD_ERR_OK) {
    echo json_encode(['success' => false]);
    exit;
}

$uploadDir = __DIR__ . '/public/uploads/';
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}

$file = $_FILES['fileToUpload'];
$ext = pathinfo($file['name'], PATHINFO_EXTENSION);
$fname = uniqid('img_') . '.' . $ext;
$target = $uploadDir . $fname;

if (!move_uploaded_file($file['tmp_name'], $target)) {
    echo json_encode(['success' => false]);
    exit;
}

$base = (isset($_SERVER['HTTPS']) ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'];
$url = $base . '/public/uploads/' . $fname;

echo json_encode(['success' => true, 'file' => $url]);
