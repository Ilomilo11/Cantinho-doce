<?php
session_start();

// Verifica autenticação
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}

require_once 'conexao.php';

// Verifica se o ID foi passado
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID inválido.");
}

$id = (int) $_GET['id'];

// Buscar produto
$sql = "SELECT * FROM produtos WHERE id = ?";
$stmt = mysqli_prepare($conexao, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$produto = mysqli_fetch_assoc($result);

if (!$produto) {
    die("Produto não encontrado.");
}

// Atualizar produto
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = trim($_POST['nome']);
    $preco = str_replace(",", ".", $_POST['preco']);
    $descricao = trim($_POST['descricao']);

    $sql = "UPDATE produtos SET nome = ?, preco = ?, descricao = ? WHERE id = ?";
    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, "sdsi", $nome, $preco, $descricao, $id);

    if (mysqli_stmt_execute($stmt)) {
        header("Location: produtos.php?msg=editado");
        exit;
    } else {
        die("Erro ao atualizar produto: " . mysqli_error($conexao));
    }
}
?>

<!doctype html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Editar Produto</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="produtos.php">Painel</a>
    <div class="d-flex">
      <a href="logout.php" class="btn btn-outline-light">Sair</a>
    </div>
  </div>
</nav>

<div class="container mt-4">
    <h2 class="mb-3">Editar Produto</h2>

    <form method="POST" class="shadow p-4 bg-white rounded">
        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" id="nome" name="nome" class="form-control" 
                   value="<?= htmlspecialchars($produto['nome']) ?>" required>
        </div>

        <div class="mb-3">
            <label for="preco" class="form-label">Preço (R$)</label>
            <input type="text" id="preco" name="preco" class="form-control" 
                   value="<?= number_format($produto['preco'], 2, ',', '.') ?>" required>
        </div>

        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição</label>
            <textarea id="descricao" name="descricao" class="form-control" rows="3" required><?= htmlspecialchars($produto['descricao']) ?></textarea>
        </div>

        <div class="mb-3">
            <label for="descricao" class="form-label">Categoria</label>
            <textarea id="descricao" name="descricao" class="form-control" rows="3" required><?= htmlspecialchars($produto['descricao']) ?></textarea>
        </div>

        <button type="submit" class="btn btn-success">Salvar Alterações</button>
        <a href="produtos.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
