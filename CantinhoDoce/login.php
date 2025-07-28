<?php
session_start();
include "conexao.php";

if ($_SERVER['REQUEST_METHOD']  == 'POST'){
    $login = $_POST['Email'];
    $senha = $_POST['Senha'];

    $sql = "SELECT * FROM usuarios WHERE user = '$login'";
    $res = mysqli_query($conexao, $sql);
    $usuario = mysqli_fetch_assoc($res);

    if($usuario && password_verify($senha, $usuario['Senha'])){
        $_SESSION['usuario'] = $usuario['Nome'];
        header('location: painel-usuario.php');
    }else{
        echo "<div class=\"alert alert-primary\" role=\"alert\">
  Email ou senha invalidos!
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
    <link href="style.css\style-login.css">
    <style>
        .LOGIN{
            width: 400px;
            height: 400px;
            background-color: #fad0d0;
            box-shadow: rgba(0,0,0,0.603);
            border-radius: 20px;
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
            text-align: center;
        }

        form{
            display: block;
            box-sizing: border-box;
            padding: 40px;
            width: 100%;
            height: 100%;
            background-size: cover;
            flex-direction: column;
            display: flex;
            gap: 5px;
        }

        h1{
            font-size: 25px;
            font-weight: normal;
            text-shadow: #fffbf5;
            margin-bottom: 60pxS;
        }
        label{
          color: rgba(0,0,0,0.603);
          text-transform: uppercase;
          font-size: 15px;
          letter-spacing: 2px;
          padding-left: 0px;
        }

        input{
          background-color: #f4eeee;
          height: 40px;
          line-height: 40px;
          border-radius: 10px;
          border: none;
          margin-bottom: 20px;
        }

        button{
          font-size: 14px;
          background-color: #D17777;
          height: 40px;
          line-height: 40px;
          border-radius: 10px;
          border: none;
          margin: 10px 0px;
        }
    </style>
  </head>
  <body style= "background-image: url(imagens/CantinhoDoce.png);">

    <!--login-->

    <div class="container text-center">
        <div class="row">
          <div class="col-sm-2"></div>
          <div class="col-sm-8">
            <div class="LOGIN">
                <form method="post">
                    <h1>LOGIN</h1>
                    <label>Email</label>
                    <input type="email" name="Email" class="form-control" required>
                    <label>Senha</label>
                    <input type="password" name="Senha" class="form-control" required>
                    <button>LOGIN</button>
                </form>
            </div>
          </div>
          <div class="col-sm-2"></div>
        </div>
      </div>
      <!--FIM GRID-->

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>