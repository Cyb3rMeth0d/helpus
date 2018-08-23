DROP DATABASE IF EXISTS helpus;
CREATE DATABASE helpus
		DEFAULT CHARACTER SET utf8;

USE helpus;

CREATE TABLE pais(
	id_pais INT NOT NULL AUTO_INCREMENT UNIQUE PRIMARY KEY,
	name VARCHAR(25) NOT NULL
);

INSERT INTO pais VALUES(1,'Spain');
CREATE TABLE provincia (
  idprovincia int(10) unsigned NOT NULL auto_increment,
  provincia varchar(50) NOT NULL,
  provinciaseo varchar(50) NOT NULL,
  provincia3 char(3) default NULL,
  PRIMARY KEY  (idprovincia),
  UNIQUE KEY provinciaseo (provinciaseo)
);
INSERT INTO provincia VALUES(1, 'Álava', 'alava', 'ALV');
INSERT INTO provincia VALUES(2, 'Castellón', 'castellon', 'CAS');
INSERT INTO provincia VALUES(3, 'León', 'leon', 'LEO');
INSERT INTO provincia VALUES(4, 'Salamanca', 'salamanca', 'SAL');
INSERT INTO provincia VALUES(5, 'Albacete', 'albacete', 'ABC');
INSERT INTO provincia VALUES(6, 'Ceuta', 'ceuta', 'CEU');
INSERT INTO provincia VALUES(7, 'Lleida', 'lleida', 'LLE');
INSERT INTO provincia VALUES(8, 'Segovia', 'segovia', 'SGV');
INSERT INTO provincia VALUES(9, 'Alicante', 'alicante', 'ALA');
INSERT INTO provincia VALUES(10, 'Ciudad Real', 'ciudad-real', 'CRE');
INSERT INTO provincia VALUES(11, 'Lugo', 'lugo', 'LUG');
INSERT INTO provincia VALUES(12, 'Sevilla', 'sevilla', 'SVL');
INSERT INTO provincia VALUES(13, 'Almería', 'almeria', 'ALM');
INSERT INTO provincia VALUES(14, 'Córdoba', 'cordoba', 'CBA');
INSERT INTO provincia VALUES(15, 'Madrid', 'madrid', 'MAD');
INSERT INTO provincia VALUES(16, 'Soria', 'soria', 'SOR');
INSERT INTO provincia VALUES(17, 'Asturias', 'asturias', 'AST');
INSERT INTO provincia VALUES(18, 'A Coruña', 'coruna', 'LCO');
INSERT INTO provincia VALUES(19, 'Málaga', 'malaga', 'MAL');
INSERT INTO provincia VALUES(20, 'Tarragona', 'tarragona', 'TRN');
INSERT INTO provincia VALUES(21, 'Ávila', 'avila', 'AVL');
INSERT INTO provincia VALUES(22, 'Cuenca', 'cuenca', 'CNC');
INSERT INTO provincia VALUES(23, 'Melilla', 'melilla', 'MEL');
INSERT INTO provincia VALUES(24, 'S.C. Tenerife', 'tenerife', 'SCT');
INSERT INTO provincia VALUES(25, 'Badajoz', 'badajoz', 'BDJ');
INSERT INTO provincia VALUES(26, 'Girona', 'girona', 'GIR');
INSERT INTO provincia VALUES(27, 'Murcia', 'murcia', 'MUR');
INSERT INTO provincia VALUES(28, 'Teruel', 'teruel', 'TER');
INSERT INTO provincia VALUES(29, 'Baleares', 'baleares', 'BAL');
INSERT INTO provincia VALUES(30, 'Granada', 'granada', 'GND');
INSERT INTO provincia VALUES(31, 'Navarra', 'navarra', 'NVR');
INSERT INTO provincia VALUES(32, 'Toledo', 'toledo', 'TOL');
INSERT INTO provincia VALUES(33, 'Barcelona', 'barcelona', 'BCN');
INSERT INTO provincia VALUES(34, 'Guadalajara', 'guadalajara', 'GLJ');
INSERT INTO provincia VALUES(35, 'Ourense', 'ourense', 'OUR');
INSERT INTO provincia VALUES(36, 'Valencia', 'valencia', 'VAL');
INSERT INTO provincia VALUES(37, 'Burgos', 'burgos', 'BRG');
INSERT INTO provincia VALUES(38, 'Guipúzcoa', 'guipuzcoa', 'GPZ');
INSERT INTO provincia VALUES(39, 'Palencia', 'palencia', 'PAL');
INSERT INTO provincia VALUES(40, 'Valladolid', 'valladolid', 'VLL');
INSERT INTO provincia VALUES(41, 'Cáceres', 'caceres', 'CAC');
INSERT INTO provincia VALUES(42, 'Huelva', 'huelva', 'HLV');
INSERT INTO provincia VALUES(43, 'Las Palmas', 'palmas', 'LPA');
INSERT INTO provincia VALUES(44, 'Vizcaya', 'vizcaya', 'VZC');
INSERT INTO provincia VALUES(45, 'Cádiz', 'cadiz', 'CDZ');
INSERT INTO provincia VALUES(46, 'Huesca', 'huesca', 'HSC');
INSERT INTO provincia VALUES(47, 'Pontevedra', 'pontevedra', 'PNV');
INSERT INTO provincia VALUES(48, 'Zamora', 'zamora', 'ZAM');
INSERT INTO provincia VALUES(49, 'Cantabria', 'cantabria', 'CTB');
INSERT INTO provincia VALUES(50, 'Jaén', 'jaen', 'JAE');
INSERT INTO provincia VALUES(51, 'La Rioja', 'rioja', 'LRJ');
INSERT INTO provincia VALUES(52, 'Zaragoza', 'zaragoza', 'ZAR');

