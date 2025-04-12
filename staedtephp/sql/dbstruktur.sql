create database staedte;

using staedte;

create table Stadt (
    id int not null auto_increment primary key,
    stadtname varchar(30) not null,
    einwohnerzahl int not null
);