<?php
// create_quiz.php
session_start();
include 'includes/db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom = $_POST['nom'];
    $description = $_POST['description'];
    $image = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];

    // Déplacer l'image uploadée vers un dossier sur le serveur
    $upload_dir = 'uploads/';
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0755, true);
    }
    move_uploaded_file($image_tmp, $upload_dir . $image);

    // Utilisation de la classe Quiz pour créer un quiz
    $quiz_id = $quizClass->create($nom, $description, $image, $_SESSION['user_id']);

    header("Location: edit_quiz.php?id=$quiz_id");
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Création Quiz</title>
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
        <section class="hero">
            <h2>PAGE DE CREATION</h2>
            <p>Page Administrateur</p>
        </section>

        <div class="quiz-list">
            <div class="quiz-card">
                <form method="post" enctype="multipart/form-data">
                    <input type="text" name="nom" placeholder="Nom du quiz" required>
                    <textarea name="description" placeholder="Description du quiz" required></textarea>
                    <input type="file" name="image" accept="image/*" required>
                    <button type="submit">Créer</button>
                </form>
            </div>
        </div>
    </main>
    <footer>
      
        <p>&copy; Quiz Night | - La Plateforme</p>
      
    </footer>
</body>
</html>