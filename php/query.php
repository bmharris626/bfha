<?php
$servername = "localhost";
$username = "bmharris";
$password = "\$Blackbird54";
$dbname = "bfha";

// Query to database
$sql = sprintf(
  "SELECT DISTINCT lastName, firstName, callNum, title, pageNum
    FROM entries AS a JOIN indx AS b
    ON a.id = b.entryid
    JOIN vols AS c
    ON b.voldid = c.id
    WHERE a.lastName LIKE '%s'
      AND a.firstName LIKE '%s'
      AND collection LIKE '%s'",
    strtoupper($_POST["last_name"]),
    strtoupper($_POST["first_name"]),
    strtoupper($_POST["collection"])
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
} else { $response = "ERROR: Could not connect to Database"; }

$conn->close();

echo json_encode($response);
?>
