<?php
require_once __DIR__ . '/../models/User.php';

class UserController {
    
    public function perfil() {
        if(session_status() === PHP_SESSION_NONE) session_start();
        if (!isset($_SESSION['user'])) { header('Location: index.php'); exit; }

        $userModel = new User();
        $mensagem = "";

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_SESSION['user']['id'];
            
            if (isset($_FILES['foto']) && $_FILES['foto']['error'] === 0) {
                if (!is_dir('uploads')) { mkdir('uploads', 0777, true); }
                
                $ext = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
                $novoNome = "uploads/" . uniqid() . "." . $ext;
                
                if (move_uploaded_file($_FILES['foto']['tmp_name'], $novoNome)) {
                    $userModel->updatePhoto($id, $novoNome);
                    $_SESSION['user']['foto'] = $novoNome;
                }
            }

            $nome = $_POST['nome'];
            $user = $_POST['username'];
            if($userModel->update($id, $nome, $user)) {
                $_SESSION['user']['name'] = $nome;
                $_SESSION['user']['username'] = $user;
                $mensagem = "Perfil atualizado!";
            }
        }

        $usuario = $userModel->getById($_SESSION['user']['id']);
        require_once __DIR__ . '/../views/perfil.php';
    }

    public function pesquisa() {
        if(session_status() === PHP_SESSION_NONE) session_start();
        if (!isset($_SESSION['user'])) { header('Location: index.php'); exit; }

        $userModel = new User();
        $resultados = [];

        if (isset($_GET['action']) && isset($_GET['id'])) {
            $targetId = $_GET['id'];
            $meuId = $_SESSION['user']['id'];
            if ($_GET['action'] == 'follow') {
                $userModel->follow($meuId, $targetId);
            } elseif ($_GET['action'] == 'unfollow') {
                $userModel->unfollow($meuId, $targetId);
            }
            header("Location: pesquisa.php?termo=" . ($_GET['termo'] ?? ''));
            exit;
        }

        if (isset($_GET['termo'])) {
            $resultados = $userModel->search($_GET['termo'], $_SESSION['user']['id']);
        }

        require_once __DIR__ . '/../views/pesquisa.php';
    }
}
?>