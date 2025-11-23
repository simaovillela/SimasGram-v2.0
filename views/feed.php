<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Feed</title>
    <link rel="stylesheet" href="assets/css/estilo-feed.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <!-- SIDEBAR CORRIGIDA -->
    <div class="sidebar">
        <ul>
            <li><a href="feed.php"><i class="fas fa-home"></i></a></li>
            <li><a href="pesquisa.php"><i class="fas fa-search"></i></a></li>
            <li><a href="perfil.php"><i class="fas fa-user"></i></a></li>
            <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i></a></li>
        </ul>
    </div>

    <div class="feed-container">
        <div class="profile-header">
            <a href="perfil.php" style="text-decoration:none; color:inherit; display:flex; align-items:center;">
                <div class="profile-info">
                    <img class="avatar" src="<?php echo $user_foto; ?>" alt="Avatar">
                    <div style="margin-left:10px;">
                        <h2><?php echo htmlspecialchars($user_name); ?></h2>
                        <span class="handle">@<?php echo htmlspecialchars($user_username); ?></span>
                    </div>
                </div>
            </a>
            <a href="logout.php" class="btn-edit-profile">Sair</a>
        </div>
        
        <form class="new-post-form" method="POST" action="feed.php">
            <textarea name="novoPost" placeholder="Quais são as novidades?"></textarea>
            <button class="btn-post" type="submit">Postar</button>
        </form>
        <hr>

        <?php if (empty($posts)): ?>
            <p style="text-align: center; padding: 20px;">Ainda não há posts.</p>
        <?php else: ?>
            <?php foreach ($posts as $post): ?>
                <div class="post">
                    <div class="post-header">
                        <img class="avatar avatar-small" src="<?php echo !empty($post['foto_perfil']) ? $post['foto_perfil'] : 'assets/imgs/perfil.jpg'; ?>">
                        <div>
                            <span class="author-name"><?php echo htmlspecialchars($post['author_name']); ?></span>
                            <span class="handle">@<?php echo htmlspecialchars($post['author_username']); ?></span>
                        </div>
                    </div>
                    <div class="post-body">
                        <p><?php echo nl2br(htmlspecialchars($post['conteudo'])); ?></p>
                    </div>
                    <div class="post-footer">
                        <form method="POST" action="feed.php" style="display:inline;">
                            <input type="hidden" name="post_id" value="<?php echo $post['id']; ?>">
                            <button type="submit" name="curtir" class="like-button">
                                <i class="far fa-heart"></i> <?php echo $post['curtidas']; ?>
                            </button>
                        </form>
                        <span><i class="far fa-comment"></i> 0</span>
                    </div>
                </div>
                <hr>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</body>
</html>