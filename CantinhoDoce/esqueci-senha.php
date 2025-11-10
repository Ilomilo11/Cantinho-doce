<?php
include 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];

    // Verifica se existe usuário com esse e-mail
    $sql = "SELECT * FROM usuarios WHERE email='$email'";
    $result = mysqli_query($conexao, $sql);

    if (mysqli_num_rows($result) > 0) {
        // Aqui você poderia enviar e-mail real com link de redefinição
        $msg = "Um link de redefinição de senha foi enviado para seu e-mail!";
    } else {
        $msg = "E-mail não encontrado!";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Esqueci minha senha</title>
</head>
<style>
            .rec-senha{
            width: 300px;
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
          line-height: 10px;
          border-radius: 10px;
          border: none;
          margin: 10px 0px;
        }

        p{

        }

        body{
            background-image: url('imagens/CantinhoDoce.png')
        }
</style>
<body>
 <div class="rec-senha">
    <h2>Recuperar Senha</h2>
    <?php if (!empty($msg)) echo "<p>$msg</p>"; ?>
    <form method="POST" action="">
        <label>Digite seu e-mail cadastrado:</label><br>
        <input type="email" name="email" required><br>
        <button type="submit">Enviar</button>
        <p><a href="login.php">Voltar ao login</a></p>
    </form>
 </div>
</body>
</html>
