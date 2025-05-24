<link rel="stylesheet" href="../styles/mini.css">

<div>
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
      <img src="../assets/logo.svg" alt="SQL-Judge" width="150px">
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
  <?php if (!empty($newsletter_msg))
    echo $newsletter_msg; ?>
</div>