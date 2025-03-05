<?php
// includes/User.php
class User {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function create($email, $password) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // Hacher le mot de passe
        $stmt = $this->pdo->prepare("INSERT INTO user (email, password) VALUES (?, ?)");
        $stmt->execute([$email, $hashedPassword]);
    }

    public function findByEmail($email) {
        $stmt = $this->pdo->prepare("SELECT * FROM user WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch();
    }

    public function verifyPassword($user, $password) {
        // Si le mot de passe est haché, utiliser password_verify
        if (password_verify($password, $user['password'])) {
            return true;
        }
        // Sinon, comparer en clair
        return $password === $user['password'];
    }
}
?>