**** 
 🏆 Live Scoring System (LAMP Stack)
****

A simple web-based scoring system that allows judges to assign points to participants and displays a live scoreboard to the public.

**📦 Features
**
Admin Panel: Add new judges (username + display name).

Judge Portal: Judges can assign points to registered participants.

Public Scoreboard: Displays all participants ranked by total points, auto-refreshes every 10 seconds with JS countdown.

Responsive Design: Mobile-friendly layout.

Built on LAMP: Linux, Apache, MySQL, PHP.

# 📁 Folder Structure
 Dashboard-scoring
|
|-index.php
|-style.css(for index.php)
|-config.php
|-/admin/|add_judge.php  (# Admin adds judges)/judge_portal.php (# Judges assign points)/public_scoreboard.php(users can see all partcipants ranked by total points)
|--sql/schema.sql(# DB schema and sample data)
|--README.md

## 🚀 Setup Instructions
Install LAMP stack
Use XAMPP, WAMP, or Docker.

### Create a database

`CREATE DATABASE scoring_system;
USE scoring_system;
`
#### Import schema
`mysql -u root -p scoring_system < sql/schema.sql
`
### Configure DB credentials

In config.php, update your DB credentials:

` $conn = new mysqli("localhost", "root", "", "scoring_system");
`
#### Run the app
Open index.php in your browser via http://localhost/scoring-system/index.php

**🗂️ Database Schema
**
```~~~~
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL
);

CREATE TABLE judges (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    display_name VARCHAR(100) NOT NULL
);

CREATE TABLE scores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    judge_id INT NOT NULL,
    points INT NOT NULL CHECK (points BETWEEN 0 AND 100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (judge_id) REFERENCES judges(id)
);





```
**🧪 Sample Data
**
```python
INSERT INTO users (name) VALUES
('Alice'), ('Bob'), ('Charlie');

INSERT INTO judges (username, display_name) VALUES
('judge1', 'Judge Judy'),
('judge2', 'Judge Dredd');

INSERT INTO scores (user_id, judge_id, points) VALUES
(1, 1, 75),
(2, 1, 90),
(3, 2, 85);

```


### ⚙️ Design Notes
No login/authentication implemented (not required for this task).

Secure prepared statements used to prevent SQL injection.

Internal CSS used for simplicity; external stylesheet possible.

JS Enhancements:

Live countdown to next refresh

Timestamp for last update

## 📝 Assumptions
Judges and users are manually added or pre-registered.

One judge can assign multiple scores to the same user (could be refined).

No duplicate username allowed for judges.

## 🌟 Future Improvements (if more time)
Add login system for judges/admins.

Prevent duplicate scoring or allow score updating.

AJAX-based real-time updates (without page reload).

Export reports or charts of scores.

Mobile-first redesign with external CSS/JS.

 




### ScreenShots of system interface

1 Landing page ![image](https://res.cloudinary.com/dwz971dvw/image/upload/v1748169683/landing_image_lwbkt9.jpg)

2 Judge-portal![Portal](https://res.cloudinary.com/dwz971dvw/image/upload/v1748169830/judges_aicvz1.jpg)

 3Adminportal(ADDING-JUDGES)-![Portal](https://res.cloudinary.com/dwz971dvw/image/upload/v1748169755/admin-judge_aqjbab.jpg)

 4 Public-Scoreboard-![Portal](https://res.cloudinary.com/dwz971dvw/image/upload/v1748169723/scoreboard_u16vk5.jpg)