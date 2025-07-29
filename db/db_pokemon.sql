-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 29/07/2025 às 17:10
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `db_pokemon`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `cadastrar_pokemon`
--

CREATE TABLE `cadastrar_pokemon` (
  `id_pokemon` int(11) NOT NULL,
  `nome_pokemon` varchar(150) NOT NULL,
  `tipo_pokemon` enum('normal','fogo','agua','grama','eletrico','gelo','lutador','veneno','terra','voador','psiquico','inseto','pedra','fantasma','dragao','aco','sombrio','fada') NOT NULL,
  `loc_pokemon` varchar(300) NOT NULL,
  `data_pokemon` date NOT NULL,
  `hp_pokemon` varchar(150) NOT NULL,
  `ataque_pokemon` varchar(150) NOT NULL,
  `defesa_pokemon` varchar(150) NOT NULL,
  `obs_pokemon` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `cadastrar_pokemon`
--

INSERT INTO `cadastrar_pokemon` (`id_pokemon`, `nome_pokemon`, `tipo_pokemon`, `loc_pokemon`, `data_pokemon`, `hp_pokemon`, `ataque_pokemon`, `defesa_pokemon`, `obs_pokemon`) VALUES
(4, 'Pikachu', 'eletrico', 'Moçota', '2025-07-29', '60', 'choque', '40', 'gera eletricidade'),
(5, 'Mew', 'psiquico', 'Praça da Bandeira', '2025-07-25', '100', 'miragem mistica', 'qualquer golpe', 'lendario'),
(6, 'Charmander', 'fogo', 'Caverna', '2025-07-23', '39', 'Fire Fang', '43', '1º geração');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `cadastrar_pokemon`
--
ALTER TABLE `cadastrar_pokemon`
  ADD PRIMARY KEY (`id_pokemon`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `cadastrar_pokemon`
--
ALTER TABLE `cadastrar_pokemon`
  MODIFY `id_pokemon` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
