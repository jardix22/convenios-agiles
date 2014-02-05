/*
Navicat MySQL Data Transfer

Source Server         : Local MySql
Source Server Version : 50532
Source Host           : localhost:3306
Source Database       : app_agreements_db

Target Server Type    : MYSQL
Target Server Version : 50532
File Encoding         : 65001

Date: 2014-02-05 00:36:01
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `agreements`
-- ----------------------------
DROP TABLE IF EXISTS `agreements`;
CREATE TABLE `agreements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text,
  `objetives` text,
  `responsible` varchar(255) DEFAULT NULL,
  `location_type` varchar(45) DEFAULT NULL,
  `coverage_type` varchar(45) DEFAULT NULL,
  `institution_type` varchar(255) DEFAULT NULL,
  `suscription_date` date DEFAULT NULL,
  `rectory_resolution` varchar(15) DEFAULT NULL,
  `state` int(11) DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `validity` varchar(255) DEFAULT NULL,
  `purpose_type` varchar(45) DEFAULT NULL,
  `is_undefined` tinyint(1) DEFAULT '0',
  `expired_date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of agreements
-- ----------------------------
INSERT INTO `agreements` VALUES ('10', 'Convenio Marco de Cooperación Interinstitucional entre KWS, Universidad de Hohenheim, Cámara Alemana y la Universidad Nacional del Altiplano - Puno.', 'Establecer los términos para la ejecución del Proyecto de Investigación: “Selección de poblaciones de mezclas evolutivas de quinua (Chenopodium quinoa Willd) asistido por marcadores genéticos en el Perú” ganador del Concurso Internacional convocado por “KWS”, “UHOH” y “CA”.', 'Dr. Ángel Mújica Sánchez', 'Internacional', 'Marco', 'Universidades', '2011-09-05', '1807-2011-R-UNA', '0', '2013-12-16 16:58:58', '2013-12-16 16:58:58', '5 años', 'Cooperación', '0', '2016-09-05');
INSERT INTO `agreements` VALUES ('11', 'Convenio Marco de Cooperación Interinstitucional ente la Universidad Mayor de San Simón (Bolivia), Universidad Técnica de Oruro (Bolivia) y la Universidad Nacional del Altiplano Puno.', 'Establecer una relación interinstitucional, con miras a promover acciones académicas y de desarrollo integral del sistema TDPS; Implementar acciones conjuntas para el intercambio académico y capacitación de estudiantes y docentes de la UNA, UTO y UMSA; Diseñar e implementar mecanismos desde la óptica académica para fortalecer el desarrollo de tareas conjuntas en materia de acuicultura, pesquería, recursos hidrobiológicos, ganadería y agricultura andina, medio ambiente y otros rubros relacionados con el contexto del TDPS.', 'Jefe de la Oficina de Cooperación Nacional e Internacional de la UNA PUNO. ', 'Internacional', 'Marco', 'Universidades', '2011-11-11', '2284-2011-R-UNA', '0', '2013-12-16 17:22:30', '2013-12-16 17:22:30', '3 años', 'Cooperación', '0', '2014-11-11');
INSERT INTO `agreements` VALUES ('12', 'Convenio Marco de cooperación interinstitucional entre la Universidad de Aquino – Bolivia y la Universidad Nacional del Altiplano Puno – Perú.', 'El objetivo del presente Convenio Marco de Cooperación Interinstitucional, es establecer y desarrollar programas de cooperación técnica interinstitucional entre la Universidad de Aquino de Bolivia y la Universidad Nacional del Altiplano Puno – Perú.', 'Decano de la Fac. de Medicina Humana.', 'Internacional', 'Marco', 'Universidades', '2011-11-09', '2582-2011-R-UNA', '0', '2013-12-16 17:26:53', '2013-12-16 17:26:53', '2 años', 'Cooperación', '0', '2013-11-09');

-- ----------------------------
-- Table structure for `lifelines`
-- ----------------------------
DROP TABLE IF EXISTS `lifelines`;
CREATE TABLE `lifelines` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `state` varchar(45) DEFAULT NULL,
  `when` datetime DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `agreement_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_lifelines_users1_idx` (`user_id`),
  CONSTRAINT `fk_lifelines_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=372 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of lifelines
-- ----------------------------
INSERT INTO `lifelines` VALUES ('8', 'modified', '2014-01-13 22:06:02', '9', null);
INSERT INTO `lifelines` VALUES ('9', 'created', '2014-01-13 22:08:10', '9', null);
INSERT INTO `lifelines` VALUES ('10', 'modified', '2014-01-13 22:08:18', '9', null);
INSERT INTO `lifelines` VALUES ('11', 'deleted', '2014-01-13 22:08:29', '9', null);
INSERT INTO `lifelines` VALUES ('12', 'modified', '2014-01-14 13:08:03', '9', null);
INSERT INTO `lifelines` VALUES ('14', 'deleted', '2014-01-15 02:10:21', '9', null);
INSERT INTO `lifelines` VALUES ('15', 'created', '2014-01-16 17:28:39', '9', null);
INSERT INTO `lifelines` VALUES ('16', 'deleted', '2014-01-16 17:29:03', '9', null);
INSERT INTO `lifelines` VALUES ('17', 'created', '2014-01-16 17:41:27', '9', null);
INSERT INTO `lifelines` VALUES ('18', 'created', '2014-01-16 17:41:44', '9', null);
INSERT INTO `lifelines` VALUES ('19', 'deleted', '2014-01-16 17:42:22', '9', null);
INSERT INTO `lifelines` VALUES ('20', 'deleted', '2014-01-16 17:42:25', '9', null);
INSERT INTO `lifelines` VALUES ('21', 'created', '2014-01-16 17:46:32', '9', null);
INSERT INTO `lifelines` VALUES ('22', 'created', '2014-01-16 17:46:50', '9', null);
INSERT INTO `lifelines` VALUES ('23', 'deleted', '2014-01-16 17:48:48', '9', null);
INSERT INTO `lifelines` VALUES ('24', 'deleted', '2014-01-16 17:48:51', '9', null);
INSERT INTO `lifelines` VALUES ('25', 'created', '2014-01-16 17:49:02', '9', null);
INSERT INTO `lifelines` VALUES ('26', 'created', '2014-01-16 17:49:22', '9', null);
INSERT INTO `lifelines` VALUES ('27', 'created', '2014-01-16 17:51:58', '9', null);
INSERT INTO `lifelines` VALUES ('28', 'deleted', '2014-01-16 19:45:43', '9', null);
INSERT INTO `lifelines` VALUES ('29', 'deleted', '2014-01-16 19:45:46', '9', null);
INSERT INTO `lifelines` VALUES ('30', 'deleted', '2014-01-16 19:45:49', '9', null);
INSERT INTO `lifelines` VALUES ('31', 'modified', '2014-01-16 20:34:38', '9', null);
INSERT INTO `lifelines` VALUES ('32', 'modified', '2014-01-16 20:44:47', '9', null);
INSERT INTO `lifelines` VALUES ('33', 'modified', '2014-01-16 20:44:55', '9', null);
INSERT INTO `lifelines` VALUES ('34', 'modified', '2014-01-16 20:46:57', '9', null);
INSERT INTO `lifelines` VALUES ('35', 'modified', '2014-01-16 20:47:18', '9', null);
INSERT INTO `lifelines` VALUES ('36', 'created', '2014-01-17 14:48:03', '9', null);
INSERT INTO `lifelines` VALUES ('37', 'created', '2014-01-17 14:50:57', '9', null);
INSERT INTO `lifelines` VALUES ('38', 'created', '2014-01-17 14:53:29', '9', null);
INSERT INTO `lifelines` VALUES ('39', 'modified', '2014-01-17 14:54:19', '9', null);
INSERT INTO `lifelines` VALUES ('40', 'created', '2014-01-17 14:54:47', '9', null);
INSERT INTO `lifelines` VALUES ('41', 'modified', '2014-01-17 15:36:05', '9', null);
INSERT INTO `lifelines` VALUES ('42', 'modified', '2014-01-17 15:36:17', '9', null);
INSERT INTO `lifelines` VALUES ('43', 'created', '2014-01-17 15:37:07', '9', null);
INSERT INTO `lifelines` VALUES ('44', 'modified', '2014-01-17 15:37:39', '9', null);
INSERT INTO `lifelines` VALUES ('45', 'deleted', '2014-01-17 15:39:32', '9', null);
INSERT INTO `lifelines` VALUES ('46', 'deleted', '2014-01-17 15:39:35', '9', null);
INSERT INTO `lifelines` VALUES ('47', 'deleted', '2014-01-17 15:39:38', '9', null);
INSERT INTO `lifelines` VALUES ('48', 'deleted', '2014-01-17 15:39:41', '9', null);
INSERT INTO `lifelines` VALUES ('49', 'deleted', '2014-01-17 15:39:44', '9', null);
INSERT INTO `lifelines` VALUES ('50', 'deleted', '2014-01-17 15:39:47', '9', null);
INSERT INTO `lifelines` VALUES ('51', 'modified', '2014-01-17 15:44:19', '9', null);
INSERT INTO `lifelines` VALUES ('52', 'modified', '2014-01-17 15:44:35', '9', null);
INSERT INTO `lifelines` VALUES ('53', 'modified', '2014-01-17 15:45:32', '9', null);
INSERT INTO `lifelines` VALUES ('54', 'modified', '2014-01-17 15:45:39', '9', null);
INSERT INTO `lifelines` VALUES ('55', 'deleted', '2014-01-17 15:50:23', '9', null);
INSERT INTO `lifelines` VALUES ('56', 'deleted', '2014-01-17 15:50:26', '9', null);
INSERT INTO `lifelines` VALUES ('57', 'modified', '2014-01-17 15:58:06', '9', null);
INSERT INTO `lifelines` VALUES ('58', 'created', '2014-01-17 16:04:54', '9', null);
INSERT INTO `lifelines` VALUES ('59', 'deleted', '2014-01-17 16:09:15', '9', null);
INSERT INTO `lifelines` VALUES ('60', 'created', '2014-01-17 16:40:48', '9', null);
INSERT INTO `lifelines` VALUES ('61', 'deleted', '2014-01-17 16:52:15', '9', null);
INSERT INTO `lifelines` VALUES ('62', 'created', '2014-01-17 16:59:55', '9', null);
INSERT INTO `lifelines` VALUES ('63', 'modified', '2014-01-17 17:00:39', '9', null);
INSERT INTO `lifelines` VALUES ('64', 'modified', '2014-01-17 17:01:14', '9', null);
INSERT INTO `lifelines` VALUES ('65', 'modified', '2014-01-17 17:01:22', '9', null);
INSERT INTO `lifelines` VALUES ('66', 'created', '2014-01-17 17:01:46', '9', null);
INSERT INTO `lifelines` VALUES ('67', 'deleted', '2014-01-17 17:07:29', '9', null);
INSERT INTO `lifelines` VALUES ('68', 'deleted', '2014-01-17 17:07:31', '9', null);
INSERT INTO `lifelines` VALUES ('69', 'created', '2014-01-17 17:17:02', '9', null);
INSERT INTO `lifelines` VALUES ('70', 'created', '2014-01-17 17:21:15', '9', null);
INSERT INTO `lifelines` VALUES ('71', 'modified', '2014-01-17 17:23:02', '9', null);
INSERT INTO `lifelines` VALUES ('72', 'deleted', '2014-01-17 17:41:52', '9', null);
INSERT INTO `lifelines` VALUES ('73', 'deleted', '2014-01-17 17:41:54', '9', null);
INSERT INTO `lifelines` VALUES ('74', 'created', '2014-01-17 19:39:20', '9', null);
INSERT INTO `lifelines` VALUES ('75', 'created', '2014-01-17 19:39:50', '9', null);
INSERT INTO `lifelines` VALUES ('76', 'modified', '2014-01-17 19:41:12', '9', null);
INSERT INTO `lifelines` VALUES ('77', 'modified', '2014-01-17 20:33:16', '9', null);
INSERT INTO `lifelines` VALUES ('78', 'modified', '2014-01-17 20:37:02', '9', null);
INSERT INTO `lifelines` VALUES ('79', 'modified', '2014-01-17 20:37:24', '9', null);
INSERT INTO `lifelines` VALUES ('80', 'created', '2014-01-17 20:42:31', '9', null);
INSERT INTO `lifelines` VALUES ('81', 'created', '2014-01-17 20:55:06', '9', null);
INSERT INTO `lifelines` VALUES ('82', 'created', '2014-01-17 20:56:58', '9', null);
INSERT INTO `lifelines` VALUES ('83', 'created', '2014-01-17 20:57:46', '9', null);
INSERT INTO `lifelines` VALUES ('84', 'created', '2014-01-17 20:59:44', '9', null);
INSERT INTO `lifelines` VALUES ('85', 'created', '2014-01-17 21:03:32', '9', null);
INSERT INTO `lifelines` VALUES ('86', 'deleted', '2014-01-17 21:04:00', '9', null);
INSERT INTO `lifelines` VALUES ('87', 'created', '2014-01-17 21:04:14', '9', null);
INSERT INTO `lifelines` VALUES ('88', 'created', '2014-01-17 21:05:02', '9', null);
INSERT INTO `lifelines` VALUES ('89', 'created', '2014-01-17 21:05:51', '9', null);
INSERT INTO `lifelines` VALUES ('90', 'created', '2014-01-17 21:19:03', '9', null);
INSERT INTO `lifelines` VALUES ('91', 'created', '2014-01-17 21:44:04', '9', null);
INSERT INTO `lifelines` VALUES ('92', 'created', '2014-01-17 21:58:18', '9', null);
INSERT INTO `lifelines` VALUES ('93', 'created', '2014-01-17 21:58:47', '9', null);
INSERT INTO `lifelines` VALUES ('94', 'created', '2014-01-17 21:59:23', '9', null);
INSERT INTO `lifelines` VALUES ('95', 'created', '2014-01-17 21:59:55', '9', null);
INSERT INTO `lifelines` VALUES ('96', 'created', '2014-01-17 22:11:15', '9', null);
INSERT INTO `lifelines` VALUES ('97', 'created', '2014-01-17 22:14:27', '9', null);
INSERT INTO `lifelines` VALUES ('98', 'created', '2014-01-17 22:15:42', '9', null);
INSERT INTO `lifelines` VALUES ('99', 'created', '2014-01-17 22:17:04', '9', null);
INSERT INTO `lifelines` VALUES ('100', 'created', '2014-01-17 22:18:30', '9', null);
INSERT INTO `lifelines` VALUES ('101', 'created', '2014-01-17 22:19:15', '9', null);
INSERT INTO `lifelines` VALUES ('102', 'deleted', '2014-01-17 22:19:46', '9', null);
INSERT INTO `lifelines` VALUES ('103', 'deleted', '2014-01-17 22:19:48', '9', null);
INSERT INTO `lifelines` VALUES ('104', 'deleted', '2014-01-17 22:19:50', '9', null);
INSERT INTO `lifelines` VALUES ('105', 'deleted', '2014-01-17 22:19:55', '9', null);
INSERT INTO `lifelines` VALUES ('106', 'deleted', '2014-01-17 22:19:58', '9', null);
INSERT INTO `lifelines` VALUES ('107', 'deleted', '2014-01-17 22:20:00', '9', null);
INSERT INTO `lifelines` VALUES ('108', 'deleted', '2014-01-17 22:20:02', '9', null);
INSERT INTO `lifelines` VALUES ('109', 'deleted', '2014-01-17 22:20:06', '9', null);
INSERT INTO `lifelines` VALUES ('110', 'deleted', '2014-01-17 22:20:12', '9', null);
INSERT INTO `lifelines` VALUES ('111', 'deleted', '2014-01-17 22:20:15', '9', null);
INSERT INTO `lifelines` VALUES ('112', 'deleted', '2014-01-17 22:20:17', '9', null);
INSERT INTO `lifelines` VALUES ('113', 'deleted', '2014-01-17 22:20:19', '9', null);
INSERT INTO `lifelines` VALUES ('114', 'deleted', '2014-01-17 22:20:21', '9', null);
INSERT INTO `lifelines` VALUES ('115', 'deleted', '2014-01-17 22:20:24', '9', null);
INSERT INTO `lifelines` VALUES ('116', 'deleted', '2014-01-17 22:20:27', '9', null);
INSERT INTO `lifelines` VALUES ('117', 'deleted', '2014-01-17 22:20:29', '9', null);
INSERT INTO `lifelines` VALUES ('118', 'deleted', '2014-01-17 22:20:33', '9', null);
INSERT INTO `lifelines` VALUES ('119', 'deleted', '2014-01-17 22:20:36', '9', null);
INSERT INTO `lifelines` VALUES ('120', 'deleted', '2014-01-17 22:20:41', '9', null);
INSERT INTO `lifelines` VALUES ('121', 'deleted', '2014-01-17 22:20:43', '9', null);
INSERT INTO `lifelines` VALUES ('122', 'deleted', '2014-01-17 22:20:45', '9', null);
INSERT INTO `lifelines` VALUES ('123', 'deleted', '2014-01-17 22:20:48', '9', null);
INSERT INTO `lifelines` VALUES ('124', 'created', '2014-01-17 22:21:10', '9', null);
INSERT INTO `lifelines` VALUES ('125', 'created', '2014-01-17 22:22:00', '9', null);
INSERT INTO `lifelines` VALUES ('126', 'created', '2014-01-17 22:24:54', '9', null);
INSERT INTO `lifelines` VALUES ('127', 'created', '2014-01-17 22:33:50', '9', null);
INSERT INTO `lifelines` VALUES ('128', 'created', '2014-01-17 22:41:36', '9', null);
INSERT INTO `lifelines` VALUES ('129', 'created', '2014-01-17 22:44:11', '9', null);
INSERT INTO `lifelines` VALUES ('130', 'deleted', '2014-01-17 22:49:01', '9', null);
INSERT INTO `lifelines` VALUES ('131', 'created', '2014-01-17 22:49:13', '9', null);
INSERT INTO `lifelines` VALUES ('132', 'created', '2014-01-17 22:55:11', '9', null);
INSERT INTO `lifelines` VALUES ('133', 'created', '2014-01-17 22:56:02', '9', null);
INSERT INTO `lifelines` VALUES ('134', 'created', '2014-01-17 22:56:46', '9', null);
INSERT INTO `lifelines` VALUES ('135', 'created', '2014-01-17 22:57:22', '9', null);
INSERT INTO `lifelines` VALUES ('136', 'created', '2014-01-17 23:02:44', '9', null);
INSERT INTO `lifelines` VALUES ('137', 'created', '2014-01-17 23:03:48', '9', null);
INSERT INTO `lifelines` VALUES ('138', 'created', '2014-01-17 17:18:08', '9', null);
INSERT INTO `lifelines` VALUES ('139', 'created', '2014-01-17 17:21:16', '9', null);
INSERT INTO `lifelines` VALUES ('140', 'deleted', '2014-01-17 23:27:03', '9', null);
INSERT INTO `lifelines` VALUES ('141', 'deleted', '2014-01-17 23:27:06', '9', null);
INSERT INTO `lifelines` VALUES ('142', 'deleted', '2014-01-17 23:27:08', '9', null);
INSERT INTO `lifelines` VALUES ('143', 'deleted', '2014-01-17 23:27:10', '9', null);
INSERT INTO `lifelines` VALUES ('144', 'deleted', '2014-01-17 23:27:13', '9', null);
INSERT INTO `lifelines` VALUES ('145', 'deleted', '2014-01-17 23:27:15', '9', null);
INSERT INTO `lifelines` VALUES ('146', 'deleted', '2014-01-17 23:27:18', '9', null);
INSERT INTO `lifelines` VALUES ('147', 'deleted', '2014-01-17 23:27:21', '9', null);
INSERT INTO `lifelines` VALUES ('148', 'deleted', '2014-01-17 23:27:23', '9', null);
INSERT INTO `lifelines` VALUES ('149', 'deleted', '2014-01-17 23:27:26', '9', null);
INSERT INTO `lifelines` VALUES ('150', 'deleted', '2014-01-17 23:27:29', '9', null);
INSERT INTO `lifelines` VALUES ('151', 'deleted', '2014-01-17 23:27:31', '9', null);
INSERT INTO `lifelines` VALUES ('152', 'created', '2014-01-17 17:27:47', '9', null);
INSERT INTO `lifelines` VALUES ('153', 'created', '2014-01-17 17:32:55', '9', null);
INSERT INTO `lifelines` VALUES ('154', 'modified', '2014-01-17 23:33:42', '9', null);
INSERT INTO `lifelines` VALUES ('155', 'modified', '2014-01-17 23:33:53', '9', null);
INSERT INTO `lifelines` VALUES ('156', 'modified', '2014-01-17 23:39:34', '9', null);
INSERT INTO `lifelines` VALUES ('157', 'modified', '2014-01-17 23:39:57', '9', null);
INSERT INTO `lifelines` VALUES ('158', 'deleted', '2014-01-17 23:40:11', '9', null);
INSERT INTO `lifelines` VALUES ('159', 'deleted', '2014-01-17 23:40:13', '9', null);
INSERT INTO `lifelines` VALUES ('160', 'deleted', '2014-01-17 23:40:16', '9', null);
INSERT INTO `lifelines` VALUES ('161', 'deleted', '2014-01-17 23:40:18', '9', null);
INSERT INTO `lifelines` VALUES ('162', 'modified', '2014-01-17 23:44:05', '9', null);
INSERT INTO `lifelines` VALUES ('163', 'created', '2014-01-28 10:02:24', '9', null);
INSERT INTO `lifelines` VALUES ('164', 'modified', '2014-01-28 21:34:48', '9', null);
INSERT INTO `lifelines` VALUES ('165', 'modified', '2014-01-28 21:35:02', '9', null);
INSERT INTO `lifelines` VALUES ('166', 'created', '2014-01-28 15:43:59', '9', null);
INSERT INTO `lifelines` VALUES ('167', 'created', '2014-01-28 15:45:53', '9', null);
INSERT INTO `lifelines` VALUES ('168', 'modified', '2014-01-28 21:51:52', '9', null);
INSERT INTO `lifelines` VALUES ('169', 'modified', '2014-01-28 21:51:56', '9', null);
INSERT INTO `lifelines` VALUES ('170', 'modified', '2014-01-28 22:02:03', '9', null);
INSERT INTO `lifelines` VALUES ('171', 'deleted', '2014-01-28 22:12:30', '9', null);
INSERT INTO `lifelines` VALUES ('172', 'deleted', '2014-01-28 22:12:32', '9', null);
INSERT INTO `lifelines` VALUES ('173', 'deleted', '2014-01-28 22:12:35', '9', null);
INSERT INTO `lifelines` VALUES ('174', 'created', '2014-01-28 16:16:21', '9', null);
INSERT INTO `lifelines` VALUES ('175', 'created', '2014-01-28 16:18:47', '9', null);
INSERT INTO `lifelines` VALUES ('176', 'deleted', '2014-01-28 22:19:33', '9', null);
INSERT INTO `lifelines` VALUES ('177', 'modified', '2014-01-28 22:25:50', '9', null);
INSERT INTO `lifelines` VALUES ('178', 'modified', '2014-01-28 22:26:40', '9', null);
INSERT INTO `lifelines` VALUES ('179', 'deleted', '2014-01-28 22:30:21', '9', null);
INSERT INTO `lifelines` VALUES ('180', 'created', '2014-01-28 16:35:06', '9', null);
INSERT INTO `lifelines` VALUES ('181', 'created', '2014-01-28 16:53:24', '9', null);
INSERT INTO `lifelines` VALUES ('182', 'created', '2014-01-28 16:58:24', '9', null);
INSERT INTO `lifelines` VALUES ('183', 'deleted', '2014-01-28 23:03:37', '9', null);
INSERT INTO `lifelines` VALUES ('184', 'deleted', '2014-01-28 23:03:39', '9', null);
INSERT INTO `lifelines` VALUES ('185', 'deleted', '2014-01-28 23:03:41', '9', null);
INSERT INTO `lifelines` VALUES ('186', 'deleted', '2014-01-28 23:03:44', '9', null);
INSERT INTO `lifelines` VALUES ('187', 'created', '2014-01-28 17:04:11', '9', null);
INSERT INTO `lifelines` VALUES ('188', 'created', '2014-01-28 17:04:38', '9', null);
INSERT INTO `lifelines` VALUES ('189', 'created', '2014-01-28 17:05:21', '9', null);
INSERT INTO `lifelines` VALUES ('190', 'created', '2014-01-28 17:05:43', '9', null);
INSERT INTO `lifelines` VALUES ('191', 'created', '2014-01-28 17:07:50', '9', null);
INSERT INTO `lifelines` VALUES ('192', 'created', '2014-01-28 17:09:01', '9', null);
INSERT INTO `lifelines` VALUES ('193', 'created', '2014-01-28 17:18:56', '9', null);
INSERT INTO `lifelines` VALUES ('194', 'created', '2014-01-28 17:19:39', '9', null);
INSERT INTO `lifelines` VALUES ('195', 'created', '2014-01-28 17:24:57', '9', null);
INSERT INTO `lifelines` VALUES ('196', 'created', '2014-01-28 17:29:46', '9', null);
INSERT INTO `lifelines` VALUES ('197', 'modified', '2014-01-28 23:41:27', '9', null);
INSERT INTO `lifelines` VALUES ('198', 'modified', '2014-01-28 23:41:31', '9', null);
INSERT INTO `lifelines` VALUES ('199', 'modified', '2014-01-28 23:41:36', '9', null);
INSERT INTO `lifelines` VALUES ('200', 'modified', '2014-01-28 23:41:44', '9', null);
INSERT INTO `lifelines` VALUES ('201', 'modified', '2014-01-28 23:41:48', '9', null);
INSERT INTO `lifelines` VALUES ('202', 'modified', '2014-01-28 23:46:22', '9', null);
INSERT INTO `lifelines` VALUES ('203', 'modified', '2014-01-28 23:46:33', '9', null);
INSERT INTO `lifelines` VALUES ('204', 'modified', '2014-01-28 23:47:02', '9', null);
INSERT INTO `lifelines` VALUES ('205', 'modified', '2014-01-28 23:47:46', '9', null);
INSERT INTO `lifelines` VALUES ('206', 'modified', '2014-01-28 23:55:13', '9', null);
INSERT INTO `lifelines` VALUES ('207', 'modified', '2014-01-28 23:55:27', '9', null);
INSERT INTO `lifelines` VALUES ('208', 'deleted', '2014-01-29 15:20:50', '9', null);
INSERT INTO `lifelines` VALUES ('209', 'deleted', '2014-01-29 15:20:55', '9', null);
INSERT INTO `lifelines` VALUES ('210', 'modified', '2014-01-29 15:22:33', '9', null);
INSERT INTO `lifelines` VALUES ('211', 'modified', '2014-01-29 15:22:46', '9', null);
INSERT INTO `lifelines` VALUES ('212', 'modified', '2014-01-29 15:23:12', '9', null);
INSERT INTO `lifelines` VALUES ('213', 'created', '2014-01-29 09:25:33', '9', null);
INSERT INTO `lifelines` VALUES ('214', 'created', '2014-01-29 09:26:20', '9', null);
INSERT INTO `lifelines` VALUES ('215', 'created', '2014-01-29 09:26:59', '9', null);
INSERT INTO `lifelines` VALUES ('216', 'created', '2014-01-29 09:30:33', '9', null);
INSERT INTO `lifelines` VALUES ('217', 'modified', '2014-01-29 15:30:51', '9', null);
INSERT INTO `lifelines` VALUES ('218', 'modified', '2014-01-29 15:34:02', '9', null);
INSERT INTO `lifelines` VALUES ('219', 'modified', '2014-01-29 15:35:14', '9', null);
INSERT INTO `lifelines` VALUES ('220', 'modified', '2014-01-29 15:36:37', '9', null);
INSERT INTO `lifelines` VALUES ('221', 'modified', '2014-01-29 15:36:52', '9', null);
INSERT INTO `lifelines` VALUES ('222', 'modified', '2014-01-29 15:37:11', '9', null);
INSERT INTO `lifelines` VALUES ('223', 'modified', '2014-01-29 15:37:37', '9', null);
INSERT INTO `lifelines` VALUES ('224', 'modified', '2014-01-29 15:38:14', '9', null);
INSERT INTO `lifelines` VALUES ('225', 'modified', '2014-01-29 15:39:03', '9', null);
INSERT INTO `lifelines` VALUES ('226', 'modified', '2014-01-29 15:44:01', '9', null);
INSERT INTO `lifelines` VALUES ('227', 'modified', '2014-01-29 15:44:35', '9', null);
INSERT INTO `lifelines` VALUES ('228', 'modified', '2014-01-29 15:45:59', '9', null);
INSERT INTO `lifelines` VALUES ('229', 'modified', '2014-01-29 15:46:14', '9', null);
INSERT INTO `lifelines` VALUES ('230', 'modified', '2014-01-29 15:47:18', '9', null);
INSERT INTO `lifelines` VALUES ('231', 'modified', '2014-01-29 15:47:38', '9', null);
INSERT INTO `lifelines` VALUES ('232', 'modified', '2014-01-29 15:47:52', '9', null);
INSERT INTO `lifelines` VALUES ('233', 'modified', '2014-01-29 15:53:53', '9', null);
INSERT INTO `lifelines` VALUES ('234', 'modified', '2014-01-29 15:54:27', '9', null);
INSERT INTO `lifelines` VALUES ('235', 'created', '2014-01-29 09:54:51', '9', null);
INSERT INTO `lifelines` VALUES ('236', 'created', '2014-01-29 09:57:17', '9', null);
INSERT INTO `lifelines` VALUES ('237', 'created', '2014-01-29 10:01:03', '9', null);
INSERT INTO `lifelines` VALUES ('238', 'modified', '2014-01-29 16:32:23', '9', null);
INSERT INTO `lifelines` VALUES ('239', 'created', '2014-01-29 10:33:19', '9', null);
INSERT INTO `lifelines` VALUES ('240', 'created', '2014-01-29 10:34:00', '9', null);
INSERT INTO `lifelines` VALUES ('241', 'modified', '2014-01-29 16:34:34', '9', null);
INSERT INTO `lifelines` VALUES ('242', 'created', '2014-01-29 10:40:32', '9', null);
INSERT INTO `lifelines` VALUES ('243', 'created', '2014-01-29 10:40:59', '9', null);
INSERT INTO `lifelines` VALUES ('244', 'modified', '2014-01-29 16:41:19', '9', null);
INSERT INTO `lifelines` VALUES ('245', 'deleted', '2014-01-29 17:03:27', '9', null);
INSERT INTO `lifelines` VALUES ('246', 'deleted', '2014-01-29 17:03:29', '9', null);
INSERT INTO `lifelines` VALUES ('247', 'deleted', '2014-01-29 17:03:32', '9', null);
INSERT INTO `lifelines` VALUES ('248', 'deleted', '2014-01-29 17:03:35', '9', null);
INSERT INTO `lifelines` VALUES ('249', 'deleted', '2014-01-29 17:03:37', '9', null);
INSERT INTO `lifelines` VALUES ('250', 'deleted', '2014-01-29 17:03:40', '9', null);
INSERT INTO `lifelines` VALUES ('251', 'deleted', '2014-01-29 17:03:42', '9', null);
INSERT INTO `lifelines` VALUES ('252', 'deleted', '2014-01-29 17:03:45', '9', null);
INSERT INTO `lifelines` VALUES ('253', 'deleted', '2014-01-29 17:03:47', '9', null);
INSERT INTO `lifelines` VALUES ('254', 'deleted', '2014-01-29 17:03:49', '9', null);
INSERT INTO `lifelines` VALUES ('255', 'deleted', '2014-01-29 17:03:52', '9', null);
INSERT INTO `lifelines` VALUES ('256', 'deleted', '2014-01-29 17:03:54', '9', null);
INSERT INTO `lifelines` VALUES ('257', 'deleted', '2014-01-29 17:03:56', '9', null);
INSERT INTO `lifelines` VALUES ('258', 'deleted', '2014-01-29 17:03:59', '9', null);
INSERT INTO `lifelines` VALUES ('259', 'deleted', '2014-01-29 17:04:01', '9', null);
INSERT INTO `lifelines` VALUES ('260', 'deleted', '2014-01-29 17:04:34', '9', null);
INSERT INTO `lifelines` VALUES ('261', 'deleted', '2014-01-29 17:04:36', '9', null);
INSERT INTO `lifelines` VALUES ('262', 'deleted', '2014-01-29 17:04:38', '9', null);
INSERT INTO `lifelines` VALUES ('263', 'deleted', '2014-01-29 17:04:41', '9', null);
INSERT INTO `lifelines` VALUES ('264', 'modified', '2014-01-29 19:11:10', '9', null);
INSERT INTO `lifelines` VALUES ('265', 'modified', '2014-01-29 19:11:17', '9', null);
INSERT INTO `lifelines` VALUES ('266', 'modified', '2014-01-29 19:24:20', '9', null);
INSERT INTO `lifelines` VALUES ('267', 'modified', '2014-01-29 19:24:31', '9', null);
INSERT INTO `lifelines` VALUES ('268', 'modified', '2014-01-29 19:25:12', '9', null);
INSERT INTO `lifelines` VALUES ('269', 'modified', '2014-01-29 20:19:16', '9', '14');
INSERT INTO `lifelines` VALUES ('270', 'modified', '2014-01-29 20:19:27', '9', '14');
INSERT INTO `lifelines` VALUES ('271', 'modified', '2014-01-29 20:19:43', '9', '14');
INSERT INTO `lifelines` VALUES ('272', 'modified', '2014-01-29 20:20:46', '9', '14');
INSERT INTO `lifelines` VALUES ('273', 'modified', '2014-01-29 20:26:37', '9', '14');
INSERT INTO `lifelines` VALUES ('274', 'created', '2014-01-29 15:10:18', '9', '147');
INSERT INTO `lifelines` VALUES ('275', 'created', '2014-01-29 15:12:12', '9', '148');
INSERT INTO `lifelines` VALUES ('276', 'created', '2014-01-29 15:15:02', '9', '149');
INSERT INTO `lifelines` VALUES ('277', 'created', '2014-01-29 15:17:39', '9', '150');
INSERT INTO `lifelines` VALUES ('278', 'deleted', '2014-01-29 21:18:01', '9', '150');
INSERT INTO `lifelines` VALUES ('279', 'deleted', '2014-01-29 21:18:04', '9', '149');
INSERT INTO `lifelines` VALUES ('280', 'created', '2014-01-29 15:18:19', '9', '151');
INSERT INTO `lifelines` VALUES ('281', 'deleted', '2014-01-29 21:19:08', '9', '151');
INSERT INTO `lifelines` VALUES ('282', 'created', '2014-01-29 15:19:19', '9', '152');
INSERT INTO `lifelines` VALUES ('283', 'deleted', '2014-01-29 21:57:39', '9', '152');
INSERT INTO `lifelines` VALUES ('284', 'deleted', '2014-01-29 21:57:42', '9', '148');
INSERT INTO `lifelines` VALUES ('285', 'deleted', '2014-01-29 21:57:46', '9', '147');
INSERT INTO `lifelines` VALUES ('286', 'created', '2014-01-29 16:00:13', '9', '153');
INSERT INTO `lifelines` VALUES ('287', 'deleted', '2014-01-29 22:00:51', '9', '153');
INSERT INTO `lifelines` VALUES ('288', 'created', '2014-01-29 16:01:21', '9', '154');
INSERT INTO `lifelines` VALUES ('289', 'modified', '2014-01-29 22:02:00', '9', '154');
INSERT INTO `lifelines` VALUES ('290', 'deleted', '2014-01-29 23:10:01', '9', '154');
INSERT INTO `lifelines` VALUES ('291', 'modified', '2014-01-29 23:12:55', '9', '14');
INSERT INTO `lifelines` VALUES ('292', 'created', '2014-01-29 19:06:12', '9', '155');
INSERT INTO `lifelines` VALUES ('293', 'created', '2014-01-29 19:06:50', '9', '156');
INSERT INTO `lifelines` VALUES ('294', 'created', '2014-01-29 19:08:23', '9', '157');
INSERT INTO `lifelines` VALUES ('295', 'created', '2014-01-29 19:09:58', '9', '158');
INSERT INTO `lifelines` VALUES ('296', 'created', '2014-01-29 19:13:48', '9', '159');
INSERT INTO `lifelines` VALUES ('297', 'created', '2014-01-29 19:16:33', '9', '160');
INSERT INTO `lifelines` VALUES ('299', 'created', '2014-01-29 19:19:47', '9', '162');
INSERT INTO `lifelines` VALUES ('301', 'created', '2014-01-29 19:22:06', '9', '164');
INSERT INTO `lifelines` VALUES ('302', 'created', '2014-01-30 02:06:38', '9', '165');
INSERT INTO `lifelines` VALUES ('303', 'created', '2014-01-29 20:07:22', '9', '166');
INSERT INTO `lifelines` VALUES ('304', 'created', '2014-01-29 20:07:37', '9', '167');
INSERT INTO `lifelines` VALUES ('305', 'created', '2014-01-29 20:09:01', '9', '168');
INSERT INTO `lifelines` VALUES ('306', 'created', '2014-01-29 20:12:50', '9', '169');
INSERT INTO `lifelines` VALUES ('307', 'created', '2014-01-29 20:15:59', '9', '170');
INSERT INTO `lifelines` VALUES ('311', 'created', '2014-01-29 20:20:09', '9', '174');
INSERT INTO `lifelines` VALUES ('312', 'created', '2014-01-29 20:22:16', '9', '175');
INSERT INTO `lifelines` VALUES ('313', 'created', '2014-01-29 20:23:22', '9', '176');
INSERT INTO `lifelines` VALUES ('314', 'created', '2014-01-29 20:23:49', '9', '177');
INSERT INTO `lifelines` VALUES ('316', 'deleted', '2014-01-30 02:24:35', '9', '178');
INSERT INTO `lifelines` VALUES ('317', 'deleted', '2014-01-30 02:24:38', '9', '177');
INSERT INTO `lifelines` VALUES ('318', 'deleted', '2014-01-30 02:24:40', '9', '176');
INSERT INTO `lifelines` VALUES ('319', 'deleted', '2014-01-30 02:24:42', '9', '175');
INSERT INTO `lifelines` VALUES ('320', 'deleted', '2014-01-30 02:24:45', '9', '174');
INSERT INTO `lifelines` VALUES ('321', 'deleted', '2014-01-30 02:24:47', '9', '168');
INSERT INTO `lifelines` VALUES ('322', 'deleted', '2014-01-30 02:28:51', '9', '167');
INSERT INTO `lifelines` VALUES ('323', 'deleted', '2014-01-30 02:28:54', '9', '164');
INSERT INTO `lifelines` VALUES ('324', 'deleted', '2014-01-30 02:28:57', '9', '165');
INSERT INTO `lifelines` VALUES ('325', 'deleted', '2014-01-30 02:29:00', '9', '166');
INSERT INTO `lifelines` VALUES ('326', 'deleted', '2014-01-30 02:29:07', '9', '173');
INSERT INTO `lifelines` VALUES ('327', 'deleted', '2014-01-30 02:29:10', '9', '172');
INSERT INTO `lifelines` VALUES ('328', 'deleted', '2014-01-30 02:29:12', '9', '171');
INSERT INTO `lifelines` VALUES ('329', 'deleted', '2014-01-30 02:29:14', '9', '170');
INSERT INTO `lifelines` VALUES ('330', 'deleted', '2014-01-30 02:29:17', '9', '169');
INSERT INTO `lifelines` VALUES ('331', 'deleted', '2014-01-30 02:29:19', '9', '163');
INSERT INTO `lifelines` VALUES ('332', 'deleted', '2014-01-30 02:29:22', '9', '162');
INSERT INTO `lifelines` VALUES ('333', 'created', '2014-01-29 20:30:25', '9', '179');
INSERT INTO `lifelines` VALUES ('334', 'created', '2014-01-29 20:31:04', '9', '180');
INSERT INTO `lifelines` VALUES ('335', 'deleted', '2014-01-31 01:46:06', '9', '180');
INSERT INTO `lifelines` VALUES ('336', 'deleted', '2014-01-31 01:46:11', '9', '179');
INSERT INTO `lifelines` VALUES ('337', 'deleted', '2014-01-31 01:46:15', '9', '159');
INSERT INTO `lifelines` VALUES ('338', 'deleted', '2014-01-31 01:46:20', '9', '157');
INSERT INTO `lifelines` VALUES ('339', 'deleted', '2014-01-31 01:46:24', '9', '155');
INSERT INTO `lifelines` VALUES ('340', 'deleted', '2014-01-31 01:46:28', '9', '14');
INSERT INTO `lifelines` VALUES ('341', 'deleted', '2014-01-31 01:46:33', '9', '13');
INSERT INTO `lifelines` VALUES ('342', 'deleted', '2014-01-31 01:46:38', '9', '156');
INSERT INTO `lifelines` VALUES ('343', 'created', '2014-01-30 19:54:44', '9', '181');
INSERT INTO `lifelines` VALUES ('344', 'deleted', '2014-02-04 16:02:34', '9', '181');
INSERT INTO `lifelines` VALUES ('345', 'deleted', '2014-02-04 16:02:38', '9', '161');
INSERT INTO `lifelines` VALUES ('346', 'created', '2014-02-04 10:32:45', '9', '182');
INSERT INTO `lifelines` VALUES ('347', 'created', '2014-02-04 11:04:48', '9', '183');
INSERT INTO `lifelines` VALUES ('348', 'created', '2014-02-04 11:31:00', '9', '184');
INSERT INTO `lifelines` VALUES ('349', 'created', '2014-02-04 12:05:15', '9', '185');
INSERT INTO `lifelines` VALUES ('350', 'created', '2014-02-04 12:11:43', '9', '186');
INSERT INTO `lifelines` VALUES ('351', 'created', '2014-02-04 12:14:44', '9', '187');
INSERT INTO `lifelines` VALUES ('352', 'modified', '2014-02-04 18:14:56', '9', '187');
INSERT INTO `lifelines` VALUES ('353', 'deleted', '2014-02-04 18:15:05', '9', '187');
INSERT INTO `lifelines` VALUES ('354', 'deleted', '2014-02-04 18:15:07', '9', '186');
INSERT INTO `lifelines` VALUES ('355', 'deleted', '2014-02-04 18:15:10', '9', '185');
INSERT INTO `lifelines` VALUES ('356', 'deleted', '2014-02-04 18:15:12', '9', '184');
INSERT INTO `lifelines` VALUES ('357', 'deleted', '2014-02-04 18:15:15', '9', '183');
INSERT INTO `lifelines` VALUES ('358', 'deleted', '2014-02-04 18:15:22', '9', '182');
INSERT INTO `lifelines` VALUES ('359', 'deleted', '2014-02-04 18:15:27', '9', '160');
INSERT INTO `lifelines` VALUES ('360', 'deleted', '2014-02-04 18:15:30', '9', '158');
INSERT INTO `lifelines` VALUES ('361', 'created', '2014-02-04 12:23:03', '9', '188');
INSERT INTO `lifelines` VALUES ('362', 'modified', '2014-02-04 18:24:51', '9', '188');
INSERT INTO `lifelines` VALUES ('363', 'modified', '2014-02-04 18:25:25', '9', '188');
INSERT INTO `lifelines` VALUES ('364', 'modified', '2014-02-04 18:25:52', '9', '188');
INSERT INTO `lifelines` VALUES ('365', 'modified', '2014-02-04 18:27:29', '9', '188');
INSERT INTO `lifelines` VALUES ('366', 'modified', '2014-02-04 18:28:15', '9', '188');
INSERT INTO `lifelines` VALUES ('367', 'modified', '2014-02-04 18:29:50', '9', '188');
INSERT INTO `lifelines` VALUES ('368', 'created', '2014-02-04 12:35:15', '9', '189');
INSERT INTO `lifelines` VALUES ('369', 'modified', '2014-02-04 18:36:50', '9', '189');
INSERT INTO `lifelines` VALUES ('370', 'deleted', '2014-02-04 18:36:56', '9', '189');
INSERT INTO `lifelines` VALUES ('371', 'deleted', '2014-02-04 18:36:59', '9', '188');

-- ----------------------------
-- Table structure for `roles`
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` varchar(50) NOT NULL,
  `description` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES ('admin', 'Administrador');

-- ----------------------------
-- Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `role_id` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_users_roles1_idx` (`role_id`),
  CONSTRAINT `fk_users_roles1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('9', 'admin', 'd1d9e5187a6f48c9a643b7a7cb3ac4c6', 'admin', '');
