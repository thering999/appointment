/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 80031 (8.0.31)
 Source Host           : localhost:3306
 Source Schema         : appointment

 Target Server Type    : MySQL
 Target Server Version : 80031 (8.0.31)
 File Encoding         : 65001

 Date: 19/06/2023 09:42:08
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for admin
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin`  (
  `aemail` varchar(255) CHARACTER SET tis620 COLLATE tis620_thai_ci NOT NULL,
  `apassword` varchar(255) CHARACTER SET tis620 COLLATE tis620_thai_ci NULL DEFAULT NULL,
  PRIMARY KEY (`aemail`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of admin
-- ----------------------------
INSERT INTO `admin` VALUES ('admin@edoc.com', '123');

-- ----------------------------
-- Table structure for appointment
-- ----------------------------
DROP TABLE IF EXISTS `appointment`;
CREATE TABLE `appointment`  (
  `appoid` int NOT NULL AUTO_INCREMENT,
  `pid` int NULL DEFAULT NULL,
  `apponum` int NULL DEFAULT NULL,
  `scheduleid` int NULL DEFAULT NULL,
  `appodate` date NULL DEFAULT NULL,
  PRIMARY KEY (`appoid`) USING BTREE,
  INDEX `pid`(`pid`) USING BTREE,
  INDEX `scheduleid`(`scheduleid`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 5 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Fixed;

-- ----------------------------
-- Records of appointment
-- ----------------------------
INSERT INTO `appointment` VALUES (3, 1, 1, 5, '2023-07-24');
INSERT INTO `appointment` VALUES (2, 6, 1, 4, '2023-07-23');
INSERT INTO `appointment` VALUES (1, 7, 1, 4, '2023-06-24');

-- ----------------------------
-- Table structure for doctor
-- ----------------------------
DROP TABLE IF EXISTS `doctor`;
CREATE TABLE `doctor`  (
  `docid` int NOT NULL AUTO_INCREMENT,
  `docemail` varchar(255) CHARACTER SET tis620 COLLATE tis620_thai_ci NULL DEFAULT NULL,
  `docname` varchar(255) CHARACTER SET tis620 COLLATE tis620_thai_ci NULL DEFAULT NULL,
  `docpassword` varchar(255) CHARACTER SET tis620 COLLATE tis620_thai_ci NULL DEFAULT NULL,
  `doccid` varchar(15) CHARACTER SET tis620 COLLATE tis620_thai_ci NULL DEFAULT NULL,
  `doctel` varchar(15) CHARACTER SET tis620 COLLATE tis620_thai_ci NULL DEFAULT NULL,
  `specialties` int NULL DEFAULT NULL,
  PRIMARY KEY (`docid`) USING BTREE,
  INDEX `specialties`(`specialties`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of doctor
-- ----------------------------
INSERT INTO `doctor` VALUES (1, 'doctor@edoc.com', 'Test Doctor', '123', '1350400052968', '0110000000', 1);
INSERT INTO `doctor` VALUES (2, 'dr_no@edoc.com', 'doctor NO', '123', '3499900016055', '0804066967', 20);

-- ----------------------------
-- Table structure for exam1
-- ----------------------------
DROP TABLE IF EXISTS `exam1`;
CREATE TABLE `exam1`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `pid` int NOT NULL,
  `pemail` varchar(255) CHARACTER SET tis620 COLLATE tis620_thai_ci NULL DEFAULT NULL,
  `pname` varchar(20) CHARACTER SET tis620 COLLATE tis620_thai_ci NULL DEFAULT NULL,
  `pcid` varchar(15) CHARACTER SET tis620 COLLATE tis620_thai_ci NULL DEFAULT NULL,
  `age` varchar(20) CHARACTER SET tis620 COLLATE tis620_thai_ci NULL DEFAULT NULL,
  `ptel` varchar(15) CHARACTER SET tis620 COLLATE tis620_thai_ci NULL DEFAULT NULL,
  `no1` int NULL DEFAULT NULL,
  `no2` int NULL DEFAULT NULL,
  `no3` int NULL DEFAULT NULL,
  `no4` int NULL DEFAULT NULL,
  `no5` int NULL DEFAULT NULL,
  `no6` int NULL DEFAULT NULL,
  `no7` int NULL DEFAULT NULL,
  `no8` int NULL DEFAULT NULL,
  `no9` int NULL DEFAULT NULL,
  `no10` int NULL DEFAULT NULL,
  `no11` int NULL DEFAULT NULL,
  `no12` int NULL DEFAULT NULL,
  `no13` int NULL DEFAULT NULL,
  `no14` int NULL DEFAULT NULL,
  `no15` int NULL DEFAULT NULL,
  `no16` int NULL DEFAULT NULL,
  `no17` int NULL DEFAULT NULL,
  `no18` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`, `pid`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 6 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of exam1