CREATE TABLE poblacion (
  id_poblacion int(10) unsigned NOT NULL auto_increment,
  id_provincia int(10) unsigned NOT NULL,
  poblacion varchar(150) NOT NULL,
  poblacionseo varchar(150) default NULL,
  postal int(5) unsigned zerofill default NULL,
  latitud decimal(9,6) default NULL,
  longitud decimal(9,6) default NULL,
  PRIMARY KEY  (id_poblacion),
  UNIQUE KEY poblacionseo (poblacionseo),
  UNIQUE KEY lugar (latitud,longitud),
  KEY idprovincia (id_provincia)
)

CREATE TABLE categories(
	id_categoria INT NOT NULL AUTO_INCREMENT UNIQUE PRIMARY KEY,
	name VARCHAR(55) NOT NULL
);

CREATE TABLE users (
  id_user INT NOT NULL AUTO_INCREMENT UNIQUE,
  name VARCHAR(25) NOT NULL,
  lastname VARCHAR(25) NOT NULL,
  email VARCHAR(100) NOT NULL,
  password VARCHAR(255) NOT NULL,
  data DATETIME NOT NULL,
  fecha_registro DATETIME NOT NULL,
  poblacion INT NOT NULL  REFERENCES poblacion(id_poblacion),
  activo TINYINT NOT NULL,
  PRIMARY KEY(id_user)
);

CREATE TABLE helps(
	id_help INT NOT NULL AUTO_INCREMENT UNIQUE,
	id_user INT NOT NULL,
	title VARCHAR(255) NOT NULL,
	description TEXT CHARACTER SET utf8 NOT NULL,
	date_origen DATETIME NOT NULL,
	date_final DATETIME NOT NULL,
	price TINYINT,
	karma INT NOT NULL,
	categoria INT NOT NULL,
	PRIMARY KEY(id_help, id_user),
	FOREIGN KEY(categoria) REFERENCES categories(id_categoria)
	      ON DELETE RESTRICT
     	 ON UPDATE CASCADE,
	FOREIGN KEY(id_user) REFERENCES users(id_user)
	      ON DELETE RESTRICT
     	 ON UPDATE CASCADE
);




