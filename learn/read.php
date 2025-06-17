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

$chapter = isset($_GET['chapter']) ? (int) $_GET['chapter'] : null;
$lesson = isset($_GET['lesson']) ? (int) $_GET['lesson'] : null;
$prev_lesson = $lesson - 1;
$next_lesson = $lesson + 1;

if (empty($chapter) || empty($lesson)) {
  errorRedirectToIndex();
}

$current_lesson_dir = "../static/ch" . "$chapter" . "/page-" . "$lesson" . ".webp";
$prev_lesson_dir = "../static/ch" . "$chapter" . "/page-" . "$prev_lesson" . ".webp";
$next_lesson_dir = "../static/ch" . "$chapter" . "/page-" . "$next_lesson" . ".webp";

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
  <link rel="icon" type="image/x-icon" href="../assets/favicon.ico">
  <title>SQL Judge | Learn</title>
  <link rel="stylesheet" href="../styles/body.css">
  <link rel="stylesheet" href="../styles/grid.css">
  <link rel="stylesheet" href="../styles/mini.css">
  <link rel="stylesheet" href="../styles/reader.css">
</head>

<script src="./get_focused.js"></script>

<body>
  <?php require '../components/header.php'; ?>
  <?php require '../components/navbar.php'; ?>

  <div class="row">
    <!-- left column -->
    <div class="leftcolumn">
      <div class="card">
        <h2>Online Viewer</h2>
        <h3><a href="./index.php">Index</a>
          > <a href="./index.php">Chapter
            <?php echo $chapter ?>
          </a>
          > Lesson
          <?php echo $lesson ?>
        </h3>
        <hr>
      </div>

      <div class="card">
        <img src="<?php echo $current_lesson_dir ?>" id="focus"
          alt="Chapter <?php echo $chapter ?>, Lesson <?php echo $lesson ?>">
      </div>

      <div class="card">
        <div class="row2-space-between">
          <button <?php echo $prev_lesson_exists ? '' : 'disabled'; ?> class="green-button"
            onclick="window.location.href='./read.php?chapter=<?php echo $chapter ?>&lesson=<?php echo $prev_lesson ?>'">Previous</button>

          <form method="get" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <input type="hidden" name="chapter" value="<?php echo $chapter; ?>">
            <input type="number" name="lesson" min="1" placeholder="<?php echo $lesson ?>" required
              class="lesson-input">
            <button type="submit" class="green-button">Go</button>
          </form>

          <button <?php echo $next_lesson_exists ? '' : 'disabled'; ?> class="green-button"
            onclick="window.location.href='./read.php?chapter=<?php echo $chapter ?>&lesson=<?php echo $next_lesson ?>'">Next</button>
        </div>
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