<link rel="stylesheet" href="../styles/mini.css">
<link rel="stylesheet" href="../styles/table.css">

<?php
include '../lib/db.php';
// Fetch top rated users (by total_solved)
$top_rated = [];
$sql_top_rated = "SELECT * FROM top_rated_5";
if ($stmt = $conn->prepare($sql_top_rated)) {
  if ($stmt->execute()) {
    $top_rated = $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
}
// Fetch top contributors (by total_contributions)
$top_contributors = [];
$sql_top_contributors = "SELECT * FROM top_contributors_5";
if ($stmt2 = $conn->prepare($sql_top_contributors)) {
  if ($stmt2->execute()) {
    $top_contributors = $stmt2->fetchAll(PDO::FETCH_ASSOC);
  }
}
?>
<div class="card">
  <h2>Personalization</h2>
  <p>Welcome home, chief! Here's some quick links for you.</p>
  <ul>
    <li><a href="../profile/index.php">My profile</a></li>
    <li><a href="#">My friends</a></li>
    <li><a href="../profile/settings.php">Profile settings</a></li>
    <li><a href="#">My submissions</a></li>
    <li><a href="../auth/logout.php">Log out</a></li>
  </ul>
</div>
<div class="card">
  <h3>Search users</h3>
  <div class="row2">
    <div>
      <input class="row2-text-input" id="searching_ID" type="text" placeholder="Search..">
    </div>
    <div>
      <button type="button" class="row2-button"
      onclick="window.location.href='../profile/index.php?username=' + document.getElementById('searching_ID').value;">Search</button>
    </div>
  </div>
</div>
<div class="card">
  <h3>Notifications</h3>
  <p>You have no new notifications.</p>
</div>
<div class="card">
  <h3>Top rated</h3>
  <table border="1">
    <tr>
      <th>Name</th>
      <th>Total solved</th>
    </tr>
    <?php
    if (!empty($top_rated)) {
      foreach ($top_rated as $user) {
        echo '<tr>';
        echo '<td><a href="../profile/index.php?username=' . urlencode($user['username']) . '">' . htmlspecialchars($user['first_name'] . ' ' . $user['last_name']) . '</a></td>';
        echo '<td>' . intval($user['total_solved']) . '</td>';
        echo '</tr>';
      }
    } else {
      echo '<tr><td colspan="2">No data found.</td></tr>';
    }
    ?>
  </table>
</div>
<div class="card">
  <h3>Top contributors</h3>
  <table border="1">
    <tr>
      <th>Name</th>
      <th>Total contributions</th>
    </tr>
    <?php
    if (!empty($top_contributors)) {
      foreach ($top_contributors as $user) {
        echo '<tr>';
        echo '<td><a href="../profile/index.php?username=' . urlencode($user['username']) . '">' . htmlspecialchars($user['first_name'] . ' ' . $user['last_name']) . '</a></td>';
        echo '<td>' . intval($user['total_contributions']) . '</td>';
        echo '</tr>';
      }
    } else {
      echo '<tr><td colspan="2">No data found.</td></tr>';
    }
    ?>
  </table>
</div>
<?php unset($conn); ?>