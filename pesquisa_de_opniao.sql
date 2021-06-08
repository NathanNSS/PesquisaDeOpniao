-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 24-Mar-2021 às 02:35
-- Versão do servidor: 10.4.14-MariaDB
-- versão do PHP: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `pesquisa_de_opniao`
--
CREATE DATABASE IF NOT EXISTS `pesquisa_de_opniao` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `pesquisa_de_opniao`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `enquete_simples_caracteres`
--

CREATE TABLE `enquete_simples_caracteres` (
  `Cod_Enquete_Simples_Caracteres` int(4) NOT NULL,
  `unico` varchar(20) NOT NULL,
  `private` varchar(20) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `titulo` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `data_criacao` datetime NOT NULL,
  `descricao` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `item1` varchar(255) NOT NULL,
  `item2` varchar(255) NOT NULL,
  `item3` varchar(255) NOT NULL,
  `item4` varchar(255) NOT NULL,
  `item5` varchar(255) NOT NULL,
  `item6` varchar(255) NOT NULL,
  `item7` varchar(255) NOT NULL,
  `item8` varchar(255) NOT NULL,
  `item9` varchar(255) NOT NULL,
  `item10` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `enquete_simples_caracteres`
--

INSERT INTO `enquete_simples_caracteres` (`Cod_Enquete_Simples_Caracteres`, `unico`, `private`, `id_user`, `titulo`, `data_criacao`, `descricao`, `item1`, `item2`, `item3`, `item4`, `item5`, `item6`, `item7`, `item8`, `item9`, `item10`) VALUES
(123, '', '', NULL, 'Titulo', '2021-03-24 00:00:00', 'Descrição', 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j'),
(321, '', '', NULL, 'Titulo', '2021-03-11 00:00:00', 'Descrição', 'fghjk', 'vbh', 'jd', 'vbhnjmk', 'cvbnm', 'xcvbnm', 'dfghjk', 'd', 'fghjk', 'dfghj'),
(121058, '', '', NULL, 'GG', '2021-03-10 00:00:00', 'GG', 'GG', 'GG', '', '', '', '', '', '', '', ''),
(146218, '', '', NULL, 'Moveis Para Casa', '2021-03-17 00:00:00', 'Ajude-me a escolher moveis para minha casa', 'sofá', 'cama', '', '', '', '', '', '', '', ''),
(199316, '', '', NULL, 'GGGGGGGg', '2021-03-06 00:00:00', 'GGGGGGGGGGGGGg', 'GGG', 'GG', '', '', '', '', '', '', '', ''),
(224649, '', '', 1, 'sdfdsf', '2021-03-11 00:00:00', 'sdfsdf', 'sdfsdf', 'sdfsdf', '', '', '', '', '', '', '', ''),
(278451, 'on', 'on', 1, 'OP', '2021-03-25 00:00:00', 'OOOo', 'Oo', 'OOo', '', '', '', '', '', '', '', ''),
(288701, 'on', 'on', 2, 'asda', '2021-03-03 00:00:00', 'asdas', 'aas', 'asss', '', '', '', '', '', '', '', ''),
(300277, '', '', NULL, 'Melhor Marca de Roupa', '2021-03-05 00:00:00', 'Me Ajudem Escolher A Melhor Marca de Roupa ', 'MCD', 'CK', 'Nike', 'Adidas', '', '', '', '', '', ''),
(450192, '', '', NULL, 'Cor de Sapatos', '2021-03-18 00:00:00', 'Me ajudem a Escolher cor do meu próximo sapatos ', 'verde', 'azul', 'amarelo', 'rosa', 'branco', 'preto', '', '', '', ''),
(485691, 'on', 'on', 2, 'asas', '2021-03-10 00:00:00', 'asas', 'asas', 'asas', '', '', '', '', '', '', '', ''),
(500304, '', 'on', 2, 'Melhor Marca de Extrato de Tomate', '2021-03-10 18:27:06', 'Me Ajude a Escolher a Melhor Marca de Extrato de Tomate  ', 'Elefante', 'Quero', 'Heinz', 'Qualitá', '', '', '', '', '', ''),
(522555, '', '', NULL, 'Melhor Marca de Notebook', '2021-03-17 00:00:00', 'Estou procurando notebook para comprar gostaria de ajuda em escolher a melhor marca ', 'Dell', 'Acer', 'Lenovo', 'Asus', 'Sansung', 'Apple', '', '', '', ''),
(527002, '', '', 1, 'aUUUU', '2021-03-02 00:00:00', 'GGT', 'GGA', 'HHA', '', '', '', '', '', '', '', ''),
(534356, 'on', '', NULL, 'You tube', '2021-03-19 00:00:00', 'Vocês querem vídeo sobre...', 'Amoeba', 'React', '', '', '', '', '', '', '', ''),
(614807, '', '', NULL, 'Melhor Jogo do Ano', '2021-03-29 00:00:00', 'Escolha qual melhor o jogo do ano para que possamos premiá-lo', 'GTA-V', 'Minecraft', 'Dota 2', 'Diablo III', 'League of Legends', 'Call of Duty', 'Ark', 'Apex', 'Raft', 'The Legend of Zelda'),
(643960, 'on', 'on', 2, 'PooP', '2021-03-17 00:00:00', 'Oo', 'O', 'o', '', '', '', '', '', '', '', ''),
(703433, '', '', NULL, 'Nome de Criança', '2021-03-19 00:00:00', 'Ajude me ', 'Ana', 'Leticia', '', '', '', '', '', '', '', ''),
(725821, 'on', 'on', 1, 'GOD', '2021-03-18 00:00:00', 'GG', 'G1', 'G2', '', '', '', '', '', '', '', ''),
(826406, 'on', 'on', 1, 'Melhor Marca de Chocolate', '2021-03-17 00:00:00', 'Com a chegada da Páscoa, resolvi compra barras de chocolate em vez de ovo de Páscoa', 'Nestlé', 'Garoto', 'Lacta', 'Hershey`s', '', '', '', '', '', ''),
(865487, 'on', 'on', 2, 'Cor Favorita', '2021-03-02 00:00:00', '...', 'Azul', 'Vermelho', 'Preto', 'Branco', '', '', '', '', '', ''),
(891634, 'on', '', NULL, 'Caixa', '2021-03-13 00:00:00', 'Caixote', '01', '02', '', '', '', '', '', '', '', ''),
(938333, '', '', NULL, 'Melhor Marca de Carro', '2021-03-18 00:00:00', 'Escolha a Melhor marca de Carro', 'Audi', 'Ford', 'Volkswagen', 'Hyundai', 'Honda', 'Chevrolet', 'Renault', 'Kia ', 'Bmw', 'Mercedes Benz'),
(974330, 'on', '', NULL, 'Linguagem de Programação', '2021-03-22 00:00:00', 'Gosta taria de pedir ajuda para escolher minha próxima linguagem de programação', 'C+/C++', 'Java', 'JavaScript', 'PHP', 'Python', 'Swift', '', '', '', ''),
(990003, '', '', NULL, 'Itens para casa', '2021-03-18 00:00:00', 'ajuda para itens de casa ', 'cadeira ', 'mesa', 'fogão', 'geladeira', '', '', '', '', '', ''),
(990005, '', '', NULL, '', '2021-03-10 00:00:00', '', '', 'Testando Mensagem', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `enquete_simples_num`
--

CREATE TABLE `enquete_simples_num` (
  `Cod_Enquete_Simples_Num` int(4) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `Item1` int(6) NOT NULL,
  `Item2` int(6) NOT NULL,
  `Item3` int(6) NOT NULL,
  `Item4` int(6) NOT NULL,
  `Item5` int(6) NOT NULL,
  `Item6` int(6) NOT NULL,
  `Item7` int(6) NOT NULL,
  `Item8` int(6) NOT NULL,
  `Item9` int(6) NOT NULL,
  `Item10` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `enquete_simples_num`
--

INSERT INTO `enquete_simples_num` (`Cod_Enquete_Simples_Num`, `id_user`, `Item1`, `Item2`, `Item3`, `Item4`, `Item5`, `Item6`, `Item7`, `Item8`, `Item9`, `Item10`) VALUES
(121058, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(146218, NULL, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0),
(199316, NULL, 2, 2, 0, 0, 0, 0, 0, 0, 0, 0),
(278451, 1, 3, 2, 0, 0, 0, 0, 0, 0, 0, 0),
(288701, 2, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0),
(300277, NULL, 5, 5, 5, 5, 0, 0, 0, 0, 0, 0),
(450192, NULL, 2, 2, 0, 3, 1, 2, 0, 0, 0, 0),
(485691, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(500304, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(522555, NULL, 1, 0, 0, 0, 1, 0, 0, 0, 0, 0),
(534356, NULL, 6, 10, 0, 0, 0, 0, 0, 0, 0, 0),
(614807, NULL, 0, 1, 0, 1, 2, 1, 1, 1, 1, 0),
(643960, 2, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(703433, NULL, 3, 1, 0, 0, 0, 0, 0, 0, 0, 0),
(865487, 2, 2, 0, 2, 0, 0, 0, 0, 0, 0, 0),
(891634, NULL, 0, 2, 0, 0, 0, 0, 0, 0, 0, 0),
(938333, NULL, 7, 6, 6, 4, 15, 10, 11, 11, 41, 35),
(974330, NULL, 0, 0, 2, 7, 0, 0, 0, 0, 0, 0),
(990003, NULL, 1, 6, 5, 6, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `id_user` int(6) NOT NULL,
  `enquetes_user` int(11) DEFAULT NULL,
  `votos_user` int(11) DEFAULT NULL,
  `usuario` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `sexo` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `data_nac` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id_user`, `enquetes_user`, `votos_user`, `usuario`, `email`, `sexo`, `senha`, `data_nac`) VALUES
(1, NULL, NULL, 'Cleito Campos', 'cleitocampos@gmail.com', 'M', '3e19b5009c3f24642936caa810c1d4ba', '2021-02-04'),
(2, NULL, NULL, 'Isabela Campos', 'isabelacampos@gmail.com', 'F', 'f7820d605a3ebef2866aaba7e8c2fd64', '2002-10-25'),
(3, NULL, NULL, 'paulo', 'paulo@gmail.com', 'M', '5e70978f884a79cbd890a75d32b0121f', '2021-03-24');

-- --------------------------------------------------------

--
-- Estrutura da tabela `votos_usuario`
--

CREATE TABLE `votos_usuario` (
  `id_voto` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `cod_enquete` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `voto_user` varchar(255) NOT NULL,
  `quant_votos` int(11) NOT NULL,
  `data_voto` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `votos_usuario`
--

INSERT INTO `votos_usuario` (`id_voto`, `id_user`, `cod_enquete`, `titulo`, `voto_user`, `quant_votos`, `data_voto`) VALUES
(1, 2, 938333, 'Melhor Marca de Carro', 'Bmw', 3, '2021-03-23 18:30:32'),
(2, 2, 938333, 'Melhor Marca de Carro', 'Mercedes Benz', 2, '2021-03-23 16:58:46'),
(3, 1, 938333, 'Melhor Marca de Carro', 'Bmw', 3, '2021-03-23 16:58:46'),
(4, 1, 938333, 'Melhor Marca de Carro', 'Mercedes Benz', 1, '2021-03-23 16:58:46'),
(5, 2, 865487, 'Cor Favorita', 'Azul', 1, '2021-03-23 16:58:46'),
(6, 2, 865487, 'Cor Favorita', 'Preto', 1, '2021-03-23 16:58:46'),
(7, 2, 288701, 'asda', 'asss', 1, '2021-03-23 16:58:46'),
(8, 1, 527002, 'aUUUU', 'GGA', 3, '2021-03-23 16:58:46'),
(9, 1, 527002, 'aUUUU', 'HHA', 2, '2021-03-23 16:58:46'),
(10, 1, 450192, 'Cor de Sapatos', 'preto', 1, '2021-03-23 16:58:46'),
(11, 1, 450192, 'Cor de Sapatos', 'rosa', 1, '2021-03-23 16:58:46'),
(12, 1, 199316, 'GGGGGGGg', 'GG', 1, '2021-03-23 16:58:46'),
(13, 1, 199316, 'GGGGGGGg', 'GGG', 1, '2021-03-23 16:58:46'),
(14, 1, 300277, 'Melhor Marca de Roupa', 'CK', 4, '2021-03-23 18:10:59'),
(15, 1, 300277, 'Melhor Marca de Roupa', 'Nike', 3, '2021-03-23 18:10:57'),
(16, 2, 643960, 'PooP', 'O', 1, '2021-03-23 16:58:46'),
(17, 3, 974330, 'Linguagem de Programação', 'PHP', 1, '2021-03-23 16:58:46'),
(18, 1, 974330, 'Linguagem de Programação', 'JavaScript', 1, '2021-03-23 17:38:32'),
(19, 1, 300277, 'Melhor Marca de Roupa', 'MCD', 1, '0000-00-00 00:00:00'),
(20, 1, 300277, 'Melhor Marca de Roupa', 'Adidas', 3, '2021-03-23 18:10:50');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `enquete_simples_caracteres`
--
ALTER TABLE `enquete_simples_caracteres`
  ADD PRIMARY KEY (`Cod_Enquete_Simples_Caracteres`),
  ADD KEY `id_user_fk` (`id_user`);

--
-- Índices para tabela `enquete_simples_num`
--
ALTER TABLE `enquete_simples_num`
  ADD PRIMARY KEY (`Cod_Enquete_Simples_Num`),
  ADD KEY `id_user_fk` (`id_user`);

--
-- Índices para tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `Cod_Enquete_Fk` (`enquetes_user`),
  ADD KEY `Cod_Enquete_votos_fk` (`votos_user`);

--
-- Índices para tabela `votos_usuario`
--
ALTER TABLE `votos_usuario`
  ADD PRIMARY KEY (`id_voto`),
  ADD KEY `cod_enquete_fk` (`cod_enquete`),
  ADD KEY `id_user` (`id_user`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `enquete_simples_caracteres`
--
ALTER TABLE `enquete_simples_caracteres`
  MODIFY `Cod_Enquete_Simples_Caracteres` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=990006;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_user` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `votos_usuario`
--
ALTER TABLE `votos_usuario`
  MODIFY `id_voto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `enquete_simples_caracteres`
--
ALTER TABLE `enquete_simples_caracteres`
  ADD CONSTRAINT `id_user_fk` FOREIGN KEY (`id_user`) REFERENCES `usuario` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `enquete_simples_num`
--
ALTER TABLE `enquete_simples_num`
  ADD CONSTRAINT `id_user__fk` FOREIGN KEY (`id_user`) REFERENCES `usuario` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `Cod_Enquete_Fk` FOREIGN KEY (`enquetes_user`) REFERENCES `enquete_simples_caracteres` (`Cod_Enquete_Simples_Caracteres`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Cod_Enquete_votos_fk` FOREIGN KEY (`votos_user`) REFERENCES `enquete_simples_caracteres` (`Cod_Enquete_Simples_Caracteres`) ON UPDATE CASCADE;

--
-- Limitadores para a tabela `votos_usuario`
--
ALTER TABLE `votos_usuario`
  ADD CONSTRAINT `cod_enqueteFk` FOREIGN KEY (`cod_enquete`) REFERENCES `enquete_simples_caracteres` (`Cod_Enquete_Simples_Caracteres`) ON UPDATE CASCADE,
  ADD CONSTRAINT `id_userFk` FOREIGN KEY (`id_user`) REFERENCES `usuario` (`id_user`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
