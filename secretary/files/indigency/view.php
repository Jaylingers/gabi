<?php
// Database connection (replace with your actual connection)
$conn = new mysqli('localhost', 'root', '', 'gabi');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all certificates from the database
$sql = "SELECT * FROM indigency";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Files - Secretary Dashboard</title>
    <link rel="stylesheet" href="../../dashboard.css">
    <link rel="stylesheet" href="../index.css">
     <style>
        /* Add some basic styles for the table */
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
     <header>
        <div class="title">
            <li><a href="dashboard.php" class="nav-link">Secretary</a></li>
        </div>
        <nav>
            <ul class="navbar">
                <li><a href="../../dashboard.php" class="nav-link">Home</a></li>
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
     <h1>List of Certificates</h1>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Purok</th>
                <th>Years Living</th>
                <th>Purpose</th>
                <th>Date Issued</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                // Output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . htmlspecialchars($row['name']) . "</td>
                            <td>" . htmlspecialchars($row['purok']) . "</td>
                            <td>" . htmlspecialchars($row['year_living']) . "</td>
                            <td>" . htmlspecialchars($row['purpose']) . "</td>
                            <td>" . htmlspecialchars($row['date_issued']) . "</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No certificates found</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>
<?php
// Close connection
$conn->close();
?>