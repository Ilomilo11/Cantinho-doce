<?php
session_start();
if(!isset($_SESSION['usuario'])){
    header("Location: login.php");
    exit;
}

include 'conexao.php';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cantinho Doce</title>
  <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  
  <style>
     * {
       margin: 0;
       padding: 0;
       box-sizing: border-box;
     }

     body {
       font-family: Arial, sans-serif;
       background-color: #fff;
       background-image: url('imagens/CantinhoDoce.png');
     }

     header {
       background-color: #fafafa;
       display: flex;
       align-items: center;
       justify-content: space-between;
       padding: 1rem 2rem;
       border-bottom: 1px solid #ddd;
     }

     .menu-icon {
       font-size: 1.5rem;
       cursor: pointer;
       background-color: #f08a8a;
       border: none;
       padding: 10px 15px;
       border-radius: 8px;
       color: white;
       font-weight: bold;
       z-index: 1000;
       font-family: 'Arial', fantasy;
     }
     
     .logo {
       font-family: 'Pacifico', cursive;
       font-size: 2rem;
     }

     .login {
       display: flex;
       align-items: center;
       gap: 0.5rem;
       cursor: pointer;
       font-size: 1.2rem
     }

     .login a {
       color: black;
       text-decoration: none;
     }

     .main-banner {
       background-color: #ffb5b5;
       padding: 3rem 2rem;
       text-align: center;
       margin-top: -100px;
       box-shadow: 0 0 2px rgba(0,0,0,0.2);
     }

     .main-banner h1 {
       font-family: 'Pacifico', cursive;
       font-size: 4rem;
       color: #000;
     }

     .main-banner p.subtext {
       font-size: 1rem;
       margin-top: 0.5rem;
     }

     .main-banner p.price {
       margin-top: 1rem;
       font-weight: bold;
     }

     .background-pattern {
       background: url('https://www.transparenttextures.com/patterns/cup-cakes.png');
       height: 100px;
     }

     .container-botoes {
      display: flex;
      justify-content: center;
      gap: 20px;
      margin-top: 20px
    }

/* From Uiverse.io by Madflows */ 
button {
 position: relative;
 display: inline-block;
 cursor: pointer;
 outline: none;
 border: 0;
 vertical-align: middle;
 text-decoration: none;
 font-family: inherit;
 font-size: 15px;
 height: 90px;
 width: 215px;
}

button.categories {
 font-weight: 600;
 color: #382b22;
 text-transform: uppercase;
 padding: 1.25em 2em;
 background: #ffe0e0;
 border: 2px solid #b18597;
 border-radius: 0.75em;
 -webkit-transform-style: preserve-3d;
 transform-style: preserve-3d;
 -webkit-transition: background 150ms cubic-bezier(0, 0, 0.58, 1), -webkit-transform 150ms cubic-bezier(0, 0, 0.58, 1);
 transition: transform 150ms cubic-bezier(0, 0, 0.58, 1), background 150ms cubic-bezier(0, 0, 0.58, 1), -webkit-transform 150ms cubic-bezier(0, 0, 0.58, 1);
}

button.categories::before {
 position: absolute;
 content: '';
 width: 100%;
 height: 100%;
 top: 0;
 left: 0;
 right: 0;
 bottom: 0;
 background: #f9c4d2;
 border-radius: inherit;
 -webkit-box-shadow: 0 0 0 2px #b18597, 0 0.625em 0 0 #ffe3e2;
 box-shadow: 0 0 0 2px #b18597, 0 0.625em 0 0 #ffe3e2;
 -webkit-transform: translate3d(0, 0.75em, -1em);
 transform: translate3d(0, 0.75em, -1em);
 transition: transform 150ms cubic-bezier(0, 0, 0.58, 1), box-shadow 150ms cubic-bezier(0, 0, 0.58, 1), -webkit-transform 150ms cubic-bezier(0, 0, 0.58, 1), -webkit-box-shadow 150ms cubic-bezier(0, 0, 0.58, 1);
}

