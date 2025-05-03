<?php
require "../lib/db.php";
require "../lib/security.php";

// variables and initialize with empty values
$username = $password = $confirm_password = $email = $first_name = $last_name = $website = $bio = "";
$username_err = $password_err = $confirm_password_err = $email_err = $first_name_err = $last_name_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $username = test_input($_POST["username"]);
  if (empty($username)) {
    $username_err = "Please enter a username.";
  } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', $username)) {
    $username_err = "Username can only contain letters, numbers, and underscores.";
  } else {
    $sql = "SELECT id FROM users WHERE username = :username";
    if ($stmt = $conn->prepare($sql)) {
      $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
      $param_username = $username;
      if ($stmt->execute()) {
        switch ($stmt->rowCount()) {
          case 1:
            $username_err = "This username is already taken.";
            break;
        }
      } else {
        echo "Oops! Something went wrong. Please try again later.";
      }
      unset($stmt);
    }
  }

  $email = test_input($_POST["email"]);
  if (empty($email)) {
    $email_err = "Please enter an email.";
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $email_err = "Invalid email format.";
  }

  $first_name = test_input($_POST["first_name"]);
  if (empty($first_name)) {
    $first_name_err = "Please enter your first name.";
  } elseif (!preg_match("/^[a-zA-Z ]*$/", $first_name)) {
    $first_name_err = "Only letters and white space allowed";
  }

  $last_name = test_input($_POST["last_name"]);
  if (empty($last_name)) {
    $last_name_err = "Please enter your last name.";
  } elseif (!preg_match("/^[a-zA-Z ]*$/", $last_name)) {
    $last_name_err = "Only letters and white space allowed";
  }

  $password = test_input($_POST["password"]);
  if (empty($password)) {
    $password_err = "Please enter a password.";
  } elseif (strlen(trim($_POST["password"])) < 6) {
    $password_err = "Password must have at least 6 characters.";
  } elseif (strlen(trim($_POST["password"])) > 20) {
    $password_err = "Password cannot exceed 20 characters.";
  }

  $confirm_password = test_input($_POST["confirm_password"]);
  if (empty($confirm_password)) {
    $confirm_password_err = "Please confirm password.";
  } elseif ($password != $confirm_password) {
    $confirm_password_err = "Password did not match.";
  }

  $website = test_input($_POST["website"]);
  $bio = test_input($_POST["bio"]);

  if (empty($username_err) && empty($password_err) && empty($confirm_password_err) && empty($email_err) && empty($first_name_err) && empty($last_name_err)) {
    $sql = "INSERT INTO users (username, email, first_name, last_name, password, website, bio) VALUES (:username, :email, :first_name, :last_name, :password, :website, :bio)";

    if ($stmt = $conn->prepare($sql)) {
      $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
      $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);
      $stmt->bindParam(":first_name", $param_first_name, PDO::PARAM_STR);
      $stmt->bindParam(":last_name", $param_last_name, PDO::PARAM_STR);
      $stmt->bindParam(":password", $param_password, PDO::PARAM_STR);
      $stmt->bindParam(":website", $param_website, PDO::PARAM_STR);
      $stmt->bindParam(":bio", $param_bio, PDO::PARAM_STR);

      $param_username = $username;
      $param_email = $email;
      $param_first_name = $first_name;
      $param_last_name = $last_name;
      $param_password = password_hash($password, PASSWORD_DEFAULT);
      $param_website = $website;
      $param_bio = $bio;

      if ($stmt->execute()) {
        header("location: login.php");
      } else {
        echo "Oops! Something went wrong. Please try again later.";
      }
      unset($stmt);
    }
  }

  unset($pdo);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Sign Up</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../styles/body.css">
  <link rel="stylesheet" href="../styles/forms.css">
</head>

<body>
  <?php require '../components/header.php'; ?>
  <?php require '../components/navbar.php'; ?>

  <div class="wrapper">
    <h2>Register</h2>
    <p>
      Please fill this form to create an account,<br>
      and let's embark on a new adventure!
    </p>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

      First Name: <span class="error">* <?php echo $first_name_err; ?></span>
      <input type="text" name="first_name" value="<?php echo $first_name; ?>">
      <br>

      Last Name: <span class="error">* <?php echo $last_name_err; ?></span>
      <input type="text" name="last_name" value="<?php echo $last_name; ?>">
      <br>

      Username: <span class="error">* <?php echo $username_err; ?></span>
      <input type="text" name="username" value="<?php echo $username; ?>">
      <br>

      E-mail: <span class="error">* <?php echo $email_err; ?></span>
      <input type="text" name="email" value="<?php echo $email; ?>">
      <br>

      Password: <span class="error">* <?php echo $password_err; ?></span>
      <input type="password" name="password" value="<?php echo $password; ?>">
      <br>

      Confirm Password: <span class="error">* <?php echo $confirm_password_err; ?></span>
      <input type="password" name="confirm_password" value="<?php echo $password; ?>">
      <br>

      Website:
      <input type="text" name="website" value="<?php echo $website; ?>">
      <br>

      Bio:
      <textarea name="bio" rows="5" cols="40"><?php echo $bio; ?></textarea>

      <p>Already have an account? <a href="login.php">Login here</a>.</p>
      <input type="submit" name="submit" value="Register now">
    </form>

  </div>

  <?php require '../components/footer.php'; ?>
</body>

</html>