<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Meu Perfil</title>
    <link rel="stylesheet" href="assets/css/estilo-feed.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .container-perfil { max-width: 600px; margin: 50px auto; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; margin-bottom: 5px; }
        .form-group input { width: 100%; padding: 8px; box-sizing: border-box; }
        .img-preview { width: 100px; height: 100px; border-radius: 50%; object-fit: cover; margin-bottom: 10px; }
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
        <div class="container-perfil">
            <h2>Editar Perfil</h2>
            <?php if(!empty($mensagem)) echo "<p style='color:green'>$mensagem</p>"; ?>
            
            <form method="POST" enctype="multipart/form-data">
                <div style="text-align:center;">
                    <img src="<?php echo !empty($usuario['foto_perfil']) ? $usuario['foto_perfil'] : 'assets/imgs/perfil.jpg'; ?>" class="img-preview">
                    <br>
                    <label for="foto">Alterar Foto:</label>
                    <input type="file" name="foto" id="foto" accept="image/*">
                </div>
                
                <div class="form-group">
                    <label>Nome Completo:</label>
                    <input type="text" name="nome" value="<?php echo htmlspecialchars($usuario['nome']); ?>" required>
                </div>

                <div class="form-group">
                    <label>Username:</label>
                    <input type="text" name="username" value="<?php echo htmlspecialchars($usuario['username']); ?>" required>
                </div>

                <button type="submit" class="btn-post">Salvar Alterações</button>
            </form>
        </div>
    </div>
</body>
</html>