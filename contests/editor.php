<?php
session_start();
$_SESSION["page"] = "contests";
require "../lib/db.php";
require "../lib/security.php";

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
  header("location: ../auth/login.php");
  exit;
}

// Get contest ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
  echo "Invalid contest ID.";
  exit;
}
$contest_id = intval($_GET['id']);

// Initialize variables
$title = $description = $start_time = $end_time = "";
$title_err = $start_time_err = $end_time_err = "";
$is_public = true;

// Fetch contest data
$sql = "SELECT * FROM contests WHERE ID = :id";
if ($stmt = $conn->prepare($sql)) {
  $stmt->bindParam(":id", $contest_id, PDO::PARAM_INT);
  $stmt->execute();
  if ($stmt->rowCount() == 1) {
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $title = $row['title'];
    $description = $row['description'];
    $start_time = date('Y-m-d\TH:i', strtotime($row['start_time']));
    $end_time = date('Y-m-d\TH:i', strtotime($row['end_time']));
    $created_by = $row['created_by'];
    if ($created_by != $_SESSION["id"]) {
      header("location: ./no_access.php");
      exit;
    }
    $is_public = $row['is_public'] ? true : false;
  } else {
    echo "Contest not found.";
    exit;
  }
  unset($stmt);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $title = test_input($_POST["contest-title"]);
  $description = test_input($_POST["contest-description"]);
  $start_time = test_input($_POST["start-time"]);
  $end_time = test_input($_POST["end-time"]);
  $is_public = isset($_POST["is-public"]) ? 1 : 0;

  if (empty($title)) {
    $title_err = "Please enter a title.";
  }
  if (empty($start_time)) {
    $start_time_err = "Please enter a start time.";
  }
  if (empty($end_time)) {
    $end_time_err = "Please enter an end time.";
  }

  if (empty($title_err) && empty($start_time_err) && empty($end_time_err)) {
    $sql = "UPDATE contests SET title = :title, description = :description, start_time = :start_time, end_time = :end_time, is_public = :is_public WHERE ID = :id";
    if ($stmt = $conn->prepare($sql)) {
      $stmt->bindParam(":title", $param_title, PDO::PARAM_STR);
      $stmt->bindParam(":description", $param_description, PDO::PARAM_STR);
      $stmt->bindParam(":start_time", $param_start_time, PDO::PARAM_STR);
      $stmt->bindParam(":end_time", $param_end_time, PDO::PARAM_STR);
      $stmt->bindParam(":is_public", $param_is_public, PDO::PARAM_BOOL);
      $stmt->bindParam(":id", $contest_id, PDO::PARAM_INT);
      $param_title = $title;
      $param_description = $description;
      $param_start_time = $start_time;
      $param_end_time = $end_time;
      $param_is_public = $is_public;
      if ($stmt->execute()) {
        header("location: index.php");
        exit;
      } else {
        echo "Oops! Something went wrong. Please try again later.";
      }
      unset($stmt);
    }
    unset($conn);
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SQL Judge | Edit Contest</title>
  <link rel="stylesheet" href="../styles/body.css">
  <link rel="stylesheet" href="../styles/grid.css">
  <link rel="stylesheet" href="../styles/blog_editor.css">
  <link rel="stylesheet" href="../styles/mini.css">
</head>
<body>
  <?php require '../components/header.php'; ?>
  <?php require '../components/navbar.php'; ?>
  <div class="row">
    <div class="leftcolumn">
      <center>
        <h2 class="bigtxt">Edit Contest</h2>
      </center>
      <br>
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . '?id=' . $contest_id); ?>" method="POST">
        <h3>Contest Title</h3>
        <input type="text" class="full-w" name="contest-title" id="contest-title" placeholder="Contest title..." required value="<?php echo htmlspecialchars($title); ?>" />
        <span class="error"><?php echo $title_err; ?></span>
        <h3>Description</h3>
        <textarea class="full-w" name="contest-description" id="contest-description" style="height: 200px;" placeholder="Describe the contest..."><?php echo htmlspecialchars($description); ?></textarea>
        <h3>Start Time</h3>
        <input type="datetime-local" class="full-w" name="start-time" id="start-time" required value="<?php echo htmlspecialchars($start_time); ?>" />
        <span class="error"><?php echo $start_time_err; ?></span>
        <h3>End Time</h3>
        <input type="datetime-local" class="full-w" name="end-time" id="end-time" required value="<?php echo htmlspecialchars($end_time); ?>" />
        <span class="error"><?php echo $end_time_err; ?></span>
        <div style="margin: 10px 0;">
          <label><input type="checkbox" name="is-public" <?php if($is_public) echo 'checked'; ?>> Public contest</label>
        </div>
        <button type="submit" class="green-button">Update Contest</button>
      </form>
    </div>
    <div class="rightcolumn">
      <?php include '../components/right_sidebar.php' ?>
    </div>
  </div>
  <?php require '../components/footer.php'; ?>
</body>
</html>
