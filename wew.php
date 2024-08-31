<?php
$servername = "localhost";
$username = "root";  // Change this to your database username
$password = "";      // Change this to your database password
$dbname = "gabi";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully<br>";
} else {
    echo "Error creating database: " . $conn->error . "<br>";
}

// Select the database
$conn->select_db($dbname);

// Create table
$sql = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(20) NOT NULL
)";
if ($conn->query($sql) === TRUE) {
    echo "Table users created successfully<br>";
} else {
    echo "Error creating table: " . $conn->error . "<br>";
}

// Users data
$passwords = [
    'captain' => 'bosnic',
    'secretary' => 'tagsip',
    'treasurer' => 'pepito',
    'pio' => 'barangay',
    'councilor' => 'konsehal'
];

// Insert users
foreach ($passwords as $role => $password) {
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    $sql = "INSERT INTO users (username, password, role) VALUES ('$role', '$hashedPassword', '$role')";
    if ($conn->query($sql) === TRUE) {
        echo "User $role inserted successfully<br>";
    } else {
        echo "Error inserting user $role: " . $conn->error . "<br>";
    }
}

$conn->close();
?>
