-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 28-Nov-2023 às 14:44
-- Versão do servidor: 10.4.21-MariaDB
-- versão do PHP: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `sistema`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `onibus`
--

CREATE TABLE `onibus` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `status` enum('naRodoviaria','emRota','atrasado','semRota') NOT NULL,
  `regiao` enum('Terminal x Vila Esperanca','Terminal x Jardim das Laranjeiras / Santa Isabel','Terminal x J Laranjeiras / Santa Isabel Via Esperanca','Terminal x Cachoeira de Emas / Santa Fe','Terminal x Santa Fe','Terminal x Vila Sao Pedro','Terminal x Jardim Milenium Via Vila Sao Pedro','Terminal x Vila Sao Pedro / Cidade Jardim','Terminal x Taboao','Terminal x Jardim Morumbi','Terminal x Distrito Industrial','Terminal x AFA Via Psicultura','Terminal x AFA / Vila dos Sargentos') NOT NULL,
  `ultimaAtualizacao` varchar(255) NOT NULL,
  `horario` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `onibus`
--

INSERT INTO `onibus` (`id`, `nome`, `status`, `regiao`, `ultimaAtualizacao`, `horario`) VALUES
(1, 'AFA', 'naRodoviaria', 'Terminal x AFA / Vila dos Sargentos', 'Yuri', '05:35:00'),
(2, 'Vila Esperanca', 'atrasado', 'Terminal x Vila Esperanca', 'Yuri', '11:15:00'),
(3, 'Jardim Morumbi', 'emRota', 'Terminal x Jardim Morumbi', 'Yuri', '15:00:00'),
(4, 'Cachoeira De Emas', 'atrasado', 'Terminal x Cachoeira de Emas / Santa Fe', 'Yuri', '15:30:00'),
(5, 'Vila Sao Pedro', 'naRodoviaria', 'Terminal x Vila Sao Pedro / Cidade Jardim', 'Yuri', '16:15:00'),
(6, 'Taboao', 'semRota', 'Terminal x Taboao', 'Yuri', '13:05:00'),
(7, 'Distrito Industrial', 'semRota', 'Terminal x Distrito Industrial', 'Yuri', '06:25:00'),
(8, 'Jardim das Laranjeiras', 'emRota', 'Terminal x J Laranjeiras / Santa Isabel Via Esperanca', 'Yuri', '15:00:00'),
(9, 'Santa Fe', 'naRodoviaria', 'Terminal x Santa Fe', 'Yuri', '15:30:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(30) NOT NULL,
  `user` varchar(30) NOT NULL,
  `senha` varchar(30) NOT NULL,
  `cargo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `user`, `senha`, `cargo`) VALUES
(1, 'Yuri', 'yuri', '123', 1),
(2, 'Matheus', 'matheus', '123123', 0);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `onibus`
--
ALTER TABLE `onibus`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `onibus`
--
ALTER TABLE `onibus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
