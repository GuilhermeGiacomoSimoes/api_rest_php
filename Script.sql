create database bancoapirest;

use bancoapirest;

create table users(
	id int primary key, 
	first_name varchar(50) not null,
	last_name varchar(50) not null,
	email varchar(100) null
);
