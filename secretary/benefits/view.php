<?php
// Include database connection
$host = 'localhost';
$db_name = 'gabi';
$username = 'root';
$password = '';

$conn = new mysqli($host, $username, $password, $db_name);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


// Functionality to approve, disapprove, or delete a resident
if (isset($_POST['action'])) {
    $assistance_id = intval($_POST['assistance_id']);

    if ($_POST['action'] == 'approve_all') {
        $update_query = "UPDATE assistance_residents SET status = 'Approved' WHERE assistance_id = $assistance_id";
    } elseif ($_POST['action'] == 'disapprove_all') {
        $update_query = "UPDATE assistance_residents SET status = 'Disapproved' WHERE assistance_id = $assistance_id";
    } elseif ($_POST['action'] == 'delete') {
        $resident_id = intval($_POST['resident_id']);
        $delete_query = "DELETE FROM assistance_residents WHERE assistance_id = $assistance_id AND resident_id = $resident_id";
        $conn->query($delete_query);
        header("Location: view.php");
        exit;
    }

    $conn->query($update_query);
}

// Fetch all government assistance
$assistance_query = "SELECT * FROM assistance";
$assistance_result = $conn->query($assistance_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Government Assistance List</title>
    <link rel="stylesheet" href="../dashboard.css">
     <link rel="stylesheet" href="index.css">
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
    <div class="content">
        <h2>Government Assistance List</h2>

        <?php while ($assistance = $assistance_result->fetch_assoc()) : ?>
            <div class="assistance-block">
                <h3><?php echo htmlspecialchars($assistance['assistance_name']); ?></h3>
                <p>Date: <?php echo htmlspecialchars($assistance['date']); ?></p>
                <p>Location: <?php echo htmlspecialchars($assistance['location']); ?></p>

                <h4>Selected Residents:</h4>
                <table>
                    <tr>
                        <th>Last Name</th>
                        <th>First Name</th>
                        <th>Middle Name</th>
                        <th>Purok</th>
                        <th>Source of Income</th>
                        <th>Beneficiaries Type</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    <?php
                    // Fetch selected residents for the current assistance
                    $residents_query = "
                        SELECT r.*, ar.status 
                        FROM assistance_residents ar
                        JOIN residents r ON ar.resident_id = r.id
                        WHERE ar.assistance_id = " . intval($assistance['id']);
                    $residents_result = $conn->query($residents_query);

                    while ($resident = $residents_result->fetch_assoc()) :
                    ?>
                        <tr>
                            <td><?php echo htmlspecialchars($resident['last_name']); ?></td>
                            <td><?php echo htmlspecialchars($resident['first_name']); ?></td>
                            <td><?php echo htmlspecialchars($resident['middle_name']); ?></td>
                            <td><?php echo htmlspecialchars($resident['purok']); ?></td>
                            <td><?php echo htmlspecialchars($resident['source_of_income']); ?></td>
                            <td><?php echo htmlspecialchars($resident['beneficiaries']); ?></td>
                            <td><?php echo htmlspecialchars($resident['status']); ?></td>
                            <td>
                                <form method="post" style="display:inline-block;">
                                    <input type="hidden" name="resident_id" value="<?php echo $resident['id']; ?>">
                                    <input type="hidden" name="assistance_id" value="<?php echo $assistance['id']; ?>">
                                    <button type="submit" name="action" value="delete">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </table>
                <!-- Approve/Disapprove all residents in the current assistance -->
                <form method="post" style="margin-top: 10px;">
                    <input type="hidden" name="assistance_id" value="<?php echo $assistance['id']; ?>">
                    <button type="submit" name="action" value="approve_all">Approve All</button>
                    <button type="submit" name="action" value="disapprove_all">Disapprove All</button>
                </form>
            </div>
            <hr>
        <?php endwhile; ?>
    </div>
</body>
</html>
