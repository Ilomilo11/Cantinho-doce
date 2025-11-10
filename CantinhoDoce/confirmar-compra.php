<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmar Compra</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #fff8f0 url('imagens/CantinhoDoce.png') repeat;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container1 {
            display: flex;
            gap: 20px;
            width: 700px;
        }

        .endereco, .resumo {
            background: #fcbaba;
            padding: 20px;
            border-radius: 15px;
            flex: 1;
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
        }

        h2 {
            font-size: 20px;
            margin-bottom: 15px;
            color: #333;
        }

        .item {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
            text-align: left;
        }

        .item img {
            width: 60px;
            height: 60px;
            margin-right: 10px;
            border-radius: 8px;
        }

        .btns {
            text-align: center;
            margin-top: 15px;
        }

        button {
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
        }

        .confirmar {
            background: #d35d5d;
            color: white;
        }

        .voltar {
            background: #a94442;
            color: white;
        }

        .confirmar:hover {
            background: #b94a4a;
        }

        .voltar:hover {
            background: #872f2f;
        }
    </style>
</head>
<body>

<div class="container1">
    <!-- Endereço -->
    <div class="endereco">
        <h2>CONFIRMAR ENDEREÇO</h2>
        <form method="POST" action="finalizar-compra.php">
            <input type="text" name="rua" class="form-control mb-2" placeholder="Rua" required>
            <input type="text" name="numero" class="form-control mb-2" placeholder="Número" required>
            <input type="text" name="bairro" class="form-control mb-2" placeholder="Bairro" required>
            <input type="text" name="cidade" class="form-control mb-2" placeholder="Cidade" required>
            <input type="text" name="estado" class="form-control mb-2" placeholder="Estado" required>

            <div class="btns">
                <button type="submit" class="confirmar">Finalizar Compra</button>
                <button type="button" class="voltar" onclick="window.location.href='produtos.php'">Voltar</button>
            </div>
        </form>
    </div>

    <!-- Resumo -->
    <div class="resumo">
        <h2>RESUMO DO PEDIDO</h2>
        <?php
        if (!empty($_SESSION['carrinho'])) {
            $totalGeral = 0;
            foreach ($_SESSION['carrinho'] as $produto) {
                $subtotal = $produto['preco'] * $produto['quantidade'];
                $totalGeral += $subtotal;
                echo "<div class='item'>
                        <img src='{$produto['imagem']}' alt='{$produto['nome']}'>
                        <div>
                            <p><strong>{$produto['quantidade']}x</strong> {$produto['nome']}</p>
                            <p>R$ " . number_format($produto['preco'], 2, ',', '.') . "</p>
                        </div>
                      </div>";
            }
            echo "<h4>Total: R$" . number_format($totalGeral, 2, ',', '.') . "</h4>";
        } else {
            echo "<p>Nenhum item no carrinho.</p>";
        }
        ?>
    </div>
</div>

</body>
</html>
