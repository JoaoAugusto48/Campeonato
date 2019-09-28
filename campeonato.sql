-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 19-Set-2019 às 02:09
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
(1, 10, 0, 'Brasileirão'),
(2, 12, 0, 'serie a'),
(3, 12, 0, 'serie a'),
(4, 12, 0, 'serie a'),
(5, 12, 0, 'serie a'),
(6, 12, 0, 'serie a'),
(7, 8, 0, 'Serie A'),
(8, 8, 0, 'Serie A'),
(9, 8, 0, 'Serie A'),
(10, 8, 0, 'Serie A'),
(11, 8, 0, 'Serie A'),
(12, 8, 0, 'Serie A'),
(13, 4, 0, 'Super Liga'),
(14, 4, 0, 'Super Liga'),
(15, 4, 0, 'Super Liga'),
(16, 4, 0, 'Super Liga'),
(17, 4, 0, 'Super Liga'),
(18, 4, 0, 'Super Liga'),
(19, 4, 0, 'Super Liga'),
(20, 4, 0, 'Super Liga'),
(21, 4, 0, 'Super Liga'),
(22, 4, 0, 'Super Liga'),
(23, 4, 0, 'Super Liga'),
(24, 4, 0, 'Super Liga'),
(25, 4, 0, 'Super Liga'),
(26, 4, 0, 'Super Liga'),
(27, 4, 0, 'Super Liga'),
(28, 4, 0, 'Super Liga'),
(29, 4, 0, 'Amigos'),
(30, 12, 0, 'Teste'),
(31, 12, 0, 'Teste'),
(32, 12, 0, 'Teste'),
(33, 12, 0, 'Teste'),
(34, 12, 0, 'Teste'),
(35, 12, 0, 'Teste');

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
(16, 'Internacional', 'INT', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `estatistica`
--

CREATE TABLE `estatistica` (
  `id` int(11) NOT NULL,
  `vitoria` int(11) NOT NULL,
  `empate` int(11) NOT NULL,
  `derrota` int(11) NOT NULL,
  `golpro` int(11) NOT NULL,
  `golcontra` int(11) NOT NULL,
  `idequipe` int(11) NOT NULL,
  `idcampeonato` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(46, 'teste, errei', 1);

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
  `ngolvisitante` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de tabela `equipe`
--
ALTER TABLE `equipe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de tabela `estatistica`
--
ALTER TABLE `estatistica`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `pais`
--
ALTER TABLE `pais`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT de tabela `partida`
--
ALTER TABLE `partida`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
