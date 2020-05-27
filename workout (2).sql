-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 21-Maio-2020 às 16:57
-- Versão do servidor: 10.4.11-MariaDB
-- versão do PHP: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `workout`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `treinos`
--

CREATE TABLE `treinos` (
  `id` int(11) NOT NULL,
  `id_utilizador` int(11) NOT NULL,
  `titulo` varchar(50) NOT NULL,
  `descricao` text NOT NULL,
  `dificuldade` int(11) NOT NULL,
  `imagens` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `utilizadores`
--

CREATE TABLE `utilizadores` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(40) NOT NULL,
  `dataNasc` date NOT NULL,
  `tipoUtilizador` int(11) NOT NULL,
  `contaAtivada` int(11) NOT NULL,
  `chave` varchar(100) NOT NULL,
  `foto` longtext DEFAULT NULL,
  `genero` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `utilizadores`
--

INSERT INTO `utilizadores` (`id`, `username`, `nome`, `email`, `password`, `dataNasc`, `tipoUtilizador`, `contaAtivada`, `chave`, `foto`, `genero`) VALUES
(39, 'brunofgm7', 'bruno', 'bruno7moreira@gmail.com', '4297f44b13955235245b2497399d7a93', '2020-05-03', 0, 1, 'e3f1e31fe6514c5de04995b7b04f0471', 'fotos/stock.jpg', NULL),
(44, 'dias', 'dias', 'dragaonuno98@hotmail.com', '', '2020-05-03', 0, 0, 'e14629297152fac1184da282533a9e00', 'fotos/stock.jpg', 'f'),
(45, 'leo', 'leo', 'leonardo-t-oliveira@hotmail.com', 'e10adc3949ba59abbe56e057f20f883e', '2020-05-27', 0, 1, 'caaccf93e8def9296f858dd4616caf01', 'fotos/stock.jpg', NULL);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `treinos`
--
ALTER TABLE `treinos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_utilizador` (`id_utilizador`);

--
-- Índices para tabela `utilizadores`
--
ALTER TABLE `utilizadores`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`,`username`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `treinos`
--
ALTER TABLE `treinos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `utilizadores`
--
ALTER TABLE `utilizadores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `treinos`
--
ALTER TABLE `treinos`
  ADD CONSTRAINT `treinos_ibfk_1` FOREIGN KEY (`id_utilizador`) REFERENCES `utilizadores` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
