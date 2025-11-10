-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3366
-- Tempo de geração: 10/11/2025 às 18:23
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `cantinhodoce`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `produtos`
--

CREATE TABLE `produtos` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `descricao` varchar(300) NOT NULL,
  `imagem` varchar(255) NOT NULL,
  `categoria` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `produtos`
--

INSERT INTO `produtos` (`id`, `nome`, `preco`, `descricao`, `imagem`, `categoria`) VALUES
(1, 'torta de frango', 12.00, 'torta de frango', 'uploads/68ac5f0b44ac0_Imagem do WhatsApp de 2025-08-07 à(s) 11.20.49_29a2302d.jpg', 'salgados'),
(2, 'Bolo de chocolate', 12.00, 'bolo de chocolate', 'uploads/68ac5f1b041a8_download.jpeg', 'doces'),
(4, 'Bolo de laranja', 12.00, 'bolo de laranja', 'uploads/68ac5f438e30b_download (1).jpeg', 'doces'),
(6, 'brownie', 10.00, 'brownie', 'uploads/68aca51611cb6_9b703a9df7604abf863a3bd76aa6.jpg', 'doces'),
(7, 'Coxinha', 7.00, 'Coxinha de frango', 'uploads/68b04b5ae9535_coxinha-4161592_1920-scaled-1.webp', 'salgados'),
(9, 'coca cola', 9.00, 'coca cola ', 'uploads/68b04b96c7d06_images (2).jpeg', 'bebidas');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `ID` int(11) NOT NULL,
  `Nome` varchar(100) NOT NULL,
  `User` varchar(100) NOT NULL,
  `Senha` varchar(100) NOT NULL,
  `Nivel` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`ID`, `Nome`, `User`, `Senha`, `Nivel`) VALUES
(1, 'Paulo', 'pauloborges@gmail.com', '$2y$10$atUT97qZGf.pHezdAEjR2.OGf62MKfPrPv2UdcRQssp1f2aQH.55W', 1),
(2, 'Ana Júlia Oliveira Martins', 'anajulia.patins@gmail.com', '$2y$10$ZRcwATore8V7Y8cou/Z0p.nByG.0TJXW8ep5AdvfTjRDC2Z3VQLly', 2),
(3, 'Cleberson', 'lilianchagas@professor', '$2y$10$8eizCvjKEu3uSf8o8EGqWOXNd8gnV/Rn/CU2ZKuxsIpqi5/5zMXsW', 2),
(4, 'paulo borges tavares', 'pauloborges12@icloud.com', '$2y$10$2RCrklSqd0AhMMIecSFv/enAyY17PHNGgDDgkzH6NpJXZYI1B3mOS', 0);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
