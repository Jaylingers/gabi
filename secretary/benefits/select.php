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

$assistance_id = $_GET['assistance_id'];

// Handle resident selection
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['resident_id'])) {
    $resident_id = $_POST['resident_id'];

    // Check if resident is already added to the assistance
    $check_sql = "SELECT * FROM assistance_residents WHERE assistance_id = ? AND resident_id = ?";
    $stmt = $conn->prepare($check_sql);
    $stmt->bind_param("ii", $assistance_id, $resident_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        // Insert the resident into the assistance
        $sql = "INSERT INTO assistance_residents (assistance_id, resident_id) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $assistance_id, $resident_id);
        $stmt->execute();
    }
    $stmt->close();
}

// Search residents
$residents = [];
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['search'])) {
    $search = $_GET['search'];
    $sql = "SELECT * FROM residents WHERE last_name LIKE ? OR first_name LIKE ?";
    $stmt = $conn->prepare($sql);
    $like_search = "%" . $search . "%";
    $stmt->bind_param("ss", $like_search, $like_search);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $residents[] = $row;
    }
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Residents for Assistance</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
  

    <div class="content">
        <h2>Search Residents</h2>
        <form method="GET" action="">
            <input type="hidden" name="assistance_id" value="<?php echo htmlspecialchars($assistance_id); ?>">
            <input type="text" name="search" placeholder="Enter name or category" required>
            <input type="submit" value="Search">
        </form>

        <?php if (!empty($residents)): ?>
            <h3>Resident Search Results</h3>
            <form method="POST" action="">
                <input type="hidden" name="assistance_id" value="<?php echo htmlspecialchars($assistance_id); ?>">
                <table>
                    <thead>
                        <tr>
                            <th>Select</th>
                            <th>Full Name</th>
                            <th>Birthday</th>
                            <th>Marital Status</th>
                            <th>Purok</th>
                            <th>Source of Income</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($residents as $resident): ?>
                            <tr>
                                <td>
                                    <input type="checkbox" name="resident_id" value="<?php echo htmlspecialchars($resident['id']); ?>">
                                </td>
                                <td><?php echo htmlspecialchars($resident['last_name'] . ', ' . $resident['first_name'] . ' ' . $resident['extension_name'] . ' ' . $resident['middle_name']); ?></td>
                                <td><?php echo htmlspecialchars(date('F j, Y', strtotime($resident['birthday']))); ?></td>
                                <td><?php echo htmlspecialchars($resident['marital_status']); ?></td>
                                <td><?php echo htmlspecialchars($resident['purok']); ?></td>
                                <td><?php echo htmlspecialchars($resident['source_of_income']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <input type="submit" value="Add Selected Residents">
            </form>
        <?php endif; ?>
    </div>
</body>
</html>
