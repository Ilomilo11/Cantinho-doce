<?php
session_start(); 
include 'conexao.php';
include './configuracao.php'; // Inclui as constantes PagSeguro

// Recupera os dados preparados por finalizar-compra.php
$dadosCheckout = $_SESSION['dados_checkout'] ?? null;

// Verifica se há dados de checkout, senão redireciona (Fluxo de segurança)
if (!$dadosCheckout || !isset($dadosCheckout['checkout_ready'])) {
    header("Location: confirmar-compra.php");
    exit;
}

$valorTotalComFrete = $dadosCheckout['valorTotalComFrete'];
$valorProdutos = $dadosCheckout['itemAmount1'];
$enderecoRua = $dadosCheckout['shippingAddressStreet'];
$enderecoNumero = $dadosCheckout['shippingAddressNumber'];
$enderecoBairro = $dadosCheckout['shippingAddressDistrict'];
$enderecoCidade = $dadosCheckout['shippingAddressCity'];
$enderecoEstado = $dadosCheckout['shippingAddressState'];
$enderecoCEP = $dadosCheckout['shippingAddressPostalCode'];

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pagamento - Cantinho Doce</title>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link href="css/personalizado.css" rel="stylesheet"> 
    <style>
        /* CSS Mínimo para a página de Pagamento */
        body {
            font-family: Arial, sans-serif;
            background: #fff8f0 url('imagens/CantinhoDoce.png') repeat; 
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container1 { /* Mantendo o nome do container original */
            display: flex;
            gap: 20px;
            width: 800px;
            text-align: center;
        }

        /* Estilo dos blocos (seguindo o padrão do confirmar-compra.php) */
        .bloco-cartao, .resumo-pedido {
            background: #fcbaba; /* Cor de fundo do bloco */
            padding: 25px;
            border-radius: 15px;
            flex: 1;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: left;
        }
        
        .bloco-cartao h2, .resumo-pedido h2, .resumo-pedido h3 {
            color: #8b0000; /* Vermelho escuro para títulos */
            font-family: 'Pacifico', cursive;
            text-align: center;
        }

        .bloco-cartao input[type="text"], .bloco-cartao input[type="email"], .bloco-cartao select {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        
        .bloco-cartao label {
            font-weight: bold;
            display: block;
            margin-top: 10px;
        }

        #btnComprar {
            background-color: #8b0000;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1.1em;
            margin-top: 20px;
            width: 100%;
            transition: background-color 0.3s;
        }
        
        #btnComprar:hover {
            background-color: #a02020;
        }
        
        .bandeira-cartao img {
            width: 30px; 
            height: 20px; 
            margin-left: 5px;
            vertical-align: middle;
        }
        
        .total-final {
            font-size: 1.5em;
            color: #8b0000;
            margin-top: 15px;
            text-align: center;
        }

        /* Estilo do Resumo */
        .item-resumo {
            border-bottom: 1px solid #c99;
            padding: 10px 0;
        }

        .item-resumo:last-child {
            border-bottom: none;
        }

        .item-resumo p {
            margin: 5px 0;
        }

    </style>
