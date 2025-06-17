<?php
session_start();
$_SESSION["page"] = "about";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/x-icon" href="../assets/favicon.ico">
  <title>SQL Judge | F.A.Q.</title>
  <link rel="stylesheet" href="../styles/body.css">
  <link rel="stylesheet" href="../styles/grid.css">
</head>

<body>
  <?php require '../components/header.php'; ?>
  <?php require '../components/navbar.php'; ?>

  <div class="row">
    <!-- left column -->
    <div class="leftcolumn">
      <div class="card">
        <h1>Frequently Asked Questions (F.A.Q.)</h1>
        <p>Here are some common questions and answers about SQL Judge.</p>
      </div>

      <div class="card">
        <h2>What is SQL Judge?</h2>
        <p>SQL Judge is a web application that allows users to learn and
          practice SQL queries. It also enables it's users to be able to
          share their thoughts and discuss about different topics through blogs.</p>
      </div>

      <div class="card">
        <h2>Is it free of charge?</h2>
        <p>Yes, it's totally free of charge. You can use it without any
          cost or subscription. Consider logging in for extended features.
        </p>
      </div>

      <div class="card">
        <h2>Is it Open source?</h2>
        <p>Yes, it's totally an open source project and the source code
          can be viewed from the footer's open source button.
        </p>
      </div>
    </div>

    <!-- right column -->
    <div class="rightcolumn">
      <?php include '../components/right_sidebar.php' ?>
    </div>
  </div>

  <?php require '../components/footer.php'; ?>
</body>

</html>