<?php
// play_quiz.php
session_start();
include 'includes/db.php';

$quiz_id = $_GET['id'];
$questions = $questionsClass->getByQuizId($quiz_id);

if (!isset($_SESSION['current_question_index'])) {
    $_SESSION['current_question_index'] = 0;
    $_SESSION['score'] = 0; // Initialiser le score
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $question_id = $_POST['question_id'];
    $answer_id = $_POST['answer_id'];

    $selected_answer = $reponsesClass->getCorrectAnswer($question_id);

    if ($selected_answer && $selected_answer['id'] == $answer_id) {
        $message = "<p class='correct-answer'>Bonne réponse !</p>";
        $_SESSION['score']++; // Incrémenter le score en cas de bonne réponse
    } else {
        $correct_answer = $reponsesClass->getCorrectAnswer($question_id);
        $message = "<p class='incorrect-answer'>Mauvaise réponse ! La bonne réponse était : {$correct_answer['description']}</p>";
    }

    $_SESSION['current_question_index']++;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jouer au Quiz</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header>
        <div class="logo">
            <img src="images/logo.png" alt="Logo Quiz Night">
        </div>
        <div>
            <h1>QUIZ NIGHT</h1>
            <p>Testez vos connaissances</p>
        </div>
        <div class="header-content">
            <div class="auth-buttons">
                <button onclick="window.location.href='index.php'">Retour</button>
            </div>
        </div>
    </header>
    <main>
        <section class="quiz-play">
            <?php if (isset($message)) echo $message; ?>

            <?php if ($_SESSION['current_question_index'] >= count($questions)): ?>
                <div class="quiz-completed">
                    <p>Vous avez terminé le quiz !</p>
                    <p>Votre score est de <?php echo $_SESSION['score']; ?> sur <?php echo count($questions); ?></p>
                    <a href="index.php"><button>Retour à l'accueil</button></a>
                    <?php unset($_SESSION['current_question_index']); ?>
                    <?php unset($_SESSION['score']); ?>
                </div>
            <?php else: ?>
                <?php $current_question = $questions[$_SESSION['current_question_index']]; ?>
                <div class="question-container">
                    <h3><?php echo htmlspecialchars($current_question['description']); ?></h3>
                    <form method="post">
                        <input type="hidden" name="question_id" value="<?php echo $current_question['id']; ?>">
                        <?php $answers = $reponsesClass->getByQuestionId($current_question['id']); ?>
                        <?php foreach ($answers as $answer): ?>
                            <button type="submit" name="answer_id" value="<?php echo $answer['id']; ?>" class="answer-button">
                                <?php echo htmlspecialchars($answer['description']); ?>
                            </button>
                        <?php endforeach; ?>
                    </form>
                </div>
            <?php endif; ?>
        </section>
    </main>
    <footer>
        <p>&copy; Quiz Night | - La Plateforme</p>
    </footer>
</body>
</html>