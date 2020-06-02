-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 01-Jun-2020 às 23:38
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
-- Estrutura da tabela `certificado`
--

CREATE TABLE `certificado` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `certificado` longtext NOT NULL,
  `aprovado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `certificado`
--

INSERT INTO `certificado` (`id`, `username`, `email`, `certificado`, `aprovado`) VALUES
(12, 'brunofgm7', 'bruno7moreira@gmail.com', 'candidaturas/cand_brunofgm7_Invoices_2015116968_T5.pdf', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `exercicios`
--

CREATE TABLE `exercicios` (
  `id_exerc` int(11) NOT NULL,
  `id_treino` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `series_rep` varchar(255) NOT NULL,
  `dificuldade` varchar(255) NOT NULL,
  `imagem` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `exercicios`
--

INSERT INTO `exercicios` (`id_exerc`, `id_treino`, `nome`, `series_rep`, `dificuldade`, `imagem`) VALUES
(1, 19, 'Supino ', '3x12', 'medio', ''),
(2, 19, 'Bicep com halteres', '3x10', 'facil', ''),
(3, 19, 'Corrida', '2x40', 'dificil', ''),
(4, 23, 'crunch', '3x30', 'medio', ''),
(5, 23, 'Prancha', '3x1min', 'extremo', ''),
(6, 23, 'ex1', '3x15', 'facil', 'fotosTreinosExercicios/treino_ex1_brunofgm7.jpg'),
(9, 28, 'tetet', 'etetetete', 'dificil', 'fotosTreinosExercicios/treino_tetet_brunofgm7.jpg'),
(12, 28, 'fgadgad', 'fgafgsf', 'facil', 'fotosTreinosExercicios/treino_fgadgad_brunofgm7.jpg');

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
  `id` int(11) NOT NULL,
  `id_utilizador` int(11) NOT NULL,
  `titulo` varchar(50) NOT NULL,
  `descricao` text DEFAULT NULL,
  `dificuldade` text NOT NULL,
  `imagem` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `treinos`
--

INSERT INTO `treinos` (`id`, `id_utilizador`, `titulo`, `descricao`, `dificuldade`, `imagem`) VALUES
(23, 39, 'terça', 'pernas', 'dificil', 'fotosTreinosExercicios/treino_terça_brunofgm7.jpg'),
(28, 39, 'O meu treino de segunda', 'Treino de pernas e peito', 'dificil', 'fotosTreinosExercicios/treino_O meu treino de segunda_brunofgm7.jpg');

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
(39, 'brunofgm7', 'bruno', 'bruno7moreira@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '2020-05-03', 1, 1, 'e3f1e31fe6514c5de04995b7b04f0471', 'fotos/stock.jpg', NULL),
(45, 'leo', 'leo', 'leonardo-t-oliveira@hotmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '2020-05-27', 0, 1, 'caaccf93e8def9296f858dd4616caf01', 'fotos/stock.jpg', NULL),
(48, 'TheWarriorPT', 'Nuno2', 'dragaonuno98@hotmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '2020-05-01', 2, 0, '75532a3011ffb24f2fa628c0226e56e2', 'fotos/stock.jpg', 'f');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `certificado`
--
ALTER TABLE `certificado`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `exercicios`
--
ALTER TABLE `exercicios`
  ADD PRIMARY KEY (`id_exerc`);

--
-- Índices para tabela `exerc_treinos`
--
ALTER TABLE `exerc_treinos`
  ADD KEY `id_exerc` (`id_exerc`);

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
-- AUTO_INCREMENT de tabela `certificado`
--
ALTER TABLE `certificado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `exercicios`
--
ALTER TABLE `exercicios`
  MODIFY `id_exerc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `treinos`
--
ALTER TABLE `treinos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de tabela `utilizadores`
--
ALTER TABLE `utilizadores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

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
