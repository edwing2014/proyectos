/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50527
Source Host           : localhost:3306
Source Database       : proyectos2

Target Server Type    : MYSQL
Target Server Version : 50527
File Encoding         : 65001

Date: 2014-01-15 23:02:06
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `clientes`
-- ----------------------------
DROP TABLE IF EXISTS `clientes`;
CREATE TABLE `clientes` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nombres` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `apellidos` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `identificacion` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- ----------------------------
-- Records of clientes
-- ----------------------------
INSERT INTO `clientes` VALUES ('1', 'edwin', 'guevara', '1628474', 'admin@pixelweb.com.co');

-- ----------------------------
-- Table structure for `config`
-- ----------------------------
DROP TABLE IF EXISTS `config`;
CREATE TABLE `config` (
  `id` int(10) NOT NULL DEFAULT '1',
  `razon_social` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `dominio` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `inicial_folder` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `google_analitics_id_perfil` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `google_analitics_seguimiento` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `google_analitics_user` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `google_analitics_pws` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `metatittle` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `metadescr` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `keywords` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `nombre_sitio` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `descripcion_sitio` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `email_sistema` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `logo` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `empresa` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `telefono` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `ciudad` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `pais` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `celular` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `email_empresa` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `usuario_ftp` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `clave_ftp` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `ftp_server` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `ftp_port` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `ftp_folder` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `usuario_mail` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `clave_mail` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `mail_port` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `mail_server` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `clave_mail_sistema` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `puerto_mail` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `usuario_database` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `clave_database` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `database_port` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `database_server` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `usuario_ga` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `clave_ga` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `ga_profile_id` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `ga_page_code` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `usuario_facebook` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `clave_facebook` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `api_key_facebook` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `theme` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `status` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `lista_general` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `lista_boletin` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `lista_preguntas` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `lista_mensajes` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `slogan` longtext COLLATE utf8_spanish_ci,
  `enlace_facebook` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `enlace_twitter` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of config
-- ----------------------------

-- ----------------------------
-- Table structure for `empleados`
-- ----------------------------
DROP TABLE IF EXISTS `empleados`;
CREATE TABLE `empleados` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nombres` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `apellidos` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `identificacion` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `cargo` int(255) DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `clave` blob,
  `usuario` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `is_admin` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- ----------------------------
-- Records of empleados
-- ----------------------------
INSERT INTO `empleados` VALUES ('1', 'adnres', 'vina', '1474', '1', 'admin@pixelweb.com.co', 0xDC4E9F35DF0CF497, 'edwin', '1');
INSERT INTO `empleados` VALUES ('2', 'juan', 'perez', '258741', '1', 'admin@portaildelmediooriente.com', 0x7648446E7A2B4236487345735A41756E776167644F4A56387644426D46694E516D486D3336454B344568416B4E4F7853426F4E47742B67745871723078363649775A6A6152707570356450646C466F70614D675250513D3D, 'edgb', '1');

-- ----------------------------
-- Table structure for `proyectos`
-- ----------------------------
DROP TABLE IF EXISTS `proyectos`;
CREATE TABLE `proyectos` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `cliente` int(10) DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_entrega` date DEFAULT NULL,
  `a_cargo` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `descripcion` longtext COLLATE utf8_spanish_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- ----------------------------
-- Records of proyectos
-- ----------------------------
INSERT INTO `proyectos` VALUES ('3', 'demo1', '1', '2014-01-28', '2014-01-23', '1', '<p>\r\n	sas</p>\r\n');
INSERT INTO `proyectos` VALUES ('4', null, null, '2014-01-22', '2014-01-23', '1', null);
INSERT INTO `proyectos` VALUES ('5', 'demo2', '1', '2014-01-07', '2014-01-17', '2', '<p>\r\n	a</p>\r\n');

-- ----------------------------
-- Table structure for `tareas`
-- ----------------------------
DROP TABLE IF EXISTS `tareas`;
CREATE TABLE `tareas` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `proyecto` int(10) DEFAULT NULL,
  `empleado` int(10) DEFAULT NULL,
  `prioridad` int(10) DEFAULT NULL,
  `estado` int(10) DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `descripcion` longtext COLLATE utf8_spanish_ci,
  PRIMARY KEY (`id`),
  KEY `fkemp` (`empleado`),
  KEY `fkproyecto` (`proyecto`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- ----------------------------
-- Records of tareas
-- ----------------------------
INSERT INTO `tareas` VALUES ('6', 'as1', '3', '1', '1', '2', '2014-01-14', '2014-01-15', '<p>\r\n	as</p>\r\n');
INSERT INTO `tareas` VALUES ('7', 'wsq', '5', '1', '2', '1', '2014-01-28', '2014-01-31', '<p>\r\n	asas</p>\r\n');
INSERT INTO `tareas` VALUES ('8', 'tarea8', '5', '2', '1', '1', '2014-01-16', '2014-01-17', '<p>\r\n	hacer una</p>\r\n');
