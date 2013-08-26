-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tempo de Geração: 
-- Versão do Servidor: 5.5.27
-- Versão do PHP: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT=0;
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Banco de Dados: `orango`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(128) NOT NULL,
  `Slug` varchar(128) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `post`
--

CREATE TABLE IF NOT EXISTS `post` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Title` varchar(128) NOT NULL,
  `Slug` varchar(128) NOT NULL,
  `CreatedDate` int(11) NOT NULL,
  `PublicationDate` int(11) DEFAULT NULL,
  `UpdatedDate` int(11) DEFAULT NULL,
  `UserId` int(11) NOT NULL,
  `Content` text NOT NULL,
  `Status` int(11) NOT NULL,
  `Type` varchar(16) NOT NULL COMMENT 'post\npage',
  `ParentId` int(11) DEFAULT NULL,
  `Order` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `post_category`
--

CREATE TABLE IF NOT EXISTS `post_category` (
  `PostId` int(11) NOT NULL,
  `CategoryId` varchar(45) NOT NULL,
  PRIMARY KEY (`PostId`,`CategoryId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(128) NOT NULL,
  `Email` varchar(128) NOT NULL,
  `Password` varchar(32) NOT NULL,
  `Role` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `option`
--

CREATE TABLE IF NOT EXISTS `option` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(128) NOT NULL,
  `Value` varchar(128) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura stand-in para visualizar `view_category`
--
CREATE TABLE IF NOT EXISTS `view_category` (
`Id` int(11)
,`Name` varchar(128)
,`Slug` varchar(128)
,`PostId` int(11)
,`PostSlug` varchar(128)
,`PostTitle` varchar(128)
);
-- --------------------------------------------------------

--
-- Estrutura stand-in para visualizar `view_post`
--
CREATE TABLE IF NOT EXISTS `view_post` (
`Id` int(11)
,`Title` varchar(128)
,`Slug` varchar(128)
,`CreatedDate` int(11)
,`PublicationDate` int(11)
,`UpdatedDate` int(11)
,`UserId` int(11)
,`Content` text
,`Status` int(11)
,`CategoryId` int(11)
,`CategoryName` varchar(128)
,`CategorySlug` varchar(128)
,`AuthorName` varchar(128)
,`AuthorEmail` varchar(128)
);
-- --------------------------------------------------------

--
-- Estrutura para visualizar `view_category`
--
DROP TABLE IF EXISTS `view_category`;

CREATE VIEW `view_category` AS select `c`.`Id` AS `Id`,`c`.`Name` AS `Name`,`c`.`Slug` AS `Slug`,`p`.`Id` AS `PostId`,`p`.`Slug` AS `PostSlug`,`p`.`Title` AS `PostTitle` from ((`post` `p` join `post_category` `pc` on(((`p`.`Id` = `pc`.`PostId`) and (`p`.`Type` = 'post')))) join `category` `c` on((`pc`.`CategoryId` = `c`.`Id`)));

-- --------------------------------------------------------

--
-- Estrutura para visualizar `view_post`
--
DROP TABLE IF EXISTS `view_post`;

CREATE VIEW `view_post` AS select `p`.`Id` AS `Id`,`p`.`Title` AS `Title`,`p`.`Slug` AS `Slug`,`p`.`CreatedDate` AS `CreatedDate`,`p`.`PublicationDate` AS `PublicationDate`,`p`.`UpdatedDate` AS `UpdatedDate`,`p`.`UserId` AS `UserId`,`p`.`Content` AS `Content`,`p`.`Status` AS `Status`,`c`.`Id` AS `CategoryId`,`c`.`Name` AS `CategoryName`,`c`.`Slug` AS `CategorySlug`,`u`.`Name` AS `AuthorName`,`u`.`Email` AS `AuthorEmail` from (((`post` `p` join `user` `u` on((`u`.`Id` = `p`.`UserId`))) left join `post_category` `pc` on((`p`.`Id` = `pc`.`PostId`))) left join `category` `c` on((`pc`.`CategoryId` = `c`.`Id`))) where (`p`.`Type` = 'post');
COMMIT;
