<?php
require_once __DIR__ . '/../models/User.php';

class AuthController {
    public function registrar() {
        $errors = [];
        $name = $username = $email = $birthdate = $gender = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            $username = trim($_POST['username'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';
            $password_confirm = $_POST['password_confirm'] ?? '';
            $birthdate = $_POST['birthdate'] ?? '';
            $gender = $_POST['gender'] ?? '';

            if (empty($name) || empty($username) || empty($email) || empty($password)) { $errors[] = "Campos obrigatórios vazios."; }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { $errors[] = "E-mail inválido."; }
            if (strlen($password) < 6 || !preg_match('/[A-Z]/', $password) || !preg_match('/[0-9]/', $password)) { 
                $errors[] = "Senha deve ter min. 6 caracteres, 1 maiúscula e 1 número."; 
            }
            if ($password !== $password_confirm) { $errors[] = "Senhas não coincidem."; }

            $userModel = new User();
            if (empty($errors) && $userModel->checkExists($email, $username)) {
                $errors[] = "E-mail ou Usuário já existem.";
            }

            if (empty($errors)) {
                if ($userModel->create($name, $username, $email, $password, $birthdate, $gender)) {
                    header('Location: index.php?success=1');
                    exit;
                } else {
                    $errors[] = "Erro ao salvar no banco.";
                }
            }
        }
        require_once __DIR__ . '/../views/cadastro.php';
    }

    public function logar() {
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';

            $userModel = new User();
            $user = $userModel->login($email);

            if ($user && password_verify($password, $user['senha'])) {
                if(session_status() === PHP_SESSION_NONE) session_start();
                $_SESSION['user'] = [
                    'id' => $user['id'],
                    'name' => $user['nome'],
                    'username' => $user['username'],
                    'foto' => $user['foto_perfil']
                ];
                header('Location: feed.php');
                exit;
            } else {
                $error = "E-mail ou senha inválidos.";
            }
        }
        require_once __DIR__ . '/../views/login.php';
    }
}
?>