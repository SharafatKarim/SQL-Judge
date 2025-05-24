<?php
session_start();
$_SESSION["page"] = "settings";
?>

<?php
function errorRedirectToHome()
{
  header("Location: ./not_found.php");
  exit();
}

if (empty($_REQUEST['username'])) {
  $username = $_SESSION["username"];
} else {
  $username = $_REQUEST["username"];
}

// get the get request information
if (empty($username)) {
  errorRedirectToHome();
  exit();
}

require "../lib/db.php";

$sql = "SELECT * FROM users WHERE username = :username";

if ($stmt = $conn->prepare($sql)) {
  $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
  $param_username = $username;

  if ($stmt->execute() && $stmt->rowCount() > 0 && $row = $stmt->fetch()) {
    // setting variables
    $ID = $row["id"] ?? "";
    $username = $row["username"] ?? "";
    $email = $row["email"] ?? "";
    $first_name = $row["first_name"] ?? "";
    $last_name = $row["last_name"];
    $country = $row["country"] ?? "";
    $address = $row["address"] ?? "";
    $institution = $row["institution"] ?? "";
    $role = $row["role"] ?? "";
    $is_verified = $row["is_verified"] ?? "";
    $profile_picture = $row["profile_picture"] ?? "";
    $bio = $row["bio"] ?? "";
    $gender = $row["gender"] ?? "";
    $date_of_birth = $row["date_of_birth"] ?? "";
    $phone_number = $row["phone_number"] ?? "";
    $website = $row["website"] ?? "";
    $github = $row["github"] ?? "";
    $twitter = $row["twitter"] ?? "";
    $linkedin = $row["linkedin"] ?? "";
    $facebook = $row["facebook"] ?? "";
    $telegram = $row["telegram"] ?? "";
    $last_login = $row["last_login"] ?? "";
    $total_solved = $row["total_solved"] ?? "";
    $total_submissions = $row["total_submissions"] ?? "";
    $total_contributions = $row["total_contributions"] ?? "";
    $created_at = $row["created_at"] ?? "";
  } else {
    echo "⚠️ Invalid username or password.";
    errorRedirectToHome();
  }
} else {
  echo "Oops! Something went wrong. Please try again later.";
  errorRedirectToHome();
}
unset($stmt);
unset($conn);
?>

