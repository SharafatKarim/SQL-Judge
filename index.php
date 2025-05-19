<?php
session_start();
$_SESSION["page"] = "home";

// Database connection
require './lib/db.php';

// Fetch blogs
$author_id = isset($_SESSION['id']) ? intval($_SESSION['id']) : 0;
$sql = "SELECT blogs.ID, blogs.title, blogs.content, blogs.created_at, users.username FROM blogs JOIN users ON blogs.author_id = users.ID WHERE blogs.is_published = 1 OR blogs.author_id = $author_id ORDER BY blogs.created_at DESC LIMIT 5";
$blogs = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SQL Judge | Home</title>
  <link rel="stylesheet" href="styles/body.css">
  <link rel="stylesheet" href="styles/grid.css">
  <link rel="stylesheet" href="styles/blog.css">
</head>

<body>
  <?php require 'components/header.php'; ?>
  <?php require 'components/navbar.php'; ?>

  <div class="row">
    <!-- left column -->
    <div class="leftcolumn">
      <div class="card">
        <h2>NEWS & EVENTS</h2>
        <hr>

        <h3>May update</h3>
        <h5>Major changes, Tue 13, May 2025</h5>
        <ul>
          <li>Blogs & Thoughts section added.</li>
          <li>Leaderboard implemented.</li>
        </ul>
        <h3>April update</h3>
        <h5>Major changes, Sun 06, April 2025</h5>
        <ul>
          <li>Grid layout implemented.</li>
          <li>Login and Sign up system implemented with php.</li>
          <li>Submit form to report errors implemented with php.</li>
        </ul>
        <h3>March update</h3>
        <h5>Major changes, Sun 06, April 2025</h5>
        <ul>
          <li>Basic layout implemented.</li>
          <li>Several pages implemented with basic HTML and CSS.</li>
        </ul>
      </div>

      <div class="card">
        <h2>BLOGS & THOUGHTS</h2>
        <hr>

        <?php if ($blogs && $blogs->rowCount() > 0): ?>
          <?php foreach ($blogs as $blog): ?>
            <h2>
              <a href="./blog/post.php?id=<?php echo htmlspecialchars($blog['ID']); ?>">
                <?php echo htmlspecialchars($blog['title']); ?>
              </a>
            </h2>
            <h5>By <?php echo htmlspecialchars($blog['username']); ?> on
              <?php echo htmlspecialchars($blog['created_at']); ?>
            </h5>
            <!-- TODO :: Add formatting, pagination and limit -->
            <p><?php echo htmlspecialchars_decode($blog['content']); ?></p>
            <hr>
          <?php endforeach; ?>
          <a href="./blog/index.php">
            <button class="horizontal-button">Load more...</button>
          </a>

        <?php else: ?>
          No blogs available at the moment.
        <?php endif; ?>

      </div>
    </div>

    <!-- right column -->
    <div class="rightcolumn">
      <?php include 'components/right_sidebar.php' ?>
    </div>
  </div>

  <?php require 'components/footer.php'; ?>
</body>

</html>