button.categories:hover {
 background: #ffe9e9;
 -webkit-transform: translate(0, 0.25em);
 transform: translate(0, 0.25em);
}

button.categories:hover::before {
 -webkit-box-shadow: 0 0 0 2px #b18597, 0 0.5em 0 0 #ffe3e2;
 box-shadow: 0 0 0 2px #b18597, 0 0.5em 0 0 #ffe3e2;
 -webkit-transform: translate3d(0, 0.5em, -1em);
 transform: translate3d(0, 0.5em, -1em);
}

button.categories:active {
 background: #ffe9e9;
 -webkit-transform: translate(0em, 0.75em);
 transform: translate(0em, 0.75em);
}

button.categories:active::before {
 -webkit-box-shadow: 0 0 0 2px #b18597, 0 0 #ffe3e2;
 box-shadow: 0 0 0 2px #b18597, 0 0 #ffe3e2;
 -webkit-transform: translate3d(0, 0, -1em);
 transform: translate3d(0, 0, -1em);
}

    .categories:hover {
      transform: translateY(-8px) scale(1.05); /* aumenta levemente o botão */
      box-shadow: 0 6px 15px rgba(0,0,0,0.2); /* sombra para destacar */
      background-color:rgb(236, 141, 135);
}

    .category-button {
      height: 80px;
      width: 175px;
      background-color: #ffb5b5;
      color: black;
      padding: 1rem 2rem;
      border-radius: 20px;
      font-weight: bold;
      font-family: 'Chonburi', fantasy
      font-color: rgb(255, 255, 255);
      font-size: 1.3rem;
      border: none;
      cursor: pointer;
      margin-right: 30px;
    }


    .carousel-container {
    position: relative;
    width: 95%;
    margin: 100px auto 0 auto;  /* desce o carrossel */
    overflow: hidden;
    padding: 15px 0;
}

.carousel {
    display: flex;
    transition: transform 0.5s ease-in-out;
}

.carousel img {
    width: 230px;       /* TAMANHO DA IMAGEM */
    height: 230px;
    object-fit: cover;
    border-radius: 20px;
    margin-right: 25px; /* espaçamento entre as imagens */
}

/* Botões */
.nav {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background: #ff7b7b;
    color: white;
    border: none;
    font-size: 35px;
    width: 55px;
    height: 55px;
    border-radius: 50%;
    cursor: pointer;
    opacity: 0.85;
    transition: 0.3s;
    z-index: 10;
}

.nav:hover {
    opacity: 1;
}

.prev {
    left: -10px;
}

