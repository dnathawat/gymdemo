<?php
$servername = "127.0.0.1";
$username = "root";
$dbname = "gymdemo";
$password = "";

try {
	$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
	$conn->setAttribute(PDO::ATTR_ERRMODE, pdo::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
	echo "Connection Failed" . $e->getMessage();
}

