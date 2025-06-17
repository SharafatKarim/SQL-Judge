<?php
session_start();
$_SESSION["page"] = "blog";
require "../lib/db.php";
require "../lib/security.php";

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
  header("location: ../auth/login.php");
  exit;
}

// Get blog ID from URL
$blog_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch existing blog data
$sql = "SELECT * FROM blogs WHERE ID = :blog_id AND author_id = :author_id";
$stmt = $conn->prepare($sql);
$stmt->execute([
  ':blog_id' => $blog_id,
  ':author_id' => $_SESSION['id']
]);
$blog = $stmt->fetch(PDO::FETCH_ASSOC);

// If blog doesn't exist or user is not the author, redirect
if (!$blog) {
  header("location: ./index.php");
  exit;
}

$title = $content = "";
$title_err = $content_err = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Handle delete action
  if (isset($_POST["delete_blog"])) {
    $delete_sql = "DELETE FROM blogs WHERE ID = :blog_id AND author_id = :author_id";
    if ($delete_stmt = $conn->prepare($delete_sql)) {
      $delete_stmt->bindParam(":blog_id", $blog_id, PDO::PARAM_INT);
      $delete_stmt->bindParam(":author_id", $_SESSION["id"], PDO::PARAM_INT);

      if ($delete_stmt->execute()) {
        // Also delete related comments and reactions
        $conn->prepare("DELETE FROM blog_comments WHERE blog_id = :blog_id")->execute([':blog_id' => $blog_id]);
        $conn->prepare("DELETE FROM blog_reactions WHERE blog_id = :blog_id")->execute([':blog_id' => $blog_id]);

        header("location: ./index.php");
        exit;
      } else {
        echo "Error deleting blog post.";
      }
      unset($delete_stmt);
    }
  } else {
    // Handle update action
    $title = test_input($_POST["blog-title"]);
    if (empty($title)) {
      $title_err = "Please enter a title.";
    }

    $content = test_input($_POST["blog-text"]);
    if (empty($content)) {
      $content_err = "Please enter the content.";
    }

    if (empty($title_err) && empty($content_err)) {
      $update_sql = "UPDATE blogs SET title = :title, content = :content, is_published = :is_published WHERE ID = :blog_id AND author_id = :author_id";

      if ($update_stmt = $conn->prepare($update_sql)) {
        // Bind parameters
        $update_stmt->bindParam(":title", $param_title, PDO::PARAM_STR);
        $update_stmt->bindParam(":content", $param_content, PDO::PARAM_STR);
        $update_stmt->bindParam(":is_published", $param_is_published, PDO::PARAM_BOOL);
        $update_stmt->bindParam(":blog_id", $blog_id, PDO::PARAM_INT);
        $update_stmt->bindParam(":author_id", $_SESSION["id"], PDO::PARAM_INT);

        // Set parameters
        $param_title = $title;
        $param_content = $content;
        $param_is_published = isset($_POST["save-draft"]) && $_POST["save-draft"] == '1' ? false : true;

        // Execute the statement
        if ($update_stmt->execute()) {
          header("location: post.php?id=" . $blog_id);
          exit;
        } else {
          echo "Oops! Something went wrong. Please try again later.";
        }

        unset($update_stmt);
      }
    }
  }
}

// Set form values to existing blog data
$title = $blog['title'];
$content = $blog['content'];

unset($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/x-icon" href="../assets/favicon.ico">
  <title>SQL Judge | Edit Blog</title>
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
        <h2 class="bigtxt">Edit Your Blog Post</h2>
        <p>Make changes to your blog post...</p>
      </center>
      <br>

      <form action="<?php echo htmlspecialchars_decode($_SERVER["PHP_SELF"]) . "?id=" . $blog_id; ?>" method="POST">
        <h2>Edit your post...</h2>

        <h3>Enter a title...</h3>
        <input type="text" class="full-w" name="blog-title" id="blog-title"
          value="<?php echo htmlspecialchars_decode($title); ?>" placeholder="Blog title..." required />
        <span class="error"><?php echo $title_err; ?></span>

        <h3>Enter full body...</h3>
        <textarea class="full-w" name="blog-text" id="blog-text" style="height: 500px;"
          placeholder="Write your blog here..." required><?php echo htmlspecialchars_decode($content); ?></textarea>
        <span class="error"><?php echo $content_err; ?></span>

        <div style="height: 16px"></div>
        <div class="row2">
          <button type="submit" name="save-draft" value="0" class="green-button">Update & Publish</button>
          <button type="submit" name="save-draft" value="1" class="green-button">Save as draft (private)</button>
          <button type="submit" name="delete_blog" value="1" class="green-button"
            onclick="return confirm('Are you sure you want to delete this blog post? This action cannot be undone.');">
            Delete Blog Post
          </button>
          <button class="green-button"
            onclick="window.location.href='post.php?id=<?php echo $blog_id; ?>'; return false;">
            Cancel
          </button>
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