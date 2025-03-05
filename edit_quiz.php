<?php
// edit_quiz.php
session_start();
include 'includes/db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$quiz_id = $_GET['id'];

// Instanciation des classes
$quizClass = new Quiz($pdo);
$questionsClass = new Questions($pdo);
$reponsesClass = new Reponses($pdo); // Assurez-vous que cette ligne est présente

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add_question'])) {
        $question = $_POST['question'];
        // Utilisation de la classe Questions
        $questionsClass->create($question, $quiz_id);
    } elseif (isset($_POST['add_answer'])) {
        $answer = $_POST['answer'];
        $question_id = $_POST['question_id'];
        // Utilisation de la classe Reponses
        $reponsesClass->create($answer, $question_id);
    } elseif (isset($_POST['update_quiz'])) {
        $nom = $_POST['nom'];
        $description = $_POST['description'];
        $image = $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];

        // Si une nouvelle image est uploadée
        if ($image) {
            $upload_dir = 'image/';
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0755, true);
            }
            move_uploaded_file($image_tmp, $upload_dir . $image);

            // Utilisation de la classe Quiz pour mettre à jour le quiz
            $quizClass->update($quiz_id, $nom, $description, $image);
        } else {
            // Utilisation de la classe Quiz pour mettre à jour le quiz sans image
            $quizClass->update($quiz_id, $nom, $description);
        }
    } elseif (isset($_POST['update_question'])) {
        $question_id = $_POST['question_id'];
        $new_question = $_POST['new_question'];
        // Utilisation de la classe Questions pour mettre à jour la question
        $questionsClass->update($question_id, $new_question);
    } elseif (isset($_POST['delete_question'])) {
        $question_id = $_POST['question_id'];
        // Utilisation de la classe Questions pour supprimer la question et ses réponses
        $questionsClass->delete($question_id);
    } elseif (isset($_POST['set_correct_answer'])) {
        $answer_id = $_POST['answer_id'];
        $question_id = $_POST['question_id'];
        // Utilisation de la classe Reponses pour définir la réponse correcte
        $reponsesClass->setCorrectAnswer($answer_id, $question_id);
    }
}

// Récupérer les informations du quiz avec la classe Quiz
$quiz = $quizClass->getById($quiz_id);

// Récupérer les questions du quiz avec la classe Questions
$questions = $questionsClass->getByQuizId($quiz_id);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Page de Modification</title>
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
            <h1>Modifier le Quiz : <?php echo $quiz['nom']; ?></h1>
        </section>

        <!-- Formulaire pour mettre à jour le quiz (nom, description, image) -->
        <div class="quiz-list">
        <div class="quiz-card">
            <form method="post" enctype="multipart/form-data">
                <label for="nom">Nom du quiz :</label>
                <input type="text" name="nom" value="<?php echo $quiz['nom']; ?>">
                <br>
                <label for="description">Description du quiz :</label>
                <textarea name="description"><?php echo $quiz['description']; ?></textarea>
                <br>
                <label for="image">Image du quiz :</label>
                <input type="file" name="image" accept="image/*">
                <br>
                <button type="submit" name="update_quiz">Mettre à jour le quiz</button>
            </form>
             <!-- Bouton "Retour" -->
            <a href="admin.php">Retour</a>
        </div>
        </div>

        <!-- Liste des questions existantes -->
        <div class="quiz-list">
        <div class="quiz-card">
            <?php foreach ($questions as $question): ?>
                <div class="question">
                    <h3><?php echo $question['description']; ?></h3>
                    <!-- Formulaire pour modifier la question -->
                    <form method="post">
                        <input type="hidden" name="question_id" value="<?php echo $question['id']; ?>">
                        <input type="text" name="new_question" placeholder="Modifier la question">
                        <button type="submit" name="update_question">Modifier</button>
                    </form>
                    <!-- Formulaire pour supprimer la question -->
                    <form method="post">
                        <input type="hidden" name="question_id" value="<?php echo $question['id']; ?>">
                        <button type="submit" name="delete_question">Supprimer</button>
                    </form>
                    <!-- Formulaire pour ajouter une réponse -->
                    <form method="post">
                        <input type="text" name="answer" placeholder="Ajouter une réponse">
                        <input type="hidden" name="question_id" value="<?php echo $question['id']; ?>">
                        <button type="submit" name="add_answer">Enregistrer</button>
                    </form>
                    <!-- Liste des réponses existantes -->
                    <?php $answers = $reponsesClass->getByQuestionId($question['id']); ?>
                    <?php foreach ($answers as $answer): ?>
                        <div class="answer">
                            <p><?php echo $answer['description']; ?></p>
                            <!-- Formulaire pour définir la réponse correcte -->
                            <form method="post">
                                <input type="hidden" name="answer_id" value="<?php echo $answer['id']; ?>">
                                <input type="hidden" name="question_id" value="<?php echo $question['id']; ?>">
                                <button type="submit" name="set_correct_answer">Définir comme correcte</button>
                            </form>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>
        </div>
        </div>

        <!-- Formulaire pour ajouter une nouvelle question -->
        <div class="quiz-list">
        <div class="quiz-card">
            <h2>Ajouter une question</h2>
            <form method="post">
                <input type="text" name="question" placeholder="Ajouter une question">
                <button type="submit" name="add_question">Ajouter</button>
            </form>
        </div>
        </div>
    </main>

    <footer>
      
      <p>&copy; Quiz Night |  - La Plateforme</p>
    
  </footer>
</body>
</html>