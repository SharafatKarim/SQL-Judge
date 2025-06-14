<?php
session_start();
$_SESSION["page"] = "problemsets";
require '../lib/db.php';
require '../lib/security.php';

// Fetch all problems from previous contests
$now = date('Y-m-d H:i:s');
$sql = "SELECT problems.*, contests.title AS contest_title FROM problems JOIN contests ON problems.contest_id = contests.ID WHERE contests.end_time <= ? ORDER BY contests.end_time DESC, problems.ID ASC";
$stmt = $conn->prepare($sql);
$stmt->execute([$now]);
$problems = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SQL Judge | Problemssets</title>
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
        <h2>Problems from Previous Contests</h2>
        <?php if (count($problems) > 0): ?>
          <ul>
            <?php foreach ($problems as $problem): ?>
            </ul>
            <table style="width:100%; border-collapse: collapse; margin-top: 1em;">
              <thead>
                <tr>
                  <th style="text-align:left; border-bottom: 1px solid #ccc; padding: 8px;">Title</th>
                  <th style="text-align:left; border-bottom: 1px solid #ccc; padding: 8px;">Contest</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($problems as $problem): ?>
                  <tr>
                    <td>
                      <a href="./problem.php?id=<?php echo $problem['ID']; ?>">
                        <?php echo htmlspecialchars($problem['title']); ?>
                      </a>
                    </td>
                    <td>
                      <?php echo htmlspecialchars($problem['contest_title']); ?>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          <?php endforeach; ?>
          </ul>
        <?php else: ?>
          <p>No problems from previous contests found.</p>
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