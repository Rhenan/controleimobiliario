-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 21-Fev-2015 às 00:24
-- Versão do servidor: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `imob`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `evento`
--

CREATE TABLE IF NOT EXISTS `evento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(600) NOT NULL,
  `estadoAnterior` varchar(20) NOT NULL,
  `estadoModificado` varchar(20) NOT NULL,
  `dataDeModificacao` date NOT NULL,
  `valor` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1  ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `evento_orcamento`
--

CREATE TABLE IF NOT EXISTS `evento_orcamento` (
  `id_Evento` int(11) NOT NULL,
  `id_Orcamento` int(11) NOT NULL,
  UNIQUE KEY `id_orcamento` (`id_Orcamento`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `imovel`
--

CREATE TABLE IF NOT EXISTS `imovel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(60) NOT NULL,
  `endereco` varchar(200) NOT NULL,
  `cep` varchar(20) DEFAULT NULL,
  `identificador` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1  ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `imovel_usuario`
--

CREATE TABLE IF NOT EXISTS `imovel_usuario` (
  `id_Imovel` int(11) NOT NULL,
  `id_Usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `orcamento`
--

CREATE TABLE IF NOT EXISTS `orcamento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(100) NOT NULL,
  `valor` double NOT NULL,
  `pdf` varchar(300) NOT NULL,
  `situacao` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1  ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `servico`
--

CREATE TABLE IF NOT EXISTS `servico` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `acao` varchar(100) NOT NULL,
  `modulo` varchar(100) NOT NULL,
  `nome` varchar(120) NOT NULL,
  `hasMenuItem` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `acao` (`acao`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1  ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `servicomanutencao`
--

CREATE TABLE IF NOT EXISTS `servicomanutencao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `descricao` varchar(600) NOT NULL,
  `situacao` varchar(20) NOT NULL,
  `dataAbertura` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1  ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `servicomanutencao_evento`
--

CREATE TABLE IF NOT EXISTS `servicomanutencao_evento` (
  `id_ServicoManutencao` int(11) NOT NULL,
  `id_Evento` int(11) NOT NULL,
  UNIQUE KEY `id_Evento` (`id_Evento`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `servicomanutencao_imovel`
--

CREATE TABLE IF NOT EXISTS `servicomanutencao_imovel` (
  `id_ServicoManutencao` int(11) NOT NULL,
  `id_Imovel` int(11) NOT NULL,
  UNIQUE KEY `id_ServicoManutencao` (`id_ServicoManutencao`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `servicomanutencao_orcamento`
--

CREATE TABLE IF NOT EXISTS `servicomanutencao_orcamento` (
  `id_servicomanutencao` int(11) NOT NULL,
  `id_orcamento` int(11) NOT NULL,
  UNIQUE KEY `id_orcamento` (`id_orcamento`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `servicomanutencao_tipomanutencao`
--

CREATE TABLE IF NOT EXISTS `servicomanutencao_tipomanutencao` (
  `id_ServicoManutencao` int(11) NOT NULL,
  `id_TipoManutencao` int(11) NOT NULL,
  UNIQUE KEY `id_ServicoManutencao` (`id_ServicoManutencao`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipomanutencao`
--

CREATE TABLE IF NOT EXISTS `tipomanutencao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `categoria` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1  ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(20) NOT NULL,
  `senha` varchar(32) NOT NULL,
  `perfil` varchar(20) NOT NULL,
  `nome` varchar(120) NOT NULL,
  `status` varchar(12) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `usuario` (`usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1  ;

-- Default password for admin: admin

INSERT INTO `usuario` (`id`, `usuario`, `senha`, `perfil`, `nome`, `status`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Admin', 'admin', 'ATIVO');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario_evento`
--

CREATE TABLE IF NOT EXISTS `usuario_evento` (
  `id_Usuario` int(11) NOT NULL,
  `id_Evento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario_servico`
--

CREATE TABLE IF NOT EXISTS `usuario_servico` (
  `id_Usuario` int(11) NOT NULL,
  `id_Servico` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
