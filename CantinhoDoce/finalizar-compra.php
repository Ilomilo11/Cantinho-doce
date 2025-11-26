<?php
// Recebe os dados de endereço da página confirmar-compra.php
$rua = $_POST['rua'] ?? '';
$numero = $_POST['numero'] ?? '';
$bairro = $_POST['bairro'] ?? '';
$cidade = $_POST['cidade'] ?? '';
$estado = $_POST['estado'] ?? '';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finalizar Compra</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #fff8f0 url('imagens/CantinhoDoce.png') repeat;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .pagamento-container {
            background: #fcbaba;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
            width: 400px;
            text-align: center;
        }

        h2 {
            color: #333;
            margin-bottom: 20px;
        }

        select, button {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            border-radius: 8px;
            border: none;
        }

        select {
            background-color: white;
        }

        button {
            background-color: #d35d5d;
            color: white;
            font-weight: bold;
            transition: 0.3s;
        }

        button:hover {
            background-color: #b94a4a;
        }

        /* Pop-up (modal) */
        .popup {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.6);
            justify-content: center;
            align-items: center;
            z-index: 999;
        }

        .popup-content {
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            text-align: center;
            width: 300px;
            box-shadow: 0 0 15px rgba(0,0,0,0.3);
            animation: aparecer 0.3s ease;
        }

        @keyframes aparecer {
            from { opacity: 0; transform: scale(0.9); }
            to { opacity: 1; transform: scale(1); }
        }

        .popup-content h3 {
            color: #28a745;
            margin-bottom: 15px;
        }

        .popup-content button {
            background: #d35d5d;
            border: none;
            color: white;
            padding: 10px 15px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
        }

        .popup-content button:hover {
            background: #b94a4a;
        }

        .endereco-info {
            font-size: 14px;
            margin-bottom: 10px;
            background: #fff3f3;
            border-radius: 8px;
            padding: 10px;
        }
    </style>
</head>
<body>

<div class="pagamento-container">
    <h2>Simulação de Pagamento</h2>

    <div class="endereco-info">
        <p><strong>Endereço:</strong> <?= htmlspecialchars("$rua, $numero - $bairro, $cidade - $estado") ?></p>
    </div>

    <select id="metodoPagamento">
        <option value="">Selecione o método de pagamento</option>
        <option value="cartao">Cartão de Crédito</option>
        <option value="pix">PIX</option>
        <option value="boleto">Cartão de débito</option>
    </select>

    <div class="btns">
    <button type="button" class="confirmar" onclick="window.location.href='pagamento.php'">
        Pagar Agora
    </button>
    <button type="button" class="voltar" onclick="window.location.href='produtos.php'">
        Voltar
    </button>
</div>


<!-- Pop-up -->
<div class="popup" id="popup">
    <div class="popup-content">
        <h3>✅ Compra Aprovada!</h3>
        <p>Seu pedido foi confirmado com sucesso.</p>
        <button onclick="window.location.href='pagina_inicial.php'">Voltar à Página Inicial</button>
    </div>
</div>

<script>
    document.getElementById('btnPagar').addEventListener('click', function() {
        const metodo = document.getElementById('metodoPagamento').value;
        if (!metodo) {
            alert('Por favor, selecione um método de pagamento.');
            return;
        }

        // Simula um tempo de processamento
        this.disabled = true;
        this.innerText = "Processando...";
        setTimeout(() => {
            document.getElementById('popup').style.display = 'flex';
            this.disabled = false;
            this.innerText = "Pagar Agora";
        }, 1500);
    });
</script>

</body>
</html>
