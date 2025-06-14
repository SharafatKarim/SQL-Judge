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
$stmt = $conn->prepare("SELECT contests.*, users.username FROM contests JOIN users ON contests.created_by = users.ID WHERE contests.ID = ?");
$stmt->execute([$contest_id]);
$contest = $stmt->fetch();
if (!$contest) {
  echo "<h2>Contest not found.</h2>";
  exit();
}

$user_id = isset($_SESSION['id']) ? intval($_SESSION['id']) : 0;
$is_creator = ($user_id && $user_id == $contest['created_by']);

// Check registration
$is_registered = false;
if ($user_id) {
  $reg_stmt = $conn->prepare("SELECT 1 FROM contest_registrations WHERE user_id = ? AND contest_id = ?");
  $reg_stmt->execute([$user_id, $contest_id]);
  $is_registered = $reg_stmt->fetch() ? true : false;
}

// Access control
$now = date('Y-m-d H:i:s');
if ($contest['start_time'] > $now && !$is_creator) {
  // Not started yet, only creator can view
  header('Location: ./no_access.php');
  exit();
}
if (!$is_creator && !$is_registered) {
  // Not registered
  header('Location: ./no_access.php');
  exit();
}

// Fetch problems
$problems = $conn->prepare("SELECT * FROM problems WHERE contest_id = ? ORDER BY ID ASC");
$problems->execute([$contest_id]);

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contest Dashboard | <?php echo htmlspecialchars($contest['title']); ?></title>
  <link rel="stylesheet" href="../styles/body.css">
  <link rel="stylesheet" href="../styles/grid.css">
  <link rel="stylesheet" href="../styles/mini.css">
</head>

<body>
  <?php require '../components/header.php'; ?>
  <?php require '../components/navbar.php'; ?>
  <div class="row">
    <div class="leftcolumn">
      <div class="card">
        <h2><?php echo htmlspecialchars($contest['title']); ?></h2>
        <h5>By <?php echo htmlspecialchars($contest['username']); ?> | Starts:
          <?php echo htmlspecialchars($contest['start_time']); ?> | Ends:
          <?php echo htmlspecialchars($contest['end_time']); ?>
        </h5>
        <p><?php echo nl2br(htmlspecialchars($contest['description'])); ?></p>
        <div class="row2">
          <?php if ($is_creator): ?>
            <a href="./delete_contest.php?id=<?php echo $contest_id; ?>" class="green-button"
              onclick="return confirm('Are you sure you want to delete this contest?');">Delete Contest</a>
            <a href="./add_problem.php?contest_id=<?php echo $contest_id; ?>" class="green-button">Add
              Problemsets</a>
            <a href="./validate.php?contest_id=<?php echo $contest_id; ?>" class="green-button">Validate
              Answers</a>
          <?php endif; ?>
          <a href="./index.php" class="green-button">Back to Contests</a>
        </div>
      </div>
      <div class="card">
        <h2>Problems</h2>
        <?php if ($problems->rowCount() > 0): ?>
          <?php foreach ($problems as $problem): ?>
            <div class="card left-green">
              <h3>
                <a href="./problem.php?id=<?php echo $problem['ID']; ?>">
                  <?php echo htmlspecialchars($problem['title']); ?>
                </a>
              </h3>
              <p><?php echo nl2br(htmlspecialchars($problem['description'])); ?></p>
              <span>Difficulty: <?php echo htmlspecialchars($problem['difficulty']); ?></span>
            </div>
          <?php endforeach; ?>
        <?php else: ?>
          <div class="card left-red">No problems added yet.</div>
        <?php endif; ?>
      </div>
    </div>
    <div class="rightcolumn">
      <?php include '../components/right_sidebar.php' ?>
    </div>
  </div>
  <?php require '../components/footer.php'; ?>
  <?php unset($conn); ?>
</body>

</html>