-- ----------------------------
INSERT INTO `exam1` VALUES (1, 7, 'patient@edoc.com', 'Test Patient', '0000000000', '40', '0120000000', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0);
INSERT INTO `exam1` VALUES (2, 7, 'patient@edoc.com', 'Test Patient', '0000000000', '40', '0120000000', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0);
INSERT INTO `exam1` VALUES (3, 1, 'patient@edoc.com', 'Test Patient', '0000000000', '40', '0120000000', 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0);
INSERT INTO `exam1` VALUES (4, 1, 'patient@edoc.com', 'Test Patient', '0000000000', '40', '0120000000', 1, 1, 1, 1, 0, 1, 0, 1, 0, 1, 0, 1, 0, 1, 0, 0, 0, 0);
INSERT INTO `exam1` VALUES (5, 7, 'tester@edoc.com', 'test', '3499010070055', '70', '0804066967', 1, 0, 0, 1, 1, 0, 1, 1, 1, 1, 0, 0, 1, 1, 0, 0, 0, 0);

-- ----------------------------
-- Table structure for monitor1
-- ----------------------------
DROP TABLE IF EXISTS `monitor1`;
CREATE TABLE `monitor1`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `pid` int NOT NULL,
  `pemail` varchar(255) CHARACTER SET tis620 COLLATE tis620_thai_ci NULL DEFAULT NULL,
  `pname` varchar(20) CHARACTER SET tis620 COLLATE tis620_thai_ci NULL DEFAULT NULL,
  `pcid` varchar(15) CHARACTER SET tis620 COLLATE tis620_thai_ci NULL DEFAULT NULL,
  `age` varchar(20) CHARACTER SET tis620 COLLATE tis620_thai_ci NULL DEFAULT NULL,
  `ptel` varchar(15) CHARACTER SET tis620 COLLATE tis620_thai_ci NULL DEFAULT NULL,
  `lmp` date NULL DEFAULT NULL,
  `no1_1` int NULL DEFAULT NULL,
  `no1_2` int NULL DEFAULT NULL,
  `no1_3` int NULL DEFAULT NULL,
  `no1_4` int NULL DEFAULT NULL,
  `no2_1` int NULL DEFAULT NULL,
  `no2_2` int NULL DEFAULT NULL,
  `no3` int NULL DEFAULT NULL,
  `no4` int NULL DEFAULT NULL,
  `no5` int NULL DEFAULT NULL,
  `no6` int NULL DEFAULT NULL,
  `no7` int NULL DEFAULT NULL,
  `no8` int NULL DEFAULT NULL,
  `no9` int NULL DEFAULT NULL,
  `no10` int NULL DEFAULT NULL,
  `week` int NULL DEFAULT NULL,
  `start_date` date NULL DEFAULT NULL,
  `end_date` date NULL DEFAULT NULL,
  `answer` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`, `pid`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 11 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of monitor1
-- ----------------------------
INSERT INTO `monitor1` VALUES (7, 1, 'patient@edoc.com', 'Test Patient', '0000000000', '40', '0120000000', '2023-01-25', 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 33, '2023-09-13', '2023-09-20', 'abnormal_nhso');
INSERT INTO `monitor1` VALUES (8, 7, 'tester@edoc.com', 'test', '3499010070055', '70', '0804066967', '2023-01-25', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 12, '2023-04-19', '2023-04-26', 'abnormal_nhso');
INSERT INTO `monitor1` VALUES (9, 9, 'papart@gmail.com', 'monitor', '0000000000000', '27', '054948948', '2023-01-25', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 33, '2023-09-13', '2023-09-20', 'normal');
INSERT INTO `monitor1` VALUES (10, 9, 'papart@gmail.com', 'monitor', '0000000000000', '27', '054948948', '2023-01-25', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 33, '2023-09-13', '2023-09-20', 'abnormal_hospital');

-- ----------------------------
-- Table structure for patient
-- ----------------------------
DROP TABLE IF EXISTS `patient`;
CREATE TABLE `patient`  (
  `pid` int NOT NULL AUTO_INCREMENT,
  `pemail` varchar(255) CHARACTER SET tis620 COLLATE tis620_thai_ci NULL DEFAULT NULL,
  `pname` varchar(255) CHARACTER SET tis620 COLLATE tis620_thai_ci NULL DEFAULT NULL,
  `ppassword` varchar(255) CHARACTER SET tis620 COLLATE tis620_thai_ci NULL DEFAULT NULL,
  `paddress` varchar(255) CHARACTER SET tis620 COLLATE tis620_thai_ci NULL DEFAULT NULL,
  `pcid` varchar(15) CHARACTER SET tis620 COLLATE tis620_thai_ci NULL DEFAULT NULL,
  `pdob` date NULL DEFAULT NULL,
  `ptel` varchar(15) CHARACTER SET tis620 COLLATE tis620_thai_ci NULL DEFAULT NULL,
  `age` varchar(20) CHARACTER SET tis620 COLLATE tis620_thai_ci NULL DEFAULT NULL,
  `gravida` varchar(20) CHARACTER SET tis620 COLLATE tis620_thai_ci NULL DEFAULT NULL,
  `lmp` date NULL DEFAULT NULL,
  `edc` date NULL DEFAULT NULL,
  `weight` varchar(20) CHARACTER SET tis620 COLLATE tis620_thai_ci NULL DEFAULT NULL,
  `height` varchar(20) CHARACTER SET tis620 COLLATE tis620_thai_ci NULL DEFAULT NULL,
  `bmi` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `ancno` varchar(20) CHARACTER SET tis620 COLLATE tis620_thai_ci NULL DEFAULT NULL,
  `ancplace` varchar(20) CHARACTER SET tis620 COLLATE tis620_thai_ci NULL DEFAULT NULL,
  `salary` varchar(20) CHARACTER SET tis620 COLLATE tis620_thai_ci NULL DEFAULT NULL,
  `osm` varchar(20) CHARACTER SET tis620 COLLATE tis620_thai_ci NULL DEFAULT NULL,
  PRIMARY KEY (`pid`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 10 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of patient
-- ----------------------------
INSERT INTO `patient` VALUES (1, 'patient@edoc.com', 'Test Patient', '123', 'Sri Lanka', '0000000000', '2000-01-01', '0120000000', '40', '1', '2023-01-23', '2023-05-31', '50', '158', '25', '1', '10712', '20000', 'ไม่มี');
INSERT INTO `patient` VALUES (2, 'emhashenudara@gmail.com', 'Hashen Udara', '123', 'Sri Lanka', '0110000000', '2022-06-03', '0700000000', '40', '1', '2023-01-23', '2023-05-31', '50', '158', '25', '1', '10712', '20000', 'ไม่มี');
INSERT INTO `patient` VALUES (5, 'johnwick@gmail.com', 'john wick', '123', 'ประเทศไทย', '3499010070055', '2023-05-22', '0804066967', '40', '1', '2023-01-03', '2023-05-24', '50', '158', '25', '1', '10712', '20000', 'ไม่มี');
INSERT INTO `patient` VALUES (7, 'tester@edoc.com', 'test', '123', '1/2 มุกดาหาร', '3499010070055', '2023-05-23', '0804066967', '70', '1', '2023-01-25', '2023-05-31', '50', '158', '25', '1', '10712', '20000', 'ไม่มี');
INSERT INTO `patient` VALUES (9, 'papart@gmail.com', 'monitor', '123', '874/785', '0000000000000', '1996-06-28', '054948948', '27', '1', '2023-01-25', '2024-01-24', '73', '164', '50', '26', '??????.??????', '20000', '????????????????????');

-- ----------------------------
-- Table structure for schedule
-- ----------------------------
DROP TABLE IF EXISTS `schedule`;
CREATE TABLE `schedule`  (
  `scheduleid` int NOT NULL AUTO_INCREMENT,
  `docid` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `title` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `scheduledate` date NULL DEFAULT NULL,
  `scheduletime` time NULL DEFAULT NULL,
  `nop` int NULL DEFAULT NULL,
  PRIMARY KEY (`scheduleid`) USING BTREE,
  INDEX `docid`(`docid`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 9 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of schedule
-- ----------------------------
INSERT INTO `schedule` VALUES (1, '1', 'Test Session', '2023-06-20', '18:00:00', 50);
INSERT INTO `schedule` VALUES (2, '1', '1', '2023-06-01', '20:36:00', 1);
INSERT INTO `schedule` VALUES (3, '1', '12', '2023-06-26', '20:33:00', 1);
INSERT INTO `schedule` VALUES (4, '1', '1', '0000-00-00', '12:32:00', 1);
INSERT INTO `schedule` VALUES (5, '1', '1', '2023-07-25', '20:35:00', 1);
INSERT INTO `schedule` VALUES (6, '1', '12', '2023-07-30', '20:35:00', 1);
INSERT INTO `schedule` VALUES (7, '1', '1', '2023-06-17', '20:36:00', 1);
INSERT INTO `schedule` VALUES (8, '1', '12', '2023-07-24', '13:33:00', 1);

-- ----------------------------
-- Table structure for specialties
-- ----------------------------
DROP TABLE IF EXISTS `specialties`;
CREATE TABLE `specialties`  (
  `id` int NOT NULL,
  `sname` varchar(50) CHARACTER SET tis620 COLLATE tis620_thai_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of specialties
-- ----------------------------
INSERT INTO `specialties` VALUES (1, 'Accident and emergency medicine');
INSERT INTO `specialties` VALUES (2, 'Allergology');
INSERT INTO `specialties` VALUES (3, 'Anaesthetics');
INSERT INTO `specialties` VALUES (4, 'Biological hematology');
INSERT INTO `specialties` VALUES (5, 'Cardiology');
INSERT INTO `specialties` VALUES (6, 'Child psychiatry');
INSERT INTO `specialties` VALUES (7, 'Clinical biology');
INSERT INTO `specialties` VALUES (8, 'Clinical chemistry');
INSERT INTO `specialties` VALUES (9, 'Clinical neurophysiology');
INSERT INTO `specialties` VALUES (10, 'Clinical radiology');
INSERT INTO `specialties` VALUES (11, 'Dental, oral and maxillo-facial surgery');
INSERT INTO `specialties` VALUES (12, 'Dermato-venerology');
INSERT INTO `specialties` VALUES (13, 'Dermatology');
INSERT INTO `specialties` VALUES (14, 'Endocrinology');
INSERT INTO `specialties` VALUES (15, 'Gastro-enterologic surgery');
INSERT INTO `specialties` VALUES (16, 'Gastroenterology');
INSERT INTO `specialties` VALUES (17, 'General hematology');
INSERT INTO `specialties` VALUES (18, 'General Practice');
INSERT INTO `specialties` VALUES (19, 'General surgery');
INSERT INTO `specialties` VALUES (20, 'Geriatrics');
INSERT INTO `specialties` VALUES (21, 'Immunology');
INSERT INTO `specialties` VALUES (22, 'Infectious diseases');
INSERT INTO `specialties` VALUES (23, 'Internal medicine');
INSERT INTO `specialties` VALUES (24, 'Laboratory medicine');
INSERT INTO `specialties` VALUES (25, 'Maxillo-facial surgery');
INSERT INTO `specialties` VALUES (26, 'Microbiology');
INSERT INTO `specialties` VALUES (27, 'Nephrology');
INSERT INTO `specialties` VALUES (28, 'Neuro-psychiatry');
INSERT INTO `specialties` VALUES (29, 'Neurology');
INSERT INTO `specialties` VALUES (30, 'Neurosurgery');
INSERT INTO `specialties` VALUES (31, 'Nuclear medicine');
INSERT INTO `specialties` VALUES (32, 'Obstetrics and gynecology');
INSERT INTO `specialties` VALUES (33, 'Occupational medicine');
INSERT INTO `specialties` VALUES (34, 'Ophthalmology');
INSERT INTO `specialties` VALUES (35, 'Orthopaedics');
INSERT INTO `specialties` VALUES (36, 'Otorhinolaryngology');
INSERT INTO `specialties` VALUES (37, 'Paediatric surgery');
INSERT INTO `specialties` VALUES (38, 'Paediatrics');
INSERT INTO `specialties` VALUES (39, 'Pathology');
INSERT INTO `specialties` VALUES (40, 'Pharmacology');
INSERT INTO `specialties` VALUES (41, 'Physical medicine and rehabilitation');
INSERT INTO `specialties` VALUES (42, 'Plastic surgery');
INSERT INTO `specialties` VALUES (43, 'Podiatric Medicine');
INSERT INTO `specialties` VALUES (44, 'Podiatric Surgery');
INSERT INTO `specialties` VALUES (45, 'Psychiatry');
INSERT INTO `specialties` VALUES (46, 'Public health and Preventive Medicine');
INSERT INTO `specialties` VALUES (47, 'Radiology');
INSERT INTO `specialties` VALUES (48, 'Radiotherapy');
INSERT INTO `specialties` VALUES (49, 'Respiratory medicine');
INSERT INTO `specialties` VALUES (50, 'Rheumatology');
INSERT INTO `specialties` VALUES (51, 'Stomatology');
INSERT INTO `specialties` VALUES (52, 'Thoracic surgery');
INSERT INTO `specialties` VALUES (53, 'Tropical medicine');
INSERT INTO `specialties` VALUES (54, 'Urology');
INSERT INTO `specialties` VALUES (55, 'Vascular surgery');
INSERT INTO `specialties` VALUES (56, 'Venereology');

-- ----------------------------
-- Table structure for webuser
-- ----------------------------
DROP TABLE IF EXISTS `webuser`;
CREATE TABLE `webuser`  (
  `email` varchar(255) CHARACTER SET tis620 COLLATE tis620_thai_ci NOT NULL,
  `usertype` char(1) CHARACTER SET tis620 COLLATE tis620_thai_ci NULL DEFAULT NULL,
  PRIMARY KEY (`email`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of webuser
-- ----------------------------
INSERT INTO `webuser` VALUES ('admin@edoc.com', 'a');
INSERT INTO `webuser` VALUES ('doctor@edoc.com', 'd');
INSERT INTO `webuser` VALUES ('patient@edoc.com', 'p');
INSERT INTO `webuser` VALUES ('emhashenudara@gmail.com', 'p');
INSERT INTO `webuser` VALUES ('dr_no@edoc.com', 'd');
INSERT INTO `webuser` VALUES ('johnwick@gmail.com', 'd');
INSERT INTO `webuser` VALUES ('tester@edoc.com', 'd');
INSERT INTO `webuser` VALUES ('papart@gmail.com', 'd');

SET FOREIGN_KEY_CHECKS = 1;
