<?php
// register.php
session_start();
include 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Utilisation de la classe User
    $userClass->create($email, $password);

    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
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
            <h2>PAGE D'INSCRIPTION</h2>
        </section>

        <div class="register-container">
            <form method="post">
                <input type="pseudo" name="pseudo" placeholder="Pseudo" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Mot de passe" required>
                <button type="submit">S'INSCRIRE</button>
            </form>
        </div>
    </main>
    <footer>
      
        <p>&copy; Quiz Night |  - La Plateforme</p>
      
    </footer>
</body>
</html>