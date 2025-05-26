<?php
session_start();
$_SESSION["page"] = "blog";
require "../lib/db.php";
require "../lib/security.php";

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
  header("location: ../auth/login.php");
  exit;
}

$title = $content = "";
$title_err = $content_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $title = test_input($_POST["blog-title"]);
  if (empty($title)) {
    $title_err = "Please enter a title.";
  }

  $content = test_input($_POST["blog-text"]);
  if (empty($content)) {
    $content_err = "Please enter the content.";
  }

  if (empty($title_err) && empty($content_err)) {
    $sql = "INSERT INTO blogs (author_id, title, content, is_published) VALUES (:author_id, :title, :content, :is_published)";

    if ($stmt = $conn->prepare($sql)) {
      // Bind parameters
      $stmt->bindParam(":author_id", $param_author_id, PDO::PARAM_INT);
      $stmt->bindParam(":title", $param_title, PDO::PARAM_STR);
      $stmt->bindParam(":content", $param_content, PDO::PARAM_STR);
      $stmt->bindParam(":is_published", $param_is_published, PDO::PARAM_BOOL);

      // Set parameters
      $param_author_id = $_SESSION["id"];
      $param_title = $title;
      $param_content = $content;
      $param_is_published = isset($_POST["save-draft"]) && $_POST["save-draft"] == '1' ? false : true;

      // Execute the statement
      if ($stmt->execute()) {
        // Redirect to the blog list or confirmation page
        header("location: index.php");
        exit;
      } else {
        echo "Oops! Something went wrong. Please try again later.";
      }

      // Close the statement
      unset($stmt);
    }
  }

  // Close the connection
  unset($conn);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SQL Judge | Blog</title>
  <link rel="stylesheet" href="../styles/body.css">
  <link rel="stylesheet" href="../styles/grid.css">
  <link rel="stylesheet" href="../styles/blog_editor.css">
  <link rel="stylesheet" href="../styles/mini.css">
</head>

<body>
  <?php require '../components/header.php'; ?>
  <?php require '../components/navbar.php'; ?>

  <div class="row">
    <!-- left column -->
    <div class="leftcolumn">
      <center>
        <h2 class="bigtxt">Welcome to the blog!</h2>
        <p>Feel free to share your thoughts...</p>
      </center>
      <br>

      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <h2>Create a new post...</h2>

        <h3>Enter a title...</h3>
        <input type="text" class="full-w" name="blog-title" id="blog-title" placeholder="Blog title..." required />
        <h3>Enter full body...</h3>
        <textarea class="full-w" name="blog-text" id="blog-text" style="height: 500px;"
          placeholder="Write your blog here..." required></textarea>

        <div style="height: 16px"></div>
        <div class="row2">
          <button type="submit" name="save-draft" value="0" class="green-button">Publish blog...</button>
          <button type="submit" name="save-draft" value="1" class="green-button">Save as draft (private)!</button>
        </div>
      </form>

    </div>

    <!-- right column -->
    <div class="rightcolumn">
      <?php include '../components/right_sidebar.php' ?>
    </div>
  </div>

  <?php require '../components/footer.php'; ?>
</body>

</html>