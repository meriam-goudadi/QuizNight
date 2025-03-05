<?php
// includes/db.php
$host = '127.0.0.1:3306';
$db   = 'quiznight';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

// Initialisation des classes
require_once 'User.php';
require_once 'Quiz.php';
require_once 'Questions.php';
require_once 'Reponses.php';

$userClass = new User($pdo);
$quizClass = new Quiz($pdo);
$questionsClass = new Questions($pdo);
$reponsesClass = new Reponses($pdo);
?>