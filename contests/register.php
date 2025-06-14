<?php
session_start();
require '../lib/db.php';
require '../lib/security.php';

$contest_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$user_id = isset($_SESSION['id']) ? intval($_SESSION['id']) : 0;

if (!$user_id) {
    echo "<script>alert('You must be logged in to register for a contest.'); window.location.href = './index.php';</script>";
    exit();
}

if (!$contest_id) {
    echo "<script>alert('Invalid contest.'); window.location.href = './index.php';</script>";
    exit();
}

// Check if already registered
$stmt = $conn->prepare("SELECT 1 FROM contest_registrations WHERE user_id = ? AND contest_id = ?");
$stmt->execute([$user_id, $contest_id]);
if ($stmt->fetch()) {
    echo "<script>alert('You are already registered for this contest.'); window.location.href = './index.php';</script>";
    exit();
}

// Register the user
$reg_stmt = $conn->prepare("INSERT INTO contest_registrations (user_id, contest_id) VALUES (?, ?)");
if ($reg_stmt->execute([$user_id, $contest_id])) {
    echo "<script>alert('Registration successful!'); window.location.href = './index.php';</script>";
} else {
    echo "<script>alert('Registration failed. Please try again.'); window.location.href = './index.php';</script>";
}
?>
