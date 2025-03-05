<?php
// index.php
session_start();
include 'includes/db.php';

$quizzes = $quizClass->getAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Night - La Plateforme</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header>
        <div class="logo">
            <img src="images/logo.png" alt="Logo Quiz Night">
        </div>
        <div>
          <h1>QUIZ NIGHT</h1>
          <p>LA PLATEFORME</p>
        </div>
        <div class="header-content">
          <div class="auth-buttons">
              <a href="register.php"><button>S'inscrire</button></a>
              <a href="login.php"><button>Se connecter</button></a>
          </div>
        </div>
    </header>

    <main>
        <section class="hero">
            <h2>ENVIE DE TESTER TES CONNAISSANCES ?</h2>
            <h1>CHOISIS UN QUIZ</h1>
        </section>

        <section class="quiz-list">
            <?php foreach ($quizzes as $quiz): ?>
                <div class="quiz-card">
                    <div class="quiz-image">
                        <img src="images/<?php echo $quiz['image']; ?>" alt="<?php echo $quiz['nom']; ?>">
                    </div>
                    <h2><?php echo $quiz['nom']; ?></h2>
                    <p><?php echo $quiz['description']; ?></p>
                    <a href="play_quiz.php?id=<?php echo $quiz['id']; ?>">Jouer</a>
                </div>
            <?php endforeach; ?>
        </section>
    </main>
    <footer>
      
        <p>&copy; Quiz Night | - La Plateforme</p>
      
    </footer>
</body>
</html>