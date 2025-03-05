<?php
// includes/Questions.php
class Questions {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    /**
     * Récupérer toutes les questions d'un quiz par son ID.
     *
     * @param int $id_quiz L'ID du quiz.
     * @return array Les questions du quiz.
     */
    public function getByQuizId($id_quiz) {
        $stmt = $this->pdo->prepare("SELECT * FROM questions WHERE id_quiz = ?");
        $stmt->execute([$id_quiz]);
        return $stmt->fetchAll();
    }

    /**
     * Créer une nouvelle question.
     *
     * @param string $description La description de la question.
     * @param int $id_quiz L'ID du quiz auquel la question appartient.
     */
    public function create($description, $id_quiz) {
        $stmt = $this->pdo->prepare("INSERT INTO questions (description, id_quiz) VALUES (?, ?)");
        $stmt->execute([$description, $id_quiz]);
    }

    /**
     * Mettre à jour une question existante.
     *
     * @param int $question_id L'ID de la question à mettre à jour.
     * @param string $new_question La nouvelle description de la question.
     */
    public function update($question_id, $new_question) {
        $stmt = $this->pdo->prepare("UPDATE questions SET description = ? WHERE id = ?");
        $stmt->execute([$new_question, $question_id]);
    }

    /**
     * Supprimer une question et toutes ses réponses associées.
     *
     * @param int $question_id L'ID de la question à supprimer.
     */
    public function delete($question_id) {
        // Supprimer d'abord toutes les réponses associées à la question
        $stmt = $this->pdo->prepare("DELETE FROM reponses WHERE id_questions = ?");
        $stmt->execute([$question_id]);

        // Ensuite, supprimer la question elle-même
        $stmt = $this->pdo->prepare("DELETE FROM questions WHERE id = ?");
        $stmt->execute([$question_id]);
    }
}
?>