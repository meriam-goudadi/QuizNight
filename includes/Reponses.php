<?php
// includes/Reponses.php
class Reponses {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getByQuestionId($id_question) {
        $stmt = $this->pdo->prepare("SELECT * FROM reponses WHERE id_questions = ?");
        $stmt->execute([$id_question]);
        return $stmt->fetchAll();
    }

    public function create($description, $id_questions) {
        $stmt = $this->pdo->prepare("INSERT INTO reponses (description, id_questions) VALUES (?, ?)");
        $stmt->execute([$description, $id_questions]);
    }

    public function getCorrectAnswer($id_question) {
        $stmt = $this->pdo->prepare("SELECT * FROM reponses WHERE id_questions = ? AND is_correct = 1");
        $stmt->execute([$id_question]);
        return $stmt->fetch();
    }

    /**
     * Définir une réponse comme correcte pour une question donnée.
     *
     * @param int $answer_id L'ID de la réponse à définir comme correcte.
     * @param int $question_id L'ID de la question associée.
     */
    public function setCorrectAnswer($answer_id, $question_id) {
        // D'abord, réinitialiser toutes les réponses de cette question à "non correcte"
        $sql = "UPDATE reponses SET is_correct = 0 WHERE id_questions = :question_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':question_id' => $question_id]);

        // Ensuite, définir la réponse spécifiée comme correcte
        $sql = "UPDATE reponses SET is_correct = 1 WHERE id = :answer_id AND id_questions = :question_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':answer_id' => $answer_id, ':question_id' => $question_id]);
    }
}
?>