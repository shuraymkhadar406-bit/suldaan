<?php
session_start();
include "db_conn.php";

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Check if file is provided
if (!isset($_GET['file']) || empty($_GET['file'])) {
    header("Location: index.php");
    exit;
}

$file = basename($_GET['file']);
$path = "upload/file/" . $file;

// Check if file exists
if (!file_exists($path)) {
    die("File not found!");
}

// Get book information
$stmt = $conn->prepare("SELECT title FROM books WHERE file = ?");
$stmt->execute([$file]);
$book = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$book) {
    die("Book not found!");
}

// Save download report
$insert = $conn->prepare("INSERT INTO downloads (user_id, book_file, book_title) VALUES (?, ?, ?)");
$insert->execute([
    $_SESSION['user_id'],
    $file,
    $book['title']
]);

// Download the file
header("Content-Description: File Transfer");
header("Content-Type: application/octet-stream");
header("Content-Disposition: attachment; filename=\"" . basename($file) . "\"");
header("Content-Length: " . filesize($path));
readfile($path);
exit;
?>