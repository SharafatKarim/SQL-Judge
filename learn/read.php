<?php
session_start();
$_SESSION["page"] = "learn";
?>

<?php
function errorRedirectToIndex()
{
  print "<script>alert('Invalid URL!');</script>";
  header("Location: ./not_found.php");
  exit();
}

$chapter = $_GET['chapter'] ?? null;
$lesson = $_GET['lesson'] ?? null;

if (empty($chapter) || empty($lesson)) {
  errorRedirectToIndex();
}

$current_lesson_dir = "../static/ch" . "$chapter" . "/page-" . "$lesson" . ".webp";
$prev_lesson_dir = "../static/ch" . "$chapter" . "/page-" . "$lesson-1" . ".webp";
$next_lesson_dir = "../static/ch" . "$chapter" . "/page-" . "$lesson+1" . ".webp";

$current_lesson_exists = file_exists($current_lesson_dir);
$prev_lesson_exists = file_exists($prev_lesson_dir);
$next_lesson_exists = file_exists($next_lesson_dir);

if (!$current_lesson_exists) {
  errorRedirectToIndex();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SQL Judge | Learn</title>
  <link rel="stylesheet" href="../styles/body.css">
  <link rel="stylesheet" href="../styles/grid.css">
  <link rel="stylesheet" href="../styles/table.css">
</head>

<body>
  <?php require '../components/header.php'; ?>
  <?php require '../components/navbar.php'; ?>

  <div class="row">
    <!-- left column -->
    <div class="leftcolumn">
      <div class="card">
        <h2>Online Viewer</h2>
        
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