<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Judge Scoring System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Judge Scoring System for managing judges and scoring users.">
    <meta name="keywords" content="judge, scoring, system, users, scores">
    <meta name="author" content="Your Name">
    
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background: #f8f9fa;
        }
        header, footer {
            background: #007bff;
            color: white;
            padding: 20px;
            text-align: center;
        }
        main {
            padding: 30px;
            text-align: center;
        }
        .nav-links a {
            display: inline-block;
            margin: 15px;
            padding: 15px 25px;
            background: white;
            border-radius: 8px;
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
            box-shadow: 0 0 5px rgba(0,0,0,0.1);
            transition: 0.3s;
        }
        .nav-links a:hover {
            background: #e9f0fc;
        }

        .info-section {
            max-width: 800px;
            margin: 40px auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px #ccc;
            text-align: left;
        }

        .info-section h3 {
            color: #333;
            margin-bottom: 15px;
        }

        .info-section ul {
            list-style: none;
            padding-left: 0;
        }

        .info-section ul li {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

    <header>
        <h1>Welcome to the Judge Scoring System</h1>
        <p>Select a section to proceed:</p>
    </header>

    <main>
        <div class="nav-links">
            <a href="admin/add_judge.php"><i class="fas fa-user-plus"></i> Admin Panel (Add Judge)</a>
            <a href="admin/judge_portal.php"><i class="fas fa-clipboard-check"></i> Judge Portal (Score Users)</a>
            <a href="admin/public_scoreboard.php"><i class="fas fa-trophy"></i> Public Scoreboard</a>
        </div>

        <div class="info-section">
            <h3>About This System</h3>
            <p>This platform allows judges to score participants during competitions. Admins can manage judges, and everyone can view the live scoreboard.</p>

            <h3>How It Works</h3>
            <ul>
                <li><strong>Admin:</strong> Adds and manages judges.</li>
                <li><strong>Judges:</strong> View participant list and submit scores.</li>
                <li><strong>Public:</strong> View real-time scoreboard to see top performers.</li>
            </ul>

            <h3>Why Use It?</h3>
            <ul>
                <li>Simple and user-friendly interface</li>
                <li>Transparent and fair scoring</li>
                <li>Live score updates</li>
            </ul>
        </div>
    </main>

    <footer>
        <p>&copy; <?= date("Y") ?> Judge Scoring System</p>
    </footer>

    <script src="script.js"></script>
</body>
</html>
