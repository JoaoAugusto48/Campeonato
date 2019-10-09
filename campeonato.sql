-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 03-Out-2019 às 03:23
-- Versão do servidor: 10.3.16-MariaDB
-- versão do PHP: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `campeonato`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `campeonato`
--

CREATE TABLE `campeonato` (
  `id` int(11) NOT NULL,
  `nequipe` int(11) NOT NULL,
  `turno` tinyint(1) NOT NULL,
  `nome` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `campeonato`
--

INSERT INTO `campeonato` (`id`, `nequipe`, `turno`, `nome`) VALUES
(1, 8, 1, 'Brasileirão');

-- --------------------------------------------------------

--
-- Estrutura da tabela `equipe`
--

CREATE TABLE `equipe` (
  `id` int(11) NOT NULL,
  `nome` varchar(30) NOT NULL,
  `sigla` varchar(3) NOT NULL,
  `idpais` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `equipe`
--

INSERT INTO `equipe` (`id`, `nome`, `sigla`, `idpais`) VALUES
(1, 'Corinthians', 'COR', 1),
(2, 'São Paulo', 'SPO', 1),
(5, 'Juventus', 'JUV', 7),
(6, 'Boca Juniors', 'BOC', 2),
(7, 'RB Leipzig', 'RBL', 5),
(8, 'Penarol', 'PEN', 8),
(9, 'Atlético de Madrid', 'ATM', 6),
(10, 'AC Milan', 'ACM', 7),
(11, 'River Plate', 'RIV', 2),
(13, 'Grêmio', 'GRE', 1),
(14, 'Napoli', 'NAP', 7),
(15, 'Barcelona', 'BAR', 6),
(16, 'Internacional', 'INT', 1),
(17, 'Chapecoense', 'CHA', 1),
(18, 'Sandra FC', 'SAN', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `estatistica`
--

CREATE TABLE `estatistica` (
  `id` int(11) NOT NULL,
  `vitoria` int(2) NOT NULL,
  `empate` int(2) NOT NULL,
  `derrota` int(2) NOT NULL,
  `golpro` int(3) NOT NULL,
  `golcontra` int(3) NOT NULL,
  `idequipe` int(11) NOT NULL,
  `idcampeonato` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `estatistica`
--

INSERT INTO `estatistica` (`id`, `vitoria`, `empate`, `derrota`, `golpro`, `golcontra`, `idequipe`, `idcampeonato`) VALUES
(1, 0, 0, 0, 0, 0, 6, 1),
(2, 0, 0, 0, 0, 0, 17, 1),
(3, 0, 0, 0, 0, 0, 1, 1),
(4, 0, 0, 0, 0, 0, 13, 1),
(5, 0, 0, 0, 0, 0, 16, 1),
(6, 0, 0, 0, 0, 0, 8, 1),
(7, 0, 0, 0, 0, 0, 18, 1),
(8, 0, 0, 0, 0, 0, 2, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `pais`
--

CREATE TABLE `pais` (
  `id` int(11) NOT NULL,
  `nome` varchar(25) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `pais`
--

INSERT INTO `pais` (`id`, `nome`, `status`) VALUES
(1, 'Brasil', 1),
(2, 'Argentina', 1),
(5, 'Alemanha', 1),
(6, 'Espanha', 1),
(7, 'Itália', 1),
(8, 'Uruguai', 1),
(9, 'Portugal', 1),
(10, 'Japão', 1),
(11, 'Paraguai', 1),
(15, 'Colombia', 1),
(16, 'Croacia', 1),
(17, 'Finlandia', 1),
(18, 'Venezuela', 1),
(29, 'Republica Tcheca', 1),
(33, 'Chile', 1),
(34, 'Teste', 1),
(35, 'teste2', 0),
(36, 'teste3', 1),
(37, 'teste2', 1),
(38, 'test4', 0),
(39, 'Egito', 1),
(40, 'Bolivia', 1),
(41, 'teste05', 0),
(42, 'teste06', 0),
(43, 'teste aksaks', 0),
(44, 'asdasfafs', 0),
(45, 'mais um', 1),
(46, 'teste, errei', 1),
(47, 'Estados Unidos', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `partida`
--

CREATE TABLE `partida` (
  `id` int(11) NOT NULL,
  `idcampeonato` int(11) NOT NULL,
  `timecasa` int(11) NOT NULL,
  `timevisitante` int(11) NOT NULL,
  `ngolcasa` int(2) NOT NULL,
  `ngolvisitante` int(2) NOT NULL,
  `rodada` int(2) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `partida`
--

INSERT INTO `partida` (`id`, `idcampeonato`, `timecasa`, `timevisitante`, `ngolcasa`, `ngolvisitante`, `rodada`, `status`) VALUES
(1, 1, 18, 8, 0, 0, 0, 0),
(2, 1, 16, 2, 0, 0, 0, 0),
(3, 1, 1, 6, 0, 0, 0, 0),
(4, 1, 13, 17, 0, 0, 0, 0),
(5, 1, 8, 16, 0, 0, 1, 0),
(6, 1, 6, 18, 0, 0, 1, 0),
(7, 1, 2, 13, 0, 0, 1, 0),
(8, 1, 17, 1, 0, 0, 1, 0),
(9, 1, 6, 8, 0, 0, 2, 0),
(10, 1, 13, 16, 0, 0, 2, 0),
(11, 1, 18, 17, 0, 0, 2, 0),
(12, 1, 1, 2, 0, 0, 2, 0),
(13, 1, 8, 13, 0, 0, 3, 0),
(14, 1, 17, 6, 0, 0, 3, 0),
(15, 1, 16, 1, 0, 0, 3, 0),
(16, 1, 2, 18, 0, 0, 3, 0),
(17, 1, 17, 8, 0, 0, 4, 0),
(18, 1, 1, 13, 0, 0, 4, 0),
(19, 1, 6, 2, 0, 0, 4, 0),
(20, 1, 18, 16, 0, 0, 4, 0),
(21, 1, 8, 1, 0, 0, 5, 0),
(22, 1, 2, 17, 0, 0, 5, 0),
(23, 1, 13, 18, 0, 0, 5, 0),
(24, 1, 16, 6, 0, 0, 5, 0),
(25, 1, 2, 8, 0, 0, 6, 0),
(26, 1, 18, 1, 0, 0, 6, 0),
(27, 1, 17, 16, 0, 0, 6, 0),
(28, 1, 6, 13, 0, 0, 6, 0),
(29, 1, 8, 18, 0, 0, 7, 0),
(30, 1, 2, 16, 0, 0, 7, 0),
(31, 1, 6, 1, 0, 0, 7, 0),
(32, 1, 17, 13, 0, 0, 7, 0),
(33, 1, 16, 8, 0, 0, 8, 0),
(34, 1, 18, 6, 0, 0, 8, 0),
(35, 1, 13, 2, 0, 0, 8, 0),
(36, 1, 1, 17, 0, 0, 8, 0),
(37, 1, 8, 6, 0, 0, 9, 0),
(38, 1, 16, 13, 0, 0, 9, 0),
(39, 1, 17, 18, 0, 0, 9, 0),
(40, 1, 2, 1, 0, 0, 9, 0),
(41, 1, 13, 8, 0, 0, 10, 0),
(42, 1, 6, 17, 0, 0, 10, 0),
(43, 1, 1, 16, 0, 0, 10, 0),
(44, 1, 18, 2, 0, 0, 10, 0),
(45, 1, 8, 17, 0, 0, 11, 0),
(46, 1, 13, 1, 0, 0, 11, 0),
(47, 1, 2, 6, 0, 0, 11, 0),
(48, 1, 16, 18, 0, 0, 11, 0),
(49, 1, 1, 8, 0, 0, 12, 0),
(50, 1, 17, 2, 0, 0, 12, 0),
(51, 1, 18, 13, 0, 0, 12, 0),
(52, 1, 6, 16, 0, 0, 12, 0),
(53, 1, 8, 2, 0, 0, 13, 0),
(54, 1, 1, 18, 0, 0, 13, 0),
(55, 1, 16, 17, 0, 0, 13, 0),
(56, 1, 13, 6, 0, 0, 13, 0);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `campeonato`
--
ALTER TABLE `campeonato`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `equipe`
--
ALTER TABLE `equipe`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idpais` (`idpais`);

--
-- Índices para tabela `estatistica`
--
ALTER TABLE `estatistica`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idcampeonato` (`idcampeonato`),
  ADD KEY `idtime` (`idequipe`);

--
-- Índices para tabela `pais`
--
ALTER TABLE `pais`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `partida`
--
ALTER TABLE `partida`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idcampeonato` (`idcampeonato`),
  ADD KEY `timecasa` (`timecasa`),
  ADD KEY `timevisitante` (`timevisitante`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `campeonato`
--
ALTER TABLE `campeonato`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `equipe`
--
ALTER TABLE `equipe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de tabela `estatistica`
--
ALTER TABLE `estatistica`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `pais`
--
ALTER TABLE `pais`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT de tabela `partida`
--
ALTER TABLE `partida`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `equipe`
--
ALTER TABLE `equipe`
  ADD CONSTRAINT `equipe_ibfk_1` FOREIGN KEY (`idpais`) REFERENCES `pais` (`id`);

--
-- Limitadores para a tabela `estatistica`
--
ALTER TABLE `estatistica`
  ADD CONSTRAINT `estatistica_ibfk_1` FOREIGN KEY (`idcampeonato`) REFERENCES `campeonato` (`id`),
  ADD CONSTRAINT `estatistica_ibfk_2` FOREIGN KEY (`idequipe`) REFERENCES `equipe` (`id`);

--
-- Limitadores para a tabela `partida`
--
ALTER TABLE `partida`
  ADD CONSTRAINT `partida_ibfk_1` FOREIGN KEY (`idcampeonato`) REFERENCES `campeonato` (`id`),
  ADD CONSTRAINT `partida_ibfk_2` FOREIGN KEY (`timecasa`) REFERENCES `equipe` (`id`),
  ADD CONSTRAINT `partida_ibfk_3` FOREIGN KEY (`timevisitante`) REFERENCES `equipe` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
