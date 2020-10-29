-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 30-Out-2020 às 00:52
-- Versão do servidor: 10.4.8-MariaDB
-- versão do PHP: 7.2.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `teste_tecnico`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_bicicleta`
--

CREATE TABLE `tb_bicicleta` (
  `id` int(11) NOT NULL,
  `descricao` longtext NOT NULL,
  `id_cor` int(11) NOT NULL,
  `id_material` int(11) NOT NULL,
  `id_marca_modelo` int(11) NOT NULL,
  `id_loja` int(11) NOT NULL,
  `valor` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tb_bicicleta`
--

INSERT INTO `tb_bicicleta` (`id`, `descricao`, `id_cor`, `id_material`, `id_marca_modelo`, `id_loja`, `valor`) VALUES
(1, 'BICICLETA COM FREIOS A DISCO', 1, 1, 1, 1, 410),
(2, 'BICICLETA URBANA', 2, 2, 2, 2, 360),
(3, 'BICICLETA COM DESIGN ERGONOMICO', 3, 3, 3, 3, 270);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_cor`
--

CREATE TABLE `tb_cor` (
  `id` int(11) NOT NULL,
  `cor` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tb_cor`
--

INSERT INTO `tb_cor` (`id`, `cor`) VALUES
(2, 'AMARELO'),
(3, 'AZUL'),
(1, 'VERMELHO');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_loja`
--

CREATE TABLE `tb_loja` (
  `id` int(11) NOT NULL,
  `razao_social` varchar(250) NOT NULL,
  `nome_fantasia` varchar(250) NOT NULL,
  `cnpj` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tb_loja`
--

INSERT INTO `tb_loja` (`id`, `razao_social`, `nome_fantasia`, `cnpj`) VALUES
(1, 'CASA BAHIA COMERCIAL LTDA', 'CASAS BAHIA', 59291534000167),
(2, 'LOJAS AMERICANAS SA', 'LOJAS AMERICANAS', 33014556000196),
(3, 'VIA VAREJO SA', 'PONTOFRIO', 33041260065290);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_marca`
--

CREATE TABLE `tb_marca` (
  `id` int(11) NOT NULL,
  `marca` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tb_marca`
--

INSERT INTO `tb_marca` (`id`, `marca`) VALUES
(2, 'CALOI'),
(3, 'GROOVE'),
(1, 'SOUTH BIKE');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_marca_modelo`
--

CREATE TABLE `tb_marca_modelo` (
  `id` int(11) NOT NULL,
  `id_marca` int(11) NOT NULL,
  `id_modelo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tb_marca_modelo`
--

INSERT INTO `tb_marca_modelo` (`id`, `id_marca`, `id_modelo`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 3, 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_material`
--

CREATE TABLE `tb_material` (
  `id` int(11) NOT NULL,
  `material` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tb_material`
--

INSERT INTO `tb_material` (`id`, `material`) VALUES
(1, 'ACO'),
(3, 'ALUMINIO'),
(2, 'FERRO');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_modelo`
--

CREATE TABLE `tb_modelo` (
  `id` int(11) NOT NULL,
  `modelo` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tb_modelo`
--

INSERT INTO `tb_modelo` (`id`, `modelo`) VALUES
(3, 'JAZZ DISC'),
(1, 'LEGEND'),
(2, 'URBAM');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `tb_bicicleta`
--
ALTER TABLE `tb_bicicleta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tb_bicicleta_fk_id_cor` (`id_cor`),
  ADD KEY `tb_bicicleta_fk_id_material` (`id_material`),
  ADD KEY `tb_bicicleta_fk_id_marca_modelo` (`id_marca_modelo`),
  ADD KEY `tb_bicicleta_fk_id_loja` (`id_loja`);

--
-- Índices para tabela `tb_cor`
--
ALTER TABLE `tb_cor`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cor` (`cor`);

--
-- Índices para tabela `tb_loja`
--
ALTER TABLE `tb_loja`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tb_loja_index_unique_cnpj` (`cnpj`);

--
-- Índices para tabela `tb_marca`
--
ALTER TABLE `tb_marca`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tb_marca_index_unique_marca` (`marca`);

--
-- Índices para tabela `tb_marca_modelo`
--
ALTER TABLE `tb_marca_modelo`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tb_marca_modelo_index_unique_id_modelo` (`id_modelo`),
  ADD KEY `tb_marca_modelo_fk_id_marca` (`id_marca`);

--
-- Índices para tabela `tb_material`
--
ALTER TABLE `tb_material`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tb_material_index_unique_material` (`material`);

--
-- Índices para tabela `tb_modelo`
--
ALTER TABLE `tb_modelo`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tb_modelo_index_unique_modelo` (`modelo`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tb_bicicleta`
--
ALTER TABLE `tb_bicicleta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `tb_cor`
--
ALTER TABLE `tb_cor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `tb_loja`
--
ALTER TABLE `tb_loja`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `tb_marca`
--
ALTER TABLE `tb_marca`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `tb_marca_modelo`
--
ALTER TABLE `tb_marca_modelo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `tb_material`
--
ALTER TABLE `tb_material`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `tb_modelo`
--
ALTER TABLE `tb_modelo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `tb_bicicleta`
--
ALTER TABLE `tb_bicicleta`
  ADD CONSTRAINT `tb_bicicleta_fk_id_cor` FOREIGN KEY (`id_cor`) REFERENCES `tb_cor` (`id`),
  ADD CONSTRAINT `tb_bicicleta_fk_id_loja` FOREIGN KEY (`id_loja`) REFERENCES `tb_loja` (`id`),
  ADD CONSTRAINT `tb_bicicleta_fk_id_marca_modelo` FOREIGN KEY (`id_marca_modelo`) REFERENCES `tb_marca_modelo` (`id`),
  ADD CONSTRAINT `tb_bicicleta_fk_id_material` FOREIGN KEY (`id_material`) REFERENCES `tb_material` (`id`);

--
-- Limitadores para a tabela `tb_marca_modelo`
--
ALTER TABLE `tb_marca_modelo`
  ADD CONSTRAINT `tb_marca_modelo_fk_id_marca` FOREIGN KEY (`id_marca`) REFERENCES `tb_marca` (`id`),
  ADD CONSTRAINT `tb_marca_modelo_fk_id_modelo` FOREIGN KEY (`id_modelo`) REFERENCES `tb_modelo` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
