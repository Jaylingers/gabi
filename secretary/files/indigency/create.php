<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gabi";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Insert resident data if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $purok = $_POST['purok'];
    $year_living = $_POST['year_living'];
    $purpose = $_POST['purpose'];
    $date_issued = $_POST['date_issued'];

    $sql = "INSERT INTO indigency (name, purok, year_living, purpose, date_issued) VALUES ('$name', '$purok', '$year_living', '$purpose', '$date_issued')";

    if ($conn->query($sql) === TRUE) {
        // Redirect to generate.php with the ID of the newly inserted record
        $last_id = $conn->insert_id;
        header("Location: generate.php");
        exit();
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
    <title>Files - Secretary Dashboard</title>
    <link rel="stylesheet" href="../../dashboard.css">
    <link rel="stylesheet" href="../../../assets/css/files/index.css">
    <link rel="stylesheet" href="create.css">
    <script src="create.js"></script>
</head>
<body>
     <header>
        <div class="title">
            <li><a href="dashboard.php" class="nav-link">Secretary</a></li>
        </div>
        <nav>
            <ul class="navbar">
                <li><a href="../../home/index.php" class="nav-link">Home</a></li>
                <li><a href="index.php" class="nav-link">Files</a></li>
                <li><a href="../../residents/index.php" class="nav-link">Residents</a></li>
                <li><a href="../../reports/index.php" class="nav-link">Report</a></li>
                <li><a href="../../seminar/index.php" class="nav-link">Seminar</a></li>
                <li><a href="../../benefits/index.php" class="nav-link">Government Beneficiaries</a></li>
                 <li><a href="../../index.php" class="nav-link">Barangay Info</a></li>
                <li><a href="../logout.php" class="nav-link logout-btn">Logout</a></li>
            </ul>
            </ul>
        </nav>
    </header>
    <div class="container">
    <h1>Certificate of Indigency</h1>
    <form id="indigencyForm" method="POST" onsubmit="return validateForm()">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="purok">Purok:</label>
        <input type="text" id="purok" name="purok" required>

        <label for="year_living">Years Living:</label>
        <input type="number" id="year_living" name="year_living" required>

        <label for="purpose">Purpose:</label>
        <input type="text" id="purpose" name="purpose" required>

        <label for="date_issued">Date Issued:</label>
        <input type="date" id="date_issued" name="date_issued" required>

        <input type="submit" value="Generate Certificate">
    </form>
</div>
   
</body>
</html>