</head>
<body>
    <span class="endereco" data-endereco="<?php echo URL; ?>"></span>
    <span id="msg" style="color:red; text-align:center; display:block; margin-top:20px;"></span>
    
    <div class="container1">
        
        <div class="bloco-cartao">
            <h2>Pagar com Cartão de Crédito</h2>
            <form name="formPagamento" action="" id="formPagamento">
                
                <input type="hidden" name="paymentMethod" value="creditCard">
                <input type="hidden" name="receiverEmail" value="<?php echo EMAIL_LOJA; ?>">
                <input type="hidden" name="currency" value="<?php echo MOEDA_PAGAMENTO; ?>">
                <input type="hidden" name="notificationURL" value="<?php echo URL_NOTIFICACAO; ?>">
                <input type="hidden" name="reference" value="<?php echo $dadosCheckout['reference']; ?>">
                
                <input type="hidden" name="itemId1" value="<?php echo $dadosCheckout['itemId1']; ?>">
                <input type="hidden" name="itemDescription1" value="<?php echo $dadosCheckout['itemDescription1']; ?>">
                <input type="hidden" name="itemAmount1" value="<?php echo $dadosCheckout['itemAmount1']; ?>">
                <input type="hidden" name="itemQuantity1" value="<?php echo $dadosCheckout['itemQuantity1']; ?>">
                <input type="hidden" name="amount" id="amount" value="<?php echo $dadosCheckout['itemAmount1']; ?>">
                <input type="hidden" name="noIntInstalQuantity" id="noIntInstalQuantity" value="2">
                <input type="hidden" name="bandeiraCartao" id="bandeiraCartao">
                <input type="hidden" name="tokenCartao" id="tokenCartao">
                <input type="hidden" name="hashCartao" id="hashCartao">
                <input type="hidden" name="shippingCost" id="shippingCost" value="<?php echo $dadosCheckout['shippingCost']; ?>">
                
                <label>Número do Cartão:</label>
                <input type="text" name="numCartao" id="numCartao" required> 
                <span class="bandeira-cartao"></span>

                <div class="row">
                    <div class="col-md-6">
                        <label>Mês de Validade:</label>
                        <input type="text" name="mesValidade" id="mesValidade" maxlength="2" value="12" required>
                    </div>
                    <div class="col-md-6">
                        <label>Ano de Validade:</label>
                        <input type="text" name="anoValidade" id="anoValidade" maxlength="4" value="2030" required>
                    </div>
                </div>
                
                <label>CVV (Código de Segurança):</label>
                <input type="text" name="cvvCartao" id="cvvCartao" maxlength="3" value="123" required>

                <label>Quantidades de Parcelas:</label>
                <select name="qntParcelas" id="qntParcelas" class="select-qnt-parcelas" required>
                    <option value="">Aguardando número do cartão...</option>
                </select>
                <input type="hidden" name="valorParcelas" id="valorParcelas">

                <hr>
                <label>Nome no Cartão:</label>
                <input type="text" name="creditCardHolderName" id="creditCardHolderName" value="Jose Comprador" required>
                
                <label>CPF do Dono do Cartão:</label>
                <input type="text" name="creditCardHolderCPF" id="creditCardHolderCPF" value="22111944785" required>
                
                <label>Data de Nascimento:</label>
                <input type="text" name="creditCardHolderBirthDate" id="creditCardHolderBirthDate" value="27/10/1987" required>
                
                <input type="hidden" name="senderName" value="Jose Comprador">
                <input type="hidden" name="senderCPF" value="22111944785">
                <input type="hidden" name="senderAreaCode" value="11">
                <input type="hidden" name="senderPhone" value="56273440">
                <input type="hidden" name="senderEmail" value="c66860546910556664625@sandbox.pagseguro.com.br">

                <input type="hidden" name="shippingAddressRequired" value="true">
                <input type="hidden" name="shippingAddressStreet" value="<?php echo $enderecoRua; ?>">
                <input type="hidden" name="shippingAddressNumber" value="<?php echo $enderecoNumero; ?>">
                <input type="hidden" name="shippingAddressDistrict" value="<?php echo $enderecoBairro; ?>">
                <input type="hidden" name="shippingAddressPostalCode" value="<?php echo $enderecoCEP; ?>">
                <input type="hidden" name="shippingAddressCity" value="<?php echo $enderecoCidade; ?>">
                <input type="hidden" name="shippingAddressState" value="<?php echo $enderecoEstado; ?>">
                <input type="hidden" name="shippingAddressCountry" value="BRA">
                <input type="hidden" name="shippingType" value="3">
                
                <input type="hidden" name="billingAddressStreet" value="Av. Brig. Faria Lima">
                <input type="hidden" name="billingAddressNumber" value="1384">
                <input type="hidden" name="billingAddressDistrict" value="Jardim Paulistano">
                <input type="hidden" name="billingAddressPostalCode" value="01452002">
                <input type="hidden" name="billingAddressCity" value="Sao Paulo">
                <input type="hidden" name="billingAddressState" value="SP">
                <input type="hidden" name="billingAddressCountry" value="BRA">

                <div class="total-final">
                    Total a Pagar: **R$ <?php echo number_format($valorTotalComFrete, 2, ',', '.'); ?>**
                </div>
                
                <input type="submit" name="btnComprar" id="btnComprar" value="Finalizar Compra">
            </form>
        </div>
        
        <div class="resumo-pedido">
            <h2>Resumo do Pedido</h2>
            
            <div class="item-resumo">
                <p>**Subtotal dos Produtos:** R$ <?php echo number_format($valorProdutos, 2, ',', '.'); ?></p>
            </div>
            
            <div class="item-resumo">
                <p>**Taxa de Entrega:** R$ <?php echo number_format($dadosCheckout['shippingCost'], 2, ',', '.'); ?></p>
            </div>

            <div class="item-resumo">
                <h3>Total Final: R$ <?php echo number_format($valorTotalComFrete, 2, ',', '.'); ?></h3>
            </div>
            
            <hr>
            
            <h2>Endereço de Entrega</h2>
            <p>**Rua:** <?php echo $enderecoRua; ?>, <?php echo $enderecoNumero; ?></p>
            <p>**Bairro:** <?php echo $enderecoBairro; ?></p>
            <p>**Cidade/Estado:** <?php echo $enderecoCidade; ?> - <?php echo $enderecoEstado; ?></p>
            <p>**CEP:** <?php echo $enderecoCEP; ?></p>
            
            <button type="button" class="btn btn-sm btn-secondary" onclick="window.location.href='confirmar-compra.php'">Alterar Endereço</button>
        </div>

    </div>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo SCRIPT_PAGSEGURO; ?>"></script>
    <script src="js/personalizado.js"></script>
</body>
</html>