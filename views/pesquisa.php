<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Pesquisar</title>
    <link rel="stylesheet" href="assets/css/estilo-feed.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .user-card { display: flex; align-items: center; justify-content: space-between; padding: 10px; border-bottom: 1px solid #eee; }
        .user-info { display: flex; align-items: center; }
        .user-info img { width: 40px; height: 40px; border-radius: 50%; margin-right: 10px; object-fit: cover;}
        .btn-follow { padding: 5px 10px; border: none; border-radius: 4px; cursor: pointer; }
        .btn-follow.follow { background: #1da1f2; color: white; }
        .btn-follow.unfollow { background: #ccc; color: black; }
    </style>
</head>
<body>
    <div class="sidebar">
        <ul>
            <li><a href="feed.php"><i class="fas fa-home"></i></a></li>
            <li><a href="pesquisa.php"><i class="fas fa-search"></i></a></li>
            <li><a href="perfil.php"><i class="fas fa-user"></i></a></li>
            <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i></a></li>
        </ul>
    </div>

    <div class="feed-container">
        <h2>Pesquisar Usuários</h2>
        <form method="GET" action="pesquisa.php" style="margin-bottom: 20px;">
            <input type="text" name="termo" placeholder="Buscar por nome ou @usuario..." style="width: 70%; padding: 10px;">
            <button type="submit" class="btn-post" style="width: 25%;">Buscar</button>
        </form>

        <div class="resultados">
            <?php if (isset($_GET['termo']) && empty($resultados)): ?>
                <p>Nenhum usuário encontrado.</p>
            <?php endif; ?>

            <?php foreach ($resultados as $user): ?>
                <div class="user-card">
                    <div class="user-info">
                        <img src="<?php echo !empty($user['foto_perfil']) ? $user['foto_perfil'] : 'assets/imgs/perfil.jpg'; ?>">
                        <div>
                            <strong><?php echo htmlspecialchars($user['nome']); ?></strong><br>
                            <small>@<?php echo htmlspecialchars($user['username']); ?></small>
                        </div>
                    </div>
                    
                    <?php if ($user['seguindo'] > 0): ?>
                        <a href="pesquisa.php?termo=<?php echo $_GET['termo']; ?>&action=unfollow&id=<?php echo $user['id']; ?>">
                            <button class="btn-follow unfollow">Deixar de Seguir</button>
                        </a>
                    <?php else: ?>
                        <a href="pesquisa.php?termo=<?php echo $_GET['termo']; ?>&action=follow&id=<?php echo $user['id']; ?>">
                            <button class="btn-follow follow">Seguir</button>
                        </a>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>