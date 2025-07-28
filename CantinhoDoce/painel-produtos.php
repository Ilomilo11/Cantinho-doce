<?php
session_start();
if(!isset($_SESSION['usuario'])){
    header("Location: login.php");
    exit;
}


include 'conexao.php';
?>

<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Painel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
 </head>
<body class='container py-5'>
  
   <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Cantinho Doce</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="pagina_inicial.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="painel-produtos.php">Produtos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="painel-usuario.php">Usuários</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Sair</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <h1>Painel de Controle</h1>
    <p>Bem vindo, <?= $_SESSION['usuario']?>
    <br>
    <h2>produtos</h2>
    <table class ="table table-bordered">
        <thead><tr><th>nome</th><th>preco</th><th>descricao</th><th>imagem</th><th>Ação</th></tr></thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM produtos";
            $resultado = mysqli_query($conexao, $sql);
            while($linha = mysqli_fetch_assoc($resultado)){
                echo "<tr>
                <td>{$linha['nome']}</td>
                <td>{$linha['preco']}</td>
                <td>{$linha['descricao']}</td>
                <td><img src='{$linha['imagem']}' width='100'></td>
                <td><a href=\"editar.php?id={$linha['id']}\"<button type=\"button\" class=\"btn btn-warning\">Editar</button></td>
                </td>
                ";
            }
            ?>
        </tbody>
    
    </table>

    <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Registrar produto
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel"> Cadastro de produto</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <?php
include 'conexao.php';

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $Nome = $_POST['nome'];
    $Preco = $_POST['preco'];
    $Descricao = $_POST['descricao'];

    $imagem_nome = $_FILES['imagem']['name'];
    $imagem_tmp = $_FILES['imagem']['tmp_name'];
    $imagem_tamanho = $_FILES['imagem']['size'];
    $imagem_tipo = mime_content_type($imagem_tmp);

    $checagem = getimagesize($imagem_tmp);
    $tipos_permitidos = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];

    if ($checagem && in_array($imagem_tipo, $tipos_permitidos)) {
        if ($imagem_tamanho < 5 * 1024 * 1024) {
            $novo_nome = uniqid() . '_' . basename($imagem_nome);
            $caminho_imagem = 'uploads/' . $novo_nome;

            if (move_uploaded_file($imagem_tmp, $caminho_imagem)) {
                $sql = "INSERT INTO produtos (nome, preco, descricao, imagem) 
                        VALUES ('$Nome', '$Preco', '$Descricao', '$caminho_imagem')";
                mysqli_query($conexao, $sql);
                header("Location: painel-produtos.php");
                exit;
            } else {
                echo "<div class=\"alert alert-primary\" role=\"alert\">
  Erro ao salvar no servidor!
</div>";;
            }
        } else {
            echo "<div class=\"alert alert-primary\" role=\"alert\">
  Imagem muito grande. O tamanho permitido é de 5MB.
</div>";;
        }
    } else {
        echo "<div class=\"alert alert-primary\" role=\"alert\">
  O arquivo enviado não é uma imagem valida!
</div>";
    }
}
?>

<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cantinho Doce</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="style.css\style.css">
     <style>

.table {
    background-color: #fff;
    border-collapse: collapse;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.table thead th {
    background-color: #D17777;
    color: #fff; 
    font-weight: bold;
    text-align: center;
    padding: 12px;
    border: 2px solid #B05555;
}

.table tbody td {
    padding: 10px;
    border: 1px solid #D17777;
    text-align: center;
    vertical-align: middle;
}

.table tbody tr:hover {
    background-color: #F8E7E7;
}

.btn-warning {
    background-color: #D17777;
    border-color: #B05555;
    color: #fff;
    padding: 8px 16px;
    transition: background-color 0.3s ease;
}

.btn-warning:hover {
    background-color: #B05555;
    border-color: #903333;
}

.btn-dark {
    background-color: #333333;
    border-color: #222222;
    color: #fff;
    padding: 8px 16px;
    transition: background-color 0.3s ease;
}

.btn-dark:hover {
    background-color: #444444;
    border-color: #333333;
}

.container {
    background-color: rgba(255, 255, 255, 0.9);
    padding: 20px;
    border-radius: 10px;
}

body {
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    min-height: 100vh;
}

h1, h2 {
    color: #D17777;
    font-weight: bold;
}

p {
    color: #333;
    font-size: 1.1rem;
}

.nav-link{
    color:  #D17777;
    font-size: 1.1rem;
    padding: 8px;
}

.navbar-brand{
    font-family: Arial, sans-serif;
    color:  #D17777;
    font-size: 30px;
    border: none;
}
</style>
  </head>
  <body style= "background-image: url(imagens/CantinhoDoce.png);">
    <div class="container text-center">
        <div class="row">
          <div class="col-sm-2"></div>
          <div class="col-sm-8">
            <div class="LOGIN">
                <form method="post" enctype="multipart/form-data">
                    <h1>CADASTRO DE PRODUTO</h1>
                    <label>Nome do produto</label>
                    <input type="text" name="nome" class="form-control" required>
                    <label>Preço</label>
                    <input type="number" name="preco" class="form-control" required>
                    <label>descricao</label>
                    <input type="text" name="descricao" class="form-control" required>
                    <label>Imagem</label>
                    <input type="file" name="imagem" class="form-control" accept="image/*" required>
                  <br><button>CADASTRAR</button>
                </form>
            </div>
          </div>
          <div class="col-sm-2"></div>
        </div>
      </div>


    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>
 </body>
</html>
