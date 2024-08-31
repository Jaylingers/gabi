<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Capture the posted data
    $name = htmlspecialchars($_POST['name']);
    $purok = htmlspecialchars($_POST['purok']);
    $year_living = htmlspecialchars($_POST['year_living']);
    $purpose = htmlspecialchars($_POST['purpose']);
    $date_issued = htmlspecialchars($_POST['date_issued']);

    // Database connection (replace with your actual connection)
    $conn = new mysqli('localhost', 'root', '', 'gabi');

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO indigency (name, purok, year_living, purpose, date_issued) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $name, $purok, $year_living, $purpose, $date_issued);

    // Execute the statement
    if ($stmt->execute()) {
        // Redirect to view.php after successful insertion
        header('Location: view.php');
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close connections
    $stmt->close();
    $conn->close();
}
?>
