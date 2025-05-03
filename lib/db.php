<?php
$env = parse_ini_file(__DIR__ . "/../.env");

$servername = $env['DB_SERVER_HOST'];
$server_username = $env['DB_USERNAME'];
$server_password = $env['DB_PASSWORD'];
$dbname = $env['DB_DATABASE_NAME'];

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $server_username, $server_password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  die("ERROR: Could not connect. " . $e->getMessage());
}
?>