-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 21-Set-2019 às 23:32
-- Versão do servidor: 10.3.16-MariaDB
-- versão do PHP: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `ranking`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `alunos`
--

CREATE TABLE `alunos` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `categoria` int(11) NOT NULL DEFAULT 1,
  `curso` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `serie` int(3) DEFAULT 1,
  `media` double NOT NULL DEFAULT 6
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `alunos`
--

INSERT INTO `alunos` (`id`, `nome`, `categoria`, `curso`, `serie`, `media`) VALUES
(3, 'christian', 3, 'informática', 2, 8.5),
(8, 'Gabriel Costa Lavor', 4, 'Comercio', 2, 9.8),
(9, 'Ana Fabricia', 3, 'informática', 2, 9),
(10, 'Marcos Justino', 4, 'informática', 2, 9.9),
(11, 'Mariana ', 2, 'informática', 2, 6.8),
(12, 'Guilherme', 4, 'informática', 2, 9.9),
(13, 'Aderlan ', 3, 'informática', 2, 8.4),
(14, 'ellen ', 1, 'informática', 2, 5.8),
(15, 'Luna', 1, 'informática', 2, 2),
(16, 'Ronald', 4, 'informática', 2, 10),
(17, 'Vinicius ', 4, 'informática', 2, 9.7),
(18, 'Aldenir', 2, 'informática', 2, 7.5),
(19, 'Gaby ', 4, 'informática', 1, 10),
(20, 'Pedro Lucax', 3, 'Redes de Computadores', 3, 8.8);

-- --------------------------------------------------------

--
-- Estrutura da tabela `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `notaLimite` double NOT NULL,
  `notaMinima` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `categorias`
--

INSERT INTO `categorias` (`id`, `nome`, `notaLimite`, `notaMinima`) VALUES
(1, 'bronze', 5.9, 0),
(2, 'prata', 7.9, 6),
(3, 'ouro', 9, 8),
(4, 'diamante', 10, 9.1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `email` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `senha` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `email`, `senha`) VALUES
(3, 'admin@gmail.com', 'admin'),
(4, 'olegarioifce@gmail.com', 'olestark'),
(6, 'christianferreira652@gmail.com', 'mãe');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `alunos`
--
ALTER TABLE `alunos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `alunos`
--
ALTER TABLE `alunos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de tabela `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
