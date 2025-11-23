<?php
require_once __DIR__ . '/../models/Post.php';

class PostController {
    public function index() {
        if(session_status() === PHP_SESSION_NONE) session_start();
        
        if (!isset($_SESSION['user'])) { 
            header('Location: index.php'); 
            exit; 
        }

        $postModel = new Post();

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['novoPost'])) {
            if (!empty(trim($_POST['novoPost']))) {
                $postModel->create($_SESSION['user']['id'], trim($_POST['novoPost']));
            }
            header('Location: feed.php'); 
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['curtir'])) {
            $postModel->like($_POST['post_id']);
            header('Location: feed.php'); 
            exit;
        }

        $posts = $postModel->getFeed($_SESSION['user']['id']);
        
        $user_name = $_SESSION['user']['name'];
        $user_username = $_SESSION['user']['username'];
        $user_foto = $_SESSION['user']['foto'] ?? 'assets/imgs/perfil.jpg';
        
        require_once __DIR__ . '/../views/feed.php';
    }
}
?>