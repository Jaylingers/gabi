<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Announcements and Gym Schedule</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <!-- Header with Navigation Bar -->
    <div class="header">
        <ul>
            <li><a href="viewing.php">Home</a></li>
            <li><a href="officials.php">Barangay Officials and Staff</a></li>
            <li><a href="history.php">Barangay History</a></li>
            <li><a href="contact.php">Contact Us</a></li>
        </ul>
    </div>

    <!-- Main Content Area -->
    <div class="container">
        <!-- Left Sidebar for Emergency Contacts -->
        <div class="left-sidebar">
            <h2>Emergency Contacts</h2>
            <ul>
                <li>Cordova Police:</li>
                <li>Lapu-Lapu City Police:</li>
                <li>Mandaue City Police:</li>
                <li>Cebu City Police:</li>
                <br>
                <li>Lapu-Lapu City Fire Department:</li>
                <li>Mandaue City Fire Department:</li>
                <li>Cordova Fire Department:</li>
                <li>Cebu City Fire Department:</li>
                <br>
                <li>Cordova MDRRMO:</li>
                <li>Lapu-Lapu City DRRMO:</li>
                <li>Mandaue City DRRMO:</li>
                <li>Cebu City DRRMo:</li>
                <br>
                <li>ERUF:</li>
                <li>Red Cross</li>
                <li>SWAT:</li>
                <li>:</li>


            </ul>
        </div>

        <!-- Center Content for Viewing Announcements -->
        <div class="main-content">
            <h1>Announcements</h1>
            <div id="announcement-list">
                <?php
                // Database connection
                $conn = new mysqli('localhost', 'root', '', 'gabi');

                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Fetch and display announcements
                $result = $conn->query("SELECT * FROM announcements ORDER BY created_at DESC");
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='schedule-item'>";
                    echo "<span><strong>" . $row['title'] . "</strong>: " . $row['body'] . "</span>";
                    echo "</div>";
                }

                // Close the connection
                $conn->close();
                ?>
            </div>
        </div>

       <!-- Right Sidebar for Gym Schedule -->
<div class="right-sidebar">
    <h2>View Gym Schedule</h2>
    <div id="schedule-list">
        <?php
        // Database connection for gym schedule
        $conn = new mysqli('localhost', 'root', '', 'gabi');

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Fetch and display gym schedules
        $result = $conn->query("SELECT * FROM gym_schedule ORDER BY date, time");
        while ($row = $result->fetch_assoc()) {
            echo "<div class='schedule-item'>"; 
       
            echo "<strong>Date:</strong> " . date('F d, Y', strtotime($row['date'])) . "<br>";
     
            echo "<strong>Time:</strong> " . date('h:i A', strtotime($row['time'])) . "<br>";
    
            echo "<strong>Who:</strong> " . $row['who'] . "<br>";
     
            echo "<strong>Hours:</strong> " . $row['hours'] . "<br>";
       
            echo "</div><hr>"; // Add a horizontal line for separation
        }

        // Close the connection
        $conn->close();
        ?>
    </div>
</div>
    </div>
<br>
</body>
</html>
