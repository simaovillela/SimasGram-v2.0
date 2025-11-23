<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - SimasGram</title>
    <link rel="stylesheet" href="assets/css/estilo-autenticacao.css">
</head>
<body>
    <div class="container-auth">
        <h1>Crie sua Conta</h1>
        <?php if (!empty($errors)): ?>
            <div class="error-message">
                <?php foreach ($errors as $erro): ?>
                    <p><?php echo $erro; ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <form method="POST" action="cadastro.php">
            <div class="grupo-form">
                <label for="name">Nome completo</label>
                <input type="text" id="name" name="name" required value="<?php echo htmlspecialchars($name); ?>">
            </div>
            <div class="grupo-form">
                <label for="username">Nome de usuário</label>
                <input type="text" id="username" name="username" required value="<?php echo htmlspecialchars($username); ?>">
            </div>
            <div class="grupo-form">
                <label for="email">E-mail</label>
                <input type="email" id="email" name="email" required value="<?php echo htmlspecialchars($email); ?>">
            </div>
            <div class="grupo-form">
                <label for="password">Senha</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="grupo-form">
                <label for="password_confirm">Confirme a Senha</label>
                <input type="password" id="password_confirm" name="password_confirm" required>
            </div>
            <div class="grupo-form">
                <label for="birthdate">Data de Nascimento</label>
                <input type="date" id="birthdate" name="birthdate" required value="<?php echo htmlspecialchars($birthdate); ?>">
            </div>
            <div class="grupo-form">
                <label for="gender">Gênero</label>
                <select id="gender" name="gender" required>
                    <option value="">Selecione...</option>
                    <option value="feminino" <?php echo ($gender === 'feminino') ? 'selected' : ''; ?>>Feminino</option>
                    <option value="masculino" <?php echo ($gender === 'masculino') ? 'selected' : ''; ?>>Masculino</option>
                    <option value="outro" <?php echo ($gender === 'outro') ? 'selected' : ''; ?>>Outro</option>
                </select>
            </div>
            <button type="submit" class="btn-principal">Cadastrar</button>
        </form>
        <div class="link-alternativo">Já tem uma conta? <a href="index.php">Faça login</a></div>
    </div>
</body>
</html>