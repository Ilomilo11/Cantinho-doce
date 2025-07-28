<?php
include 'conexao.php';
session_start();

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
    <link href="style.css">
  </head>
  <body style= "background-image: url(imagens/CantinhoDoce.png);">

    <!--login-->

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
                    <button>CADASTRAR</button>
                </form>
            </div>
          </div>
          <div class="col-sm-2"></div>
        </div>
      </div>


    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>
