/*

SQLyog Ultimate v8.55 
MySQL - 5.7.33 : Database - phalcont_teste01

*********************************************************************

*/



/*!40101 SET NAMES utf8 */;



/*!40101 SET SQL_MODE=''*/;



/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;

/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

CREATE DATABASE IF NOT EXISTS `phalcont_teste01` /*!40100 DEFAULT CHARACTER SET latin1 */;



USE `phalcont_teste01`;



/*Table structure for table `noticia` */


DROP TABLE IF EXISTS `noticia`;



CREATE TABLE `noticia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(500) DEFAULT NULL,
  `texto` text DEFAULT '',
  `data_ultima_atualizacao` datetime DEFAULT NULL,
  `data_cadastro` datetime DEFAULT NULL,
  `publicado` int(1) DEFAULT 0,
  `data_publicacao` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4;



/*Data for the table `noticia` */



/*Table structure for table `usuario` */


DROP TABLE IF EXISTS `usuario`;



CREATE TABLE `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `senha` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;



/*Data for the table `usuario` */


insert  into `usuario`(`id`,`nome`,`email`,`senha`) values (1,'Teste','teste1@brasilbigdata.com.br','123456');


/*Table structure for table `categoria` */


DROP TABLE IF EXISTS `categoria`;



CREATE TABLE `categoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;



/*Data for the table `categoria` */



insert  into `categoria`(`id`,`nome`) values (1,'Saúde');
insert  into `categoria`(`id`,`nome`) values (2,'Esporte');
insert  into `categoria`(`id`,`nome`) values (3,'Política');



/*Table structure for table `noticia_categoria` */


DROP TABLE IF EXISTS `noticia_categoria`;



CREATE TABLE `noticia_categoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_noticia` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`id_noticia`) REFERENCES noticia(`id`),
  FOREIGN KEY (`id_categoria`) REFERENCES categoria(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;

/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;

/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;

/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

