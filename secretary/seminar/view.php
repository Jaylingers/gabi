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

// Fetch seminars from the database
$sql = "SELECT * FROM seminars";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Seminars</title>
     <link rel="stylesheet" href="../dashboard.css">
    <link rel="stylesheet" href="view.css">
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
        <h2>All Seminars</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Seminar Name</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Location</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    // Output data for each row
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["id"] . "</td>";
                        echo "<td>" . $row["seminar_name"] . "</td>";
                        echo "<td>" . $row["date"] . "</td>";
                        echo "<td>" . $row["time"] . "</td>";
                        echo "<td>" . $row["location"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No seminars found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
$conn->close();
?>
