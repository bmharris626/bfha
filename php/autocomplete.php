<?php
$servername = "localhost";
$username = "bmharris";
$password = "\$Blackbird54";
$dbname = "bfha";

$sql = sprintf(
  "SELECT DISTINCT %s FROM entries WHERE (firstName LIKE '%s') AND (lastName LIKE '%s') LIMIT 5;",
  $_POST["column"], strtoupper($_POST["first_name"]), strtoupper($_POST["last_name"])
);

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$result = $conn->query($sql);
$response = array();

if ($result->num_rows > 0) {
  // save query results to array
  while( $row = $result->fetch_assoc()) {$response[] = $row[$_POST["column"]]; }
} else { $response[] = "(No Matching Results)"; }

$conn->close();

echo json_encode($response);
?>
