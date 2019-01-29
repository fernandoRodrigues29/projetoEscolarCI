-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           5.7.14 - MySQL Community Server (GPL)
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Copiando estrutura do banco de dados para projetoescola
CREATE DATABASE IF NOT EXISTS `projetoescola` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `projetoescola`;


-- Copiando estrutura para tabela projetoescola.alternativa
CREATE TABLE IF NOT EXISTS `alternativa` (
  `id` int(11) DEFAULT NULL,
  `alternativa` varchar(50) DEFAULT NULL,
  `fk_questao` int(11) DEFAULT NULL,
  `gabarito` tinyint(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela projetoescola.alternativa: 0 rows
/*!40000 ALTER TABLE `alternativa` DISABLE KEYS */;
/*!40000 ALTER TABLE `alternativa` ENABLE KEYS */;


-- Copiando estrutura para tabela projetoescola.aluno
CREATE TABLE IF NOT EXISTS `aluno` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `fk_turma` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela projetoescola.aluno: 4 rows
/*!40000 ALTER TABLE `aluno` DISABLE KEYS */;
INSERT INTO `aluno` (`id`, `nome`, `email`, `fk_turma`) VALUES
	(1, 'don pedro de primaira2', 'dp@dp.com', NULL),
	(2, 'd pedro II', 'imperador2@casareal.com', NULL),
	(18, 'bonifacio', 'bonifacio@cr.com', NULL),
	(19, 'usuario sem imagem', 'imagem@img.com', NULL);
/*!40000 ALTER TABLE `aluno` ENABLE KEYS */;


-- Copiando estrutura para tabela projetoescola.aluno_disciplina
CREATE TABLE IF NOT EXISTS `aluno_disciplina` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_aluno` int(11) DEFAULT NULL,
  `fk_disciplina` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela projetoescola.aluno_disciplina: 4 rows
/*!40000 ALTER TABLE `aluno_disciplina` DISABLE KEYS */;
INSERT INTO `aluno_disciplina` (`id`, `fk_aluno`, `fk_disciplina`) VALUES
	(1, 35, 4),
	(2, 35, 1),
	(3, 1, 4),
	(5, 35, 5);
/*!40000 ALTER TABLE `aluno_disciplina` ENABLE KEYS */;


-- Copiando estrutura para tabela projetoescola.avaliacao
CREATE TABLE IF NOT EXISTS `avaliacao` (
  `id` int(11) DEFAULT NULL,
  `fk_aluno` int(11) DEFAULT NULL,
  `fk_disciplina` int(11) DEFAULT NULL,
  `nota` float DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela projetoescola.avaliacao: 0 rows
/*!40000 ALTER TABLE `avaliacao` DISABLE KEYS */;
/*!40000 ALTER TABLE `avaliacao` ENABLE KEYS */;


-- Copiando estrutura para tabela projetoescola.chat
CREATE TABLE IF NOT EXISTS `chat` (
  `int` int(11) DEFAULT NULL,
  `emissor` int(11) DEFAULT NULL,
  `remetente` int(11) DEFAULT NULL,
  `mensagem` text,
  `data` datetime DEFAULT NULL,
  `m_pai` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela projetoescola.chat: 0 rows
/*!40000 ALTER TABLE `chat` DISABLE KEYS */;
/*!40000 ALTER TABLE `chat` ENABLE KEYS */;


-- Copiando estrutura para tabela projetoescola.disciplina
CREATE TABLE IF NOT EXISTS `disciplina` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(50) NOT NULL,
  `descricao` text NOT NULL,
  `conteudo` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela projetoescola.disciplina: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `disciplina` DISABLE KEYS */;
INSERT INTO `disciplina` (`id`, `titulo`, `descricao`, `conteudo`) VALUES
	(1, 'ecologia do ser4', 'descrição do ecologia do ser', 'conteudo do ecologia do ser'),
	(4, 'protugues', 'humanas', 'conteudo 1\r\nconteudo 2\r\nconteudo 3\r\nconteudo 4'),
	(5, 'matematica', 'humanas', 'conteudo 1\r\nconteudo 2\r\nconteudo 3');
/*!40000 ALTER TABLE `disciplina` ENABLE KEYS */;


-- Copiando estrutura para tabela projetoescola.imagem_usuario
CREATE TABLE IF NOT EXISTS `imagem_usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `img` varchar(70) NOT NULL,
  `fk_usuario` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela projetoescola.imagem_usuario: 2 rows
/*!40000 ALTER TABLE `imagem_usuario` DISABLE KEYS */;
INSERT INTO `imagem_usuario` (`id`, `img`, `fk_usuario`) VALUES
	(34, '9cc5fdf2a534be7b428298423802ef4d.jpg', 1),
	(37, 'cf14e7b7554b4bfdd3f95b1520585d3e.jpg', 4);
/*!40000 ALTER TABLE `imagem_usuario` ENABLE KEYS */;


-- Copiando estrutura para tabela projetoescola.professor
CREATE TABLE IF NOT EXISTS `professor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `fk_disciplina` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela projetoescola.professor: 5 rows
/*!40000 ALTER TABLE `professor` DISABLE KEYS */;
INSERT INTO `professor` (`id`, `nome`, `fk_disciplina`) VALUES
	(1, 'valdir', NULL),
	(2, 'noslan', NULL),
	(3, 'gilberto', NULL),
	(6, 'Vladimir', 5),
	(7, 'Jurandir', 5);
/*!40000 ALTER TABLE `professor` ENABLE KEYS */;


-- Copiando estrutura para tabela projetoescola.professor_turma
CREATE TABLE IF NOT EXISTS `professor_turma` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_professor` int(11) DEFAULT NULL,
  `fk_turma` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela projetoescola.professor_turma: 1 rows
/*!40000 ALTER TABLE `professor_turma` DISABLE KEYS */;
INSERT INTO `professor_turma` (`id`, `fk_professor`, `fk_turma`) VALUES
	(1, 6, 2);
/*!40000 ALTER TABLE `professor_turma` ENABLE KEYS */;


-- Copiando estrutura para tabela projetoescola.questoes
CREATE TABLE IF NOT EXISTS `questoes` (
  `id` int(11) DEFAULT NULL,
  `questoes` varchar(50) DEFAULT NULL,
  `gabarito` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela projetoescola.questoes: 0 rows
/*!40000 ALTER TABLE `questoes` DISABLE KEYS */;
/*!40000 ALTER TABLE `questoes` ENABLE KEYS */;


-- Copiando estrutura para tabela projetoescola.resultado_avaliacao
CREATE TABLE IF NOT EXISTS `resultado_avaliacao` (
  `fk_questao` int(11) DEFAULT NULL,
  `fk_avaliacao` int(11) DEFAULT NULL,
  `gabarito` tinyint(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela projetoescola.resultado_avaliacao: 0 rows
/*!40000 ALTER TABLE `resultado_avaliacao` DISABLE KEYS */;
/*!40000 ALTER TABLE `resultado_avaliacao` ENABLE KEYS */;


-- Copiando estrutura para tabela projetoescola.resultado_multipla_escolha
CREATE TABLE IF NOT EXISTS `resultado_multipla_escolha` (
  `fk_avaliacao` int(11) DEFAULT NULL,
  `fk_questao` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela projetoescola.resultado_multipla_escolha: 0 rows
/*!40000 ALTER TABLE `resultado_multipla_escolha` DISABLE KEYS */;
/*!40000 ALTER TABLE `resultado_multipla_escolha` ENABLE KEYS */;


-- Copiando estrutura para tabela projetoescola.tab_teste
CREATE TABLE IF NOT EXISTS `tab_teste` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `campo` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela projetoescola.tab_teste: 1 rows
/*!40000 ALTER TABLE `tab_teste` DISABLE KEYS */;
INSERT INTO `tab_teste` (`id`, `campo`) VALUES
	(1, 'conseguimos3');
/*!40000 ALTER TABLE `tab_teste` ENABLE KEYS */;


-- Copiando estrutura para tabela projetoescola.turma
CREATE TABLE IF NOT EXISTS `turma` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `turma` varchar(50) DEFAULT NULL,
  `turno` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela projetoescola.turma: 3 rows
/*!40000 ALTER TABLE `turma` DISABLE KEYS */;
INSERT INTO `turma` (`id`, `turma`, `turno`) VALUES
	(1, '1-a', 'matutino'),
	(2, '1-b', 'vespertino'),
	(4, '2-a', 'noturno');
/*!40000 ALTER TABLE `turma` ENABLE KEYS */;


-- Copiando estrutura para tabela projetoescola.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(250) DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL,
  `login` varchar(250) DEFAULT NULL,
  `senha` varchar(70) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COMMENT='tabel destinada ao controle do acesso ao sistema';

-- Copiando dados para a tabela projetoescola.usuarios: 2 rows
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` (`id`, `nome`, `email`, `login`, `senha`) VALUES
	(1, 'alpha', 'alpha@emil.com', 'lalpha', '202cb962ac59075b964b07152d234b70'),
	(4, 'altere isso', 'alterisso@alter.com', 'hhgh', 'c80d813035d3da27eec278d500308db9');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
