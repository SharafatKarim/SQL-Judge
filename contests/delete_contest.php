<?php
session_start();
require '../lib/db.php';
require '../lib/security.php';

// Get contest ID from query
$contest_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if (!$contest_id) {
  header('Location: ./index.php');
  exit();
}

// Fetch contest info
$stmt = $conn->prepare("SELECT * FROM contests WHERE ID = ?");
$stmt->execute([$contest_id]);
$contest = $stmt->fetch();
if (!$contest) {
  header('Location: ./index.php');
  exit();
}

// Check if user is creator
$user_id = isset($_SESSION['id']) ? intval($_SESSION['id']) : 0;
if (!$user_id || $user_id != $contest['created_by']) {
  header('Location: ./no_access.php');
  exit();
}

// Delete contest registrations
$del_reg = $conn->prepare("DELETE FROM contest_registrations WHERE contest_id = ?");
$del_reg->execute([$contest_id]);

// Delete problems and their submissions
$problems = $conn->prepare("SELECT ID FROM problems WHERE contest_id = ?");
$problems->execute([$contest_id]);
while ($problem = $problems->fetch()) {
  $del_sub = $conn->prepare("DELETE FROM submissions WHERE problem_id = ?");
  $del_sub->execute([$problem['ID']]);
}
$del_prob = $conn->prepare("DELETE FROM problems WHERE contest_id = ?");
$del_prob->execute([$contest_id]);

// Delete the contest itself
$del_contest = $conn->prepare("DELETE FROM contests WHERE ID = ?");
$del_contest->execute([$contest_id]);

header('Location: ./index.php');
exit();
?>