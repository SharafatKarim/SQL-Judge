<?php
session_start();
$_SESSION["page"] = "contests";

require '../lib/db.php';
require '../lib/security.php';

$contest_id = isset($_GET['contest_id']) ? intval($_GET['contest_id']) : 0;
$user_id = isset($_SESSION['id']) ? intval($_SESSION['id']) : 0;

// Fetch contest and check creator
$stmt = $conn->prepare("SELECT * FROM contests WHERE ID = ?");
$stmt->execute([$contest_id]);
$contest = $stmt->fetch();
if (!$contest) {
  echo "<h2>Contest not found.</h2>";
  exit();
}
if (!$user_id || $user_id != $contest['created_by']) {
  echo "<h2>Access denied. Only the contest creator can add problems.</h2>";
  exit();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $title = trim($_POST['title'] ?? '');
  $description = trim($_POST['description'] ?? '');
  $difficulty = $_POST['difficulty'] ?? 'medium';
  $time_limit = intval($_POST['time_limit'] ?? 2);
  $memory_limit = intval($_POST['memory_limit'] ?? 256);
  $test_inputs = $_POST['test_input'] ?? [];
  $test_outputs = $_POST['test_output'] ?? [];
  $test_hidden = $_POST['test_hidden'] ?? [];

  if ($title && $description && count($test_inputs) > 0) {
    $conn->beginTransaction();
    $prob_stmt = $conn->prepare("INSERT INTO problems (contest_id, title, description, difficulty, time_limit, memory_limit) VALUES (?, ?, ?, ?, ?, ?)");
    $prob_stmt->execute([$contest_id, $title, $description, $difficulty, $time_limit, $memory_limit]);
    $problem_id = $conn->lastInsertId();
    $tc_stmt = $conn->prepare("INSERT INTO test_cases (problem_id, input, expected_output, is_hidden) VALUES (?, ?, ?, ?)");
    for ($i = 0; $i < count($test_inputs); $i++) {
      $input = $test_inputs[$i];
      $output = $test_outputs[$i];
      $hidden = isset($test_hidden[$i]) ? 1 : 0;
      $tc_stmt->execute([$problem_id, $input, $output, $hidden]);
    }
    $conn->commit();
    echo "<script>alert('Problem and test cases added successfully!'); window.location.href = 'dashboard.php?id=$contest_id';</script>";
    exit();
  } else {
    echo "<script>alert('Please fill all required fields and at least one test case.');</script>";
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Problem | <?php echo htmlspecialchars($contest['title']); ?></title>
  <link rel="stylesheet" href="../styles/body.css">
  <link rel="stylesheet" href="../styles/grid.css">
  <link rel="stylesheet" href="../styles/blog_editor.css">
  <link rel="stylesheet" href="../styles/mini.css">
  <script>
    function addTestCaseRow() {
      var table = document.getElementById('testcases');
      var row = table.insertRow(-1);
      row.innerHTML = `<td><textarea name="test_input[]" required></textarea></td><td><textarea name="test_output[]" required></textarea></td><td><input type="checkbox" name="test_hidden[]"></td><td><button type="button" onclick="this.parentNode.parentNode.remove();">Remove</button></td>`;
    }
  </script>
</head>

<body>
  <?php require '../components/header.php'; ?>
  <?php require '../components/navbar.php'; ?>
  <div class="row">
    <div class="leftcolumn">
      <center>
        <h2>Add Problem to: <?php echo htmlspecialchars($contest['title']); ?></h2>
      </center>
      <form method="post">
        <label>Title:<br><input type="text" name="title" required></label><br><br>
        <label>Description:<br><textarea name="description" rows="5" required></textarea></label><br><br>
        <label>Difficulty:
          <select name="difficulty">
            <option value="easy">Easy</option>
            <option value="medium" selected>Medium</option>
            <option value="hard">Hard</option>
          </select>
        </label><br><br>
        <label>Time Limit (seconds): <input type="number" name="time_limit" value="2" min="1" max="30"></label><br><br>
        <label>Memory Limit (MB): <input type="number" name="memory_limit" value="256" min="32"
            max="2048"></label><br><br>
        <h3>Test Cases</h3>
        <table border="1" id="testcases">
          <tr>
            <th>Input</th>
            <th>Expected Output</th>
            <th>Hidden?</th>
            <th>Action</th>
          </tr>
          <tr>
            <td><textarea name="test_input[]" required></textarea></td>
            <td><textarea name="test_output[]" required></textarea></td>
            <td><input type="checkbox" name="test_hidden[]"></td>
            <td><button type="button" onclick="this.parentNode.parentNode.remove();">Remove</button></td>
          </tr>
        </table>
        <button type="button" onclick="addTestCaseRow();">Add Test Case</button><br><br>
        <input type="submit" value="Add Problem" class="green-button">
        <a href="dashboard.php?id=<?php echo $contest_id; ?>" class="blue-button">Back to Dashboard</a>
      </form>
    </div>
    <div class="rightcolumn">
      <?php include '../components/right_sidebar.php' ?>
    </div>
  </div>
  <?php require '../components/footer.php'; ?>
  <?php unset($conn); ?>
</body>

</html>