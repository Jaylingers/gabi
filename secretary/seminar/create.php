<?php
$servername = "localhost";
$username = "root"; // Change this if you have a different username
$password = ""; // Change this if you have a different password
$dbname = "gabi"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Insert seminar into database
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $seminar_name = $_POST['seminar_name'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $location = $_POST['location'];

    $sql = "INSERT INTO seminars (seminar_name, date, time, location) VALUES ('$seminar_name', '$date', '$time', '$location')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>window.onload = function() { alert('Seminar Created Successfully!'); }</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Residents - Secretary Dashboard</title>
    <link rel="stylesheet" href="../dashboard.css">
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <header>
        <div class="title">
            <h1>Secretary</h1>
        </div>
        <nav>
            <ul class="navbar">
                <li><a href="../home/index.php" class="nav-link">Home</a></li>
                <li><a href="../files/index.php" class="nav-link">Files</a></li>
                <li><a href="../residents/index.php" class="nav-link">Residents</a></li>
                <li><a href="../reports/index.php" class="nav-link">Report</a></li>
                <li><a href="../seminar/index.php" class="nav-link">Seminar</a></li>
                <li><a href="../benefits/index.php" class="nav-link">Government Beneficiaries</a></li>
                <li><a href="../logout.php" class="nav-link logout-btn">Logout</a></li>
            </ul>
        </nav>
    </header>
    <div class="form-wrapper">
        <form method="POST" action="">
            <h2>Create Seminar</h2>
            <label for="seminar_name">Seminar Name:</label>
            <input type="text" id="seminar_name" name="seminar_name" required>

            <label for="date">Date:</label>
            <input type="date" id="date" name="date" required>

            <label for="time">Time:</label>
            <input type="time" id="time" name="time" required>

            <label for="location">Location:</label>
            <input type="text" id="location" name="location" required>

            <input type="submit" value="Create Seminar">
        </form>
    </div>
  
</body>
</html>
