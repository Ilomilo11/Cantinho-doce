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
    <link rel="stylesheet" href="style.css\style.css">
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
    font-family: Arial, sans-serif;
    color:  #D17777;
    font-size: 1.1rem;
    padding: 8px;
}

.navbar-brand{
    font-family: Arial, sans-serif;
    color:  #D17777;
    font-size: 30px;
}
    </style>
 </head>
 <body class='container py-5' style= "background-image: url(imagens/CantinhoDoce.png);">

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
    <h2>Usuarios</h2>
    <table class ="table table-bordered">
        <thead><tr><th>Nome</th><th>Email</th></th><th>Ação</th></tr></thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM usuarios";
            $resultado = mysqli_query($conexao, $sql);
            while($linha = mysqli_fetch_assoc($resultado)){
                echo "<tr>
                <td>{$linha['Nome']}</td>
                <td>{$linha['User']}</td>
                <td><a href=\"editar.php?id={$linha['ID']}\"<button type=\"button\" class=\"btn btn-warning\">Editar</button></td>
                </td>
                ";
            }
            ?>
        </tbody>   
    </table>
 </body>
</html>
