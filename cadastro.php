<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['user'])) {
    header("Location: feed.php");
    exit;
}

require_once 'controllers/AuthController.php';
$controller = new AuthController();
$controller->registrar();
?>