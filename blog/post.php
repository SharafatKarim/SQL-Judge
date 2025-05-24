<?php
session_start();
$_SESSION["page"] = "blog";

// Database connection
require '../lib/db.php';
require '../lib/security.php';

// Fetch blog post
$post_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$sql = "SELECT blogs.ID, blogs.title, blogs.content, blogs.created_at, users.username 
  FROM blogs 
  JOIN users ON blogs.author_id = users.ID 
  WHERE blogs.ID = :post_id AND (blogs.is_published = 1 OR blogs.author_id = :author_id)";
$stmt = $conn->prepare($sql);
$stmt->execute([
  ':post_id' => $post_id,
  ':author_id' => isset($_SESSION['id']) ? intval($_SESSION['id']) : 0
]);
$blog = $stmt->fetch(PDO::FETCH_ASSOC);

// Fetch comments
$comment_sql = "SELECT blog_comments.comment, blog_comments.created_at, users.username FROM blog_comments JOIN users ON blog_comments.user_id = users.ID WHERE blog_comments.blog_id = :post_id ORDER BY blog_comments.created_at DESC";
$comment_stmt = $conn->prepare($comment_sql);
$comment_stmt->execute([':post_id' => $post_id]);
$comments = $comment_stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch reactions
$reaction_sql = "SELECT reaction, COUNT(*) as count FROM blog_reactions WHERE blog_id = :post_id GROUP BY reaction";
$reaction_stmt = $conn->prepare($reaction_sql);
$reaction_stmt->execute([':post_id' => $post_id]);
$reactions = $reaction_stmt->fetchAll(PDO::FETCH_ASSOC);

// Handle new comment submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['comment'])) {
  $new_comment = trim($_POST['comment']);
  if (!empty($new_comment) && isset($_SESSION['id'])) {
    $insert_comment_sql = "INSERT INTO blog_comments (blog_id, user_id, comment) VALUES (:blog_id, :user_id, :comment)";
    $insert_comment_stmt = $conn->prepare($insert_comment_sql);
    $insert_comment_stmt->execute([
      ':blog_id' => $post_id,
      ':user_id' => $_SESSION['id'],
      ':comment' => $new_comment
    ]);
    header("Location: post.php?id=$post_id");
    exit;
  }
}

// Handle reaction submission - #TODO : Only one user can react one
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reaction'])) {
  $reaction = $_POST['reaction'];
  if (in_array($reaction, ['like', 'dislike']) && isset($_SESSION['id'])) {
    $insert_reaction_sql = "INSERT INTO blog_reactions (blog_id, user_id, reaction) VALUES (:blog_id, :user_id, :reaction) ON DUPLICATE KEY UPDATE reaction = :reaction";
    $insert_reaction_stmt = $conn->prepare($insert_reaction_sql);
    $insert_reaction_stmt->execute([
      ':blog_id' => $post_id,
      ':user_id' => $_SESSION['id'],
      ':reaction' => $reaction
    ]);
    header("Location: post.php?id=$post_id");
    exit;
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SQL Judge | Blog Post</title>
  <link rel="stylesheet" href="../styles/body.css">
  <link rel="stylesheet" href="../styles/grid.css">
  <link rel="stylesheet" href="../styles/mini.css">
  <link rel="stylesheet" href="../styles/blog.css">
  <link rel="stylesheet" href="../styles/code_block.css">
</head>

<body>
  <?php require '../components/header.php'; ?>
  <?php require '../components/navbar.php'; ?>

  <div class="row">
    <!-- left column -->
    <div class="leftcolumn">
      <?php if ($blog): ?>
        <div class="card">
          <h2><?php echo decode_data_with_formatting($blog['title']); ?></h2>
          <h5>By <?php echo decode_data_with_formatting($blog['username']); ?> on
            <?php echo decode_data_with_formatting($blog['created_at']); ?></h5>
          <hr>
        </div>
        <?php $content = decode_data_with_formatting($blog['content']); ?>
        <div class="card">
          <?php echo $content; ?>
        </div>
        
        <!-- Reactions card -->
        <div class="card">
          <h3>Reactions</h3>
          <form method="POST" class="reaction-container">
            <button type="submit" class="reaction-button" name="reaction" value="like">Like (<?php echo $reactions[0]['count'] ?? 0; ?>)</button>
            <button type="submit" class="reaction-button" name="reaction" value="dislike">Dislike (<?php echo $reactions[1]['count'] ?? 0; ?>)</button>
          </form>
        </div>

        <!-- Comments card -->
        <div class="card">
          <h3>Comments</h3>
          <?php if (!empty($comments)): ?>
            <?php foreach ($comments as $comment): ?>
              <div class="comment">
                <strong><?php echo decode_data_with_formatting($comment['username']); ?>:</strong>
                <p><?php echo decode_data_with_formatting($comment['comment']); ?></p>
                <small><?php echo decode_data_with_formatting($comment['created_at']); ?></small>
              </div>
              <hr>
            <?php endforeach; ?>
          <?php else: ?>
            <p>No comments yet. Be the first to comment!</p>
          <?php endif; ?>

          <?php if (isset($_SESSION['id'])): ?>
            <form method="POST">
                <textarea class="horizontal-textarea" name="comment" placeholder="Write a comment..." required></textarea>
              <button class="horizontal-button" type="submit">Submit</button>
            </form>
          <?php else: ?>
            <p><a href="../auth/login.php">Log in</a> to leave a comment.</p>
          <?php endif; ?>
        </div>
      <?php else: ?>
        <div class="card">Blog post not found or you do not have access to view it.</div>
      <?php endif; ?>
    </div>

    <!-- right column -->
    <div class="rightcolumn">
      <?php include '../components/right_sidebar.php'; ?>
    </div>
  </div>

  <?php require '../components/footer.php'; ?>

  <?php
  // Close the connection
  unset($conn);
  ?>
</body>

</html>