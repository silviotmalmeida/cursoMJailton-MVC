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
-- Estrutura para tabela `clientes`
--

CREATE TABLE `clientes` (
  `id_cliente` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `cep` varchar(12) NOT NULL,
  `endereco` varchar(150) NOT NULL,
  `complemento` varchar(150),
  `numero` varchar(10) NOT NULL,
  `bairro` varchar(100) NOT NULL,
  `cidade` varchar(80) NOT NULL,
  `uf` varchar(2) NOT NULL,
  `celular` varchar(15) NOT NULL,
  `cpf` varchar(15) NOT NULL,
  `sexo` varchar(15) NOT NULL,
  `data_nascimento` date NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `observacao` text,
  `data_cadastro` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Despejando dados para a tabela `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `nome`, `cep`,`endereco`, `complemento`, `numero`, `bairro`, `cidade`, `uf`, `celular`, `cpf`, `sexo`, `data_nascimento`, `email`, `senha`, `observacao`, `data_cadastro`) VALUES
(1, 'Manoel Jailton Sousa do Nascimento', '7858544', 'Rua 45', 'Próximo ao Bar Alcoolizados Anônimos', '10', 'Cohama', 'São Luís', 'MA', '9899898', '33716780677', 'M', '1972-12-30', 'mjailton@gmail.com', '$2y$10$/vC1UKrEJQUZLN2iM3U9re/4DQP74sXCOVXlYXe/j9zuv1/MHD4o.', 'observação', '2019-12-30');

-- --------------------------------------------------------

--
-- Estrutura para tabela `contatos`
--

CREATE TABLE `contatos` (
  `id_contato` int(11) NOT NULL,
  `id_estado` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
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
-- Despejando dados para a tabela `contatos`
--

INSERT INTO `contatos` (`id_contato`, `id_estado`, `nome`, `endereco`, `numero`, `bairro`, `cidade`, `cep`, `ddd`, `celular`, `sexo`, `data_nascimento`, `cpf`, `email`, `site`, `data_cadastro`, `observacao`) VALUES
(1, 3, 'Manoel Jailton Sousa do Nascimento', 'Rua 45', '10', 'Cohama', 'São Luís', '7858544', '98', '9899898', NULL, '2019-12-30', '33716780677', 'mjailton@gmail.com', 'mjailton.com.br', '2019-12-30', ''),
(2, 3, 'Manoel Jailton Sousa', 'Rua 45', '10', 'Cohama', 'São Luís', '7858544', '98', '9899898', NULL, '2019-12-30', '33716780677', 'mjailton@gmail.com', 'mjailton@gmail.com', '2019-12-30', '');

-- --------------------------------------------------------

--
-- Estrutura para tabela `estados`
--

CREATE TABLE `estados` (
  `id_estado` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `sigla` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Despejando dados para a tabela `estados`
--

INSERT INTO `estados` (`id_estado`, `nome`, `sigla`) VALUES
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
-- Índices de tabela `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Índices de tabela `contatos`
--
ALTER TABLE `contatos`
  ADD PRIMARY KEY (`id_contato`),
  ADD KEY `fk_contato_estado` (`id_estado`);

--
-- Índices de tabela `estados`
--
ALTER TABLE `estados`
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
-- AUTO_INCREMENT de tabela `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `contatos`
--
ALTER TABLE `contatos`
  MODIFY `id_contato` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `estados`
--
ALTER TABLE `estados`
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
-- Restrições para tabelas `contatos`
--
ALTER TABLE `contatos`
  ADD CONSTRAINT `contato_ibfk_1` FOREIGN KEY (`id_estado`) REFERENCES `estados` (`id_estado`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
