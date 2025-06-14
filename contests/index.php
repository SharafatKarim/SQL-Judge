<?php
session_start();
$_SESSION["page"] = "contests";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SQL Judge | Contests</title>
  <link rel="stylesheet" href="../styles/body.css">
  <link rel="stylesheet" href="../styles/grid.css">
  <link rel="stylesheet" href="../styles/mini.css">
</head>

<body>
  <?php require '../components/header.php'; ?>
  <?php require '../components/navbar.php'; ?>

  <div class="row">
    <!-- left column -->
    <div class="leftcolumn">
      <div class="card">
        <h2>Welcome to the Contests!</h2>
        <p>Feel free to create one...<br>
          ...and share the knowledge & XP!</p>

        <div class="row2">
          <a href="./creator.php" class="green-button">
            Create a new contest...
          </a>
        </div>
        <hr>
      </div>

      <div class="card">
        <?php
        require '../lib/db.php';
        require '../lib/security.php';
        $user_id = isset($_SESSION['id']) ? intval($_SESSION['id']) : 0;

        // Fetch and group contests
        $now = date('Y-m-d H:i:s');
        $upcoming = $conn->query("SELECT contests.*, users.username FROM contests JOIN users ON contests.created_by = users.ID WHERE contests.start_time > NOW() ORDER BY contests.start_time ASC");
        $running = $conn->query("SELECT contests.*, users.username FROM contests JOIN users ON contests.created_by = users.ID WHERE contests.start_time <= NOW() AND contests.end_time > NOW() ORDER BY contests.start_time ASC");
        $previous = $conn->query("SELECT contests.*, users.username FROM contests JOIN users ON contests.created_by = users.ID WHERE contests.end_time <= NOW() ORDER BY contests.start_time DESC");
        ?>

        <h2>Currently Running Contests</h2>
        <?php if ($running && $running->rowCount() > 0): ?>
          <?php foreach ($running as $contest): ?>
            <div class="card left-green">
              <h2><?php echo htmlspecialchars($contest['title']); ?></h2>
              <h5>By <?php echo htmlspecialchars($contest['username']); ?> | Starts:
                <?php echo htmlspecialchars($contest['start_time']); ?> | Ends:
                <?php echo htmlspecialchars($contest['end_time']); ?>
                <?php if (!$contest['is_public']): ?>
                  <span style="color: orange;">[PRIVATE]</span>
                <?php endif; ?>
              </h5>
              <p><?php echo nl2br(htmlspecialchars($contest['description'])); ?></p>
              <div class="row2">
                <a href="./editor.php?id=<?php echo $contest['ID']; ?>" class="green-button">Edit</a>
                <a href="./register.php?id=<?php echo $contest['ID']; ?>" class="green-button">Register</a>
                <a href="./dashboard.php?id=<?php echo $contest['ID']; ?>" class="green-button">Enter</a>
              </div>
              <hr>
            </div>
          <?php endforeach; ?>
        <?php else: ?>
          <div class="card left-green">No currently running contests.</div>
          <hr>
        <?php endif; ?>
      </div>

      <div class="card">
        <h2>Upcoming Contests</h2>
        <?php if ($upcoming && $upcoming->rowCount() > 0): ?>
          <?php foreach ($upcoming as $contest): ?>
            <div class="card left-blue">
              <h2><?php echo htmlspecialchars($contest['title']); ?></h2>
              <h5>By <?php echo htmlspecialchars($contest['username']); ?> | Starts:
                <?php echo htmlspecialchars($contest['start_time']); ?> | Ends:
                <?php echo htmlspecialchars($contest['end_time']); ?>
                <?php if (!$contest['is_public']): ?>
                  <span style="color: orange;">[PRIVATE]</span>
                <?php endif; ?>
              </h5>
              <p><?php echo nl2br(htmlspecialchars($contest['description'])); ?></p>
              <div class="row2">
                <a href="./editor.php?id=<?php echo $contest['ID']; ?>" class="green-button">Edit</a>
                <a href="./register.php?id=<?php echo $contest['ID']; ?>" class="green-button">Register</a>
                <a href="./dashboard.php?id=<?php echo $contest['ID']; ?>" class="green-button">Enter</a>
              </div>
              <hr>
            </div>
          <?php endforeach; ?>
        <?php else: ?>
          <div class="card left-blue">No upcoming contests.</div>
          <hr>
        <?php endif; ?>
      </div>

      <div class="card">
        <h2>Previous Contests</h2>
        <?php if ($previous && $previous->rowCount() > 0): ?>
          <?php foreach ($previous as $contest): ?>
            <div class="card left-red">
              <h2><?php echo htmlspecialchars($contest['title']); ?></h2>
              <h5>By <?php echo htmlspecialchars($contest['username']); ?> | Starts:
                <?php echo htmlspecialchars($contest['start_time']); ?> | Ends:
                <?php echo htmlspecialchars($contest['end_time']); ?>
                <?php if (!$contest['is_public']): ?>
                  <span style="color: orange;">[PRIVATE]</span>
                <?php endif; ?>
              </h5>
              <p><?php echo nl2br(htmlspecialchars($contest['description'])); ?></p>
              <div class="row2">
                <a href="./editor.php?id=<?php echo $contest['ID']; ?>" class="green-button">Edit</a>
                <a href="./register.php?id=<?php echo $contest['ID']; ?>" class="green-button">Register</a>
                <a href="./dashboard.php?id=<?php echo $contest['ID']; ?>" class="green-button">Enter</a>
              </div>
              <hr>
            </div>
          <?php endforeach; ?>
        <?php else: ?>
          <div class="card left-red">No previous contests.</div>
          <hr>
        <?php endif; ?>
      </div>

      <div class="card">
        <?php include '../components/newsletter.php' ?>
      </div>
    </div>

    <!-- right column -->
    <div class="rightcolumn">
      <?php include '../components/right_sidebar.php' ?>
    </div>
  </div>

  <?php require '../components/footer.php'; ?>

  <?php
  // Close the connection
  unset($conn);
  ?>
</body>

</html>