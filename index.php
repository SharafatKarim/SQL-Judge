<?php
session_start();
$_SESSION["page"] = "home";

// Database connection
require './lib/db.php';
require './lib/security.php';

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
  <link rel="stylesheet" href="styles/mini.css">
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
              <a href="./blog/post.php?id=<?php echo decode_data_with_formatting($blog['ID']); ?>">
                <?php echo decode_data_with_formatting($blog['title']); ?>
              </a>
            </h2>
            <h5>By <?php echo decode_data_with_formatting($blog['username']); ?> on
              <?php echo decode_data_with_formatting($blog['created_at']); ?>
            </h5>
            <!-- TODO :: Add pagination and limit -->
            <p>
              <?php
              $content = decode_data_with_formatting($blog['content']);
              $max_length = 300;
              if (mb_strlen($content) > $max_length) {
                echo mb_substr($content, 0, $max_length) . '...';
                echo ' <a href="./post.php?id=' . decode_data_with_formatting($blog['ID']) . '">Read more</a>';
              } else {
                echo $content;
              }
              ?>
            </p>
            <hr>
          <?php endforeach; ?>
          <a href="./blog/index.php">
            <button class="horizontal-button">Load more...</button>
          </a>

        <?php else: ?>
          No blogs available at the moment.
        <?php endif; ?>

      </div>

      <div class="card">
        <h2>NEWSLETTER</h2>
        <hr>
        <div class="row2">
          <div>
            <h2>Become a Better SQL Enthusiast!</h2>
            <p>
              With the SQL Judge periodic Newsletter, 
              you'll get practical SQL tips, discover new challenges, 
              explore database concepts, and stay updated with the latest features and events 
              from the SQL Judge community.
            </p>
          </div>
          <div>
            <img src="./assets/logo.svg" alt="SQL-Judge" width="150px">
          </div>
        </div>
        <?php
        $newsletter_msg = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['newsletter_email'])) {
          $email = trim($_POST['newsletter_email']);
          if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            try {
              $stmt = $conn->prepare("INSERT INTO newsletters (email) VALUES (:email)");
              $stmt->bindParam(':email', $email);
              $stmt->execute();
              $newsletter_msg = '<span style="color:green;">Subscribed successfully!</span>';
            } catch (PDOException $e) {
              if ($e->getCode() == 23000) {
                $newsletter_msg = '<span style="color:orange;">You are already subscribed.</span>';
              } else {
                $newsletter_msg = '<span style="color:red;">Subscription failed, 
                try again later.</span>';
              }
            }
          } else {
            $newsletter_msg = '<span style="color:red;">Please enter a valid email address.</span>';
          }
        }
        ?>
        <form class="row2-form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
          <input type="email" name="newsletter_email" placeholder="Your email address" required>
          <button type="submit">Subscribe</button>
        </form>
        <?php if (!empty($newsletter_msg)) echo $newsletter_msg; ?>
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