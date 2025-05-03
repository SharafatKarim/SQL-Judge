<?php
session_start();
$_SESSION["page"] = "home";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SQL Judge | Home</title>
  <link rel="stylesheet" href="styles/body.css">
  <link rel="stylesheet" href="styles/grid.css">
</head>

<body>
  <?php require 'components/header.php'; ?>
  <?php require 'components/navbar.php'; ?>

  <div class="row">
    <!-- left column -->
    <div class="leftcolumn">
      <div class="card">
        <h2>NEWS & EVENTS</h2>
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
        <h2>TITLE HEADING</h2>
        <h5>Title description, Sun 6, 2025</h5>
        <div class="fakeimg" style="height:200px;">Image</div>
        <p>Some text..</p>
        <p>Sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod
          tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation
          ullamco.</p>
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