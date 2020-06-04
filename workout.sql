-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 04-Jun-2020 às 15:42
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
(21, 40, 'Supino reto', '3x12', 'dificil', 'fotosTreinosExercicios/exercicio_Supino reto_admin.jpg'),
(22, 40, 'Aberturas na máquina', '3x15', 'medio', 'fotosTreinosExercicios/exercicio_Aberturas na máquina_admin.jpg'),
(23, 40, 'Tricep testa', '12-10-8', 'dificil', 'fotosTreinosExercicios/exercicio_Tricep testa_admin.jpg'),
(24, 40, 'Tricep ', '3x10', 'medio', 'fotosTreinosExercicios/exercicio_Tricep _admin.jpg'),
(25, 40, 'Aberturas halteres', '3x10', 'dificil', 'fotosTreinosExercicios/exercicio_Aberturas halteres_admin.jpg'),
(26, 41, 'Bicep na barra', '3x12', 'dificil', 'fotosTreinosExercicios/exercicio_Bicep na barra_admin.jpg'),
(27, 41, 'Bicep martelo', '3x15', 'dificil', 'fotosTreinosExercicios/exercicio_Bicep martelo_admin.jpg'),
(28, 41, 'Bicep', '15-12-10', 'medio', 'fotosTreinosExercicios/exercicio_Bicep_admin.jpg'),
(29, 41, 'Remada Unilateral', '3x15', 'dificil', 'fotosTreinosExercicios/exercicio_Remada Unilateral_admin.jpg'),
(30, 41, 'Remada 45 graus', '3x12', 'medio', 'fotosTreinosExercicios/exercicio_Remada 45 graus_admin.jpg'),
(31, 42, 'Levantamento das ancas', '3x20', 'dificil', 'fotosTreinosExercicios/exercicio_Levantamento das ancas_admin.jpg'),
(32, 42, 'Agachamento', '3x30', 'dificil', 'fotosTreinosExercicios/exercicio_Agachamento_admin.jpg'),
(33, 42, 'Extensão de quadril ', '3x10', 'medio', 'fotosTreinosExercicios/exercicio_Extensão de quadril _admin.jpg'),
(34, 42, 'Lounge', '3x20', 'medio', 'fotosTreinosExercicios/exercicio_Lounge_admin.jpg'),
(35, 43, 'Bicicleta', '3x20', 'medio', 'fotosTreinosExercicios/exercicio_Bicicleta_admin.jpg'),
(36, 43, 'Barco', '1min', 'dificil', 'fotosTreinosExercicios/exercicio_Barco_admin.jpg'),
(37, 43, 'Russian Twist', '3x30', 'medio', 'fotosTreinosExercicios/exercicio_Russian Twist_admin.jpg'),
(38, 43, 'Prancha', '1min x 3', 'dificil', 'fotosTreinosExercicios/exercicio_Prancha_admin.jpg'),
(39, 43, 'Mountain Climbers', '3x20', 'medio', 'fotosTreinosExercicios/exercicio_Mountain Climbers_admin.jpg');

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
(40, 50, 'Treino de segunda', 'Peito e tricep', 'facil', 'fotosTreinosExercicios/treino_Treino de segunda_admin.jpg'),
(41, 50, 'Treino de quarta', 'Costas e Bicep', 'medio', 'fotosTreinosExercicios/treino_Treino de quarta_admin.jpg'),
(42, 50, 'BUMBUM Brasil', 'Bumbum', 'dificil', 'fotosTreinosExercicios/treino_BUMBUM Brasil_admin.jpg'),
(43, 50, 'Abs', 'Sixpack', 'medio', 'fotosTreinosExercicios/treino__admin.jpg');

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
(50, 'admin', 'admin', 'admin@admin.com', '21232f297a57a5a743894a0e4a801fc3', '2020-06-02', 2, 1, '0c0043f256d7828e6c48079cf9135650', 'fotos/stock.jpg', 'm');

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
  MODIFY `id_exerc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de tabela `treinos`
--
ALTER TABLE `treinos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT de tabela `utilizadores`
--
ALTER TABLE `utilizadores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

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
