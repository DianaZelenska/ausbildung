CREATE DATABASE webshop;

USE webshop;

CREATE TABLE `webshop`.`produkt` (
	`id` INT NOT NULL AUTO_INCREMENT , 
	`produktname` VARCHAR(255) NOT NULL , 
	`beschreibung` TEXT NOT NULL , 
	PRIMARY KEY (`id`)
); 