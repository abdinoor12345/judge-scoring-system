<?php
include(__DIR__ . '/../config.php');

if (!isset($conn)) {
    die('No database connection ($conn is undefined).');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Add Judge</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }

        .navbar {
            background-color: #007bff;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: white;
            border-radius: 0;
        }

        .navbar .nav-brand {
            font-size: 20px;
            font-weight: bold;
        }

        .navbar .nav-links a {
            color: white;
            text-decoration: none;
            margin-left: 20px;
            font-size: 16px;
        }

        .navbar .nav-links a:hover {
            text-decoration: underline;
        }

        h2 {
            text-align: center;
            margin-top: 30px;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            max-width: 400px;
            margin: 30px auto;
            box-shadow: 0 0 10px rgba(0,0,0,0.05);
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            background-color: #007BFF;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
        }

        button:hover {
            background-color: #0056b3;
        }

        p {
            text-align: center;
            color: green;
            font-weight: bold;
        }

        p.error {
            color: red;
        }
    </style>
</head>
<body>

<nav class="navbar">
    <div class="nav-brand">Admin Panel</div>
    <div class="nav-links">
        <a href="../index.php">Home</a>
        <a href="add_judge.php">Add Judge</a>
        <a href="judge_portal.php">Judge Portal</a>
        <a href="public_scoreboard.php">Scoreboard</a>
    </div>
</nav>

<h2>Add Judge</h2>

<form method="POST" action="">
    <label>Username:</label>
    <input type="text" name="username" required />
    
    <label>Display Name:</label>
    <input type="text" name="display_name" required />

    <button type="submit">Add Judge</button>
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $display_name = trim($_POST['display_name']);

    $stmt = $conn->prepare("INSERT INTO judges (username, display_name) VALUES (?, ?)");
    if ($stmt === false) {
        echo "<p class='error'>Prepare failed: " . htmlspecialchars($conn->error) . "</p>";
        exit;
    }

    $stmt->bind_param("ss", $username, $display_name);

    if ($stmt->execute()) {
        echo "<p>Judge added successfully.</p>";
    } else {
        echo "<p class='error'>Error: " . htmlspecialchars($stmt->error) . "</p>";
    }

    $stmt->close();
    $conn->close();
}
?>

</body>
</html>
