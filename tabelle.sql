Create DATABASE hw1;
USE hw1:

CREATE TABLE users (
    id integer primary key auto_increment,
    username varchar(16) not null unique,
    password varchar(255) not null,
    email varchar(255) not null unique,
    name varchar(255) not null,
    surname varchar(255) not null
) Engine = InnoDB;

CREATE TABLE films (
    id integer primary key auto_increment,
    user integer not null,
    film_id integer not null,
    content json,
    watched integer not null

) Engine = InnoDB;