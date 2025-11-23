<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SimasGram</title>
    <link rel="stylesheet" href="assets/css/estilo-autenticacao.css">
</head>
<body>
    <div class="container-auth">
        <h1>Entrar na sua Conta</h1>
        <?php if (!empty($error)): ?>
            <p class="error-message"><?php echo $error; ?></p>
        <?php endif; ?>
        <?php if (isset($_GET['success'])): ?>
            <p class="success-message">Cadastro realizado com sucesso! Faça o login.</p>
        <?php endif; ?>
        
        <form method="POST" action="index.php">
            <div class="grupo-form">
                <label for="email">E-mail</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="grupo-form">
                <label for="password">Senha</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="btn-principal">Entrar</button>
        </form>
        <div class="link-alternativo">Não tem uma conta? <a href="cadastro.php">Cadastre-se</a></div>
    </div>
</body>
</html>