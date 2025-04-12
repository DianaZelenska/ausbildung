create database forum;

use forum;

create table autor(
    id int not null auto_increment primary key,
    vorname varchar(50) not null
);

create table beitrag(
    id int not null auto_increment primary key,
    autorid int not null,
    datum date default current_date,
    inhalt text not null,
    foreign key (autorid) references autor(id),
    parentid int null,
    foreign key(parentid) references beitrag(id)
);
