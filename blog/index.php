<?php
session_start();
$_SESSION["page"] = "blog";

// Database connection
require '../lib/db.php';

// Fetch blogs
$author_id = isset($_SESSION['id']) ? intval($_SESSION['id']) : 0;
$sql = "SELECT blogs.ID, blogs.title, blogs.content, blogs.created_at, users.username FROM blogs JOIN users ON blogs.author_id = users.ID WHERE blogs.is_published = 1 OR blogs.author_id = $author_id ORDER BY blogs.created_at DESC";
$blogs = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SQL Judge | Blog</title>
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
        <h2>Welcome to the blog!</h2>
        <p>Feel free to share your thoughts...</p>

        <div class="row2">
          <a href="./creator.php" class="green-button">
            Publish a blog...
          </a>
          <a href="./creator.php" class="green-button">
            Craft a draft blog...!
          </a>
        </div>
        <hr>
      </div>

      <?php if ($blogs && $blogs->rowCount() > 0): ?>
        <?php foreach ($blogs as $blog): ?>
            <div class="card">
            <h2>
              <a href="./post.php?id=<?php echo htmlspecialchars($blog['ID']); ?>">
              <?php echo htmlspecialchars($blog['title']); ?>
              </a>
            </h2>
            <h5>By <?php echo htmlspecialchars($blog['username']); ?> on
              <?php echo htmlspecialchars($blog['created_at']); ?>
            </h5>
            <!-- TODO :: Add formatting, pagination and limit -->
            <p><?php echo htmlspecialchars_decode($blog['content']); ?></p>
            </div>
        <?php endforeach; ?>
      <?php else: ?>
        <div class="card">No blogs available at the moment.</div>
      <?php endif; ?>

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