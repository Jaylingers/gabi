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

// Fetch all beneficiaries
$sql = "SELECT * FROM residents"; // Adjust the SQL query based on your actual table structure
$result = $conn->query($sql);

$beneficiaries = [
    
    'Single Parents' => []
];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Only include beneficiaries with a valid type
        if (in_array($row['beneficiaries'], array_keys($beneficiaries))) {
            $beneficiaries[$row['beneficiaries']][] = $row; // Group by beneficiary type
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Beneficiaries</title>
    <link rel="stylesheet" href="../dashboard.css">
     <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="viewgb.css"> <!-- Link to your CSS file -->
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
                <li><a href="../files/index.php" class="nav-link ">Files</a></li>
                <li><a href="../residents/index.php" class="nav-link">Residents</a></li>
                <li><a href="../reports/index.php" class="nav-link">Report</a></li>
                <li><a href="../seminar/index.php" class="nav-link">Seminar</a></li>
                <li><a href="../benefits/index.php" class="nav-link">Government Beneficiaries</a></li>
                <li><a href="../logout.php" class="nav-link logout-btn">Logout</a></li>
            </ul>
        </nav>
    </header>
      <br>
       <nav>
            <ul class="navbar">
                <li><a href="view4ps.php" class="nav-link">4PS</a></li>
                <li><a href="viewsc.php" class="nav-link">Senior Citizen</a></li>
                <li><a href="viewpwd.php" class="nav-link">PWD</a></li>
                <li><a href="viewsp.php" class="nav-link">Single Parent</a></li>
            </ul>
        </nav>

    <div class="content">
        <h2>Beneficiary Types</h2>

        <?php foreach ($beneficiaries as $type => $group): ?>
            <?php if (!empty($group)): // Only display if there are beneficiaries ?>
                <h3><?php echo htmlspecialchars($type); ?></h3>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Full Name</th>
                            <th>Birthday</th>
                            <th>Marital Status</th>
                            <th>Purok</th>
                            <th>Source of Income</th>
                            <th>Renting or Own</th>
                            <th>Light Source</th>
                            <th>Water Source</th>
                            <th>Pets</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($group as $beneficiary): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($beneficiary['id']); ?></td>
                                <td><?php echo htmlspecialchars($beneficiary['last_name'] . ', ' . $beneficiary['first_name'] . ' ' . $beneficiary['extension_name'] . ' ' . $beneficiary['middle_name']); ?></td>
                                <td><?php echo htmlspecialchars(date('F j, Y', strtotime($beneficiary['birthday']))); ?></td>
                                <td><?php echo htmlspecialchars($beneficiary['marital_status']); ?></td>
                                <td><?php echo htmlspecialchars($beneficiary['purok']); ?></td>
                                <td><?php echo htmlspecialchars($beneficiary['source_of_income']); ?></td>
                                <td><?php echo htmlspecialchars($beneficiary['house_ownership']); ?></td>
                                <td><?php echo htmlspecialchars($beneficiary['light_source']); ?></td>
                                <td><?php echo htmlspecialchars($beneficiary['water_source']); ?></td>
                                <td><?php echo htmlspecialchars($beneficiary['pets']); ?></td>
                                
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
</body>
</html>
