<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = $conn->prepare('SELECT * FROM users WHERE username = ?');
    $query->bind_param('s', $username);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];
            header("Location: " . $user['role'] . "/dashboard.php");
            exit;
        } else {
            $error = 'Invalid username or password';
        }
    } else {
        $error = 'Invalid username or password';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: lightsteelblue;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            width: 400px;
            max-width: 100%;
            text-align: center;
            padding: 20px;
        }
        .images {
            display: flex;
            justify-content: space-around;
            margin-bottom: 20px;
        }
        .images img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
        }
        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        form input {
            margin: 10px 0;
            padding: 10px;
            width: 80%;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        form button {
            padding: 10px 20px;
            color: white;
            background-color: whitesmoke;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        form button:hover {
            background-color: #0056b3;
        }
    </style>
    <script>
        function showError(message) {
            alert(message);
        }
    </script>
</head>
<body>
    <div class="container">
        <div class="images">
            <img src="cebu.png" alt="Image 1">
            <img src="cordova.png" alt="Image 2">
            <img src="gabi.png" alt="Image 3">
            
        </div>
        <form method="post" action="">
            <?php if (isset($error)): ?>
                <script>showError('<?php echo $error; ?>');</script>
            <?php endif; ?>
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
