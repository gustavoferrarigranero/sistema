/*
SQLyog Professional v12.09 (64 bit)
MySQL - 5.7.11 : Database - sistema
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `conf` */

DROP TABLE IF EXISTS `conf`;

CREATE TABLE `conf` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item` varchar(150) DEFAULT NULL,
  `valor` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `conf` */

insert  into `conf`(`id`,`item`,`valor`) values (2,'url','http://localhost/Psicoline/');
insert  into `conf`(`id`,`item`,`valor`) values (3,'usuario','admin');
insert  into `conf`(`id`,`item`,`valor`) values (4,'senha','123');

/*Table structure for table `consultas` */

DROP TABLE IF EXISTS `consultas`;

CREATE TABLE `consultas` (
  `id_consulta` int(11) NOT NULL AUTO_INCREMENT,
  `id_doutor` int(11) DEFAULT NULL,
  `id_paciente` int(11) DEFAULT NULL,
  `data` date DEFAULT NULL,
  `sintomas` text,
  PRIMARY KEY (`id_consulta`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `consultas` */

insert  into `consultas`(`id_consulta`,`id_doutor`,`id_paciente`,`data`,`sintomas`) values (4,5,4,'2016-09-11','czxczxczxc');

/*Table structure for table `mensagens` */

DROP TABLE IF EXISTS `mensagens`;

CREATE TABLE `mensagens` (
  `id_mensagem` int(11) NOT NULL AUTO_INCREMENT,
  `id_remetente` int(11) DEFAULT NULL,
  `id_destinatario` int(11) DEFAULT NULL,
  `mensagem` text,
  `dataenvio` datetime DEFAULT NULL,
  PRIMARY KEY (`id_mensagem`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

/*Data for the table `mensagens` */

insert  into `mensagens`(`id_mensagem`,`id_remetente`,`id_destinatario`,`mensagem`,`dataenvio`) values (7,6,5,'OlÃ¡, poderia me ajudar em uma questÃ£o?','2016-09-27 01:38:13');
insert  into `mensagens`(`id_mensagem`,`id_remetente`,`id_destinatario`,`mensagem`,`dataenvio`) values (8,5,6,'Posso sim, qual o problema?','2016-09-27 01:53:34');
insert  into `mensagens`(`id_mensagem`,`id_remetente`,`id_destinatario`,`mensagem`,`dataenvio`) values (6,5,4,'OlÃ¡, tudo sim, em que posso ajudar o sr.?','2016-09-27 01:22:00');
insert  into `mensagens`(`id_mensagem`,`id_remetente`,`id_destinatario`,`mensagem`,`dataenvio`) values (5,4,5,'OlÃ¡,\r\ntudo bem dr.?','2016-09-27 01:09:11');

/*Table structure for table `usuario` */

DROP TABLE IF EXISTS `usuario`;

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(150) NOT NULL,
  `email` varchar(250) DEFAULT NULL,
  `usuario` varchar(100) NOT NULL,
  `senha` varchar(50) NOT NULL,
  `datanascimento` date DEFAULT NULL,
  `cpf` varchar(100) NOT NULL,
  `rg` varchar(100) DEFAULT NULL,
  `problemasaude` text,
  `datacadastro` datetime DEFAULT NULL,
  `tipo` int(1) DEFAULT '1' COMMENT '1=paciente/2=medico',
  `status` int(1) DEFAULT '1',
  PRIMARY KEY (`id_usuario`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `usuario` */

insert  into `usuario`(`id_usuario`,`nome`,`email`,`usuario`,`senha`,`datanascimento`,`cpf`,`rg`,`problemasaude`,`datacadastro`,`tipo`,`status`) values (4,'Jose AntÃ´nio','jose@gmail.com','jose','e10adc3949ba59abbe56e057f20f883e','1975-04-17','435345345345','43534534534','','2016-10-14 18:10:28',1,1);
insert  into `usuario`(`id_usuario`,`nome`,`email`,`usuario`,`senha`,`datanascimento`,`cpf`,`rg`,`problemasaude`,`datacadastro`,`tipo`,`status`) values (6,'Arthur Silva','arthur@gmail.com','arthur','e10adc3949ba59abbe56e057f20f883e','1972-09-13','55645634545','65755475656','','2016-09-27 01:37:42',1,1);
insert  into `usuario`(`id_usuario`,`nome`,`email`,`usuario`,`senha`,`datanascimento`,`cpf`,`rg`,`problemasaude`,`datacadastro`,`tipo`,`status`) values (5,'Andre Pereira','andre@gmail.com','andre','e10adc3949ba59abbe56e057f20f883e','1975-04-17','435345345345','43534534534','','2016-10-14 18:07:39',2,1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
