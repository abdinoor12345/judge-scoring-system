<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
include(__DIR__ . '/../config.php');

$users_result = $conn->query("SELECT id, name FROM users");
$users = $users_result->fetch_all(MYSQLI_ASSOC);

$feedback = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = (int)$_POST['user_id'];
    $score = (int)$_POST['points'];

    $stmt = $conn->prepare("INSERT INTO scores (user_id, points, created_at) VALUES (?, ?, NOW())");
    $stmt->bind_param("ii", $user_id, $score);
    if ($stmt->execute()) {
        $feedback = "<p class='success'>Score submitted successfully!</p>";
    } else {
        $feedback = "<p class='error'>Error: " . htmlspecialchars($stmt->error) . "</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Judge Portal</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f0f2f5;
            padding: 40px;
        }
        .navbar {
    background-color: #007bff;
    padding: 15px 30px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    color: white;
    border-radius: 10px;
    margin-bottom: 20px;
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

        .container {
            background: #fff;
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px #ccc;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        label {
            display: block;
            margin-top: 20px;
            font-weight: bold;
        }

        select, input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-top: 8px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        button {
            margin-top: 25px;
            width: 100%;
            padding: 12px;
            background-color: #007bff;
            border: none;
            color: #fff;
            font-size: 16px;
            border-radius: 6px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        .success {
            color: green;
            text-align: center;
        }

        .error {
            color: red;
            text-align: center;
        }

        .user-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        .user-table th, .user-table td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }

        .user-table th {
            background-color: #007bff;
            color: white;
        }

        .user-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>
<nav class="navbar">
    <div class="nav-brand">Event Judge Portal</div>
    <div class="nav-links">
        <a href="../index.php">Home</a>
        <a href="../admin/judge_portal.php">Submit Score</a>
        <a href="../admin/public_scoreboard.php">Scoreboard</a>
    </div>
</nav>

    <div class="container">

        <h2>Registered Participants</h2>
        <table class="user-table">
            <tr>
                <th>ID</th>
                <th>Name</th>
            </tr>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= $user['id'] ?></td>
                    <td><?= htmlspecialchars($user['name']) ?></td>
                </tr>
            <?php endforeach; ?>
        </table>

        <h2>Submit Score</h2>
        <?= $feedback ?>
        <form method="POST">
            <label>User:</label>
            <select name="user_id" required>
                <option value="">Select a participant</option>
                <?php foreach ($users as $user): ?>
                    <option value="<?= $user['id'] ?>"><?= htmlspecialchars($user['name']) ?></option>
                <?php endforeach; ?>
            </select>

            <label>Score (1-100):</label>
            <input type="number" name="points" min="1" max="100" required>

            <button type="submit">Submit Score</button>
        </form>
    </div>
</body>
</html>
