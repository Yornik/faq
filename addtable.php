<?php
$servername = "localhost";
$username = "faqapp";
$password = "bmS7GXQPLaJrFvxgZMBM8TvJQXAN9dknK2R3RU4DSmYALT84sTz6aqsHqvJQS6efRVAFYs";
$dbname = "faqapp";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// sql to create table
$sql = "CREATE TABLE Users2 (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
name VARCHAR(255) NOT NULL,
pass VARCHAR(255) NOT NULL,
)";

if ($conn->query($sql) === TRUE) {
    echo "Table Users created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();
?>