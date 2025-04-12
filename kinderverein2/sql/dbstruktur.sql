create database kinderverein;

use kinderverein;

create table Mitglied(
	id int not null auto_increment primary key,
	vorname varchar(30) not null,
	nachname varchar(30) not null,
	jahre int not null
);