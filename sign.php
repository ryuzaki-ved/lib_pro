<?php

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "lib_project";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Using prepared statements to prevent SQL injection
// Since 'year' is treated as a string, the prepared statement placeholders remain the same
$stmt = $conn->prepare("INSERT INTO user_pass (username, year, password) VALUES (?, ?, ?)");

// 'username', 'password', and 'year' are all treated as strings in your table
$username = $_POST['username'];
$year = $_POST['year'];
$hashed_password = password_hash($_POST['password'], PASSWORD_DEFAULT);


// Bind parameters and execute
$stmt->bind_param("sss", $username, $hashed_password, $year); // 'sss' denotes all parameters are strings
$stmt->execute();

echo "New record created successfully";

$stmt->close();
$conn->close();
?>
