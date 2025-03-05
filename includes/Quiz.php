<?php
// includes/Quiz.php
class Quiz {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAll() {
        $stmt = $this->pdo->query("SELECT * FROM quiz");
        return $stmt->fetchAll();
    }

    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM quiz WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function create($nom, $description, $image, $id_user) {
        $stmt = $this->pdo->prepare("INSERT INTO quiz (nom, description, image, id_user) VALUES (?, ?, ?, ?)");
        $stmt->execute([$nom, $description, $image, $id_user]);
        return $this->pdo->lastInsertId();
    }

    public function update($id, $nom, $description, $image = null) {
        if ($image) {
            $stmt = $this->pdo->prepare("UPDATE quiz SET nom = ?, description = ?, image = ? WHERE id = ?");
            $stmt->execute([$nom, $description, $image, $id]);
        } else {
            $stmt = $this->pdo->prepare("UPDATE quiz SET nom = ?, description = ? WHERE id = ?");
            $stmt->execute([$nom, $description, $id]);
        }
    }

    public function delete($id) {
    // Désactiver temporairement les contraintes de clé étrangère
    $this->pdo->exec("SET FOREIGN_KEY_CHECKS=0");

    // Supprimer les réponses associées aux questions du quiz
    $stmt = $this->pdo->prepare("DELETE reponses FROM reponses 
                                 INNER JOIN questions ON reponses.id_questions = questions.id 
                                 WHERE questions.id_quiz = ?");
    $stmt->execute([$id]);

    // Supprimer les questions associées au quiz
    $stmt = $this->pdo->prepare("DELETE FROM questions WHERE id_quiz = ?");
    $stmt->execute([$id]);

    // Supprimer le quiz
    $stmt = $this->pdo->prepare("DELETE FROM quiz WHERE id = ?");
    $stmt->execute([$id]);

    // Réactiver les contraintes de clé étrangère
    $this->pdo->exec("SET FOREIGN_KEY_CHECKS=1");
    }
}
?>