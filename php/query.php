<?php

$lastName = htmlspecialchars(
  strtoupper($_POST['last_name'])
);
$firstName = htmlspecialchars(
  strtoupper($_POST['first_name'])
);
$type = htmlspecialchars($_POST['type']);

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = $sql_base . $sql_where . $sql_limit;

$result = $conn->query($sql);

$response = array();

if ($result->num_rows > 0) {
  // save query results to array
  while($row = $result->fetch_assoc()) {
    switch ($type) {
      case 'lastName':
        $response[] = $row["lastName"];
        break;
      case 'firstName':
        $response[] = $row["firstName"];
        break;
    }
  }
} else {
  $response[] = "(No Matching Results)";
}

?>
