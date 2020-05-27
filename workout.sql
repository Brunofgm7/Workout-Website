-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 27-Maio-2020 às 23:22
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
-- Estrutura da tabela `exercicios`
--

CREATE TABLE `exercicios` (
  `id_exerc` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `series_rep` varchar(255) NOT NULL,
  `dificuldade` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `exercicios`
--

INSERT INTO `exercicios` (`id_exerc`, `nome`, `series_rep`, `dificuldade`) VALUES
(1, 'Supino ', '3x12', 'medio'),
(2, 'Bicep com halteres', '3x10', 'facil'),
(3, 'Corrida', '2x40', 'dificil'),
(4, 'crunch', '3x30', 'medio'),
(5, 'Prancha', '3x1min', 'extremo');

-- --------------------------------------------------------

--
-- Estrutura da tabela `exerc_treinos`
--

CREATE TABLE `exerc_treinos` (
  `id_exerc` int(11) NOT NULL,
  `id_treinos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `exerc_treinos`
--

INSERT INTO `exerc_treinos` (`id_exerc`, `id_treinos`) VALUES
(1, 1),
(2, 1),
(3, 3),
(4, 2),
(5, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `treinos`
--

CREATE TABLE `treinos` (
  `id_treinos` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `treinos`
--

INSERT INTO `treinos` (`id_treinos`, `nome`) VALUES
(1, 'Segunda'),
(2, 'Terça'),
(3, 'Corrida');

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
(39, 'brunofgm7', 'bruno', 'bruno7moreira@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '2020-05-03', 0, 1, 'e3f1e31fe6514c5de04995b7b04f0471', 'fotos/perfil_brunofgm7.jpg', 'f'),
(44, 'dias', 'dias', 'dragaonuno98@hotmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '2020-05-03', 0, 0, 'e14629297152fac1184da282533a9e00', 'fotos/stock.jpg', 'f'),
(45, 'leo', 'leo', 'leonardo-t-oliveira@hotmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '2020-05-27', 0, 1, 'caaccf93e8def9296f858dd4616caf01', 'fotos/stock.jpg', NULL),
(47, 'bruno', 'bruno', 'dadsa@gmail.com', '', '2020-05-03', 0, 0, '4de1c9c7b0a1516945bf075bcf95540f', 'fotos/stock.jpg', 'm');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `exercicios`
--
ALTER TABLE `exercicios`
  ADD PRIMARY KEY (`id_exerc`);

--
-- Índices para tabela `exerc_treinos`
--
ALTER TABLE `exerc_treinos`
  ADD KEY `id_exerc` (`id_exerc`),
  ADD KEY `id_treinos` (`id_treinos`);

--
-- Índices para tabela `treinos`
--
ALTER TABLE `treinos`
  ADD PRIMARY KEY (`id_treinos`);

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
-- AUTO_INCREMENT de tabela `exercicios`
--
ALTER TABLE `exercicios`
  MODIFY `id_exerc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `treinos`
--
ALTER TABLE `treinos`
  MODIFY `id_treinos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `utilizadores`
--
ALTER TABLE `utilizadores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `exerc_treinos`
--
ALTER TABLE `exerc_treinos`
  ADD CONSTRAINT `exerc_treinos_ibfk_1` FOREIGN KEY (`id_exerc`) REFERENCES `exercicios` (`id_exerc`),
  ADD CONSTRAINT `exerc_treinos_ibfk_2` FOREIGN KEY (`id_treinos`) REFERENCES `treinos` (`id_treinos`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
