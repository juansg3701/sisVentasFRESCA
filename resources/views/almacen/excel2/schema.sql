
create database importex1;
use importex1;

create table person(
	id int not null auto_increment primary key,
	no varchar(255) ,
	name varchar(255) not null,
	lastname varchar(50) not null,
	address1 varchar(50),
	address2 varchar(50),
	phone1 varchar(50),
	phone2 varchar(50),
	email1 varchar(50),
	email2 varchar(50),
	created_at datetime not null
);
