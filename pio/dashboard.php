<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PIO Admin Panel</title>
    <style>
        /* CSS Styles */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f2f5;
            display: flex;
            flex-direction: column;
        }

        .header {
            background-color: #4CAF50;
            color: white;
            padding: 15px 20px;
            display: flex;
            justify-content: flex-end;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .header ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: flex;
        }

        .header ul li {
            margin-left: 20px;
        }

        .header ul li a {
            color: white;
            text-decoration: none;
            padding: 10px 15px;
            display: block;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .header ul li a:hover {
            background-color: #45a049;
        }

        .container {
            display: flex;
            margin: 20px;
            flex: 1;
        }

        .left-sidebar, .right-sidebar {
            width: 20%;
            padding: 15px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .main-content {
            width: 60%;
            padding: 15px;
            background-color: #fff;
            margin: 0 10px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .main-content h1, .right-sidebar h2, .left-sidebar h2 {
            margin-top: 0;
            color: #333;
        }

        #announcement-form input, #announcement-form textarea, #gym-schedule-form input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        #announcement-form button, #gym-schedule-form button {
            padding: 10px 15px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        #announcement-form button:hover, #gym-schedule-form button:hover {
            background-color: #45a049;
        }

        .schedule-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            margin-bottom: 10px;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .schedule-item button {
            background-color: #f44336;
            margin-left: 10px;
        }

        .schedule-item button:hover {
            background-color: #d32f2f;
        }

        .update-button {
            background-color: #008CBA;
        }

        .update-button:hover {
            background-color: #007B9E;
        }
    </style>
</head>
<body>
    <!-- Header with Navigation Bar -->
    <div class="header">
        <ul>
            <li><a href="home.php">Home</a></li>
            <li><a href="officials.php">Barangay Officials and Staff</a></li>
            <li><a href="history.php">Barangay History</a></li>
            <li><a href="contact.php">Contact Us</a></li>
            <li><a href="logout.php" class="nav-link logout-btn">Logout</a></li>
        </ul>
    </div>

    <!-- Main Content Area -->
    <div class="container">
        <!-- Left Sidebar for Emergency Contacts -->
        <div class="left-sidebar">
            <h2>Emergency Contacts</h2>
            <ul>
                <li>Police: 123-456</li>
                <li>Fire Department: 789-012</li>
                <li>Hospital: 345-678</li>
            </ul>
        </div>

        <!-- Center Content for Announcement Creation -->
        <div class="main-content">
            <h1>Create Announcement</h1>
            <form id="announcement-form" method="POST" action="">
                <label for="announcement-title">Title:</label>
                <input type="text" id="announcement-title" name="title" required>

                <label for="announcement-body">Body:</label>
                <textarea id="announcement-body" name="body" required></textarea>

                <button type="submit">Post Announcement</button>
            </form>

            <h2>Announcements</h2>
            <div id="announcement-list">
                <?php
                // Database connection
                $conn = new mysqli('localhost', 'root', '', 'gabi');

                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Handle announcement creation
                if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['title'])) {
                    $title = $conn->real_escape_string($_POST['title']);
                    $body = $conn->real_escape_string($_POST['body']);

                    $sql = "INSERT INTO announcements (title, body) VALUES ('$title', '$body')";
                    $conn->query($sql);
                }

                // Handle announcement deletion
                if (isset($_POST['delete_announcement'])) {
                    $id = intval($_POST['delete_announcement']);
                    $conn->query("DELETE FROM announcements WHERE id=$id");
                }

                // Handle announcement update
                if (isset($_POST['update_announcement'])) {
                    $id = intval($_POST['update_announcement']);
                    $title = $conn->real_escape_string($_POST['title']);
                    $body = $conn->real_escape_string($_POST['body']);

                    $conn->query("UPDATE announcements SET title='$title', body='$body' WHERE id=$id");
                }

                // Fetch and display announcements
                $result = $conn->query("SELECT * FROM announcements ORDER BY created_at DESC");
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='schedule-item'>";
                    echo "<span><strong>" . $row['title'] . "</strong>: " . $row['body'] . "</span>";
                    echo "
                        <form method='POST' style='display:inline;'>
                            <input type='hidden' name='delete_announcement' value='" . $row['id'] . "'>
                            <button type='submit'>Delete</button>
                        </form>
                        <button class='update-button' onclick='populateUpdateForm(" . json_encode($row) . ")'>Update</button>
                    ";
                    echo "</div>";
                }

                $conn->close();
                ?>
            </div>

            <!-- Hidden form for updating announcements -->
            <form id="update-announcement-form" style="display:none;" method="POST">
                <input type="hidden" name="update_announcement" id="update-id">
                <label for="update-title">Title:</label>
                <input type="text" id="update-title" name="title" required>

                <label for="update-body">Body:</label>
                <textarea id="update-body" name="body" required></textarea>

                <button type="submit">Update Announcement</button>
            </form>
        </div>

        <!-- Right Sidebar for Gym Scheduling -->
        <div class="right-sidebar">
            <h2>Update Gym Schedule</h2>
            <form id="gym-schedule-form" method="POST" action="">
                <label for="schedule-date">Date:</label>
                <input type="date" id="schedule-date" name="date" required>

                <label for="schedule-time">Time:</label>
                <input type="time" id="schedule-time" name="time" required>

                <label for="schedule-who">Who:</label>
                <input type="text" id="schedule-who" name="who" required>

                <label for="schedule-hours">Hours:</label>
                <input type="number" id="schedule-hours" name="hours" required>

                <button type="submit">Save Schedule</button>
            </form>

            <h2>Scheduled Gym Events</h2>
            <div id="schedule-list">
                <?php
                // Database connection for gym schedule
                $conn = new mysqli('localhost', 'root', '', 'gabi');

                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Insert gym schedule if the gym schedule form is submitted
                if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['who'])) {
                    $date = $conn->real_escape_string($_POST['date']);
                    $time = $conn->real_escape_string($_POST['time']);
                    $who = $conn->real_escape_string($_POST['who']);
                    $hours = intval($_POST['hours']);

                    $sql = "INSERT INTO gym_schedule (date, time, who, hours) VALUES ('$date', '$time', '$who', $hours)";
                    $conn->query($sql);
                }

                // Handle gym schedule deletion
                if (isset($_POST['delete_schedule'])) {
                    $id = intval($_POST['delete_schedule']);
                    $conn->query("DELETE FROM gym_schedule WHERE id=$id");
                }

                // Handle gym schedule update
                if (isset($_POST['update_schedule'])) {
                    $id = intval($_POST['update_schedule']);
                    $date = $conn->real_escape_string($_POST['date']);
                    $time = $conn->real_escape_string($_POST['time']);
                    $who = $conn->real_escape_string($_POST['who']);
                    $hours = intval($_POST['hours']);

                    $conn->query("UPDATE gym_schedule SET date='$date', time='$time', who='$who', hours=$hours WHERE id=$id");
                }

                // Fetch and display gym schedules
                $result = $conn->query("SELECT * FROM gym_schedule ORDER BY date, time");
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='schedule-item'>";
                    echo "<span><strong>Date:</strong> " . $row['date'] . ", <strong>Time:</strong> " . $row['time'] . ", <strong>Who:</strong> " . $row['who'] . ", <strong>Hours:</strong> " . $row['hours'] . "</span>";
                    echo "
                        <form method='POST' style='display:inline;'>
                            <input type='hidden' name='delete_schedule' value='" . $row['id'] . "'>
                            <button type='submit'>Delete</button>
                        </form>
                        <button class='update-button' onclick='populateUpdateScheduleForm(" . json_encode($row) . ")'>Update</button>
                    ";
                    echo "</div>";
                }

                $conn->close();
                ?>
            </div>

            <!-- Hidden form for updating gym schedules -->
            <form id="update-gym-schedule-form" style="display:none;" method="POST">
                <input type="hidden" name="update_schedule" id="update-schedule-id">
                <label for="update-schedule-date">Date:</label>
                <input type="date" id="update-schedule-date" name="date" required>

                <label for="update-schedule-time">Time:</label>
                <input type="time" id="update-schedule-time" name="time" required>

                <label for="update-schedule-who">Who:</label>
                <input type="text" id="update-schedule-who" name="who" required>

                <label for="update-schedule-hours">Hours:</label>
                <input type="number" id="update-schedule-hours" name="hours" required>

                <button type="submit">Update Schedule</button>
            </form>
        </div>
    </div>

    <script>
        // Populate the update form for announcements
        function populateUpdateForm(announcement) {
            document.getElementById('update-id').value = announcement.id;
            document.getElementById('update-title').value = announcement.title;
            document.getElementById('update-body').value = announcement.body;

            document.getElementById('update-announcement-form').style.display = 'block';
        }

        // Populate the update form for gym schedules
        function populateUpdateScheduleForm(schedule) {
            document.getElementById('update-schedule-id').value = schedule.id;
            document.getElementById('update-schedule-date').value = schedule.date;
            document.getElementById('update-schedule-time').value = schedule.time;
            document.getElementById('update-schedule-who').value = schedule.who;
            document.getElementById('update-schedule-hours').value = schedule.hours;

            document.getElementById('update-gym-schedule-form').style.display = 'block';
        }
    </script>
</body>
</html>
