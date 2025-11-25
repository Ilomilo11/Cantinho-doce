<?php
// Inclui o arquivo de conexão com o banco de dados
include 'conexao.php';

// Inicia a sessão para verificar o usuário
session_start();

// Pega o termo de pesquisa se ele existir na URL
$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';

// Prepara a consulta SQL de forma segura
if (!empty($searchTerm)) {
    // Usa placeholders para prevenir SQL Injection
    $sql = "SELECT * FROM produtos WHERE nome LIKE ? OR descricao LIKE ?";
    $stmt = mysqli_prepare($conexao, $sql);
    
    // Cria o valor do termo de pesquisa para o LIKE
    $likeSearchTerm = "%" . $searchTerm . "%";
    
    // Vincula os parâmetros à consulta preparada
    mysqli_stmt_bind_param($stmt, "ss", $likeSearchTerm, $likeSearchTerm);
    mysqli_stmt_execute($stmt);
    
    // Obtém o resultado
    $resultado = mysqli_stmt_get_result($stmt);
} else {
    $sql = "SELECT * FROM produtos";
    $resultado = mysqli_query($conexao, $sql);
}


// Recebe categoria da URL
$categoria = isset($_GET['categoria']) ? $_GET['categoria'] : 'todos';

if ($categoria !== 'todos') {
    $sql = "SELECT * FROM produtos WHERE categoria = ?";
    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, "s", $categoria);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
} else {
    // Caso selecione "todos"
    $sql = "SELECT * FROM produtos";
    $resultado = mysqli_query($conexao, $sql);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cantinho Doce - Produtos</title>
  <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Chonburi&display=swap" rel="stylesheet">
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
      display: flex;
      flex-direction: column;
      min-height: 100vh;
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

    .header-left, .header-right {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .logo {
      font-family: 'Pacifico', cursive;
      font-size: 1.5rem;
      color:rgb(0, 0, 0);
    }

    /* Estilo da nova barra de pesquisa */
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

    .cart-icon, .user-icon {
        font-size: 1.5rem;
        cursor: pointer;
        color: #f08a8a;
    }

    .main-container {
      display: flex;
      flex-grow: 1;
      padding: 1rem;
      gap: 1rem;
    }
    
    @media (max-width: 768px) {
        .main-container {
            flex-direction: column;
            gap: 2rem;
        }
        .sidebar {
            width: 100%;
        }
    }

    .sidebar {
      background-color: #fff8f8;
      width: 250px;
      padding: 1rem;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }

    /* Estilo da caixa de seleção de categorias */
    .category-filter {
      padding: 1rem;
      border-radius: 10px;
      background-color: #fff8f8;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
      margin-bottom: 1rem;
    }
    
    .category-filter label {
      display: block;
      font-family: 'Chonburi', cursive;
      font-size: 1.2rem;
      color: #D17777;
      margin-bottom: 0.5rem;
      font-family: Arial, sans-serif;
    }

    .category-filter select {
      width: 100%;
      padding: 0.75rem;
      border: 2px solid #D17777;
      border-radius: 8px;
      background-color: #ffe8e8;
      font-size: 1rem;
      color: #333;
      cursor: pointer;
      -webkit-appearance: none;
      -moz-appearance: none;
      appearance: none;
      background-image: url('data:image/svg+xml;utf8,<svg fill="%23D17777" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><path d="M7 10l5 5 5-5z"/><path d="M0 0h24v24H0z" fill="none"/></svg>');
      background-repeat: no-repeat;
      background-position: right 10px center;
    }

    .produtos-container {
      flex-grow: 1;
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
      gap: 1.5rem;
      padding: 1rem;
      justify-items: center;
    }

    .produto-card {
      background-color:rgb(252, 209, 209);;
      border-radius: 15px;
      padding: 1rem;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
      display: flex;
      flex-direction: column;
      align-items: center;
      width: 100%;
      max-width: 300px;
      position: relative;
    }
    
    .produto-card img {
      width: 100%;
      height: 150px;
      object-fit: cover;
      border-radius: 10px;
      margin-bottom: 0.5rem;
      border: 2px solid #ffb5b5;
    }

    .produto-info {
        text-align: center;
        flex-grow: 1;
        width: 100%;
    }

    .produto-info h3 {
      font-family: 'Chonburi', cursive;
      font-size: 1.2rem;
      color: #333;
      margin: 0.5rem 0;
      font-family: Arial, sans-serif;
    }
    
    .produto-info .descricao {
        font-size: 0.8rem;
        color: #555;
        margin-bottom: 0.5rem;
    }

    .produto-info .preco {
      font-weight: bold;
      font-size: 1.1rem;
      color:rgb(211, 109, 109);
      margin: 0.5rem 0;
    }

    .add-to-cart-btn {
        background-color: #D17777;
        color: white;
        border: none;
        padding: 0.75rem 1.5rem;
        border-radius: 20px;
        cursor: pointer;
        font-weight: bold;
        text-transform: uppercase;
        margin-top: 1rem;
    }
    
    .carrinho-sidebar-container {
      position: fixed;
      right: 0;
      top: 0;
      height: 100%;
      width: 300px;
      transition: transform 0.3s ease-in-out;
      transform: translateX(100%);
      z-index: 100;
    }
    
    .carrinho-sidebar-container.open {
      transform: translateX(0);
    }

    .carrinho-sidebar {
      background-color: #fff8f8;
      width: 100%;
      height: 100%;
      padding: 1rem;
      box-shadow: -2px 0 8px rgba(0,0,0,0.2);
      display: flex;
      flex-direction: column;
    }

    .carrinho-sidebar h2 {
      font-family: 'Pacifico', cursive;
      font-size: 1.8rem;
      color: #f08a8a;
      margin-bottom: 1.5rem;
      text-align: center;
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

    .cart-item-info h4 {
        font-size: 1rem;
        font-family: 'Chonburi', cursive;
    }

    .cart-item-info p {
        font-size: 0.9rem;
    }
    
    .remove-item-btn {
        background: none;
        border: none;
        color: #D17777;
        font-size: 1.2rem;
        cursor: pointer;
    }
    
    .carrinho-itens-container {
        flex-grow: 1;
        overflow-y: auto;
    }

    footer {
      background-color: #c97b7b;
      color: black;
      padding: 1.5rem;
      text-align: center;
      font-size: 1.2rem;
      font-weight: bold;
      border-radius: 40px 40px 0 0;
      margin-top: auto;
    }

      a {
       color: black;
       text-decoration: none;
       margin: 20px
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

     /* === Modal Detalhes do Produto === */
.modal {
  display: none;
  position: fixed;
  z-index: 9999;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0,0,0,0.5);
  justify-content: center;
  align-items: center;
  animation: fadeIn 0.3s ease;
}

.modal-content {
  background-color: #fff8f8;
  border-radius: 15px;
  padding: 1.5rem;
  width: 90%;
  max-width: 500px;
  box-shadow: 0 4px 20px rgba(0,0,0,0.3);
  position: relative;
  animation: slideUp 0.3s ease;
  text-align: center;
}

.modal-content img {
  width: 100%;
  height: 200px;
  border-radius: 10px;
  object-fit: cover;
  margin-bottom: 1rem;
}

.modal-close {
  position: absolute;
  top: 10px;
  right: 15px;
  font-size: 1.5rem;
  color: #D17777;
  cursor: pointer;
  font-weight: bold;
}

.star-rating {
  display: flex;
  justify-content: center;
  margin: 1rem 0;
}

.star-rating i {
  font-size: 1.8rem;
  color: #ccc;
  cursor: pointer;
  transition: color 0.2s;
}

.star-rating i.active {
  color: #FFD700;
}

@keyframes fadeIn {
  from { opacity: 0; }
  to { opacity: 1; }
}

@keyframes slideUp {
  from { transform: translateY(50px); opacity: 0; }
  to { transform: translateY(0); opacity: 1; }
}


  </style>
</head>
<body>
  <header>
  <div class="menu-icon">☰</div>
    <div class="header-left">
        <div class="logo">Cantinho Doce</div>
    </div>

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
  </div>
  <div class="overlay" onclick="toggleMenu()"></div>

    <a href="pagina_inicial.php">Home</a>
    <form action="produtos.php" method="get" class="search-bar">
        <button type="submit" aria-label="Pesquisar">
            <i class="fas fa-search search-icon"></i>
        </button>
        <input type="text" placeholder="Pesquisar..." name="search" value="<?= htmlspecialchars($searchTerm) ?>">
    </form>
    <div class="header-right">
    <br><div class="login">
      <span>👤</span>
      <a href="login.php">Login</a>
    </div></br>
        <br><div class="cart-icon" id="cart-toggle">🛒</div></br>
    </div>
  </header>

  <main class="main-container">
    <div class="category-filter sidebar">
      <label for="category">Categorias</label>
      <select id="category" name="category">
        <option value="todos"   <?= $categoria == 'todos' ? 'selected' : '' ?>>Todos</option>
        <option value="salgados" <?= $categoria == 'salgados' ? 'selected' : '' ?>>Salgados</option>
        <option value="doces"    <?= $categoria == 'doces' ? 'selected' : '' ?>>Doces</option>
        <option value="bebidas"  <?= $categoria == 'bebidas' ? 'selected' : '' ?>>Bebidas</option>
        <option value="outros"   <?= $categoria == 'outros' ? 'selected' : '' ?>>Outros</option>
      </select>
    </div>

    

    <section class="produtos-container">
      <?php
      // Verifica se há produtos e os exibe
      if (mysqli_num_rows($resultado) > 0) {
          while ($produto = mysqli_fetch_assoc($resultado)) {
              echo '<div class="produto-card">';
              echo '<img src="' . htmlspecialchars($produto['imagem']) . '" alt="' . htmlspecialchars($produto['nome']) . '">';
              echo '<div class="produto-info">';
              echo '<h3>' . htmlspecialchars($produto['nome']) . '</h3>';
              echo '<p class="descricao">' . htmlspecialchars($produto['descricao']) . '</p>';
              echo '<p class="preco">R$ ' . number_format($produto['preco'], 2, ',', '.') . '</p>';
              echo '</div>';
              echo '<button class="add-to-cart-btn" 
                        data-id="' . htmlspecialchars($produto['id']) . '"
                        data-nome="' . htmlspecialchars($produto['nome']) . '"
                        data-preco="' . htmlspecialchars($produto['preco']) . '"
                        data-imagem="' . htmlspecialchars($produto['imagem']) . '">
                        <i class="fas fa-plus"></i> Adicionar Item
                      </button>';
              echo '</div>';
          }
      } else {
          echo '<p>Nenhum produto encontrado.</p>';
      }
      ?>


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
  </div>
  <div class="overlay" onclick="toggleMenu()"></div>
    
    <div class="carrinho-sidebar-container" id="carrinhoSidebar">
      <div class="carrinho-sidebar">
        <button onclick="document.getElementById('carrinhoSidebar').classList.remove('open')" style="background: none; border: none; font-size: 1.5rem; float: right; cursor: pointer; color: #D17777;">×</button>
        <h2>Seu Carrinho</h2>
        <div class="carrinho-itens-container" id="carrinho-itens">
          <p id="carrinho-vazio" style="text-align: center; color: #888;">Seu carrinho está vazio.</p>
        </div>
        <hr style="border-top: 1px dashed #D17777; margin: 1rem 0;">
        <p style="font-weight: bold; font-size: 1.2rem; display: flex; justify-content: space-between;">Valor Total: <span id="totalCarrinho">R$ 0,00</span></p>
        <button class="add-to-cart-btn" style="width: 100%;" onclick="window.location.href='confirmar-compra.php'">
    Finalizar Compra
</button>



      </div>
    </div>
  </main>

  <footer>
    <span style="margin-right: 0.5rem;">📍</span>
    <a href="https://www.google.com/maps/place/Rua+Gastão+Bousquet,+474+-+Vila+S%C3%A3o+Jorge,+Santos" 
       target="_blank" 
       style="color: black; text-decoration: underline;">
      Rua Gastão Bousquet, nº474, Vila São Jorge - Santos, SP
    </a>
  </footer>

  <script>
/* ======= Script robusto para carrinho + modal + avaliação ======= */
document.addEventListener('DOMContentLoaded', () => {
  // elementos do carrinho (com checagens)
  const carrinhoSidebar = document.getElementById('carrinhoSidebar');
  const carrinhoItensContainer = document.getElementById('carrinho-itens');
  const totalCarrinhoSpan = document.getElementById('totalCarrinho');
  const carrinhoVazioMsg = document.getElementById('carrinho-vazio');
  const cartToggleBtn = document.getElementById('cart-toggle');

  // inicializa carrinho
  let cart = JSON.parse(localStorage.getItem('cart')) || [];

  function renderizarCarrinho() {
    if (!carrinhoItensContainer || !totalCarrinhoSpan) return;
    carrinhoItensContainer.innerHTML = '';
    let total = 0;
    if (cart.length === 0) {
      carrinhoVazioMsg && (carrinhoVazioMsg.style.display = 'block');
    } else {
      carrinhoVazioMsg && (carrinhoVazioMsg.style.display = 'none');
      cart.forEach(item => {
        const itemDiv = document.createElement('div');
        itemDiv.classList.add('cart-item');
        const imagemSrc = item.imagem || 'https://placehold.co/50x50/ffb5b5/000?text=Produto';
        const preco = parseFloat(item.preco) || 0;
        itemDiv.innerHTML = `
          <img src="${imagemSrc}" alt="${item.nome}" onerror="this.src='https://placehold.co/50x50/ffb5b5/000?text=Produto'">
          <div class="cart-item-info">
            <h4>${item.nome}</h4>
            <p>R$ ${preco.toFixed(2).replace('.', ',')}</p>
          </div>
          <button class="remove-item-btn" data-id="${item.id}" aria-label="Remover item">
            <i class="fas fa-times-circle"></i>
          </button>
        `;
        carrinhoItensContainer.appendChild(itemDiv);
        total += preco;
      });
    }
    totalCarrinhoSpan.textContent = `R$ ${total.toFixed(2).replace('.', ',')}`;
  }

  function salvarCart() {
    localStorage.setItem('cart', JSON.stringify(cart));
  }

  function adicionarItem(id, nome, preco, imagem) {
    const precoNum = parseFloat(preco) || 0;
    const itemExistente = cart.find(item => item.id === id);
    if (itemExistente) {
      // se quiser quantidade, aqui você pode incrementar
      return;
    } else {
      cart.push({ id, nome, preco: precoNum, imagem });
    }
    salvarCart();
    renderizarCarrinho();
    carrinhoSidebar && carrinhoSidebar.classList.add('open');
  }

  function removerItem(id) {
    cart = cart.filter(item => item.id !== id);
    salvarCart();
    renderizarCarrinho();
  }

  // event delegation para botões "Adicionar Item" existentes e futuros
  document.body.addEventListener('click', (e) => {
    const btn = e.target.closest('.add-to-cart-btn');
    if (btn && btn.dataset && btn.dataset.id) {
      // extrai atributos (usa dataset para segurança)
      const id = btn.dataset.id;
      const nome = btn.dataset.nome || btn.getAttribute('data-nome') || 'Produto';
      const preco = btn.dataset.preco || btn.getAttribute('data-preco') || '0';
      const imagem = btn.dataset.imagem || btn.getAttribute('data-imagem') || '';
      adicionarItem(id, nome, preco, imagem);
      return;
    }

    // remover item dentro do carrinho
    if (e.target.closest('.remove-item-btn')) {
      const remBtn = e.target.closest('.remove-item-btn');
      const id = remBtn.getAttribute('data-id');
      if (id) removerItem(id);
      return;
    }
  });

  // abrir/fechar carrinho
  if (cartToggleBtn && carrinhoSidebar) {
    cartToggleBtn.addEventListener('click', () => {
      carrinhoSidebar.classList.toggle('open');
    });
  }

  // render inicial
  renderizarCarrinho();

  /* ======= Modal de detalhes e avaliação ======= */
  const modal = document.getElementById('produtoModal');
  const modalImagem = document.getElementById('modalImagem');
  const modalNome = document.getElementById('modalNome');
  const modalDescricao = document.getElementById('modalDescricao');
  const modalPreco = document.getElementById('modalPreco');
  const modalClose = modal ? modal.querySelector('.modal-close') || modal.querySelector('.modal-close') : null;
  const modalAddCarrinho = document.getElementById('modalAddCarrinho');
  let estrelas = []; // será preenchido após modal existir
  let produtoAtual = null;

  function atualizarEstrelasVisual(nota) {
    estrelas.forEach((el, i) => {
      if (i < nota) el.classList.add('active');
      else el.classList.remove('active');
    });
  }

  // delegação para abrir modal ao clicar na imagem OU no título H3
  document.body.addEventListener('click', (e) => {
    const clickedCard = e.target.closest('.produto-card');
    if (!clickedCard) return;

    const isImgOrTitle = (e.target.tagName === 'IMG') || (e.target.tagName === 'H3');
    if (!isImgOrTitle) return;

    // pega dados do card com checagens
    const idBtn = clickedCard.querySelector('.add-to-cart-btn');
    const id = idBtn ? idBtn.getAttribute('data-id') : clickedCard.getAttribute('data-id') || Date.now().toString();
    const nome = clickedCard.querySelector('h3') ? clickedCard.querySelector('h3').innerText.trim() : 'Produto';
    const descricaoEl = clickedCard.querySelector('.descricao');
    const descricao = descricaoEl ? descricaoEl.innerText.trim() : '';
    let precoText = clickedCard.querySelector('.preco') ? clickedCard.querySelector('.preco').innerText : 'R$ 0,00';
    precoText = precoText.replace('R$', '').replace(/\./g,'').replace(',', '.').trim();
    const imagem = clickedCard.querySelector('img') ? clickedCard.querySelector('img').src : '';

    produtoAtual = { id, nome, descricao, preco: parseFloat(precoText) || 0, imagem };

    if (!modal) return console.warn('Modal não encontrado no DOM.');

    // ======= Comentário de Avaliação =======
const comentarioInput = document.getElementById('comentarioProduto');
const comentarioSalvo = document.getElementById('comentarioSalvo');
const enviarComentarioBtn = document.getElementById('enviarComentario');

// carregar comentário salvo ao abrir modal
function carregarComentario(produtoId) {
  const comentario = localStorage.getItem(`comentario_${produtoId}`) || '';
  if (comentario) {
    comentarioSalvo.textContent = `"${comentario}"`;
    comentarioSalvo.style.display = 'block';
  } else {
    comentarioSalvo.style.display = 'none';
  }
  comentarioInput.value = comentario;
}

// quando abrir o modal, carrega comentário
document.body.addEventListener('click', (e) => {
  const clickedCard = e.target.closest('.produto-card');
  if (clickedCard && (e.target.tagName === 'IMG' || e.target.tagName === 'H3')) {
    setTimeout(() => {
      if (produtoAtual) carregarComentario(produtoAtual.id);
    }, 100);
  }
});

// salvar comentário
enviarComentarioBtn.addEventListener('click', () => {
  if (!produtoAtual) return;
  const texto = comentarioInput.value.trim();
  if (texto) {
    localStorage.setItem(`comentario_${produtoAtual.id}`, texto);
    comentarioSalvo.textContent = `"${texto}"`;
    comentarioSalvo.style.display = 'block';
    comentarioInput.value = '';
    alert('✅ Avaliação salva com sucesso!');
  } else {
    alert('Por favor, escreva algo antes de enviar.');
  }
});


    // preenche modal
    modalImagem.src = produtoAtual.imagem || 'https://placehold.co/600x400/ffb5b5/000?text=Produto';
    modalNome.textContent = produtoAtual.nome;
    modalDescricao.textContent = produtoAtual.descricao;
    modalPreco.textContent = `R$ ${produtoAtual.preco.toFixed(2).replace('.', ',')}`;

    // estrelas (captura os elementos agora que modal existe)
    estrelas = Array.from(document.querySelectorAll('#modalAvaliacao i'));

    // restaura avaliação salva
    const notaSalva = parseInt(localStorage.getItem(`avaliacao_${produtoAtual.id}`) || '0', 10);
    atualizarEstrelasVisual(notaSalva);

    // abre modal
    modal.style.display = 'flex';
    modal.setAttribute('aria-hidden', 'false');
  });

  // fechar modal: botão e clique fora
  if (modalClose) {
    modalClose.addEventListener('click', () => {
      modal.style.display = 'none';
      modal.setAttribute('aria-hidden', 'true');
    });
  }
  window.addEventListener('click', (e) => {
    if (modal && e.target === modal) {
      modal.style.display = 'none';
      modal.setAttribute('aria-hidden', 'true');
    }
  });

  // avaliação por estrelas (delegação)
  document.body.addEventListener('click', (e) => {
    const star = e.target.closest('#modalAvaliacao i');
    if (!star || !produtoAtual) return;
    const nota = parseInt(star.getAttribute('data-avaliacao'), 10) || 0;
    // atualiza visual
    estrelas = Array.from(document.querySelectorAll('#modalAvaliacao i'));
    atualizarEstrelasVisual(nota);
    // salva
    try {
      localStorage.setItem(`avaliacao_${produtoAtual.id}`, nota);
    } catch (err) {
      console.warn('Erro ao salvar avaliação:', err);
    }
  });

  // adicionar ao carrinho pelo modal
  if (modalAddCarrinho) {
    modalAddCarrinho.addEventListener('click', () => {
      if (!produtoAtual) return;
      adicionarItem(produtoAtual.id, produtoAtual.nome, produtoAtual.preco, produtoAtual.imagem);
      // fecha modal
      if (modal) {
        modal.style.display = 'none';
        modal.setAttribute('aria-hidden', 'true');
      }
    });
  }

  // DEBUG: mostra erros no console caso algo falhe cedo
  console.log('produtos.js: inicializado. Carrinho carregado com', cart.length, 'itens.');
});

function toggleMenu() {
       document.body.classList.toggle('menu-open');
   }
   document.querySelector('.menu-icon').addEventListener('click', toggleMenu);


document.getElementById("category").addEventListener("change", function() {
    const categoria = this.value;
    window.location.href = "produtos.php?categoria=" + categoria;
});
</script>

<!-- Modal Detalhes do Produto -->
<div id="produtoModal" class="modal" aria-hidden="true" role="dialog">
  <div class="modal-content" role="document">
    <button class="modal-close" aria-label="Fechar">&times;</button>
    <img id="modalImagem" src="" alt="Imagem do produto">
    <h2 id="modalNome"></h2>
    <p id="modalDescricao"></p>
    <p id="modalPreco" style="font-weight:bold; color:#D17777; font-size:1.2rem;"></p>

    <div class="star-rating" id="modalAvaliacao" aria-label="Avaliação">
      <i class="fas fa-star" data-avaliacao="1"></i>
      <i class="fas fa-star" data-avaliacao="2"></i>
      <i class="fas fa-star" data-avaliacao="3"></i>
      <i class="fas fa-star" data-avaliacao="4"></i>
      <i class="fas fa-star" data-avaliacao="5"></i>
    </div>

    <!-- Campo de texto para comentário -->
    <textarea id="comentarioProduto" placeholder="Escreva aqui o que achou do produto..." 
              style="width:100%; height:80px; padding:0.5rem; border-radius:8px; border:1px solid #f08a8a; margin-top:0.5rem; resize:none;"></textarea>
    
    <!-- Botão para salvar comentário -->
    <button id="enviarComentario" class="add-to-cart-btn" 
            style="background-color:#f08a8a; margin-top:0.5rem;">Enviar Avaliação</button>

    <!-- Exibição do comentário salvo -->
    <p id="comentarioSalvo" 
       style="margin-top:0.8rem; font-style:italic; color:#555; background:#fff0f0; border-radius:10px; padding:0.5rem; display:none;">
    </p>

    <button id="modalAddCarrinho" class="add-to-cart-btn">Adicionar ao Carrinho</button>
  </div>
</div>


</body>
</html>
