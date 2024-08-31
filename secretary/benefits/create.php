<?php
// Database connection
$host = 'localhost';
$db_name = 'gabi';
$username = 'root';
$password = '';

$conn = new mysqli($host, $username, $password, $db_name);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $assistance_name = $_POST['assistance_name'];
    $date = $_POST['date'];
    $location = $_POST['location'];

    // Insert the new assistance into the database
    $sql = "INSERT INTO assistance (assistance_name, date, location) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $assistance_name, $date, $location);
    $stmt->execute();
    $assistance_id = $stmt->insert_id; // Get the ID of the newly created assistance
    $stmt->close();

    // Redirect to the resident selection page with the assistance ID
    header("Location: select.php?assistance_id=$assistance_id");
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Government Assistance</title>
     <link rel="stylesheet" href="../dashboard.css">
     <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="create.css"> <!-- Link to your CSS file -->
    <script src="../script.js" defer></script> <!-- Link to your JavaScript file -->
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
            <label for="assistance_name">Assistance Name:</label>
            <input type="text" id="assistance_name" name="assistance_name" required><br>

            <label for="date">Date:</label>
            <input type="date" id="date" name="date" required><br>

            <label for="location">Location:</label>
            <input type="text" id="location" name="location" required><br>

            <input type="submit" value="Create Assistance">
        </form>
    </div>
</body>
</html>
