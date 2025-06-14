<?php
session_start();
$_SESSION["page"] = "leaderboard";
?>

<?php
require "../lib/db.php";

// Fetch users ordered by total_solved
$sql_total_solved = "SELECT first_name, last_name, username, total_solved
          FROM users
          ORDER BY total_solved DESC
          LIMIT 50";
if (
  $stmt = $conn->prepare($sql_total_solved)
) {
  if ($stmt->execute()) {
    $total_solved = $stmt->fetchAll(PDO::FETCH_ASSOC);
  } else {
    echo "Oops! Something went wrong. Please try again later.";
  }
} else {
  echo "Oops! Something went wrong. Please try again later.";
}

// Fetch users ordered by total_submissions
$sql_total_submissions = "SELECT first_name, last_name, username, total_submissions
                    FROM users
                    ORDER BY total_submissions DESC
                    LIMIT 50";
if (
  $stmt2 = $conn->prepare($sql_total_submissions)
) {
  if ($stmt2->execute()) {
    $total_submissions = $stmt2->fetchAll(PDO::FETCH_ASSOC);
  } else {
    echo "Oops! Something went wrong. Please try again later.";
  }
} else {
  echo "Oops! Something went wrong. Please try again later.";
}

$sql_total_contributions = "SELECT first_name, last_name, username, total_contributions
               FROM users
               ORDER BY total_contributions DESC
               LIMIT 50";
if ($stmt3 = $conn->prepare($sql_total_contributions)) {
  if ($stmt3->execute()) {
    $total_contributions = $stmt3->fetchAll(PDO::FETCH_ASSOC);
  } else {
    echo "Oops! Something went wrong. Please try again later.";
  }
} else {
  echo "Oops! Something went wrong. Please try again later.";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SQL Judge | Leaderboard</title>
  <link rel="stylesheet" href="../styles/body.css">
  <link rel="stylesheet" href="../styles/grid.css">
  <link rel="stylesheet" href="../styles/mini.css">
  <link rel="stylesheet" href="../styles/table.css">
</head>

<body>
  <?php require '../components/header.php'; ?>
  <?php require '../components/navbar.php'; ?>

  <div class="row">
    <!-- left column -->
    <div class="leftcolumn">
      <div class="card">
        <h2>Most solved by...</h2>
        <table>
          <tr>
            <th>Name</th>
            <th>Total solved</th>
          </tr>
          <tr>
            <?php
            if (!empty($total_solved)) {
              foreach ($total_solved as $row) {
                echo "<tr>";
                echo "<td><a href='../profile/index.php?username=" .
                  urlencode($row['username']) .
                  "'>" .
                  htmlspecialchars($row['first_name'] .
                    ' ' . $row['last_name']) . "</a></td>";
                echo "<td>" . htmlspecialchars($row['total_solved']) . "</td>";
                echo "</tr>";
              }
            } else {
              echo "<tr><td colspan='2'>No data found.</td></tr>";
            }
            ?>
          </tr>
        </table>
      </div>

      <div class="card">
        <h2>Most hard worker...</h2>
        <table>
          <tr>
            <th>Name</th>
            <th>Total submissions</th>
          </tr>
          <?php
          if (!empty($total_submissions)) {
            foreach ($total_submissions as $row) {
              echo "<tr>";
              echo "<td><a href='../profile/index.php?username=" .
                urlencode($row['username']) .
                "'>" .
                htmlspecialchars($row['first_name'] .
                  ' ' . $row['last_name']) . "</a></td>";
              echo "<td>" . htmlspecialchars($row['total_submissions']) . "</td>";
              echo "</tr>";
            }
          } else {
            echo "<tr><td colspan='2'>No data found.</td></tr>";
          }
          ?>
        </table>
      </div>
      
      <div class="card">
        <h2>Most contribution...</h2>
        <table>
          <tr>
            <th>Name</th>
            <th>Total contributions</th>
          </tr>
          <?php
          if (!empty($total_contributions)) {
            foreach ($total_contributions as $row) {
              echo "<tr>";
              echo "<td><a href='../profile/index.php?username=" .
                urlencode($row['username']) .
                "'>" .
                htmlspecialchars($row['first_name'] .
                  ' ' . $row['last_name']) . "</a></td>";
              echo "<td>" . htmlspecialchars($row['total_contributions']) . "</td>";
              echo "</tr>";
            }
          } else {
            echo "<tr><td colspan='2'>No data found.</td></tr>";
          }
          ?>
        </table>
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