DROP DATABASE IF EXISTS MeteoDB;
CREATE DATABASE MeteoDB;
USE MeteoDB;


CREATE TABLE user (
	name		varchar(40)		NOT NULL,
 	mail		varchar(40)		NOT NULL,
 	password	varchar(16)		NOT NULL,
 
 	PRIMARY KEY (mail)

);

CREATE TABLE station (
	mail 		varchar(40)		NOT NULL,
	name		varchar(40)		NOT NULL,
	altitude	float	 		NOT NULL,
	latitude	float	 		NOT NULL,
	longitude	float	 		NOT NULL,
	id 			int 			NOT NULL    AUTO_INCREMENT,

	KEY (id),
	PRIMARY KEY (mail, name),
	FOREIGN KEY (mail) REFERENCES user (mail) ON DELETE CASCADE

);


INSERT INTO user VALUES ('pippo','test@gmail.com','password');

INSERT INTO station (mail, name, altitude, latitude, longitude) 
VALUES ('test@gmail.com','Monte Calvo',700,42.3541,13.2762);