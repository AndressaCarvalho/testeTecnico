-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 04-Nov-2020 às 05:15
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
-- Banco de dados: `db_teste_tecnico`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_bicicleta`
--

CREATE TABLE `tb_bicicleta` (
  `id` int(11) NOT NULL,
  `descricao` longtext NOT NULL,
  `valor` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tb_bicicleta`
--

INSERT INTO `tb_bicicleta` (`id`, `descricao`, `valor`) VALUES
(1, 'BICICLETA COM FREIOS A DISCO', 410),
(2, 'BICICLETA URBANA', 360),
(3, 'BICICLETA COM DESIGN ERGONOMICO', 270),
(4, 'BICICLETA ULTRA LEVE', 595),
(5, 'BICICLETA PARA TRILHA', 400);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `tb_bicicleta`
--
ALTER TABLE `tb_bicicleta`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tb_bicicleta`
--
ALTER TABLE `tb_bicicleta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
