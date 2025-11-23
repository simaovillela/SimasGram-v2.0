<?php
require_once __DIR__ . '/../config/database.php';

class Post {
    private $conn;

    public function __construct() {
        $this->conn = Database::connect();
    }

    public function create($userId, $conteudo) {
        $stmt = $this->conn->prepare("INSERT INTO posts (user_id, conteudo) VALUES (:uid, :conteudo)");
        return $stmt->execute([':uid' => $userId, ':conteudo' => $conteudo]);
    }

    public function getFeed($myId) {
        $sql = "SELECT p.*, u.nome as author_name, u.username as author_username, u.foto_perfil 
                FROM posts p 
                JOIN users u ON p.user_id = u.id 
                WHERE p.user_id = :myId 
                OR p.user_id IN (SELECT followed_id FROM follows WHERE follower_id = :myId)
                ORDER BY p.data_criacao DESC";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':myId' => $myId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function like($postId) {
        $stmt = $this->conn->prepare("UPDATE posts SET curtidas = curtidas + 1 WHERE id = :id");
        return $stmt->execute([':id' => $postId]);
    }
}
?>