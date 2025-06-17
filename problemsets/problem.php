<?php
session_start();
require '../lib/db.php';
require '../lib/security.php';

$problem_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch problem and contest, ensure contest is over
$stmt = $conn->prepare("SELECT p.*, c.title AS contest_title, c.end_time, c.ID AS contest_id FROM problems p JOIN contests c ON p.contest_id = c.ID WHERE p.ID = ?");
$stmt->execute([$problem_id]);
$problem = $stmt->fetch();
if (!$problem) {
    echo "<h2>Problem not found.</h2>";
    exit();
}
$now = date('Y-m-d H:i:s');
if ($problem['end_time'] > $now) {
    echo "<h2>This problem is not available yet. Only problems from previous contests are shown here.</h2>";
    exit();
}

// Fetch test cases
$test_cases = $conn->prepare("SELECT * FROM test_cases WHERE problem_id = ?");
$test_cases->execute([$problem_id]);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/x-icon" href="../assets/favicon.ico">
    <title>Problem | <?php echo htmlspecialchars($problem['title']); ?></title>
    <link rel="stylesheet" href="../styles/body.css">
    <link rel="stylesheet" href="../styles/grid.css">
    <link rel="stylesheet" href="../styles/mini.css">
</head>
<body>
<?php require '../components/header.php'; ?>
<?php require '../components/navbar.php'; ?>
<div class="row">
    <div class="leftcolumn">
        <div class="card">
            <h2><?php echo htmlspecialchars($problem['title']); ?></h2>
            <h5>Contest: <?php echo htmlspecialchars($problem['contest_title']); ?> | Difficulty: <?php echo htmlspecialchars($problem['difficulty']); ?></h5>
            <p><?php echo nl2br(htmlspecialchars($problem['description'])); ?></p>
            <p>Time Limit: <?php echo htmlspecialchars($problem['time_limit']); ?>s | Memory Limit: <?php echo htmlspecialchars($problem['memory_limit']); ?>MB</p>
        </div>
        <div class="card">
            <h3>Test Cases</h3>
            <table border="1" style="width:100%">
                <tr><th>Sample Input</th><th>Expected Output</th><th>Hidden?</th></tr>
                <?php foreach ($test_cases as $tc): ?>
                    <tr>
                        <td><pre><?php echo htmlspecialchars($tc['input']); ?></pre></td>
                        <td><pre><?php echo htmlspecialchars($tc['expected_output']); ?></pre></td>
                        <td><?php echo $tc['is_hidden'] ? 'Yes' : 'No'; ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
    <div class="rightcolumn">
        <?php include '../components/right_sidebar.php' ?>
    </div>
</div>
<?php require '../components/footer.php'; ?>
<?php unset($conn); ?>
</body>
</html>
