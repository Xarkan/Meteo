DROP DATABASE IF EXISTS SampleStation;
CREATE DATABASE SampleStation;
USE SampleStation;

CREATE TABLE measure (
	time 		datetime 		NOT NULL,
	misura1		float			NOT NULL,
	misura2		float			NOT NULL,

	PRIMARY KEY (time)
);