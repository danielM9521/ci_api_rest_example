DROP DATABASE IF EXISTS VENDANOS_DB;
CREATE DATABASE VENDANOS_DB;
USE VENDANOS_DB;

CREATE TABLE PRODUCTO(
id_producto int primary key not null auto_increment,
nombre varchar(128) not null,
cantidad int not null,
precio_unitario float not null,
estado tinyint(1) not null
);