<?php
require "../lib/db.php";
require "../lib/security.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $first_name = test_input($_POST["first_name"]) ?? '';
  $last_name = test_input($_POST["last_name"] ?? '');
  $email = test_input($_POST["email"] ?? '');
  $country = test_input($_POST["country"] ?? '');
  $address = test_input($_POST["address"] ?? '');
  $institution = test_input($_POST["institution"] ?? '');
  $bio = test_input($_POST["bio"] ?? '');
  $gender = test_input($_POST["gender"] ?? '');
  $date_of_birth = test_input($_POST["date_of_birth"] ?? '');
  $phone_number = test_input($_POST["phone_number"] ?? '');
  $website = test_input($_POST["website"] ?? '');
  $github = test_input($_POST["github"] ?? '');
  $twitter = test_input($_POST["twitter"] ?? '');
  $linkedin = test_input($_POST["linkedin"] ?? '');
  $facebook = test_input($_POST["facebook"] ?? '');
  $telegram = test_input($_POST["telegram"] ?? '');

  if (empty($email)) {
    $error = "Please enter an email.";
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error = "Invalid email format.";
  }

  if (empty($first_name)) {
    $error = "Please enter your first name.";
  } elseif (!preg_match("/^[a-zA-Z ]*$/", $first_name)) {
    $error = "Only letters and white space allowed";
  }

  if (empty($last_name)) {
    $error = "Please enter your last name.";
  } elseif (!preg_match("/^[a-zA-Z ]*$/", $last_name)) {
    $error = "Only letters and white space allowed";
  }

  if (empty($date_of_birth)) {
    $error = "Please enter your date of birth.";
  }

  if ($error) {
    echo "<script>alert('$error');</script>";
  } else {


    $sql = "UPDATE users SET 
            first_name = :first_name,
            last_name = :last_name,
            email = :email,
            country = :country,
            address = :address,
            institution = :institution,
            bio = :bio,
            gender = :gender,
            date_of_birth = :date_of_birth,
            phone_number = :phone_number,
            website = :website,
            github = :github,
            twitter = :twitter,
            linkedin = :linkedin,
            facebook = :facebook,
            telegram = :telegram
          WHERE username = :username";

    if ($stmt = $conn->prepare($sql)) {
      $stmt->bindParam(":first_name", $first_name, PDO::PARAM_STR);
      $stmt->bindParam(":last_name", $last_name, PDO::PARAM_STR);
      $stmt->bindParam(":email", $email, PDO::PARAM_STR);
      $stmt->bindParam(":country", $country, PDO::PARAM_STR);
      $stmt->bindParam(":address", $address, PDO::PARAM_STR);
      $stmt->bindParam(":institution", $institution, PDO::PARAM_STR);
      $stmt->bindParam(":bio", $bio, PDO::PARAM_STR);
      $stmt->bindParam(":gender", $gender, PDO::PARAM_STR);
      $stmt->bindParam(":date_of_birth", $date_of_birth, PDO::PARAM_STR);
      $stmt->bindParam(":phone_number", $phone_number, PDO::PARAM_STR);
      $stmt->bindParam(":website", $website, PDO::PARAM_STR);
      $stmt->bindParam(":github", $github, PDO::PARAM_STR);
      $stmt->bindParam(":twitter", $twitter, PDO::PARAM_STR);
      $stmt->bindParam(":linkedin", $linkedin, PDO::PARAM_STR);
      $stmt->bindParam(":facebook", $facebook, PDO::PARAM_STR);
      $stmt->bindParam(":telegram", $telegram, PDO::PARAM_STR);
      $stmt->bindParam(":username", $username, PDO::PARAM_STR);

      if ($stmt->execute()) {
        echo "<script>alert('Success!');</script>";
        echo "<p>Profile updated successfully!</p>";
        header("location: index.php");
      } else {
        echo "<script>alert('Error updating profile. Please try again.');</script>";
      }
      unset($stmt);
      unset($conn);
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SQL Judge | Feedback</title>
  <link rel="stylesheet" href="../styles/body.css">
  <!-- <link rel="stylesheet" href="../styles/forms.css"> -->
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
        <h2>PROFILE SETTINGS</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
          <table>
            <tr>
              <td>First Name</td>
              <td><input type="text" name="first_name" value="<?php echo htmlspecialchars($first_name); ?>"></td>
            </tr>
            <tr>
              <td>Last Name</td>
              <td><input type="text" name="last_name" value="<?php echo htmlspecialchars($last_name); ?>"></td>
            </tr>
            <tr>
              <td>Email</td>
              <td><input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>"></td>
            </tr>
            <tr>
              <td>Country</td>
              <td><input type="text" name="country" value="<?php echo htmlspecialchars($country); ?>"></td>
            </tr>
            <tr>
              <td>Address</td>
              <td><input type="text" name="address" value="<?php echo htmlspecialchars($address); ?>"></td>
            </tr>
            <tr>
              <td>Institution</td>
              <td><input type="text" name="institution" value="<?php echo htmlspecialchars($institution); ?>"></td>
            </tr>
            <tr>
              <td>Bio</td>
              <td><textarea name="bio"><?php echo htmlspecialchars($bio); ?></textarea></td>
            </tr>
            <tr>
              <td>Gender</td>
              <td>
                <select name="gender">
                  <option value="Male" <?php echo $gender === 'Male' ? 'selected' : ''; ?>>Male</option>
                  <option value="Female" <?php echo $gender === 'Female' ? 'selected' : ''; ?>>Female</option>
                  <option value="Other" <?php echo $gender === 'Other' ? 'selected' : ''; ?>>Other</option>
                </select>
              </td>
            </tr>
            <tr>
              <td>Date of Birth</td>
              <td><input type="date" name="date_of_birth" value="<?php echo htmlspecialchars($date_of_birth); ?>"></td>
            </tr>
            <tr>
              <td>Phone Number</td>
              <td><input type="text" name="phone_number" value="<?php echo htmlspecialchars($phone_number); ?>"></td>
            </tr>
            <tr>
              <td>Website</td>
              <td><input type="url" name="website" value="<?php echo htmlspecialchars($website); ?>"></td>
            </tr>
            <tr>
              <td>GitHub</td>
              <td><input type="url" name="github" value="<?php echo htmlspecialchars($github); ?>"></td>
            </tr>
            <tr>
              <td>Twitter</td>
              <td><input type="url" name="twitter" value="<?php echo htmlspecialchars($twitter); ?>"></td>
            </tr>
            <tr>
              <td>LinkedIn</td>
              <td><input type="url" name="linkedin" value="<?php echo htmlspecialchars($linkedin); ?>"></td>
            </tr>
            <tr>
              <td>Facebook</td>
              <td><input type="url" name="facebook" value="<?php echo htmlspecialchars($facebook); ?>"></td>
            </tr>
            <tr>
              <td>Telegram</td>
              <td><input type="url" name="telegram" value="<?php echo htmlspecialchars($telegram); ?>"></td>
            </tr>
            <tr>
              <td colspan="2">
                <button type="submit">Update Profile</button>
              </td>
            </tr>
          </table>
        </form>
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