<?php
require "../lib/db.php";
require "../lib/security.php";

// Initialize variables
$username = $password = "";
$username_err = $password_err = $login_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $username = test_input($_POST["username"]);
  if (empty($username)) {
    $username_err = "Please enter a username.";
  }

  $password = test_input($_POST["password"]);
  if (empty($password)) {
    $password_err = "Please enter your password.";
  }

  if (empty($username_err) && empty($password_err)) {
    $sql = "SELECT id, username, password FROM users WHERE username = :username";

    if ($stmt = $conn->prepare($sql)) {
      $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
      $param_username = $username;

      if ($stmt->execute()) {
        if ($stmt->rowCount() == 1) {
          if ($row = $stmt->fetch()) {
            $id = $row["id"];
            $username = $row["username"];
            $hashed_password = $row["password"];
            if (password_verify($password, $hashed_password)) {
              session_start();
              $_SESSION["loggedin"] = true;
              $_SESSION["id"] = $id;
              $_SESSION["username"] = $username;
              header("location: welcome.php");
            } else {
              $login_err = "Invalid username or password.";
            }
          }
        } else {
          $login_err = "⚠️ Invalid username or password.";
        }
      } else {
        echo "Oops! Something went wrong. Please try again later.";
      }
      unset($stmt);
    }
  }
  unset($conn);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../styles/body.css">
  <link rel="stylesheet" href="../styles/forms.css">
  <style>
    .wrapper {
      height: 65vh;
      justify-content: center;
      display: flex;
      flex-direction: column;
    }

    form {
      width: 35%;
    }

    @media (max-width: 780px) {
      form {
        width: 80%;
      }
    }

    @media (max-width: 480px) {
      form {
        width: 95%;
      }
    }
  </style>
</head>

<body>
  <?php require '../components/header.php'; ?>
  <?php require '../components/navbar.php'; ?>

  <div class="wrapper">
    <h2>Login</h2>
    <p>Please fill in your credentials to login.</p>


    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
      <?php
      if (!empty($login_err)) {
        echo '<p><div class="error">' . $login_err . '</div></p>';
      }
      ?>

      Username: <span class="error">* <?php echo $username_err; ?></span>
      <input type="text" name="username" value="<?php echo $username; ?>">
      <br>

      Password: <span class="error">* <?php echo $password_err; ?></span>
      <input type="password" name="password">
      <br>

      <p>Don't have an account? <a href="register.php">Sign up now</a>.</p>
      <input type="submit" name="submit" value="Login">
    </form>
  </div>
  <?php require '../components/footer.php'; ?>
</body>

</html>