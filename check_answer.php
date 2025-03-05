<?php
// check_answer.php
session_start();
include 'includes/db.php';

$data = json_decode(file_get_contents('php://input'), true);
$questionId = $data['questionId'];
$answerId = $data['answerId'];

// Utilisation de la classe Reponses pour vérifier la réponse
$answer = $reponsesClass->getCorrectAnswer($questionId);

// Vérifier si la réponse sélectionnée est correcte
$isCorrect = ($answer && $answer['id'] == $answerId);

echo json_encode(['correct' => $isCorrect]);
?>