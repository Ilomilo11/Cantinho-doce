<?php
include 'conexao.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $Nome = $_POST['Nome'];
    $Email = $_POST['Email'];
    $Senha = password_hash($_POST['Senha'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO usuarios (Nome, User, Senha) VALUE ('$Nome', '$Email', '$Senha')";
    mysqli_query($conexao, $sql);
    header("location: login.php");
};

?>


<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cantinho Doce</title>
    <link href="cantinhodoce.css">
    <style>
      @keyframes aparecer {
    0% {
        opacity: 0;
        transform: translate(-50%, -40%) scale(0.9);
    }
    100% {
        opacity: 1;
        transform: translate(-50%, -50%) scale(1);
    }
}

.LOGIN {
    width: 400px;
    height: 500px;
    background-color: #fad0d0;
    border-radius: 20px;
    position: absolute;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%);
    font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
    text-align: center;
    box-shadow: 4px 4px 10px #D17777

    /* AQUI a animação */
    animation: aparecer 0.8s ease-out;
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

        a{
          color: #D17777;
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
                <form method="POST">
                    <h1>REGISTRAR</h1>
                    <label>Nome</label>
                    <input ttype="text" name="Nome" class="form-control" required>
                    <label>Email</label>
                    <input type="email" name="Email" class="form-control" required>
                    <label>Senha</label>
                    <input type="password" name="Senha" class="form-control" required>
                    <button>Registrar</button>
                    <a href="login.php" class="btn btn-link">Já tenho conta</a>
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
