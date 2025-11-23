<?php
require_once __DIR__ . '/../config/database.php';

class User {
    private $conn;

    public function __construct() {
        $this->conn = Database::connect();
    }

    public function checkExists($email, $username) {
        $stmt = $this->conn->prepare("SELECT id FROM users WHERE email = :email OR username = :username");
        $stmt->execute([':email' => $email, ':username' => $username]);
        return $stmt->rowCount() > 0;
    }

    public function create($nome, $username, $email, $senha, $nasc, $genero) {
        $stmt = $this->conn->prepare("INSERT INTO users (nome, username, email, senha, data_nascimento, genero) VALUES (:nome, :username, :email, :senha, :nasc, :genero)");
        return $stmt->execute([
            ':nome' => $nome, ':username' => $username, ':email' => $email, 
            ':senha' => password_hash($senha, PASSWORD_DEFAULT), ':nasc' => $nasc, ':genero' => $genero
        ]);
    }

    public function login($email) {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute([':email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->conn->prepare("SELECT id, nome, username, email, foto_perfil FROM users WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $nome, $username) {
        $stmt = $this->conn->prepare("UPDATE users SET nome = :nome, username = :username WHERE id = :id");
        return $stmt->execute([':nome' => $nome, ':username' => $username, ':id' => $id]);
    }

    public function updatePhoto($id, $path) {
        $stmt = $this->conn->prepare("UPDATE users SET foto_perfil = :path WHERE id = :id");
        return $stmt->execute([':path' => $path, ':id' => $id]);
    }

    public function search($term, $myId) {
        $term = "%$term%";
        $stmt = $this->conn->prepare("
            SELECT u.id, u.nome, u.username, u.foto_perfil,
            (SELECT COUNT(*) FROM follows WHERE follower_id = :myId AND followed_id = u.id) as seguindo
            FROM users u 
            WHERE (u.nome LIKE :term OR u.username LIKE :term) AND u.id != :myId
        ");
        $stmt->execute([':term' => $term, ':myId' => $myId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function follow($followerId, $followedId) {
        $stmt = $this->conn->prepare("INSERT IGNORE INTO follows (follower_id, followed_id) VALUES (:me, :target)");
        return $stmt->execute([':me' => $followerId, ':target' => $followedId]);
    }

    public function unfollow($followerId, $followedId) {
        $stmt = $this->conn->prepare("DELETE FROM follows WHERE follower_id = :me AND followed_id = :target");
        return $stmt->execute([':me' => $followerId, ':target' => $followedId]);
    }
}
?>