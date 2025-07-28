<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cantinho Doce</title>
  <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
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

    .menu-icon, .cart-icon {
      font-size: 1.5rem;
      cursor: pointer;
      top: 20px; 
      right: 20px; 
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
      font-size: 1.5rem;
    }

    .login {
      display: flex;
      align-items: center;
      gap: 0.5rem;
      cursor: pointer;
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

    .categories {
      display: flex;
      justify-content: center;
      gap: 2rem;
      padding: 2rem;
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

    .carousel {
      display: flex;
      justify-content: center;
      align-items: center;
      gap: 1rem;
      padding: 2rem;
      position: relative;
      overflow-x: auto;
      max-width: 1000px;
      margin: 0 auto;
      overscroll-behavior-x: contain;
      scroll-snap-type: x mandatory;
    }

    .carousel-container {
      display: flex;
      transition: transform 0.5s ease;
      gap: 1.2rem;
      border: 5px;
      scroll-snap-align: center;
    }

    .carousel img {
      width: 250px;
      height: 300px;
      border-radius: 20px;
      object-fit: cover;
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

  </style>
</head>
<body>
  <header>
    <div class="menu-icon">☰</div>
    <div class="logo">Cantinho Doce</div>
    <div class="login">
      <span>👤</span>
      <a href="login.php">Login</a>
    </div>
    <div class="cart-icon">🛒 carrinho</div>
  </header>

  <div class="background-pattern"></div>

  <section class="main-banner">
    <h1>Cantinho Doce</h1>
    <p class="subtext">Com todo o carinho e qualidade, feitos para você! Adoçando sua vida todos os dias</p>
    <p class="price">Pedidos a partir de R$15,00</p>
  </section>

  <br><section class="categories">
    <button class="category-button">DOCES</button>
    <button class="category-button">SALGADOS</button>
    <button class="category-button">BEBIDAS</button>
  </section></br>

  <section class="carousel">
    <div class="carousel-container">
      <img src="imagens/Imagem do WhatsApp de 2025-05-27 à(s) 09.14.21_e0480e23.jpg" alt="Açai">
      <img src="imagens/Imagem do WhatsApp de 2025-05-27 à(s) 09.14.20_00b51bc1.jpg" alt="Brownie">
      <img src="imagens/Imagem do WhatsApp de 2025-05-27 à(s) 09.14.17_282bdbf6.jpg" alt="Pastel Assado">
      <img src="imagens\Quais_são_os_melhores_acompanhamentos_para_açai-1024x559.png.webp" alt="Pastel Assado">
      <img src="imagens/Imagem-ilustrativa-de-bolo-de-cenoura.webp" alt="Pastel Assado">
      <img src="imagens\download.jpg">
    </div>
  </section>

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
          <li>Correios</li>
          <li>Motoboy</li>
          <li>Retirada</li>
        </ul>
      </li>
    </ul>
  </div>
  <div class="overlay" onclick="toggleMenu()"></div>



  <!-- Sidebar do carrinho -->
  <div id="carrinhoSidebar" style="position: fixed; right: -400px; top: 0; width: 300px; height: 100%; background-color: #fff8f8; box-shadow: -2px 0 8px rgba(0,0,0,0.2); transition: right 0.3s ease; padding: 1rem; z-index: 999;">
    <button onclick="toggleCarrinho()" style="background: none; border: none; font-size: 1.5rem; float: right; cursor: pointer;">×</button>
    <h2 style="font-family: 'Pacifico', cursive;">Seu carrinho</h2>
    <ul id="listaCarrinho" style="list-style: none; padding: 0;">
      <!-- Itens do carrinho serão adicionados aqui -->
    </ul>
    <p style="margin-top: 1rem;"><strong>Total:</strong> R$ <span id="totalCarrinho">0.00</span></p>
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
    let currentSlide = 0;
    const slides = document.querySelectorAll('.carousel-container img');
    const totalSlides = slides.length;

    function updateCarousel() {
      const offset = -currentSlide * 260;
      document.querySelector('.carousel-container').style.transform = `translateX(${offset}px)`;
    }

    function nextSlide() {
      currentSlide = (currentSlide + 1) % totalSlides;
      updateCarousel();
    }

    function prevSlide() {
      currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
      updateCarousel();
    }

  function toggleMenu() {
    document.body.classList.toggle('menu-open');
  }

  function toggleCarrinho() {
      const carrinho = document.getElementById('carrinhoSidebar');
      const isOpen = carrinho.style.right === '0px';
      carrinho.style.right = isOpen ? '-400px' : '0px';
    }

  document.querySelector('.menu-icon').addEventListener('click', toggleMenu);

  document.querySelector('.cart-icon').addEventListener('click', toggleCarrinho);
  
  
  </script>
</body>
</html>