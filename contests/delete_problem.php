<?php
session_start();
require '../lib/db.php';
require '../lib/security.php';

$problem_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$user_id = isset($_SESSION['id']) ? intval($_SESSION['id']) : 0;

// Fetch problem and contest
$stmt = $conn->prepare("SELECT p.*, c.created_by, c.ID AS contest_id FROM problems p JOIN contests c ON p.contest_id = c.ID WHERE p.ID = ?");
$stmt->execute([$problem_id]);
$problem = $stmt->fetch();
if (!$problem) {
    echo "<script>alert('Problem not found.'); window.location.href = 'index.php';</script>";
    exit();
}
$contest_id = $problem['contest_id'];

// Only creator can delete
if (!$user_id || $user_id != $problem['created_by']) {
    echo "<script>alert('Access denied. Only the contest creator can delete problems.'); window.location.href = 'no_access.php';</script>";
    exit();
}

// Delete problem and its test cases
$conn->beginTransaction();
try {
    $conn->prepare("DELETE FROM test_cases WHERE problem_id = ?")->execute([$problem_id]);
    $conn->prepare("DELETE FROM submissions WHERE problem_id = ?")->execute([$problem_id]);
    $conn->prepare("DELETE FROM problems WHERE ID = ?")->execute([$problem_id]);
    $conn->commit();
    echo "<script>alert('Problem deleted successfully.'); window.location.href = 'dashboard.php?id=$contest_id';</script>";
    exit();
} catch (Exception $e) {
    $conn->rollBack();
    echo "<script>alert('Failed to delete problem.'); window.location.href = 'dashboard.php?id=$contest_id';</script>";
    exit();
}
?>
