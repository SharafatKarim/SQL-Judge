<?php
session_start();
$_SESSION["page"] = "profile";
?>

<?php 
require "get_profile.php"; 
$page_username = $username;
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SQL Judge | Profile</title>
  <link rel="stylesheet" href="../styles/body.css">
  <link rel="stylesheet" href="../styles/grid.css">
  <link rel="stylesheet" href="../styles/table.css">
</head>

<body>
  <?php require '../components/header.php'; ?>

  <?php require '../components/navbar.php'; ?>

  <div class="row">
    <!-- left column -->
    <div class="leftcolumn">
      <div class="card">
        <h2>PROFILE</h2>
        <table>
          <tr>
            <td>Username</td>
            <td><b><?php echo htmlspecialchars($page_username); ?></b></td>
          </tr>
          <tr>
            <td>First Name</td>
            <td><?php echo htmlspecialchars($first_name); ?></td>
          </tr>
          <tr>
            <td>Last Name</td>
            <td><?php echo htmlspecialchars($last_name); ?></td>
          </tr>
          <tr>
            <td>Email</td>
            <td><?php echo htmlspecialchars($email); ?></td>
          </tr>
          <tr>
            <td>Country</td>
            <td><?php echo htmlspecialchars($country); ?></td>
          </tr>
          <tr>
            <td>Address</td>
            <td><?php echo htmlspecialchars($address); ?></td>
          </tr>
          <tr>
            <td>Institution</td>
            <td><?php echo htmlspecialchars($institution); ?></td>
          </tr>
          <tr>
            <td>Role</td>
            <td><?php echo htmlspecialchars($role); ?></td>
          </tr>
          <tr>
            <td>Verified</td>
            <td><?php echo $is_verified ? 'Yes' : 'No'; ?></td>
          </tr>
          <tr>
            <td>Bio</td>
            <td><?php echo $bio; ?></td>
          </tr>
          <tr>
            <td>Gender</td>
            <td><?php echo htmlspecialchars($gender); ?></td>
          </tr>
          <tr>
            <td>Date of Birth</td>
            <td><?php echo htmlspecialchars($date_of_birth); ?></td>
          </tr>
          <tr>
            <td>Phone Number</td>
            <td><?php echo htmlspecialchars($phone_number); ?></td>
          </tr>
          <tr>
            <td>Website</td>
            <td><a href="<?php echo htmlspecialchars($website); ?>"
                target="_blank"><?php echo htmlspecialchars($website); ?></a></td>
          </tr>
          <tr>
            <td>GitHub</td>
            <td><a href="<?php echo htmlspecialchars($github); ?>"
                target="_blank"><?php echo htmlspecialchars($github); ?></a></td>
          </tr>
          <tr>
            <td>Twitter</td>
            <td><a href="<?php echo htmlspecialchars($twitter); ?>"
                target="_blank"><?php echo htmlspecialchars($twitter); ?></a></td>
          </tr>
          <tr>
            <td>LinkedIn</td>
            <td><a href="<?php echo htmlspecialchars($linkedin); ?>"
                target="_blank"><?php echo htmlspecialchars($linkedin); ?></a></td>
          </tr>
          <tr>
            <td>Facebook</td>
            <td><a href="<?php echo htmlspecialchars($facebook); ?>"
                target="_blank"><?php echo htmlspecialchars($facebook); ?></a></td>
          </tr>
          <tr>
            <td>Telegram</td>
            <td><a href="<?php echo htmlspecialchars($telegram); ?>"
                target="_blank"><?php echo htmlspecialchars($telegram); ?></a></td>
          </tr>
          <tr>
            <td>Last Login</td>
            <td><?php echo htmlspecialchars($last_login); ?></td>
          </tr>
          <tr>
            <td>Total Solved</td>
            <td><?php echo htmlspecialchars($total_solved); ?></td>
          </tr>
          <tr>
            <td>Total Submissions</td>
            <td><?php echo htmlspecialchars($total_submissions); ?></td>
          </tr>
          <tr>
            <td>Total Contributions</td>
            <td><?php echo htmlspecialchars($total_contributions); ?></td>
          </tr>
          <tr>
            <td>Created At</td>
            <td><?php echo htmlspecialchars($created_at); ?></td>
          </tr>
        </table>
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