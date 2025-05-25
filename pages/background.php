<?php
session_start();
$_SESSION["page"] = "about";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SQL Judge | Background</title>
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
        <h2>HISTORY</h2>
        <hr>
        <p>
          This is the story behind MySQL. When I started learning it at first,
          it felt way too difficult as I didn't go through any proper tutorial.
          Of course, I could read books, but which may take a lot of time.
          Instead I simply started writing queries to solve some problems,
          and the more I solve, the more I got used to the syntax and the logic behind it.
        </p>
        <p>
          So I thought maybe, anyone who is familliar with any programming language,
          can learn SQL without much effort.
          Perhaps some basic knowledge and a short note?
          <br>
          This is the idea behind SQL Judge. Here, you can learn SQL from some basic concepts,
          without going through any large book or tutorial. You can practice SQL queries
          and get instant feedback on your queries as well.
        </p>
      </div>

      <div class="card">
        <h2>RESOURCES</h2>
        <hr>
        <table>
          <thead>
            <tr>
              <th>CONTENT</th>
              <th>URL</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><img src="../assets/logo.svg" alt="SQL Judge Logo" width="60"></td>
              <td><a href="../assets/logo.svg" target="_blank">SQL Judge Logo</a></td>
            </tr>
            <tr>
              <td>Learning materials</td>
              <td><a href="https://www.db-book.com/slides-dir/index.html"
                  target="_blank">https://www.db-book.com/slides-dir/index.html</a></td>
            </tr>
            <tr>
              <td>Cheatsheet</td>
              <td><a href="https://sharafat.gitbook.io/home/docs/my-sql"
                  target="_blank">https://sharafat.gitbook.io/home/docs/my-sql</a></td>
            </tr>
          </tbody>
        </table>
      </div>

      <div class="card">
        <?php include '../components/newsletter.php' ?>
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