<?php
include 'db.php';

$busca = $_GET['busca'] ?? '';
$query = "SELECT * FROM noticias WHERE titulo LIKE :busca OR conteudo LIKE :busca";
$stmt = $pdo->prepare($query);
$stmt->execute(['busca' => "%$busca%"]);
$noticias = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <title>HelloWorldNews</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h1>Notícias</h1>
        <form method="get" class="mb-3">
            <input type="text" name="busca" class="form-control" placeholder="Pesquisar..." value="<?= htmlspecialchars($busca) ?>">
        </form>
        <a href="criar.php" class="btn btn-primary mb-3">Nova Notícia</a>
        <?php foreach ($noticias as $noticia): ?>
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title"><?= htmlspecialchars($noticia['titulo']) ?></h5>
                    <p class="card-text"><?= nl2br(htmlspecialchars($noticia['conteudo'])) ?></p>
                    <a href="editar.php?id=<?= $noticia['id'] ?>" class="btn btn-warning btn-sm">Editar</a>
                    <a href="excluir.php?id=<?= $noticia['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza?')">Excluir</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
