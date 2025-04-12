create database staedte;

use staedte;

create table Stadt(
	id int not null auto_increment primary key,
	stadtname varchar(30) not null,
	einwohnerzahl int not null
);