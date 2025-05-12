<link rel="stylesheet" href="../styles/navbar.css">

<body>
  <nav class="navbar">
    <button class="menu-toggle" onclick="toggleMenu()">☰ Main menu</button>
    <div class="nav-list" id="nav-list">
      <?php
      if ($_SESSION["page"] == "home") {
        echo '<div class="nav-item active">';
      } else {
        echo '<div class="nav-item">';
      }
      ?>
        <a href="../">Home</a>
      </div>

      <?php
      if ($_SESSION["page"] == "blog") {
        echo '<div class="nav-item active">';
      } else {
        echo '<div class="nav-item">';
      }
      ?>
        <a href="../blog/index.php">Blog</a>
      </div>

      <?php
      if ($_SESSION["page"] == "learn") {
        echo '<div class="nav-item active">';
      } else {
        echo '<div class="nav-item">';
      }
      ?>
        <a href="../learn/php">Learn</a>
      </div>
      
      <?php
      if ($_SESSION["page"] == "cheatsheet") {
        echo '<div class="nav-item active">';
      } else {
        echo '<div class="nav-item">';
      }
      ?>
        <a href="../cheatsheet/index.php">Cheat Sheet</a>
      </div>

      <?php
      if ($_SESSION["page"] == "problemsets") {
        echo '<div class="nav-item active">';
      } else {
        echo '<div class="nav-item">';
      }
      ?>
        <a href="../problemsets/index.php">Problemsets</a>
      </div>

      <?php
      if ($_SESSION["page"] == "contests") {
        echo '<div class="nav-item active">';
      } else {
        echo '<div class="nav-item">';
      }
      ?>
        <a href="../contests/index.php">Contests</a>
      </div>

      <?php
      if ($_SESSION["page"] == "leaderboard") {
        echo '<div class="nav-item active">';
      } else {
        echo '<div class="nav-item">';
      }
      ?>
        <a href="../leaderboard/index.php">Leaderboard</a>
      </div>

      <?php
      if ($_SESSION["page"] == "profile") {
        echo '<div class="nav-item active">';
      } else {
        echo '<div class="nav-item">';
      }
      ?>
        <a href="../profile/index.php">Profile</a>
      </div>

      <?php
      if ($_SESSION["page"] == "settings") {
        echo '<div class="nav-item active">';
      } else {
        echo '<div class="nav-item">';
      }
      ?>
        <a href="../profile/settings.php">Settings</a>
      </div>

    </div>
  </nav>
  <script>
    function toggleMenu() {
      const navList = document.getElementById('nav-list');
      navList.style.display = navList.style.display === 'block' ? 'none' : 'block';
    }
  </script>
</body>