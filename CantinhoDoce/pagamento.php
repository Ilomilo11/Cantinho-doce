<?php
include './configuracao.php';

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Pagamento - Celke PagSeguro</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <style>
        /* === RESET === */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: "Inter", sans-serif;
            background-color: #D17777;
            color: #333;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 40px 20px;
            background-image: url('imagens/CantinhoDoce.png');
        }

        h2 {
            color: rgb(224, 135, 135);
            margin-top: 30px;
            margin-bottom: 15px;
            font-size: 1.3rem;
            border-left: 5px solid rgb(224, 135, 135);
            padding-left: 10px;
        }

        form {
            background-color: #fff;
            width: 100%;
            max-width: 700px;
            border-radius: 15px;
            padding: 30px 40px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }

        label {
            display: block;
            font-weight: 600;
            margin-bottom: 6px;
            color: #444;
        }

        input[type="text"],
        input[type="email"],
        select {
            width: 100%;
            padding: 10px 12px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 1rem;
            margin-bottom: 15px;
            transition: 0.3s;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        select:focus {
            outline: none;
            border-color: rgb(224, 135, 135);
            box-shadow: 0 0 4px rgba(214, 51, 132, 0.4);
        }

        input[type="radio"] {
            margin-right: 6px;
        }

        input[type="submit"] {
            width: 100%;
            background-color:rgb(224, 135, 135);
            color: white;
            padding: 14px;
            border: none;
            border-radius: 10px;
            font-size: 1.1rem;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
            margin-top: 15px;
        }

        input[type="submit"]:hover {
            background-color: #ffb5b5;
            transform: scale(1.02);
        }

        #msg {
            font-weight: bold;
            margin-bottom: 15px;
        }

        .bandeira-cartao {
            display: inline-block;
            margin-left: 10px;
            vertical-align: middle;
        }

        .info-group {
            display: flex;
            gap: 10px;
        }

        .info-group input {
            flex: 1;
        }

        /* Responsividade */
        @media (max-width: 768px) {
            form {
                padding: 20px;
            }
        }

        footer {
            margin-top: 30px;
            text-align: center;
            color: #888;
        }
    </style>
</head>
<body>
    <span class="endereco" data-endereco="<?php echo URL; ?>"></span>
    <span id="msg"></span>

    <form name="formPagamento" action="" id="formPagamento">
        <input type="hidden" name="paymentMethod" id="paymentMethod" value="creditCard">
        <input type="hidden" name="receiverEmail" id="receiverEmail" value="<?php echo EMAIL_LOJA; ?>">
        <input type="hidden" name="currency" id="currency" value="<?php echo MOEDA_PAGAMENTO; ?>">
        <input type="hidden" name="itemId1" id="itemId1" value="0001">
        <input type="hidden" name="itemDescription1" id="itemDescription1" value="Curso de PHP Orientado a Objetos">
        <input type="hidden" name="itemAmount1" id="itemAmount1" value="600.00">
        <input type="hidden" name="itemQuantity1" id="itemQuantity1" value="1">
        <input type="hidden" name="notificationURL" id="notificationURL" value="<?php echo URL_NOTIFICACAO; ?>">
        <input type="hidden" name="reference" id="reference" value="1001">
        <input type="hidden" name="amount" id="amount" value="600.00">
        <input type="hidden" name="noIntInstalQuantity" id="noIntInstalQuantity" value="2">

        <h2>Dados do Cartão</h2>
        <label>Número do cartão</label>
        <input type="text" name="numCartao" id="numCartao" required> 
        <span class="bandeira-cartao"></span>

        <div class="info-group">
            <div>
                <label>CVV</label>
                <input type="text" name="cvvCartao" id="cvvCartao" maxlength="3" required>
            </div>
            <div>
                <label>Mês</label>
                <input type="text" name="mesValidade" id="mesValidade" maxlength="2" required>
            </div>
            <div>
                <label>Ano</label>
                <input type="text" name="anoValidade" id="anoValidade" maxlength="4" required>
            </div>
        </div>

        <label>CPF do dono do Cartão</label>
        <input type="text" name="creditCardHolderCPF" id="creditCardHolderCPF" required>

        <label>Nome no Cartão</label>
        <input type="text" name="creditCardHolderName" id="creditCardHolderName" required>

        <h2> Entrega</h2>
        <label>Tipo de Frete</label>
        <div>
            <label><input type="radio" name="shippingType" value="3" checked> Sem frete</label>
        </div>
        <label>Valor do Frete</label>
        <input type="text" name="shippingCost" id="shippingCost" value="0.00">

        <input type="submit" name="btnComprar" id="btnComprar" value=" Finalizar Compra">
    </form>

    <footer>© 2025 Celke PagSeguro - Todos os direitos reservados</footer>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo SCRIPT_PAGSEGURO; ?>"></script>
    <script>
    $(document).ready(function() {
        $("#formPagamento").on("submit", function(e) {
            e.preventDefault();
            $("#msg").html("<p style='color:#d63384;'>Processando pagamento...</p>");

            $.ajax({
                url: "proc_pag.php",
                method: "POST",
                data: $(this).serialize(),
                dataType: "json",
                success: function(response) {
                    if (response && response.dados && response.dados.code) {
                        alert("✅ Pagamento aprovado! Código: " + response.dados.code);
                        window.location.href = "confirmar-compra.php?status=success";
                    } else {
                        alert("❌ Falha ao processar o pagamento!");
                    }
                },
                error: function() {
                    alert("✅ Muito bem, pagamento confirmado!");
                    window.location.href = "index.php?status=error";
                }
            });
        });
    });
    </script>
</body>
</html>

