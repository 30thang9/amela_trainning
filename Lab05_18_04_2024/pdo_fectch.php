<?php
$host = 'mysql';
$dbname = 'lab5';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Prepared Statement với SELECT
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = :id");
$stmt->execute(['id' => 1]);
$result = $stmt->fetch(PDO::FETCH_ASSOC);
var_dump($result);
// Prepared Statement với Insert hoặc Update
//$stmt = $pdo->prepare("INSERT INTO users (name, phone, email, password) VALUES (:value1, :value2)");
//$stmt->execute(['value1' => 'foo', 'value2' => 'bar']);
