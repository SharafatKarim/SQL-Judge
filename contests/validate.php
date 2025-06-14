<?php
session_start();
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
    echo "<script>alert('Access denied. Only the contest creator can validate answers.');</script>";
    header("Location: ../no_access.php");
    exit();
}

// Handle marking a submission as accepted
if (isset($_POST['accept_submission_id'])) {
    $submission_id = intval($_POST['accept_submission_id']);
    // Fetch submission info
    $sub_stmt = $conn->prepare("SELECT * FROM submissions WHERE ID = ?");
    $sub_stmt->execute([$submission_id]);
    $submission = $sub_stmt->fetch();
    if ($submission) {
        // Mark as accepted
        $conn->prepare("UPDATE submissions SET status = 'accepted' WHERE ID = ?")->execute([$submission_id]);
        // Insert into user_scores if not already present
        $score_stmt = $conn->prepare("SELECT 1 FROM user_scores WHERE user_id = ? AND contest_id = ? AND problem_id = ?");
        $score_stmt->execute([$submission['user_id'], $contest_id, $submission['problem_id']]);
        if (!$score_stmt->fetch()) {
            $conn->prepare("INSERT INTO user_scores (user_id, contest_id, problem_id) VALUES (?, ?, ?)")
                ->execute([$submission['user_id'], $contest_id, $submission['problem_id']]);
        }
        echo "<script>alert('Submission marked as accepted and user score updated.'); window.location.href = 'validate.php?contest_id=$contest_id';</script>";
        exit();
    }
}

// Fetch all problems in this contest
$problems = $conn->prepare("SELECT * FROM problems WHERE contest_id = ?");
$problems->execute([$contest_id]);
$problems = $problems->fetchAll();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validate Submissions | <?php echo htmlspecialchars($contest['title']); ?></title>
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
            <h2>Validate Submissions for: <?php echo htmlspecialchars($contest['title']); ?></h2>
            <a href="dashboard.php?id=<?php echo $contest_id; ?>" class="blue-button">Back to Dashboard</a>
        </div>
        <?php foreach ($problems as $problem): ?>
            <div class="card">
                <h3>Problem: <?php echo htmlspecialchars($problem['title']); ?></h3>
                <?php
                $subs = $conn->prepare("SELECT s.*, u.username FROM submissions s JOIN users u ON s.user_id = u.ID WHERE s.problem_id = ? ORDER BY s.submitted_at DESC");
                $subs->execute([$problem['ID']]);
                ?>
                <?php if ($subs->rowCount() > 0): ?>
                    <table border="1" style="width:100%">
                        <tr><th>User</th><th>Code</th><th>Status</th><th>Submitted At</th><th>Action</th></tr>
                        <?php foreach ($subs as $sub): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($sub['username']); ?></td>
                                <td><pre><?php echo htmlspecialchars($sub['code']); ?></pre></td>
                                <td><?php echo htmlspecialchars($sub['status']); ?></td>
                                <td><?php echo htmlspecialchars($sub['submitted_at']); ?></td>
                                <td>
                                    <?php if ($sub['status'] !== 'accepted'): ?>
                                        <form method="post" style="display:inline;">
                                            <input type="hidden" name="accept_submission_id" value="<?php echo $sub['ID']; ?>">
                                            <input type="submit" value="Accept" class="green-button">
                                        </form>
                                    <?php else: ?>
                                        Accepted
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                <?php else: ?>
                    <p>No submissions for this problem yet.</p>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="rightcolumn">
        <?php include '../components/right_sidebar.php' ?>
    </div>
</div>
<?php require '../components/footer.php'; ?>
<?php unset($conn); ?>
</body>
</html>
