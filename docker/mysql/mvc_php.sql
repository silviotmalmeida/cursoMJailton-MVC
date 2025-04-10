-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Tempo de geração: 10/04/2025 às 14:17
-- Versão do servidor: 5.7.44
-- Versão do PHP: 8.2.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `mvc_php`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `cliente`
--

CREATE TABLE `cliente` (
  `id_cliente` int(11) NOT NULL,
  `cliente` varchar(100) NOT NULL,
  `endereco` varchar(150) NOT NULL,
  `numero` varchar(10) NOT NULL,
  `bairro` varchar(100) NOT NULL,
  `cidade` varchar(80) NOT NULL,
  `cep` varchar(12) NOT NULL,
  `ddd` varchar(2) NOT NULL,
  `celular` varchar(15) NOT NULL,
  `sexo` varchar(15) DEFAULT NULL,
  `data_nascimento` date DEFAULT NULL,
  `cpf` varchar(15) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `site` varchar(100) DEFAULT NULL,
  `data_cadastro` date DEFAULT NULL,
  `observacao` text,
  `uf` varchar(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Despejando dados para a tabela `cliente`
--

INSERT INTO `cliente` (`id_cliente`, `cliente`, `endereco`, `numero`, `bairro`, `cidade`, `cep`, `ddd`, `celular`, `sexo`, `data_nascimento`, `cpf`, `email`, `site`, `data_cadastro`, `observacao`, `uf`) VALUES
(1, 'Manoel Jailton Sousa do Nascimento', 'Rua 45', '10', 'Cohama', 'São Luís', '7858544', '98', '9899898', NULL, '2019-12-30', '33716780677', 'mjailton@gmail.com', 'mjailton.com.br', '2019-12-30', '', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `contato`
--

CREATE TABLE `contato` (
  `id_contato` int(11) NOT NULL,
  `id_estado` int(11) NOT NULL,
  `contato` varchar(100) NOT NULL,
  `endereco` varchar(150) NOT NULL,
  `numero` varchar(10) NOT NULL,
  `bairro` varchar(100) NOT NULL,
  `cidade` varchar(80) NOT NULL,
  `cep` varchar(12) NOT NULL,
  `ddd` varchar(2) NOT NULL,
  `celular` varchar(15) NOT NULL,
  `sexo` varchar(15) DEFAULT NULL,
  `data_nascimento` date DEFAULT NULL,
  `cpf` varchar(15) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `site` varchar(100) DEFAULT NULL,
  `data_cadastro` date DEFAULT NULL,
  `observacao` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Despejando dados para a tabela `contato`
--

INSERT INTO `contato` (`id_contato`, `id_estado`, `contato`, `endereco`, `numero`, `bairro`, `cidade`, `cep`, `ddd`, `celular`, `sexo`, `data_nascimento`, `cpf`, `email`, `site`, `data_cadastro`, `observacao`) VALUES
(1, 3, 'Manoel Jailton Sousa do Nascimento', 'Rua 45', '10', 'Cohama', 'São Luís', '7858544', '98', '9899898', NULL, '2019-12-30', '33716780677', 'mjailton@gmail.com', 'mjailton.com.br', '2019-12-30', ''),
(2, 3, 'Manoel Jailton Sousa', 'Rua 45', '10', 'Cohama', 'São Luís', '7858544', '98', '9899898', NULL, '2019-12-30', '33716780677', 'mjailton@gmail.com', 'mjailton@gmail.com', '2019-12-30', '');

-- --------------------------------------------------------

--
-- Estrutura para tabela `estado`
--

CREATE TABLE `estado` (
  `id_estado` int(11) NOT NULL,
  `estado` varchar(100) NOT NULL,
  `sigla` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Despejando dados para a tabela `estado`
--

INSERT INTO `estado` (`id_estado`, `estado`, `sigla`) VALUES
(3, 'Maranhão', 'MA'),
(4, 'Maranhão', 'MA'),
(7, 'Rio de Janeiro', 'RJ'),
(8, 'São Paulo', 'SP'),
(9, 'Bahia', 'BA');

-- --------------------------------------------------------

--
-- Estrutura para tabela `test`
--

CREATE TABLE `test` (
  `id` bigint(20) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profession` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `test`
--

INSERT INTO `test` (`id`, `name`, `email`, `profession`) VALUES
(1, 'Nome 1', 'email1@email.com', 'engenheiro'),
(2, 'Nome 2', 'email2@email.com', 'médico'),
(3, 'Nome 3', 'email3@email.com', 'engenheiro');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Índices de tabela `contato`
--
ALTER TABLE `contato`
  ADD PRIMARY KEY (`id_contato`),
  ADD KEY `fk_contato_estado` (`id_estado`);

--
-- Índices de tabela `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`id_estado`);

--
-- Índices de tabela `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `contato`
--
ALTER TABLE `contato`
  MODIFY `id_contato` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `estado`
--
ALTER TABLE `estado`
  MODIFY `id_estado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `test`
--
ALTER TABLE `test`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `contato`
--
ALTER TABLE `contato`
  ADD CONSTRAINT `contato_ibfk_1` FOREIGN KEY (`id_estado`) REFERENCES `estado` (`id_estado`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
