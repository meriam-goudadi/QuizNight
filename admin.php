<?php
// admin.php
session_start();
include 'includes/db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_quiz'])) {
    $quiz_id = $_POST['quiz_id'];

    // Utilisation de la classe Quiz pour supprimer le quiz
    $quizClass->delete($quiz_id);

    // Rediriger vers la page admin
    header('Location: admin.php');
    exit();
}

// Récupérer tous les quiz avec la classe Quiz
$quizzes = $quizClass->getAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Administrateur</title>
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
                <a href="index.php"><button>Déconnexion</button></a>
            </div>
        </div>
    </header>
    <main>
        <section class="hero">
            <h2>PAGE ADMIN</h2>
            <p>Créer, Modifier ou Supprimer un Quiz</p>
        </section>

        <!-- Bouton "Créer un nouveau quiz" placé ici -->
        <div class="create-quiz-container">
            <a href="create_quiz.php" class="create-quiz-button">Créer un nouveau quiz</a>
        </div>

        <!-- Liste des quiz -->
        <div class="quiz-list">
            <?php foreach ($quizzes as $quiz): ?>
                <div class="quiz-card">
                    <h2><?php echo htmlspecialchars($quiz['nom']); ?></h2>
                    <p><?php echo htmlspecialchars($quiz['description']); ?></p>
                    <a href="edit_quiz.php?id=<?php echo $quiz['id']; ?>" class="edit-button">Modifier</a>
                    <form method="post" class="delete-form">
                        <input type="hidden" name="quiz_id" value="<?php echo $quiz['id']; ?>">
                        <button type="submit" name="delete_quiz" class="delete-button">Supprimer</button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
    </main>
    <footer>
        <p>&copy; Quiz Night | - La Plateforme</p>
    </footer>
</body>
</html>