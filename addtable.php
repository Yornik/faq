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
$sql0 = "CREATE TABLE QA (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
question VARCHAR(6000) NOT NULL,
answer VARCHAR(6000) NOT NULL,
category VARCHAR(255) NOT NULL,
media    VARCHAR(1000)
)";

$sql1 = "CREATE TABLE Users2 (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
name VARCHAR(600) NOT NULL,
pass VARCHAR(600) NOT NULL,
)";

if ($conn->query($sql0) === TRUE) {
    echo "Table QA created successfully";
} else {
    echo "Error creating table QA: " . $conn->error;
}
if ($conn->query($sql1) === TRUE) {
    echo "Table Users2 created successfully";
} else {
    echo "Error creating table Users2: " . $conn->error;
}
$conn->close();
?>