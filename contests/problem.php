<?php
session_start();
require '../lib/db.php';
require '../lib/security.php';

$problem_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$user_id = isset($_SESSION['id']) ? intval($_SESSION['id']) : 0;

// Fetch problem and contest
$stmt = $conn->prepare("SELECT p.*, c.title AS contest_title, c.created_by, c.ID AS contest_id FROM problems p JOIN contests c ON p.contest_id = c.ID WHERE p.ID = ?");
$stmt->execute([$problem_id]);
$problem = $stmt->fetch();
if (!$problem) {
    echo "<h2>Problem not found.</h2>";
    exit();
}
$contest_id = $problem['contest_id'];
$is_creator = ($user_id && $user_id == $problem['created_by']);

// Check registration
$is_registered = false;
if ($user_id) {
    $reg_stmt = $conn->prepare("SELECT 1 FROM contest_registrations WHERE user_id = ? AND contest_id = ?");
    $reg_stmt->execute([$user_id, $contest_id]);
    $is_registered = $reg_stmt->fetch() ? true : false;
}

// Access control
if (!$is_creator && !$is_registered) {
    header('Location: ./no_access.php');
    exit();
}

// Fetch test cases
$test_cases = $conn->prepare("SELECT * FROM test_cases WHERE problem_id = ?");
$test_cases->execute([$problem_id]);

// Handle code submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['code'])) {
    $code = trim($_POST['code']);
    if ($code) {
        $sub_stmt = $conn->prepare("INSERT INTO submissions (user_id, problem_id, code) VALUES (?, ?, ?)");
        if ($sub_stmt->execute([$user_id, $problem_id, $code])) {
            echo "<script>alert('Submission received!'); window.location.href = 'problem.php?id=$problem_id';</script>";
            exit();
        } else {
            echo "<script>alert('Submission failed. Please try again.');</script>";
        }
    } else {
        echo "<script>alert('Code cannot be empty.');</script>";
    }
}
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
            <?php if ($is_creator): ?>
                <a href="delete_problem.php?id=<?php echo $problem_id; ?>" class="green-button">Delete Problem</a>
            <?php endif; ?>
            <a href="dashboard.php?id=<?php echo $contest_id; ?>" class="blue-button">Back to Dashboard</a>
        </div>
        <div class="card">
            <h3>Test Cases</h3>
            <table border="1" style="width:100%">
                <tr><th>Expected Output</th></tr>
                <?php foreach ($test_cases as $tc): ?>
                    <tr>
                        <td><pre><?php echo htmlspecialchars($tc['expected_output']); ?></pre></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
        <div class="card">
            <h3>Submit Your Code</h3>
            <form method="post">
                <textarea name="code" rows="10" style="width:100%" required placeholder="Write your SQL code here..."></textarea><br><br>
                <input type="submit" value="Submit" class="green-button">
            </form>
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
