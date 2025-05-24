<?php
session_start();
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
  $isLoggedIn = true;
  $username = $_SESSION["username"];
  $userId = $_SESSION["id"];
} else {
  $isLoggedIn = false;
}
?>

<link rel="stylesheet" href="../styles/header.css">

<body>
  <div class="header">
    <h1><a class="header-text" href="../"><img src="../assets/logo.svg" height="36px" alt="SQL Judge">SQL Judge</a></h1>
    <div class="nav-link">

    <?php 
     if ($isLoggedIn) {
       echo '<a class="header-button" href="../profile/index.php">Profile ('. $username .')</a>';
       echo '<a class="header-button" href="../auth/logout.php">Log Out</a>';
     } else {
      echo '<a class="header-button" href="../auth/login.php">Login</a>';
      echo '<a class="header-button" href="../auth/register.php">Register</a>';
     }
    ?>
    </div>
  </div>
</body>