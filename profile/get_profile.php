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