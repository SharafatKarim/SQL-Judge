<?php
session_start();
$_SESSION["page"] = "problemsets";
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
        <h2>Welcome to the Problemssets!</h2>
        <p>Feel free to submit a query...</p>

        <div class="row2">
          <a href="./creator.php" class="green-button">
            Publish a query...
          </a>
        </div>
        <hr>
      </div>

      <div class="card">
        <h2>No contests running!</h2>
        <p>Please check back tomorrow...</p>
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