<?php
session_start();
$_SESSION["page"] = "about";
?>

<?php
require "../lib/db.php";
require "../lib/security.php";

// define variables and set to empty values
$nameErr = $emailErr = $websiteErr = $feedbackErr = "";
$name = $email = $feedback = $website = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  } else {
    $name = test_input($_POST["name"]);
    $nameErr = "";
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
      $nameErr = "Only letters and white space allowed";
    }
  }

  if (empty($_POST["email"])) {
    $email = "";
  } else {
    $email = test_input($_POST["email"]);
    $emailErr = "";
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
    }
  }

  if (empty($_POST["website"])) {
    $website = "";
  } else {
    $website = test_input($_POST["website"]);
    // check if URL address syntax is valid (this regular expression also allows dashes in the URL)
    if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $website)) {
      $websiteErr = "Invalid URL";
    }
  }

  if (empty($_POST["feedback"])) {
    $feedbackErr = "Feedback is required";
  } else {
    $feedback = test_input($_POST["feedback"]);
    $feedbackErr = "";
  }

  if (empty($nameErr) && empty($emailErr) && empty($websiteErr) && empty($feedbackErr)) {
    $sql = "INSERT INTO feedback (name, email, website, feedback) VALUES (:name, :email, :website, :feedback)";

    if ($stmt = $conn->prepare($sql)) {
      $stmt->bindParam(":name", $param_name, PDO::PARAM_STR);
      $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);
      $stmt->bindParam(":website", $param_website, PDO::PARAM_STR);
      $stmt->bindParam(":feedback", $param_feedback, PDO::PARAM_STR);

      $param_name = $name;
      $param_email = $email;
      $param_website = $website;
      $param_feedback = $feedback;

      if ($stmt->execute()) {
        echo "<p>Thank you for your feedback!</p>";
        header("location: ../auth/welcome.php");
      } else {
        echo "<p>Oops! Something went wrong. Please try again later.</p>";
      }
      unset($stmt);
    }
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/x-icon" href="../assets/favicon.ico">
  <title>SQL Judge | Feedback</title>
  <link rel="stylesheet" href="../styles/body.css">
  <link rel="stylesheet" href="../styles/forms.css">
</head>

<body>
  <?php require '../components/header.php'; ?>
  <?php require '../components/navbar.php'; ?>

  <div class="wrapper">
    <h2>User feedback</h2>
    <p>Use the following form to submit your feedback to us!<br>
      Having an account is not required to submit feedback.<br>
      <span class="error">* refers to the required field.</span>
    </p>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
      Name: <span class="error">* <?php echo $nameErr; ?></span>
      <input type="text" name="name" value="<?php echo $name; ?>">
      <br><br>

      E-mail: <span class="error"><?php echo $emailErr; ?></span>
      <input type="text" name="email" value="<?php echo $email; ?>">
      <br><br>

      Website: <span class="error"><?php echo $websiteErr; ?></span>
      <input type="text" name="website" value="<?php echo $website; ?>">
      <br><br>

      Feedback: <span class="error">* <?php echo $feedbackErr; ?></span>
      <textarea name="feedback" rows="5" cols="40"><?php echo $feedback; ?></textarea>
      <br><br>
      <input type="submit" name="submit" value="Submit">
    </form>
  </div>

  <?php require '../components/footer.php'; ?>
</body>

</html>