.next {
    right: -10px;
}


     .side-menu {
       position: fixed;
       top: 0;
       left: -250px;
       width: 250px;
       height: 100%;
       background-color: #fff8f8;
       box-shadow: 2px 0 5px rgba(0,0,0,0.2);
       padding: 2rem 1rem;
       transition: left 0.3s ease;
       z-index: 1001;
       border-right: 2px solid #ffb5b5;
     }

     .side-menu h2 {
       font-family: 'Pacifico', cursive;
       font-size: 1.8rem;
       color: #f08a8a;
       margin-bottom: 1.5rem;
       text-align: center;
     }

     .side-menu ul {
       list-style: none;
     }

     .side-menu li {
       padding: 0.8rem 1rem;
       font-size: 1rem;
       cursor: pointer;
       font-weight: bold;
       color: #333;
       transition: background-color 0.2s ease;
       border-radius: 8px;
     }

     .side-menu li:hover {
       background-color: #ffb5b5;
       color: white;
     }

     .side-menu .submenu {
       margin-left: 1rem;
       margin-top: 0.5rem;
       font-weight: normal;
     }

     .side-menu .submenu li {
       font-size: 0.9rem;
       padding: 0.5rem 1rem;
       color: #555;
     }

     .side-menu .submenu li:hover {
       background-color: #ffe0e0;
       color: #333;
     }

     .overlay {
       position: fixed;
       top: 0;
       left: 0;
       width: 100%;
       height: 100%;
       background: rgba(0,0,0,0.3);
       opacity: 0;
       visibility: hidden;
       z-index: 1000;
       transition: opacity 0.3s ease;
     }

     .menu-open .side-menu {
       left: 0;
     }

     .menu-open .overlay {
       opacity: 1;
       visibility: visible;
     }

     .search-bar button {
       background: none;
       border: none;
       color: #f08a8a;
       cursor: pointer;
     }

     .search-bar .search-icon {
       font-size: 1.2rem;
       color: #D17777;
       margin-right: 0.5rem;
     }

     .search-bar {
       display: flex;
       align-items: center;
       background-color: #eee9e3;
       border-radius: 10px;
       padding: 0.5rem 1rem;
       box-shadow: inset 0 2px 4px rgba(0,0,0,0.1);
       width: 100%;
       max-width: 500px;
     }

     .search-bar input {
       border: none;
       background: none;
       outline: none;
       padding: 0.25rem;
       flex-grow: 1;
       font-size: 1rem;
       color: #333;
     }

     /* Estilo para a sidebar do carrinho */
     .carrinho-sidebar {
       position: fixed;
       right: -400px; /* Esconde a sidebar por padrão */
       top: 0;
       width: 300px;
       height: 100%;
       background-color: #fff8f8;
       box-shadow: -2px 0 8px rgba(0,0,0,0.2);
       transition: right 0.3s ease;
       padding: 1rem;
       z-index: 999;
       display: flex;
       flex-direction: column;
     }

     .carrinho-sidebar.open {
       right: 0; /* Exibe a sidebar quando a classe .open é adicionada */
     }

     .carrinho-sidebar h2 {
       font-family: 'Pacifico', cursive;
       font-size: 1.8rem;
       color: #f08a8a;
       margin-bottom: 1.5rem;
       text-align: center;
     }

     .carrinho-itens-container {
       flex-grow: 1;
       overflow-y: auto;
     }

     .cart-item {
       display: flex;
       gap: 0.5rem;
       margin-bottom: 1rem;
       align-items: center;
       background-color: #ffe8e8;
       padding: 0.5rem;
       border-radius: 10px;
     }

     .cart-item img {
       width: 50px;
       height: 50px;
       border-radius: 5px;
       object-fit: cover;
     }

     .cart-item-info {
       flex-grow: 1;
     }

     .remove-item-btn {
       background: none;
       border: none;
       color: #D17777;
       font-size: 1.2rem;
       cursor: pointer;
     }

     .finalizar-compra-btn {
       background-color: #D17777;
       color: white;
       border: none;
       padding: 0.75rem 1.5rem;
       border-radius: 20px;
       cursor: pointer;
       font-weight: bold;
       text-transform: uppercase;
       margin-top: 1rem;
       width: 100%;
     }

     .cart-icon {
       font-size: 1.5rem;
       cursor: pointer;
     }
  </style>
</head>
<body>
  <header>
    <div class="menu-icon">☰</div>
    <div class="logo">Cantinho Doce</div>
    <form action="produtos.php" method="get" class="search-bar">
      <i class="fas fa-search search-icon"></i>
      <input type="text" placeholder="Pesquisar..." name="search">
    </form>
    <div class="login">
      <span>👤</span> <p>Bem vindo, <?= $_SESSION['usuario']?>
    </div>
    <div class="cart-icon" id="cart-toggle">🛒</div>
  </header>

  <div class="background-pattern"></div>

  <section class="main-banner">
    <h1>Cantinho Doce</h1>
    <p class="subtext">Com todo o carinho e qualidade, feitos para você! Adoçando sua vida todos os dias</p>
    <p class="price">Pedidos a partir de R$15,00</p>
  </section>

