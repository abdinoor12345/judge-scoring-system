<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
include(__DIR__ . '/../config.php');

// Fetch users and their total points
$sql = "
    SELECT users.name, COALESCE(SUM(scores.points), 0) AS total_points
    FROM users
    LEFT JOIN scores ON users.id = scores.user_id
    GROUP BY users.id
    ORDER BY total_points DESC
";
$result = $conn->query($sql);
$users = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Public Scoreboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="refresh" content="10"> <!-- Auto-refresh every 10 seconds -->

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        .navbar {
            background-color: #007bff;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: white;
        }

        .navbar .nav-brand {
            font-size: 20px;
            font-weight: bold;
        }

        .navbar .nav-links a {
            color: white;
            text-decoration: none;
            margin-left: 20px;
        }

        .scoreboard {
            max-width: 700px;
            margin: 40px auto;
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 0 10px #ccc;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 16px;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr.highlight {
            background-color: #d4edda !important; /* Light green for top scorer */
        }

        .note {
            text-align: center;
            color: #777;
            margin-top: 15px;
        }

        @media screen and (max-width: 600px) {
            .navbar {
                flex-direction: column;
                text-align: center;
            }

            .navbar .nav-links {
                margin-top: 10px;
            }

            table, thead, tbody, th, td, tr {
                display: block;
            }

            th, td {
                padding: 10px;
                text-align: right;
                border-bottom: 1px solid #ddd;
            }

            th::before, td::before {
                float: left;
                font-weight: bold;
            }

            td:nth-child(1)::before { content: "Rank"; }
            td:nth-child(2)::before { content: "Participant"; }
            td:nth-child(3)::before { content: "Points"; }
        }
    </style>
</head>
<body>

<nav class="navbar">
    <div class="nav-brand">Live Scoreboard</div>
    <div class="nav-links">
        <a href="../index.php">Home</a>
        <a href="../admin/judge_portal.php">Judge Portal</a>
    </div>
</nav>

<div class="scoreboard">
    <h2>Top Participants</h2>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Participant</th>
                <th>Total Points</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $index => $user): ?>
                <?php
                    $rank = $index + 1;
                    $medal = '';
                    if ($rank == 1) $medal = '🥇';
                    elseif ($rank == 2) $medal = '🥈';
                    elseif ($rank == 3) $medal = '🥉';
                ?>
                <tr class="<?= $rank == 1 ? 'highlight' : '' ?>">
                    <td><?= $rank ?></td>
                    <td><?= htmlspecialchars($user['name']) ?> <?= $medal ?></td>
                    <td><?= (int)$user['total_points'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <p class="note">Auto-refreshes every 10 seconds to reflect latest scores.</p>
</div>
<script>
    // Countdown Timer Logic
    let countdown = 10;
    const note = document.querySelector('.note');
    const timerEl = document.createElement('span');
    const timestampEl = document.createElement('div');

    note.innerHTML = '';
    note.appendChild(timerEl);
    note.appendChild(timestampEl);

    function updateCountdown() {
        timerEl.textContent = `Refreshing in ${countdown} second${countdown !== 1 ? 's' : ''}...`;
        countdown--;
        if (countdown < 0) {
            location.reload();
        }
    }

    function updateTimestamp() {
        const now = new Date();
        timestampEl.textContent = `Last updated at: ${now.toLocaleTimeString()}`;
        timestampEl.style.color = '#555';
        timestampEl.style.fontSize = '0.9em';
    }

    updateCountdown();
    updateTimestamp();
    setInterval(updateCountdown, 1000);
</script>

</body>
</html>
