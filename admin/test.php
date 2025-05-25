<?php
echo "Test start<br>";

ini_set('display_errors', 1);
error_reporting(E_ALL);

include(__DIR__ . '/../config.php');

echo "After include<br>";

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "Connected successfully!";
}
?>