<br><br><br><div class="container-botoes">
    <a href="produtos.php?categoria=doces"><button class="categories">DOCES</button></a>
    <a href="produtos.php?categoria=salgados"><button class="categories">SALGADOS</button></a>
    <a href="produtos.php?categoria=bebidas"><button class="categories">BEBIDAS</button></a>
</div>

<div class="carousel-container">
    <button class="nav prev">&#10094;</button>

    <div class="carousel">
        <img src="imagens\download.jpg" alt="">
        <img src="imagens\Imagem do WhatsApp de 2025-05-27 à(s) 09.14.17_282bdbf6.jpg" alt="">
        <img src="imagens\Quais_são_os_melhores_acompanhamentos_para_açai-1024x559.png.webp" alt="">
        <img src="imagens\Imagem do WhatsApp de 2025-05-27 à(s) 09.14.21_e0480e23.jpg" alt="">
        <img src="imagens\Imagem-ilustrativa-de-bolo-de-cenoura.webp" alt="">
        <img src="imagens\uploads6841826072508_Imagem do WhatsApp de 2025-05-27 à(s) 09.14.19_7acc6e57.jpg" alt="">
        <img src="uploads/download.jpeg" alt="">
        <img src="uploads/download (1).jpeg" alt="">
        <img src="uploads/download (2).jpeg" alt="">
        <img src="uploads/download (3).jpeg" alt="">
        <img src="uploads/download (4).jpeg" alt="">
        <img src="uploads/images.jpeg" alt="">
    </div>

    <button class="nav next">&#10095;</button>
</div>


  <div class="background-pattern"></div>

  <section style="background-color: #ece6e6; margin: 2rem auto; padding: 2rem; max-width: 600px; border-radius: 30px; text-align: center;">
    <h2 style="font-family: 'Pacifico', cursive; font-size: 2rem; margin-bottom: 1rem;">Horários</h2>
    <div style="display: flex; justify-content: space-between; font-size: 1rem; font-weight: bold;">
      <div style="text-align: left;">
        <p>Domingo</p>
        <p>Segunda</p>
        <p>Terça</p>
        <p>Quarta</p>
        <p>Quinta</p>
        <p>Sexta</p>
        <p>Sábado</p>
      </div>
      <div>
        <p>13:00 - 17:00</p>
        <p>Fechado</p>
        <p>Fechado</p>
        <p>14:30 - 20:00</p>
        <p>13:00 - 18:00</p>
        <p>14:30 - 20:00</p>
        <p>14:30 - 20:00</p>
      </div>
    </div>
  </section>

  <div id="sideMenu" class="side-menu">
    <h2>Cantinho Doce</h2>
    <ul>
      <li>Contato</li>
      <li>Instagram</li>
      <li>Whatsapp</li>
      <li>E-mail</li>
      <li>Dúvidas</li>
      <li>
        Pagamento
        <ul class="submenu">
          <li>PIX</li>
          <li>Cartão de Crédito</li>
          <li>Cartão de Débito</li>
          <li>Dinheiro</li>
        </ul>
      </li>
      <li>
        Entrega
        <ul class="submenu">
          <li>Motoboy</li>
          <li>Retirada</li>
        </ul>
      </li>
    </ul>
    <li>
      ADM
      <ul class="submenu">
        <li><a href="painel-usuario.php" target= "_blank">banco de dados</a></li>
    </ul>
  </div>
  <div class="overlay" onclick="toggleMenu()"></div>

  <div id="carrinhoSidebar" class="carrinho-sidebar">
    <button onclick="toggleCarrinho()" style="background: none; border: none; font-size: 1.5rem; float: right; cursor: pointer;">×</button>
    <h2 style="font-family: 'Pacifico', cursive;">Seu carrinho</h2>
    <div class="carrinho-itens-container" id="listaCarrinho">
      </div>
    <hr style="border-top: 1px dashed #D17777; margin: 1rem 0;">
    <p style="font-weight: bold; font-size: 1.2rem; display: flex; justify-content: space-between;">Total: R$ <span id="totalCarrinho">0.00</span></p>
    <button class="finalizar-compra-btn">Finalizar Compra</button>
  </div>

  <footer style="background-color: #c97b7b; color: black; padding: 1.5rem; text-align: center; font-size: 1.2rem; font-weight: bold; border-radius: 40px 40px 0 0;">
    <span style="margin-right: 0.5rem;">📍</span>
    <a href="https://www.google.com/maps/place/Rua+Gastão+Bousquet,+474+-+Vila+S%C3%A3o+Jorge,+Santos" 
       target="_blank" 
       style="color: black; text-decoration: underline;">
      Rua Gastão Bousquet, nº474, Vila São Jorge - Santos, SP
    </a>
  </footer>

  <script>
function toggleMenu() {
       document.body.classList.toggle('menu-open');
   }

   // Variável para armazenar o estado do carrinho
   let cart = JSON.parse(localStorage.getItem('cart')) || [];

   function renderizarCarrinho() {
       const listaCarrinho = document.getElementById('listaCarrinho');
       const totalCarrinhoSpan = document.getElementById('totalCarrinho');
       listaCarrinho.innerHTML = '';
       let total = 0;

       if (cart && cart.length > 0) { // Verifica se o carrinho não está vazio
           cart.forEach(item => {
               if (item && item.nome && item.preco) { // Verifica se os dados do item existem
                   const itemDiv = document.createElement('div');
                   itemDiv.classList.add('cart-item');
                   const preco = parseFloat(item.preco) || 0;
                   const imagemSrc = item.imagem || 'https://via.placeholder.com/50/ffb5b5/000?Text=Sem+Imagem'; // Placeholder para imagem
                   itemDiv.innerHTML = `
                       <img src="${imagemSrc}" alt="${item.nome}" onerror="this.src='https://via.placeholder.com/50/ffb5b5/000?Text=Sem+Imagem'">
                       <div class="cart-item-info">
                           <h4>${item.nome}</h4>
                           <p>R$ ${preco.toFixed(2).replace('.', ',')}</p>
                       </div>
                   `;
                   listaCarrinho.appendChild(itemDiv);
                   total += preco;
               }
           });
       } else {
           listaCarrinho.innerHTML = '<p style="text-align: center; color: #888;">Seu carrinho está vazio.</p>';
       }

       totalCarrinhoSpan.textContent = total.toFixed(2).replace('.', ',');
   }

   function toggleCarrinho() {
       const carrinho = document.getElementById('carrinhoSidebar');
       carrinho.classList.toggle('open');
       renderizarCarrinho();
   }

   document.querySelector('.menu-icon').addEventListener('click', toggleMenu);
   document.querySelector('.cart-icon').addEventListener('click', toggleCarrinho);

   renderizarCarrinho();

   const carousel = document.querySelector(".carousel");
const images = document.querySelectorAll(".carousel img");
const imgWidth = 260 + 25; // largura da imagem + margem direita
const visibleImages = 3;   // QUANTAS IMAGENS MOSTRAR
let currentIndex = 0;

// quantos "cliques" possíveis existem
const maxIndex = Math.ceil(images.length / visibleImages) - 1;

function updateCarousel() {
    const offset = -(imgWidth * visibleImages) * currentIndex;
    carousel.style.transform = `translateX(${offset}px)`;
}

document.querySelector(".next").onclick = () => {
    if (currentIndex < maxIndex) {
        currentIndex++;
        updateCarousel();
    }
};

document.querySelector(".prev").onclick = () => {
    if (currentIndex > 0) {
        currentIndex--;
        updateCarousel();
    }
};


  </script>
</body>
</html>